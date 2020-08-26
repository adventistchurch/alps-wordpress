<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_post_hero_featured');
function crb_post_hero_featured()
{
    Container
        ::make('post_meta', __('ALPS: Featured Image Hero Layout', 'alps'))
        ->where('post_type', '=', 'post')
        ->set_context('side')
        ->set_priority('low')
        ->add_fields([
            Field
                ::make('radio', 'featured_image_hero_layout', __('Feature Image Hero Layout', 'alps'))
                ->set_help_text(__('If a featured image is set, select the layout of the hero.', 'alps'))
                ->add_options([
                    'hero_layout_1_3' => __('Text Width: 1/3 and Image Width: 2/3', 'alps'),
                    'hero_layout_3_3' => __('Text Width: 1/2 and Image Width: 1/2', 'alps'),
                ]),
        ]);
}

add_action('carbon_fields_register_fields', 'crb_attach_post_template_fields');
function crb_attach_post_template_fields()
{
    Container
        ::make('post_meta', __('ALPS: Entry Sidebar / Featured Image', 'alps'))
        ->where('post_type', '=', 'post')
        ->add_fields([
            Field
                ::make('separator', 'crb_hide_sidebar', __('Hide Sidebar', 'alps'))
                ->set_width(50),
            Field
                ::make('separator', 'crb_hide_img', __('Hide Featured Image', 'alps'))
                ->set_width(50),
            Field
                ::make('checkbox', 'hide_sidebar', __('Hide Sidebar', 'alps'))
                ->set_help_text(__('Hides the sidebar for this entry if it is active.', 'alps'))
                ->set_option_value('true')
                ->set_width(50),
            Field
                ::make('checkbox', 'hide_featured_image', __('Hide Featured Image', 'alps'))
                ->set_help_text(__('Hides the featured image on the page/post header for this entry.', 'alps'))
                ->set_option_value('true')
                ->set_width(50),
        ]);
}
