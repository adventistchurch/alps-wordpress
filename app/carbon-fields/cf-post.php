<?php

use App\Core\ALPSPostPage;
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
                ->set_width(33),
            Field
                ::make('separator', 'crb_hide_img', __('Hide Featured Image', 'alps'))
                ->set_width(33),
            Field
                ::make('separator', 'crb_show_related_stories', __('Show related stories on Post', 'alps'))
                ->set_width(33),
            Field
                ::make('checkbox', 'hide_sidebar', __('Hide Sidebar', 'alps'))
                ->set_help_text(__('Hides the sidebar for this entry if it is active.', 'alps'))
                ->set_option_value('true')
                ->set_width(33),
            Field
                ::make('checkbox', 'hide_featured_image', __('Hide Featured Image', 'alps'))
                ->set_help_text(__('Hides the featured image on the page/post header for this entry.', 'alps'))
                ->set_option_value('true')
                ->set_width(33),
            Field
                ::make('checkbox', 'display_related_stories', __('Show related stories on Post', 'alps'))
                ->set_help_text(__('Hide (default option and managed in theme settings) / show Related Stories on the Post Page.', 'alps'))
                ->set_option_value('false')
                ->set_conditional_logic([[
                    'field' => !ALPSPostPage::HideRelatedStories(),
                    'value' => false,
                    'compare' => '='
                ]])
                ->set_width(33),
            Field
                ::make('html', 'display_relates_stories_inactive')
                ->set_html(__('<p style="font-size:13px; margin-top: 0;">This feature is enabled. <br> To activate the feature, enable the option <u><i>"Hide Related Stories on Post page"</i></u> in the theme settings.</p>', 'alps'))
                ->set_conditional_logic([[
                    'field' => ALPSPostPage::HideRelatedStories(),
                    'value' => false,
                    'compare' => '='
                ]])
                ->set_width(33),
        ]);
}
