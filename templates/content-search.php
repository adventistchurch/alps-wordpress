<?php
  // Featured image.
  $thumb_id = get_post_thumbnail_id();
  // Image alt
  $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
?>

<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white can-be--dark-light">
      <div class="spacing--one-and-half">
        <?php if (!have_posts()) : ?>
          <div class="pad--primary no-pad--top no-pad--btm spacing--half text">
            <div class="alert alert-warning">
              <?php _e('Sorry, no results were found.', 'sage'); ?>
            </div>
            <?php get_template_part('patterns/components/search-form'); ?>
          </div>
        <?php endif; ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="pad--primary no-pad--top no-pad--btm spacing--half text">
            <h3 class="brown font--tertiary--l theme--primary-text-color"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn font--secondary--s upper theme--secondary-background-color"><strong>Read More</strong></a>
          </div>
          <hr>
        <?php endwhile; ?>
        <?php get_template_part('patterns/components/posts-navigation'); ?>
      </div>
    </div> <!-- /.shift-left--fluid -->
    <div class="shift-right--fluid bg--beige can-be--dark-dark">
      <?php include(locate_template('patterns/components/aside.php')); ?>
    </div> <!-- /.shift-right--fluid -->
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
