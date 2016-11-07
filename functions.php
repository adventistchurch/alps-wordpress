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
