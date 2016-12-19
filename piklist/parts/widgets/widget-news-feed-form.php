<?php
  piklist('field', array(
    'type' => 'text',
    'field' => 'news_feed_title',
    'label' => 'Custom Feed Title',
    'columns' => 6
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'news_widget_post_count',
    'label' => 'Number of posts',
    'columns' => 2
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'news_sidebar',
    'label' => 'Sidebar',
    'choices' => array(
      'true' => 'Check this box to format the feed for the sidebar.'
    )
  ));
?>
