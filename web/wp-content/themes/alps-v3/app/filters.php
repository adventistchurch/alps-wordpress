<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    $classes[] = 'body';

    // Add class if dark theme is true
    $dark_theme = get_option('alps_theme_settings')['dark_theme'];
    if ($dark_theme) {
      $classes[] = 'u-theme--dark';
    }

    // Add class if grid lines is true
    $grid_lines = get_option('alps_theme_settings')['grid_lines'];
    if ($grid_lines) {
      $classes[] = 'has-grid';
    }

    // Add class if sabbath column is hidden
    $hide_sabbath = get_option('alps_theme_settings')['sabbath_hide'];
    if ($hide_sabbath) {
      $classes[] = 'hide-sabbath';
    }

    $hide_sabbath_small = get_option('alps_theme_settings')['sabbath_hide_small'];
    if ($hide_sabbath_small) {
      $classes[] = 'hide-sabbath--small';
    }

    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
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
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", function ($templates) {
        return collect($templates)->flatMap(function ($template) {
            $transforms = [
                '%^/?(resources[\\/]views)?[\\/]?%' => '',
                '%(\.blade)?(\.php)?$%' => ''
            ];
            $normalizedTemplate = preg_replace(array_keys($transforms), array_values($transforms), $template);
            return ["{$normalizedTemplate}.blade.php", "{$normalizedTemplate}.php"];
        })->toArray();
    });
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    echo template($template, $data);
    // Return a blank file to make WordPress happy
    return get_theme_file_path('index.php');
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', 'App\\template_path');
