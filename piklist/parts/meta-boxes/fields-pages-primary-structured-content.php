<?php
/*
  Title: Pages: Primary Structured Content
  Post Type: page
  Order: 1
  Template: template-single
*/
  piklist('field', array(
    'type' => 'group',
    'label' => 'Primary Structured Content',
    'field' => 'primary_structured_content',
    'description' => 'Choose the type of content you would like to appear in the primary content column.',
    'add_more' => true,
    'fields' => array(
      array(
        'type' => 'select',
        'field' => 'content_block_layout',
        'columns' => 12,
        'value' => '',
        'label' => 'Content Block Layout',
        'choices' => array(
          '' => 'Select Block Layout',
          'content_block_grid' => 'Content Block: Grid',
          'content_block_image' => 'Content Block: Image'
        )
      ),
      array(
        'type' => 'file',
        'field' => 'content_block_image_file',
        'label' => 'Image',
        'columns' => 6,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image',
          'max' => 1
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_image'
          )
        )
      ),
      array(
        'type' => 'select',
        'field' => 'content_block_image_layout',
        'columns' => 6,
        'label' => 'Image Layout',
        'value' => 'full_width',
        'choices' => array(
          'full_width' => 'Full Width',
          'breakout' => 'Breakout',
          'breakout_parallax' => 'Breakout with Parallax'
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_image'
          )
        )
      ),
      array(
        'type' => 'select',
        'field' => 'content_block_grid_layout',
        'columns' => 12,
        'label' => 'Grid Layout',
        'value' => '',
        'choices' => array(
          '' => 'Select Grid Layout',
          '2up-70-30' => '2 Columns (70/30)',
          '2up-30-70' => '2 Columns (30/70)',
          '2up-50-50' => '2 Columns (50/50)',
          '3up' => '3 Columns'
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_grid'
          )
        )
      ),
      array(
        'type' => 'editor',
        'field' => 'content_block_grid_body_1',
        'label' => 'Body (Column 1)',
        'columns' => 12,
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_grid'
          )
        )
      ),
      array(
        'type' => 'file',
        'field' => 'content_block_grid_file_1',
        'label' => 'Image (Column 1)',
        'columns' => 12,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image',
          'max' => 1
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_grid'
          )
        )
      ),
      array(
        'type' => 'editor',
        'field' => 'content_block_grid_body_2',
        'label' => 'Body (Column 2)',
        'columns' => 12,
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_grid'
          )
        )
      ),
      array(
        'type' => 'file',
        'field' => 'content_block_grid_file_2',
        'label' => 'Image (Column 2)',
        'columns' => 12,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image',
          'max' => 1
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_grid'
          )
        )
      ),
      array(
        'type' => 'editor',
        'field' => 'content_block_grid_body_3',
        'label' => 'Body (Column 3)',
        'columns' => 12,
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_grid'
          ),
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_grid_layout',
            'value' => '3up'
          )
        )
      ),
      array(
        'type' => 'file',
        'field' => 'content_block_grid_file_3',
        'label' => 'Image (Column 3)',
        'columns' => 12,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image',
          'max' => 1
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_grid'
          ),
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_grid_layout',
            'value' => '3up'
          )
        )
      )
    )
  ));
?>
