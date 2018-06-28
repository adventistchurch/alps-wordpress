<?php
/**
 * Template Name: Landing Page Template
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header-carousel'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
