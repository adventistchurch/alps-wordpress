<?php
namespace App\Core;

class ALPSVersions
{
    const STORAGE_KEY = 'alps_versions';
    const OPTION_KEY = 'alps_version';

    public function init()
    {
        add_action(\App\Cron::ACTION, [$this, 'fetchVersions']);
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

        $versions = get_site_transient(self::STORAGE_KEY);
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
}
