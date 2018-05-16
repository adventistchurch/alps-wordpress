<?php
  piklist('field', array(
    'type' => 'select',
    'field' => 'feed_category_list',
    'label' => 'Category',
    'description' => 'Select the category for the feed.',
    'value' => 'news',
    'choices' => piklist(
      get_terms('category', array(
        'hide_empty' => true
      )),
      array(
        'term_id',
        'name'
      )
    )
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'feed_title',
    'label' => 'Custom Feed Title',
    'columns' => 6
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'feed_widget_post_count',
    'label' => 'Number of posts',
    'columns' => 2
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'for_sidebar',
    'label' => 'Sidebar',
    'choices' => array(
      'true' => 'Check this box to format the feed for the sidebar.'
    )
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'feed_widget_btn_text',
    'label' => 'More Button Text',
    'columns' => 6
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'feed_widget_btn_link',
    'label' => 'More Button Link',
    'columns' => 6
  ));
?>
