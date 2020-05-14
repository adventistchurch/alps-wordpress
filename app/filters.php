<?php

namespace App;

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
      $classes[] = 'hide-sabbath hide-sabbath--until-small';
    } else if ($hide_sabbath_screens == 'hide-sabbath--until-medium') {
      $classes[] = 'hide-sabbath hide-sabbath--until-medium';
    } else if ($hide_sabbath_screens == 'hide-sabbath--until-large') {
      $classes[] = 'hide-sabbath hide-sabbath--until-large';
    } else {
      $classes[] = 'hide-sabbath hide-sabbath--all';
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

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'alps') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );
    return template_path(locate_template(["views/{$comments_template}", $comments_template]) ?: $comments_template);
}, 100);


// REMOVE MEDIA BUTTON FROM CF RICH TEXT EDITOR
add_filter( 'crb_media_buttons_html', function( $html, $field_name ) {
    $fields = array( 'content_block_freeform_body', 'sb_body', 'content_body_1', 'footer_description' );
    if (in_array( $field_name, $fields ) ) {
        return;
    }
    return $html;
}, 10, 2);
