<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');

function crb_attach_theme_options()
{
    Container
        ::make('theme_options', __('ALPS Theme Settings'))
        ->set_page_parent('themes.php')
        ->set_page_file('alps-theme-options')
        ->add_tab(__('GLOBAL'), [
            Field
                ::make('separator', 'crb_logo', __('Logo')),
            Field
                ::make('image', 'logo', __('Logo')),
            Field
                ::make('separator', 'crb_theme_colors', __('Theme Color Options / Grid')),
            Field
                ::make('select', 'theme_color', __('Theme Color'))
                ->add_options([
                    'treefrog' => __('Treefrog'),
                    'ming' => __('Ming'),
                    'bluejay' => __('Bluejay'),
                    'iris' => __('Iris'),
                    'lily' => __('Lily'),
                    'scarlett' => __('Scarlett'),
                    'campfire' => __('Campfire'),
                    'winter' => __('Winter'),
                    'forest' => __('Forest'),
                    'cave' => __('Cave'),
                    'denim' => __('Denim'),
                    'emperor' => __('Emperor'),
                    'grapevine' => __('Grapevine'),
                    'velvet' => __('Velvet'),
                    'earth' => __('Earth'),
                    'night' => __('Night')
                ])
                ->set_width(33),
            Field
                ::make('checkbox', 'dark_theme', __('Dark Theme'))
                ->set_option_value('true')
                ->set_help_text('Select if you would like the theme to be dark.')
                ->set_width(33),
            Field
                ::make('checkbox', 'grid_lines', __('Grid Lines'))
                ->set_option_value('true')
                ->set_help_text('Select if you would like show the grid lines.')
                ->set_width(33),
            Field
                ::make('html', 'crb_statements_exp')
                ->set_html('<h3>Global Site Statements</h3><p style="font-size:16px">Both of these statements show up in the navigation drawer.</p>'),
            Field
                ::make('textarea', 'site_branding_statement', __('Site Branding Statement'))
                ->set_default_value('[Site Name] is a website of the Seventh-day Adventist church in [Region Name].')
                ->set_help_text('Found in the navigation drawer')
                ->set_rows(2)
                ->set_width(50),
            Field
                ::make('textarea', 'global_branding_statement', __('Global Branding Statement'))
                ->set_default_value('Seventh-day Adventists are devoted to helping people understand the Bible to find freedom, healing, and hope in Jesus.')
                ->set_help_text('Found in the navigation drawer')
                ->set_rows(2)
                ->set_width(50),
        ])
        ->add_tab(__('POSTS OPTIONS'), [
            Field
                ::make('separator', 'crb_content_display', __('Category Page Content Display')),
            Field
                ::make('checkbox', 'index_hide_sidebar', __('Hide The Sidebar'))
                ->set_option_value('true')
                ->set_help_text('Hides the sidebar on the home/category page if it is active.'),
            Field
                ::make('separator', 'crb_posts_display', __('Category Posts Content Display')),
            Field
                ::make('text', 'posts_page_title', __('Home Page Title'))
                ->set_width(33),
            Field
                ::make('checkbox', 'posts_label', __('Category Posts Feed Label'))
                ->set_option_value('true')
                ->set_help_text('Select to display the label "Category" on category posts feed.')
                ->set_width(33),
            Field
                ::make('checkbox', 'posts_grid', __('Posts Feed Grid'))
                ->set_option_value('true')
                ->set_help_text('Select to display the posts side-by-side.')
                ->set_width(33),
            Field
                ::make('checkbox', 'posts_grid_3up', __('Posts Feed Grid (3up)'))
                ->set_option_value('true')
                ->set_help_text('Select to display the posts 3up at the largest breakpoint. The sidebar must be hidden for the pages to display 3up.')
                ->set_width(33),
            Field
                ::make('checkbox', 'posts_image', __('Posts Feed Image'))
                ->set_option_value('true')
                ->set_help_text('Select to display the feature image for the posts.')
                ->set_width(33),
            Field
                ::make('checkbox', 'posts_image_round', __('Posts Round Images'))
                ->set_option_value('true')
                ->set_help_text('Make the post feed images round.')
                ->set_width(33),
            Field
                ::make('separator', 'crb_archive_display', __('Posts Archive Content Display')),
            Field
                ::make('text', 'archive_page_title', __('Page Title'))
                ->set_width(33),
            Field
                ::make('checkbox', 'archive_hide_sidebar', __('Hide The Sidebar'))
                ->set_option_value('true')
                ->set_help_text('Hides the sidebar on the posts archives if it is active.')
                ->set_width(33),

        ])
        ->add_tab(__('SABBATH COLUMN'), [
            Field
                ::make('image', 'sabbath_icon', __('Sabbath Icon'))
                ->set_width(50),
            Field
                ::make('image', 'sabbath_background', __('Sabbath Background Image'))
                ->set_width(50),
            Field
                ::make('checkbox', 'sabbath_scroll', __('Hide Sabbath Icon Until Scroll'))
                ->set_option_value('true')
                ->set_help_text('Select to hide the sabbath icon till you scroll.')
                ->set_width(33),
            Field
                ::make('checkbox', 'sabbath_hide', __('Hide the sabbath column'))
                ->set_option_value('true')
                ->set_help_text('Select to hide the sabbath column.')
                ->set_width(33),
            Field
                ::make('radio', 'sabbath_hide_screens', 'Hide the sabbath column at certain screen widths')
                ->add_options([
                    'hide-sabbath--all' => 'Hide the sabbath column for all screen widths.',
                    'hide-sabbath--until-small' => 'Hide the sabbath column at small screens.',
                    'hide-sabbath--until-medium' => 'Hide the sabbath column at medium screens.',
                    'hide-sabbath--until-large' => 'Hide the sabbath column at large screens.'
                ])
                ->set_conditional_logic([[
                    'field' => 'sabbath_hide',
                    'value' => true,
                    'compare' => '='
                ]])
                ->set_width(33),
        ])
        ->add_tab(__('FOOTER CONTENT'), [
            Field
                ::make('rich_text', 'footer_description', __('Footer Description')),
            Field
                ::make('text', 'footer_copyright', __('Footer Copyright')),
            Field
                ::make('complex', 'footer_address', __('Footer Address'))
                ->add_fields([
                    Field
                        ::make('text', 'footer_address_street', __('Street Address')),
                    Field
                        ::make('text', 'footer_address_city', __('City'))
                        ->set_width(33),
                    Field
                        ::make('text', 'footer_address_state', __('State'))
                        ->set_width(33),
                    Field
                        ::make('text', 'footer_address_zip', __('Postal Code'))
                        ->set_width(33),
                    Field
                        ::make('text', 'footer_address_country', __('Country'))
                        ->set_width(50),
                    Field
                        ::make('text', 'footer_phone', __('Phone Number'))
                        ->set_width(50),
                ])
                ->set_min(1)
                ->set_max(1),
            Field
                ::make('image', 'footer_logo_icon', __('Footer Logo Icon'))
                ->set_help_text('Upload a logo icon for the footer. * Will only display if the sabbath column is hidden.'),
        ]);
}
