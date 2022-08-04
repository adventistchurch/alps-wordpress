<?php
// Custom Header logo file is located /patterns/00-atoms/logos/alps-logo-custom.blade.php

update_option( '_sabbath_hide', 'true' );
update_option( '_footer_logo_type', 'square' );

$menu = get_term_by('name', 'Learn More', 'nav_menu');
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

$menu = get_term_by('name', 'Footer Secondary Navigation', 'nav_menu');
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
