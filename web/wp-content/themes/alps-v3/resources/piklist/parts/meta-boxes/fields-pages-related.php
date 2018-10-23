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
    'field' => 'related_layout',
    'label' => 'Related Pages Layout',
    'description' => 'Check the layout options for the related pages.',
    'columns' => 12,
    'choices' => array(
      'grid' => 'Display the related pages side-by-side.',
      'image' => 'Show the feature image for the related pages.',
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'related_image_round',
    'label' => 'Related Pages Round Image',
    'columns' => 12,
    'choices' => array(
      'true' => 'Select to make the featured image round.',
    ),
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'related_layout',
        'value' => 'image'
      ),
      array(
        'reset' => false,
        'field' => 'related_layout',
        'value' => 'grid',
        'compare' => '!='
      )
    )
  ));
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'related_grid_3up',
    'description' => '*The sidebar must be hidden for the pages to display 3up.',
    'label' => 'Related Pages Grid',
    'columns' => 12,
    'choices' => array(
      'true' => 'Select to display the related pages 3up at the largest breakpoint.',
    ),
    'conditions' => array(
      array(
        'reset' => false,
        'field' => 'related_layout',
        'value' => 'grid'
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
