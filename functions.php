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
    array(
      'name'        => 'WordPress SEO by Yoast',
      'slug'        => 'wordpress-seo',
      'source'             => get_template_directory() . '/lib/plugins/wordpress-seo.zip',
      'required'           => true,
      'is_callable' => 'wpseo_init',
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
 * Hide content area on 'Single' page templates
 */
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;
  $template_file = get_post_meta($post_id, '_wp_page_template', true);
  if($template_file == 'template-single.php'){ // edit the template name
      remove_post_type_support('page', 'editor');
  }
}

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
 * Custom menu output.
 */
function alps_walker_nav_menu_start_el($item_output, $item, $depth, $args) {
  $menu_locations = get_nav_menu_locations();

  // Primary navigation customizations.
  if (has_term($menu_locations['primary_navigation'], 'nav_menu', $item)) {
    $item_output = preg_replace('/<a /', '<a class="primary-nav__link theme--primary-text-color" ', $item_output, 1);
    // Add custom "active" class to active links.
    if ($item->current == 1){
      $item_output = preg_replace('/<a /', '<a class="primary-nav__link theme--secondary-text-color active" ', $item_output, 1);
    }
    // If the link is within a submenu, update classes.
    if ($depth === 1){
      $item_output = preg_replace('/<a /', '<a class="primary-nav__subnav__link theme--primary-text-color" ', $item_output, 1);
    }
  }
  // Secondary navigation customizations.
  if (has_term($menu_locations['secondary_navigation'], 'nav_menu', $item)) {
    $item_output = preg_replace('/<a /', '<a class="secondary-nav__link theme--secondary-text-color" ', $item_output, 1);
    // Add custom "active" class to active links.
    if ($item->current == 1){
      $item_output = preg_replace('/<a /', '<a class="secondary-nav__link theme--secondary-text-color active" ', $item_output, 1);
    }
    // Add "js-toggle-parent" class to first link item (should be language dropdown).
    if ($item->menu_order == 1){
      $item_output = preg_replace('/<a /', '<a class="secondary-nav__link theme--secondary-text-color js-toggle-parent" ', $item_output, 1);
    }
    // If the link is within a submenu, update classes.
    if ($depth === 1){
      $item_output = preg_replace('/<a /', '<a class="secondary-nav__subnav__link theme--secondary-background-hover-color--at-medium" ', $item_output, 1);
    }
  }
  // Footer navigation customizations.
  if (has_term($menu_locations['footer_navigation'], 'nav_menu', $item)) {
    $item_output = preg_replace('/<a /', '<a class="footer__nav-link font--secondary link--white" ', $item_output, 1);
  }
  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'alps_walker_nav_menu_start_el', 10, 4);

/**
 * ACF
 */
