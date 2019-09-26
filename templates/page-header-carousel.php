<?php
  $carousel_type    = get_alps_field( 'carousel_type' );
  $carousel_slides  = get_alps_field( 'carousel_slides' );
?>
<?php if ($carousel_type == 'large_format_2_col_4x3' && $carousel_slides || $carousel_type == 'large_format_2_col_16x9' && $carousel_slides): ?>
  <?php include(locate_template('patterns/components/hero-carousel__2-column.php')); ?>
<?php elseif ($carousel_type == 'large_format_inset' && $carousel_slides): ?>
  <?php include(locate_template('patterns/components/hero-carousel.php')); ?>
<?php else: ?>
  <?php get_template_part('templates/page', 'header'); ?>
<?php endif; ?>
