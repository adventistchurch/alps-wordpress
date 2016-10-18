<?php
  // Featured image.
  $thumb_id = get_post_thumbnail_id();
  // Image alt
  $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
?>

<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white can-be--dark-light no-pad--btm">
      <div class="pad--primary spacing">
        <?php //include(locate_template('patterns/components/breadcrumb.php')); ?>
        <div class="text article__body spacing">
          <?php if (get_field('display_title')): ?>
            <h2><?php the_field('display_title'); ?></h2>
          <?php endif; ?>
          <?php if (get_field('intro')): ?>
            <p class="font--secondary--m theme--primary-text-color"><?php the_field('intro'); ?></p>
          <?php endif; ?>
          <?php if ($thumb_id && get_field('hide_featured_image') != TRUE): ?>
            <div class="article__hero">
              <img src="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]; ?>" alt="<?php echo $alt; ?>" class="article__hero-img">
            </div>
          <?php endif; ?>
          <?php the_content(); ?>
        </div>
      </div>
      <?php include(locate_template('templates/block-layout.php')); ?>
    </div> <!-- /.shift-left--fluid -->
    <div class="shift-right--fluid bg--beige can-be--dark-dark">
      <?php include(locate_template('patterns/components/aside.php')); ?>
    </div> <!-- /.shift-right--fluid -->
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
