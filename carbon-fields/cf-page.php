<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_carousel_fields' );
// PAGE - CAROUSEL ========================================================
function crb_attach_carousel_fields() {
  Container::make( 'post_meta', 'ALPS: Carousel' )
    ->where( 'post_type', '=', 'page' )
    //->set_context( 'carbon_fields_after_title' )
    ->add_fields( array(
      Field::make( 'radio', 'carousel_type', 'Carousel Type' )
        ->add_options( array(
          'large_format_inset' => 'Large format with text overlay',
          'large_format_2_col_4x3' => 'Two column large format with 4:3 image ratio',
          'large_format_2_col_16x9' => 'Two column large format with 16:9 image ratio',
          'small_format_inset' => 'Small format with text overlay featured in primary content',
          'false' => 'None'
        ) )
        ->set_default_value( 'false' ),
      Field::make( 'complex', 'carousel_slides', __( 'Carousel Slides' ) )
        ->add_fields( array( 
          Field::make( 'image', 'carousel_image', __( 'Image' ) ),
          Field::make( 'text', 'carousel_title', __( 'Title' ) )
            ->set_width( 50 ),
          Field::make( 'text', 'carousel_subtitle', __( 'Subtitle (Optional)' ) )
            ->set_width( 50 ),
          Field::make( 'textarea', 'carousel_description', __( 'Description' ) )
            ->set_rows( 3 ),
          Field::make( 'text', 'carousel_link_url', __( 'Link URL' ) )
            ->set_attribute( 'placeholder', 'Absolute path or relative path (e.g. http://site.com or /about-us' )
            ->set_width( 50 ),
          Field::make( 'text', 'carousel_link_text', __( 'Link Text (Optional)' ) )
            ->set_width( 50 ),
          Field::make( 'checkbox', 'carousel_text_align_right', __( 'Text Align Right' ) )
            ->set_option_value( 'true' )
            ->set_help_text( __( 'To align the text to the right on the full width carousel, check this box' ) ),
        )  ) 
        // ONLY SHOW IF CAROUSEL TYPE IS NOT FALSE
        ->set_conditional_logic( 
          array(
            array(
              'field'   => 'carousel_type',
              'value'   => 'false', 
              'compare' => 'EXCLUDES', 
            )
          )
        ),
    ) );
}

add_action( 'carbon_fields_register_fields', 'crb_attach_structured_fields' );
// SINGLE TEMPLATE - STRUCTURED CONTENT =====================================
function crb_attach_structured_fields() {
  Container::make( 'post_meta', 'ALPS: Structured Content' )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'template-single.php' )
    ->add_fields( array(
      Field::make( 'complex', 'primary_structured_content', __( 'Primary Structured Content' ) )
        ->add_fields( array( 
          Field::make( 'select', 'content_block_layout', __( 'Content Block Layout' ) )
            ->set_options( array(
              'false' => __( 'Select Block Layout' ),
              'content_block_grid' => __( 'Content Block: Grid' ),
              'content_block_image' => __( 'Content Block: Image' )
            ) )
            ->set_width( 50 ),
          // GRID FIELDS - SELECT LAYOUT - CONTENT BLOCK: GRID -----------------------------------//
          Field::make( 'select', 'content_block_grid_layout', __( 'Grid Layout' ) )
            ->set_options( array(
              '1up' => '1 Column',
              '2up-70-30' => '2 Columns (70/30)',
              '2up-30-70' => '2 Columns (30/70)',
              '2up-50-50' => '2 Columns (50/50)',
              '3up' => '3 Columns'
            ) )
            ->set_default_value( '1up' )
            ->set_conditional_logic( array(
              array(
                'field' => 'content_block_layout',
                'value' => 'content_block_grid'
              ) 
            ) )
            ->set_width( 50 ),
            // GRID - COL ONE - SELECT TYPE - CONTENT BLOCK: GRID -----------------------------------//
            Field::make( 'select', 'grid_block_1', __( 'Grid Block (Column 1)' ) )
              ->set_options( array(
                '' => 'Select Content Type',
                'content_body_1' => 'Body',
                'content_image_1' => 'Image'
              ) )
              ->set_conditional_logic( array(
                array(
                  'field' => 'content_block_layout',
                  'value' => 'content_block_grid'
                )
              ) 
            ),
            // GRID - COL ONE - EDITOR - CONTENT BLOCK: GRID --------------------------// 
            Field::make( 'rich_text', 'content_block_grid_body_1', __( 'Body' ) )
             ->set_conditional_logic( 
                array(
                  array(
                    'field' => 'grid_block_1',
                    'value' => 'content_body_1'
                  ),
                   array(
                  'field' => 'content_block_layout',
                  'value' => 'content_block_grid'
                  ),
                )
              ),
            // GRID - COL ONE - IMAGE - CONTENT BLOCK: GRID ---------------------------// 
            Field::make( 'image', 'content_block_grid_file_1', __( 'Image' ) )
             ->set_conditional_logic( 
                array(
                  array(
                    'field' => 'grid_block_1',
                    'value' => 'content_image_1'
                  ),
                  array(
                  'field' => 'content_block_layout',
                  'value' => 'content_block_grid'
                  ),
                )
              ),
            // GRID - COL TWO - SELECT TYPE - CONTENT BLOCK: GRID ---------------------------// 
            Field::make( 'select', 'grid_block_2', __( 'Grid Block (Column 2)' ) )
              ->set_options( array(
                '' => 'Select Content Type',
                'content_body_2' => 'Body',
                'content_image_2' => 'Image'
              ) )
              ->set_conditional_logic( array(
                array(
                  'field' => 'content_block_layout',
                  'value' => 'content_block_grid'
                ),
                array(
                  'field' => 'content_block_grid_layout',
                  'value' => '1up',
                  'compare' => 'EXCLUDES'
                ),
              ) 
            ),
            // GRID - COL TWO - EDITOR - CONTENT BLOCK: GRID --------------------------// 
            Field::make( 'rich_text', 'content_block_grid_body_2', __( 'Body' ) )
              ->set_conditional_logic( 
                array(
                  array(
                    'field' => 'grid_block_2',
                    'value' => 'content_body_2'
                  ),
                  array(
                    'field' => 'content_block_grid_layout',
                    'value' => '1up',
                    'compare' => 'EXCLUDES'
                  ),
                  array(
                    'field' => 'content_block_layout',
                    'value' => 'content_block_grid'
                  ),
                )
              ),
          // GRID - COL TWO - IMAGE - CONTENT BLOCK: GRID ---------------------------// 
          Field::make( 'image', 'content_block_grid_file_2', __( 'Image' ) )
            ->set_conditional_logic( 
              array(
                array(
                  'field' => 'grid_block_2',
                  'value' => 'content_image_2'
                ),
                 array(
                  'field' => 'content_block_grid_layout',
                  'value' => '1up',
                  'compare' => 'EXCLUDES'
                ),
                 array(
                  'field' => 'content_block_layout',
                  'value' => 'content_block_grid'
                ),
              )
            ),
          // GRID - COL THREE - SELECT TYPE - CONTENT BLOCK: GRID ---------------------------// 
          Field::make( 'select', 'grid_block_3', __( 'Grid Block (Column 3)' ) )
            ->set_options( array(
              '' => 'Select Content Type',
              'content_body_3' => 'Body',
              'content_image_3' => 'Image'
            ) )
            ->set_conditional_logic( array(
              array(
                'field' => 'content_block_layout',
                'value' => 'content_block_grid'
              ),
              array(
                'field' => 'content_block_grid_layout',
                'value' => '3up'
              ),
            ) 
          ),
            // GRID - COL THREE - EDITOR - CONTENT BLOCK: GRID --------------------------// 
          Field::make( 'rich_text', 'content_block_grid_body_3', __( 'Body' ) )
            ->set_conditional_logic( 
              array(
                array(
                  'field' => 'grid_block_3',
                  'value' => 'content_body_3'
                ),
                 array(
                  'field' => 'content_block_grid_layout',
                  'value' => '3up'
                ),
                 array(
                  'field' => 'content_block_layout',
                  'value' => 'content_block_grid'
                ),
              )
            ),
          // GRID - COL THREE - IMAGE - CONTENT BLOCK: GRID ---------------------------// 
          Field::make( 'image', 'content_block_grid_file_3', __( 'Image' ) )
            ->set_conditional_logic( 
              array(
                array(
                  'field' => 'grid_block_3',
                  'value' => 'content_image_3'
                ),
                 array(
                  'field' => 'content_block_grid_layout',
                  'value' => '3up'
                ),
                 array(
                  'field' => 'content_block_layout',
                  'value' => 'content_block_grid'
                ),
              )
            ),
          // GRID - IMAGE LAYOUT - CONTENT BLOCK: IMAGE ---------------------------// 
          Field::make( 'select', 'content_block_image_layout', __( 'Image Layout' ) )
            ->set_options( array(
              'full_width' => 'Full Width',
              'breakout' => 'Breakout',
              'breakout_parallax' => 'Breakout with Parallax'
            ) )
            ->set_default_value( 'full_width' )
            ->set_conditional_logic( 
              array(
                array(
                  'field' => 'content_block_layout',
                  'value' => 'content_block_image'
                )
              )
            )
            ->set_width( 50 ),
          // GRID - IMAGE FILE - CONTENT BLOCK: IMAGE ---------------------------//  
          Field::make( 'image', 'content_block_image_file', __( 'Image' ) )
            ->set_conditional_logic( 
              array(
                array(
                  'field' => 'content_block_layout',
                  'value' => 'content_block_image'
                )
              )
            ),
        ) ),
        
    ) );
}


add_action( 'carbon_fields_register_fields', 'crb_attach_related_pages' );
// SINGLE TEMPLATE - STRUCTURED CONTENT =====================================
function crb_attach_related_pages() {
  Container::make( 'post_meta', 'ALPS: Related Pages' )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'template-landing-page.php' )
    ->add_fields( array(
      Field::make( 'radio', 'related', __( 'Related Pages Format' ) )
        ->set_help_text( 'Select the format of the related pages.' )
        ->add_options( array(
          'related_top_level' => 'Show first level child pages only',
          'related_all' => 'Show child and grandchild pages',
          'related_custom' => 'Show custom pages'
        ) 
      ),
      Field::make( 'association', 'related_custom_value', __( 'Assign Pages' ) )
        ->set_types( array(
          array(
            'type' => 'post',
            'post_type' => 'page',
          )
        ) )
        ->set_conditional_logic( 
          array(
            array(
              'field' => 'related',
              'value' => 'related_custom'
            )
          )
        ),
       Field::make( 'checkbox', 'make_the_image_round', __( 'Make the Image Round' ) )
            ->set_option_value( 'true' )
            ->set_help_text( __( 'To make the image round, check this box.' ) )
    ) );
}





