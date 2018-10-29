<?php
/*
  Title: Related Pages
  Post Type: page
  Order: 6
  Hide for Template: views/template-posts.blade
*/
  piklist('field', array(
    'type' => 'radio',
    'field' => 'related',
    'label' => 'Related Pages Format',
    'description' => 'Select the format of the related pages.',
    'columns' => 12,
    'value' => 'false',
    'choices' => array(
      'related_top_level' => 'Show first level child pages only',
      'related_all' => 'Show child and grandchild pages',
      'related_custom' => 'Show custom pages',
      'false' => 'None'
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'related_grid',
    'label' => 'Related Pages Grid',
    'columns' => 12,
    'choices' => array(
      'true' => 'Select to display the related pages side-by-side.',
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'related_grid_3up',
    'description' => '*The sidebar must be hidden for the pages to display 3up.',
    'label' => 'Related Pages Grid (3up)',
    'columns' => 12,
    'choices' => array(
      'true' => 'Select to display the related pages 3up at the largest breakpoint.',
    ),
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'related_grid',
        'value' => 'true'
      )
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'related_image',
    'label' => 'Related Pages Image',
    'columns' => 12,
    'choices' => array(
      'true' => 'Select to display the feature image for the related pages.',
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'related_image_round',
    'label' => 'Related Pages Round Image',
    'description' => '*Does not work for images displays side-by-side.',
    'columns' => 12,
    'choices' => array(
      'true' => 'Select to make the featured image round.',
    ),
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'related_image',
        'value' => 'true'
      )
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
          'order' => 'ASC'
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
    )
  ));
?>
