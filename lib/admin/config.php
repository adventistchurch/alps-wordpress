<?php
	include ( 'panel_install.php' );
	include ( 'controllers/adventist_panel_controller.php' );
	include ( 'controllers/slides_controller.php' );
	include ( 'controllers/pastors_controller.php' );

	function adventist_panel(){
	    add_menu_page( 'Adventist Panel', __('Theme Options', 'adventist'), 'manage_options', 'adventist', 'adventist_panel_controller', get_template_directory_uri(). '/lib/admin/icon.png'); 
	    add_submenu_page( 'adventist' , __('Theme Links', 'adventist'), __('Theme Links', 'adventist'), 'manage_options', 'adventist_links', 'adventist_links'); 
	    add_submenu_page( 'adventist' , __('Slideshow', 'adventist'), __('Slideshow', 'adventist'), 'manage_options', 'adventist_slides', 'adventist_slides');
	    add_submenu_page( 'adventist' , __('Staff Directory', 'adventist'), __('Staff Directory', 'adventist'), 'manage_options', 'adventist_pastors', 'adventist_pastors');
	}
	add_action( 'admin_menu', 'adventist_panel' );

	add_action("after_switch_theme", "adventist_panel_install");

?>