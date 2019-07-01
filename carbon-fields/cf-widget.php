<?php

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class ThemeWidgetExample extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'theme_widget_example', 'Theme Widget - Example', 'Displays a block with title/text', array(
            Field::make( 'text', 'title', 'Title' )->set_default_value( 'Hello World!') ,
            Field::make( 'textarea', 'content', 'Content' )->set_default_value( 'Lorem Ipsum dolor sit amet' )
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
    register_widget( 'ThemeWidgetExample' );
}
