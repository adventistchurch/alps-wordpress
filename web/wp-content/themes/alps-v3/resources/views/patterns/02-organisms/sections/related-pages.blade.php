@php
  $related = get_post_meta($post->ID, 'related', true);
  $related_grid = get_post_meta($post->ID, 'related_grid', true);
  $related_image = get_post_meta($post->ID, 'related_image', true);
  $related_image_round = get_post_meta($post->ID, 'related_image_round', true);
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
    $pages = get_post_meta($post->ID, 'related_custom_value');
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
@endphp
@if ($pages)
  <div class="u-spacing--double u-space--double--top">
    @php
      if ($related_grid == "true") {
        if (get_post_meta($post->ID, 'hide_sidebar', true) == 'true') {
          if (get_post_meta($post->ID, 'related_grid_3up', true) == 'true') {
            $grid_class = "l-grid-item--6-col u-shift--right--1-col--at-large u-shift--left--1-col--at-medium u-no-gutters";
            $grid_item_class = "l-grid-item--s--3-col l-grid-item--l--2-col";
          } else {
            $grid_class = "l-grid-item--6-col l-grid-item--m--4-col u-no-gutters";
            $grid_item_class = "l-grid-item--xs--3-col l-grid-item--m--2-col";
          }
        } else {
          $grid_class = "l-grid-item--6-col l-grid-item--l--4-col u-shift--left--1-col--standard u-no-gutters";
          $grid_item_class = "l-grid-item--s--3-col l-grid-item--l--2-col";
        }
        echo '<div class="l-grid l-grid--7-col ' . $grid_class . '">';
      }
    @endphp
      @foreach ($pages as $page)
        @php
          if ($related == 'related_all') {
            $id = $page->ID;
          } elseif ($related == 'related_custom') {
            $id = $page;
          } else {
            $id = $page->ID;
          }
          $title = get_the_title($id);
          $excerpt = get_the_excerpt($id);
          $excerpt_length = 400;
          $body = get_the_content($id);
          $link = get_permalink($id);
          $category = NULL;
          $date = NULL;
          $cta = "Read More";
          $block_class = "u-spacing--half";
          $block_title_class = "u-theme--color--darker u-font--primary--m";
          $block_meta_class = "hide";
          if ($related_image == "true") {
            $thumb_id = get_post_thumbnail_id($id);
          } else {
            $thumb_id = false;
          }
          if ($thumb_id) {
            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            if ($related_grid == "true") {
              $excerpt_length = 150;
              $thumb_size = 'horiz__16x9';
              $block_class = "c-media-block__stacked c-block__stacked u-space--right u-space--double--bottom";
              $block_content_class = "u-border--left u-theme--border-color--darker--left";
              $picture = true;
              $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size)[0];
              $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
              $image_break_m = "500";
            } else {
              if ($related_image_round == "true") {
                $block_img_wrap_class = "u-round u-space--left";
              } else {
                $block_img_wrap_class = "";
              }
              $excerpt_length = 200;
              $thumb_size = 'thumbnail';
              $thumb_id = get_post_thumbnail_id($id);
              $image = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
              $block_group_class = "u-flex--justify-start";
              if (get_post_meta($post->ID, 'hide_sidebar', true) == 'true') {
                $block_class = "c-media-block__row c-block__row l-grid--7-col l-grid-wrap";
                $block_img_class = "l-grid-item l-grid-item--2-col l-grid-item--m--1-col u-padding--zero--sides";
                $block_content_class = "l-grid-item l-grid-item--4-col l-grid-item--m--3-col";
              } else {
                $block_class = "c-media-block__row c-block__row l-grid--7-col l-grid-wrap l-standard-break";
                $block_img_class = "l-grid-item l-grid-item--2-col l-grid-item--m--1-col l-grid-item--xl--1-col u-padding--zero--sides";
                $block_content_class = "l-grid-item l-grid-item--4-col l-grid-item--m--3-col l-grid-item--xl--2-col";
              }
            }
          } else {
            $thumb_id = NULL;
            if ($related_grid == "true") {
              $block_class = "u-spacing u-padding--right u-space--double--bottom";
            }
          }
        @endphp
        @if ($related_grid == "true")<div class="l-grid-item {{ $grid_item_class }}">@endif
          @if ($thumb_id)
            @include('patterns.01-molecules.blocks.media-block')
          @else
            @include('patterns.01-molecules.blocks.content-block')
          @endif
        @if ($related_grid == "true")</div>@endif
      @endforeach
    @if ($related_grid == "true")</div>@endif
  </div>
@endif
{!! wp_reset_query() !!}
