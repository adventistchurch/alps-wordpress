<?php
/*
  Title: Featured Image Hero
  Order: 6
  Context: side

*/
  piklist('field', array(
    'type' => 'radio',
    'field' => 'featured_image_hero_layout',
    'label' => 'Feature Image Hero Layout',
    'description' => 'If a featured image is set, select the layout of the hero.',
    'value' => 'hero_layout_3_3',
    'choices' => array(
      'hero_layout_1_3' => 'Text Width: 1/3 and Image Width: 2/3',
      'hero_layout_3_3' => 'Text Width: 1/2 and Image Width: 1/2'
    )
  ));
?>
