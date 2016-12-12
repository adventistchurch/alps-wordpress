<?php
  // Featured image.
  $thumb_id = get_post_thumbnail_id();
  // Image alt
  $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
  $display_title = get_post_meta($post->ID, 'display_title', true);
  $intro = get_post_meta($post->ID, 'intro', true);
  $hide_featured_image = get_post_meta($post->ID, 'hide_featured_image', true);
  $video_url = get_post_meta($post->ID, 'video_url', true);
  $carousel_type = get_post_meta($post->ID, 'carousel_type', true);
?>
<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white can-be--dark-light no-pad--btm">
      <div class="pad--primary spacing">
        <?php if ($carousel_type == 'small_format_inset'): ?>
          <?php include(locate_template('patterns/components/hero-carousel.php')); ?>
        <?php endif; ?>
        <div class="text article__body spacing">
          <?php if ($display_title): ?>
            <h2 class="font--tertiary--l theme--primary-text-color"><?php echo $display_title; ?></h2>
          <?php endif; ?>
          <?php if ($video_url): ?>
            <?php include(locate_template('patterns/components/featured-video.php')); ?>
          <?php else: ?>
            <?php if ($thumb_id && $hide_featured_image != 'true'): ?>
              <div class="article__hero">
                <img src="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]; ?>" alt="<?php echo $alt; ?>" class="article__hero-img">
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <?php if ($intro): ?>
            <h3><?php echo $intro; ?></h3>
          <?php endif; ?>
          <?php the_content(); ?>
        </div>
      </div>
      <?php include(locate_template('templates/block-layout.php')); ?>
    </div> <!-- /.shift-left--fluid -->
    <?php get_sidebar(); ?>
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
