<?php
/**
 * Template Name: News Template
 */
  $theme_options = get_option('alps_theme_settings');
  $categories = $theme_options['category'];
  $category_ids = array();
  foreach ($categories as $category){
    $category_ids[] = $category;
  }
  $category_ids = implode(',', $category_ids);
?>
<?php get_template_part('templates/page', 'header-carousel'); ?>
<?php include(locate_template('patterns/components/news-navigation.php')); ?>
<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white no-pad--top no-pad--btm can-be--dark-light">
      <?php $carousel_type = get_post_meta($post->ID, 'carousel_type', true); ?>
      <?php if ($carousel_type == 'small_format_inset'): ?>
        <?php include(locate_template('patterns/components/hero-carousel.php')); ?>
      <?php endif; ?>
      <div class="g g-2up--at-medium with-divider">
        <div class="gi">
          <div class="spacing">
            <div class="spacing--half">
              <h2 class="font--tertiary--l theme--primary-text-color pad pad-double--top pad-half--btm">
                <?php _e('Recent', 'sage'); ?> <?php the_title(); ?>
              </h2>
            </div>
            <hr>
            <?php
              // Recent News
              $news = array(
                'cat' => array($category_ids),
                'posts_per_page' => 4,
                'tax_query' => array( array(
                  'taxonomy' => 'post_format',
                  'field' => 'slug',
                  'terms' => array('post-format-video' , 'post-format-gallery'),
                  'operator' => 'NOT IN'
                ))
              );
              query_posts($news);
            ?>
            <?php while (have_posts()) : the_post(); ?>
              <div class="pad">
                <?php
                  $title = get_the_title();
                  $intro = get_post_meta($post->ID, 'intro', true);;
                  $body = strip_tags(get_the_content());
                  $body = strip_shortcodes($body);
                  $excerpt_length = 100;
                  $image = get_post_thumbnail_id();
                  $button_text = __('Read More', 'sage');
                  $date = get_the_date();
                  $button_url = get_the_permalink();
                  $round_image = get_post_meta($post->ID, 'make_the_image_round', true);
                  $thumbnail = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
                  $thumbnail_round = wp_get_attachment_image_src($image, "square--s")[0];
                  $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                  $block_inner_class = 'block__row--small-to-large';
                  if (isset($post->post_date) && $post->post_type == 'post') {
                    $date = get_the_date('M j, Y');
                    $date_formatted = get_the_date('c');
                  }
                ?>
                <?php include(locate_template('patterns/blocks/block-media.php')); ?>
              </div>
              <hr>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
          </div><!-- ./spacing -->
        </div><!-- ./gi -->
        <div class="gi pad-double--btm">
          <div class="spacing">
            <div class="spacing--half">
              <h2 class="font--tertiary--l theme--primary-text-color pad pad-double--top pad-half--btm">
                <?php _e('ANN Video', 'sage'); ?>
              </h2>
            </div>
            <hr>
            <?php
              // Featured Video
              $videos = array(
                'cat' => array($category_ids),
                'posts_per_page' => 1,
                'tax_query' => array( array(
                  'taxonomy' => 'post_format',
                  'field' => 'slug',
                  'terms' => array('post-format-video'),
                  'operator' => 'IN'
                ))
              );
              query_posts($videos);
            ?>
            <?php while (have_posts()) : the_post(); ?>
              <div class="pad no-pad--btm">
                <?php
                  $title = get_the_title();
                  $image = get_post_thumbnail_id();
                  $intro = '';
                  $body = '';
                  $button_url = get_the_permalink();
                  $button_text = '';
                  $thumbnail = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
                  $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                  $block_inner_class = 'block';
                  if (isset($post->post_date) && $post->post_type == 'post') {
                    $date = get_the_date('M j, Y');
                    $date_formatted = get_the_date('c');
                  }
                ?>
                <?php include(locate_template('patterns/blocks/block-media.php')); ?>
              </div>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>

            <div class="g g-2-split pad-half no-pad--top">
              <?php
                // Videos
                $videos = array(
                  'cat' => array($category_ids),
                  'posts_per_page' => 6,
                  'offset' => 1,
                  'tax_query' => array( array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-video'),
                    'operator' => 'IN'
                  ))
                );
                query_posts($videos);
              ?>
              <?php while (have_posts()) : the_post(); ?>
                <div class="gi spacing--half">
                  <div class="pad-half--left pad-half--right">
                    <?php
                      $title = get_the_title();
                      $title_size = 'font--secondary--s';
                      $image = get_post_thumbnail_id();
                      $intro = '';
                      $body = '';
                      $button_url = get_the_permalink();
                      $button_text = '';
                      $thumbnail = wp_get_attachment_image_src($image, "horiz__16x9--s")[0];
                      $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                      $block_inner_class = 'block';
                      if (isset($post->post_date) && $post->post_type == 'post') {
                        $date = get_the_date('M j, Y');
                        $date_formatted = get_the_date('c');
                      }
                    ?>
                    <?php include(locate_template('patterns/blocks/block-media.php')); ?>
                  </div>
                </div>
              <?php endwhile; ?>
              <?php wp_reset_query(); ?>
            </div>
            <hr />
            <div class="carousel-block block spacing--quarter">
              <h2 class="font--tertiary--m theme--primary-text-color pad pad-half--btm">
              <?php _e('Photos', 'sage'); ?>
              </h2>
              <div class="carousel-block__carousel carousel-nav--4-3">
                <div class="carousel rel ">
                  <div class="carousel__slides js-carousel__single-item">
                    <?php
                      // Photos
                      $gallery = array(
                        'cat' => array($category_ids),
                        'posts_per_page' => 3,
                        'tax_query' => array( array(
                          'taxonomy' => 'post_format',
                          'field' => 'slug',
                          'terms' => array('post-format-gallery'),
                          'operator' => 'IN'
                        ))
                      );
                      query_posts($gallery);
                    ?>
                    <?php while (have_posts()) : the_post(); ?>
                      <?php
                        $id = get_the_id();
                        $title = get_the_title();
                        $intro = get_post_meta($post->ID, 'intro', true);
                        $body = strip_tags(get_the_content());
                        $body = strip_shortcodes($body);
                        $excerpt_length = 100;
                        $image = get_post_thumbnail_id();
                        $button_text = __('Read More', 'sage');
                        $date = get_the_date();
                        $button_url = get_the_permalink();
                        $thumbnail = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
                        $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                        $block_inner_class = 'block';
                        if (isset($post->post_date) && $post->post_type == 'post') {
                          $date = get_the_date('M j, Y');
                          $date_formatted = get_the_date('c');
                        }
                      ?>
                      <?php include(locate_template('patterns/blocks/block-media-carousel.php')); ?>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                  </div>
                </div>
              </div>
            </div><!-- / .carousel-block__carousel -->
          </div>
        </div><!-- /.gi -->
      </div><!-- /.g -->
    </div> <!-- /.shift-left--fluid -->
    <?php get_sidebar(); ?>
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
