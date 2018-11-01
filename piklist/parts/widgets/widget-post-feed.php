<?php
/*
  Title: Post Feed
  Description: Feed of posts in the selected category
*/
?>
<?php
  $feed_category = empty($settings['feed_category_list']) ? 'news' : $settings['feed_category_list'];
  $for_sidebar = empty($settings['for_sidebar']) ? '' : $settings['for_sidebar'];
  $widget_title = empty($settings['feed_title']) ? 'News' : $settings['feed_title'];
  $post_count = empty($settings['feed_widget_post_count']) ? '-1' : $settings['feed_widget_post_count'];
  $btn_text = empty($settings['feed_widget_btn_text']) ? '' : $settings['feed_widget_btn_text'];
  $btn_link = empty($settings['feed_widget_btn_link']) ? '' : $settings['feed_widget_btn_link'];

  // Post Feed args
  $args = array(
    'cat' => $feed_category,
    'posts_per_page' => $post_count,
  );
  $the_query = new WP_Query($args);
?>

<?php if ($the_query->have_posts()): ?>
  <?php
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
  ?>

  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <?php
      $title = get_the_title();
      $intro = get_post_meta(get_the_ID(), 'intro', true);
      $body = strip_tags(get_the_content());
      $body = strip_shortcodes($body);
      $kicker = get_post_meta(get_the_ID(), 'kicker', true);
      $button_text = __('Read More', 'sage');
      $button_url = get_the_permalink();
      $round_image = '';
      $thumb_id = get_post_thumbnail_id();
      $thumbnail = wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0];
      $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
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
  <?php endif; ?>
<?php endif; ?>
