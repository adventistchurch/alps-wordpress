<?php
/*
  Title: Featured Video
  Post Type: page, post
  Order: 4
  Context: side
*/
  piklist('field', array(
    'type' => 'text',
    'field' => 'video_url',
    'label' => 'Video Url',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'textarea',
    'field' => 'video_caption',
    'label' => 'Video Caption',
    'columns' => 12,
    'attributes' => array(
      'rows' => 5,
      'cols' => 50
    )
  ));
?>
