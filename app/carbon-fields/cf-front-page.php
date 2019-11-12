<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_front_page_fields');
function crb_attach_front_page_fields()
{
  Container::make('post_meta', 'ALPS: Home - Row Block')->where('post_type', '=', 'page')->where('post_template', '=', 'template-home.php')->add_fields(array(
    Field::make('checkbox', 'grid_two_columns', __('Two Column Block?'))->set_option_value('true')->set_help_text(__('To display the block in two columns, check this box.')),
    Field::make('radio', 'content_block', 'Content Block Type')->add_options(array(
      'false' => 'None',
      'freeform' => 'Freeform Content Block ',
      'relationship' => 'Relationship Content Block'
    ))->set_help_text(__('Choose your content type for this block.'))->set_default_value('false'),
    Field::make('complex', 'content_block_freeform', __('Freeform Content Block'))->add_fields(array(
      Field::make('color', 'content_block_freeform_colorpicker', 'Color Picker'),
      Field::make('text', 'content_block_freeform_kicker', __('Kicker'))->set_width(25),
      Field::make('text', 'content_block_freeform_title', __('Title'))->set_width(75),
      Field::make('image', 'content_block_freeform_image', __('Image'))->set_width(25),
      Field::make('checkbox', 'content_block_freeform_round', __('Make the Image Round'))->set_option_value('true')->set_help_text(__('To make the image round, check this box.'))->set_width(75),
      Field::make('rich_text', 'content_block_freeform_body', __('Body')),
      Field::make('text', 'content_block_freeform_button_text', __('Button Text'))->set_width(50),
      Field::make('text', 'content_block_freeform_button_url', __('Button URL'))->set_width(50)
    ))->set_conditional_logic(array(
      array(
        'field' => 'content_block',
        'value' => 'freeform'
      )
    )),
    Field::make('association', 'content_block_relationship', __('Relationship Content Block'))->set_types(array(
      array(
        'type' => 'post',
        'post_type' => 'page'
      ),
      array(
        'type' => 'post',
        'post_type' => 'post'
      )
    ))->set_conditional_logic(array(
      array(
        'field' => 'content_block',
        'value' => 'relationship'
      )
    ))
  ));
  Container::make('post_meta', 'ALPS: Home - Story Block')->where('post_type', '=', 'page')->where('post_template', '=', 'template-home.php')->add_fields(array(
    Field::make('text', 'sb_title', __('Title'))->set_width(50),
    Field::make('text', 'sb_subtitle', __('Subtitle'))->set_width(50),
    Field::make('image', 'sb_background_image', __('Background Image'))->set_help_text(__('Choose an image to display in the background (optional).'))->set_width(50),
    Field::make('image', 'sb_thumbnail', __('Thumbnail'))->set_help_text(__('Image to appear in the top left area of the block.'))->set_width(50),
    Field::make('image', 'sb_side_image', __('Side Image'))->set_help_text(__('Optionally include an image with the body copy. If this is a video thumbnail, check the "Side Image Video" box.'))->set_width(50),
    Field::make('checkbox', 'is_video', __('Side Image - Video?'))->set_option_value('true')->set_help_text(__('If the side image is a video thumbnail, check this box.'))->set_width(50),
    Field::make('rich_text', 'sb_body', __('Body')),
    // The data retrieved from a Rich Text field will generally need to be manually filtered
    // to display properly. Simply echoing the field will lead to improperly formatted paragraphs.
    // echo wpautop( carbon_get_the_post_meta('sb_body') );
    // echo apply_filters( 'the_content', carbon_get_the_post_meta( 'sb_body' ) );
    Field::make('text', 'sb_url', __('URL'))->set_width(50),
    Field::make('text', 'sb_cta', __('Call to Action Text'))->set_width(50)
  ));
}