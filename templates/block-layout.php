<!-- Loop of related posts to child page -->
<?php
  $page_title = $wp_query->post->post_title;
  $page_parent = $wp_query->post->post_parent;
  $args = array(
    'category_name' => $page_title,
    'posts_per_page' => 6
  );
  query_posts($args);
?>

<?php
  // Remove '!' from below if statement if posts should be automatically added
  if (!have_posts() && $page_parent > 0):
?>
<div class="spacing text">
  <div class="g g-2up--at-medium with-divider">
    <?php while (have_posts()) : the_post(); ?>
      <div class="gi">
        <div class="spacing">
          <div class="pad">
            <?php
              $title = get_the_title();
              $intro = get_field('intro');
              $body = strip_tags(get_the_content());
              $excerpt_length = 200;
              $image = get_post_thumbnail_id();
              $kicker = get_field('kicker');
              $button_text = 'Read More';
              $date = get_the_date();
              $button_url = get_the_permalink();
              $thumbnail = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
              $thumbnail_round = wp_get_attachment_image_src($image, "square--s")[0];
              $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
              $block_inner_class = 'block__row--small-to-large';
            ?>
            <?php include(locate_template('patterns/blocks/block-media.php')); ?>
          </div>
          <hr>
        </div>
      </div>
    <?php endwhile;  ?>
  </div>
  <div class="pad spacing"></div>
</div>
<?php endif; ?>
<?php wp_reset_query(); ?>

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
  <?php if ($is_two_column): ?><div class="gi"><?php endif; ?>
    <div class="spacing--zero no-space--top flex">
      <?php include(locate_template('patterns/blocks/block-headline.php')); ?>
      <?php if (!$is_two_column): ?><hr class="w--100p"><?php endif; ?>
    </div>
  <?php if ($is_two_column): ?></div><?php endif; ?>

  <?php
    // Freeform media block.
    else: ?>
  <?php if ($is_two_column): ?><div class="gi"><?php endif; ?>
    <div class="<?php if ($is_two_column): echo 'pad'; endif; ?> pad--primary">
      <?php include(locate_template('patterns/blocks/block-media.php')); ?>
    </div>
    <?php if (!$is_two_column): ?><hr class="w--100p"><?php endif; ?>
  <?php if ($is_two_column): ?></div><?php endif; ?>
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

    <?php if ($is_two_column): ?><div class="gi"><?php endif; ?>
      <div class="<?php if ($is_two_column): echo 'pad'; endif; ?> pad--primary">
        <?php include(locate_template('patterns/blocks/block-media.php')); ?>
      </div>
    <?php if ($is_two_column): ?></div><?php endif; ?>

    <?php if (!$is_two_column): ?><hr class="w--100p"><?php endif; ?>

  <?php
    // End referenc block foreach.
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
