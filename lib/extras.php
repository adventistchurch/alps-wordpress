<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;



/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if theme color is selected
  $primary_theme_color = get_option('alps_theme_settings')['primary_theme_color'];
  if ($primary_theme_color) {
    $classes[] = 'theme--' . $primary_theme_color;
  } else {
    $classes[] = 'theme--ming';
  }

  $secondary_theme_color = get_option('alps_theme_settings')['secondary_theme_color'];
  if ($secondary_theme_color) {
    $classes[] = 'theme--' . $secondary_theme_color;
  } else {
    $classes[] = 'theme--warm';
  }

  // Add class if dark theme is true
  $dark_theme = get_option('alps_theme_settings')['dark_theme'];
  if ($dark_theme) {
    $classes[] = 'dark';
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');
