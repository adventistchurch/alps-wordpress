<?php
  $big = 999999999;
  $args = array(
    'mid_size' => 2,
    'prev_next' => false,
    'prev_text' => __('Next &rarr;', 'sage'),
    'next_text' => __('&larr; Previous', 'sage'),
  );

  // Native WordPress menu classes to be replaced.
  $replace = array(
    'page-numbers ',
    'current',
    '<a class=',
    'pagination__page white dots'
  );

  // Custom ALPS classes to replace.
  $replace_with = array(
    'pagination__page white ',
    'pagination__page--current bg--gray',
    '<a class="pagination__page theme--secondary-background-color white "',
    'pagination__divide'
  );

  $links = paginate_links($args);
  $next_link = get_previous_posts_link($args['next_text']);
  $prev_link = get_next_posts_link($args['prev_text']);
?>

<nav class="pagination center-block align--center" role="navigation">
  <?php echo $next_link; ?>
  <div class="pagination__pages show-at--medium dib">
    <?php echo str_replace($replace, $replace_with, $links); ?>
  </div>
  <?php echo $prev_link; ?>
</nav> <!-- /.pagination -->
