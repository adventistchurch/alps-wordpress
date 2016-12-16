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
  piklist('field', array(
    'type' => 'text',
    'field' => 'footer_copyright',
    'label' => 'Footer Copyright',
    'columns' => 12,
    'value' => 'Copyright © 2016, General Conference of Seventh-day Adventists'
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'footer_address',
    'label' => 'Footer Address',
    'columns' => 12,
    'value' => '12501 Old Columbia Pike, Silver Spring, MD 20904, USA 301-680-6000'
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'footer_trademark_url',
    'label' => 'Footer Trademark & Logo Usage URL',
    'columns' => 12,
    'description' => 'Enter the URL to the trademark and logo usage information.',
    'value' => 'https://www.adventist.org/en/copyright/trademark-and-logo-usage/'
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'footer_legal_url',
    'label' => 'Footer Legal Notices URL',
    'columns' => 12,
    'description' => 'Enter the URL to the legal notices information.',
    'value' => 'https://www.adventist.org/en/copyright/legal-notice/'
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'footer_privacy_url',
    'label' => 'Footer Privacy Policy URL',
    'columns' => 12,
    'description' => 'Enter the URL to the privacy policy information.',
    'value' => 'http://privacy.adventist.org/en/'
  ));
?>
