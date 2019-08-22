<?php
/**
 * Template Name: Long Form Template
 */

 $thumb_id            = get_post_thumbnail_id();
 $alt                 = get_alps_field( '_wp_attachment_image_alt', $thumb_id );
 $display_title       = get_alps_field( 'display_title', $post->ID );
 $kicker              = get_alps_field( 'kicker', $post->ID );
 $subtitle            = get_alps_field( 'subtitle', $post->ID );
 $intro               = get_alps_field( 'intro', $post->ID );
 $hide_featured_image = get_alps_field( 'hide_featured_image', $post->ID );
?>
<?php while (have_posts()) : the_post(); ?>
  <header class="longform__header  longform__header--with-hero">
    <div class="layout-container cf spacing">
      <div class="longform__header__text spacing--half">
        <h1 class="longform__heading font--tertiary--xl">
          <?php if ($display_title): ?>
            <?php echo $display_title; ?>
          <?php else: ?>
            <?php the_title(); ?>
          <?php endif; ?>
        </h1>
        <?php if ($subtitle): ?>
          <h2 class="font--secondary--m theme--primary-text-color"><?php echo $subtitle; ?></h2>
        <?php endif; ?>
      </div>
      <?php if ($thumb_id && $hide_featured_image != 'true'): ?>
        <div class="longform__hero">
          <picture class="picture">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source srcset="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--l")[0]; ?>" media="(min-width: 900px)">
            <source srcset="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]; ?>" media="(min-width: 500px)">
            <!--[if IE 9]></video><![endif]-->
            <img itemprop="image" srcset="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--s")[0]; ?>" alt="<?php echo $alt; ?>">
          </picture>
        </div>
      <?php endif; ?>
    </div>
  </header> <!-- /.longform__header -->
  <div class="layout-container">
    <div class="spacing column__primary">
      <div class="text article__body longform__body spacing center-block">
        <?php if ($intro): ?>
          <div>
            <p class="font--primary--l"><?php echo $intro; ?></p>
          </div>
        <?php endif; ?>
        <?php the_content(); ?>
      </div> <!-- /.article__body -->
    </div> <!-- /.spacing -->
  </div> <!-- /.layout-container -->
  <?php get_template_part('templates/page', 'footer'); ?>
<?php endwhile; ?>
