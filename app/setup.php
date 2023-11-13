<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'alps'),
        'secondary_navigation' => __('Secondary Navigation', 'alps'),
        'learn_more_navigation' => __('Learn More', 'alps'),
        'footer_primary_navigation' => __('Footer Primary Navigation', 'alps'),
        'footer_secondary_navigation' => __('Footer Secondary Navigation', 'alps')
    ]);

    /**
     * Disable the default block patterns.
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');
    load_theme_textdomain('alps', get_theme_file_path('/resources/lang'));

    /**
    * Use main stylesheet for visual editor
    * @see assets/styles/layouts/_tinymce.scss
    */
    add_editor_style(asset_path('/styles/main.scss'));

}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */

add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="c-widget c-%1$s c-%2$s o-link-wrapper--underline u-spacing u-background-color--gray--light u-padding u-theme--border-color--darker u-border--left can-be--dark-dark">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="c-block__heading-title u-theme--color--darker">',
        'after_title'   => '</div>'
    ];
    register_sidebar([
        'name'          => __('Page Top', 'alps'),
        'id'            => 'section-page-top'
    ] + $config);
    register_sidebar([
        'name'          => __('Page Bottom', 'alps'),
        'id'            => 'section-page-bottom'
    ] + $config);
    register_sidebar([
        'name'          => __('Page Sidebar', 'alps'),
        'id'            => 'sidebar-page'
    ] + $config);
    register_sidebar([
        'name'          => __('Posts Sidebar', 'alps'),
        'id'            => 'sidebar-posts'
    ] + $config);
    register_sidebar([
        'name'          => __('Post Footer Region', 'alps'),
        'id'            => 'footer-region-post'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer Region', 'alps'),
        'id'            => 'footer-region'
    ] + $config);
    register_sidebar([
        'name'          => __('Category Top', 'alps'),
        'id'            => 'category-top'
    ] + $config);
    register_sidebar([
        'name'          => __('Category Bottom', 'alps'),
        'id'            => 'category-bottom'
    ] + $config);
});

/**
 * Custom image styles.
 */
// Featured crop.
add_image_size('featured__hero--s', 500, 400, array('center', 'center'));
add_image_size('featured__hero--m', 800, 500, array('center', 'center'));
add_image_size('featured__hero--l', 1100, 500, array('center', 'center'));
add_image_size('featured__hero--xl', 1600, 600, array('center', 'center'));

// 16:9 crop.
add_image_size('horiz__16x9--s', 500, 280, array('center', 'center'));
add_image_size('horiz__16x9--m', 800, 450, array('center', 'center'));
add_image_size('horiz__16x9--l', 1100, 620, array('center', 'center'));

// 4:3 crop.
add_image_size('horiz__4x3--s', 500, 375, array('center', 'center'));
add_image_size('horiz__4x3--m', 700, 600, array('center', 'center'));
add_image_size('horiz__4x3--l', 900, 700, array('center', 'center'));

// 3:4 crop for portraits.
add_image_size('vert__3x4--s', 450, 600, array('center', 'center'));
add_image_size('vert__3x4--m', 600, 800, array('center', 'center'));

// Flexible height
add_image_size('flex-height--s', 350, 9999);
add_image_size('flex-height--m', 700, 9999);
add_image_size('flex-height--l', 900, 9999);
add_image_size('flex-height--xl', 1100, 9999);

// Square
add_image_size('thumbnail--s', 400, 400, array('center', 'center'));
add_image_size('thumbnail--m', 800, 800, array('center', 'center'));

// Makes image size available in dashboard for Gutenberg blocks.
add_action('admin_init', function() {
  $custom_sizes['horiz__16x9--m'] = 'Medium 16:9 (800x450)';
  add_filter(
    'image_size_names_choose',
    function( $sizes ) use ( $custom_sizes ) {
      return array_merge( $sizes, $custom_sizes );
    }
  );
});
