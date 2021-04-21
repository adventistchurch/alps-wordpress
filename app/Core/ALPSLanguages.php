<?php
namespace App\Core;

const BASENAME = 'sitepress-multilingual-cms/sitepress.php';

class ALPSLanguages
{
    public static function WPMLPluginIsActive()
    {
        if( !function_exists('is_plugin_active') ) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }

        return is_plugin_active(BASENAME);
    }

    private static function log($data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
}
