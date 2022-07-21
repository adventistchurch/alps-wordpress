<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');

function crb_attach_theme_options()
{
    $globalFields = [
        Field
            ::make('separator', 'crb_theme_colors', __('Theme Color Options / Grid', 'alps')),
        Field
            ::make('select', 'theme_color', __('Theme Color', 'alps'))
            ->add_options([
                'nad-denim' => __('NAD - Denim', 'alps'),
                'nad-nile' => __('NAD - Nile', 'alps'),
                'nad-amethyst' => __('NAD - Amethyst', 'alps'),
                'nad-spark' => __('NAD - Spark', 'alps'),
                'nad-miracle' => __('NAD - Miracle', 'alps'),
                'nad-branch' => __('NAD - Branch', 'alps'),
                'nad-vine' => __('NAD - Vine', 'alps'),
                'treefrog' => __('Treefrog', 'alps'),
                'ming' => __('Ming', 'alps'),
                'bluejay' => __('Bluejay', 'alps'),
                'iris' => __('Iris', 'alps'),
                'lily' => __('Lily', 'alps'),
                'scarlett' => __('Scarlett', 'alps'),
                'campfire' => __('Campfire', 'alps'),
                'winter' => __('Winter', 'alps'),
                'forest' => __('Forest', 'alps'),
                'cave' => __('Cave', 'alps'),
                'denim' => __('Denim', 'alps'),
                'emperor' => __('Emperor', 'alps'),
                'grapevine' => __('Grapevine', 'alps'),
                'velvet' => __('Velvet', 'alps'),
                'earth' => __('Earth', 'alps'),
                'night' => __('Night', 'alps')
            ])
            ->set_width(33),
        Field
            ::make('checkbox', 'dark_theme', __('Dark Theme', 'alps'))
            ->set_option_value('true')
            ->set_help_text(__('Select if you would like the theme to be dark.', 'alps'))
            ->set_width(33),
        Field
            ::make('checkbox', 'grid_lines', __('Grid Lines', 'alps'))
            ->set_option_value('true')
            ->set_help_text(__('Select if you would like show the grid lines.', 'alps'))
            ->set_width(33),
        Field
            ::make('checkbox', 'square_buttons', __('Square Buttons', 'alps'))
            ->set_option_value('true')
            ->set_help_text(__('Select if you would like square buttons', 'alps'))
            ->set_width(33),
        Field
            ::make('html', 'crb_statements_exp')
            ->set_html(__('<h3>Global Site Statements</h3><p style="font-size:16px">Both of these statements show up in the navigation drawer.</p>', 'alps')),
        Field
            ::make('textarea', 'site_branding_statement', __('Site Branding Statement', 'alps'))
            ->set_default_value(__('[Site Name] is a website of the Seventh-day Adventist church in [Region Name].', 'alps'))
            ->set_help_text(__('Found in the navigation drawer', 'alps'))
            ->set_rows(2)
            ->set_width(50),
        Field
            ::make('textarea', 'global_branding_statement', __('Global Branding Statement', 'alps'))
            ->set_default_value(__('Seventh-day Adventists are devoted to helping people understand the Bible to find freedom, healing, and hope in Jesus.', 'alps'))
            ->set_help_text(__('Found in the navigation drawer', 'alps'))
            ->set_rows(2)
            ->set_width(50),
    ];

    $languages = apply_filters('wpml_active_languages', NULL);
    $logoFields = [
        Field::make('separator', 'crb_logo', __('Logo', 'alps')),
    ];
    if (empty($languages)) {
        $logoFields = [
            Field
                ::make('image', 'logo', __('Logo', 'alps')),
        ];
    } else {
        foreach ($languages as $lang) {
            $logoFields = [
                Field
                    ::make('image', 'logo_' . $lang['code'], __('Logo (' . $lang['translated_name'] . ')', 'alps'))
                    ->set_width(33)
            ];
        }
    }

    $versionFields = [];
    $versions = \App\Core\ALPSVersions::getAll();
    if ($versions && count($versions) > 0) {
        $versionOptions = [];
        foreach ($versions as $idx => $v) {
            if ($idx === 0) {
                $versionOptions['latest'] = __('Latest', 'alps') . ' (' . $v['version'] . ')';
            } else {
                $versionOptions[$v['version']] = $v['version'];
            }
        }

        $versionFields = [
            Field
                ::make('html', 'crb_alps_version')
                ->set_html(__('<h3>ALPS CORE Version</h3><p style="font-size:16px">Stick to the selected version of ALPS core CSS and Javascript.</p>', 'alps')),
            Field
                ::make('radio', 'project_alps_version', __('ALPS Core files version', 'alps'))
                ->add_options([
                    'alps-remote' => __('REMOTE: This option pulls the ALPS CORE CSS and Javascript from the remote CDN.', 'alps'),
                    'alps-local' => __('LOCAL: This option caches the most recent version of ALPS to your local site, reducing the connections to remote servers.', 'alps'),
                ])
                ->set_width(33),
            Field
                ::make('select', \App\Core\ALPSVersions::OPTION_KEY, __('Choose the REMOTE ALPS CDN Version', 'alps'))
                ->add_options($versionOptions)
                ->set_conditional_logic([[
                    'field' => 'project_alps_version',
                    'value' => 'alps-remote',
                    'compare' => '='
                ]])
                ->set_width(33),
            Field
                ::make('html', 'cached_version')
                ->set_html(__('<h3 style="font-size:13px; margin-top: 0;">Cached LOCAL style version</h3><p style="font-size:13px">ALPS Version '.\App\Core\ALPSVersions::getLocalCachedVersion().'</p>', 'alps'))
                ->set_conditional_logic([[
                    'field' => 'project_alps_version',
                    'value' => 'alps-local',
                    'compare' => '='
                ]])
                ->set_width(33),
        ];
    }

    $WPMLFields = [];
    if(\App\Core\ALPSLanguages::WPMLPluginIsActive()) {
        $WPMLHeader= Field
            ::make('html', 'crb_alps_languages')
            ->set_html(__('<h3>WPML Language Selector Settings</h3>', 'alps'));
        $WPMLContent = Field
            ::make('checkbox', 'project_alps_languages_hide_selector', __('Hide WPML languages', 'alps'))
            ->set_option_value('false')
            ->set_help_text(__('Hiding default WPML languages selector on page.', 'alps'));
        array_push($WPMLFields, $WPMLHeader, $WPMLContent);
    }

    Container
        ::make('theme_options', __('ALPS Theme Settings', 'alps'))
        ->set_page_parent('themes.php')
        ->set_page_file('alps-theme-options')
        ->add_tab(__('GLOBAL', 'alps'), array_merge($logoFields, $globalFields, $versionFields, $WPMLFields))
        ->add_tab(__('POSTS OPTIONS', 'alps'), [
            Field
                ::make('separator', 'crb_content_display', __('Home Page Content Display', 'alps')),
            Field
                ::make('text', 'posts_page_title', __('Home Page Title', 'alps'))
                ->set_help_text(__('Sets a custom home page title for sites displaying the latest posts.', 'alps'))
                ->set_width(33),
            Field
                ::make('checkbox', 'index_hide_sidebar', __('Hide The Sidebar', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Hides the sidebar on the home/archive page if it is active.', 'alps'))
                ->set_width(33),
            Field
                ::make('separator', 'crb_posts_display', __('Posts Content Display', 'alps')),
            Field
                ::make('text', 'archive_page_title', __('Archives Page Title', 'alps'))
                ->set_help_text(__('Sets a custom title for the archive page for sites with a custom posts page.', 'alps'))
                ->set_width(100),
            Field
                ::make('checkbox', 'is_related_stories_image_hidden', __('Hide The Related Stories Image', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Hides the image in the Related Stories block in sidebar.', 'alps'))
                ->set_width(33),
            Field
                ::make('checkbox', 'archive_hide_sidebar', __('Hide The Sidebar', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Hides the sidebar on the archive page if it is active.', 'alps'))
                ->set_width(33),
            Field
                ::make('checkbox', 'posts_label', __('Category Posts Feed Label', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Select to display the label "Category" on category posts feed.', 'alps'))
                ->set_width(33),
            Field
                ::make('separator', 'crb_archive_display', __('Posts Grid and Image Display', 'alps')),
            Field
                ::make('checkbox', 'posts_grid', __('Posts Feed Grid', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Select to display the posts side-by-side.', 'alps'))
                ->set_width(50),
            Field
                ::make('checkbox', 'posts_grid_3up', __('Posts Feed Grid (3up)', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Select to display the posts 3up at the largest breakpoint. The sidebar must be hidden for the pages to display 3up.', 'alps'))
                ->set_width(50),
            Field
                ::make('checkbox', 'posts_image', __('Posts Feed Image', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Select to display the feature image for the posts.', 'alps'))
                ->set_width(50),
            Field
                ::make('checkbox', 'posts_image_round', __('Posts Round Images', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Make the post feed images round.', 'alps'))
                ->set_width(50),
        ])
        ->add_tab(__('SABBATH COLUMN', 'alps'), [
            Field
                ::make('image', 'sabbath_icon', __('Sabbath Icon', 'alps'))
                ->set_width(50),
            Field
                ::make('image', 'sabbath_background', __('Sabbath Background Image', 'alps'))
                ->set_width(50),
            Field
                ::make('checkbox', 'sabbath_scroll', __('Hide Sabbath Icon Until Scroll', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Select to hide the sabbath icon till you scroll.', 'alps'))
                ->set_width(33),
            Field
                ::make('checkbox', 'sabbath_hide', __('Hide the sabbath column', 'alps'))
                ->set_option_value('true')
                ->set_help_text(__('Select to hide the sabbath column.', 'alps'))
                ->set_width(33),
            Field
                ::make('radio', 'sabbath_hide_screens', __('Hide the sabbath column at certain screen widths', 'alps'))
                ->add_options([
                    'hide-sabbath--all' => __('Hide the sabbath column for all screen widths.', 'alps'),
                    'hide-sabbath--until-small' => __('Hide the sabbath column at small screens.', 'alps'),
                    'hide-sabbath--until-medium' => __('Hide the sabbath column at medium screens.', 'alps'),
                    'hide-sabbath--until-large' => __('Hide the sabbath column at large screens.', 'alps'),
                ])
                ->set_conditional_logic([[
                    'field' => 'sabbath_hide',
                    'value' => true,
                    'compare' => '='
                ]])
                ->set_width(33),
        ])
        ->add_tab(__('FOOTER CONTENT', 'alps'), [
            Field
                ::make('rich_text', 'footer_description', __('Footer Description', 'alps')),
            Field
                ::make('text', 'footer_copyright', __('Footer Copyright', 'alps')),
            Field
                ::make('complex', 'footer_address', __('Footer Address', 'alps'))
                ->add_fields([
                    Field
                        ::make('text', 'footer_address_street', __('Street Address', 'alps')),
                    Field
                        ::make('text', 'footer_address_city', __('City', 'alps'))
                        ->set_width(33),
                    Field
                        ::make('text', 'footer_address_state', __('State', 'alps'))
                        ->set_width(33),
                    Field
                        ::make('text', 'footer_address_zip', __('Postal Code', 'alps'))
                        ->set_width(33),
                    Field
                        ::make('text', 'footer_address_country', __('Country', 'alps'))
                        ->set_width(50),
                    Field
                        ::make('text', 'footer_phone', __('Phone Number', 'alps'))
                        ->set_width(50),
                ])
                ->set_min(1)
                ->set_max(1),
            Field
                ::make('image', 'footer_logo_icon', __('Footer Logo Icon', 'alps'))
                ->set_help_text(__('Upload a logo icon for the footer. * Will only display if the sabbath column is hidden.', 'alps')),
            Field
                ::make('radio', 'footer_logo_type', __('Fallback Footer Logo Icon', 'alps'))
                ->add_options([
                    'square' => __('Square', 'alps'),
                    'circle' => __('Circle', 'alps'),
                ])
                ->set_width(33),
        ]);
}
