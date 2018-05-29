@php
  $post_type = get_post_type($post->ID);
  $category = get_the_category();
  if ($category) {
    if (class_exists('WPSEO_Primary_Term')) {
      $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
      $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
      $term = get_term($wpseo_primary_term);
      if (is_wp_error($term)) {
        $category = $category[0]->slug;
      } else {
        $category = $term->slug;
      }
    }
    else {
      $category = $category[0]->slug;
    }
  }
  $args = array(
    'post_type' => $post_type,
    'category_name' => $category,
    'posts_per_page' => 2,
    'post__not_in' => array($post->ID)
  );
  $related = new WP_Query($args);
@endphp
@if ($related->have_posts())
  <div class="c-related-posts u-spacing">
    <div class="c-block__heading u-theme--border-color--darker">
      <h3 class="c-block__heading-title u-theme--color--darker">Related Stories</h3>
    </div>
    <div class="c-related-posts__blocks u-spacing">
      @while ($related->have_posts())
        @php($related->the_post())
        @php
          $id = get_the_ID();
          $title = get_the_title($id);
          $thumb_id = get_post_thumbnail_id($id);
          $thumb_size = 'horiz__4x3';
          $link = get_permalink($id);
          $date = date('F j, Y', strtotime(get_the_date()));
          $image = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
          $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
          $category = $category;

          $block_class = "c-block--reversed c-media-block--reversed l-grid--7-col";
          $block_group_class = "u-flex--justify-start";
          $block_img_class = "l-grid-item--2-col l-grid-item--m--1-col l-grid-item--l--1-col u-padding--right";
          $block_content_class = "l-grid-item--4-col l-grid-item--m--3-col l-grid-item--l--1-col u-border--left u-theme--border-color--darker--left u-color--gray u-spacing--half";
          $block_title_class = "u-theme--color--dark u-font--primary--s";
          $block_meta_class = "u-theme--color--base u-font--secondary--xs";
        @endphp
        @include('patterns.01-molecules.blocks.media-block')
      @endwhile
      @php(wp_reset_query())
    </div>
  </div>
@endif
