<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_header');
function crb_attach_header()
{
    Container::make('post_meta', 'ALPS: Header Banner')->where('post_type', '=', 'page')->add_fields(array(
    Field::make('separator', 'crb_long_header', __('Banner'))->set_help_text(__('IMPORTANT: Setting the Header Banner will override the display of the Featured Image.')),
    Field::make('text', 'display_title', __('Header Title')),
    Field::make('text', 'kicker', __('Header Kicker')),
    Field::make('text', 'long_header_subtitle', __('Header Subtitle')),
    Field::make('image', 'header_background_image', __('Header Image'))
  ));
}

add_action('carbon_fields_register_fields', 'crb_attach_hero');
function crb_attach_hero()
{
    Container
        ::make('post_meta', 'ALPS: Hero')
        ->where('post_type', '=', 'page')
        ->where('post_template', '!=', 'views/template-posts.blade.php')
        ->add_fields([
            Field
                ::make('separator', 'crb_hero_banner', __('Hero Banner'))
                ->set_help_text(__('IMPORTANT: Setting a hero style below will completely override anything you have entered for your ALPS Header Banner or your Featured Image.')),
            Field
                ::make('radio', 'hero_type', __('Hero Style'))
                ->set_help_text('Select the hero configuration.')
                ->add_options([
                      'false'   => 'None',
                      'default' => 'Half screen image with text overlay (Min/Max Images: 1)',
                      'full'    => 'Full screen image with text overlay (Min/Max Images: 1)',
                      'column'  => 'Three column image format with text overlays (Min/Max Images: 3)',
                      'carousel' => 'Half screen image gallery with text overlay (Max Images: 6)'
                ]),
            Field
                ::make('image', 'hero_image', __('Hero Image'))
                ->set_conditional_logic([
                    'relation' => 'OR', // Optional, defaults to "AND"
                    [
                        'field' => 'hero_type',
                        'value' => 'default'
                    ],
                    [
                        'field' => 'hero_type',
                        'value' => 'full'
                    ]
                ]),
            Field
                ::make('textarea', 'hero_title', __('Hero Title'))
                ->set_help_text(__('The title of the hero image.'))
                ->set_rows(2)
                ->set_width(50)
                ->set_conditional_logic([
                    'relation' => 'OR', // Optional, defaults to "AND"
                    [
                        'field' => 'hero_type',
                        'value' => 'default'
                    ],
                    [
                        'field' => 'hero_type',
                        'value' => 'full'
                    ]
                ]),
            Field
                ::make('text', 'hero_kicker', __('Hero Kicker'))
                ->set_help_text(__('Displays below the title in the hero image.'))
                ->set_width(50)
                ->set_conditional_logic([
                    'relation' => 'OR', // Optional, defaults to "AND"
                    [
                        'field' => 'hero_type',
                        'value' => 'default'
                    ],
                    [
                        'field' => 'hero_type',
                        'value' => 'full'
                    ]
                ]),
            Field
                ::make('text', 'hero_link_url', __('Hero Link URL'))
                ->set_help_text(__('Enter an URL to link the hero image.'))
                ->set_conditional_logic([
                    'relation' => 'OR', // Optional, defaults to "AND"
                    [
                        'field' => 'hero_type',
                        'value' => 'default'
                    ],
                    [
                        'field' => 'hero_type',
                        'value' => 'full'
                    ]
                ]),
            Field
                ::make('checkbox', 'hero_image_extended', __('Hero Image Extended'))
                ->set_option_value('true')
                ->set_help_text('Check to extend the hero image over the sabbath column.')
                ->set_width(50)
                ->set_conditional_logic([
                    'relation' => 'OR', // Optional, defaults to "AND"
                    [
                        'field' => 'hero_type',
                        'value' => 'default'
                    ],
                    [
                        'field' => 'hero_type',
                        'value' => 'full'
                    ]
                ]),
            Field
                ::make('checkbox', 'hero_scroll_hint', __('Hero Scroll Hint'))
                ->set_option_value('true')
                ->set_help_text('Check to extend the hero image over the sabbath column.')
                ->set_width(50)
                ->set_conditional_logic([
                    [
                        'field' => 'hero_type',
                        'value' => 'full'
                    ]
                ]),

            Field
                ::make('complex', 'hero_column', __('Hero Column (3 Columns)'))
                ->set_conditional_logic([
                    [
                        'field' => 'hero_type',
                        'value' => 'column'
                    ]
                ])
                ->add_fields([
                    Field
                        ::make('image', 'hero_image_column', __('Hero Image')),
                    Field
                        ::make('textarea', 'hero_title_column', __('Hero Title'))
                        ->set_help_text(__('The title of the hero image.'))
                        ->set_rows(2)
                        ->set_width(50),
                    Field
                        ::make('text', 'hero_kicker_column', __('Hero Kicker'))
                        ->set_help_text(__('Displays below the title in the hero image.'))
                        ->set_width(50),
                    Field
                        ::make('text', 'hero_link_url', __('Hero Link URL'))
                        ->set_help_text(__('Enter an URL to link the hero image.'))
                ])
                ->set_min(3)
                ->set_max(3),
            Field
                ::make('complex', 'hero_carousel', __('Hero Carousel'))
                ->set_conditional_logic([
                    [
                        'field' => 'hero_type',
                        'value' => 'carousel'
                    ]
                ])
                // Field names refers to https://github.com/adventistchurch/alps/blob/v3.x/source/_patterns/02-organisms/sections/hero-carousel.json
                ->add_fields([
                    Field
                        ::make('image', 'slide_image', __('Hero Image')),
                    Field
                        ::make('text', 'slide_heading', __('Hero Title'))
                        ->set_help_text(__('The title of the hero image slide.'))
                        ->set_width(50),
                    Field
                        ::make('text', 'slide_subtitle', __('Hero Kicker'))
                        ->set_help_text(__('Displays below the title in the hero image slide.'))
                        ->set_width(50),
                    Field
                        ::make('textarea', 'slide_dek', __('Hero Description'))
                        ->set_help_text(__('Displays below the sub title in the hero image slide.'))
                        ->set_width(100),
                    Field
                        ::make('text', 'slide_url', __('Hero Link URL'))
                        ->set_help_text(__('Enter an URL to link the hero image slide.'))
                        ->set_width(50),
                    Field
                        ::make('text', 'slide_cta', __('Hero Link CTA'))
                        ->set_help_text(__('Displays title in the hero link.'))
                        ->set_width(50),
                ])
                ->set_min(1)
                ->set_max(6)
        ]);
}

add_action('carbon_fields_register_fields', 'crb_attach_page_template_fields');
function crb_attach_page_template_fields()
{
    Container::make('post_meta', 'ALPS: Entry Sidebar / Featured Image')->where('post_type', '=', 'page')->add_fields(array(
    Field::make('separator', 'crb_hide_sidebar', __('Hide Sidebar'))->set_width(50),
    Field::make('separator', 'crb_hide_img', __('Hide Featured Image'))->set_width(50),
    Field::make('checkbox', 'hide_sidebar', __('Hide Sidebar'))->set_help_text(__('Hides the sidebar for this entry if it is active.'))->set_option_value('true')->set_width(50),
    Field::make('checkbox', 'hide_featured_image', __('Hide Featured Image'))->set_help_text(__('Hides the featured image on the page/post header for this entry.'))->set_option_value('true')->set_width(50)
  ));
}

add_action('carbon_fields_register_fields', 'crb_attach_related_pages');
function crb_attach_related_pages()
{
    Container::make('post_meta', 'ALPS: Related Pages & Posts')->where('post_type', '=', 'page')->where('post_template', '!=', 'views/template-posts.blade.php')->add_fields(array(
    Field::make('radio', 'related', __('Related Pages Format'))->set_help_text('Select the format of the related pages.')->add_options(array(
      'false' => 'None',
      'related_top_level' => 'Show first level child pages only',
      'related_all' => 'Show child and grandchild pages',
      'related_custom' => 'Show custom pages'
    )),
    Field::make('association', 'related_custom_value', __('Assign Pages'))->set_types(array(
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
        'field' => 'related',
        'value' => 'related_custom'
      )
    )),
    Field::make('checkbox', 'related_grid', __('Related Pages Grid'))->set_option_value('true')->set_help_text(__('Select to display the related pages side-by-side.')),
    Field::make('checkbox', 'related_grid_3up', __('Related Pages Grid (3up)'))->set_option_value('true')->set_help_text(__('Select to display the related pages in 3 columns on large screens. This will only display if the Sabbath column is hidden.'))->set_conditional_logic(array(
      array(
        'field' => 'related_grid',
        'value' => true
      )
    )),
    Field::make('checkbox', 'related_image', __('Related Pages Image'))->set_option_value('true')->set_help_text(__('Select to display the feature image for the related pages.')),
    Field::make('checkbox', 'related_image_round', __('Related Pages Round Image'))->set_option_value('true')->set_help_text(__('Select to make the featured image round.'))->set_conditional_logic(array(
      'relation' => 'AND',
      array(
        'field' => 'related_image',
        'value' => true
      ),
      array(
        'field' => 'related_grid',
        'value' => false
      )
    ))
  ));
}

add_action('carbon_fields_register_fields', 'crb_post_in_banner');
function crb_post_in_banner()
{
    Container::make('post_meta', 'ALPS: Hero Featured Post')->where('post_type', '=', 'page')->where('post_template', '=', 'views/template-posts.blade.php')->add_fields(array(
    Field::make('separator', 'crb_fpost_banner', __('Hero: Show Featured Post')),
    Field::make('checkbox', 'show_hero_featured_post', __('Select to display a featured post in the hero.'))->set_option_value('true'),
    Field::make('association', 'hero_featured_post', __('Select - Hero Featured Post'))->set_conditional_logic(array(
      array(
        'field' => 'show_hero_featured_post',
        'value' => true
      )
    ))->set_types(array(
      array(
        'type' => 'post',
        'post_type' => 'post'
      )
    ))->set_max(1)
  ));
}

// POST FEED - LIST ------------------------------------------------
add_action('carbon_fields_register_fields', 'crb_post_feed_list');
function crb_post_feed_list()
{
    Container::make('post_meta', 'ALPS: Post Feed List')->where('post_type', '=', 'page')->where('post_template', '=', 'views/template-posts.blade.php')->add_fields(array(
    Field::make('separator', 'crb_feed_list_banner', __('Post Feed - List')),
    Field::make('radio', 'post_feed_list', __('Post Feed: List'))->set_help_text('Displays as a list of posts.')->add_options(array(
      'post_feed_list_false' => 'None',
      'post_feed_list_category' => 'Select a category of posts to feature.',
      'post_feed_list_custom' => 'Select specific posts to feature.'
    )),
    Field::make('separator', 'crb_feed_list_cat_sep', __('Select Post Category'))->set_conditional_logic(array(
      array(
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )),
    Field::make('separator', 'crb_feed_list_pick_sep', __('Select Specific Posts'))->set_conditional_logic(array(
      array(
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_custom'
      )
    )),
    // NEXT THREE FIELDS ARE SHOWN FOR BOTH
    Field::make('text', 'post_feed_list_title', __('Section Title'))->set_help_text(__('Enter the title for this featured posts section.'))->set_width(50)->set_conditional_logic(array(
      'relation' => 'AND',
      array(
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_false',
        'compare' => 'EXCLUDES'
      )
    )),
    Field::make('text', 'post_feed_list_link', __('Section Link'))->set_help_text(__('Enter the link to the posts archive page.'))->set_width(50)->set_conditional_logic(array(
      'relation' => 'AND',
      array(
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_false',
        'compare' => 'EXCLUDES'
      )
    )),
    Field::make('checkbox', 'post_feed_list_round_image', __('Round Image Thumbnail'))->set_help_text(__('Check to make the image thumbnail round.'))->set_option_value('true')->set_conditional_logic(array(
      'relation' => 'AND',
      array(
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_false',
        'compare' => 'EXCLUDES'
      )
    )),
    // ONLY CATEGORY FIELDS FOLLOW WITH SPECIFIC / SELECTED ONES TO FOLLOW THIS
    Field::make('association', 'post_feed_list_category_array', __('Select - Category'))->set_help_text(__('Click on the category you want to select on the left and it will be selected on the right side. You can only select one category.'))->set_types(array(
      array(
        'type' => 'term',
        'taxonomy' => 'category'
      )
    ))->set_max(1)->set_conditional_logic(array(
      array(
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )),
    Field::make('text', 'post_feed_list_count', __('Number of Posts'))->set_help_text(__('Enter the number of posts you would like to display. (If empty, defaults to 3 posts in the selected category)'))->set_width(50)->set_conditional_logic(array(
      array(
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )),
    Field::make('text', 'post_feed_list_offset', __('Post Offset'))->set_help_text(__('Enter the number of posts you would like to offset.'))->set_width(50)->set_conditional_logic(array(
      array(
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_category'
      )
    )),
    // ONLY SPECIFIC / SELECTED POSTS
    Field::make('association', 'post_feed_list_custom_array', __('Select - Custom Posts'))->set_help_text(__('Click on the posts you want to select on the left and they will be selected on the right side.'))->set_types(array(
      array(
        'type' => 'post',
        'post_type' => 'post'
      )
    ))->set_conditional_logic(array(
      array(
        'field' => 'post_feed_list',
        'value' => 'post_feed_list_custom'
      )
    ))
  ));
}

// POST FEED - FULL ------------------------------------------------
add_action('carbon_fields_register_fields', 'crb_post_feed_full');
function crb_post_feed_full()
{
    Container::make('post_meta', 'ALPS: Post Feed - Full Width')->where('post_type', '=', 'page')->where('post_template', '=', 'views/template-posts.blade.php')->add_fields(array(
    Field::make('separator', 'crb_feed_list_banner', __('Post Feed - Full Width')),
    Field::make('radio', 'post_feed_full', __('Post Feed: Full Width'))->set_help_text('Displays as a list of posts.')->add_options(array(
      'post_feed_full_false' => 'None',
      'post_feed_full_category' => 'Select a category of posts to feature.'
    )),
    Field::make('separator', 'crb_feed_full_cat_sep', __('Select Post Category'))->set_conditional_logic(array(
      array(
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    )),
    // NEXT THREE FIELDS ARE SHOWN FOR BOTH
    Field::make('text', 'post_feed_full_title', __('Section Title'))->set_help_text(__('Enter the title for this featured posts section.'))->set_width(50)->set_conditional_logic(array(
      'relation' => 'AND',
      array(
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    )),
    Field::make('text', 'post_feed_full_link', __('Section Link'))->set_help_text(__('Enter the link to the posts archive page.'))->set_width(50)->set_conditional_logic(array(
      'relation' => 'AND',
      array(
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    )),
    Field::make('checkbox', 'post_feed_full_featured', __('Full Width Featured Post'))->set_help_text(__('Select to include a post full width.'))->set_option_value('post_feed_full_featured_true')->set_conditional_logic(array(
      'relation' => 'AND',
      array(
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    )),
    Field::make('association', 'post_feed_full_featured_array', __('Featured Post'))->set_help_text(__('Select (1) post to feature as a full width post.'))->set_types(array(
      array(
        'type' => 'post',
        'post_type' => 'post'
      )
    ))->set_max(1)->set_conditional_logic(array(
      array(
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      ),
      array(
        'field' => 'post_feed_full_featured',
        'value' => true
      )
    )),
    Field::make('text', 'post_feed_full_offset', __('Post Offset'))->set_help_text(__('Enter the number of posts you would like to offset.'))->set_width(50)->set_conditional_logic(array(
      array(
        'field' => 'post_feed_full',
        'value' => 'post_feed_list_category'
      )
    )),
    Field::make('association', 'post_feed_full_category_array', __('Select - Category'))->set_help_text(__('Click on the category you want to select on the left and it will be selected on the right side. You can only select one category.'))->set_types(array(
      array(
        'type' => 'term',
        'taxonomy' => 'category'
      )
    ))->set_max(1)->set_conditional_logic(array(
      array(
        'field' => 'post_feed_full',
        'value' => 'post_feed_full_category'
      )
    ))
  ));
}

// POST FEED - ARCHIVE ------------------------------------------------
add_action('carbon_fields_register_fields', 'crb_post_feed_archive');
function crb_post_feed_archive()
{
    Container::make('post_meta', 'ALPS: Post Feed Archive')->where('post_type', '=', 'page')->where('post_template', '=', 'views/template-posts.blade.php')->add_fields(array(
    Field::make('separator', 'crb_feed_archive_banner', __('Post Feed - Archive')),
    Field::make('radio', 'post_feed_archive', __('Post Feed: Archive'))->set_help_text('Displays as a list of posts.')->add_options(array(
      'post_feed_archive_false' => 'None',
      'post_feed_archive_category' => 'Select a category of posts to feature.'
    )),
    Field::make('separator', 'crb_feed_archive_cat_sep', __('Select Post Category'))->set_conditional_logic(array(
      array(
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive'
      )
    )),
    Field::make('text', 'post_feed_archive_title', __('Section Title'))->set_help_text(__('Enter the title for this featured posts section.'))->set_width(50)->set_conditional_logic(array(
      'relation' => 'AND',
      array(
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive_category'
      )
    )),
    Field::make('text', 'post_feed_archive_link', __('Section Link'))->set_help_text(__('Enter the link to the posts archive page.'))->set_width(50)->set_conditional_logic(array(
      'relation' => 'AND',
      array(
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive_category'
      )
    )),
    Field::make('text', 'post_feed_archive_offset', __('Post Offset'))->set_help_text(__('Enter the number of posts you would like to offset.'))->set_width(50)->set_conditional_logic(array(
      array(
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive_category'
      )
    )),
    Field::make('association', 'post_feed_archive_category_array', __('Select - Category'))->set_help_text(__('Click on the category you want to select on the left and it will be selected on the right side. You can only select one category.'))->set_types(array(
      array(
        'type' => 'term',
        'taxonomy' => 'category'
      )
    ))->set_max(1)->set_conditional_logic(array(
      array(
        'field' => 'post_feed_archive',
        'value' => 'post_feed_archive_category'
      )
    ))
  ));
}
