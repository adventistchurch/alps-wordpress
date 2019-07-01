<?php

require_once( 'cf-theme-options.php' );
require_once( 'cf-global.php' );
require_once( 'cf-front-page.php' );
require_once( 'cf-page.php' );
require_once( 'cf-post.php' );

// LOAD CF FROM COMPOSER ADDED VENDOR DIR
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
		require_once __DIR__ . '/../vendor/autoload.php';
    \Carbon_Fields\Carbon_Fields::boot();
		// IN SAGE THEMES ///////////////
		// WIDGETS HAVE TO BE LOADED HERE
		require_once( 'cf-widget.php' );

}

// REMOVE MEDIA BUTTON FROM CF RICH TEXT EDITOR
add_filter( 'crb_media_buttons_html', function( $html, $field_name ) {
    $fields = array( 'content_block_freeform_body', 'sb_body', 'content_body_1' );
	if (in_array( $field_name, $fields ) ) {
		return;
	}
	return $html;
}, 10, 2);