<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    // wp_enqueue_style( $handle, $src, $deps, $ver, $media );
    wp_enqueue_style('alps/main.css', asset_path('styles/main.css'), false, filemtime(get_stylesheet_directory() .'/dist/styles/main.css') );
    // wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
    wp_enqueue_script('alps/main.js', asset_path('scripts/main.js'), ['jquery'], filemtime(get_stylesheet_directory() .'/dist/scripts/main.js'), true);
    /*
    if (!is_admin()) {
      wp_deregister_script('jquery');
      // Load a copy of jQuery from the jquery CDN.
      wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', false, '3.4.1', true);
    }
    */
}, 100);

/**
 * Theme setup
 */

add_action('after_setup_theme', function () {
  /**
   * Make theme available for translation.
     * Translations can be filed in the /lang/ directory.
   */
    load_theme_textdomain('alps', get_template_directory() . '/lang');

    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
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
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
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
        'name'          => __('Posts Template Sidebar', 'alps'),
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
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
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

// Flexible height
add_image_size('flex-height--s', 350, 9999);
add_image_size('flex-height--m', 700, 9999);
add_image_size('flex-height--l', 900, 9999);
add_image_size('flex-height--xl', 1100, 9999);

// Square
add_image_size('thumbnail--s', 200, 200, array('center', 'center'));

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
