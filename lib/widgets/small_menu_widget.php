<?php
class SmallMenuWidget extends WP_Widget {
	
	function SmallMenuWidget() {
		$widget_ops = array('classname' => 'SmallMenuWidget', 'description' => __('Adventist - Small Menu', "adventist") );
		$this->WP_Widget('SmallMenuWidget', __('Adventist - Small Menu', "adventist"), $widget_ops);
	}
 
	function widget($args, $instance) {
		global $post;
		$page = get_page( $post -> ID );

	    echo $before_widget;

	    echo '<ul id="sub-nav">';
		wp_list_pages(array(
			'depth' => -1,
			'child_of' => $page -> post_parent,
			'title_li' => '',
			'post_type' => $post->post_type
		));
		echo "</ul>";

	    echo $after_widget;
	}
 
}
?>