<?php
namespace App;

class TemplateHelpers {
    /**
     * Get sidebar visibility for Post List
     *
     * @return bool
     */
    public static function isVisibleSidebarOnArchive()
    {
        if (get_option('show_on_front') === 'page') {
            $postsRootPostId = get_option('page_for_posts');
            $isVisible = !get_post_meta($postsRootPostId, '_hide_sidebar', true);
        } else {
            $isVisible = !get_alps_option('index_hide_sidebar') && !get_alps_option('archive_hide_sidebar');
        }
        return $isVisible;
    }

    /**
     * Get sidebar visibility for Home Page
     *
     * @return bool
     */
    public static function isVisibleSidebarOnFront()
    {
        if (get_option('show_on_front') === 'page') {
            $frontRootPostId = get_option('page_on_front');
            $isVisible = !get_post_meta($frontRootPostId, '_hide_sidebar', true);
        } else {
            $isVisible = !get_alps_option('index_hide_sidebar');
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
