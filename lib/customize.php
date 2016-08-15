<?php

	function adventist_customize_register( $wp_customize ) {





		// SECTION OPTIONS

		$wp_customize->add_section( 'adventist_options' , array(

		    'title'      => __( 'Options', 'adventist' ),

		    'priority'   => 29,

		) );





			// LOGO FOOTER

			$wp_customize->add_setting( 'logo_footer' , array(

			    'default'     => '',

			    'transport'   => 'refresh',

			) );



			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "logo_footer", array(

					'label'    => 'Logo Footer',

					'section'  => 'adventist_options',

					'settings' => 'logo_footer'

				) ) );



	}



	add_action( 'customize_register', 'adventist_customize_register' );

	

?>

