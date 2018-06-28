<?php
/*
  Title: Hero
  Post Type: page
  Order: 2
  Hide for Template: views/template-posts.blade
*/
  piklist('field', array(
    'type' => 'radio',
    'field' => 'hero_type',
    'label' => 'Hero Type',
    'value' => 'false',
    'choices' => array(
      'default' => 'Half screen image with text overlay (Min/Max Images: 1)',
      'full' => 'Full screen image with text overlay (Min/Max Images: 1)',
      'column' => 'Three column image format with text overlays (Min/Max Images: 3)',
      'false' => 'None'
    )
  ));
  piklist('field', array(
    'type' => 'group',
    'field' => 'hero_image',
    'label' => 'Hero Image',
    'add_more' => true,
    'validate' => array(
      array(
        'type' => 'limit',
        'options' => array(
          'min' => 1,
          'max' => 3
        )
      )
    ),
    'description' => 'Choose a photo and add copy to build the image panel.',
    'conditions' => array(
      'relation' => 'or',
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'default'
      ),
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'full'
      ),
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'column'
      )
    ),
    'fields' => array(
      array(
        'type' => 'file',
        'field' => 'hero_image',
        'label' => 'Image',
        'columns' => 12,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image'
        )
      ),
      array(
        'type' => 'textarea',
        'field' => 'hero_title',
        'label' => 'Title',
        'columns' => 12,
        'attributes' => array(
          'rows' => 2,
          'cols' => 50
        )
      ),
      array(
        'type' => 'text',
        'field' => 'hero_kicker',
        'label' => 'Kicker',
        'columns' => 12
      ),
      array(
        'type' => 'text',
        'field' => 'hero_link_url',
        'description' => 'Absolute path or relative path (e.g. http://site.com or /about-us)',
        'label' => 'Link Url',
        'columns' => 12
      )
    )
  ));
?>
