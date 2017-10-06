<?php
/*
  Title: Theme Settings
  Order: 100
  Tab: Conditions
  Sub Tab: Advanced
  Setting: alps_theme_settings
*/

  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'logo_desktop_wide',
    'label' => 'Logo Desktop Wide',
    'choices' => array(
      'wide' => 'Select if the default logo orientation is wide rather than square.'
    )
  ));
  $languages = apply_filters('wpml_active_languages', NULL);
  if (!empty($languages)) {
    foreach ($languages as $language) {
      piklist('field', array(
        'type' => 'file',
        'field' => 'logo_desktop_' . $language['code'],
        'label' => 'Logo Desktop (' . $language['translated_name'] . ')',
        'description' => 'Upload the default ' . $language['translated_name'] . ' logo for the that will be used at the large breakpoints',
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image'
        )
      ));
    }
  } else {
    piklist('field', array(
      'type' => 'file',
      'field' => 'logo_desktop',
      'label' => 'Logo Desktop',
      'description' => 'Upload the default logo that will be used at the large breakpoints',
      'options' => array(
        'modal_title' => 'Upload Image',
        'button' => 'Add Image'
      )
    ));
  }
  if (!empty($languages)) {
    foreach ($languages as $language) {
      piklist('field', array(
        'type' => 'file',
        'field' => 'logo_mobile_' . $language['code'],
        'label' => 'Logo Mobile (' . $language['translated_name'] . ')',
        'description' => 'Upload the horizontal format of the ' . $language['translated_name'] . ' logo that will be used at the small breakpoints',
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image'
        )
      ));
    }
  } else {
    piklist('field', array(
      'type' => 'file',
      'field' => 'logo_mobile',
      'label' => 'Logo Mobile',
      'description' => 'Upload the horizontal format of the logo that will be used at the small breakpoints',
      'options' => array(
        'modal_title' => 'Upload Image',
        'button' => 'Add Image'
      )
    ));
  }
  if (!empty($languages)) {
    foreach ($languages as $language) {
      piklist('field', array(
        'type' => 'file',
        'field' => 'logo_text_' . $language['code'],
        'label' => 'Logo Text (' . $language['translated_name'] . ')',
        'description' => 'Uploaded an image of the ' . $language['translated_name'] . ' text to appear below the main logo',
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image'
        )
      ));
    }
  } else {
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
  }
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
    'type' => 'checkbox',
    'field' => 'hide_author_global',
    'label' => 'Hide Author',
    'choices' => array(
      'true' => 'Select if you would like hide the post author'
    )
  ));
  piklist('field', array(
    'type' => 'editor',
    'field' => 'footer_description',
    'label' => 'Footer Description',
    'columns' => 12,
    'value' => '<a href="//www.adventist.org/en/">Adventist.org</a> is the Official website of the Seventh-day Adventist world church &bull; <a href="//www.adventist.org/en/world-church/">View Regions</a>'
  ));
  piklist('field', array(
    'type' => 'text',
    'field' => 'footer_copyright',
    'label' => 'Footer Copyright',
    'columns' => 12,
    'value' => 'Copyright © 2016, General Conference of Seventh-day Adventists'
  ));
  piklist('field', array(
    'type' => 'group',
    'field' => 'footer_address',
    'label' => 'Footer Address',
    'fields' => array(
      array(
        'type' => 'text',
        'field' => 'footer_address_street',
        'label' => 'Street Address',
        'columns' => 12,
        'value' => '12501 Old Columbia Pike'
      ),
      array(
        'type' => 'text',
        'field' => 'footer_address_city',
        'label' => 'City',
        'columns' => 4,
        'value' => 'Silver Spring'
      ),
      array(
        'type' => 'text',
        'field' => 'footer_address_state',
        'label' => 'State',
        'columns' => 4,
        'value' => 'MD'
      ),
      array(
        'type' => 'text',
        'field' => 'footer_address_zip',
        'label' => 'Zipcode',
        'columns' => 4,
        'value' => '20904'
      ),
      array(
        'type' => 'text',
        'field' => 'footer_address_country',
        'label' => 'Country',
        'columns' => 6,
        'value' => 'USA'
      ),
      array(
        'type' => 'text',
        'field' => 'footer_phone',
        'label' => 'Phone Number',
        'columns' => 6,
        'value' => '301-680-6000'
      )
    )
  ));
?>
