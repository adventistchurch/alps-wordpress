<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('5.6.4', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 5.6.4 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Load ajax script
 */
function enqueue_ajax_load_more() {
   wp_enqueue_script('ajax-load-more'); // Already registered, just needs to be enqueued
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_load_more');

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
if (is_customize_preview() && isset($_GET['theme'])) {
    $sage_error(__('Theme must be activated prior to using the customizer.', 'sage'));
}
$sage_views = basename(dirname(__DIR__)).'/'.basename(__DIR__).'/views';
add_filter('stylesheet', function () use ($sage_views) {
    return dirname($sage_views);
});
add_filter('stylesheet_directory_uri', function ($uri) {
    return dirname($uri);
});
if ($sage_views !== get_option('stylesheet')) {
    update_option('stylesheet', $sage_views);
    if (php_sapi_name() === 'cli') {
        return;
    }
    wp_redirect($_SERVER['REQUEST_URI']);
    exit();
}

/**
 * Allow SVG's through WP media uploader
 */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

/**
 * Provides automatic updates for the WordPress theme and plugins (http://wp-updates.com/)
 */
// require_once('wp-updates-theme.php');
// new WPUpdatesThemeUpdater_1948( 'http://wp-updates.com/api/2/theme', basename(get_template_directory()) );

/**
 * Require plugins on theme install
 */
// require_once get_template_directory() . '/lib/plugin-activation.php';
// add_action( 'tgmpa_register', 'adventist_register_required_plugins' );
// function adventist_register_required_plugins() {
//   $plugins = array(
//     array(
//       'name'               => 'Piklist', // The plugin name.
//       'slug'               => 'piklist', // The plugin slug (typically the folder name).
//       'source'             => get_template_directory() . '/lib/plugins/piklist.zip', // The plugin source.
//       'required'           => true, // If false, the plugin is only 'recommended' instead of required.
//       'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
//       'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
//     ),
//     // WordPress SEO
// 		array(
// 			'name'     => 'WordPress SEO by Yoast',
// 			'slug'     => 'wordpress-seo',
// 			'required' => false,
// 		)
//   );
//   $config = array(
//     'id'           => 'adventist',                 // Unique ID for hashing notices for multiple instances of TGMPA.
//     'default_path' => '',                      // Default absolute path to bundled plugins.
//     'menu'         => 'tgmpa-install-plugins', // Menu slug.
//     'parent_slug'  => 'themes.php',            // Parent menu slug.
//     'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
//     'has_notices'  => true,                    // Show admin notices or not.
//     'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
//     'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
//     'is_automatic' => false,                   // Automatically activate plugins after installation or not.
//     'message'      => '',                      // Message to output right before the plugins table.
//   );
//   tgmpa( $plugins, $config );
// }

/**
 * Fix for Piklist fields not saving
 */
function my_custom_init() {
  remove_post_type_support( 'post', 'custom-fields' );
  remove_post_type_support( 'page', 'custom-fields' );
}
add_action( 'init', 'my_custom_init' );

/**
 * Piklist Theme Settings
 */
add_filter('piklist_admin_pages', 'piklist_theme_setting_pages');
function piklist_theme_setting_pages($pages) {
   $pages[] = array(
    'page_title' => __('ALPS Custom Settings')
    ,'menu_title' => __('Settings', 'piklist')
    ,'sub_menu' => 'themes.php' //Under Appearance menu
    ,'capability' => 'manage_options'
    ,'menu_slug' => 'custom_settings'
    ,'setting' => 'alps_theme_settings'
    ,'menu_icon' => plugins_url('piklist/parts/img/piklist-icon.png')
    ,'page_icon' => plugins_url('piklist/parts/img/piklist-page-icon-32.png')
    ,'single_line' => true
    ,'default_tab' => 'Basic'
    ,'save_text' => 'Save ALPS Theme Settings'
  );
  return $pages;
}

/**
 * Add a custom parameter to the Piklist comment block.
 */
add_filter('piklist_part_data', 'my_custom_comment_block', 10, 2);
function my_custom_comment_block($data, $folder) {

  // If not a Meta-box section than bail
  if ($folder!= 'meta-boxes') {
    return $data;
  }

  // Allow Piklist to read our custom comment block attribute: "Hide for Template", and set it to hide_for_template
  $data['hide_for_template'] = 'Hide for Template';
  return $data;
}

/**
 * Assign meta-box access to user role, “no-role”, if the page template is selected
 */
add_filter('piklist_part_process_callback', 'my_hide_for_template', 10, 2);
function my_hide_for_template($part, $type) {
  global $post;

  // If not a meta box than bail
  if ($type != 'meta-boxes') {
    return $part;
  }

  // Check if any page template is set in the comment block
  if (!empty($part['data']['hide_for_template'])) {

    // Get the active page template
    $active_template = pathinfo(get_page_template_slug($post->ID), PATHINFO_FILENAME);
    $active_template = empty($active_template) ? 'default' : $active_template;

    // Does the active page template match what we want to hide?
    if (strpos($part['data']['hide_for_template'], $active_template) !== false) {

      // Change meta-box access to user role: no-role
      $part['data']['role'] = 'no-role';
    }
  }
  return $part;
}

// Remove colors and text styles from Gutenberg
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'editor-color-palette');
add_theme_support( 'editor-text-styles');
add_theme_support( 'wp-block-styles' );

// Only allow the following blocks in Gutenberg
add_filter( 'allowed_block_types', function() {
	return [
    'core/heading',
    'core/image',
    'core/video',
    'core/vimeo',
    'core/block',
    'core/spacer',
    'gutenberg-blocks/paragraph',
    'gutenberg-blocks/latest-posts',
    'gutenberg-blocks/content-block',
    'gutenberg-blocks/content-show-more',
    'gutenberg-blocks/content-expand',
    'gutenberg-blocks/highlighted-paragraph',
    'gutenberg-blocks/blockquote',
    'gutenberg-blocks/image-2up',
    'gutenberg-blocks/image-breakout',
    'gutenberg-blocks/gallery',
    'gutenberg-blocks/accordion',
  ];
} );
