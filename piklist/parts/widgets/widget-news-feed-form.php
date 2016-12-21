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
  piklist('field', array(
    'type' => 'text',
    'field' => 'news_widget_btn_text',
    'label' => 'More Button Text',
    'columns' => 6
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'news_widget_btn_link',
    'label' => 'More Button Link',
    'columns' => 6
  ));
?>
