<?php
namespace App;

class TemplateHelpers {
    const POST_HEADER_TYPE_HERO = 'hero';
    const POST_HEADER_TYPE_SIMPLE = 'simple';
    const POST_HEADER_TYPE_FEATURED = 'featured';

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

        $headerHeroType = get_post_meta($postsRootPostId, '_hero_type', true);
        $isHeroHeader = $headerHeroType && $headerHeroType !== 'false';

        $GLOBALS["headerTitle"] = $headerTitle;
        $GLOBALS["headerKicker"] = $headerKicker;
        $GLOBALS["headerSubtitle"] = $headerSubtitle;

        $GLOBALS["isVisibleFeaturedImage"] = $isVisibleFeaturedImage;
        $GLOBALS["headerBackgroundImage"] = $headerBackgroundImage;
        $GLOBALS["postsRootPostIsVisibleSidebar"] = $postsRootPostIsVisibleSidebar;

        $GLOBALS["headerHeroType"] = $headerHeroType;
        $GLOBALS["isHeroHeader"] = $isHeroHeader;

        return [
            'postsRootPostId' => $postsRootPostId,
            'postsRootPostIsVisibleSidebar' => $postsRootPostIsVisibleSidebar,
            'headerType' => $isHeroHeader ? TemplateHelpers::POST_HEADER_TYPE_HERO : TemplateHelpers::POST_HEADER_TYPE_SIMPLE,
            'headerTitle' => $headerTitle,
            'headerKicker' => $headerKicker,
            'headerSubtitle' => $headerSubtitle,
            'headerBackgroundImage' => $headerBackgroundImage,
        ];
    }

    public static function getPostData($postId)
    {
        $isFeaturedImageHidden = get_post_meta($postId, '_hide_featured_image', true);
        $customImage = get_post_meta($postId, '_header_background_image', true);

        if (empty($customImage)){
            $thumbId = get_post_thumbnail_id($postId);
        }else{
            $thumbId = $customImage;
        }

        if ($isFeaturedImageHidden) {
            $headerType = \App\TemplateHelpers::POST_HEADER_TYPE_SIMPLE;
        } else {
            if (empty($customImage)){
                $headerType = $thumbId ? \App\TemplateHelpers::POST_HEADER_TYPE_FEATURED  : \App\TemplateHelpers::POST_HEADER_TYPE_SIMPLE;
            }else{
                $headerType = \App\TemplateHelpers::POST_HEADER_TYPE_FEATURED;
            }

        }

        $post = get_post($postId);

        $headerTitle = get_post_meta($postId, '_display_title', true);
        if (empty($headerTitle)){
            $headerTitle = $post->post_title;
        }
        $headerDesc  = $post->post_excerpt;
        $headerDate  = get_the_date('', $post->ID);
        $headerKicker = get_post_meta($post->ID, '_kicker', true);

        $headerCategory = '';
        $cat = get_the_category($post->ID);
        if (count($cat) > 0) {
            $headerCategory = $cat[0]->name;
        }

        $headerImageCaption = get_the_post_thumbnail_caption($post->ID);
        $headerImages = [
            's'  => wp_get_attachment_image_src($thumbId, 'horiz__4x3--s'),
            'm'  => wp_get_attachment_image_src($thumbId, 'horiz__4x3--m'),
            'l'  => wp_get_attachment_image_src($thumbId, 'horiz__4x3--l'),
            'xl' => wp_get_attachment_image_src($thumbId, 'horiz__4x3--xl'),
        ];

        $headerImages['s'][] = 0;
        $headerImages['m'][] = 500;
        $headerImages['l'][] = 800;
        $headerImages['xl'][] = 1100;

        return [
            'headerType'  => $headerType,
            'headerTitle' => $headerTitle,
            'headerDesc'  => $headerDesc,
            'headerDate'  => $headerDate,
            'headerCategory'  => $headerCategory,
            'headerImageCaption' => $headerImageCaption,
            'headerImages' => $headerImages,
            'headerKicker' => $headerKicker
        ];
    }
}
