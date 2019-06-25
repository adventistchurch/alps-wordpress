<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {

    Container::make( 'theme_options', __( 'Theme Options' ) )
      ->set_page_file( 'theme-options' )
      ->add_tab( __( 'LOGOS' ), array( 
        Field::make( 'separator', 'crb_logos', __( 'Logos' ) ),
        Field::make( 'checkbox', 'logo_desktop_wide', __( 'Logo Wide / Desktop' ) )
          ->set_option_value( 'true' )
          ->set_help_text( 'Select if the default logo orientation is wide, or desktop, rather than square.' ),
        Field::make( 'image', 'logo_desktop', __( 'Logo - Desktop' ) )
            ->set_width( 33 ),
        Field::make( 'image', 'logo_mobile', __( 'Logo - Mobile' ) )
            ->set_width( 33 ),
        Field::make( 'image', 'logo_text', __( 'Logo - Subtext' ) )
            ->set_width( 33 ),      
      ) )
      ->add_tab( __( 'COLORS' ), array( 
        Field::make( 'select', 'primary_theme_color', __( 'Primary Theme Color' ) )
            ->add_options( array(
                'emperor' => __( 'Emporer' ),
                'earth' => __( 'Earth' ),
                'grapevine' => __( 'Grapevine' ),
                'denim' => __( 'Denim' ),
                'campfire' => __( 'Campfire' ),
                'treefrog' => __( 'Tree Frog' ),
                'ming' => __( 'Ming' ),
            ) )
            ->set_width( 33 ),
          Field::make( 'select', 'secondary_theme_color', __( 'Secondary Theme Color' ) )
            ->add_options( array(
                'cool' => __( 'Cool' ),
                'warm' => __( 'Warm' ),
            ) )
            ->set_width( 33 ),
          Field::make( 'checkbox', 'dark_theme', __( 'Dark Theme' ) )
            ->set_option_value( 'true' )
            ->set_help_text( 'Select if you would like the theme to be dark.' )
            ->set_width( 33 ),
      ) )
        ->add_tab( __( 'FOOTER CONTENT' ), array( 
          Field::make( 'rich_text', 'footer_description', __( 'Footer Description' ) ),
          Field::make( 'text', 'footer_copyright', __( 'Footer Copyright' ) ),
          Field::make( 'complex', 'footer_address', __( 'Footer Address' ) )
              ->add_fields( array(
                Field::make( 'text', 'footer_address_street', __( 'Street Address' ) ),
                Field::make( 'text', 'footer_address_city', __( 'City' ) )
                  ->set_width( 33 ),
                Field::make( 'text', 'footer_address_state', __( 'State' ) )
                  ->set_width( 33 ),
                Field::make( 'text', 'footer_address_zip', __( 'Postal Code' ) )
                  ->set_width( 33 ),
                Field::make( 'text', 'footer_address_country', __( 'Country' ) )
                  ->set_width( 50 ),
                Field::make( 'text', 'footer_phone', __( 'Phone Number' ) )
                  ->set_width( 50 ),
              ) )
            ->set_min( 1 )
            ->set_max( 1 ) 
        ) )
        ->add_tab( __( 'HIDE AUTHORS' ), array( 
          Field::make( 'checkbox', 'hide_author_global', __( 'Hide Author Globally' ) )
              ->set_option_value( 'true' )
              ->set_help_text( 'Select if you would like to hide the post author site wide.' ),
        ) )
         ->add_tab( __( 'DEFAULT NEWS CATEGORY' ), array( 
            Field::make( 'association', 'category' )
              ->set_types( array(
                array(
                    'type' => 'term',
                    'taxonomy' => 'category',
                ),
              ) )
              ->set_min( 1 )
              ->set_max( 1 )
         ) );
}
