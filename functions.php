<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**
 * Breadcrumbs
 */
function wordpress_breadcrumbs() {
  $name = 'Home'; //text for the 'Home' link
  $current_before = '<li class="breadcrumbs__list-item font--secondary--xs upper dib"><a class="breadcrumbs__link can-be--white">';
  $current_after = '</a></li>';
  $li_class = 'breadcrumbs__list-item font--secondary--xs upper dib';
  $link_class = 'breadcrumbs__link can-be--white';
  if (!is_home() && !is_front_page() || is_paged()) {
    echo '<nav class="breadcrumbs" role="navigation"><ul class="breadcrumbs__list">';
    global $post;
    $home = get_bloginfo('url');
    echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . $home . '">' . $name . '</a></li>';
    if (is_category()) {
      global $wp_query;
      $cat_obj   = $wp_query->get_queried_object();
      $thisCat   = $cat_obj->term_id;
      $thisCat   = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) {
        echo (get_category_parents($parentCat, TRUE, ''));
        echo $current_before . 'Archive by category &#39;';
        single_cat_title();
        echo '&#39;' . $current_after;
      }
    }
    elseif (is_day()) {
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
      echo $current_before . get_the_time('d') . $current_after;
    }
    elseif (is_month()) {
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo $current_before . get_the_time('F') . $current_after;
    }
    elseif (is_year()) {
      echo $current_before . get_the_time('Y') . $current_after;
    }
    elseif (is_single()) {
      $cat = get_the_category();
      $cat = $cat[0];
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . home_url( '/' ) . $cat->category_nicename . '">' . $cat->name . '</a></li>';
      echo $current_before;
      echo 'Article';
      echo $current_after;
    }
    elseif (is_page() && !$post->post_parent) {
      echo $current_before;
      the_title();
      echo $current_after;
    }
    elseif (is_page() && $post->post_parent) {
      $parent_id = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) {
        echo $crumb . '';
        echo $current_before;
        the_title();
        echo $current_after;
      }
    }
    elseif (is_search()) {
      echo $current_before . 'Search results for &#39;' . get_search_query() . '&#39;' . $current_after;
    }
    elseif (is_tag()) {
      echo $current_before . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $current_after;
    }
    elseif (is_author()) {
      global $author;
      $userdata = get_userdata($author);
      echo $current_before . 'Articles posted by ' . $userdata->display_name . $current_after;
    }
    elseif (is_404()) {
      echo $current_before . 'Error 404' . $current_after;
    }
    if (get_query_var('paged')) {
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
        echo ' (';
        echo __('Page') . ' ' . get_query_var('paged');
      }
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
        echo ')';
      }
    }
    echo '</nav>';
  }
}

/**
 * Require plugins on theme install
 */
require_once get_template_directory() . '/lib/plugin-activation.php';
add_action( 'tgmpa_register', 'adventist_register_required_plugins' );
function adventist_register_required_plugins() {
  $plugins = array(
    array(
      'name'               => 'Advanced Custom Fields', // The plugin name.
      'slug'               => 'advanced-custom-fields', // The plugin slug (typically the folder name).
      'source'             => get_template_directory() . '/lib/plugins/advanced-custom-fields.zip', // The plugin source.
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
      'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),
    array(
      'name'               => 'Advanced Custom Fields Pro',
      'slug'               => 'advanced-custom-fields-pro',
      'source'             => get_template_directory() . '/lib/plugins/advanced-custom-fields-pro.zip',
      'required'           => true,
    ),
  );
  $config = array(
    'id'           => 'adventist',                 // Unique ID for hashing notices for multiple instances of TGMPA.
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
  tgmpa( $plugins, $config );
}

/**
 * Register sidebar navigation
 */
function register_my_menus() {
  register_nav_menus(
    array(
      'tertiary_navigation' => __( 'Tertiary Navigation' ),
      'sidebar_navigation' => __( 'Sidebar Navigation' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

/**
 * Function to add classes to Prev & Next pagination links
 */
function posts_link_attributes() {
  return 'class="pagination__page theme--secondary-background-color white"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

/**
 * Markup for Yoast breadcrumbs
 */
function ss_breadcrumb_single_link( $link_output, $link ) {
    $element = 'li';
    $link_output = '<' . $element . ' class="breadcrumbs__list-item font--secondary--xs upper dib" . typeof="v:Breadcrumb">';
    if ( isset( $link['url'] ) && ( $i < ( count( $links ) - 1 ) || $paged ) ) {
        $link_output .= '<a href="' . esc_url( $link['url'] ) . '" rel="v:url" property="v:title">' . esc_html( $link['text'] ) . '</a>';
    } else {
        if ( isset( $opt['breadcrumbs-boldlast'] ) && $opt['breadcrumbs-boldlast'] ) {
            $link_output .= '<strong class="breadcrumb_last" property="v:title">' . esc_html( $link['text'] ) . '</strong>';
        } else {
            $link_output .= '<li class="breadcrumb_last" property="v:title">' . esc_html( $link['text'] ) . '</li>';
        }
    }
    $link_output .= '</' . $element . '>';
    return $link_output;
}
add_filter( 'wpseo_breadcrumb_single_link', 'ss_breadcrumb_single_link', 10, 2 );

/**
 * ACF
 */
