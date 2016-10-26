<?php
    if ($GLOBALS['wp_query']->max_num_pages <= 1) return;

    $args = wp_parse_args( $args, [
        'mid_size'           => 2,
        'prev_next'          => false,
        'prev_text'          => __('&larr; Previous', 'textdomain'),
        'next_text'          => __('Next &rarr;', 'textdomain'),
    ]);

    $links     = paginate_links($args);
    $next_link = get_previous_posts_link($args['next_text']);
    $prev_link = get_next_posts_link($args['prev_text']);
 ?>

<nav class="pagination center-block align--center" role="navigation">
  <span class="pagination__page pagination__prev theme--secondary-background-color white"><?php echo $prev_link; ?></span>
  <div class="pagination__pages show-at--medium dib">
    <span class="pagination__page theme--secondary-background-color white"><?php echo $links; ?></span>
  </div>
  <span class="pagination__page pagination__next theme--secondary-background-color white"><?php echo $next_link; ?></span>
</nav> <!-- /.pagination -->
