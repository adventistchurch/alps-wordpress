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
                $intro = get_field('intro');
                $body = strip_tags(get_the_content());
                $excerpt_length = 200;
                $image = get_post_thumbnail_id();
                $kicker = get_field('kicker');
                $button_text = 'Read More';
                $date = get_the_date();
                $button_url = get_the_permalink();
                $round_image = get_sub_field('make_the_image_round');
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
  // Loop of pages for top level pages
  $pages = get_pages(
    array(
      'child_of' => $post->ID,
      'post_type' => 'page',
    	'post_status' => 'publish',
      'sort_column' => 'menu_order'
    )
  );
?>
<?php if ($page_parent == 0): ?>
  <div class="spacing--double">
  <hr>
    <?php foreach ($pages as $page): ?>
      <?php
        $title = get_field('display_title', $page->ID);
        $intro = get_field('intro', $page->ID);
        $body = strip_tags($page->post_content);
        $excerpt_length = 200;
        $image = get_post_thumbnail_id($page->ID);
        $kicker = $page->post_title;
        $button_text = 'Read More';
        $date = '';
        $button_url = get_page_link($page->ID);
        $round_image = TRUE;
        $thumbnail = wp_get_attachment_image_src($image, "horiz__4x3--s")[0];
        $thumbnail_round = wp_get_attachment_image_src($image, "square--s")[0];
        $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
      ?>
      <div class="pad--primary spacing--half">
        <?php include(locate_template('patterns/blocks/block-media.php')); ?>
      </div>
      <hr>
    <?php endforeach;  ?>
  </div>
<?php endif; ?>
<?php wp_reset_query(); ?>
