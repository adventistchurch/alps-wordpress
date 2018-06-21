<?php
/*
  Title: Related Pages
  Post Type: page
  Order: 6
*/
  piklist('field', array(
    'type' => 'radio',
    'field' => 'related',
    'label' => 'Related Pages Format',
    'description' => 'Select the format of the related pages.',
    'columns' => 12,
    'value' => 'related_top_level',
    'choices' => array(
      'related_top_level' => 'Show first level child pages only',
      'related_all' => 'Show child and grandchild pages',
      'related_custom' => 'Show custom pages'
    )
  ));
  piklist( 'field', array(
    'type' => 'select',
    'field' => 'related_custom_value',
    'label' => 'Related Pages',
    'description' => 'Select the related pages to display.',
    'columns' => 12,
    'attributes' => array(
      'class' => 'css class',
      'multiple' => 'multiple'
    ),
    'choices' => piklist(
      get_posts(
        array(
          'post_type' => 'page',
          'numberposts' => -1,
          'orderby' => 'title',
          'order' => 'ASC',
          'meta_box_cb' => false
        )
      ),
      array(
        'ID',
        'post_title'
      )
    ),
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'related',
        'value' => 'related_custom'
      )
    ),
    'relate' => array(
      'scope' => 'post'
    )
  ));
?>
