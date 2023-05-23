<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Add <body> classes
 */
 add_filter('body_class', function (array $classes) {

   $classes[] = 'body';

   // Add class if dark theme is true
   $dark_theme = get_alps_option( 'dark_theme' );
   if ( !empty( $dark_theme ) ) {
     $classes[] = 'u-theme--dark';
   }

   // Add class if grid lines is true
   $grid_lines = get_alps_option( 'grid_lines' );
   if ( !empty( $grid_lines ) ) {
     $classes[] = 'has-grid';
   }

   // Add class if square buttons is true
   $square_buttons = get_alps_option( 'square_buttons' );
   if ( !empty( $square_buttons ) ) {
     $classes[] = 'u-buttons--square';
   }

   // Add class if sidebar is true on pages and posts
   $post_id = get_queried_object_id();
   // If has page sidebar
   if (is_active_sidebar('sidebar-page') && (carbon_get_post_meta($post_id, 'hide_sidebar') != 1)) {
     $classes[] = 'has-sidebar has-sidebar--pages';
   }
   // If has post sidebar
   if (is_active_sidebar('sidebar-posts') && (carbon_get_post_meta($post_id, 'hide_sidebar') != 1) && (carbon_get_theme_option('index_hide_sidebar') != 1)) {
     $classes[] = 'has-sidebar has-sidebar--posts';
   }

   // Add class if sabbath column is hidden
   $hide_sabbath = get_alps_option( 'sabbath_hide' );
   if ($hide_sabbath == true ) {
     $hide_sabbath_screens = get_alps_option( 'sabbath_hide_screens' );
     if ($hide_sabbath_screens == 'hide-sabbath--until-small') {
       $classes[] = 'hide-sabbath--until-small';
     } else if ($hide_sabbath_screens == 'hide-sabbath--until-medium') {
       $classes[] = 'hide-sabbath--until-medium';
     } else if ($hide_sabbath_screens == 'hide-sabbath--until-large') {
       $classes[] = 'hide-sabbath--until-large';
     } else {
       $classes[] = 'hide-sabbath';
     }
   }

     /** Add page slug if it doesn't exist */
     if (is_single() || is_page() && !is_front_page()) {
         if (!in_array(basename(get_permalink()), $classes)) {
             $classes[] = basename(get_permalink());
         }
     }

     /** Add class if sidebar is active */
     if (display_sidebar()) {
         $classes[] = 'sidebar-page';
     }

     /** Clean up class names for custom templates */
     $classes = array_map(function ($class) {
         return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
     }, $classes);

     return array_filter($classes);
 });



