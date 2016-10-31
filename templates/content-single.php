<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
    <div class="layout-container full--until-large">
      <div class="column__primary bg--white can-be--dark-light spacing--double">
        <div class="text article__body longform__body spacing center-block">
          <?php the_content(); ?>
        </div>
        <?php include(locate_template('templates/block-layout-posts.php')); ?>
      </div> <!-- /.shift-left--fluid -->
    </div> <!-- /.flex-container -->
  </div> <!-- /.layout-container -->
<?php endwhile; ?>
