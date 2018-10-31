<?php
  $page_title = $wp_query->post->post_title;
  $page_parent = $wp_query->post->post_parent;
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
                $title = get_the_title();
                $intro = get_post_meta($post->ID, 'intro', true);
                $body = strip_tags(get_the_content());
                $body = strip_shortcodes($body);
                $excerpt_length = 200;
                $image = get_post_thumbnail_id();
                $kicker = get_post_meta($post->ID, 'kicker', true);
                $button_text = __('Read More', 'sage');
                $button_url = get_the_permalink();
                $round_image = 'false';
                $thumbnail = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
                $thumbnail_round = wp_get_attachment_image_src($image, "square--xs")[0];
                $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
                $block_inner_class = 'block__row--small-to-large';
                $date = get_the_date('M j, Y');
                $date_formatted = get_the_date('c');
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
  $related = get_post_meta($post->ID, 'related', true);
  if ($related == 'related_all') {
      // Loop of pages for child and grandchild pages
      $pages = get_pages(
      array(
        'child_of' => $post->ID,
        'post_type' => 'page',
        'post_status' => 'publish',
        'sort_column' => 'menu_order'
      )
    );
  } elseif ($related == 'related_custom') {
      // Loop of selected pages
      $pages = get_posts(array(
      'post_type' => 'page',
      'posts_per_page' => -1,
      'post_belongs' => $post->ID,
      'post_status' => 'publish',
      'suppress_filters' => false
    ));
  } else {
      // Loop of pages for top level pages
      $pages = get_pages(
      array(
        'hierarchical' => 0,
        'parent' => $post->ID,
        'post_type' => 'page',
          'post_status' => 'publish',
        'sort_column' => 'menu_order'
      )
    );
  }
?>
<?php if ($page_parent == 0 || is_page_template('template-landing-page.php')): ?>
  <div class="spacing--double">
  <hr>
    <?php foreach ($pages as $page): ?>
      <?php
        $title = get_post_meta($page->ID, 'display_title', true);
        $intro = get_post_meta($page->ID, 'intro', true);
        $body = strip_tags($page->post_content);
        $body = strip_shortcodes($body);
        $excerpt_length = 200;
        $image = get_post_thumbnail_id($page->ID);
        $kicker = $page->post_title;
        $button_text = __('Read More', 'sage');
        $date = '';
        $button_url = get_page_link($page->ID);
        $round_image = get_post_meta($page->post_parent, 'make_the_image_round', true);
        $thumbnail = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
        $thumbnail_round = wp_get_attachment_image_src($image, "square--xs")[0];
        $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
        $block_inner_class = 'block__row';
        $date = '';
        $date_formatted = '';
      ?>
      <div class="pad--primary spacing--half">
        <?php include(locate_template('patterns/blocks/block-media.php')); ?>
      </div>
      <hr>
    <?php endforeach;  ?>
  </div>
<?php endif; ?>
<?php wp_reset_query(); ?>
