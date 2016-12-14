<?php
/*
  Title: Home: Row Block
  Post Type: page
  Order: 2
  Template: template-home
*/
  piklist('field', array(
    'type' => 'group',
    'label' => 'Content Block Freeform',
    'field' => 'content_block_freeform',
    'description' => 'Choose the type of content you would like to appear in the primary content column.',
    'add_more' => true,
    'fields' => array(
      array(
        'type' => 'text',
        'field' => 'content_block_freeform_kicker',
        'label' => 'Kicker',
        'columns' => 4
      ),
      array(
        'type' => 'text',
        'field' => 'content_block_freeform_title',
        'label' => 'Title',
        'columns' => 8
      ),
      array(
        'type' => 'file',
        'field' => 'content_block_freeform_image',
        'label' => 'Image',
        'columns' => 4,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image',
          'max' => 1
        )
      ),
      array(
        'type' => 'checkbox',
        'field' => 'content_block_freeform_round',
        'label' => 'Make the Image Round',
        'columns' => 8,
        'choices' => array(
          'true' => 'To make the image round, check this box.'
        )
      ),
      array(
        'type' => 'editor',
        'field' => 'content_block_freeform_body',
        'label' => 'Body',
        'columns' => 12,
        'options' => array(
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
      ),
      array(
        'type' => 'text',
        'field' => 'content_block_freeform_button_text',
        'label' => 'Button Text',
        'columns' => 6
      ),
      array(
        'type' => 'text',
        'field' => 'content_block_freeform_button_url',
        'label' => 'Button URL',
        'columns' => 6
      ),
      array(
        'type' => 'colorpicker',
        'field' => 'content_block_freeform_colorpicker',
        'label' => 'Color Picker',
        'columns' => 12
      )
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'grid_two_columns',
    'label' => 'Two Columns',
    'choices' => array(
      'true' => 'To display the block in two columns, check this box.'
    )
  ));
?>
