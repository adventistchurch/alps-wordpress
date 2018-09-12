<?php $content_block = get_post_meta($post->ID, 'content_block', true); ?>
<?php if ($content_block != 'false'): ?>
  <?php
    $two_columns = get_post_meta($post->ID, 'grid_two_columns', true);
    $block_inner_class = ($two_columns == 'true') ? 'block__row--small-to-medium' : '';

    if ($content_block == 'freeform') {
      $blocks = get_post_meta($post->ID, 'content_block_freeform', true);
    }
    if ($content_block == 'relationship') {
      $blocks = get_post_meta($post->ID, 'content_block_relationship');
    }
    if ($two_columns == 'true') {
      echo '<hr>';
      echo '<div class="g g-2up--at-medium with-divider grid--uniform">';
    } else {
      echo '<div class="spacing--double pad--btm ovh">';
      echo '<hr>';
    }
  ?>
    <?php foreach ($blocks as $block): ?>
      <?php
        if ($content_block == 'freeform') {
          $kicker = $block['content_block_freeform_kicker'];
          $title = $block['content_block_freeform_title'];
          $image = $block['content_block_freeform_image'][0];
          $excerpt_length = 200;
          $body = $block['content_block_freeform_body'];
          $button_text = $block['content_block_freeform_button_text'];
          $button_url = $block['content_block_freeform_button_url'];
          $left_border = $block['content_block_freeform_colorpicker'];
          $left_border_class = 'has-border--left-' . rand(0, 15);
          $thumbnail = wp_get_attachment_image_url( $image, 'horiz__4x3--s' );
          $thumbnail_round = wp_get_attachment_image_url( $image, 'square--s' );
          $alt = get_post_meta( $image, '_wp_attachment_image_alt', true );
          $round_image = $block['content_block_freeform_round'];
          if ($round_image == 'true') {
            $block_inner_class = 'block__row';
          }
        }
        if ($content_block == 'relationship') {
          $id = $block;
          $kicker = get_post_meta($id, 'kicker', true);
          $title = get_the_title($id);
          $image = get_post_thumbnail_id($id);
          $excerpt_length = 200;
          $intro = get_post_meta($id, 'intro', true);
          $body = strip_tags(get_the_content($id));
          $body = strip_shortcodes($body);
          $button_text = __('Read More');
          $button_url = get_the_permalink($id);
          $thumbnail = wp_get_attachment_image_url( $image, 'horiz__4x3--s' );
          $thumbnail_round = wp_get_attachment_image_url( $image, 'square--s' );
          $left_border = '';
          $left_border_class = '';
          $alt = get_post_meta( $image, '_wp_attachment_image_alt', true );
          $round_image = 'false';
          if ($round_image == 'true') {
            $block_inner_class = 'block__row';
          }
        }
      ?>
      <?php if ($title): ?>
        <?php if ($two_columns == 'true'): ?>
          <?php
            $block_inner_class = 'block__row--small-to-medium';
            $round_image = 'false';
          ?>
          <div class="gi">
            <div class="spacing pad">
              <?php include(locate_template('patterns/blocks/block-media.php')); ?>
            </div>
          </div>
        <?php elseif (empty($image) && $two_columns != 'true'): ?>
          <div class="spacing--zero no-space--top flex">
            <?php include(locate_template('patterns/blocks/block-headline.php')); ?>
            <hr class="w--100p">
          </div>
        <?php else: ?>
          <div class="pad--primary">
            <?php include(locate_template('patterns/blocks/block-media.php')); ?>
          </div>
          <hr class="w--100p">
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
