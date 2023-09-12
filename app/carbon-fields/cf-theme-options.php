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
                'bluejay' => __('Bluejay', 'alps'),
                'campfire' => __('Campfire', 'alps'),
                'cave' => __('Cave', 'alps'),
                'denim' => __('Denim', 'alps'),
                'earth' => __('Earth', 'alps'),
                'emperor' => __('Emperor', 'alps'),
                'forest' => __('Forest', 'alps'),
                'grapevine' => __('Grapevine', 'alps'),
                'iris' => __('Iris', 'alps'),
                'lily' => __('Lily', 'alps'),
                'ming' => __('Ming', 'alps'),
                'night' => __('Night', 'alps'),
                'scarlett' => __('Scarlett', 'alps'),
                'treefrog' => __('Treefrog', 'alps'),
                'velvet' => __('Velvet', 'alps'),
                'winter' => __('Winter', 'alps'),
                'nad-amethyst' => __('NAD - Amethyst', 'alps'),
                'nad-branch' => __('NAD - Branch', 'alps'),
                'nad-denim' => __('NAD - Denim', 'alps'),
                'nad-miracle' => __('NAD - Miracle', 'alps'),
                'nad-nile' => __('NAD - Nile', 'alps'),
                'nad-spark' => __('NAD - Spark', 'alps'),
                'nad-vine' => __('NAD - Vine', 'alps')
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
            ->set_default_value(__('An official website of the Seventh-day Adventist Church.', 'alps'))
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
        Field::make('separator', 'crb_logo', __('Logo', 'alps'))
            ->set_help_text(__('IMPORTANT NOTE: By default the theme will recolor your logo based on the selected color palette. On standard headers the logo will be shown in the theme’s primary color. On overlay headers, the logo will be shown in white. If you wish to preserve the colors of your logo, deselect the checkbox below and, optionally, upload an inverted version of your logo for use on overlay headers.', 'alps')),
        Field::make('checkbox', 'logo_recolor', __('Allow theme to control logo color', 'alps'))
            ->set_option_value('true')->set_default_value('true'),
        Field::make('checkbox', 'is_wide_logo', __('Wide Logo', 'alps'))
            ->set_option_value('true')
            ->set_help_text(__('Select if you would like to use a wider than normal logo.', 'alps'))
            ->set_width(100),
    ];
    if (empty($languages)) {
        $logoFields[] = Field::make('image', 'logo', __('Logo', 'alps'))->set_width(55);
        $logoFields[] = Field::make('image', 'logo_inverted', __('Optional Inverted Logo', 'alps'))->set_width(55);
    } else {
        foreach ($languages as $lang) {
            $logoFields[] = Field
                ::make('image', 'logo_' . $lang['code'], __('Logo (' . $lang['translated_name'] . ')', 'alps'))
                ->set_width(25);
            $logoFields[] = Field
                ::make('image', 'logo_inverted_' . $lang['code'], __('Optional Inverted Logo (' . $lang['translated_name'] . ')', 'alps'))
                ->set_width(25);
        }
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
        ->add_tab(__('GLOBAL', 'alps'), array_merge($logoFields, $globalFields, $WPMLFields))
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
                ::make( 'complex', 'footer_description', __('Footer Description', 'alps'))
                    ->add_fields( 'translatable_footer_description', [
                            Field
                                ::make('text', 'footer_description_en', __('Footer Description English', 'alps'))
                                ->set_default_value(__('An official website of the Seventh-day Adventist Church.', 'alps')),
                            Field
                                ::make('text', 'footer_description_de', __('Fußzeilenbeschreibung Deutsch', 'alps'))
                                ->set_default_value(__('Eine offizielle Website der Kirche der Siebenten-Tags-Adventisten.', 'alps')),
                            Field
                                ::make('text', 'footer_description_fr', __('Description du Pied de Page Français', 'alps'))
                                ->set_default_value(__('Un site officiel de l\'Église adventiste du Septième jour.', 'alps')),
                            Field
                                ::make('text', 'footer_description_pt-pt', __('Rodapé Descrição Português', 'alps'))
                                ->set_default_value(__('Um site oficial da Igreja Adventista do Sétimo Dia.', 'alps')),
                            Field
                                ::make('text', 'footer_description_es', __('Descripción del Pie de Página en Español', 'alps'))
                                ->set_default_value(__('Sitio web oficial de la Iglesia Adventista del Séptimo Día.', 'alps')),
                            Field
                                ::make('text', 'footer_description_ko', __('바닥 글 설명 한국어', 'alps'))
                                ->set_default_value(__('제칠 일 안식일 예수 재림 교회의 공식 웹 사이트.', 'alps')),
                            Field
                                ::make('text', 'footer_description_ru', __('Описание нижнего колонтитула (Русский)', 'alps'))
                                ->set_default_value(__('Официальный веб-сайт Церкви адвентистов седьмого дня.', 'alps')),
                            Field
                                ::make('text', 'footer_description_zh-hant', __('页脚说明中文', 'alps'))
                                ->set_default_value(__('基督复临安息日会的官方网站。', 'alps')),

                        ]),
            Field
                ::make('text', 'footer_copyright', __('Footer Copyright', 'alps'))
                ->set_default_value(__('Seventh-day Adventist Church', 'alps')),
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

        // Added to rewrite theme.json file with complete color palette based on selected color theme

        $colors = json_decode(file_get_contents(get_template_directory().'/colors.json',false));
        $color = carbon_get_theme_option('theme_color');
        $themeJSON = get_template_directory().'/theme.json';
        $file = fopen($themeJSON, "r+");
        $json = json_decode(fread($file,filesize($themeJSON)));

        if ($json && !empty($colors)){
            if (!empty($colors->{$color})){
                $json->settings->color->palette = $colors->{$color};
                rewind($file);
                ftruncate($file,0);
                fwrite($file, json_encode($json,JSON_PRETTY_PRINT));
            }
        }

        fclose($file);
}
