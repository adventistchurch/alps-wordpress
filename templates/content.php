<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white no-pad--top no-pad--btm can-be--dark-light">
      <?php $carousel_format = get_field('carousel_type');?>
      <?php if ($carousel_format == "small_format_inset"): ?>
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
          <?php if (is_home()): ?>
            All News
          <?php elseif (is_category()): ?>
            <?php $categories = get_the_category(); ?>
            <?php if (!empty($categories)): ?>
                All <?php echo esc_html($categories[0]->name); ?>
            <?php endif; ?>
          <?php endif; ?>
        </h2>
        <hr>
      </div>
      <div class="g g-3up--at-medium with-divider grid--uniform">
        <?php if (have_posts()): ?>
          <?php while (have_posts()) : the_post(); ?>
            <div class="gi">
              <div class="spacing">
                <div class="pad">
                  <?php
                    $title = get_the_title();
                    $intro = get_field('intro');
                    $body = strip_tags(get_the_content());
                    $excerpt_length = 100;
                    $image = get_post_thumbnail_id();
                    $button_text = 'Read More';
                    $date = get_the_date();
                    $button_url = get_the_permalink();
                    $round_image = get_sub_field('make_the_image_round');
                    $thumbnail = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
                    $thumbnail_round = wp_get_attachment_image_src($image, "square--s")[0];
                    $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                    $block_inner_class = 'block__row--small-to-large';
                  ?>
                  <?php include(locate_template('patterns/blocks/block-media.php')); ?>
                </div>
              </div>
            </div> <!-- /.gi -->
          <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
      </div> <!-- /.2up--at-medium -->
    </div> <!-- /.shift-left--fluid -->
    <div class="shift-right--fluid bg--beige can-be--dark-dark">
      <?php include(locate_template('patterns/components/aside.php')); ?>
    </div> <!-- /.shift-right--fluid -->
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
