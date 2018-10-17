<?php
  piklist('field', array(
    'type' => 'select',
    'field' => 'post_feed_category',
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
    ),
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'post_feed_title',
    'label' => 'Title',
    'description' => 'Enter a title for the feed. If no title is set, it will default to the category title.',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'post_feed_url',
    'label' => 'See All Link',
    'description' => 'Enter the url to view all of the post from the selected category.',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'post_feed_count',
    'label' => 'Number of posts',
    'description' => 'Enter the number of posts to display.',
    'columns' => 2
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'post_feed_offset',
    'label' => 'Offset posts',
    'description' => 'Enter the number of posts to offset.',
    'columns' => 2
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'post_feed_featured',
    'label' => 'Post Image/Description',
    'choices' => array(
      'true' => 'Check to show the image and description for each post.'
    )
  ));
?>
