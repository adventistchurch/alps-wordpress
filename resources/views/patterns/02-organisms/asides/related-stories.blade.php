@php

  $isVisibleImage = !get_alps_option('is_related_stories_image_hidden');

  $post_type = get_post_type($post->ID);
  $category = get_the_category();
  $category_slug = $category[0]->slug;
  if ($category) {
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
  $args = array(
    'post_type' => $post_type,
    'category_name' => $category_slug,
    'posts_per_page' => 2,
    'post__not_in' => array($post->ID)
  );
  $related = new WP_Query($args);
@endphp
<div class="c-related-posts u-spacing">
  <div class="c-block__heading u-theme--border-color--darker">
    <h3 class="c-block__heading-title u-theme--color--darker">{{ __('Related Stories', 'alps') }}</h3>
  </div>
  <div class="c-related-posts__blocks u-spacing">
    @if ($related->have_posts())
      @while ($related->have_posts())
        @php
          $related->the_post();
          $id = get_the_ID();
          $title = get_the_title();
          $link = get_permalink();
          $date = get_the_date('F j, Y');
          $category = $category;
        @endphp
        @if ($isVisibleImage && get_post_thumbnail_id())
          @php
            $thumb_id = get_post_thumbnail_id();
            $thumb_size = 'horiz__4x3';
            $image = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            $block_class = "c-block--reversed c-media-block--reversed l-grid--7-col";
            $block_title_class = "u-theme--color--darker u-font--primary--s";
            $block_meta_class = "u-theme--color--dark u-font--secondary--xs";
            $block_group_class = "u-flex--justify-start";
            $block_content_class = "l-grid-item--4-col l-grid-item--m--3-col l-grid-item--l--1-col u-border--left u-theme--border-color--darker--left u-color--gray u-spacing--half";
            $block_img_class = "l-grid-item--2-col l-grid-item--m--1-col l-grid-item--l--1-col u-padding--right";
            $title_div = true;
            $GLOBALS['title_div'] = $title_div;
          @endphp
          @include('patterns.01-molecules.blocks.media-block')
        @else
          @php
            $thumb_id = NULL;
            $block_class = "c-block__text u-theme--border-color--darker u-border--left u-padding--bottom u-padding--right u-spacing--half";
            $block_title_class = "u-theme--color--darker u-font--primary--s";
            $excerpt = get_the_excerpt();
            $body = get_the_content();
            $excerpt_length = 35;
            $title_div = true;
            $GLOBALS['title_div'] = $title_div;
          @endphp
          @include('patterns.01-molecules.blocks.content-block')
        @endif
      @endwhile
      {!! wp_reset_postdata() !!}
    @else
      {{ __('There are no related stories at this time.', 'alps') }}
    @endif
  </div>
</div>
