<?php
/**
 * Template Name: Home Template
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header-carousel'); ?>
  <div class="layout-container full--until-large">
    <div class="flex-container cf">
      <div class="shift-left--fluid column__primary bg--white can-be--dark-light no-pad--btm">
        <div class="spacing--double flex h--100p">
          <?php if (is_active_sidebar('widget_area_primary_top')): ?>
            <div class="pad--primary spacing text">
              <?php dynamic_sidebar('widget_area_primary_top'); ?>
            </div>
          <?php endif; ?>
          <?php if (get_post_meta($post->ID, 'display_title', true) || get_the_content()): ?>
            <div class="pad--primary spacing text">
              <?php if (get_post_meta($post->ID, 'display_title', true)): ?>
                <h2 class="font--tertiary--l theme--primary-text-color">
                  <?php echo get_post_meta($post->ID, 'display_title', true); ?>
                </h2>
              <?php endif; ?>
              <?php the_content(); ?>
            </div>
          <?php endif; ?>
          <?php if (is_active_sidebar('widget_area_primary')): ?>
            <div class="with-divider grid--uniform">
              <?php dynamic_sidebar('widget_area_primary'); ?>
            </div>
          <?php endif; ?>
          <?php include(locate_template('templates/block-layout-front.php')); ?>
          <?php include(locate_template('patterns/blocks/block-story.php')); ?>
          <?php if (is_active_sidebar('widget_area_primary_bottom')): ?>
            <div class="pad--primary spacing text">
              <?php dynamic_sidebar('widget_area_primary_bottom'); ?>
            </div>
          <?php endif; ?>
        </div>
      </div> <!-- /.shift-left--fluid -->
      <?php get_sidebar(); ?>
    </div> <!-- /.flex-container -->
  </div> <!-- /.layout-container -->
<?php endwhile; ?>
