<div class="media-block block spacing--quarter">
  <?php if ($kicker): ?>
    <span class="kicker font--secondary--m upper theme--secondary-text-color db"><?php echo $kicker ?></span>
  <?php endif; ?>
  <div class="media-block__inner spacing--quarter block__row">
    <?php if ($thumbnail && $button_url): ?>
      <a class="media-block__image-wrap block__image-wrap db" href="<?php echo $button_url; ?>">
        <div class="<?php if ($round_image): ?>round<?php endif; ?>  dib"><img class="media-block__image block__image" src="<?php echo $thumbnail; ?>" alt="<?php echo $alt; ?>" /></div>
      </a> <!-- /.media-block__image-wrap -->
    <?php endif; ?>
    <div class="media-block__content spacing--quarter <?php if ($thumbnail): ?>block__content<?php endif; ?>">
      <h3 class="media-block__title block__title"><a href="<?php echo $button_url; ?>" class="block__title-link theme--primary-text-color"><?php echo $title; ?></a></h3>
      <div class="spacing--half">
        <div class="text text--s pad-half--btm">
          <p class="media-block__description block__description"><span class="font--primary--xs"><?php echo strip_tags($body, '<a><strong><em><ul>'); ?></span></p>
        </div>
        <?php if ($button_url && $button_text): ?>
          <p><a class="media-block__cta block__cta btn theme--secondary-background-color" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></p>
        <?php endif; ?>
      </div> <!-- /.spacing -->
    </div> <!-- media-block__content -->
  </div> <!-- /.media-block__inner -->
</div> <!-- /.media-block -->
