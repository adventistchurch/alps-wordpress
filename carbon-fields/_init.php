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

function get_alps_field( $field, $id = NULL ) {
	global $post;
	if ( empty( $id ) ) {
		$id = get_queried_object_id();
	}
  $cf = get_option( 'alps_cf_converted' );
	if ( $cf ) {
		return carbon_get_post_meta( $id, $field );
	} else {
		return get_post_meta( $id, $field, true );
	}
}

function get_alps_option( $field ) {
	global $post;
	$cf = get_option( 'alps_cf_converted' );
	if ( $cf ) {
		
		return carbon_get_theme_option( $field );
	} else {
		$options 	= get_option( 'alps_theme_settings' );
		$option 	= $options[ $field ];
		if ( is_array( $option ) ) {
			// RETURN SINGLE KEY/VAL ARRAY AS VAL (IMAGES)
			if ( count( $option ) == 1 ) { 
				return $option[0];
			} else {
				// RETURN COMPLETE ARRAY
				return $option;
			}
		} else {
			return $option;
		}
	}
}

// HELPER FUNCTION
function is_multidimensional(array $array) {
  return count($array) !== count($array, COUNT_RECURSIVE);
}