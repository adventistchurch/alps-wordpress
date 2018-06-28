<div class="media-block block spacing--quarter">
  <?php if (isset($kicker) && !empty($title)): ?>
    <span class="kicker font--secondary--m upper theme--secondary-text-color db">
      <?php if ($button_url): ?>
        <a href="<?php echo $button_url; ?>"><?php echo $kicker; ?></a>
      <?php else: ?>
        <?php echo $kicker; ?>
      <?php endif; ?>
    </span>
  <?php endif; ?>
  <div class="media-block__inner spacing--quarter <?php echo ($block_inner_class) ? $block_inner_class : 'block__row'; ?>">
    <?php if ($thumbnail): ?>
      <?php if ($button_url): ?>
        <a class="media-block__image-wrap block__image-wrap db" href="<?php echo $button_url; ?>">
          <div class="<?php if ($round_image == 'true'): ?>round<?php endif; ?> dib">
            <img class="media-block__image block__image" src="<?php if ($round_image == 'true'): echo $thumbnail_round; else: echo $thumbnail; endif; ?>" alt="<?php echo $alt; ?>" />
          </div>
        </a> <!-- /.media-block__image-wrap -->
      <?php else: ?>
        <div class="media-block__image-wrap block__image-wrap db">
          <div class="<?php if ($round_image == 'true'): ?>round<?php endif; ?> dib">
            <img class="media-block__image block__image" src="<?php if ($round_image == 'true'): echo $thumbnail_round; else: echo $thumbnail; endif; ?>" alt="<?php echo $alt; ?>" />
          </div>
        </div> <!-- /.media-block__image-wrap -->
      <?php endif; ?>
    <?php endif; ?>
    <div class="media-block__content <?php if ($thumbnail): ?>block__content<?php endif; ?>">
      <h3 class="media-block__title block__title <?php if (isset($title_size)): echo $title_size; endif; ?> ">
        <?php if ($button_url): ?>
          <a href="<?php echo $button_url; ?>" class="block__title-link theme--primary-text-color"><?php if (!empty($title)): echo $title; else: echo $kicker; endif; ?></a>
        <?php else: ?>
          <span class="theme--primary-text-color"><?php if (!empty($title)): echo $title; else: echo $kicker; endif; ?></span>
        <?php endif; ?>
      </h3>
      <?php if (isset($date)): ?>
        <time class="block__date font--secondary--xs brown space-half--btm" datetime="<?php echo $date_formatted; ?>"><?php echo $date; ?></time>
      <?php endif; ?>

      <div class="spacing--half">
        <?php if (isset($intro) || isset($body)): ?>
          <div class="text text--s pad-half--btm">
            <p class="media-block__description block__description">
              <span class="font--primary--xs">
                <?php if (!empty($intro)): ?>
                  <?php
                    if (strlen($intro) > $excerpt_length):
                      echo trim(mb_substr($intro, 0, $excerpt_length)) . '&hellip;';
                    else:
                      echo $intro;
                    endif;
                  ?>
                <?php elseif (!empty($body)): ?>
                  <?php
                    if (strlen($body) > $excerpt_length):
                      echo trim(mb_substr($body, 0, $excerpt_length)) . '&hellip;';
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
          <p><a class="media-block__cta block__cta btn theme--secondary-background-color" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></p>
        <?php endif; ?>
      </div> <!-- /.spacing -->
    </div> <!-- media-block__content -->
  </div> <!-- /.media-block__inner -->
</div> <!-- /.media-block -->
