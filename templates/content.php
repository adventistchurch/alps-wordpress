
<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white no-pad--top no-pad--btm can-be--dark-light">
      <?php if (!have_posts()) : ?>
        <div class="pad--primary no-pad--top no-pad--btm spacing--half text">
          <div class="alert alert-warning pad-double--top pad-half--btm">
            <?php _e('Sorry, no results were found.', 'sage'); ?>
          </div>
          <?php get_template_part('patterns/components/search-form'); ?>
        </div>
      <?php endif; ?>
      <div class="spacing--half">
        <h2 class="font--tertiary--l theme--primary-text-color pad pad-double--top pad-half--btm">
          <?php if(is_home()): ?>
            All News
          <?php elseif(is_category()): ?>
            <?php $categories = get_the_category(); ?>
            <?php if (!empty($categories)): ?>
                All <?php echo esc_html($categories[0]->name); ?>
            <?php endif; ?>
          <?php endif; ?>
        </h2>
        <hr>
      </div>
      <div class="g g-2up--at-medium with-divider grid--uniform">
        <?php while (have_posts()) : the_post(); ?>
          <div class="gi">
            <div class="spacing">
              <div class="pad">
                <div class="media-block block spacing--quarter">
                  <div class="media-block__inner spacing--quarter ">
                    <a class="media-block__image-wrap block__image-wrap db" href="<?php the_permalink(); ?>">
                      <?php
                        // Featured image.
                        $thumb_id = get_post_thumbnail_id();
                        // Image alt
                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                      ?>
                      <?php if ($thumb_id && get_field('hide_featured_image') != TRUE): ?>
                        <div class="dib">
                          <img src="<?php echo wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0]; ?>" alt="<?php echo $alt; ?>" class="media-block__image block__image">
                        </div>
                      <?php endif; ?>
                    </a> <!-- /.media-block__image-wrap -->
                    <div class="media-block__content block__content ">
                      <h3 class="media-block__title block__title "><a href="<?php the_permalink(); ?>" class="block__title-link theme--primary-text-color"><?php the_title(); ?></a></h3>
                      <time class="block__date font--secondary--xs brown space-half--btm" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time>
                      <div class="spacing--half">
                        <div class="text text--s pad-half--btm"><p class="media-block__description block__description"><span class="font--primary--xs"><?php the_excerpt(); ?></span></p></div>
                        <p><a class="media-block__cta block__cta btn theme--secondary-background-color" href="<?php the_permalink(); ?>">Read More</a></p>
                      </div> <!-- /.spacing -->
                    </div> <!-- media-block__content -->
                  </div> <!-- /.media-block__inner -->
                </div> <!-- /.media-block -->
              </div>
            </div>
          </div> <!-- /.gi -->
        <?php endwhile; ?>
      </div> <!-- /.2up--at-medium -->
      <?php the_posts_navigation(); ?>
    </div> <!-- /.shift-left--fluid -->
    <div class="shift-right--fluid bg--beige can-be--dark-dark">
      <?php include(locate_template('patterns/components/aside.php')); ?>
    </div> <!-- /.shift-right--fluid -->
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
