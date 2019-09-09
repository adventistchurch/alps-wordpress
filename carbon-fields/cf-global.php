<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_template_fields' );

function crb_attach_template_fields() {
  Container::make( 'post_meta', 'ALPS: Template Additions' )
    //->set_context( 'carbon_fields_after_title' )
    //->set_priority( 'high' )
    ->add_fields( array(
      Field::make( 'text', 'display_title', __( 'Display Title' ) )
        ->set_help_text( __( 'Set a page title different from the default title.' ) )
        ->set_width( 50 ),
      Field::make( 'text', 'kicker', __( 'Kicker' ) )
        ->set_help_text( __( 'Enter a kicker that will display above the title.' ) )
        ->set_width( 50 ),
      Field::make( 'textarea', 'subtitle', __( 'Subtitle' ) )
        ->set_help_text( __( 'Appears coupled with Title/Display Title. Cannot Exceed 200 characters.' ) )
        ->set_rows( 3 ),
      Field::make( 'textarea', 'intro', __( 'Intro' ) )
        ->set_help_text( __( 'Intro paragraph to be included above page/post body content and used in referenced blocks.' ) )
        ->set_rows( 3 ),
      Field::make( 'image', 'header_background_image', __( 'Header Background Image' ) )
        ->set_help_text( __( 'Add a background image to the header (not available on all pages).' ) ),
      Field::make( 'checkbox', 'header_block_text', __( 'Header Block Text' ) )
        ->set_option_value( 'true' )
        ->set_help_text( __( 'Check if you would like to include a block of text in the header.' ) ),
      Field::make( 'text', 'header_block_title', __( 'Header Block Title' ) )
        ->set_conditional_logic( array(
            array(
            'field' => 'header_block_text',
            'value' => true
          ) ) )
        ->set_width( 50 ),
      Field::make( 'text', 'header_block_subtitle', __( 'Header Block Subtitle' ) )
        ->set_conditional_logic( array(
            array(
            'field' => 'header_block_text',
            'value' => true
          ) ) )
        ->set_width( 50 ),
      Field::make( 'image', 'header_block_image', __( 'Header Block Image' ) )
        ->set_conditional_logic( array(
            array(
            'field' => 'header_block_text',
            'value' => true
          ) ) )        
    ) );
  
  Container::make( 'post_meta', 'ALPS: Options' )
    ->set_context( 'side' )
    ->set_priority( 'low' )
    ->add_fields( array(
      Field::make( 'separator', 'crb_hide_img', __( 'Hide Featured Image' ) ),
      Field::make( 'checkbox', 'hide_featured_image', __( 'Hide Featured Image' ) )
        ->set_help_text( __( 'Check to hide the featured image on the front end and assign it to this entry.' ) )
        ->set_option_value( 'true' ),
      Field::make( 'separator', 'crb_feature_vid', __( 'Featured Video' ) ),
      Field::make( 'text', 'video_url', __( 'Video URL' ) ),
      Field::make( 'textarea', 'video_caption', __( 'Video Caption' ) )
        ->set_rows( 3 ),
    ) );
   
}


