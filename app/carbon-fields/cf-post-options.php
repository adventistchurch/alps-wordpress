<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function setDefaultHeader() {
    $default = false;
    if (!empty($_GET['post'])){
        $id = $_GET['post'];
        $value = get_post_meta($id,'_featured_image_hero_layout',true);
        if ($value == 'hero_layout_1_3' || $value == 'hero_layout_3_3'){
            update_post_meta( $id, '_featured_image_hero_layout', 'header-block-featured');
            $default = 'header-block-featured';
        }
    }else{
        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, 'post-new.php')){
            $default = 'header-block-featured';
        }
        if (strpos($uri, 'post_type=page')){
            $default = 'page-header';
        }
    }
    return $default;
}

function setDefaultRelatedImageCrop() {
    $default = 'square';
    if (!empty($_GET['post'])){
        $id = $_GET['post'];
        $grid = get_post_meta($id,'_related_grid',true);
        $oldCircle = get_post_meta($id,'_related_image_round',true);
        if (!empty($oldCircle)){
            $default = 'circle';
        }
        if (!empty($grid)){
            $default = 'landscape';
        }
    }
    return $default;
}

add_action('carbon_fields_register_fields', 'crb_page_options');
function crb_page_options()
{
	Container
		::make('post_meta', __('ALPS: Header and Page Builder Options', 'alps'))
		->add_fields([
			Field
				::make('separator', 'crb_page_options', __('Header and Page Builder Options', 'alps'))
				->set_help_text(__('Use these settings to alter header display and change content spacing if you intend to use a page builder.', 'alps')),
			Field
			::make('checkbox', 'remove_header', __('Remove Page Header', 'alps'))
				->set_help_text(__('Hides the page header for this entry.', 'alps'))
				->set_option_value('true')
				->set_width(33),
				Field
				::make('radio', 'featured_image_hero_layout', __('Display larger banner', 'alps'))
                ->set_help_text(__('Display feature image and text either a 50/50 hero or large image banner. Requires a feature image or custom image be set. This will override "Remove Page Header" setting.', 'alps'))
                ->set_default_value(setDefaultHeader())
                ->add_options([
                    'false' => __('Do not show larger banner.', 'alps'),
                    'header-block-featured' => __('Show larger banner as 50/50 hero with large image and text.', 'alps'),
                    'page-header' => __('Show larger image banner with text overlay.', 'alps')
                ])
                ->set_width(33),
			Field
			::make('checkbox', 'remove_spacing', __('Remove Default Spacing', 'alps'))
				->set_help_text(__('Removes classes that create default margins and padding for content area.', 'alps'))
				->set_option_value('true')
				->set_width(33),
			Field
			::make('select', 'head_type', __('Template Head Type', 'alps'))
			->set_help_text(__('Select the template header option.', 'alps'))
			->add_options([
				'default' => __('Default', 'alps'),
				'remove' => __('Remove Head', 'alps'),
				'overlay_gradient' => __('Overlay Head With Background Gradient', 'alps'),
				'overlay' => __('Overlay Head Without Gradient', 'alps')
			])
			->set_width(33),
		]);
}

add_action('carbon_fields_register_fields', 'crb_attach_header');
function crb_attach_header()
{
	Container
		::make('post_meta', __('ALPS: Header Banner', 'alps'))
		->add_fields([
			Field
				::make('separator', 'crb_long_header', __('Banner', 'alps'))
				->set_help_text(__('IMPORTANT: Setting an image and title below will override the post title and feature image .', 'alps')),
			Field
				::make('text', 'display_title', __('Header Title', 'alps')),
			Field
				::make('text', 'kicker', __('Header Kicker', 'alps')),
			Field
				::make('text', 'long_header_subtitle', __('Header Subtitle', 'alps')),
			Field
				::make('image', 'header_background_image', __('Custom Header Image (will override feature image)', 'alps'))
				->set_width(50),
		]);
}

add_action('carbon_fields_register_fields', 'crb_attach_hero');
function crb_attach_hero()
{
	Container
		::make('post_meta', __('ALPS: Hero', 'alps'))
		->where('post_template', '!=', 'views/template-posts.blade.php')
		->add_fields([
			Field
				::make('separator', 'crb_hero_banner', __('Hero Banner', 'alps'))
				->set_help_text(__('IMPORTANT: Setting a hero style below will completely override anything you have entered for your ALPS Header Banner or your Featured Image.', 'alps')),
			Field
				::make('radio', 'hero_type', __('Hero Style', 'alps'))
				->set_help_text(__('Select the hero configuration.', 'alps'))
				->add_options([
					'false' => __('None', 'alps'),
					'default' => __('Half screen image with text overlay (Min/Max Images: 1)', 'alps'),
					'full' => __('Full screen image with text overlay (Min/Max Images: 1)', 'alps'),
					'full_overlay' => __('Full screen image with text and header overlay (Min/Max Images: 1)', 'alps'),
					'column' => __('Three column image format with text overlays (Min/Max Images: 3)', 'alps'),
					'carousel' => __('Half screen image gallery with text overlay (Max Images: 6)', 'alps'),
				]),
			Field
				::make('image', 'hero_image', __('Hero Image', 'alps'))
				->set_conditional_logic([
					'relation' => 'OR', // Optional, defaults to "AND"
					[
						'field' => 'hero_type',
						'value' => 'default',
					],
					[
						'field' => 'hero_type',
						'value' => 'full',
					],
					[
						'field' => 'hero_type',
						'value' => 'full_overlay',
					]
				]),
			Field
				::make('textarea', 'hero_title', __('Hero Title', 'alps'))
				->set_help_text(__('The title of the hero image.', 'alps'))
				->set_rows(2)
				->set_width(50)
				->set_conditional_logic([
					'relation' => 'OR', // Optional, defaults to "AND"
					[
						'field' => 'hero_type',
						'value' => 'default',
					],
					[
						'field' => 'hero_type',
						'value' => 'full',
					],
					[
						'field' => 'hero_type',
						'value' => 'full_overlay',
					]
				]),
			Field
				::make('text', 'hero_kicker', __('Hero Kicker', 'alps'))
				->set_help_text(__('Displays below the title in the hero image.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					'relation' => 'OR', // Optional, defaults to "AND"
					[
						'field' => 'hero_type',
						'value' => 'default',
					],
					[
						'field' => 'hero_type',
						'value' => 'full',
					],
					[
						'field' => 'hero_type',
						'value' => 'full_overlay',
					]
				]),
			Field
				::make('text', 'hero_link_url', __('Hero Link URL', 'alps'))
				->set_help_text(__('Enter an URL to link the hero image.', 'alps'))
				->set_conditional_logic([
					'relation' => 'OR', // Optional, defaults to "AND"
					[
						'field' => 'hero_type',
						'value' => 'default',
					],
					[
						'field' => 'hero_type',
						'value' => 'full',
					],
					[
						'field' => 'hero_type',
						'value' => 'full_overlay',
					]
				]),
			Field
				::make('text', 'hero_link_button', __('Hero Link Button', 'alps'))
				->set_help_text(__('Enter text here to show on the hero button. Filling this out sets the link on the button and not the hero image.', 'alps'))
				->set_conditional_logic([
					'relation' => 'OR', // Optional, defaults to "AND"
					[
						'field' => 'hero_type',
						'value' => 'full',
					],
					[
						'field' => 'hero_type',
						'value' => 'full_overlay',
					]
				]),
			Field
				::make('checkbox', 'hero_image_extended', __('Hero Image Extended', 'alps'))
				->set_option_value('true')
				->set_help_text(__('Check to extend the hero image over the sabbath column.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					'relation' => 'OR', // Optional, defaults to "AND"
					[
						'field' => 'hero_type',
						'value' => 'default',
					],
					[
						'field' => 'hero_type',
						'value' => 'full',
					]
				]),
			Field
				::make('checkbox', 'hero_scroll_hint', __('Hero Scroll Hint', 'alps'))
				->set_option_value('true')
				->set_help_text(__('Check to extend the hero image over the sabbath column.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					[
						'field' => 'hero_type',
						'value' => 'full',
					]
				]),

			Field
				::make('complex', 'hero_column', __('Hero Column (3 Columns)', 'alps'))
				->set_conditional_logic([
					[
						'field' => 'hero_type',
						'value' => 'column',
					]
				])
				->add_fields([
					Field
						::make('image', 'hero_image_column', __('Hero Image', 'alps')),
					Field
						::make('textarea', 'hero_title_column', __('Hero Title', 'alps'))
						->set_help_text(__('The title of the hero image.', 'alps'))
						->set_rows(2)
						->set_width(50),
					Field
						::make('text', 'hero_kicker_column', __('Hero Kicker', 'alps'))
						->set_help_text(__('Displays below the title in the hero image.', 'alps'))
						->set_width(50),
					Field
						::make('text', 'hero_link_url', __('Hero Link URL', 'alps'))
						->set_help_text(__('Enter an URL to link the hero image.', 'alps'))
				])
				->set_min(3)
				->set_max(3),
			Field
				::make('complex', 'hero_carousel', __('Hero Carousel', 'alps'))
				->set_conditional_logic([
					[
						'field' => 'hero_type',
						'value' => 'carousel',
					]
				])
				// Field names refers to https://github.com/adventistchurch/alps/blob/v3.x/source/_patterns/02-organisms/sections/hero-carousel.json
				->add_fields([
					Field
						::make('image', 'slide_image', __('Hero Image', 'alps')),
					Field
						::make('text', 'slide_heading', __('Hero Title', 'alps'))
						->set_help_text(__('The title of the hero image slide.', 'alps'))
						->set_width(50),
					Field
						::make('textarea', 'slide_dek', __('Hero Description', 'alps'))
						->set_help_text(__('Displays below the sub title in the hero image slide.', 'alps'))
						->set_width(100),
					Field
						::make('text', 'slide_url', __('Hero Link URL', 'alps'))
						->set_help_text(__('Enter an URL to link the hero image slide.', 'alps'))
						->set_width(50),
					Field
						::make('text', 'slide_cta', __('Hero Link CTA', 'alps'))
						->set_help_text(__('Displays title in the hero link.', 'alps'))
						->set_width(50),
				])
				->set_min(1)
				->set_max(6)
		]);
}

add_action('carbon_fields_register_fields', 'crb_attach_page_template_fields');
function crb_attach_page_template_fields()
{
	Container
		::make('post_meta', __('ALPS: Entry Sidebar / Featured Image', 'alps'))
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

add_action('carbon_fields_register_fields', 'crb_attach_related_pages');
function crb_attach_related_pages()
{
	Container
		::make('post_meta', __('ALPS: Related Pages & Posts', 'alps'))
		->where('post_type', '=', 'page')
		->where('post_template', '!=', 'views/template-posts.blade.php')
		->add_fields([
			Field
				::make('radio', 'related', __('Related Pages Format', 'alps'))
				->set_help_text(__('Select the format of the related pages.', 'alps'))
				->add_options([
					'false' => __('None', 'alps'),
					'related_top_level' => __('Show first level child pages only', 'alps'),
					'related_all' => __('Show child and grandchild pages', 'alps'),
					'related_custom' => __('Show custom pages', 'alps'),
				]),
			Field
				::make('association', 'related_custom_value', __('Assign Pages', 'alps'))
				->set_types([
					[
						'type' => 'post',
						'post_type' => 'page',
					],
					[
						'type' => 'post',
						'post_type' => 'post',
					]
				])
				->set_conditional_logic([
					[
						'field' => 'related',
						'value' => 'related_custom',
					]
				]),
			Field
				::make('checkbox', 'related_grid', __('Related Pages Grid', 'alps'))
				->set_option_value('true')
				->set_help_text(__('Select to display the related pages side-by-side.', 'alps')),
			Field
				::make('checkbox', 'related_grid_3up', __('Related Pages Grid (3up)', 'alps'))
				->set_option_value('true')
				->set_help_text(__('Select to display the related pages in 3 columns on large screens. This will only display if the Sabbath column is hidden.', 'alps'))
				->set_conditional_logic([
					[
						'field' => 'related_grid',
						'value' => true,
					]
				]),
			Field
				::make('checkbox', 'related_image', __('Related Pages Image', 'alps'))
				->set_option_value('true')
				->set_help_text(__('Select to display the feature image for the related pages.', 'alps'))
                ->set_width(50),
            Field
                ::make('radio', 'related_image_crop', __('Related Page Image Cropping', 'alps'))
                ->add_options([
                    'square' => __('Square', 'alps'),
                    'landscape' => __('Landscape', 'alps'),
                    'portrait' => __('Portrait', 'alps'),
                    'circle' => __('Circle', 'alps'),
                ])
                ->set_default_value('landscape')
                ->set_conditional_logic([
                    [
                        'field' => 'related_image',
                        'value' => true,
                    ]
                ])
            ->set_width(50),
		]);
}

add_action('carbon_fields_register_fields', 'crb_post_in_banner');
function crb_post_in_banner()
{
	Container
		::make('post_meta', __('ALPS: Hero Featured Post', 'alps'))
		->where('post_type', '=', 'page')
		->where('post_template', '=', 'views/template-posts.blade.php')
		->add_fields([
			Field
				::make('separator', 'crb_fpost_banner', __('Hero: Show Featured Post', 'alps')),
			Field
				::make('checkbox', 'show_hero_featured_post', __('Select to display a featured post in the hero.', 'alps'))
				->set_option_value('true'),
			Field
				::make('association', 'hero_featured_post', __('Select - Hero Featured Post', 'alps'))
				->set_conditional_logic([
					[
						'field' => 'show_hero_featured_post',
						'value' => true,
					]
				])
				->set_types([
					[
						'type' => 'post',
						'post_type' => 'post',
					]
				])
				->set_max(1),
		]);
}

// POST FEED - LIST ------------------------------------------------
add_action('carbon_fields_register_fields', 'crb_post_feed_list');
function crb_post_feed_list()
{
	Container
		::make('post_meta', __('ALPS: Post Feed List', 'alps'))
		->where('post_type', '=', 'page')
		->where('post_template', '=', 'views/template-posts.blade.php')
		->add_fields([
			Field
				::make('separator', 'crb_feed_list_banner', __('Post Feed - List', 'alps')),
			Field
				::make('radio', 'post_feed_list', __('Post Feed: List', 'alps'))
				->set_help_text('Displays as a list of posts.', 'alps')
				->add_options([
					'post_feed_list_false' => __('None', 'alps'),
					'post_feed_list_category' => __('Select a category of posts to feature.', 'alps'),
					'post_feed_list_custom' => __('Select specific posts to feature.', 'alps'),
				]),
			Field
				::make('separator', 'crb_feed_list_cat_sep', __('Select Post Category', 'alps'))
				->set_conditional_logic([
					[
						'field' => 'post_feed_list',
						'value' => 'post_feed_list_category',
					]
				]),
			Field
				::make('separator', 'crb_feed_list_pick_sep', __('Select Specific Posts', 'alps'))
				->set_conditional_logic([
					[
						'field' => 'post_feed_list',
						'value' => 'post_feed_list_custom',
					]
				]),
			// NEXT THREE FIELDS ARE SHOWN FOR BOTH
			Field
				::make('text', 'post_feed_list_title', __('Section Title', 'alps'))
				->set_help_text(__('Enter the title for this featured posts section.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					'relation' => 'AND',
					[
						'field' => 'post_feed_list',
						'value' => 'post_feed_list_false',
						'compare' => 'EXCLUDES',
					]
				]),
			Field
				::make('text', 'post_feed_list_link', __('Section Link', 'alps'))
				->set_help_text(__('Enter the link to the posts archive page.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					'relation' => 'AND',
					[
						'field' => 'post_feed_list',
						'value' => 'post_feed_list_false',
						'compare' => 'EXCLUDES',
					]
				]),
			Field
				::make('checkbox', 'post_feed_list_round_image', __('Round Image Thumbnail', 'alps'))
				->set_help_text(__('Check to make the image thumbnail round.', 'alps'))
				->set_option_value('true')
				->set_conditional_logic([
					'relation' => 'AND',
					[
						'field' => 'post_feed_list',
						'value' => 'post_feed_list_false',
						'compare' => 'EXCLUDES',
					]
				]),
			// ONLY CATEGORY FIELDS FOLLOW WITH SPECIFIC / SELECTED ONES TO FOLLOW THIS
			Field
				::make('association', 'post_feed_list_category_array', __('Select - Category', 'alps'))
				->set_help_text(__('Click on the category you want to select on the left and it will be selected on the right side. You can only select one category.', 'alps'))
				->set_types([
					[
						'type' => 'term',
						'taxonomy' => 'category',
					]
				])
				->set_max(1)
				->set_conditional_logic([
					[
						'field' => 'post_feed_list',
						'value' => 'post_feed_list_category',
					]
				]),
			Field
				::make('text', 'post_feed_list_count', __('Number of Posts', 'alps'))
				->set_help_text(__('Enter the number of posts you would like to display. (If empty, defaults to 3 posts in the selected category)', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					[
						'field' => 'post_feed_list',
						'value' => 'post_feed_list_category',
					]
				]),
			Field
				::make('text', 'post_feed_list_offset', __('Post Offset', 'alps'))
				->set_help_text(__('Enter the number of posts you would like to offset.'))
				->set_width(50)
				->set_conditional_logic([
					[
						'field' => 'post_feed_list',
						'value' => 'post_feed_list_category',
					]
				]),
			// ONLY SPECIFIC / SELECTED POSTS
			Field::make('association', 'post_feed_list_custom_array', __('Select - Custom Posts', 'alps'))
				->set_help_text(__('Click on the posts you want to select on the left and they will be selected on the right side.', 'alps'))
				->set_types([
					[
						'type' => 'post',
						'post_type' => 'post',
					]
				])
				->set_conditional_logic([
					[
						'field' => 'post_feed_list',
						'value' => 'post_feed_list_custom',
					]
				]),
		]);
}

// POST FEED - FULL ------------------------------------------------
add_action('carbon_fields_register_fields', 'crb_post_feed_full');
function crb_post_feed_full()
{
	Container
		::make('post_meta', __('ALPS: Post Feed - Full Width'))
		->where('post_type', '=', 'page')
		->where('post_template', '=', 'views/template-posts.blade.php')
		->add_fields([
			Field
				::make('separator', 'crb_feed_list_banner', __('Post Feed - Full Width', 'alps')),
			Field
				::make('radio', 'post_feed_full', __('Post Feed: Full Width', 'alps'))
				->set_help_text(__('Displays as a list of posts.', 'alps'))
				->add_options([
					'post_feed_full_false' => __('None', 'alps'),
					'post_feed_full_category' => __('Select a category of posts to feature.', 'alps'),
				]),
			Field
				::make('separator', 'crb_feed_full_cat_sep', __('Select Post Category', 'alps'))
				->set_conditional_logic([
					[
						'field' => 'post_feed_full',
						'value' => 'post_feed_full_category',
					]
				]),
			// NEXT THREE FIELDS ARE SHOWN FOR BOTH
			Field
				::make('text', 'post_feed_full_title', __('Section Title', 'alps'))
				->set_help_text(__('Enter the title for this featured posts section.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					'relation' => 'AND',
					[
						'field' => 'post_feed_full',
						'value' => 'post_feed_full_category',
					]
				]),
			Field
				::make('text', 'post_feed_full_link', __('Section Link', 'alps'))
				->set_help_text(__('Enter the link to the posts archive page.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					'relation' => 'AND',
					[
						'field' => 'post_feed_full',
						'value' => 'post_feed_full_category'
					]
				]),
			Field
				::make('checkbox', 'post_feed_full_featured', __('Full Width Featured Post', 'alps'))
				->set_help_text(__('Select to include a post full width.', 'alps'))
				->set_option_value('post_feed_full_featured_true')
				->set_conditional_logic([
					'relation' => 'AND',
					[
						'field' => 'post_feed_full',
						'value' => 'post_feed_full_category',
					]
				]),
			Field
				::make('association', 'post_feed_full_featured_array', __('Featured Post', 'alps'))
				->set_help_text(__('Select (1) post to feature as a full width post.', 'alps'))
				->set_types([
					[
						'type' => 'post',
						'post_type' => 'post'
					]
				])
				->set_max(1)
				->set_conditional_logic([
					[
						'field' => 'post_feed_full',
						'value' => 'post_feed_full_category'
					],
					[
						'field' => 'post_feed_full_featured',
						'value' => true
					]
				]),
			Field
				::make('text', 'post_feed_full_offset', __('Post Offset', 'alps'))
				->set_help_text(__('Enter the number of posts you would like to offset.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					[
						'field' => 'post_feed_full',
						'value' => 'post_feed_list_category'
					]
				]),
			Field
				::make('association', 'post_feed_full_category_array', __('Select - Category', 'alps'))
				->set_help_text(__('Click on the category you want to select on the left and it will be selected on the right side. You can only select one category.', 'alps'))
				->set_types([
					[
						'type' => 'term',
						'taxonomy' => 'category'
					]
				])
				->set_max(1)
				->set_conditional_logic([
					[
						'field' => 'post_feed_full',
						'value' => 'post_feed_full_category'
					]
				]),
		]);
}

// POST FEED - ARCHIVE ------------------------------------------------
add_action('carbon_fields_register_fields', 'crb_post_feed_archive');
function crb_post_feed_archive()
{
	Container
		::make('post_meta', __('ALPS: Post Feed Archive', 'alps'))
		->where('post_type', '=', 'page')
		->where('post_template', '=', 'views/template-posts.blade.php')
		->add_fields([
			Field
				::make('separator', 'crb_feed_archive_banner', __('Post Feed - Archive', 'alps')),
			Field
				::make('radio', 'post_feed_archive', __('Post Feed: Archive', 'alps'))
				->set_help_text(__('Displays as a list of posts.', 'alps'))
				->add_options([
					'post_feed_archive_false' => __('None', 'alps'),
					'post_feed_archive_category' => __('Select a category of posts to feature.', 'alps'),
				]),
			Field
				::make('separator', 'crb_feed_archive_cat_sep', __('Select Post Category', 'alps'))
				->set_conditional_logic([
					[
						'field' => 'post_feed_archive',
						'value' => 'post_feed_archive',
					]
				]),
			Field
				::make('text', 'post_feed_archive_title', __('Section Title', 'alps'))
				->set_help_text(__('Enter the title for this featured posts section.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					'relation' => 'AND',
					[
						'field' => 'post_feed_archive',
						'value' => 'post_feed_archive_category'
					]
				]),
			Field
				::make('text', 'post_feed_archive_link', __('Section Link', 'alps'))
				->set_help_text(__('Enter the link to the posts archive page.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					'relation' => 'AND',
					[
						'field' => 'post_feed_archive',
						'value' => 'post_feed_archive_category'
					]
				]),
			Field
				::make('text', 'post_feed_archive_offset', __('Post Offset', 'alps'))
				->set_help_text(__('Enter the number of posts you would like to offset.', 'alps'))
				->set_width(50)
				->set_conditional_logic([
					[
						'field' => 'post_feed_archive',
						'value' => 'post_feed_archive_category'
					]
				]),
			Field
				::make('association', 'post_feed_archive_category_array', __('Select - Category', 'alps'))
				->set_help_text(__('Click on the category you want to select on the left and it will be selected on the right side. You can only select one category.', 'alps'))
				->set_types([
					[
						'type' => 'term',
						'taxonomy' => 'category'
					]
				])
				->set_max(1)
				->set_conditional_logic([
					[
						'field' => 'post_feed_archive',
						'value' => 'post_feed_archive_category'
					]
				]),
		]);
}
