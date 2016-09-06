asdfasdf

<?php
  if (have_rows('carousel_slides')):
    while (have_rows('carousel_slides')): the_row();

    $image_data = get_sub_field('carousel_slides');

    print_r($image_data);

  endwhile;
endif;
    ?>
