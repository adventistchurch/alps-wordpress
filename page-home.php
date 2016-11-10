<?php while (have_posts()) : the_post();
    // Get carousel format.
    $carousel_format = get_field('carousel_type');
  ?>
  <?php if ($carousel_format == "large_format_2_col_4x3" || $carousel_format == "large_format_2_col_16x9"): ?>
    <?php include(locate_template('patterns/components/hero-carousel__2-column.php')); ?>
  <?php elseif ($carousel_format == "large_format_inset"): ?>
    <?php include(locate_template('patterns/components/hero-carousel.php')); ?>
  <?php elseif ($carousel_format == "standard_square_inset"): ?>
    <?php include(locate_template('patterns/components/hero-carousel__2-column.php')); ?>
  <?php else: ?>
    <?php get_template_part('templates/page', 'header'); ?>
  <?php endif; ?>

  <div class="layout-container full--until-large">
    <div class="flex-container cf">
      <div class="shift-left--fluid column__primary bg--white can-be--dark-light no-pad--btm">
        <div class="spacing--double">
          <div class="pad--primary spacing text">
            <h2 class="font--tertiary--l theme--primary-text-color"><?php if (get_field('display_title')): the_field('display_title'); else: the_title(); endif; ?></h2>
            <?php the_content(); ?>
          </div>
          <?php include(locate_template('templates/block-layout.php')); ?>
          <?php include(locate_template('patterns/blocks/block-story.php')); ?>
        </div>
      </div> <!-- /.shift-left--fluid -->
      <div class="shift-right--fluid bg--beige can-be--dark-dark">
        <?php include(locate_template('patterns/components/aside.php')); ?>
      </div> <!-- /.shift-right--fluid -->
    </div> <!-- /.flex-container -->
  </div> <!-- /.layout-container -->
<?php endwhile; ?>
