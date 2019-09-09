<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_author_fields' );

function crb_attach_author_fields() {
  Container::make( 'post_meta', 'ALPS: Hide Author' )
    ->where( 'post_type', '=', 'post' )
    ->set_context( 'side' )
    //->set_prioriy( 'high' )
    ->add_fields( array(
       Field::make( 'checkbox', 'hide_author_post', __( 'Hide The Author' ) )
        ->set_help_text( __( 'Check if you would like to hide the post author.' ) )
        ->set_option_value( 'true' )
    ) );
}