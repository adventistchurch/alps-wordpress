<?php if (have_rows('carousel_slides')): ?>
  <section class="hero-carousel">
    <div class="carousel rel">
      <div class="carousel__slides js-carousel__single-item">
        <?php
          while (have_rows('carousel_slides')): the_row();
            $image = get_sub_field('photo');
            $title = get_sub_field('title');
            $subtitle = get_sub_field('subtitle');
            $description = get_sub_field('description');
            $link_text = get_sub_field('link_text');
            $link_url = get_sub_field('link_url');
        ?>
          <div class="carousel__item rel">
            <picture class="picture">
              <!--[if IE 9]><video style="display: none;"><![endif]-->
              <source srcset="<?php echo $image['sizes']['featured__hero--xl']; ?>" media="(min-width: 1100px)">
              <source srcset="<?php echo $image['sizes']['featured__hero--l']; ?>" media="(min-width: 800px)">
              <source srcset="<?php echo $image['sizes']['featured__hero--m']; ?>" media="(min-width: 500px)">
              <!--[if IE 9]></video><![endif]-->
              <img itemprop="image" srcset="<?php echo $image['sizes']['featured__hero--s']; ?>" alt="<?php echo $title; ?>">
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
        <?php endwhile; ?>
      </div> <!-- /.carousel__slides -->
    </div> <!-- /.carousel -->
  </section> <!-- /.hero-carousel -->
<?php endif; ?>
