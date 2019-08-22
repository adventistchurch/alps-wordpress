<?php

use Carbon_Fields\Widget;
use Carbon_Fields\Field;



class ALPS_Social_Widget extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'alps_widget_social', 'ALPS - Social Links', 'Set your social links.', array(
            Field::make( 'text', 'facebook_url', 'Facebook URL' ) ,
            Field::make( 'text', 'twitter_url', 'Twiiter URL' ) ,
            Field::make( 'text', 'flickr_url', 'Flickr URL' ) ,
            Field::make( 'text', 'youtube_url', 'YouTube URL' ) ,
            Field::make( 'text', 'vimeo_url', 'Vimeo URL' ) ,
            Field::make( 'text', 'email_address', 'Email Address' ) ,
            Field::make( 'checkbox', 'horizontal_rule', __( 'Add a horizontal rule above the block' ) )
        ) );
    }
    function front_end( $args, $settings ) {
      $before_widget  = '';
      $before_list    = '<div class="widget-content"><ul class="aside-nav__list spacing--quarter">';
      $after_list     = '</ul></div>';
      $before_link    = '<li class="aside-nav__list-item rel">';
      $after_link     = '</a></li>';
      $link_classes   = 'aside-nav__link theme--primary-text-color font--primary--xs';
      $after_widget   = '';

      $facebook   = empty($settings['facebook_url']) ? '' : $settings['facebook_url'];
      $twitter    = empty($settings['twitter_url']) ? '' : $settings['twitter_url'];
      $flickr     = empty($settings['flickr_url']) ? '' : $settings['flickr_url'];
      $youtube    = empty($settings['youtube_url']) ? '' : $settings['youtube_url'];
      $vimeo      = empty($settings['vimeo_url']) ? '' : $settings['vimeo_url'];
      $email      = empty($settings['email_address']) ? '' : $settings['email_address'];
      $add_hr     = !empty($settings['horizontal_rule']) ? true : false;

      if ($add_hr == 'true') {
          echo '<hr>';
      }
      echo $before_widget;
      echo $before_list;
      if ($facebook) {
          echo $before_link;
          echo '<a href="' . $facebook . '" class="' . $link_classes . '" target="_blank">';
          echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="-491 493.4 16.6 16.5"><path d="M-475,508.4c0,0.5-0.4,1-1,1h-3.9v-6.1h1.9l0.3-2.2h-2.3v-1.8c0-0.6,0.3-1,1-1h1.5v-2 c0,0-0.7-0.1-1.6-0.1c-2.1,0-3.2,1.2-3.2,3v1.9h-1.9v2.2h1.9v6.1h-7.4c-0.5,0-1-0.4-1-1v-13.6c0-0.5,0.4-1,1-1h13.6c0.5,0,1,0.4,1,1 V508.4z"></path></svg></span>';
          echo 'Facebook';
          echo $after_link;
      }
      if ($twitter) {
          echo $before_link;
          echo '<a href="' . $twitter . '" class="' . $link_classes . '" target="_blank">';
          echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="-491 493.2 16.6 13.8"><path d="M-474.5,495.2c-0.4,0.7-1,1.2-1.6,1.7v0.4c0,0.9-0.1,1.7-0.4,2.6c-0.2,0.9-0.6,1.7-1.1,2.5 c-0.5,0.8-1.1,1.5-1.8,2.1c-0.7,0.6-1.6,1.1-2.6,1.4c-1,0.4-2.1,0.5-3.2,0.5c-1.9,0-3.6-0.4-4.9-1.3c0.3,0,0.5,0.1,0.8,0.1 c1.4,0,2.7-0.5,4-1.5c-0.7,0-1.3-0.2-1.9-0.6c-0.5-0.4-0.9-0.9-1.1-1.6c0.2,0,0.4,0.1,0.6,0.1c0.3,0,0.6,0,0.9-0.1 c-0.7-0.1-1.3-0.5-1.8-1.1c-0.5-0.6-0.7-1.3-0.7-2v0c0.5,0.3,0.9,0.4,1.4,0.4c-1-0.6-1.4-1.5-1.4-2.7c0-0.5,0.1-1,0.4-1.6 c0.8,1,1.8,1.8,2.9,2.3c1.1,0.6,2.4,0.9,3.7,1c0-0.2-0.1-0.5-0.1-0.7c0-0.9,0.3-1.6,0.9-2.3c0.6-0.6,1.4-0.9,2.3-0.9 c0.9,0,1.7,0.3,2.4,1c0.7-0.1,1.4-0.4,2-0.8c-0.2,0.8-0.7,1.4-1.4,1.8C-475.7,495.7-475.1,495.5-474.5,495.2z"></path></svg></span>';
          echo 'Twitter';
          echo $after_link;
      }
      if ($flickr) {
          echo $before_link;
          echo '<a href="' . $flickr . '" class="' . $link_classes . '" target="_blank">';
          echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.63 44.28"><path d="M21.9,72.61a22.14,22.14,0,0,1,0-44.28A22.14,22.14,0,0,1,21.9,72.61Zm56.19,0A22.14,22.14,0,1,1,99.81,50.48,21.93,21.93,0,0,1,78.09,72.61Z" transform="translate(-0.19 -28.33)"></path></svg></span>';
          echo 'Flickr';
          echo $after_link;
      }
      if ($youtube) {
          echo $before_link;
          echo '<a href="' . $youtube . '" class="' . $link_classes . '" target="_blank">';
          echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 97.45 68.54"><path d="M97.75,30.52s-1-6.72-3.87-9.67C90.17,17,86,16.94,84.11,16.72c-13.64-1-34.09-1-34.09-1h0s-20.46,0-34.09,1C14,16.94,9.83,17,6.12,20.84c-2.92,3-3.87,9.67-3.87,9.67a147.37,147.37,0,0,0-1,15.77v7.39a147.37,147.37,0,0,0,1,15.77s1,6.72,3.87,9.67C9.83,83,14.7,82.88,16.87,83.29c7.8,0.75,33.13,1,33.13,1s20.48,0,34.11-1C86,83,90.17,83,93.88,79.13c2.92-3,3.87-9.67,3.87-9.67a147.59,147.59,0,0,0,1-15.77V46.29A147.59,147.59,0,0,0,97.75,30.52ZM39.94,62.64V35.26L66.27,49Z" transform="translate(-1.28 -15.73)"></path></svg></span>';
          echo 'Youtube';
          echo $after_link;
      }
      if ($vimeo) {
          echo $before_link;
          echo '<a href="' . $vimeo . '" class="' . $link_classes . '" target="_blank">';
          echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99 88"><path d="M99,27.12C93.48,58.87,62.57,85.75,53.27,91.89s-17.78-2.46-20.86-9C28.89,75.52,18.34,35.32,15.58,32S4.52,35.32,4.52,35.32l-4-5.37S17.34,9.46,30.15,6.9C43.74,4.18,43.72,28.15,47,41.46c3.16,12.87,5.29,20.24,8,20.24s8-7.18,13.82-18.18S68.6,22.77,57.29,29.68C61.81,2,104.54-4.62,99,27.12Z" transform="translate(-0.5 -6)"></path></svg></span>';
          echo 'Vimeo';
          echo $after_link;
      }
      if ($email) {
          echo $before_link;
          echo '<a href="mailto:' . $email . '" class="' . $link_classes . '" target="_blank">';
          echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.3 79.87"><path d="M96.92,10.25L1.64,43.83c-1.53.54-1.87,1.86-.05,2.59l20.48,8.21h0l12.15,4.87L93.49,16a0.81,0.81,0,0,1,1.14,1.14L52.15,63h0l-2.44,2.72,3.23,1.74h0L79.82,82a2.75,2.75,0,0,0,4.06-1.81L99.56,12.58C100,10.73,98.77,9.6,96.92,10.25ZM34.1,88.65c0,1.33.75,1.7,1.79,0.76C37.24,88.18,51.26,75.6,51.26,75.6L34.1,66.72V88.65Z" transform="translate(-0.35 -10.07)"></path></svg></span>';
          echo 'Email';
          echo $after_link;
      }
      echo $after_list;
      echo $after_widget;
    }
}

class ALPS_Text_With_Link_Widget extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'alps_widget_text_with_link', 'ALPS - Text with Link', 'Text block with formatted link.', array(
            Field::make( 'text', 'title', 'Title' ) ,
            Field::make( 'textarea', 'content', __( 'Content' ) ) ,
            Field::make( 'text', 'url', 'URL' ) 
                ->set_width( 50 ),
            Field::make( 'text', 'url_text', 'URL Text' )
                ->set_width( 50 )
        ) );
    }

    // Called when rendering the widget in the front-end
  function front_end( $args, $settings ) {
    $before_widget  = '';
    $before_title   = '';
    $after_title    = '';
    $after_widget   = '';
    ?>
    <div class="with-divider grid--uniform">
    <?php echo $before_widget; ?>
      <div class="widget_text_link can-be--dark-dark">
      <?php echo $before_title; ?>
        <?php if (!empty($settings['title'])): ?>
        <div class="icon icon--s"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.22 99.29"><title>List Icon</title><path d="M34.68,54.8H65.57V44.87H34.68V54.8ZM77.58,0.36H22.42a11.06,11.06,0,0,0-11,11V88.61a11.06,11.06,0,0,0,11,11H77.58a11.06,11.06,0,0,0,11-11V11.39A11.06,11.06,0,0,0,77.58.36Zm0,88.26H22.42V11.39H77.58V88.61ZM65.44,23.35H34.56V33H65.44V23.35Zm0,43.3H34.56v9.65H65.44V66.66Z" transform="translate(-11.39 -0.36)" fill="#010101" class="theme--primary-fill-color"/></svg></div>
        <?php echo $settings['title']; ?>
        <?php endif; ?>
        <?php echo $after_title; ?>
          <div class="media-block__inner spacing--quarter">
            <div class="media-block__content block__content">
            <div class="spacing--half">
            <?php if (!empty($settings['content'])): ?>
              <div class="text text--s pad-half--btm">
                <p class="media-block__description block__description">
                  <span class="font--primary--xs">
                    <?php echo $settings['content']; ?>
                  </span>
                </p>
              </div>
              <?php endif; ?>
              <?php if (!empty($settings['url'])): ?>
              <p>
                <a class="media-block__cta block__cta btn theme--secondary-background-color" href="<?php echo $settings['url']; ?>">
                <?php echo $settings['url_text']; ?>
                </a>
              </p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php echo $after_widget; ?>
    </div>
  <?php
    }
}

class ALPS_Post_Feed_Widget extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'alps_widget_post_feed', 'ALPS - Post Feed', 'Feed of posts in the selected caetgory.', array(
            Field::make( 'select', 'feed_category_list', __( 'Feed Category' ) )
                ->set_options( cat_list() ),
            Field::make( 'text', 'feed_title', 'Feed Title' ) ,
            Field::make( 'text', 'feed_widget_post_count', 'Number of Posts' ) ,
            Field::make( 'checkbox', 'for_sidebar', __( ' Format For Sidebar?' ) ),
            Field::make( 'text', 'feed_widget_btn_text', 'More Button Text' )
                ->set_width( 50 ),
            Field::make( 'text', 'feed_widget_btn_link', 'More Button Link' ) 
                ->set_width( 50 )
        ) );
    }

    // Called when rendering the widget in the front-end
    function front_end( $args, $settings ) {
      $feed_category  = empty($settings['feed_category_list']) ? 'news' : $settings['feed_category_list'];
      $for_sidebar    = empty($settings['for_sidebar']) ? '' : $settings['for_sidebar'];
      $widget_title   = empty($settings['feed_title']) ? 'News' : $settings['feed_title'];
      $post_count     = empty($settings['feed_widget_post_count']) ? '-1' : $settings['feed_widget_post_count'];
      $btn_text       = empty($settings['feed_widget_btn_text']) ? '' : $settings['feed_widget_btn_text'];
      $btn_link       = empty($settings['feed_widget_btn_link']) ? '' : $settings['feed_widget_btn_link'];

      $args = array(
        'cat' => $feed_category,
        'posts_per_page' => $post_count,
      );
    $the_query = new WP_Query($args);
  ?>

  <?php 
    if ($the_query->have_posts()): 
      if ($for_sidebar != 'true') {
        $block_inner_class = 'block__row';
        $excerpt_length = 200;
        $hr = '<hr class="w--100p">';
        echo '<h2 class="font--tertiary--l theme--primary-text-color pad pad-double--top pad-half--btm">'. $widget_title . '</h2><hr>';
        $before_block = '<div class="spacing"><div class="pad">';
        $after_block = '</div></div>';
    } else {
        $block_inner_class = 'block__row--small-to-large';
        $excerpt_length = 100;
        $hr = '';
        echo '<h3 class="font--tertiary--m theme--secondary-text-color">'. $widget_title . '</h3>';
        $before_block = '';
        $after_block = '';
    }
    while ($the_query->have_posts()) : $the_query->the_post(); 
      $title        = get_the_title();
      $intro        = get_post_meta(get_the_ID(), '_intro', true);
      $body         = strip_tags(get_the_content());
      $body         = strip_shortcodes($body);
      $kicker       = get_post_meta(get_the_ID(), '_kicker', true);
      $button_text  = __('Read More', 'sage');
      $button_url   = get_the_permalink();
      $round_image  = '';
      $thumb_id     = get_post_thumbnail_id();
      $thumbnail    = wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0];
      $alt          = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
      if (isset($post->post_date) && $post->post_type == 'post') {
        $date = get_the_date('M j, Y');
        $date_formatted = get_the_date('c');
    }
    ?>
    <?php echo $before_block; ?>
      <?php include(locate_template('patterns/blocks/block-media.php')); ?>
    <?php echo $after_block; ?>
  <?php endwhile; ?>
  <?php wp_reset_query(); ?>
  <?php if ($btn_link): ?>
    <hr/>
    <a class="center-block btn theme--secondary-background-color space space--top space-half--btm"  style="display:table;" href="<?php echo $btn_link; ?>"><?php echo $btn_text; ?></a>
  <?php endif;
    endif; 

  } // front_end
}

add_action( 'widgets_init', 'alps_widgets' );
function alps_widgets() {
    register_widget( 'ALPS_Social_Widget' );
    register_widget( 'ALPS_Text_With_Link_Widget' );
    register_widget( 'ALPS_Post_Feed_Widget' );
}

function cat_list() {
    // NEED TO BUILD CUSTOM CATEGORY LIST HERE DUE TO CARBON FIELDS ERROR
    $categories = get_categories( array( 'orderby' => 'name' ) );
    $cats = [];
    foreach ( $categories as $cat ) {
      $cats[ $cat->term_id ] = $cat->name;
    }
    return $cats;
}
