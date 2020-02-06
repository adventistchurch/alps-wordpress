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
      'carousel' => 'Half screen image gallery with text overlay (Max Images: 6)',
      'false' => 'None'
    )
  ));
  piklist('field', array(
    'type' => 'file',
    'field' => 'hero_image',
    'label' => 'Hero Image',
    'description' => 'Upload and image for the hero.',
    'columns' => 12,
    'options' => array(
      'modal_title' => 'Upload Image',
      'button' => 'Add Image',
      'multiple' => false
    ),
    'validate' => array(
      array(
        'type' => 'limit',
        'options' => array(
          'min' => 1,
          'max' => 1
        ),
        'message' => 'Sorry, you can only upload one image for the hero.'
      )
    ),
    'conditions' => array(
      'relation' => 'or',
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'full'
      ),
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'default'
      )
    )
  ));
  piklist('field', array(
    'type' => 'textarea',
    'field' => 'hero_title',
    'label' => 'Hero Title',
    'description' => 'The title of the hero image.',
    'columns' => 12,
    'attributes' => array(
      'rows' => 2,
      'cols' => 50
    ),
    'conditions' => array(
      'relation' => 'or',
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'full'
      ),
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'default'
      )
    )
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'hero_kicker',
    'label' => 'Hero Kicker',
    'description' => 'Displays below the title in the hero image.',
    'columns' => 12,
    'conditions' => array(
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'default'
      )
    )
  ));
  piklist('field', array(
    'type' => 'url',
    'field' => 'hero_link_url',
    'label' => 'Hero Link Url',
    'description' => 'Enter a url to link the hero image.',
    'columns' => 12,
    'conditions' => array(
      'relation' => 'or',
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'full'
      ),
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'default'
      )
    )
  ));
  piklist('field', array(
    'type' => 'group',
    'field' => 'hero_column',
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
    'fields' => array(
      array(
        'type' => 'file',
        'field' => 'hero_image_column',
        'label' => 'Image',
        'columns' => 12,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image'
        )
      ),
      array(
        'type' => 'text',
        'field' => 'hero_kicker_column',
        'label' => 'Kicker',
        'description' => 'Displays before the title',
        'columns' => 12
      ),
      array(
        'type' => 'textarea',
        'field' => 'hero_title_column',
        'label' => 'Title',
        'columns' => 12,
        'attributes' => array(
          'rows' => 2,
          'cols' => 50
        )
      ),
      array(
        'type' => 'text',
        'field' => 'hero_link_url_column',
        'label' => 'Link Url',
        'columns' => 12
      )
    ),
    'conditions' => array(
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'column'
      )
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'hero_image_extended',
    'label' => 'Hero Image Extended',
    'description' => 'Check to extend the hero image over the sabbath column.',
    'value' => 'true',
    'choices' => array(
      'true' => 'Extend the image over the sabbath column.'
    ),
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
      )
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'hero_scroll_hint',
    'label' => 'Hero Scroll Hint',
    'description' => 'Check to add a scroll hint to the bottom of the hero',
    'value' => 'true',
    'choices' => array(
      'true' => 'Add scroll hint button'
    ),
    'conditions' => array(
      array(
        'reset' => 'false',
        'field' => 'hero_type',
        'value' => 'full'
      )
    )
  ));
?>
