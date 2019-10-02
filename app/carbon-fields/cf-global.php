<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_template_fields' );

function crb_attach_template_fields() {
  Container::make( 'post_meta', 'ALPS: Entry Sidebar / Featured Image' )
    ->add_fields( array(
     Field::make( 'separator', 'crb_hide_sidebar', __( 'Hide Sidebar' ) )
        ->set_width(50),
     Field::make( 'separator', 'crb_hide_img', __( 'Hide Featured Image' ) )
        ->set_width(50),
      Field::make( 'checkbox', 'hide_sidebar', __( 'Hide Sidebar' ) )
        ->set_help_text( __( 'Hides the sidebar for this entry if it is active.' ) )
        ->set_option_value( 'true' )
        ->set_width(50),
      Field::make( 'checkbox', 'hide_featured_image', __( 'Hide Featured Image' ) )
        ->set_help_text( __( 'Hides the featured image on the page/post header for this entry.' ) )
        ->set_option_value( 'true' )
        ->set_width(50),
    ) );

  Container::make( 'post_meta', 'ALPS: Long Header' )
    ->add_fields( array(
      Field::make( 'separator', 'crb_long_header', __( 'Long Header' ) )
         ->set_help_text( __( 'IMPORTANT: Setting the Long Header will override the display of the Header Banner and Featured Image.' ) ),
      Field::make( 'text', 'long_header_title', __( 'Long Header Title' ) ),
      Field::make( 'text', 'long_header_kicker', __( 'Long Header Kicker' ) ),
      Field::make( 'text', 'long_header_subtitle', __( 'Long Header Subtitle' ) ),
      Field::make( 'image', 'long_header_image', __( 'Long Header Image' ) )
    ) );

  Container::make( 'post_meta', 'ALPS: Header Banner' )
    //->set_context( 'carbon_fields_after_title' )
    //->set_priority( 'high' )
    ->add_fields( array(
      Field::make( 'separator', 'crb_display_header', __( 'Header Banner' ) )
        ->set_help_text( __( 'IMPORTANT: Setting the Header Background Image will override the display of the Featured Image.' ) ),
      Field::make( 'text', 'display_title', __( 'Display Title' ) )
        ->set_help_text( __( 'Set a page title different from the default title.' ) )
        ->set_width( 50 ),
      Field::make( 'text', 'kicker', __( 'Kicker' ) )
        ->set_help_text( __( 'Enter a kicker that will display above the title.' ) )
        ->set_width( 50 ),
      Field::make( 'image', 'header_background_image', __( 'Header Background Image' ) )
        ->set_help_text( __( 'Add a background image to the header (not available on all pages).' ) ),
    ) );
}


