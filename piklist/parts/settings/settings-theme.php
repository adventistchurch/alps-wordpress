<?php
/*
Title: Theme Settings
Order: 100
Tab: Conditions
Sub Tab: Advanced
Setting: alps_theme_settings
*/

  piklist('field', array(
    'type' => 'file',
    'field' => 'logo_square',
    'label' => 'Logo Square',
    'description' => 'Upload the default logo that will be used at the large breakpoints',
    'options' => array(
      'modal_title' => 'Upload Image',
      'button' => 'Add Image'
    )
  ));

  piklist('field', array(
    'type' => 'file',
    'field' => 'logo_horizontal',
    'label' => 'Logo Horizontal',
    'description' => 'Upload the horizontal format of the logo that will be used at the small breakpoints',
    'options' => array(
      'modal_title' => 'Upload Image',
      'button' => 'Add Image'
    )
  ));

  piklist('field', array(
    'type' => 'file',
    'field' => 'logo_text',
    'label' => 'Logo Text',
    'description' => 'Uploaded an image of the text to appear below the main logo',
    'options' => array(
      'modal_title' => 'Upload Image',
      'button' => 'Add Image'
    )
  ));

  piklist('field', array(
    'type' => 'select',
    'field' => 'primary_theme_color',
    'label' => 'Primary Theme Color',
    'value' => 'treefrog',
    'choices' => array(
      'emperor' => 'Emperor',
      'earth' => 'Earth',
      'grapevine' => 'Grapevine',
      'denim' => 'Denim',
      'campfire' => 'Campfire',
      'treefrog' => 'Tree Frog',
      'ming' => 'Ming'
    )
  ));

  piklist('field', array(
    'type' => 'select',
    'field' => 'secondary_theme_color',
    'label' => 'Secondary Theme Color',
    'value' => 'warm',
    'choices' => array(
      'cool' => 'Cool',
      'warm' => 'Warm',
    )
  ));

  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'dark_theme',
    'label' => 'Dark Theme',
    'choices' => array(
      'true' => 'Select if you would like the theme to be dark'
    )
  ));

?>
