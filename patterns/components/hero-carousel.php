<?php
  $carousel_type = get_post_meta($post->ID, 'carousel_type', true);
  $carousel_slides = get_post_meta($post->ID, 'carousel_slides', true);
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
      ?>
        <div class="carousel__item rel">
          <picture class="picture">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <source srcset="<?php echo wp_get_attachment_image_url( $image, 'featured__hero--xl' ); ?>" media="(min-width: 1100px)">
            <source srcset="<?php echo wp_get_attachment_image_url( $image, 'featured__hero--l' ); ?>" media="(min-width: 800px)">
            <source srcset="<?php echo wp_get_attachment_image_url( $image, 'featured__hero--m' ); ?>" media="(min-width: 500px)">
            <!--[if IE 9]></video><![endif]-->
            <img itemprop="image" srcset="<?php echo wp_get_attachment_image_url( $image, 'featured__hero--s' ); ?>" alt="<?php echo $title; ?>">
          </picture>
          <?php if ($title): ?>
            <div class="carousel__item-text__wrap">
              <div class="layout-container">
                <div class="carousel__item-text spacing--half">
                  <div>
                    <?php if ($title): ?>
                      <h2 class="carousel__item-heading font--tertiary--xl theme--primary-transparent-background-color"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php if ($subtitle): ?>
                      <br><h3 class="carousel__item-subtitle font--secondary--m theme--primary-transparent-background-color"><?php echo $subtitle; ?></h3>
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
          <?php endif; ?>
        </div> <!-- /.carousel__item -->
      <?php endforeach; wp_reset_postdata(); ?>
    </div> <!-- /.carousel__slides -->
  </div> <!-- /.carousel -->
</section> <!-- /.hero-carousel -->
