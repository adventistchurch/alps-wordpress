<?php
  $page_title   = $wp_query->post->post_title;
  $page_parent  = $wp_query->post->post_parent;
?>
<?php
  // Loop of posts for child pages
  $args = array(
    'category_name' => $page_title,
    'posts_per_page' => 6
  );
  query_posts($args);
?>
<?php if (have_posts() && $page_parent != 0): ?>
  <div class="spacing text">
    <div class="g g-2up--at-medium with-divider">
      <?php while (have_posts()) : the_post(); ?>
        <div class="gi">
          <div class="spacing">
            <div class="pad">
              <?php
                $title              = get_the_title();
                $intro              = get_alps_field( 'intro' );
                $body               = strip_tags(get_the_content());
                $body               = strip_shortcodes($body);
                $excerpt_length     = 200;
                $image              = get_post_thumbnail_id();
                $kicker             = get_alps_field( 'kicker' );
                $button_text        = __('Read More', 'sage');
                $button_url         = get_the_permalink();
                $round_image        = 'false';
                $thumbnail          = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
                $thumbnail_round    = wp_get_attachment_image_src($image, "square--xs")[0];
                $alt                = get_alps_field( '_wp_attachment_image_alt' );
                $block_inner_class  = 'block__row--small-to-large';
                $date               = get_the_time('M j, Y');
                $date_formatted     = get_the_time('c');
              ?>
              <?php include(locate_template('patterns/blocks/block-media.php')); ?>
            </div>
            <hr>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <div class="pad spacing"></div>
  </div>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php
  $related = carbon_get_the_post_meta( 'related' );
  if ($related == 'related_all') {
    // Loop of pages for child and grandchild pages
    $pages = get_pages(array(
      'child_of'    => $post->ID,
      'post_type'   => 'page',
      'post_status' => 'publish',
      'sort_column' => 'menu_order'
    ));
  } elseif ($related == 'related_custom') {
    // LOOP OF SELECTED PAGES
    // NEED CONDITION AS PIKLIST HAS DIFFERENT WAY OF HANDLING THIS
    $cf = get_option( 'alps_cf_converted' );
    if ( $cf ) {
      $assigned = carbon_get_post_meta( $post->ID, 'related_custom_value' );
      $ids = [];
      foreach ( $assigned as $k => $entry ) {
        foreach ( $entry as $key => $val ) {
          if ( $key == 'id' ) array_push( $ids, $val );
        }
      }
      $pages = get_posts(array(
        'post__in'          => $ids,
        'post_type'         => 'page',
        'suppress_filters'  => false,
        'orderby'           => 'post__in',
      ));
    } else {
      $pages = get_posts(array(
        'post_type'         => 'page',
        'posts_per_page'    => -1,
        'post_belongs'      => $post->ID,
        'post_status'       => 'publish',
        'suppress_filters'  => false
      ));
    }
  } else {
    // Loop of pages for top level pages
    $pages = get_pages(array(
      'hierarchical'  => 0,
      'parent'        => $post->ID,
      'post_type'     => 'page',
      'post_status'   => 'publish',
      'sort_column'   => 'menu_order'
    ));
  }
?>
<?php if ($page_parent == 0 || is_page_template('template-landing-page.php')): ?>
  <div class="spacing--double">
  <hr>
    <?php foreach ($pages as $page): ?>
      <?php
        // UNSET TO KEEP EMPTY VALUES FROM PULLING LAST LOOP VALUES
        unset( $title );
        unset( $intro );
        unset( $body );        

        $title              = get_alps_field( 'display_title' );
        $intro              = get_alps_field( 'intro' );
        $body               = strip_tags($page->post_content);
        $body               = strip_shortcodes($body);
        $excerpt_length     = 200;
        $image              = get_post_thumbnail_id($page->ID);
        $kicker             = $page->post_title;
        $button_text        = __('Read More', 'sage');
        $date               = '';
        $button_url         = get_page_link($page->ID);
        $round_image        = get_alps_field( 'make_the_image_round' );
        $thumbnail          = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
        $thumbnail_round    = wp_get_attachment_image_src($image, "square--xs")[0];
        $alt                = get_alps_field( '_wp_attachment_image_alt', $image );
        $block_inner_class  = 'block__row';
        $date               = '';
        $date_formatted     = '';
      ?>
      <div class="pad--primary spacing--half">
        <?php include(locate_template('patterns/blocks/block-media.php')); ?>
      </div>
      <hr>
    <?php endforeach;  ?>
  </div>
<?php endif; ?>
<?php wp_reset_query(); ?>
