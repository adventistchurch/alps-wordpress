<?php
/**
 * Template Name: Long Form Template
 */

 // Featured image.
 $thumb_id = get_post_thumbnail_id();
 // Image alt
 $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);

 $display_title = get_post_meta($post->ID, 'display_title', true);
 $kicker = get_post_meta($post->ID, 'kicker', true);
 $subtitle = get_post_meta($post->ID, 'subtitle', true);
 $intro = get_post_meta($post->ID, 'intro', true);
 $hide_featured_image = get_post_meta($post->ID,'hide_featured_image', true);
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
