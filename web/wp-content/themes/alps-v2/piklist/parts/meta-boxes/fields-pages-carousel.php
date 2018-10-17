<?php
/*
  Title: Carousel
  Post Type: page
  Order: 1
*/
  piklist('field', array(
    'type' => 'radio',
    'field' => 'carousel_type',
    'label' => 'Carousel Type',
    'value' => 'false',
    'choices' => array(
      'large_format_inset' => 'Large format with text overlay',
      'large_format_2_col_4x3' => 'Two column large format with 4:3 image ratio',
      'large_format_2_col_16x9' => 'Two column large format with 16:9 image ratio',
      'small_format_inset' => 'Small format with text overlay featured in primary content',
      'false' => 'None'
    )
  ));
  piklist('field', array(
    'type' => 'group',
    'field' => 'carousel_slides',
    'label' => 'Carousel Slides',
    'description' => 'Choose a photo and add copy to build each slide.',
    'add_more' => true,
    'conditions' => array(
      array(
        'reset' => 'false',
        'field' => 'carousel_type',
        'compare' => '!=',
        'value' => 'false'
      )
    ),
    'fields' => array(
      array(
        'type' => 'file',
        'field' => 'carousel_image',
        'label' => 'Image',
        'columns' => 12,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image'
        )
      ),
      array(
        'type' => 'text',
        'field' => 'carousel_title',
        'label' => 'Title',
        'columns' => 6
      ),
      array(
        'type' => 'text',
        'field' => 'carousel_subtitle',
        'label' => 'Subtitle (Optional)',
        'columns' => 6
      ),
      array(
        'type' => 'textarea',
        'field' => 'carousel_description',
        'label' => 'Description',
        'columns' => 12,
        'attributes' => array(
          'rows' => 5,
          'cols' => 50
        )
      ),
      array(
        'type' => 'text',
        'field' => 'carousel_link_url',
        'label' => 'Link Url',
        'columns' => 6,
        'attributes' => array(
          'placeholder' => 'Absolute path or relative path (e.g. http://site.com or /about-us)'
        )
      ),
      array(
        'type' => 'text',
        'field' => 'carousel_link_text',
        'label' => 'Link Text (Optional)',
        'columns' => 6
      ),
      array(
        'type' => 'checkbox',
        'field' => 'carousel_text_align_right',
        'label' => 'Text Align Right',
        'columns' => 12,
        'choices' => array(
          'true' => 'To align the text to the right on the full width carousel, check this box.'
        )
      )
    )
  ));

?>
