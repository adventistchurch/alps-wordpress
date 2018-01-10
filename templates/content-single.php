<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php if (is_page_template('template-news.php')): ?>
    <?php include(locate_template('patterns/components/news-navigation.php')); ?>
  <?php endif; ?>
  <?php
    // Featured image
    $thumb_id = get_post_thumbnail_id();
    // Image alt
    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);

    $display_title = get_post_meta($post->ID, 'display_title', true);
    $kicker = get_post_meta($post->ID, 'kicker', true);
    $subtitle = get_post_meta($post->ID, 'subtitle', true);
    $intro = get_post_meta($post->ID, 'intro', true);
    $video_url = get_post_meta($post->ID, 'video_url', true);
    $hide_featured_image = get_post_meta($post->ID,'hide_featured_image', true);
    $caption = get_the_excerpt($thumb_id);
  ?>
  <div class="layout-container full--until-large">
    <div class="flex-container cf">
      <div class="shift-left--fluid column__primary bg--white can-be--dark-light no-pad--btm">
        <div class="pad--primary spacing">
          <?php if (function_exists('wordpress_breadcrumbs')) wordpress_breadcrumbs(); ?>
          <div class="text article__body spacing">
            <header class="article__header article__flow spacing--quarter">
              <h1 class="font--secondary--xl theme--secondary-text-color">
                <?php if ($display_title): ?>
                  <?php echo $display_title; ?>
                <?php else: ?>
                  <?php the_title(); ?>
                <?php endif; ?>
              </h1>
              <?php if ($subtitle): ?>
                <h2 class="font--secondary--m"><?php echo $subtitle; ?></h2>
              <?php endif; ?>
              <?php if (in_category('news')): ?>
                <?php include(locate_template('patterns/components/share-tools.php')); ?>
              <?php endif; ?>
              <div class="article__meta">
                <span class="pub_date font--secondary--s gray can-be--white"><?php the_date(); ?></span>
                <?php
                  $theme_options = get_option('alps_theme_settings');
                  $hide_author_global = $theme_options['hide_author_global'];
                  $hide_author_post = get_post_meta($post->ID, 'hide_author_post', true);
                ?>
                <?php if ($hide_author_global == true || $hide_author_post == true): ?>
                <?php else: ?>
                  <span class="divider">|</span>
                  <span class="byline font--secondary--s gray can-be--white"><?php the_author(); ?></span>
                <?php endif; ?>
              </div>
            </header>
            <?php if ($video_url): ?>
              <?php include(locate_template('patterns/components/featured-video.php')); ?>
            <?php else: ?>
              <?php if ($thumb_id && $hide_featured_image != 'true'): ?>
                <figure class="figure">
                  <div class="article__hero img-wrap">
                    <img src="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]; ?>" alt="<?php echo $alt; ?>" class="article__hero-img">
                  </div>
                  <?php if ($caption): ?>
                    <figcaption class="figcaption">
                      <p class="font--secondary--xs"><?php echo $caption; ?></p>
                    </figcaption>
                  <?php endif; ?>
                </figure>
              <?php endif; ?>
            <?php endif; ?>
            <?php if ($intro): ?>
              <h3><?php echo $intro; ?></h3>
            <?php endif; ?>
            <?php the_content(); ?>
          </div>
          <?php comments_template('/templates/comments.php'); ?>
        </div>
        <?php include(locate_template('templates/block-layout.php')); ?>
      </div> <!-- /.shift-left--fluid -->
      <?php get_sidebar(); ?>
    </div> <!-- /.flex-container -->
  </div> <!-- /.layout-container -->
<?php endwhile; ?>
