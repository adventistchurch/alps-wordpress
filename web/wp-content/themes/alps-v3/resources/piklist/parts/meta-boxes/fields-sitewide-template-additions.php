<?php
/*
  Title: Template Additions
  Post Type: post, page
  Order: 1
*/
  piklist('field', array(
    'type' => 'text',
    'field' => 'display_title',
    'label' => 'Display Title',
    'description' => 'Set a page title different from the default title.',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'kicker',
    'label' => 'Kicker',
    'description' => 'Enter a kicker that will display above the title.',
    'columns' => 6
  ));
  piklist('field', array(
    'type' => 'file',
    'field' => 'header_background_image',
    'label' => 'Header Background Image',
    'description' => 'Add a background image to the header area.',
    'options' => array(
      'modal_title' => 'Upload Image',
      'button' => 'Add Image'
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'hide_sidebar',
    'label' => 'Hide the sidebar',
    'description' => 'Hides the sidebar on the page/post if it is active.',
    'columns' => 12,
    'choices' => array(
      'true' => 'Hide the content sidebar'
    )
  ));
?>
