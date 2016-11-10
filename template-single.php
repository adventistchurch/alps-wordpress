<?php
/**
 * Template Name: Single Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php $carousel_format = get_field('carousel_type'); ?>
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
      <div class="column__primary bg--white can-be--dark-light spacing--double">
        <?php while (the_flexible_field("primary_structured_content")): ?>

          <?php if (get_row_layout() == "content_block_grid"):
            // Content Block: Grid
            $grid_layout = get_sub_field('grid_layout');
            if ($grid_layout == '2up-70-30') {
             $classes = 'g-2up--70-30--at-medium';
            } elseif ($grid_layout == '2up-50-50') {
             $classes = 'g-2up--at-medium';
            } elseif ($grid_layout == '3up') {
             $classes = 'g-3up--at-medium with-gutters';
            } else {
             $classes = '';
            }
          ?>
            <div class="g <?php echo $classes; ?> pad--primary spacing">
              <div class="gi right-gutter--l">
                <div class="text spacing">
                  <?php the_sub_field('grid_item_body_1'); ?>
                  <?php
                    $thumb_id = get_sub_field('grid_item_image_1')[id];
                    $caption = get_sub_field('grid_item_image_1')[caption];
                    $alt = get_sub_field('grid_item_image_1')[alt];
                  ?>
                  <?php if ($thumb_id): ?>
                    <figure class="figure">
                      <div class="img-wrap">
                        <img itemprop="image" src="<?php echo wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0]; ?>" alt="<?php echo $alt; ?>">
                      </div> <!-- /.img-wrap -->
                      <?php if ($caption): ?>
                        <figcaption class="figcaption"><p class="font--secondary--xs"><?php echo $caption; ?></p></figcaption>
                      <?php endif; ?>
                    </figure>
                  <?php endif; ?>
                </div>
              </div>
              <div class="gi">
                <div class="text spacing">
                  <?php the_sub_field('grid_item_body_2'); ?>
                  <?php
                    $thumb_id = get_sub_field('grid_item_image_2')[id];
                    $caption = get_sub_field('grid_item_image_2')[caption];
                    $alt = get_sub_field('grid_item_image_2')[alt];
                  ?>
                  <?php if ($thumb_id): ?>
                    <figure class="figure">
                      <div class="img-wrap">
                        <img itemprop="image" src="<?php echo wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0]; ?>" alt="<?php echo $alt; ?>">
                      </div> <!-- /.img-wrap -->
                      <?php if ($caption): ?>
                        <figcaption class="figcaption"><p class="font--secondary--xs"><?php echo $caption; ?></p></figcaption>
                      <?php endif; ?>
                    </figure>
                  <?php endif; ?>
                </div>
              </div>
              <?php if (($grid_layout) == '3up'): ?>
                <div class="gi">
                  <div class="text spacing">
                    <?php the_sub_field('grid_item_body_3'); ?>
                    <?php
                      $thumb_id = get_sub_field('grid_item_image_3')[id];
                      $caption = get_sub_field('grid_item_image_3')[caption];
                      $alt = get_sub_field('grid_item_image_3')[alt];
                    ?>
                    <?php if ($thumb_id): ?>
                      <figure class="figure">
                        <div class="img-wrap">
                          <img itemprop="image" src="<?php echo wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0]; ?>" alt="<?php echo $alt; ?>">
                        </div> <!-- /.img-wrap -->
                        <?php if ($caption): ?>
                          <figcaption class="figcaption"><p class="font--secondary--xs"><?php echo $caption; ?></p></figcaption>
                        <?php endif; ?>
                      </figure>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <?php if (get_row_layout() == "content_block_image"):
            // Content Block: Image
            $image = get_sub_field('image');
            $image_layout = get_sub_field('image_layout');
            $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
          ?>

            <?php
              //Full width media image
              if (($image_layout) == 'full_width'):
            ?>
              <picture class="picture">
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source srcset="<?php echo wp_get_attachment_image_src($image, "featured__hero--xl")[0]; ?>" media="(min-width: 1100px)">
                <source srcset="<?php echo wp_get_attachment_image_src($image, "featured__hero--l")[0]; ?>" media="(min-width: 900px)">
                <source srcset="<?php echo wp_get_attachment_image_src($image, "featured__hero--m")[0]; ?>" media="(min-width: 500px)">
                <!--[if IE 9]></video><![endif]-->
                <img itemprop="image" srcset="<?php echo wp_get_attachment_image_src($image, "featured__hero--s")[0]; ?>" alt="<?php echo $alt; ?>">
              </picture>
            <?php
              // Breakout media image
              elseif (($image_layout)== 'breakout'):
            ?>
              <style>
              .breakout-image_<?php echo $image; ?> { background-image: url(<?php echo wp_get_attachment_image_src($image, "featured__hero--s")[0]; ?>); }
              @media (min-width: 500px) {
                .breakout-image_<?php echo $image; ?> { background-image: url(<?php echo wp_get_attachment_image_src($image, "featured__hero--m")[0]; ?>); }
              }
              @media (min-width: 700px) {
                .breakout-image_<?php echo $image; ?> { background-image: url(<?php echo wp_get_attachment_image_src($image, "featured__hero--l")[0]; ?>); }
              }
              @media (min-width: 1200px) {
                .breakout-image_<?php echo $image; ?> { background-image: url(<?php echo wp_get_attachment_image_src($image, "featured__hero--xl")[0]; ?>); }
              }
              </style>
              <div class="breakout has-parallax breakout-image breakout-image_<?php echo $image; ?> bg--cover" data-type="background" data-speed="8"></div>
            <?php endif; ?>
          <?php endif; ?>
        <?php endwhile; ?>

      </div> <!-- /.shift-left--fluid -->
    </div> <!-- /.flex-container -->
  </div> <!-- /.layout-container -->
<?php endwhile; ?>
