<div class="c-block c-block__text <?php if (isset($thumb_id)): ?><?php echo 'has-image'; ?><?php endif; ?> u-theme--border-color--darker u-border--left <?php if (isset($block_class)): ?><?php echo $block_class; ?><?php endif; ?>">
  <?php if (isset($thumb_id)): ?>
    <img class="c-block__image" src="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]; ?>" />
  <?php endif; ?>
  <h3 class="u-theme--color--darker <?php if (isset($block_title_class)): ?><?php echo $block_title_class; ?><?php endif; ?>">
    <?php if (isset($url)): ?>
      <a href="<?php echo $url; ?>" class="c-block__title-link u-theme--link-hover--dark">
    <?php endif; ?>
    <strong><?php echo $title; ?></strong>
    <?php if (isset($url)): ?>
      </a>
    <?php endif; ?>
  </h3>
  <?php if (!empty($excerpt)): ?>
    <p class="c-block__body text">
      <?php
        if (strlen($excerpt) > $excerpt_length) {
          echo trim(mb_substr($excerpt, 0, $excerpt_length)) . '&hellip;';
        } else {
          echo $excerpt;
        }
      ?>
    </p>
  <?php elseif (!empty($body)): ?>
    <p class="c-block__body text">
      <?php
        if (strlen($body) > $excerpt_length) {
          echo trim(mb_substr($body, 0, $excerpt_length)) . '&hellip;';
        } else {
          echo $body;
        }
      ?>
    </p>
  <?php endif; ?>
  <?php if (isset($category)): ?>
    <span class="c-block__meta u-theme--color--dark u-font--secondary--xs"><?php echo $category; ?></span>
  <?php endif; ?>
  <?php if (isset($body)): ?>
    <div class="c-block__content">
      <p><?php echo $body; ?></p>
    </div>
  <?php endif; ?>
  <?php if (isset($expand)): ?>
    <a href="" class="o-button o-button--outline o-button--expand js-toggle-parent"></a>
  <?php else: ?>
    <?php if (isset($cta)): ?>
      <a href="<?php echo $url; ?>" class="c-block__button o-button o-button--outline"><?php echo $cta; ?><span class="u-icon u-icon--m u-path-fill--base u-space--half--left">@include('patterns.00-atoms.icons.icon-arrow-long-right')</span></a>
    <?php endif; ?>
  <?php endif; ?>
</div>
