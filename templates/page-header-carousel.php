<?php $carousel_format = get_field('carousel_type');?>
<?php if ($carousel_format == "large_format_2_col_4x3" || $carousel_format == "large_format_2_col_16x9"): ?>
  <?php include(locate_template('patterns/components/hero-carousel__2-column.php')); ?>
<?php elseif ($carousel_format == "large_format_inset"): ?>
  <?php include(locate_template('patterns/components/hero-carousel.php')); ?>
<?php elseif ($carousel_format == "standard_square_inset"): ?>
  <?php include(locate_template('patterns/components/hero-carousel__2-column.php')); ?>
<?php else: ?>
  <?php get_template_part('templates/page', 'header'); ?>
<?php endif; ?>
