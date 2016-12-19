<?php
/*
  Title: News Feed
  Description: Feed of posts in the category `News`
*/
?>
<?php
  $news_sidebar = empty($settings['news_sidebar']) ? '' : $settings['news_sidebar'];
  $widget_title = empty($settings['news_feed_title']) ? 'News' : $settings['news_feed_title'];
  $post_count = empty($settings['news_widget_post_count']) ? '3' : $settings['news_widget_post_count'];
  // News feed
  $news = array(
    'category_name' => 'news',
    'posts_per_page' => $post_count,
  );
  $the_query = new WP_Query($news);
?>

<?php if ($the_query->have_posts()): ?>
  <?php
    if ($news_sidebar != 'true') {
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
      $intro = get_post_meta($post->ID, 'intro', true);
      $body = strip_tags(get_the_content());
      $kicker = get_post_meta($post->ID, 'kicker', true);;
      $button_text = 'Read More';
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
<?php endif; ?>
