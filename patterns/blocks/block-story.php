<?php
  $title = get_post_meta($post->ID, 'sb_title', true);
  $subtitle = get_post_meta($post->ID, 'sb_subtitle', true);
  $background_image = get_post_meta($post->ID, 'sb_background_image', true);
  $thumbnail = get_post_meta($post->ID, 'sb_thumbnail', true);
  $side_image = get_post_meta($post->ID, 'sb_side_image', true);
  $video = get_post_meta($post->ID, 'is_video', true);
  $body = get_post_meta($post->ID, 'sb_body', true);
  $url = get_post_meta($post->ID, 'sb_url', true);
  $cta = get_post_meta($post->ID, 'sb_cta', true);
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
