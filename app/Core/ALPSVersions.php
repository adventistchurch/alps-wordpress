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

    public function init()
    {
        add_action(\App\CronScheduler::ACTION, [$this, 'fetchVersions']);
    }

    public function fetchVersions()
    {
        $res = wp_remote_get('https://cdn.adventist.org/alps/3/versions.json');
        $data = json_decode(wp_remote_retrieve_body($res), true);

        if ($data) {
            set_site_transient(self::STORAGE_KEY, $data);
        }
    }

    public static function getAll()
    {
        return get_site_transient(self::STORAGE_KEY);
    }

    public static function get()
    {
        $version = get_option('_' . self::OPTION_KEY);

        if (!$version) {
            return self::getFallbackVersion();
        }

        $versions = self::usingLocalVersion() ?
            self::getLocalVersion(get_site_transient(self::STORAGE_KEY)[0]) :
            get_site_transient(self::STORAGE_KEY);

        if ($versions) {
            if ($version === 'latest') {
                return $versions[0];
            }

            foreach ($versions as $v) {
                if ($v['version'] === $version) {
                    return $v;
                }
            }
        }

        return self::getFallbackVersion();
    }

    public static function getLocalCachedVersion() {
        $cachedVersion = scandir(get_theme_root().'/'.self::PARENT_THEME.self::LOCAL_PATH)[2];
        return $cachedVersion ? $cachedVersion : 'Local styles are not cached yet!';
    }

    public static function usingLocalVersion() {
        return get_alps_option('project_alps_version') === 'alps-local';
    }

    public static function getFallbackVersion()
    {
        return [
            'version' => 'unknown',
            'scripts' => [
                'main' => 'https://cdn.adventist.org/alps/3/latest/js/script.min.js',
                'head' => 'https://cdn.adventist.org/alps/3/latest/js/head-script.min.js',
            ],
            'styles' => [
                'main' => 'https://cdn.adventist.org/alps/3/latest/css/main.css',
            ],
        ];
    }

    public static function getLocalVersion($latestVersion) {
        $themes_keys = array_keys($latestVersion['styles']['themes']);
        $result_themes = [];

        $version = $latestVersion['version'];

        $local_css_main = self::LOCAL_PATH.$version.'/css/'.$version.'-main.css';
        $local_js_head  = self::LOCAL_PATH.$version.'/js/'.$version.'-head-script.min.js';
        $local_js_main  = self::LOCAL_PATH.$version.'/js/'.$version.'-script.min.js';

        $get_stylesheet_directory   = get_theme_root().'/'.self::PARENT_THEME;
        $get_template_directory_uri = get_theme_root_uri().'/'.self::PARENT_THEME;

        if(!self::currentVersionIsLatest($version)) {
            self::cleanLocalDirectory($get_stylesheet_directory.self::LOCAL_PATH);

            mkdir($get_stylesheet_directory.self::LOCAL_PATH.$version.'/css', 0777, true);
            mkdir($get_stylesheet_directory.self::LOCAL_PATH.$version.'/js', 0777, true);
            mkdir($get_stylesheet_directory.self::LOCAL_PATH.$version.'/images', 0777, true);
            mkdir($get_stylesheet_directory.self::LOCAL_PATH.$version.'/images/icons', 0777, true);

            self::uploadFile($latestVersion['styles']['main'], $get_stylesheet_directory.$local_css_main);
            self::uploadFile($latestVersion['scripts']['head'], $get_stylesheet_directory.$local_js_head);
            self::uploadFile($latestVersion['scripts']['main'], $get_stylesheet_directory.$local_js_main);

            foreach(self::LOCAL_IMAGES as &$image) {
                $local_image_path = self::LOCAL_PATH.$version.'/images/'.$image;
                self::uploadFile('https://cdn.adventist.org/alps/3/'.$version.'/images/'.$image, $get_stylesheet_directory.$local_image_path);
            }

            foreach(self::LOCAL_ICONS as &$icon) {
                $local_icon_path = self::LOCAL_PATH.$version.'/images/icons/'.$icon;
                self::uploadFile('https://cdn.adventist.org/alps/3/'.$version.'/images/icons/'.$icon, $get_stylesheet_directory.$local_icon_path);
            }
        }

        //Cache themes styles
        foreach ($themes_keys as &$key) {
            $fileName = $latestVersion['version'].'-main-'.$key.'.css';
            $filePath = self::LOCAL_PATH.$version.'/css/'.$fileName;
            self::uploadFile($latestVersion['styles']['themes'][$key], $get_stylesheet_directory.$filePath);
            $result_themes = array_merge(array($key => $get_template_directory_uri.$filePath), $result_themes);
        }

        return [
            [
                'version' => $latestVersion['version'],
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

    public static function uploadFile($file, $newfile) {

        if (!file_exists($newfile)) {
            copy($file, $newfile);

            //For debugging

//            if ( copy($file, $newfile) ) {
//                self::log('Caching of css/js files success!');
//            }else{
//                self::log('Caching of css/js files failed. - '.$file.' - '.$newfile);
//            }
        }
    }

    private static function currentVersionIsLatest($currentVersion) {
        return file_exists(get_theme_root().'/'.self::PARENT_THEME.self::LOCAL_PATH.$currentVersion);
    }

    // delete all files and sub-folders from a folder
    private static function cleanLocalDirectory($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file))
                self::cleanLocalDirectory($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }

    private static function log($data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
}
