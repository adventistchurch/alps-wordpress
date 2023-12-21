<?php
require_once('cf-theme-options.php');
require_once('cf-global.php');
require_once('cf-front-page.php');
require_once('cf-post-options.php');

// LOAD CF FROM COMPOSER ADDED VENDOR DIR
add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    require_once __DIR__ . '/../../vendor/autoload.php';
    \Carbon_Fields\Carbon_Fields::boot();
    // IN SAGE THEMES ///////////////
    // WIDGETS HAVE TO BE LOADED HERE
    require_once('cf-widget.php');
}

// REMOVE MEDIA BUTTON FROM CF RICH TEXT EDITOR
add_filter('crb_media_buttons_html', function ($html, $field_name) {
    $fields = ['content_block_freeform_body', 'sb_body', 'content_body_1', 'footer_description'];
    if (in_array($field_name, $fields)) {
        return;
    }

    return $html;
}, 10, 2);

// ADD CF ADMIN STYLESHEET
function cf_admin_style()
{
    wp_enqueue_style('cf-admin-styles', get_template_directory_uri() . '/app/carbon-fields/cf-admin.css');
}

add_action('admin_enqueue_scripts', 'cf_admin_style');

// ADD CF JAVASCRIPT
function cf_admin_js($hook)
{
    wp_enqueue_script('cf-admin-js', get_template_directory_uri() . '/app/carbon-fields/cf-admin.js', array('lodash' ));
}

add_action('admin_enqueue_scripts', 'cf_admin_js');

// HELPER FUNCTION
function is_multidimensional(array $array)
{
    return count($array) !== count($array, COUNT_RECURSIVE);
}
