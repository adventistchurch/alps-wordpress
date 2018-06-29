@php
  $hero_type = get_post_meta($post->ID, 'hero_type', true);
  if ($hero_type == "false" || $hero_type == NULL) {
    $hero = false;
  } else {
    $hero = true;
    if ($hero_type == "full") {
      $hero_image[] = get_post_meta($post->ID, 'hero_image', true)[0];
      $block_class = "c-block__full c-media-block__full has-scroll";
      $block_group_class = "u-flex--justify-center u-overlay--dark";
      $block_content_class = "l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7 u-color--white";
      $block_title_class = "l-grid-item--5-col l-grid-item--m--2-col u-font--primary--xl u-flex--justify-center";
    } elseif ($hero_type == "column") {
      $hero_image = get_post_meta($post->ID, 'hero_image', true);
      $block_class = "c-block__column c-media-block__column";
      $block_group_class = "u-flex--justify-center u-overlay--dark";
      $block_content_class = "u-color--white";
      $block_title_class = "u-font--primary--xl u-flex--justify-center";
    } else {
      $hero_image[] = get_post_meta($post->ID, 'hero_image', true)[0];
      $block_class = "c-block__inset c-media-block__inset";
      $block_content_class = "l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7 u-theme--background-color--darker u-color--white";
      $block_title_class = "l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col u-font--primary--xl";
      $block_meta_class = "l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col";
    }
  }
@endphp
@if ($hero)
  <header class="c-hero c-page-header c-page-header__feature @if($hero_type == "column"){{ 'c-page-header__3-col' }}@endif">
    <div class="c-page-header__content">
      @foreach ($hero_image as $post)
        @php
          $link = $post['hero_link_url'];
          if ($hero_type == "column") {
            $eyebrow = $post['hero_kicker'];
            $title = $post['hero_title'];
          } else {
            $title = $post['hero_title'];
            $category = $post['hero_kicker'];
          }
          if ($hero_type == "default") {
            $thumb_size = 'featured__hero';
            $image_break_m = "500";
            $image_break_l = "800";
            $image_break_xl = "1100";
          } else {
            $background_image = true;
            $thumb_size = 'flex-height';
            $image_break_m = "350";
            $image_break_l = "700";
            $image_break_xl = "900";
          }
          $picture = true;
          $thumb_id = $post['hero_image'][0];
          $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
          $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
          $image_l = wp_get_attachment_image_src($thumb_id, $thumb_size . '--l')[0];
          $image_xl = wp_get_attachment_image_src($thumb_id, $thumb_size . '--xl')[0];
          $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        @endphp
        @include('patterns.01-molecules.blocks.media-block')
      @endforeach
    </div>
  </header> <!-- /.c-page-header -->
@else
  @include('patterns.02-organisms.sections.page-header')
@endif
