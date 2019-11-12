<?php
/*
  Title: Post Feed: List
  Template: views/template-posts.blade
  Order: 3
*/
  piklist('field', array(
    'type' => 'radio',
    'field' => 'post_feed_list',
    'label' => 'Post Feed: List',
    'description' => 'Displays as a list of posts.',
    'value' => 'post_feed_list_false',
    'choices' => array(
      'post_feed_list_custom' => 'Select specific posts to feature.',
      'post_feed_list_category' => 'Select a cateogory of posts to feature.',
      'post_feed_list_false' => 'None'
    )
  ));
  piklist( 'field', array(
    'type' => 'text',
    'field' => 'post_feed_list_title',
    'label' => 'Section Title',
    'description' => 'Enter a title for the featured posts section.',
    'columns' => 12,
    'conditions' => array(
      'relation' => 'or',
      array(
        'reset' => false,
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_custom'
      ),
      array(
        'reset' => false,
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'text',
    'field' => 'post_feed_list_link',
    'label' => 'Section Link',
    'description' => 'Enter the link to see all posts.',
    'columns' => 12,
    'conditions' => array(
      'relation' => 'or',
      array(
        'reset' => false,
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_custom'
      ),
      array(
        'reset' => false,
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'checkbox',
    'field' => 'post_feed_list_round_image',
    'label' => 'Round Image Thumbnail',
    'description' => 'Check to make the image thumbnail round.',
    'columns' => 12,
    'choices' => array(
      'true' => 'Check to make the image thumbnail round.'
    ),
    'conditions' => array(
      'relation' => 'or',
      array(
        'reset' => false,
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_custom'
      ),
      array(
        'reset' => false,
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'select',
    'field' => 'post_feed_list_custom_array',
    'label' => 'Posts',
    'description' => 'Select the posts to display.',
    'columns' => 12,
    'attributes' => array(
      'class' => 'css class',
      'multiple' => 'multiple'
    ),
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
      array(
        'reset' => false,
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_custom'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'checkbox',
    'field' => 'post_feed_list_category_array',
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
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'number',
    'field' => 'post_feed_list_count',
    'label' => 'Number of Posts',
    'description' => 'Enter the number of posts you would like to display. (If empty, defaults to 3 posts in the selected category)',
    'columns' => 2,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )
  ));
  piklist( 'field', array(
    'type' => 'number',
    'field' => 'post_feed_list_offset',
    'label' => 'Post Offset',
    'description' => 'Enter the number of posts you would like to offset.',
    'columns' => 2,
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )
  ));
?>
