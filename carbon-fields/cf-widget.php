<?php

use Carbon_Fields\Widget;
use Carbon_Fields\Field;



class ALPS_Social_Widget extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'alps_widget_social', 'ALPS - Social Links', 'Set your social links.', array(
            Field::make( 'text', 'facebook_url', 'Facebook URL' ) ,
            Field::make( 'text', 'twitter_url', 'Twiiter URL' ) ,
            Field::make( 'text', 'flickr_url', 'Flickr URL' ) ,
            Field::make( 'text', 'youtube_url', 'YouTube URL' ) ,
            Field::make( 'text', 'vimeo_url', 'Vimeo URL' ) ,
            Field::make( 'text', 'email_address', 'Email Address' ) ,
            Field::make( 'checkbox', 'horizontal_rule', __( 'Add a horizontal rule above the block' ) )
        ) );
    }

    // Called when rendering the widget in the front-end
    function front_end( $args, $instance ) {
        echo $args['before_title'] . $instance['title'] . $args['after_title'];
        echo '<p>' . $instance['content'] . '</p>';
    }
}

class ALPS_Text_With_Link_Widget extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'alps_widget_text_with_link', 'ALPS - Text with Link', 'Text block with formatted link.', array(
            Field::make( 'text', 'title', 'Title' ) ,
            Field::make( 'textarea', 'content', __( 'Content' ) ) ,
            Field::make( 'text', 'url', 'URL' ) 
                ->set_width( 50 ),
            Field::make( 'text', 'url_text', 'URL Text' )
                ->set_width( 50 )
        ) );
    }

    // Called when rendering the widget in the front-end
    function front_end( $args, $instance ) {
        echo $args['before_title'] . $instance['title'] . $args['after_title'];
        echo '<p>' . $instance['content'] . '</p>';
    }
}

class ALPS_Post_Feed_Widget extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'alps_widget_post_feed', 'ALPS - Post Feed', 'Feed of posts in the selected caetgory.', array(
            Field::make( 'select', 'feed_category_list', __( 'Feed Category' ) )
                ->set_options( cat_list() ),
            Field::make( 'text', 'feed_title', 'Feed Title' ) ,
            Field::make( 'text', 'feed_widget_post_count', 'Number of Posts' ) ,
            Field::make( 'checkbox', 'for_sidebar', __( ' Format For Sidebar?' ) ),
            Field::make( 'text', 'feed_widget_btn_text', 'More Button Text' )
                ->set_width( 50 ),
            Field::make( 'text', 'feed_widget_btn_link', 'More Button Link' ) 
                ->set_width( 50 )
        ) );
    }

    // Called when rendering the widget in the front-end
    function front_end( $args, $instance ) {
        echo $args['before_title'] . $instance['title'] . $args['after_title'];
        echo '<p>' . $instance['content'] . '</p>';
    }
}

add_action( 'widgets_init', 'alps_widgets' );
function alps_widgets() {
    register_widget( 'ALPS_Social_Widget' );
    register_widget( 'ALPS_Text_With_Link_Widget' );
    register_widget( 'ALPS_Post_Feed_Widget' );
}

function cat_list() {
    // NEED TO BUILD CUSTOM CATEGORY LIST HERE DUE TO CARBON FIELDS ERROR
    $categories = get_categories( array( 'orderby' => 'name' ) );
    $cats = [];
    foreach ( $categories as $cat ) {
      $cats[ $cat->term_id ] = $cat->name;
    }
    return $cats;
}
