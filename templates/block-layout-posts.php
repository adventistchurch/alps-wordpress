<?php while(the_flexible_field("primary_structured_content")): ?>

  <!-- Content Block: Grid -->
	<?php if(get_row_layout() == "content_block_grid"): ?>
    <?php
      $grid_layout = get_sub_field('grid_layout');
      if (($grid_layout) == '2up-70-30') {
        $classes = 'g-2up--70-30--at-medium';
      } elseif (($grid_layout) == '2up-50-50') {
        $classes = 'g-2up--at-medium';
      } elseif (($grid_layout) == '3up') {
        $classes = 'g-3up--at-medium with-gutters';
      } else {
        $classes = '';
      }
    ?>

    <!-- Columns -->
    <div class="g <?php echo $classes; ?> pad--primary spacing">
      <div class="gi right-gutter--l">
        <div class="text spacing">
          <?php the_sub_field('grid_item_1'); ?>
        </div>
      </div>
      <div class="gi">
        <div class="text spacing">
          <?php the_sub_field('grid_item_2'); ?>
        </div>
      </div>
      <?php if (($grid_layout) == '3up'): ?>
        <div class="gi">
          <div class="text spacing">
            <?php the_sub_field('grid_item_3'); ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <!-- Content Block: Image -->
	<?php if(get_row_layout() == "content_block_image"):?>
    <?php
      $image = get_sub_field('image');
      $image_layout = get_sub_field('image_layout');
      $thumbnail = $image['sizes']['flex-height--s'];
      $alt = $image['alt'];
    ?>
    <?php if (($image_layout) == 'full_width'): ?>
      <div class="clearfix">Image Row</div>
    <?php elseif (($image_layout)== 'breakout'): ?>
      <!-- Breakout media image -->
        <style>
        .breakout-image { background-image: url(https://unsplash.it/500/800); }
        @media (min-width: 500px) {
          .breakout-image { background-image: url(https://unsplash.it/700/800); }
        }
        @media (min-width: 700px) {
          .breakout-image { background-image: url(https://unsplash.it/1200/800); }
        }
        @media (min-width: 1200px) {
          .breakout-image { background-image: url(https://unsplash.it/1500/900); }
        }
        </style>
        <div class="breakout has-parallax breakout-image bg--cover" data-type="background" data-speed="8"></div>
    <?php endif; ?>

	<?php endif; ?>

<?php endwhile; ?>
