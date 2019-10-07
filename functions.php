<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

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
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'alps'), __('Invalid PHP version', 'alps'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'alps'), __('Invalid WordPress version', 'alps'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'alps'),
            __('Autoloader not found.', 'alps')
        );
    }
    require_once $composer;
}

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
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage
 *
 * We do this so that the Template Hierarchy will look in themes/sage/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage
 */
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require __DIR__.'/config/assets.php',
            'theme' => require __DIR__.'/config/theme.php',
            'view' => require __DIR__.'/config/view.php',
        ]);
    }, true);

/**
 * Allow SVG's through WP media uploader
 */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Provides automatic updates for the WordPress theme and plugins (http://wp-updates.com/)
 */
require_once __DIR__.'/app/plugin-activation.php';

/**
 * Adds excerpts to pages
 */
add_post_type_support( 'page', 'excerpt' );

/**
 * Require plugins on theme install
 */
add_action('tgmpa_register', 'adventist_register_required_plugins');
function adventist_register_required_plugins() {
    if (get_bloginfo('version') >= '5.0.0') {
      $plugin_name = 'Classic Editor';
      $plugin_slug = 'classic-editor';
      $plugin_required = true;
      $plugin_activation = true;
    } else {
      $plugin_name = 'Gutenberg';
      $plugin_slug = 'gutenberg';
      $plugin_required = true;
      $plugin_activation = true;
    }
    $plugins = array(
    // Piklist
    array(
      'name'               => 'Piklist', // The plugin name.
      'slug'               => 'piklist', // The plugin slug (typically the folder name).
      'source'             => 'https://github.com/piklist/piklist/archive/develop.zip', // The plugin source.
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),
    // Gutenberg Blocks
    array(
      'name'               => 'ALPS Gutenberg Blocks', // The plugin name.
      'slug'               => 'alps-gutenberg-blocks', // The plugin slug (typically the folder name).
      'source'             => 'https://kernl.us/api/v1/updates/5c13a3859e9cea4aa2fd8fbd/download', // The plugin source.
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),
    // Guidebook
    array(
      'name'               => 'Guidebpost', // The plugin name.
      'slug'               => 'guidepost', // The plugin slug (typically the folder name).
      'source'             => 'https://github.com/sortabrilliant/guidepost/archive/master.zip',
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),
    // WordPress SEO
    array(
      'name'              => 'WordPress SEO by Yoast',
      'slug'              => 'wordpress-seo',
      'required'          => false,
    ),
    // SVG Support
    array(
      'name'              => 'SVG Support',
      'slug'              => 'svg-support',
      'required'          => true,
      'force_activation'  => true,
    ),
    array(
      'name'              => $plugin_name,
      'slug'              => $plugin_slug,
      'required'          => $plugin_required,
      'force_activation'  => $plugin_activation,
    ),
  );
  $config = array(
    'id'           => 'adventist',             // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
  );
  tgmpa($plugins, $config);
}

/**
 * Fix for Piklist fields not saving
 */
function my_custom_init() {
  remove_post_type_support('post', 'custom-fields');
  remove_post_type_support('page', 'custom-fields');
}
add_action('init', 'my_custom_init');

/**
 * Piklist Theme Settings
 */
add_filter('piklist_admin_pages', 'piklist_theme_setting_pages');
function piklist_theme_setting_pages($pages) {
  $pages[] = array(
    'page_title' => __('ALPS Custom Settings')
    ,'menu_title' => __('ALPS Custom Settings', 'alps')
    ,'sub_menu' => 'themes.php' //Under Appearance menu
    ,'capability' => 'manage_options'
    ,'menu_slug' => 'custom_settings'
    ,'setting' => 'alps_theme_settings'
    ,'menu_icon' => plugins_url('piklist/parts/img/piklist-icon.png')
    ,'page_icon' => plugins_url('piklist/parts/img/piklist-page-icon-32.png')
    ,'single_line' => true
    ,'default_tab' => 'Basic'
    ,'save_text' => __('Save ALPS Theme Settings', 'alps')
  );
  return $pages;
}

/**
 * Add a custom parameter to the Piklist comment block.
 */
add_filter('piklist_part_data', 'my_custom_comment_block', 10, 2);
function my_custom_comment_block($data, $folder) {

  // If not a Meta-box section than bail
  if ($folder!= 'meta-boxes') {
      return $data;
  }

  // Allow Piklist to read our custom comment block attribute: "Hide for Template", and set it to hide_for_template
  $data['hide_for_template'] = 'Hide for Template';
  return $data;
}

/**
 * Assign meta-box access to user role, “no-role”, if the page template is selected
 */
add_filter('piklist_part_process_callback', 'my_hide_for_template', 10, 2);
function my_hide_for_template($part, $type) {
  global $post;

  // If not a meta box than bail
  if ($type != 'meta-boxes') {
    return $part;
  }

  // Check if any page template is set in the comment block
  if (!empty($part['data']['hide_for_template'])) {

    // Get the active page template
    $active_template = pathinfo(get_page_template_slug($post->ID), PATHINFO_FILENAME);
    $active_template = empty($active_template) ? 'default' : $active_template;

    // Does the active page template match what we want to hide?
    if (strpos($part['data']['hide_for_template'], $active_template) !== false) {

      // Change meta-box access to user role: no-role
      $part['data']['role'] = 'no-role';
    }
  }
  return $part;
}

/**
 * Menu Autocreation
 */

// Primary Secondary Navigation
function auto_nav_creation_primary() {
  $name = 'Primary Navigation';
  $menu_exists = wp_get_nav_menu_object($name);

  // If it doesn't exist, let's create it.
  if (!$menu_exists) {
    $menu_id = wp_create_nav_menu($name);
    $menu = get_term_by('name', $name, 'nav_menu');

    // Set menu location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary_navigation'] = $menu->term_id;
    set_theme_mod('nav_menu_locations', $locations);
  }
}
add_action('load-nav-menus.php', 'auto_nav_creation_primary');

// Secondary Navigation
function auto_nav_creation_secondary() {
  $name = 'Secondary Navigation';
  $menu_exists = wp_get_nav_menu_object($name);

  // If it doesn't exist, let's create it.
  if (!$menu_exists) {
    $menu_id = wp_create_nav_menu($name);
    $menu = get_term_by('name', $name, 'nav_menu');

    // Set menu location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['secondary_navigation'] = $menu->term_id;
    set_theme_mod('nav_menu_locations', $locations);
  }

  update_option( 'menu_check', true );
}
add_action('load-nav-menus.php', 'auto_nav_creation_secondary');

// Footer Primary Navigation
function auto_nav_creation_social() {
  $name = 'Social Media Navigation';
  $menu_exists = wp_get_nav_menu_object($name);

  // If it doesn't exist, let's create it.
  if (!$menu_exists) {
    $menu_id = wp_create_nav_menu($name);
    $menu = get_term_by('name', $name, 'nav_menu');

    // Set menu location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['footer_primary_navigation'] = $menu->term_id;
    set_theme_mod('nav_menu_locations', $locations);
  }

  update_option( 'menu_check', true );
}
add_action('load-nav-menus.php', 'auto_nav_creation_social');

// Footer Secondary Navigation
function auto_nav_creation_footer() {
  $name = 'Footer Secondary Navigation';
  $menu_exists = wp_get_nav_menu_object($name);

  // If it doesn't exist, let's create it.
  if (!$menu_exists) {
    $menu_id = wp_create_nav_menu($name);
    $menu = get_term_by('name', $name, 'nav_menu');

    // Set up default menu items
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Trademark and Logo Usage'),
      'menu-item-classes' => '',
      'menu-item-url' => 'https://www.adventist.org/en/copyright/trademark-and-logo-usage/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Legal Notice'),
      'menu-item-url' => 'https://www.adventist.org/en/copyright/legal-notice/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Privacy Policy'),
      'menu-item-url' => 'http://privacy.adventist.org/en/',
      'menu-item-status' => 'publish'
    ));

    // Set menu location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['footer_secondary_navigation'] = $menu->term_id;
    set_theme_mod('nav_menu_locations', $locations);
  }

  update_option( 'menu_check', true );
}
add_action('load-nav-menus.php', 'auto_nav_creation_footer');

// Drawer Navigation
function auto_nav_creation_learn_more() {
  $name = 'Learn More';
  $menu_exists = wp_get_nav_menu_object($name);

  // If it doesn't exist, let's create it.
  if (!$menu_exists) {
    $menu_id = wp_create_nav_menu($name);
    $menu = get_term_by('name', $name, 'nav_menu');

    // Set up default menu items
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Adventist.org'),
      'menu-item-classes' => '',
      'menu-item-url' => 'https://www.adventist.org/en/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('ADRA'),
      'menu-item-url' => 'https://adra.org/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Adventist World Radio'),
      'menu-item-url' => 'https://www.awr.org/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Hope Channel'),
      'menu-item-url' => 'https://www.hopetv.org/',
      'menu-item-status' => 'publish'
    ));

    // Set menu location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['learn_more_navigation'] = $menu->term_id;
    set_theme_mod('nav_menu_locations', $locations);
  }

  update_option( 'menu_check', true );
}
add_action('load-nav-menus.php', 'auto_nav_creation_learn_more');

/**
 * On theme switch settings
 */
function alps_setup_options () {
  $run_menu_maker_once = get_option('menu_check');
  if ( !$run_menu_maker_once ) {
    auto_nav_creation_learn_more();
    auto_nav_creation_primary();
    auto_nav_creation_secondary();
    auto_nav_creation_footer();
    auto_nav_creation_social();
  }
  add_action('admin_notices', 'my_update_notice');
}
add_action('after_switch_theme', 'alps_setup_options');


/**
 * Save settings notice
 */
function my_update_notice() {
  ?>
    <div class="notice-warning notice is-dismissible">
      <p><?php _e( 'On theme activation, go to Appearance > Settings and save the settings to display the footer default information.', 'alps' ); ?></p>
    </div>
  <?php
}


/**
 * ALPS Gutenberg Blocks
 */

// Remove colors and text styles from Gutenberg
add_theme_support('disable-custom-colors');
add_theme_support('editor-color-palette');
add_theme_support('editor-text-styles');
add_theme_support('wp-block-styles');

// Only allow the following blocks in Gutenberg
add_filter('allowed_block_types', function () {
  return [
    'core/heading',
    'core/image',
    'core/block',
    'core/embed',
    'core/spacer',
    'core/button',
    'core/list',
    'core/shortcode',
    'core/video',
    'core/html',
    'core/embed',
    'core/paragraph',
    'alps-gutenberg-blocks/accordion',
    'alps-gutenberg-blocks/blockquote',
    'alps-gutenberg-blocks/content-block',
    'alps-gutenberg-blocks/content-show-more',
    'alps-gutenberg-blocks/content-expand',
    'alps-gutenberg-blocks/gallery',
    'alps-gutenberg-blocks/highlighted-paragraph',
    'alps-gutenberg-blocks/image-2up',
    'alps-gutenberg-blocks/image-breakout',
    'alps-gutenberg-blocks/latest-posts',
    'alps-gutenberg-blocks/cta',
    'sbb/guidepost',
  ];
});

/**
 *Provides automatic updates for the WordPress theme and plugins from Kernl (https://kernl.us/)
 */
require 'theme_update_check.php';
$MyUpdateChecker = new ThemeUpdateChecker(
  'alps-wordpress',
  'https://kernl.us/api/v1/theme-updates/5be537a15ecd012001496112/'
);

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
