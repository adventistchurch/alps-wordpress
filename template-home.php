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
          <div class="pad--primary spacing text">
            <h2 class="font--tertiary--l theme--primary-text-color"><?php if (get_post_meta($post->ID, 'display_title', true)): get_post_meta($post->ID, 'display_title', true); else: the_title(); endif; ?></h2>
            <?php the_content(); ?>
          </div>
          <?php include(locate_template('templates/block-layout-front.php')); ?>
          <?php include(locate_template('patterns/blocks/block-story.php')); ?>
        </div>
      </div> <!-- /.shift-left--fluid -->
      <?php get_sidebar(); ?>
    </div> <!-- /.flex-container -->
  </div> <!-- /.layout-container -->
<?php endwhile; ?>
