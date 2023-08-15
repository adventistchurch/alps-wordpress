<?php
namespace App\Core;

class ALPSVersions
{
    const STORAGE_KEY = 'alps_versions';
    const OPTION_KEY = 'alps_version';

    const LOCAL_PATH = '/app/local/alps/';
    const PARENT_THEME = 'alps-wordpress-v3';

    const LOCAL_ICONS = [
//        "icon-play.svg",
        "o-arrow__bracket--left.svg",
        "o-arrow__short--down.svg",
        "o-arrow--down.svg",
        "o-icon__audio.svg",
        "o-icon__gallery.svg",
        "o-icon__language.svg",
        "o-icon__video.svg"];

    const LOCAL_IMAGES = [
        "background-grid.png",
        "background-grid.svg",
        "background-pattern.png"
    ];

    const THEME_KEYS = array(
        'bluejay',
        'campfire',
        'cave',
        'denim',
        'earth',
        'emperor',
        'forest',
        'grapevine',
        'iris',
        'lily',
        'ming',
        'night',
        'scarlett',
        'treefrog',
        'velvet',
        'winter',
        'nad-amethyst',
        'nad-branch',
        'nad-denim',
        'nad-miracle',
        'nad-nile',
        'nad-spark',
        'nad-vine'
    );

    public function init()
    {
            //Add some code here for initializing default action. See example bellow.
            //add_action(\App\CronScheduler::ACTION, [$this, 'fetchVersions']);
    }

    public static function get()
    {
        return self::getLocalVersion()[0];
    }

    public static function getLocalCachedVersion() {
        $cachedVersion = scandir(get_theme_root().'/'.self::PARENT_THEME.self::LOCAL_PATH)[2];
        return $cachedVersion ? $cachedVersion : 'Local styles are not cached yet!';
    }

    public static function usingLocalVersion() {
        return get_alps_option('project_alps_version') === 'alps-local';
    }

    public static function getLocalVersion() {
//     echo '123 test ::: '.implode(' ', $latestVersion).' ::::: TTT: '.implode('', $latestVersion['styles']['themes']);
//         $themes_keys = array_keys($latestVersion['styles']['themes']);
        $result_themes = [];

        $local_css_main = self::LOCAL_PATH.'/css/'.'main.css';
        $local_js_head  = self::LOCAL_PATH.'js/'.'head-script.min.js';
        $local_js_main  = self::LOCAL_PATH.'js/'.'script.min.js';

        $get_stylesheet_directory   = get_theme_root().'/'.self::PARENT_THEME;
        $get_template_directory_uri = get_theme_root_uri().'/'.self::PARENT_THEME;

//         echo 'DIRECTORIES: '.$get_stylesheet_directory.' ::: '.$get_template_directory_uri;

        //Store local themes styles
        foreach (self::THEME_KEYS as &$key) {
            $fileName = 'main-'.$key.'.css';
            $filePath = self::LOCAL_PATH.'css/'.$fileName;
            $result_themes = array_merge(array($key => $get_template_directory_uri.$filePath), $result_themes);
        }

        return [
            [
                'version' => 'alps_local_styles_version',
                'scripts' => [
                    'main' => $get_template_directory_uri.$local_js_main,
                    'head' => $get_template_directory_uri.$local_js_head,
                ],
                'styles' => [
                    'main' => $get_template_directory_uri.$local_css_main,
                    'themes' => $result_themes
                ],
            ]
        ];
    }
}
