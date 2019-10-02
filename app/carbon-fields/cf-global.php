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

}


