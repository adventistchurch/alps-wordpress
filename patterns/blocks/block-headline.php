<?php if ($left_border): ?>
  <style>
    .<?php echo $left_border_class; ?>:before {
      background-color: <?php echo $left_border; ?>;
    }
  </style>
<?php endif; ?>
<div class="heading-block block spacing--half <?php if ($left_border): echo $left_border_class; ?> has-border--left<?php endif; ?>">
  <div class="pad">
    <h2 class="pad no-pad--btm heading-block__heading font--secondary--l theme--secondary-text-color"><?php echo $title; ?></h2>
    <div class="pad heading-block__content block__content">
      <div class="spacing">
        <div class="text">
          <p class="heading-block__description block__description">
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
          </p>
        </div>
        <?php if ($button_text && $button_url): ?>
          <p><a class="heading-block__cta block__cta btn theme--secondary-background-color" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></p>
        <?php endif; ?>
      </div> <!-- /.spacing -->
    </div> <!-- heading-block__content -->
  </div>
</div> <!-- /.heading-block -->
