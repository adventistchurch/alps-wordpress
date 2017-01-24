<?php
/*
  Title: Primary Structured Content
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
        'columns' => 6,
        'value' => '',
        'label' => 'Content Block Layout',
        'choices' => array(
          '' => 'Select Block Layout',
          'content_block_grid' => 'Content Block: Grid',
          'content_block_image' => 'Content Block: Image'
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
        'field' => 'content_block_grid_layout',
        'columns' => 6,
        'label' => 'Grid Layout',
        'value' => '2up-70-30',
        'choices' => array(
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
        'type' => 'select',
        'field' => 'grid_block_1',
        'columns' => 12,
        'label' => 'Grid Block (Column 1)',
        'value' => '',
        'choices' => array(
          '' => 'Select Content Type',
          'content_body_1' => 'Body',
          'content_image_1' => 'Image'
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
        'label' => 'Body',
        'columns' => 12,
        'options' => array( // Pass any option that is accepted by wp_editor()
          'wpautop' => true,
          'teeny' => false,
          'dfw' => false,
          'quicktags' => true,
          'drag_drop_upload' => true,
          'tinymce' => array(
            'resize' => false,
            'wp_autoresize_on' => true
          )
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:grid_block_1',
            'value' => 'content_body_1'
          ),
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
        'label' => 'Image',
        'columns' => 12,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image',
          'max' => 1
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:grid_block_1',
            'value' => 'content_image_1'
          ),
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_grid'
          )
        )
      ),
      array(
        'type' => 'select',
        'field' => 'grid_block_2',
        'columns' => 12,
        'label' => 'Grid Block (Column 2)',
        'value' => '',
        'choices' => array(
          '' => 'Select Content Type',
          'content_body_2' => 'Body',
          'content_image_2' => 'Image'
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
        'label' => 'Body',
        'columns' => 12,
        'options' => array( // Pass any option that is accepted by wp_editor()
          'wpautop' => true,
          'teeny' => false,
          'dfw' => false,
          'quicktags' => true,
          'drag_drop_upload' => true,
          'tinymce' => array(
            'resize' => false,
            'wp_autoresize_on' => true
          )
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:grid_block_2',
            'value' => 'content_body_2'
          ),
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
        'label' => 'Image',
        'columns' => 12,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image',
          'max' => 1
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:grid_block_2',
            'value' => 'content_image_2'
          ),
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_layout',
            'value' => 'content_block_grid'
          )
        )
      ),
      array(
        'type' => 'select',
        'field' => 'grid_block_3',
        'columns' => 12,
        'label' => 'Grid Block (Column 3)',
        'value' => '',
        'choices' => array(
          '' => 'Select Content Type',
          'content_body_3' => 'Body',
          'content_image_3' => 'Image'
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:content_block_grid_layout',
            'value' => '3up'
          ),
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
        'label' => 'Body',
        'columns' => 12,
        'options' => array( // Pass any option that is accepted by wp_editor()
          'wpautop' => true,
          'teeny' => false,
          'dfw' => false,
          'quicktags' => true,
          'drag_drop_upload' => true,
          'tinymce' => array(
            'resize' => false,
            'wp_autoresize_on' => true
          )
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:grid_block_3',
            'value' => 'content_body_3'
          ),
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
        'label' => 'Image',
        'columns' => 12,
        'options' => array(
          'modal_title' => 'Upload Image',
          'button' => 'Add Image',
          'max' => 1
        ),
        'conditions' => array(
          array(
            'reset' => 'false',
            'field' => 'primary_structured_content:grid_block_3',
            'value' => 'content_image_3'
          ),
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
