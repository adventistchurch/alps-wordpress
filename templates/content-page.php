<?php
  // Featured image.
  $thumb_id = get_post_thumbnail_id();
  // Image alt
  $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
?>


<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white can-be--dark-light no-pad--btm">
      <div class="pad--primary spacing">
        <?php //include(locate_template('patterns/components/breadcrumb.php')); ?>
        <div class="text article__body spacing">
          <?php if (get_field('display_title')): ?>
            <h2><?php the_field('display_title'); ?></h2>
          <?php endif; ?>
          <?php if (get_field('intro')): ?>
            <p class="font--secondary--m theme--primary-text-color"><?php the_field('intro'); ?></p>
          <?php endif; ?>
          <?php if ($thumb_id && get_field('hide_featured_image') != TRUE): ?>
            <div class="article__hero">
              <img src="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]; ?>" alt="<?php echo $alt; ?>" class="article__hero-img">
            </div>
          <?php endif; ?>
          <?php the_content(); ?>
        </div>
      </div>

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
          <div class="g g-2up--at-medium with-divider no-space--top grid--uniform">
        <?php else: ?>
          <div class="spacing--double pad--btm">
            <hr>
        <?php endif; ?>
      <?php endif; ?>

      <?php
        // Image layout.
        if ($layout === 'content_block_freeform'):
          $title = get_sub_field('title');
          $body = get_sub_field('body');
          $image = get_sub_field('image');
          $round_image = get_sub_field('make_the_image_round');
          $kicker = get_sub_field('kicker');
          $button_text = get_sub_field('button_text');
          $button_url = get_sub_field('button_url');
          $left_border = get_sub_field('left_color_border');
          $left_border_class = "has-border--left-" . rand(0, 15);
          $thumbnail = $image['sizes']['flex-height--s'];
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
            $round_image = get_field('make_the_image_round');
            $title = get_field('display_title');
            $body = get_field('intro');
            $kicker = ($post->post_type != 'post') ? get_the_title() : FALSE;
            $button_text = "Find out more";
            $button_url = get_permalink();
            $thumbnail = wp_get_attachment_image_src($thumb_id, "flex-height--s")[0];
            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?>

          <?php if ($is_two_column): ?><div class="gi"><?php endif; ?>
            <div class="<?php if ($is_two_column): echo 'pad'; endif; ?> pad--primary">
              <?php include(locate_template('patterns/blocks/block-media.php')); ?>
            </div>
          <?php if ($is_two_column): ?></div><?php endif; ?>

          <?php if (!$is_two_column): ?><hr class="w--100p"><?php endif; ?>
            
        <?php
              $i++;
            endforeach;
          wp_reset_postdata();
        endif; ?>
        <?php
            $c++;
          endwhile;
        endif; ?>
      </div>
    </div> <!-- /.shift-left--fluid -->
    <div class="shift-right--fluid bg--beige can-be--dark-dark">
      <?php include(locate_template('patterns/blocks/block-breakout.php')); ?>
      <div class="column__secondary can-be--dark-dark">
        <?php include(locate_template('patterns/components/aside.php')); ?>
      </div>
    </div> <!-- /.shift-right--fluid -->
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
