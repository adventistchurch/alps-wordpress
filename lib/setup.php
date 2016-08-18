<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'secondary_navigation' => __('Secondary Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  // Load fonts.
  wp_enqueue_style('alps/fonts', '//fonts.googleapis.com/css?family=Merriweather:400,400i,700|Montserrat|Oswald');

  // Load main ALPS styles.
  wp_enqueue_style('alps/main_css', 'http://cdn.adventist.io/alps/2/latest/css/main.css');

  // Load theme override css.
  wp_enqueue_style('alps/theme_css', Assets\asset_path('styles/alps-theme.css'), false, null);

  // Load ALPS header javascript.
  wp_enqueue_script('alps/head_js', 'http://cdn.adventist.io/alps/2/latest/js/head-script.min.js', false, '2', false);

  if (!is_admin()) {
    wp_deregister_script('jquery');
    // Load a copy of jQuery from the jquery CDN.
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', false, '2.2.4', true);
  }

  // Load ALPS footer javascript.
  wp_enqueue_script('alps/foot_js', 'http://cdn.adventist.io/alps/2/latest/js/script.min.js', ['jquery'], '2', true);

  // Load theme override javascript.
  wp_enqueue_script('alps/theme_js', Assets\asset_path('scripts/alps-theme.js'), ['jquery'], null, true);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  // Remove unnecessary inline comment css.
  global $wp_widget_factory;
  remove_action('wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

  // Remove wp-embed script.
  wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

/**
 * Remove wp generator from head.
 */
remove_action('wp_head', 'wp_generator');

/**
 * Remove emoji scripts.
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
