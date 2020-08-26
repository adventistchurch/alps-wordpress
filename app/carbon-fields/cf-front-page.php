<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_front_page_fields');
function crb_attach_front_page_fields()
{
    Container
        ::make('post_meta', __('ALPS: Home - Row Block', 'alps'))
        ->where('post_type', '=', 'page')
        ->where('post_template', '=', 'template-home.php')
        ->add_fields([
            Field
                ::make('checkbox', 'grid_two_columns', __('Two Column Block?', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('To display the block in two columns, check this box.', 'alps')),
            Field
                ::make('radio', 'content_block', __('Content Block Type', 'alps'))
                ->add_options([
                    'false' => __('None', 'alps'),
                    'freeform' => __('Freeform Content Block', 'alps'),
                    'relationship' => __('Relationship Content Block', 'alps'),
                ])
                ->set_help_text(__('Choose your content type for this block.', 'alps'))
                ->set_default_value('false'),
            Field
                ::make('complex', 'content_block_freeform', __('Freeform Content Block', 'alps'))
                ->add_fields([
                    Field
                        ::make('color', 'content_block_freeform_colorpicker', __('Color Picker', 'alps')),
                    Field
                        ::make('text', 'content_block_freeform_kicker', __('Kicker', 'alps'))
                        ->set_width(25),
                    Field
                        ::make('text', 'content_block_freeform_title', __('Title', 'alps'))
                        ->set_width(75),
                    Field
                        ::make('image', 'content_block_freeform_image', __('Image', 'alps'))
                        ->set_width(25),
                    Field
                        ::make('checkbox', 'content_block_freeform_round', __('Make the Image Round', 'alps'))
                        ->set_option_value('true')
                        ->set_help_text(__('To make the image round, check this box.', 'alps'))
                        ->set_width(75),
                    Field
                        ::make('rich_text', 'content_block_freeform_body', __('Body', 'alps')),
                    Field
                        ::make('text', 'content_block_freeform_button_text', __('Button Text', 'alps'))
                        ->set_width(50),
                    Field
                        ::make('text', 'content_block_freeform_button_url', __('Button URL', 'alps'))
                        ->set_width(50)
                ])
                ->set_conditional_logic([
                    [
                        'field' => 'content_block',
                        'value' => 'freeform'
                    ]
                ]),
            Field
                ::make('association', 'content_block_relationship', __('Relationship Content Block', 'alps'))
                ->set_types([
                    [
                        'type' => 'post',
                        'post_type' => 'page'
                    ],
                    [
                        'type' => 'post',
                        'post_type' => 'post'
                    ]
                ])
                ->set_conditional_logic([
                    [
                        'field' => 'content_block',
                        'value' => 'relationship'
                    ]
                ]),
        ]);

    Container
        ::make('post_meta', __('ALPS: Home - Story Block', 'alps'))
        ->where('post_type', '=', 'page')
        ->where('post_template', '=', 'template-home.php')
        ->add_fields([
            Field
                ::make('text', 'sb_title', __('Title', 'alps'))
                ->set_width(50),
            Field
                ::make('text', 'sb_subtitle', __('Subtitle', 'alps'))
                ->set_width(50),
            Field
                ::make('image', 'sb_background_image', __('Background Image', 'alps'))
                ->set_help_text(__('Choose an image to display in the background (optional).', 'alps'))
                ->set_width(50),
            Field
                ::make('image', 'sb_thumbnail', __('Thumbnail', 'alps'))
                ->set_help_text(__('Image to appear in the top left area of the block.', 'alps'))
                ->set_width(50),
            Field
                ::make('image', 'sb_side_image', __('Side Image', 'alps'))
                ->set_help_text(__('Optionally include an image with the body copy. If this is a video thumbnail, check the "Side Image Video" box.', 'alps'))
                ->set_width(50),
            Field
                ::make('checkbox', 'is_video', __('Side Image - Video?', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('If the side image is a video thumbnail, check this box.', 'alps'))
                ->set_width(50),
            Field
                ::make('rich_text', 'sb_body', __('Body', 'alps')),
            // The data retrieved from a Rich Text field will generally need to be manually filtered
            // to display properly. Simply echoing the field will lead to improperly formatted paragraphs.
            // echo wpautop( carbon_get_the_post_meta('sb_body') );
            // echo apply_filters( 'the_content', carbon_get_the_post_meta( 'sb_body' ) );
            Field
                ::make('text', 'sb_url', __('URL', 'alps'))
                ->set_width(50),
            Field
                ::make('text', 'sb_cta', __('Call to Action Text', 'alps'))
                ->set_width(50),
        ]);
}
