<?php
/*
  Title: Sitewide: Featured Image Settings
  Post Type: page, post
*/
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'hide_featured_image',
    'label' => 'Hide Featured Image',
    'columns' => 12,
    'choices' => array(
      'true' => 'Check this to hide the featured image from the page, but keep it in all meta fields.'
    )
  ));
?>
