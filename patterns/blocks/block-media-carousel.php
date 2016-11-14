<div class="carousel__item rel">
  <?php if ($thumbnail): ?>
    <picture class="picture">
      <img class="media-block__image block__image" src="<?php echo $thumbnail; ?>" alt="<?php echo $alt; ?>" />
    </picture>
  <?php endif; ?>
  <div class="carousel-block__content block__content spacing--quarter pad">
    <h3 class="carousel-block__title block__title font--secondary--m"><a href="<?php echo $button_url; ?>" class="block__title-link theme--primary-text-color"><?php echo $title; ?></a></h3>
    <?php if (isset($date)): ?>
      <time class="block__date font--secondary--xs brown space-half--btm" datetime="<?php echo $date_formatted; ?>"><?php echo $date; ?></time>
    <?php endif; ?>
    <div class="spacing--half">
      <?php if ($intro || $body): ?>
        <div class="text pad-half--btm">
          <p class="carousel-block__description block__description">
            <span class="font--primary--xs">
              <?php if (!empty($intro)): ?>
                <?php
                  if (strlen($intro) > $excerpt_length):
                      echo trim(substr($intro, 0, $excerpt_length)) . '&hellip;';
                  else:
                      echo $intro;
                  endif;
                ?>
              <?php elseif (!empty($body)): ?>
                <?php
                  if (strlen($body) > $excerpt_length):
                      echo trim(substr($body, 0, $excerpt_length)) . '&hellip;';
                  else:
                      echo $body;
                  endif;
                ?>
              <?php endif; ?>
            </span>
          </p>
        </div>
      <?php endif; ?>
      <?php if ($button_url && $button_text): ?>
        <p><a class="carousel-block__cta block__cta btn theme--secondary-background-color" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></p>
      <?php endif; ?>
    </div> <!-- /.spacing -->
  </div>
</div>
