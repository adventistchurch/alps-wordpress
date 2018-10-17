<div class="c-media-block c-block <?php if (isset($block_class)): ?><?php echo $block_class ?><?php endif; ?>">
  <?php if (isset($image) or isset($picture)): ?>
    <div class="c-media-block__image c-block__image <?php if (isset($block_img_class)): ?><?php echo $block_img_class ?><?php endif; ?> <?php if (isset($block_type)): ?> c-block__icon c-block__icon--<?php echo $block_type ?><?php endif; ?>">
      <div class="c-block__image-wrap <?php if (isset($block_img_wrap_class)): ?><?php echo $block_img_wrap_class ?><?php endif; ?>">
        <?php if (isset($picture)): ?>
          <picture class="picture">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            <?php if (isset($image_break_xl)): ?>
              <source srcset="<?php echo $image_xl ?>" media="(min-width: <?php echo $image_break_xl ?>px)">
            <?php endif; ?>
            <?php if (isset($image_break_l)): ?>
              <source srcset="<?php echo $image_l ?>" media="(min-width: <?php echo $image_break_l ?>px)">
            <?php endif; ?>
            <source srcset="<?php echo $image_m ?>" media="(min-width: <?php echo $image_break_m ?>px)">
            <!--[if IE 9]></video><![endif]-->
            <img itemprop="image" srcset="<?php echo $image_s ?>" alt="<?php echo $alt ?>">
          </picture>
        <?php elseif (isset($image)): ?>
          <img src="<?php echo $image ?>" itemprop="image" alt="<?php echo $alt ?>" />
        <?php endif; ?>
      </div>
    </div> <!-- c-media-block__image -->
  <?php endif; ?>
  <div class="c-media-block__content c-block__content u-spacing <?php if (isset($block_content_class)): ?><?php echo $block_content_class ?><?php endif; ?>">
    <div class="u-spacing c-block__group c-media-block__group <?php if (isset($block_group_class)): ?><?php echo $block_group_class ?><?php endif; ?>">
      <div class="u-spacing u-width--100p">
        <?php if (isset($kicker)): ?>
          <h4 class="c-media-block__kicker c-block__kicker <?php if (isset($block_kicker_class)): ?><?php echo $block_kicker_class ?><?php endif; ?>"><?php echo $kicker ?></h4>
        <?php endif; ?>
        <?php if (isset($title)): ?>
          <h3 class="c-media-block__title c-block__title <?php if (isset($block_title_class)): ?><?php echo $block_title_class ?><?php endif; ?> <?php if (isset($kicker)): ?><?php echo 'u-space--zero'?><?php endif; ?>">
            <?php if (isset($link)): ?>
              <a href="<?php echo $link ?>" class="c-block__title-link u-theme--link-hover--dark">
            <?php endif; ?>
            <?php echo $title ?>
            <?php if (isset($link)): ?>
              </a>
            <?php endif; ?>
          </h3>
        <?php endif; ?>
        <?php if (!empty($excerpt)): ?>
          <p class="c-media-block__description c-block__description">
            <?php
              if (strlen($excerpt) > $excerpt_length) {
                echo trim(mb_substr($excerpt, 0, $excerpt_length)) . '&hellip;';
              } else {
                echo $excerpt;
              }
            ?>
          </p>
        <?php elseif (!empty($body)): ?>
          <p class="c-media-block__description c-block__description">
            <?php
              if (strlen($body) > $excerpt_length) {
                echo trim(mb_substr($body, 0, $excerpt_length)) . '&hellip;';
              } else {
                echo $body;
              }
            ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="c-media-block__meta c-block__meta <?php if (isset($block_meta_class)): ?><?php echo $block_meta_class ?><?php endif; ?>">
        <?php if (isset($category)): ?>
          <span class="c-block__category u-text-transform--upper"><?php echo $category ?></span>
        <?php endif; ?>
        <?php if (isset($date)): ?>
          <time class="c-block__date u-text-transform--upper"><?php echo $date ?></time>
        <?php endif; ?>
      </div>
      <?php if (isset($cta)): ?>
        <a href="<?php echo $link ?>" class="c-block__button o-button o-button--outline"><?php echo $cta ?><span class="u-icon u-icon--m u-path-fill--base u-space--half--left">{% include '@atoms/icons/icon-arrow-long-right.twig')</span></a>
      <?php endif; ?>
    </div>
  </div> <!-- c-media-block__content -->
</div> <!-- c-media-block -->
