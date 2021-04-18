<?php
namespace App\Core;

class ALPSPostPage
{
    public static function HideRelatedStories() {
        return get_alps_option('project_alps_related_stories_is_hiding_on_post_page');
    }

    private static function log($data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
}
