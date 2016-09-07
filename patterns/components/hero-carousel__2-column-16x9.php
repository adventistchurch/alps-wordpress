<?php if (have_rows('carousel_slides')):?>
  <section class="hero-carousel layout-container hero-carousel--2-column">
    <div class="carousel rel carousel-nav--16-9--until-large">
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
          <div class="carousel__item carousel__slide cf spacing rel">
            <div class="shift-left--fluid">
              <picture class="picture">
                <!--[if IE 9]><video style="display: none;"><![endif]-->
                <source srcset="<?php echo $image['sizes']['horiz--m']; ?>" media="(min-width: 600px)">
                <!--[if IE 9]></video><![endif]-->
                <img itemprop="image" srcset="<?php echo $image['sizes']['horiz--s']; ?>" alt="<?php echo $title; ?>">
              </picture>
            </div> <!-- /.shift-left--fluid -->
            <?php if ($title): ?>
              <div class="shift-right--fluid">
                <div class="spacing--half">
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
          </div> <!-- /.carousel__item -->
        <?php endwhile; ?>
      </div> <!-- /.carousel__slides -->
    </div> <!-- /.carousel -->
  </section> <!-- /.hero-carousel -->
<?php endif; ?>
