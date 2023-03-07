<?php

namespace App;

add_filter('site_transient_update_themes', 'alps_update_theme');

function alps_update_theme($transient) {
    // let's get the theme directory name
    // it will be "alps-wordpress-v3"
    $stylesheet = get_template();

    echo 'TTT0: Test Updater: ';

    // now let's get the theme version
    // but maybe it is better to hardcode it in a constant
    $theme = wp_get_theme();
    $version = $theme->get( 'Version' );

    echo 'TTT1: Test Updater: ';

    // connect to a remote server where the update information is stored
    $remote = wp_remote_get(
        'https://alps.adventistcdn.org/wordpress/themes/alps/alps-wordpress-v3.json',
        array(
            'timeout' => 10,
            'headers' => array(
                'Accept' => 'application/json'
            )
        )
    );

    echo 'TTT2: Test Updater: ';

    // do nothing if errors
    if(
        is_wp_error( $remote )
        || 200 !== wp_remote_retrieve_response_code( $remote )
        || empty( wp_remote_retrieve_body( $remote ) )
    ) {
        return $transient;
    }

    // encode the response body
    $remote = json_decode( wp_remote_retrieve_body( $remote ) );

    if( ! $remote ) {
        return $transient; // who knows, maybe JSON is not valid
    }

    echo 'TTT3: Test Updater: ';

    $data = array(
        'theme' => $stylesheet,
        'url' => $remote->details_url,
        'requires_php' => $remote->requires_php,
        'new_version' => $remote->version,
        'package' => $remote->download_url,
    );

    // check all the versions now
    if(
        $remote
        && version_compare( $version, $remote->version, '<' )
        && version_compare( $remote->requires_php, PHP_VERSION, '<' )
    ) {
        $transient->response[ $stylesheet ] = $data;
    } else {
        $transient->no_update[ $stylesheet ] = $data;
    }

    echo 'TTT4: Test Updater: ';

    return $transient;
}
