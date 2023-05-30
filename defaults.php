<?php
/*
 * Global default settings for this installation
 */

// Logo (logo file is located /resources/views/patterns/00-atoms/logos/alps-logo-custom.blade.php)

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
      'menu-item-title' =>  __('Trademark and Logo Usage', 'alps'),
      'menu-item-classes' => '',
      'menu-item-url' => 'https://www.adventist.org/en/copyright/trademark-and-logo-usage/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Legal Notice', 'alps'),
      'menu-item-url' => 'https://www.adventist.org/en/copyright/legal-notice/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Privacy Policy', 'alps'),
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
      'menu-item-title' =>  __('Adventist.org', 'alps'),
      'menu-item-classes' => '',
      'menu-item-url' => 'https://www.adventist.org/en/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('ADRA', 'alps'),
      'menu-item-url' => 'https://adra.org/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Adventist World Radio', 'alps'),
      'menu-item-url' => 'https://www.awr.org/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Hope Channel', 'alps'),
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

/*
 * Translate Content
 */

// Translate Description (Text)
update_option( '_translate_description', '[Site URL/Name] is the official website of the Seventh-day Adventist World Church.' );

