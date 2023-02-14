<?php
/*
 * Global default settings for this installation
 */

// Logo (To use a different logo, place the SVG contents of the custom logo into a file at /views/patterns/00-atoms/logos/alps-logo-custom.blade.php)

// Theme Color (nad-denim/nad-nile/nad-amethyst/nad-spark/nad-miracle/nad-branch/nad-vine/treefrog/ming/bluejay/iris/lily/scarlett/campfire/winter/forest/cave/denim/emperor/grapevine/velvet/earth/night)
update_option( '_theme_color', 'nad-denim' );

// Dark Theme (true/false)
update_option( '_dark_theme', 'false' );

// Grid Lines (true/false)
update_option( '_grid_lines', '' );

// Square Buttons (true/false)
update_option( '_square_buttons', '' );

// Site Branding Statement (Text)
update_option( '_site_branding_statement', '[Site Name] is a website of the Seventh-day Adventist church in North America.' );

// Global Branding Statement (Text)
update_option( '_global_branding_statement', 'The Seventh-day Adventist Church in North America exists to share the distinctive, Christ-centered, Seventh-day Adventist message of hope and wholeness in North America and the world' );

// ALPS Core files version (alps-remote/alps-local)
update_option( '_project_alps_version', 'alps-remote' );


/*
 * Post Options
 */

// Home Page Title (Text)
update_option( '_posts_page_title', '' );

// Hide The Sidebar (true/false)
update_option( '_index_hide_sidebar', '' );

// Archives Page Title (Text)
update_option( '_archive_page_title', '' );

// Hide The Related Stories Image (true/false)
update_option( '_is_related_stories_image_hidden', '' );

// Hide The Sidebar (true/false)
update_option( '_archive_hide_sidebar', '' );

// Category Posts Feed Label (true/false)
update_option( '_posts_label', '' );

// Posts Feed Grid (true/false)
update_option( '_posts_grid', '' );

// Posts Feed Grid (3up) (true/false)
update_option( '_posts_grid_3up', '' );

// Posts Feed Image (true/false)
update_option( '_posts_image', '' );

// Posts Round Images (true/false)
update_option( '_posts_image_round', '' );

/*
 * Sabbath Column
 */

// Hide Sabbath Icon Until Scroll (true/false)
update_option( '_sabbath_scroll', 'true' );

// Hide the sabbath column (true/false)
update_option( '_sabbath_hide', 'false' );

/*
 * Footer Content
 */

// Footer Description (Text)
update_option( '_footer_description', '[Site URL/Name] is a website of the North American Division of the Seventh-Day Adventist Church.' );

// Footer Copyright (Text)
update_option( '_footer_copyright', 'North American Division of Seventh-day Adventists' );

// Fallback Footer Logo Icon (square/circle)
update_option( '_footer_logo_type', 'circle' );

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
      'menu-item-title' =>  __('Legal Notice', 'alps'),
      'menu-item-url' => 'https://www.nadadventist.org/acc_notice',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Privacy Policy', 'alps'),
      'menu-item-url' => 'https://www.nadadventist.org/privacy',
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

// Footer Secondary Navigation
function auto_nav_creation_social_footer() {
  $name = 'Footer Social Media Navigation';
  $menu_exists = wp_get_nav_menu_object($name);

  // If it doesn't exist, let's create it.
  if (!$menu_exists) {
    $menu_id = wp_create_nav_menu($name);
    $menu = get_term_by('name', $name, 'nav_menu');

    // Set up default menu items
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Facebook', 'alps'),
      'menu-item-classes' => '',
      'menu-item-url' => 'https://www.facebook.com/NADAdventist',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Twitter', 'alps'),
      'menu-item-url' => 'https://twitter.com/NADAdventist',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Vimeo', 'alps'),
      'menu-item-url' => 'https://vimeo.com/nadadventist',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('YouTube', 'alps'),
      'menu-item-url' => 'https://www.youtube.com/user/nadadventist',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Flickr', 'alps'),
      'menu-item-url' => 'https://www.flickr.com/photos/nadadventist/',
      'menu-item-status' => 'publish'
    ));

    // Set menu location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['footer_primary_navigation'] = $menu->term_id;
    set_theme_mod('nav_menu_locations', $locations);
  }

  update_option( 'menu_check', true );
}
add_action('load-nav-menus.php', 'auto_nav_creation_social_footer');

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
      'menu-item-title' =>  __('North American Division of Seventh-day Adventists', 'alps'),
      'menu-item-url' => 'https://www.nadadventist.org/',
      'menu-item-status' => 'publish'
    ));
    wp_update_nav_menu_item($menu->term_id, 0, array(
      'menu-item-title' =>  __('Adventist Giving', 'alps'),
      'menu-item-url' => 'https://adventistgiving.org/',
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
