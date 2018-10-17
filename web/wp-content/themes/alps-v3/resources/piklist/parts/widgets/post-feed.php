<?php
  /*
    Title: Post Feed
    Description: Feed of posts in the selected category
  */
?>
<?php
  $offset = empty($settings['post_feed_offset']) ? '' : $settings['post_feed_offset'];
  $featured = empty($settings['post_feed_featured']) ? false : $settings['post_feed_featured'];
  $category = empty($settings['post_feed_category']) ? 'news' : $settings['post_feed_category'];
  $title = empty($settings['post_feed_title']) ? get_cat_name($category) : $settings['post_feed_title'];
  $url = empty($settings['post_feed_url']) ? '' : $settings['post_feed_url'];
  $count = empty($settings['post_feed_count']) ? '-1' : $settings['post_feed_count'];

  // Post Feed args
  $args = array(
    'cat' => $category,
    'posts_per_page' => $count,
    'offset' => $offset
  );
  $the_query = new WP_Query($args);
?>

<div class="c-block-wrap u-spacing">
  <div class="c-block__heading u-theme--border-color--darker">
    <h3 class="c-block__heading-title u-theme--color--darker">
      <?php echo $title; ?>
    </h3>
    <?php if($url): ?>
      <a href="<?php echo $url; ?>" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">See All</a>
    <?php endif; ?>
  </div>
  <div class="c-block-wrap__content u-spacing">
    <?php if ($the_query->have_posts()): ?>
      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php
          $id = get_the_ID();
          $title = get_the_title($id);
          $link = get_permalink($id);
          $category = get_the_category();
          if (get_the_category()) {
            if (class_exists('WPSEO_Primary_Term')) {
              $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
              $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
              $term = get_term($wpseo_primary_term);
              if (is_wp_error($term)) {
                $category = $category[0]->name;
              } else {
                $category = $term->name;
              }
            }
            else {
              $category = $category[0]->name;
            }
          }
          if ($featured == true) {
            $date = date('F j, Y', strtotime(get_the_date()));
            $excerpt = get_the_excerpt($id);
            $excerpt_length = 200;
            $body = get_the_content($id);
            $thumb_id = get_post_thumbnail_id($id);
            $thumb_size = 'horiz__4x3';
            $image = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            $block_class = "c-block__stacked c-media-block__stacked";
            $block_content_class = "l-grid-item u-border--left u-color--gray u-theme--border-color--darker--left u-spacing--half";
            $block_title_class = "u-theme--color--darker u-font--primary--m";
            $block_meta_class = "u-theme--color--dark u-font--secondary--xs";
            include(locate_template('patterns/01-molecules/blocks/media-block.php'));
          } else {
            $block_class = "c-block__text u-theme--border-color--darker u-border--left u-padding--bottom u-spacing--half";
            $block_title_class = "u-theme--color--darker u-font--primary--s";
            include(locate_template('patterns/01-molecules/blocks/content-block.php'));
          }
        ?>
      <?php endwhile; ?>
      <?php wp_reset_query(); ?>
    <?php else: ?>
      There are no posts at this time.
    <?php endif; ?>
  </div>
</div>
