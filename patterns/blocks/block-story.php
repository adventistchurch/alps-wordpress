<?php if (get_field('sb_url') && get_field('sb_title')): ?>
  <div class="story-block block spacing--half pad flex--end" <?php if (get_field('sb_background_image')): ?>style="background-image: url(<?php echo get_field('sb_background_image')['sizes']['square--l']; ?>)"<?php endif; ?>>
    <?php if (get_field('sb_thumbnail')): ?>
      <div class="story-block__image-wrap round">
        <img class="story-block__image" src="<?php echo get_field('sb_thumbnail')['sizes']['sb_thumbnail']; ?>" alt="<?php echo get_field('sb_thumbnail')['alt']; ?>" />
      </div>
    <?php endif; ?>
    <div class="story-block__content spacing">
      <div>
        <h2 class="story-block__heading font--secondary--l theme--secondary-text-color"><?php echo the_field('sb_title'); ?></h2>
        <?php if (get_field('sb_dek')): ?><p class="font--secondary--xs <?php if (get_field('sb_background_image')): ?>white<?php endif; ?>"><?php  the_field('sb_dek'); ?></p><?php endif; ?>
      </div>
      <div class="spacing">
        <div class="text story-block__description block__description spacing <?php if (get_field('sb_background_image')): ?>white<?php endif; ?>">
          <?php if (get_field('sb_side_image')): ?>
            <a class="story-block__text-image-wrap space-half--btm" href="<?php the_field('sb_url'); ?>">
              <?php if (get_field('is_video')): ?><div class="is-video"><?php endif; ?>
              <img class="story-block__text-image" src="<?php echo get_field('sb_side_image')['sizes']['horiz__16x9--s']; ?>" alt="<?php echo get_field('sb_side_image')['alt']; ?>" />
              <?php if (get_field('is_video')): ?></div><?php endif; ?>
            </a> <!-- /.story-block__image-wrap -->
          <?php endif; ?>
          <?php the_field('sb_body'); ?>
        </div>
        <?php if (get_field('sb_cta')): ?>
          <p><a class="story-block__cta block__cta btn theme--secondary-background-color" href="<?php the_field('sb_url'); ?>"><?php the_field('sb_cta'); ?></a></p>
        <?php endif; ?>
      </div> <!-- /.spacing -->
    </div> <!-- story-block__content -->
  </div> <!-- /.story-block -->
<?php endif; ?>
