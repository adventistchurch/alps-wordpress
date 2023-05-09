<?php


use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'alps');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "./app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'alps'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'fields', 'filters', 'admin', 'template-helpers']);
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

require_once __DIR__ . '/vendor/htmlburger/carbon-fields/core/functions.php';
require_once __DIR__ . '/app/carbon-fields/_init.php';
require_once __DIR__ . '/defaults-themes.php';
require_once __DIR__ . '/defaults.php';

define('ALPS_THEME_VERSION', '3.14.3.0');
define('ALPS_THEME_NAME', 'alps-gutenberg-blocks');

require_once __DIR__ . '/updater.php';
$updater = new \ALPS\Theme\ThemeUpdater(
    ALPS_THEME_NAME,
    ALPS_THEME_VERSION,
    'https://alps.adventistcdn.org/wordpress/themes/alps/alps-wordpress-v3.json'
);
$updater->init();

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

try {
    \Roots\bootloader();
} catch (Throwable $e) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://docs.roots.io/acorn/2.x/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

/*
|--------------------------------------------------------------------------
| Enable Sage Theme Support
|--------------------------------------------------------------------------
|
| Once our theme files are registered and available for use, we are almost
| ready to boot our application. But first, we need to signal to Acorn
| that we will need to initialize the necessary service providers built in
| for Sage when booting.
|
*/

// HELPER FUNCTION TO PULL CUSTOM FIELDS FROM EITHER CF or PL
function get_alps_field( $field, $id = NULL ) {
    global $post;
    if ( empty( $id ) ) {
        $id = get_queried_object_id();
    }
    $cf = get_option( 'alps_cf_converted' );
    if ( !empty( $cf ) ) {
        $field_data = carbon_get_post_meta( $id, $field );
        if ( !empty( $field_data ) ) {
            if ( is_array( $field_data ) ) {
                if ( count( $field_data ) === 1 ) {
                    return $field_data[0];
                } else {
                    // RETURN COMPLETE ARRAY
                    return $field_data;
                }
            }
        }
        else {
            return $field_data;
        }
    } else { // PIKLIST
        return get_post_meta( $id, $field, true );
    }
}

function get_alps_option( $field ) {
    global $post;
    $option = '';
    $cf = get_option( 'alps_cf_converted' );
    if ( $cf ) {
        $option = carbon_get_theme_option( $field );
    } else {
        if ( $options = get_option( 'alps_theme_settings' ) ) {
            if ( isset( $options[ $field ] )  ) {
                $option = $options[ $field ];
            }
            else {
                $option = '';
            }
        }
    }
    if ( is_array( $option ) ) {
        // RETURN SINGLE KEY/VAL ARRAY AS VAL (IMAGES)
        if ( count( $option ) == 1 ) {
            return $option[0];
        } else {
            // RETURN COMPLETE ARRAY
            return $option;
        }
    } else {
        return $option;
    }
}

/**
 * Pagination
 */
function pagination_nav() {
    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="pagination u-center-block u-text-align--center u-space--double--top">' . "\n";

    /** Previous Post Link */
    if (get_previous_posts_link())
        printf('%s' . "\n", get_previous_posts_link('<span class="u-icon u-icon--m u-theme--path-fill--dark u-space--half--left"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><title>Left arrow bracket</title><path d="M3.25,6.41l3.5,3.5L8.16,8.5,4.66,5l3.5-3.5L6.75.09l-3.5,3.5L1.84,5Z" fill="#9b9b9b"></path></svg>
</span>'));

    /** Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="pagination__page--current u-theme--color--base"' : '';

        printf('<span%s><a class="pagination__page u-padding--quarter u-theme--color--darker u-font-weight--bold" href="%s">%s</a></span>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            echo '<span class="pagination__divide">…</span>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="pagination__page--current u-theme--color--base"' : '';
        printf('<span%s><a class="pagination__page u-padding--quarter u-theme--color--darker u-font-weight--bold" href="%s">%s</a></span>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<span class="pagination__divide">…</span>' . "\n";

        $class = $paged == $max ? ' class="pagination__page--current u-theme--color--base"' : '';
        printf('<span%s><a class="pagination__page u-padding--quarter u-theme--color--darker u-font-weight--bold" href="%s">%s</a></span>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** Next Post Link */
    if (get_next_posts_link())
        printf('%s' . "\n", get_next_posts_link('<span class="u-icon u-icon--m u-theme--path-fill--dark u-space--half--right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><title>Right arrow bracket</title><path d="M6.75,3.59,3.25.09,1.84,1.5,5.34,5,1.84,8.5,3.25,9.91l3.5-3.5L8.16,5Z" fill="#9b9b9b"></path></svg>
</span>'));

    echo '</nav>' . "\n";
}

add_theme_support('sage');
