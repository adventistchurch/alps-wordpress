<?php
/**
 * Template Name: Single Template
 */
 $blocks = get_post_meta($post->ID, 'primary_structured_content', true);
 $carousel_type = get_post_meta($post->ID, 'carousel_type', true);
 $carousel_slides = get_post_meta($post->ID, 'carousel_slides', true);
?>
<?php while (have_posts()) : the_post(); ?>
  <?php if ($carousel_type == 'large_format_2_col_4x3' && $carousel_slides || $carousel_type == 'large_format_2_col_16x9' && $carousel_slides): ?>
    <?php include(locate_template('patterns/components/hero-carousel__2-column.php')); ?>
  <?php elseif ($carousel_type == 'large_format_inset' && $carousel_slides): ?>
    <?php include(locate_template('patterns/components/hero-carousel.php')); ?>
  <?php else: ?>
    <?php get_template_part('templates/page', 'header'); ?>
  <?php endif; ?>
    <div class="layout-container full--until-large">
      <div class="column__primary bg--white can-be--dark-light spacing--double">
        <?php foreach ($blocks as $block): ?>
          <?php
            $block_layout = $block['content_block_layout'];
            $grid_layout = $block['content_block_grid_layout'];
            $image_layout = $block['content_block_image_layout'];
            $image = $block['content_block_image_file'][0];
            $grid_body_1 = $block['content_block_grid_body_1'];
            $grid_image_1 = $block['content_block_grid_file_1'][0];
            $grid_body_2 = $block['content_block_grid_body_2'];
            $grid_image_2 = $block['content_block_grid_file_2'][0];
            $grid_body_3 = $block['content_block_grid_body_3'];
            $grid_image_3 = $block['content_block_grid_file_3'][0];
          ?>

          <?php if ($block_layout == 'content_block_grid'): ?>
            <?php
              if ($grid_layout == '2up-70-30') {
               $grid_class = 'g-2up--70-30--at-medium';
               $grid_item_class = 'right-gutter--l';
              }
              elseif ($grid_layout == '2up-30-70') {
               $grid_class = 'g-2up--70-30--at-medium flip-columns';
               $grid_item_class = 'left-gutter--l';
              }
              elseif ($grid_layout == '2up-50-50') {
               $grid_class = 'g-2up--at-medium';
               $grid_item_class = 'right-gutter--l';
              }
              elseif ($grid_layout == '3up') {
               $grid_class = 'g-3up--at-medium with-gutters';
               $grid_item_class = 'right-gutter--l';
              }
              else {
               $grid_class = '';
               $grid_item_class = 'right-gutter--l';
              }
            ?>
            <div class="g <?php echo $grid_class; ?> pad--primary spacing">
              <div class="gi <?php echo $grid_item_class; ?>">
                <div class="text spacing">
                  <?php echo $grid_body_1; ?>
                  <?php
                    $thumb_id = wp_get_attachment_image_url( $grid_image_1, 'horiz__4x3--s' );
                    $caption = get_the_excerpt($grid_image_1);
                    $alt = get_post_meta( $grid_image_1, '_wp_attachment_image_alt', true );
                  ?>
                  <?php if ($thumb_id): ?>
                    <figure class="figure">
                      <div class="img-wrap">
                        <img itemprop="image" src="<?php echo $thumb_id; ?>" alt="<?php echo $alt; ?>">
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
                  <?php echo $grid_body_2; ?>
                  <?php
                    $thumb_id = wp_get_attachment_image_url( $grid_image_2, 'horiz__4x3--s' );
                    $caption = get_the_excerpt($grid_image_2);
                    $alt = get_post_meta( $grid_image_2, '_wp_attachment_image_alt', true );
                  ?>
                  <?php if ($thumb_id): ?>
                    <figure class="figure">
                      <div class="img-wrap">
                        <img itemprop="image" src="<?php echo $thumb_id; ?>" alt="<?php echo $alt; ?>">
                      </div> <!-- /.img-wrap -->
                      <?php if ($caption): ?>
                        <figcaption class="figcaption"><p class="font--secondary--xs"><?php echo $caption; ?></p></figcaption>
                      <?php endif; ?>
                    </figure>
                  <?php endif; ?>
                </div>
              </div>
              <?php if ($grid_layout == '3up'): ?>
                <div class="gi">
                  <div class="text spacing">
                    <?php echo $grid_body_3; ?>
                    <?php
                      $thumb_id = wp_get_attachment_image_url( $grid_image_3, 'horiz__4x3--s' );
                      $caption = get_the_excerpt($grid_image_3);
                      $alt = get_post_meta( $grid_image_3, '_wp_attachment_image_alt', true );
                    ?>
                    <?php if ($thumb_id): ?>
                      <figure class="figure">
                        <div class="img-wrap">
                          <img itemprop="image" src="<?php echo $thumb_id; ?>" alt="<?php echo $alt; ?>">
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

          <?php if ($block_layout == 'content_block_image'): ?>
            <?php if ($image_layout == 'full_width'): ?>
              <picture class="picture">
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source srcset="<?php echo wp_get_attachment_image_src($image, "featured__hero--xl")[0]; ?>" media="(min-width: 1100px)">
                <source srcset="<?php echo wp_get_attachment_image_src($image, "featured__hero--l")[0]; ?>" media="(min-width: 900px)">
                <source srcset="<?php echo wp_get_attachment_image_src($image, "featured__hero--m")[0]; ?>" media="(min-width: 500px)">
                <!--[if IE 9]></video><![endif]-->
                <img itemprop="image" srcset="<?php echo wp_get_attachment_image_src($image, "featured__hero--s")[0]; ?>" alt="<?php echo get_post_meta( $image, '_wp_attachment_image_alt', true ); ?>">
              </picture>
            <?php elseif ($image_layout == 'breakout' || $image_layout == 'breakout_parallax'): ?>
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
              <div class="breakout <?php if ($image_layout == 'breakout_parallax'): echo 'has-parallax'; endif; ?> breakout-image breakout-image_<?php echo $image; ?> bg--cover" data-type="background" <?php if ($image_layout == 'breakout_parallax'): echo 'data-speed="8"'; endif; ?>></div>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div> <!-- /.shift-left--fluid -->
    </div> <!-- /.flex-container -->
  </div> <!-- /.layout-container -->
<?php endwhile; ?>
