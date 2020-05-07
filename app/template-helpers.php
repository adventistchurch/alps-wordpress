<?php
namespace App;

class TemplateHelpers {
    /**
     * Get sidebar visibility
     *
     * @return bool
     */
    public static function isVisibleSidebarOnArchive()
    {
        $isVisible = !get_alps_option('index_hide_sidebar') && !get_alps_option('archive_hide_sidebar');
        if (get_option('show_on_front') === 'page') {
            $postsRootPostId = get_option('page_for_posts');
            $isHiddenSidebar = (bool)get_post_meta($postsRootPostId, '_hide_sidebar', true);
            if ($isHiddenSidebar) {
                $isVisible = false;
            }
        }
        return $isVisible;
    }

    public static function getRootPostData()
    {
        $postsRootPostId = get_option('page_for_posts');
        $postsRootPost = get_post($postsRootPostId);

        $headerTitle = get_post_meta($postsRootPost->ID, '_display_title', true);
        if (!$headerTitle) {
            $headerTitle = get_the_title($postsRootPostId);
        }
        $headerKicker = get_post_meta($postsRootPost->ID, '_kicker', true);
        $headerSubtitle = get_post_meta($postsRootPost->ID, '_long_header_subtitle', true);

        $isVisibleFeaturedImage = !get_post_meta($postsRootPost->ID, '_hide_featured_image', true);
        $headerBackgroundImage = get_post_meta($postsRootPost->ID, '_header_background_image', true);

        if ($isVisibleFeaturedImage && !$headerBackgroundImage) {
            $headerBackgroundImage = get_post_thumbnail_id($postsRootPost->ID);
        }

        $postsRootPostIsVisibleSidebar = get_post_meta($postsRootPost->ID, '_hide_sidebar', true);

        return [
            'postsRootPostId' => $postsRootPostId,
            'postsRootPostIsVisibleSidebar' => $postsRootPostIsVisibleSidebar,
            'headerTitle' => $headerTitle,
            'headerKicker' => $headerKicker,
            'headerSubtitle' => $headerSubtitle,
            'headerBackgroundImage' => $headerBackgroundImage,
        ];
    }
}
