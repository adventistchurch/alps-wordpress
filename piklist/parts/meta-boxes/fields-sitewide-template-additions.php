<?php
/*
  Title: Sitewide: Template Additions
  Post Type: post, page
*/
  piklist('field', array(
    'type' => 'text',
    'field' => 'display_title',
    'label' => 'Title',
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
    'type' => 'textarea',
    'field' => 'subtitle',
    'label' => 'Subtitle',
    'description' => 'Appears coupled with Title/Display Title. Cannot Exceed 200 characters.',
    'columns' => 12,
    'attributes' => array(
      'rows' => 5,
      'cols' => 50
    )
  ));
  piklist('field', array(
    'type' => 'textarea',
    'field' => 'intro',
    'label' => 'Intro',
    'description' => 'Intro paragraph to be included above page/post body content and used in referenced blocks.',
    'columns' => 12,
    'attributes' => array(
      'rows' => 5,
      'cols' => 50
    )
  ));
  piklist('field', array(
    'type' => 'file',
    'field' => 'header_background_image',
    'label' => 'Header Background Image',
    'description' => 'Add a background image to the header (not available on all pages).',
    'options' => array(
      'modal_title' => 'Upload Image',
      'button' => 'Add Image'
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'header_block_text',
    'label' => 'Header Block Text',
    'choices' => array(
      'true' => 'Check if you would like to include a block of text in the header.'
    )
  ));
?>
