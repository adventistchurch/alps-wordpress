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
