<?php
class BigMenuWidget extends WP_Widget {
	
	function BigMenuWidget() {
		$widget_ops = array('classname' => 'BigMenuWidget', 'description' => __('Adventist - Big Menu', "adventist") );
		$this->WP_Widget('BigMenuWidget', __('Adventist - Big Menu', "adventist"), $widget_ops);
	}
 
	function widget($args, $instance) {
		global $post;
		$page = get_page( $post -> ID );

	    echo $before_widget;

		wp_nav_menu( array( 
			'theme_location' => 'header-menu',
			'items_wrap' => '<ul id="side-nav">%3$s</ul>',
			'container' => ''
		));

	    echo $after_widget;
	}
 
}
?>