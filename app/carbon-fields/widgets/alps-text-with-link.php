<div class="c-block__breakout u-padding u-padding--double--bottom u-padding--double--top u-spacing u-theme--background-color--darker">
  <?php if (!empty($settings['text_link_title'])): ?>
    <h3 class="c-block__title u-color--white"><?php echo $settings['text_link_title']; ?></h3>
  <?php endif; ?>
  <?php if (!empty($settings['text_link_content'])): ?>
    <p class="c-block__body u-theme--color--lighter"><?php echo $settings['text_link_content']; ?></p>
  <?php endif; ?>
  <?php if (!empty($settings['text_link_url'])): ?>
    <a class="o-button o-button--lighter" href="<?php echo $settings['text_link_url']; ?>">
      <?php echo $settings['text_link_url_text']; ?>
    </a>
  <?php endif; ?>
</div>
