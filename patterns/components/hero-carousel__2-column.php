<?php
  $carousel_type = get_post_meta($post->ID, 'carousel_type', true);
  $carousel_slides = get_post_meta($post->ID, 'carousel_slides', true);

  // Assume 4:3.
  $carousel_nav_class = 'carousel-nav--4-3--until-large';
  $carousel_image_size = 'horiz__4x3';
  if ($carousel_type == 'large_format_2_col_16x9') {
    $carousel_nav_class = 'carousel-nav--16-9--until-large';
    $carousel_image_size = 'horiz__16x9';
  }
?>
<section class="hero-carousel layout-container hero-carousel--2-column">

  <div class="carousel rel <?php echo $carousel_nav_class; ?>">
    <div class="carousel__slides js-carousel__single-item">
      <?php
        foreach ($carousel_slides as $slide): setup_postdata($slide);
        $image = $slide['carousel_image'][0];
        $title = $slide['carousel_title'];
        $subtitle = $slide['carousel_subtitle'];
        $description = $slide['carousel_description'];
        $link_text = $slide['carousel_link_text'];
        $link_url = $slide['carousel_link_url'];
      ?>
        <div class="carousel__item carousel__slide cf spacing rel">
          <div class="flex-container">
            <div class="shift-left--fluid">
              <picture class="picture">
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source srcset="<?php echo wp_get_attachment_image_url( $image, $carousel_image_size . '--m' ); ?>" media="(min-width: 600px)">
                <!--[if IE 9]></video><![endif]-->
                <img itemprop="image" srcset="<?php echo wp_get_attachment_image_url( $image, $carousel_image_size . '--s' ); ?>" alt="<?php echo $title; ?>">
              </picture>
            </div> <!-- /.shift-left--fluid -->
            <?php if ($title): ?>
              <div class="shift-right--fluid">
                <div class="spacing--half pad--top">
                  <?php if ($title): ?>
                    <h2 class="carousel__slide-heading font--tertiary--l theme--primary-text-color"><?php echo $title; ?></h2>
                  <?php endif; ?>
                  <?php if ($subtitle): ?>
                    <h3 class="carousel__slide-subtitle font--secondary--m"><?php echo $subtitle; ?></h3>
                  <?php endif; ?>
                  <?php if ($description): ?>
                    <div class="carousel__slide-dek pad-half--btm">
                      <p><?php echo $description; ?></p>
                    </div> <!-- /.carousel__item-dek -->
                  <?php endif; ?>
                  <?php if ($link_url && $link_text): ?>
                    <a href="<?php echo $link_url; ?>" class="carousel__slide-cta btn theme--secondary-background-color"><?php echo $link_text; ?></a>
                  <?php endif; ?>
                </div> <!-- /.spacing--half -->
              </div> <!-- /.shift-right--fluid -->
            <?php endif; ?>
          </div>
        </div> <!-- /.carousel__item -->
      <?php endforeach; wp_reset_postdata(); ?>
    </div> <!-- /.carousel__slides -->
  </div> <!-- /.carousel -->
</section> <!-- /.hero-carousel -->
