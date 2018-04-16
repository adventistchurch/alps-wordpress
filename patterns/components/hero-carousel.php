<?php
  $carousel_type = get_post_meta($post->ID, 'carousel_type', true);
  $carousel_slides = get_post_meta($post->ID, 'carousel_slides', true);
  if ($carousel_type == 'small_format_inset') {
    $image_size = 'horiz__16x9';
  } else {
    $image_size = 'featured__hero';
  }
?>
<section class="hero-carousel">
  <div class="carousel rel">
    <div class="carousel__slides js-carousel__single-item">
      <?php
        foreach ($carousel_slides as $slide): setup_postdata($slide);
        $image = $slide['carousel_image'][0];
        $title = $slide['carousel_title'];
        $subtitle = $slide['carousel_subtitle'];
        $description = $slide['carousel_description'];
        $link_text = $slide['carousel_link_text'];
        $link_url = $slide['carousel_link_url'];
        $align_right = $slide['carousel_text_align_right'];
      ?>
        <div class="carousel__item rel">
          <picture class="picture">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <?php if ($carousel_type == 'large_format_inset'): ?>
              <source srcset="<?php echo wp_get_attachment_image_url( $image, $image_size . '--xl' ); ?>" media="(min-width: 1100px)">
            <?php endif; ?>
            <source srcset="<?php echo wp_get_attachment_image_url( $image, $image_size . '--l' ); ?>" media="(min-width: 800px)">
            <source srcset="<?php echo wp_get_attachment_image_url( $image, $image_size . '--m' ); ?>" media="(min-width: 500px)">
            <!--[if IE 9]></video><![endif]-->
            <img itemprop="image" srcset="<?php echo wp_get_attachment_image_url( $image, $image_size . '--s' ); ?>" alt="<?php echo $title; ?>">
          </picture>

          <div class="carousel__item-text__wrap">
            <div class="layout-container">
              <div class="carousel__item-text<?php if ($align_right == 'true'): echo ' carousel__item--right'; endif; ?> spacing--half">
                <div class="carousel__item-text--inner">
                  <?php if ($title): ?>
                    <h2 class="carousel__item-heading font--tertiary--xl theme--primary-transparent-background-color"><?php echo $title; ?></h2>
                  <?php endif; ?>
                  <?php if ($subtitle): ?>
                    <h3 class="carousel__item-subtitle font--secondary--m theme--primary-transparent-background-color"><?php echo $subtitle; ?></h3>
                  <?php endif; ?>
                  <?php if ($description): ?>
                    <div class="carousel__item-dek pad-half--btm theme--primary-transparent-background-color">
                      <p><?php echo $description; ?></p>
                    </div> <!-- /.carousel__item-dek -->
                  <?php endif; ?>
                </div>
                <?php if ($link_url && $link_text): ?>
                  <a href="<?php echo $link_url; ?>" class="carousel__item-cta btn theme--secondary-background-color"><?php echo $link_text; ?></a>
                <?php endif; ?>
              </div> <!-- /.carousel__item-text -->
            </div>
          </div>
        </div> <!-- /.carousel__item -->
      <?php endforeach; wp_reset_postdata(); ?>
    </div> <!-- /.carousel__slides -->
  </div> <!-- /.carousel -->
</section> <!-- /.hero-carousel -->
