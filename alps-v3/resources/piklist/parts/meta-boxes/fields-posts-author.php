<?php
/*
  Title: Hide Author
  Post Type: post
  Order: 4
  Context: side
*/
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'hide_author_post',
    'label' => 'Hide Author',
    'columns' => 12,
    'choices' => array(
      'true' => 'Check if you would like hide the post author.'
    )
  ));
?>
