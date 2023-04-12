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
//         add_filter('plugins_api', [$this, 'pluginInfo'], 20, 3);
        add_filter('site_transient_update_theme', [$this, 'checkUpdate']);
//         add_action('upgrader_process_complete', [$this, 'afterUpdate'], 10, 2);
    }

//     public function pluginInfo($res, $action, $args)
//     {
//         // do nothing if this is not about getting plugin information
//         if ('plugin_information' !== $action) {
//             return false;
//         }
//
//         if ($this->name !== $args->slug) {
//             return false;
//         }
//
//         if (false == $remote = get_transient( $this->cacheKey )) {
//             $remote = wp_remote_get( $this->metaUrl, [
//                 'timeout' => 10,
//                 'headers' => [
//                     'Accept' => 'application/json',
//                 ],
//             ]);
//
//             if ( !is_wp_error($remote) && isset($remote['response']['code']) && $remote['response']['code'] == 200 && !empty($remote['body'])) {
//                 set_transient( $this->cacheKey, $remote, $this->cacheTtl ); // 1 hour cache
//             }
//         }
//
//         if( !is_wp_error($remote) && isset( $remote['response']['code'] ) && $remote['response']['code'] == 200 && !empty($remote['body'])) {
//             $remote = json_decode($remote['body']);
//             $res = new \stdClass();
//
//             $res->name = $remote->name;
//             $res->slug = $this->name;
//             $res->version = $remote->version;
//             $res->tested = $remote->tested;
//             $res->requires = $remote->requires;
//             $res->download_link = $remote->download_url;
//             $res->trunk = $remote->download_url;
//             $res->requires_php = $remote->requires_php;
//             $res->last_updated = $remote->last_updated;
//             $res->sections = [
//                 'description' => $remote->sections->description,
//             ];
//
//             return $res;
//         }
//
//         return false;
//     }

    public function checkUpdate($transient)
    {
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


            if ( !is_wp_error( $remote ) && isset( $remote['response']['code'] ) && $remote['response']['code'] == 200 && !empty( $remote['body'] ) ) {
                set_transient( $this->cacheKey, $remote, $this->cacheTtl ); // 12 hours cache
            }

        }

        if( !is_wp_error($remote) && isset( $remote['response']['code'] ) && $remote['response']['code'] == 200 && !empty($remote['body'])) {
            $remote = json_decode( $remote['body'] );

            if ($remote && version_compare( $this->version, $remote->version, '<' ) && version_compare($remote->requires, get_bloginfo('version'), '<' )) {
                $res = new \stdClass();
                $res->slug = $this->name;
//                 $res->plugin = $this->name . '/plugin.php';
                $res->new_version = $remote->version;
//                 $res->tested = $remote->tested;
                $res->package = $remote->download_url;
                $transient->response[$res->plugin] = $res;
            }
        }

        return $transient;
    }

    public function afterUpdate($upgrader_object, $options)
    {
        if ($options['action'] == 'update' && $options['type'] === 'plugin')  {
            // just clean the cache when new plugin version is installed
            delete_transient($this->cacheKey);
        }
    }
}
