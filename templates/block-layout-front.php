<?php
  // Looping though block types.
  if (have_rows('primary_promotional_content')):
    $c = 0;
    while (have_rows('primary_promotional_content')): the_row();
      // Get layout.
      $layout = get_row_layout();
      $is_two_column = get_field('display_blocks_in_two_columns');
      $block_inner_class = ($is_two_column) ? "block__row--small-to-medium" : ""; ?>

<?php if ($c == 0): ?>
  <?php if ($is_two_column): ?>
    <hr>
    <div class="g g-2up--at-medium with-divider no-space--top grid--uniform">
  <?php else: ?>
    <div class="spacing--double pad--btm">
      <hr>
  <?php endif; ?>
<?php endif; ?>

<?php
  // Block layout.
  if ($layout === 'content_block_freeform'):
    $title = get_sub_field('title');
    $body = get_sub_field('body');
    $excerpt_length = 200;
    $image = get_sub_field('image');
    $round_image = get_sub_field('make_the_image_round');
    $kicker = get_sub_field('kicker');
    $button_text = get_sub_field('button_text');
    $button_url = get_sub_field('button_url');
    $left_border = get_sub_field('left_color_border');
    $left_border_class = "has-border--left-" . rand(0, 15);
    $thumbnail = $image['sizes']['horiz__4x3--s'];
    $thumbnail_round = $image['sizes']['square--s'];
    $alt = $image['alt']; ?>

  <?php
    // Freeform headline block.
    if (empty($image)): ?>
    <div class="spacing--zero no-space--top flex">
      <?php include(locate_template('patterns/blocks/block-headline.php')); ?>
      <hr class="w--100p">
    </div>

  <?php
    // Freeform media block.
    else: ?>
    <div class="pad--primary">
      <?php include(locate_template('patterns/blocks/block-media.php')); ?>
    </div>
    <hr class="w--100p">
  <?php endif; ?>

<?php
  // Referenced block.
  elseif ($layout === 'content_block_reference'):
    $referenced_block = get_sub_field('referenced_content');
    $block_count = count($referenced_block);
    $i = 1;

    foreach ($referenced_block as $post): setup_postdata($post);
      $thumb_id = get_post_thumbnail_id();
      $round_image = get_sub_field('make_the_image_round');
      $title = get_the_title();
      $intro = get_field('intro');
      $body = strip_tags(get_the_content());
      $excerpt_length = 200;
      $kicker = get_field('kicker');
      $button_text = "Read More";
      $button_url = get_permalink();
      $thumbnail = wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0];
      $thumbnail_round = wp_get_attachment_image_src($thumb_id, "square--s")[0];
      $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
      $title  = the_title('','',false);
      if (isset($post->post_date) && $post->post_type == 'post') {
        $date = get_the_date('M j, Y');
        $date_formatted = get_the_date('c');
      }
    ?>

    <div class="pad--primary">
      <?php include(locate_template('patterns/blocks/block-media.php')); ?>
    </div>
    <hr class="w--100p">

  <?php
    // End reference block foreach.
        $i++;
      endforeach;
    wp_reset_postdata();
  endif; ?>

  <?php
    // End promotional content loop.
      $c++;
    endwhile; ?>
  </div>
<?php endif; ?>
