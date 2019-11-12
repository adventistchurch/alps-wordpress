<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_post_hero_featured');
function crb_post_hero_featured()
{
  Container::make('post_meta', 'ALPS: Featured Image Hero Layout')->where('post_type', '=', 'post')->set_context('side')->set_priority('low')->add_fields(array(
    Field::make('radio', 'featured_image_hero_layout', __('Feature Image Hero Layout'))->set_help_text('If a featured image is set, select the layout of the hero.')->add_options(array(
      'hero_layout_1_3' => 'Text Width: 1/3 and Image Width: 2/3',
      'hero_layout_3_3' => 'Text Width: 1/2 and Image Width: 1/2'
    ))
  ));
}

add_action('carbon_fields_register_fields', 'crb_attach_post_template_fields');
function crb_attach_post_template_fields()
{
  Container::make('post_meta', 'ALPS: Entry Sidebar / Featured Image')->where('post_type', '=', 'post')->add_fields(array(
    Field::make('separator', 'crb_hide_sidebar', __('Hide Sidebar'))->set_width(50),
    Field::make('separator', 'crb_hide_img', __('Hide Featured Image'))->set_width(50),
    Field::make('checkbox', 'hide_sidebar', __('Hide Sidebar'))->set_help_text(__('Hides the sidebar for this entry if it is active.'))->set_option_value('true')->set_width(50),
    Field::make('checkbox', 'hide_featured_image', __('Hide Featured Image'))->set_help_text(__('Hides the featured image on the page/post header for this entry.'))->set_option_value('true')->set_width(50)
  ));
}

add_action('carbon_fields_register_fields', 'crb_hide_dropcap');
function crb_hide_dropcap()
{
  Container::make('post_meta', 'ALPS: Hide Dropcap')->where('post_type', '=', 'post')->set_context('side')->set_priority('low')->add_fields(array(
    Field::make('checkbox', 'hide_dropcap', __('Hide the Dropcap'))->set_help_text('Hides the dropcap on main content.')->set_option_value('true')
  ));
}