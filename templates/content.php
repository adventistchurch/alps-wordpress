<?php
  $carousel_type = '';
  if (is_page() || is_single()) {
      $carousel_type = get_post_meta($post->ID, 'carousel_type', true);
  }
?>
<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white no-pad--top no-pad--btm can-be--dark-light">
      <?php if ($carousel_type == 'small_format_inset'): ?>
        <?php include(locate_template('patterns/components/hero-carousel.php')); ?>
      <?php endif; ?>
      <?php if (!have_posts()) : ?>
        <div class="pad--primary no-pad--top no-pad--btm spacing--half text">
          <div class="alert alert-warning pad-double--top pad-half--btm">
            <?php _e('Sorry, no results were found.', 'sage'); ?>
          </div>
          <?php get_template_part('patterns/components/search-form'); ?>
        </div>
      <?php endif; ?>
      <div class="spacing--half">
        <h2 class="font--tertiary--l theme--primary-text-color pad pad-double--top pad-half--btm">
          <?php _e('All Posts', 'sage'); ?>
        </h2>
        <hr>
      </div>
      <div class="with-divider grid--uniform">
        <?php if (have_posts()): ?>
          <?php while (have_posts()) : the_post(); ?>
            <div class="">
              <div class="spacing">
                <div class="pad">
                  <?php
                    $title = get_the_title();
                    $intro = get_post_meta($post->ID, 'intro', true);
                    $body = strip_tags(get_the_content());
                    $body = strip_shortcodes($body);
                    $excerpt_length = 100;
                    $image = get_post_thumbnail_id();
                    $button_text = __('Read More', 'sage');
                    $date = get_the_date();
                    $button_url = get_the_permalink();
                    $round_image = 'false';
                    $thumbnail = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
                    $thumbnail_round = wp_get_attachment_image_src($image, "square--xs")[0];
                    $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                  ?>
                  <?php include(locate_template('patterns/blocks/block-media.php')); ?>
                </div>
              </div>
            </div> <!-- /.gi -->
          <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
      </div> <!-- /.2up--at-medium -->
      <div class="space--btm">
        <?php get_template_part('patterns/components/pagination'); ?>
      </div>
    </div> <!-- /.shift-left--fluid -->
    <?php get_sidebar(); ?>
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
