<?php
/*
  Title: Home: Story Block
  Post Type: page
  Order: 1
  Template: template-home
*/
  piklist('field', array(
    'type' => 'text',
    'field' => 'sb_title',
    'label' => 'Title',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'sb_subtitle',
    'label' => 'Subtitle',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'file',
    'field' => 'sb_background_image',
    'label' => 'Background Image',
    'description' => 'Choose an image to display in the background (optional).',
    'options' => array(
      'modal_title' => 'Upload Image',
      'button' => 'Add Image'
    )
  ));
  piklist('field', array(
    'type' => 'file',
    'field' => 'sb_thumbnail',
    'label' => 'Thumbnail',
    'description' => 'Image to appear in the top left area of the block.',
    'options' => array(
      'modal_title' => 'Upload Image',
      'button' => 'Add Image'
    )
  ));
  piklist('field', array(
    'type' => 'file',
    'field' => 'sb_side_image',
    'label' => 'Side Image',
    'description' => 'Optionally include an image with the body copy.',
    'options' => array(
      'modal_title' => 'Upload Image',
      'button' => 'Add Image'
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'is_video',
    'label' => 'Is Video',
    'choices' => array(
      'true' => 'If the side image is a video thumbnail, check this box.'
    )
  ));
  piklist('field', array(
    'type' => 'editor',
    'field' => 'sb_body',
    'label' => 'Body',
    'options' => array( // Pass any option that is accepted by wp_editor()
      'wpautop' => true,
      'teeny' => false,
      'dfw' => false,
      'quicktags' => true,
      'drag_drop_upload' => true,
      'tinymce' => array(
        'resize' => false,
        'wp_autoresize_on' => true
      )
    )
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'sb_url',
    'label' => 'URL',
    'columns' => 12
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'sb_cta',
    'label' => 'Call to Action Text',
    'columns' => 12
  ));
?>
