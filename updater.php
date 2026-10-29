<?php
namespace ALPS\Theme;

class ThemeUpdater
{
    private $name;
    private $version;
    private $metaUrl;
    // Own key: deriving it from $name collided with the ALPS Gutenberg Blocks plugin
    // updater, so the theme picked up the plugin's version and package.
    private $cacheKey = 'alps_theme_updater';
    private $lockKey = 'alps_theme_updater_lock';
    private $cacheTtl = 43200; // 12 hours, same as core's own update checks
    // Failed checks are cached too, so an unreachable CDN is not requested on every admin page.
    private $errorCacheTtl = 3600;
    private $lockTtl = 30;

    public function __construct($name, $version, $metaUrl)
    {
        $this->name     = $name;
        $this->version  = $version;
        $this->metaUrl  = $metaUrl;
    }

    public function init()
    {
        // Runs only while WordPress saves a fresh update check (wp-cron, the twice-daily
        // admin check, "Check again"), not every time the update list is read. Reading
        // happens several times on every admin page, which is what froze wp-admin when
        // the CDN was unreachable.
        add_filter('pre_set_site_transient_update_themes', [$this, 'checkUpdate']);
        add_action('upgrader_process_complete', [$this, 'afterUpdate'], 10, 2);
    }

    public function checkUpdate($transient)
    {
        if (!is_object($transient) || empty($transient->checked)) {
            return $transient;
        }

        $remote = $this->getRemoteData();

        if (!$remote) {
            return $transient;
        }

        $stylesheet = get_template();

        $data = [
            'theme' => $stylesheet,
            'url' => $this->metaUrl,
            'requires' => $remote['requires'],
            'requires_php' => $remote['requires_php'],
            'new_version' => $remote['version'],
            'package' => $remote['download_url'],
        ];

        if (
            version_compare($this->version, $remote['version'], '<')
            && version_compare(get_bloginfo('version'), $remote['requires'], '>=')
        ) {
            $transient->response[$stylesheet] = $data;
            unset($transient->no_update[$stylesheet]);
        } else {
            $transient->no_update[$stylesheet] = $data;
            unset($transient->response[$stylesheet]);
        }

        return $transient;
    }

    public function afterUpdate($upgrader, $options)
    {
        if (($options['action'] ?? '') === 'update' && ($options['type'] ?? '') === 'theme') {
            delete_transient($this->cacheKey);
        }
    }

    /**
     * Theme metadata from the CDN, cached. Returns null when it is unavailable or invalid.
     */
    private function getRemoteData()
    {
        $cached = get_transient($this->cacheKey);

        if (is_array($cached)) {
            return empty($cached['error']) ? $cached : null;
        }

        // Another request is already checking: don't stack a second request on top.
        if (get_transient($this->lockKey)) {
            return null;
        }

        set_transient($this->lockKey, 1, $this->lockTtl);

        $remote = null;
        $response = wp_remote_get($this->metaUrl, [
            'timeout' => 5,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
            $body = json_decode(wp_remote_retrieve_body($response), true);

            if (
                is_array($body)
                && !empty($body['version']) && is_string($body['version'])
                && !empty($body['download_url']) && is_string($body['download_url'])
                && str_starts_with($body['download_url'], 'https://')
            ) {
                $remote = [
                    'version' => $body['version'],
                    'download_url' => $body['download_url'],
                    'requires' => is_string($body['requires'] ?? null) ? $body['requires'] : '',
                    'requires_php' => is_string($body['requires_php'] ?? null) ? $body['requires_php'] : '',
                ];
            }
        }

        if ($remote) {
            set_transient($this->cacheKey, $remote, $this->cacheTtl);
        } else {
            set_transient($this->cacheKey, ['error' => true], $this->errorCacheTtl);
        }

        delete_transient($this->lockKey);

        return $remote;
    }
}
