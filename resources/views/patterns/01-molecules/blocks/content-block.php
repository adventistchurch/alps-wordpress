<?php if ($title_div): ?>
  <?php $h_tag = 'div'; ?>
<?php else: ?>
  <?php $h_tag = 'h3'; ?>
<?php endif; ?>
<div class="c-block c-block__text <?php if (isset($thumb_id)): ?><?php echo 'has-image'; ?><?php endif; ?> u-theme--border-color--darker u-border--left <?php if (isset($block_class)): ?><?php echo $block_class; ?><?php endif; ?>">
  <?php if (isset($thumb_id)): ?>
    <img class="c-block__image" src="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]; ?>" />
  <?php endif; ?>
  <<?php echo $h_tag ?> class="u-theme--color--darker <?php if (isset($block_title_class)): ?><?php echo $block_title_class; ?><?php endif; ?>">
    <?php if (isset($link)): ?>
      <a href="<?php echo $link; ?>" class="c-block__title-link u-theme--link-hover--dark">
    <?php endif; ?>
    <strong><?php echo $title; ?></strong>
    <?php if (isset($link)): ?>
      </a>
    <?php endif; ?>
  </<?php echo $h_tag ?>>
  <?php if (!empty($excerpt)): ?>
    <p class="c-block__body text">
      <?php
        if (str_word_count($excerpt) > $excerpt_length) {
          echo strip_shortcodes(wp_trim_words($body, $excerpt_length));
        } else {
          echo strip_shortcodes(strip_tags($excerpt, '<img>'));
        }
      ?>
    </p>
  <?php elseif (!empty($body)): ?>
    <p class="c-block__body text">
      <?php
        if (str_word_count($body) > $excerpt_length) {
          echo strip_shortcodes(wp_trim_words($body, $excerpt_length));
        } else {
          echo strip_shortcodes(strip_tags($body));
        }
      ?>
    </p>
  <?php endif; ?>
  <?php if (isset($category) || isset($date)): ?>
    <span class="c-block__meta u-theme--color--dark u-font--secondary--xs">
      <?php if (isset($category)): ?>
        <span class="c-block__category u-text-transform--upper"><?php echo $category ?></span>
      <?php endif; ?>
      <?php if (isset($date)): ?>
        <time class="c-block__date u-text-transform--upper"><?php echo $date ?></time>
      <?php endif; ?>
    </span>
  <?php endif; ?>
  <?php if (isset($expand_body)): ?>
    <div class="c-block__content">
      <p><?php echo $expand_body; ?></p>
    </div>
  <?php endif; ?>
  <?php if (isset($expand)): ?>
    <a href="" class="o-button o-button--outline o-button--expand js-toggle-parent"></a>
  <?php else: ?>
    <?php if (isset($cta)): ?>
      <a href="<?php echo $link; ?>" class="c-block__button o-button o-button--outline"><?php echo $cta; ?><span class="u-icon u-icon--m u-path-fill--base u-space--half--left"><?php include(locate_template('patterns/00-atoms/icons/icon-arrow-long-right.blade.php')); ?></span></a>
    <?php endif; ?>
  <?php endif; ?>
</div>
