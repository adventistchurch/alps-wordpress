<?php
/*
  Title: Text with Link
  Description: Arbitrary text with link.
*/
?>
<div class="c-block__breakout u-padding u-padding--double--bottom u-padding--double--top u-spacing u-theme--background-color--darker {{ breakout_block.block_class }}">
  <?php echo $before_widget; ?>
  <?php echo $before_title; ?>
    <?php if (!empty($settings['title'])): ?>
      <h3 class="c-block__title u-color--white"><?php echo $settings['title']; ?></h3>
    <?php endif; ?>
  <?php echo $after_title; ?>
  <?php if (!empty($settings['content'])): ?>
    <p class="c-block__body u-theme--color--lighter"><?php echo $settings['content']; ?></p>
  <?php endif; ?>
  <?php if (!empty($settings['url'])): ?>
    <a class="o-button o-button--lighter" href="<?php echo $settings['url']; ?>">
      <?php echo $settings['url_text']; ?>
    </a>
  <?php endif; ?>
  <?php echo $after_widget; ?>
</div>
