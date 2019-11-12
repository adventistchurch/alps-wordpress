<?php
use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class ALPS_Author_Box_Widget extends Widget
{
  // Register widget function. Must have the same name as the class
  public function __construct()
  {
    $this->setup('alps_widget_author', 'ALPS - Author Box', 'This will display a block of the post author\'s profile information.', array(
      Field::make('text', 'text_link_title', 'Author')
    ));
  }
  public function front_end($args, $settings)
  {
    include_once(dirname(__FILE__) . '/widgets/alps-author-box.php');
  }
}

class ALPS_Text_With_Link_Widget extends Widget
{
  // Register widget function. Must have the same name as the class
  public function __construct()
  {
    $this->setup('alps_widget_text_with_link', 'ALPS - Text with Link', 'Text block with formatted link.', array(
      Field::make('text', 'text_link_title', 'Title'),
      Field::make('textarea', 'text_link_content', __('Content')),
      Field::make('text', 'text_link_url', 'URL')->set_width(50),
      Field::make('text', 'text_link_url_text', 'URL Text')->set_width(50)
    ));
  }
  // Called when rendering the widget in the front-end
  public function front_end($args, $settings)
  {
    include_once(dirname(__FILE__) . '/widgets/alps-text-with-link.php');
  }
}

class ALPS_Post_Feed_Widget extends Widget
{
  // Register widget function. Must have the same name as the class
  public function __construct()
  {
    $this->setup('alps_widget_post_feed', 'ALPS - Post Feed', 'Feed of posts in the selected category.', array(
      Field::make('select', 'post_feed_category', __('Feed Category'))->set_options('cat_list'),
      Field::make('text', 'post_feed_title', 'Feed Title'),
      Field::make('text', 'post_feed_url', 'See All Link')->set_help_text('Enter the url to view all of the post from the selected category.'),
      Field::make('text', 'post_feed_count', 'Number of Posts to Display'),
      Field::make('text', 'post_feed_offset', 'Post Offset')->set_help_text('Enter the number of posts to offset. Only works if the number of posts is set.'),
      Field::make('checkbox', 'post_feed_featured', __('Post Image/Description:'))->set_help_text('Check to show the image and description for each post.')->set_option_value('true'),
      Field::make('checkbox', 'post_feed_layout', __('Grid Layout'))->set_help_text('Check to show the image and description side-by-side.')->set_option_value('true'),
    ));
  }
  // Called when rendering the widget in the front-end

  public function front_end($args, $settings)
  {
    include_once(dirname(__FILE__) . '/widgets/alps-post-feed.php');
  }
}

add_action('widgets_init', 'alps_widgets');
function alps_widgets()
{
  register_widget('ALPS_Author_Box_Widget');
  register_widget('ALPS_Text_With_Link_Widget');
  register_widget('ALPS_Post_Feed_Widget');
}

function cat_list()
{
  // NEED TO BUILD CUSTOM CATEGORY LIST HERE DUE TO CARBON FIELDS ERROR
  $categories = get_categories(array(
    'orderby' => 'name'
  ));
  $cats = array();
  foreach ($categories as $cat) {
    $cats[$cat->term_id] = $cat->name;
  }
  return $cats;
}