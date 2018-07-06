<?php
/*
  Title: Post Feed: Full Width
  Template: views/template-posts.blade
  Order: 6
*/
  piklist('field', array(
    'type' => 'radio',
    'field' => 'post_feed_full',
    'label' => 'Post Feed: Full Width',
    'description' => 'Displays as a list of posts.',
    'value' => 'post_feed_full_false',
    'choices' => array(
      'post_feed_full_category' => 'Select a cateogory of posts to feature.',
      'post_feed_full_false' => 'None'
    )
  ));
  piklist( 'field', array(
    'type' => 'text',
    'field' => 'post_feed_full_title',
    'label' => 'Section Title',
    'description' => 'Enter a title for the featured posts section.',
    'columns' => 12,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'text',
    'field' => 'post_feed_full_link',
    'label' => 'Section Link',
    'description' => 'Enter the link to see all posts.',
    'columns' => 12,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'checkbox',
    'field' => 'post_feed_full_featured',
    'label' => 'Full width featured post',
    'description' => 'Select to include a post full width.',
    'columns' => 12,
    'choices' => array(
      'post_feed_full_featured_true' => 'Full width post'
    ),
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'select',
    'field' => 'post_feed_full_featured_array',
    'label' => 'Featured Post',
    'description' => 'Select (1) post to feature as a full width post.',
    'columns' => 12,
    'choices' => piklist(
      get_posts(
        array(
          'post_type' => 'post',
          'numberposts' => -1,
          'orderby' => 'title',
          'order' => 'ASC'
        )
      ),
      array(
        'ID',
        'post_title'
      )
    ),
    'conditions' => array(
      'relation' => 'and',
      array(
        'reset' => false,
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      ),
      array(
        'reset' => false,
        'field' => 'post_feed_full_featured',
        'value' => 'post_feed_full_featured_true'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'checkbox',
    'field' => 'post_feed_full_category_array',
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
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'number',
    'field' => 'post_feed_full_offset',
    'label' => 'Post Offset',
    'description' => 'Enter the number of posts you would like to offset.',
    'columns' => 2,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    )
  ));
?>
