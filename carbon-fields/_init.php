<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

require_once( 'cf-theme-options.php' );
require_once( 'cf-global.php' );
require_once( 'cf-front-page.php' );
require_once( 'cf-page.php' );
require_once( 'cf-post.php' );

// still working on this
// require_once( 'cf-widget.php' );

// REMOVE MEDIA BUTTON FROM CF RICH TEXT EDITOR
add_filter( 'crb_media_buttons_html', function( $html, $field_name ) {
    $fields = array( 'content_block_freeform_body', 'sb_body', 'content_body_1' );
	if (in_array( $field_name, $fields ) ) {
		return;
	}
	return $html;
}, 10, 2);