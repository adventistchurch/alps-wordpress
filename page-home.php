<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header-carousel'); ?>
  <div class="layout-container full--until-large">
    <div class="flex-container cf">
      <div class="shift-left--fluid column__primary bg--white can-be--dark-light no-pad--btm">
        <div class="spacing--double flex h--100p">
          <div class="pad--primary spacing text">
            <h2 class="font--tertiary--l theme--primary-text-color"><?php if (get_field('display_title')): the_field('display_title'); else: the_title(); endif; ?></h2>
            <?php the_content(); ?>
          </div>
          <?php include(locate_template('templates/block-layout-front.php')); ?>
          <?php include(locate_template('patterns/blocks/block-story.php')); ?>
        </div>
      </div> <!-- /.shift-left--fluid -->
      <div class="shift-right--fluid bg--beige can-be--dark-dark">
        <?php include(locate_template('patterns/components/aside.php')); ?>
      </div> <!-- /.shift-right--fluid -->
    </div> <!-- /.flex-container -->
  </div> <!-- /.layout-container -->
<?php endwhile; ?>
