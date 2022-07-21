<?php
// Custom Header logo file is located /patterns/00-atoms/logos/alps-logo-custom.blade.php

update_option( '_sabbath_hide', 'true' );
update_option( '_footer_logo_type', 'square' );

$menu = get_term_by('name', 'Learn More', 'nav_menu');
wp_update_nav_menu_item($menu->term_id, 0, array(
  'menu-item-title' =>  __('Google', 'alps'),
  'menu-item-classes' => '',
  'menu-item-url' => 'https://www.google.com/',
  'menu-item-status' => 'publish'
));

$menu = get_term_by('name', 'Footer Secondary Navigation', 'nav_menu');
wp_update_nav_menu_item($menu->term_id, 0, array(
  'menu-item-title' =>  __('Google', 'alps'),
  'menu-item-classes' => '',
  'menu-item-url' => 'https://www.google.com/',
  'menu-item-status' => 'publish'
));
