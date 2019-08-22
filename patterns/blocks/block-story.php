<?php
  $title            = get_alps_field( 'sb_title' );
  $subtitle         = get_alps_field( 'sb_subtitle' );
  $background_image = get_alps_field( 'sb_background_image' );
  $thumbnail        = get_alps_field( 'sb_thumbnail' );
  $side_image       = get_alps_field( 'sb_side_image' );
  $video            = get_alps_field( 'is_video' );
  $body             = get_alps_field( 'sb_body' );
  $url              = get_alps_field( 'sb_url' );
  $cta              = get_alps_field( 'sb_cta' );
?>
<?php if ($url && $title): ?>
  <div class="story-block block spacing--half pad flex--end bg--cover" <?php if ($background_image): ?>style="background-image: url(<?php echo wp_get_attachment_image_url( $background_image, 'square--l' ); ?>)"<?php endif; ?>>
    <?php if ($thumbnail): ?>
      <div class="story-block__image-wrap round">
        <img class="story-block__image" src="<?php echo wp_get_attachment_image_url( $thumbnail, 'square--s' ); ?>" alt="<?php get_post_meta( $thumbnail, '_wp_attachment_metadata', true ); ?>" />
      </div>
    <?php endif; ?>
    <div class="story-block__content spacing">
      <div>
        <h2 class="story-block__heading font--secondary--l theme--secondary-text-color"><?php echo $title; ?></h2>
        <?php if ($subtitle): ?><p class="font--secondary--xs <?php if ($background_image): ?>white<?php endif; ?>"><?php echo $subtitle; ?></p><?php endif; ?>
      </div>
      <div class="spacing">
        <div class="text story-block__description block__description spacing <?php if ($background_image): ?>white<?php endif; ?>">
          <?php if ($side_image): ?>
            <a class="story-block__text-image-wrap space-half--btm" href="<?php echo $url; ?>">
              <?php if ($video == 'true'): ?><div class="is-video"><?php endif; ?>
              <img class="story-block__text-image" src="<?php echo wp_get_attachment_image_url( $side_image, 'horiz__16x9--s' ); ?>" alt="<?php get_post_meta( $side_image, '_wp_attachment_metadata', true ); ?>" />
              <?php if ($video == 'true'): ?></div><?php endif; ?>
            </a> <!-- /.story-block__image-wrap -->
          <?php endif; ?>
          <?php echo wpautop($body); ?>
        </div>
        <?php if ($cta): ?>
          <p><a class="story-block__cta block__cta btn theme--secondary-background-color" href="<?php echo $url; ?>"><?php echo $cta; ?></a></p>
        <?php endif; ?>
      </div> <!-- /.spacing -->
    </div> <!-- story-block__content -->
  </div> <!-- /.story-block -->
<?php endif; ?>
