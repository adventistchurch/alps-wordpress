<?php
  $carousel_type = get_post_meta($post->ID, 'carousel_type', true);
  $carousel_slides = get_post_meta($post->ID, 'carousel_slides', true);
?>
<?php if ($carousel_type == 'large_format_2_col_4x3' || $carousel_type == 'large_format_2_col_16x9' || $carousel_type == 'standard_square_inset' && $carousel_slides): ?>
  <?php include(locate_template('patterns/components/hero-carousel__2-column.php')); ?>
<?php elseif ($carousel_type == 'large_format_inset' && $carousel_slides): ?>
  <?php include(locate_template('patterns/components/hero-carousel.php')); ?>
<?php else: ?>
  <?php get_template_part('templates/page', 'header'); ?>
<?php endif; ?>
