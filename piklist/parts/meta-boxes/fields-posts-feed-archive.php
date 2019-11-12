<?php
/*
  Title: Post Feed: Archive
  Template: views/template-posts.blade
  Order: 6
*/
  piklist('field', array(
    'type' => 'radio',
    'field' => 'post_feed_archive',
    'label' => 'Post Feed: Archive',
    'description' => 'Displays as a list of posts.',
    'value' => 'post_feed_archive_false',
    'choices' => array(
      'post_feed_archive_category' => 'Select a cateogory of posts to feature.',
      'post_feed_archive_false' => 'None'
    )
  ));
  piklist( 'field', array(
    'type' => 'text',
    'field' => 'post_feed_archive_title',
    'label' => 'Section Title',
    'description' => 'Enter a title for the featured posts section.',
    'columns' => 12,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'text',
    'field' => 'post_feed_archive_link',
    'label' => 'Section Link',
    'description' => 'Enter the link to see all posts.',
    'columns' => 12,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'checkbox',
    'field' => 'post_feed_archive_category_array',
    'label' => 'Category',
    'description' => 'Select a category of posts to display.',
    'columns' => 12,
    'choices' => piklist(
      get_terms('category', array(
        'hide_empty' => true
      )),
      array(
        'term_id',
        'name'
      )
    ),
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'number',
    'field' => 'post_feed_archive_count',
    'label' => 'Number of Posts',
    'description' => 'Enter the number of posts you would like to display. (Defaults to 10 posts if empty)',
    'columns' => 2,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'number',
    'field' => 'post_feed_archive_offset',
    'label' => 'Post Offset',
    'description' => 'Enter the number of posts you would like to offset.',
    'columns' => 2,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive_category'
      )
    )
  ));
?>
