
<?php
  // Beakout block.
  $title = get_field('title');
  $body = get_field('body');
  $image = get_field('image');
  $button_text = get_field('button_text');
  $url = get_field('button_url');
  $thumbnail = $image['sizes']['horiz__4x3--s'];
  $alt = $image['alt'];
?>

<?php include(locate_template('patterns/blocks/block-breakout.php')); ?>

<div class="column__secondary can-be--dark-dark">
  <aside class="aside spacing--double">
    <div class="pad--secondary spacing--double">

      <?php if (!empty(get_field('column_title'))): ?><h3 class="font--tertiary--m theme--secondary-text-color"><?php the_field('column_title'); ?></h3><?php endif; ?>

    <?php
      // Looping though block types.
      if (have_rows('secondary_promotional_content')):
        while (have_rows('secondary_promotional_content')): the_row();
          // Get layout.
          $layout = get_row_layout();

          // Content block layout.
          if ($layout === 'content_block_freeform'):
            $title = get_sub_field('title');
            $body = get_sub_field('body');
            $image = get_sub_field('image');
            $kicker = get_sub_field('kicker');
            $button_text = get_sub_field('button_text');
            $button_url = get_sub_field('button_url');
            $thumbnail = $image['sizes']['horiz__4x3--s'];
            $alt = $image['alt'];
            $block_inner_class = 'block__row--small-to-large';
      ?>

      <?php
        // Freeform block.
        if (empty($image)): ?>
        <div class="spacing">
          <div class="content__block spacing--half">
            <h3 class="theme--primary-text-color font--secondary--m"><?php echo $title; ?></h3>
            <?php echo $body; ?>
            <?php if (!empty($button_text)): ?>
              <a href="<?php echo $button_url; ?>" class="dib font--secondary--s upper theme--secondary-text-color"><strong><?php echo $button_text; ?></strong></a>
            <?php endif; ?>
          </div>
          <hr>
        </div>

      <?php
        // Freeform media block.
        else: ?>
        <?php include(locate_template('patterns/blocks/block-media.php')); ?>
      <?php endif; ?>

    <?php
      // Referenced block.
      elseif ($layout === 'content_block_reference'):
        $referenced_block = get_sub_field('referenced_content');
        $block_count = count($referenced_block);

        foreach ($referenced_block as $post): setup_postdata($post);
          $thumb_id = get_post_thumbnail_id();
          $title = get_field('display_title');
          $body = get_field('intro');
          $kicker = ($post->post_type != 'post') ? get_the_title() : FALSE;
          $button_text = "Read more";
          $button_url = get_permalink();
          $thumbnail = wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0];
          $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
          $block_inner_class = 'block__row--small-to-large';
          if (isset($post->post_date) && $post->post_type == 'post') {
            $date = get_the_date('M j, Y');
            $date_formatted = get_the_date('c');
          }
        ?>
        <?php include(locate_template('patterns/blocks/block-media.php')); ?>
      <?php
        // End referenc block foreach.
          endforeach;
        wp_reset_postdata();
      endif; ?>

    <?php
      // End promotional content loop.
      endwhile; ?>
    </div>
  </aside>
</div>
<?php endif; ?>
