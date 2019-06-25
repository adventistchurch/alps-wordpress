<?php
  while (have_posts()) : the_post(); 
  if ( ! is_page( 'migrate' ) ) {  ?>
  <?php get_template_part('templates/page', 'header-carousel'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
  <?php
  } else { 
    get_template_part( 'template', 'migrate' );
  }
  endwhile; ?>
