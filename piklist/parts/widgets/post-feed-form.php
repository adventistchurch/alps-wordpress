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

  $tag_options  = get_tags( array( 'hide_empty' => true ) );
  $tag_names    = array_column( $tag_options, 'name' );
  $tag_ids      = array_column( $tag_options, 'term_id' );
  $tag_options  = array_combine( $tag_ids, $tag_names );
  $tag_options  = [ 'none' => 'Select A Tag'] + $tag_options;

  piklist('field', array(
    'type' => 'select',
    'field' => 'post_feed_tag',
    'label' => 'Tag',
    'description' => 'Select the TAG for the feed.',
    'choices' => $tag_options,
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
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'post_feed_layout',
    'label' => 'Grid Layout',
    'choices' => array(
      'true' => 'Check to show the image and description side-by-side.'
    )
  ));
?>
