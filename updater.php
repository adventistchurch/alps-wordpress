<?php
namespace ALPS\Theme;

class ThemeUpdater
{
    private $name;
    private $version;
    private $metaUrl;
    private $cacheKey;
    private $cacheTtl = 3600;

    public function __construct($name, $version, $metaUrl)
    {
        $this->name     = $name;
        $this->version  = $version;
        $this->cacheKey = $name . '_updater';
        $this->metaUrl  = $metaUrl;
    }

    public function init()
    {
        add_filter('site_transient_update_themes',  [$this, 'checkUpdate']);
    }

    public function checkUpdate($transient)
    {

        $stylesheet = get_template();

        if ( empty($transient->checked ) ) {
            return $transient;
        }

        // trying to get from cache first
        if ( false == $remote = get_transient( $this->cacheKey ) ) {

            // info.json is the file with the actual plugin information on your server
            $remote = wp_remote_get( $this->metaUrl, [
                'timeout' => 10,
                'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);

        }

        if( !is_wp_error($remote) && isset( $remote['response']['code'] ) && $remote['response']['code'] == 200 && !empty($remote['body'])) {
            $remote = json_decode( $remote['body'] );

            $data = array(
                'theme' => $stylesheet,
                'url' => 'https://alps.adventistcdn.org/wordpress/themes/alps/alps-wordpress-v3.json',
                'requires' => $remote->requires,
                'requires_php' => $remote->requires_php,
                'new_version' => $remote->version,
                'package' => $remote->download_url,
            );

            if ($remote && version_compare( $this->version, $remote->version, '<' ) && version_compare($remote->requires, get_bloginfo('version'), '<' )) {
                $res = new \stdClass();
                $res->slug = $this->name;
                $res->new_version = $remote->version;
                $res->package = $remote->download_url;
                $transient->response[$stylesheet] = $data;
            } else {
                $transient->no_update[$stylesheet] = $data;
            }
        }

        return $transient;
    }
}
