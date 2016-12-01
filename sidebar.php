<div class="shift-right--fluid bg--beige can-be--dark-dark">
  <?php if (is_front_page() && is_home() || !is_front_page() && is_home() || in_category('news') || is_page('recent-news')): ?>
    <?php include(locate_template('patterns/blocks/block-aside-nav.php')); ?>
  <?php else: ?>
    <?php
      // Beakout block.
      $title = get_field('title');
      $body = get_field('body');
      $image = get_field('image');
      $button_text = get_field('button_text');
      $url = get_field('button_url');
      $thumbnail = $image['sizes']['horiz__4x3--s'];
      $alt = $image['alt'];
    ?>
    <?php include(locate_template('patterns/blocks/block-breakout.php')); ?>
  <?php endif; ?>

  <div class="column__secondary can-be--dark-dark">
    <aside class="aside spacing--double">
      <div class="pad--secondary spacing--double">
        <?php if (is_active_sidebar('sidebar')): ?>
          <?php dynamic_sidebar('sidebar'); ?>
          <hr>
        <?php endif; ?>
        <?php
          // News feed
          $news = array(
            'category_name' => 'news',
            'posts_per_page' => 3,
          );
          query_posts($news);
        ?>
        <?php if (have_posts()): ?>
          <h3 class="font--tertiary--m theme--secondary-text-color">News</h3>
          <?php while (have_posts()) : the_post(); ?>
            <?php
              $title = get_the_title();
              $intro = get_field('intro');
              $image = get_field('image');
              $body = strip_tags(get_the_content());
              $excerpt_length = 100;
              $kicker = get_sub_field('kicker');
              $button_text = 'Read More';
              $button_url = get_the_permalink();
              $round_image = '';
              $thumb_id = get_post_thumbnail_id();
              $thumbnail = wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0];
              $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
              $block_inner_class = 'block__row--small-to-large';
              if (isset($post->post_date) && $post->post_type == 'post') {
                $date = get_the_date('M j, Y');
                $date_formatted = get_the_date('c');
              }
            ?>
            <?php include(locate_template('patterns/blocks/block-media.php')); ?>
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
        <?php endif; ?>
      </div>
    </aside>
  </div>
</div> <!-- /.shift-right--fluid -->
