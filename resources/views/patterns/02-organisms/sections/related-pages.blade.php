@php
  $cf_ = '_';

  $related = get_post_meta($post->ID, $cf_.'related', true);
  $related_grid = get_post_meta($post->ID, $cf_.'related_grid', true);
  $related_image = get_post_meta($post->ID, $cf_.'related_image', true);
  $related_image_round = get_post_meta($post->ID, $cf_.'related_image_round', true);
  $thumb_crop = get_post_meta($post->ID, '_related_image_crop', true);
  $title_h1 = false;

  if ($related == 'related_top_level')  {
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
  elseif ($related == 'related_all') {
    // Loop of pages for child and grandchild pages
    $pages = get_pages(
      array(
        'child_of' => $post->ID,
        'post_type' => 'page',
        'post_status' => 'publish',
        'sort_column' => 'menu_order'
      )
    );
  }
  elseif ($related == 'related_custom') {
    // CARBON FIELDS HAS COMPELTELY DIFFERENT FORMAT HERE
    $assigned = carbon_get_post_meta(get_the_id(), 'related_custom_value');
    $pages = [];
    foreach ($assigned as $k => $entry) {
      foreach ($entry as $key => $val) {
        if (!empty($val)) {
          if ($key == 'id') array_push($pages, $val);
        }
      }
    }
  }
  else {
    $pages = false;
  }
@endphp

@if ($pages)
  <div class="u-spacing--double u-space--double--top">
    @php
      if ($related_grid == "true") {
        if (get_alps_option('index_hide_sidebar') == 'false' || get_post_meta($post->ID, '_hide_sidebar', true) == 'true') {
          if (get_post_meta($post->ID, '_related_grid_3up', true) == 'true') {
            $grid_class = "l-grid-item--6-col l-grid-item--l--4-col l-grid-item--xxl--6-col u-shift--right--1-col--at-large  u-shift--left--1-col--standard u-no-gutters";
            $grid_item_class = "l-grid-item--s--3-col l-grid-item--l--2-col";
          }
          else {
            $grid_class = "l-grid-item--6-col l-grid-item--m--4-col u-no-gutters";
            $grid_item_class = "l-grid-item--xs--3-col l-grid-item--m--2-col";
          }
        }
        else {
          $grid_class = "l-grid-item--6-col l-grid-item--l--4-col u-shift--left--1-col--standard u-no-gutters";
          $grid_item_class = "l-grid-item--s--3-col l-grid-item--l--2-col";
        }
        echo '<div class="l-grid l-grid--7-col ' . $grid_class . '">';
      }
    @endphp
      @foreach ($pages as $page)
        @php
          if ($related == 'related_custom') {
            $id = $page;
            $title = get_the_title($id);
            $link = get_the_permalink($id);
            if (has_excerpt($id)) {
              $excerpt = get_the_excerpt($id);
            }
            else {
              $excerpt = get_post_field('post_content', $id, 'raw');
            }
            $excerpt_length = 55;
          } else {
            $id = $page->ID;
            $title = $page->post_title;
            $link = get_the_permalink($id);
            if (has_excerpt($id)) {
              $excerpt = get_the_excerpt($id);
            }
            else {
              $excerpt = $page->post_content;
            }
            $excerpt_length = 55;
          }

          $body = false;
          $category = NULL;
          $date = NULL;
          $cta = __('Read More', 'alps');
          $block_class = "u-spacing--half";
          $block_title_class = "u-theme--color--darker u-font--primary--m";
          $block_meta_class = "hide";

          if ($related_image  == true) {
            $thumb_id = get_post_thumbnail_id($id);
          }
          else {
            $thumb_id = false;
          }

          if ($thumb_id) {
            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
           $thumb_size = 'thumbnail';
           if (!empty($thumb_crop)){
             if ($thumb_crop == 'landscape') $thumb_size = 'horiz__16x9';
             if ($thumb_crop == 'portrait') $thumb_size = 'vert__3x4';
            } else{
              $thumb_size = 'thumbnail';
            }
            $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s');
            $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m');
            if ($thumb_crop == 'landscape'){
              if ($image_m[1] < 800 ) {
                $image_m = $image_s;
              }
            }else{
              if ($image_m[1] < 600 ) {
                $image_m = $image_s;
              }
            }
            $image_s = $image_s[0];
            $image_m = $image_m[0];
            $image_break_m = "400";
            if ($related_image_round == "true" || $thumb_crop == 'circle') {
              if ($related_grid == "true"){
                $picture_class = "u-round";
              }else{
                $block_img_wrap_class = "u-round u-space--left";
              }
            }
            else {
              $block_img_wrap_class = "";
            }
            if ($related_grid == "true") {
              $excerpt_length = 35;
              $block_class = "c-media-block__stacked c-block__stacked u-space--right u-space--double--bottom";
              $block_content_class = "u-border--left u-theme--border-color--darker--left";
              $picture = true;
              if ($related_image_round == "true" || $thumb_crop == 'circle') {
                $block_img_wrap_class = "u-padding--double--left u-padding--double--right";
                $block_content_class = "";
                $block_group_class = "u-flex--align-center";
                $block_text_class = "u-text-align--center";
              }
            }
            else {
              $excerpt_length = 55;
              $image = $image_s;
              if (end(explode(".", $image)) === 'gif') {
                $image = wp_get_attachment_image_src($thumb_id, $thumb_size . 'full')[0];
              }
              $block_group_class = "u-flex--justify-start";
              if (!is_active_sidebar('sidebar-page') || get_post_meta($post->ID, 'hide_sidebar', true) == 'true') {
                $block_img_class = "l-grid-item l-grid-item--2-col l-grid-item--m--1-col u-padding--zero--sides";
              }
              else {
                $block_img_class = "l-grid-item l-grid-item--2-col l-grid-item--m--1-col l-grid-item--xl--1-col u-padding--zero--sides";
              }

              $entry_hide_sidebar = get_post_meta($post->ID, $cf_.'hide_sidebar', true);

              if ($entry_hide_sidebar) {
                $block_class = "c-media-block__row c-block__row l-grid--7-col l-grid-wrap";
                $block_content_class = "l-grid-item l-grid-item--4-col l-grid-item--m--3-col l-grid-item--xl--3-col";
              } else {
                $block_class = "c-media-block__row c-block__row l-grid--7-col l-grid-wrap l-standard-break";
                $block_content_class = "l-grid-item l-grid-item--4-col l-grid-item--m--3-col";
              }
            }
          }
          else {
            $thumb_id = NULL;
            if ($related_grid == "true") {
              $block_class = "u-spacing u-padding--right u-space--double--bottom";
              $excerpt_length = 55;
            }
            else {
              $excerpt_length = 55;
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
