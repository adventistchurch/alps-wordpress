<?php

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class ALPS_Author_Box_Widget extends Widget
{
    public function __construct()
    {
        $this->setup(
            'alps_widget_author',
            __('ALPS - Author Box', 'alps'),
            __('This will display a block of the post author\'s profile information.', 'alps'),
            [
                Field
                    ::make('text', 'text_link_author', __('Author', 'alps')),
            ]
        );
    }

    public function front_end($args, $settings)
    {
        include_once(dirname(__FILE__) . '/widgets/alps-author-box.php');
    }
}

class ALPS_Text_With_Link_Widget extends Widget
{
    public function __construct()
    {
        $this->setup(
            'alps_widget_text_with_link',
            __('ALPS - Text with Link', 'alps'),
            __('Text block with formatted link.', 'alps'),
            [
                Field
                    ::make('text', 'text_link_title', __('Title', 'alps')),
                Field
                    ::make('textarea', 'text_link_content', __('Content', 'alps')),
                Field
                    ::make('text', 'text_link_url', __('URL', 'alps'))
                    ->set_width(50),
                Field
                    ::make('text', 'text_link_url_text', __('URL Text', 'alps'))
                    ->set_width(50),
            ]
        );
    }

    // Called when rendering the widget in the front-end
    public function front_end($args, $settings)
    {
        include_once(dirname(__FILE__) . '/widgets/alps-text-with-link.php');
    }
}

class ALPS_Post_Feed_Widget extends Widget
{
    public function __construct()
    {
        $this->setup(
            'alps_widget_post_feed',
            __('ALPS - Post Feed', 'alps'),
            __('Feed of posts in the selected category.', 'alps'),
            [
                Field
                    ::make('select', 'post_feed_category', __('Feed Category', 'alps'))
                    ->set_options('cat_list'),
                Field
                    ::make('text', 'post_feed_title', __('Feed Title', 'alps')),
                Field
                    ::make('text', 'post_feed_url', __('See All Link', 'alps'))
                    ->set_help_text(__('Enter the url to view all of the post from the selected category.', 'alps')),
                Field
                    ::make('text', 'post_feed_count', __('Number of Posts to Display', 'alps')),
                Field
                    ::make('text', 'post_feed_offset', __('Post Offset', 'alps'))
                    ->set_help_text(__('Enter the number of posts to offset. Only works if the number of posts is set.', 'alps')),
                Field
                    ::make('checkbox', 'post_feed_featured', __('Post Image/Description', 'alps'))
                    ->set_help_text(__('Check to show the image and description for each post.', 'alps'))
                    ->set_option_value('true'),
                Field
                    ::make('checkbox', 'post_feed_layout', __('Grid Layout', 'alps'))
                    ->set_help_text(__('Check to show the image and description side-by-side.', 'alps'))
                    ->set_option_value('true'),
            ]
        );
    }

    public function front_end($args, $settings)
    {
        include_once(dirname(__FILE__) . '/widgets/alps-post-feed.php');
    }
}

class ALPS_Related_Stories_Widget extends Widget
{
    public function __construct()
    {
        $this->setup(
            'alps_widget_related_storied',
            __('ALPS - Related Stories', 'alps'),
            __('Related Stories block for Post Page sidebar.', 'alps'),
            [
                Field
                    ::make('text', 'related_stories_title', __('Title', 'alps')),
            ]
        );
    }

    // Called when rendering the widget in the front-end
    public function front_end($args, $settings)
    {
        include_once(dirname(__FILE__) . '/widgets/alps-related-stories.php');
    }
}

add_action('widgets_init', 'alps_widgets_init');
function alps_widgets_init()
{
    register_widget('ALPS_Author_Box_Widget');
    register_widget('ALPS_Text_With_Link_Widget');
    register_widget('ALPS_Post_Feed_Widget');
    register_widget('ALPS_Related_Stories_Widget');
}

function cat_list()
{
    // NEED TO BUILD CUSTOM CATEGORY LIST HERE DUE TO CARBON FIELDS ERROR
    $categories = get_categories([
        'orderby' => 'name'
    ]);
    $cats = [];
    foreach ($categories as $cat) {
        $cats[$cat->term_id] = $cat->name;
    }

    return $cats;
}
