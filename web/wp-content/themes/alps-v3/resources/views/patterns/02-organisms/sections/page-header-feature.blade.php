@php
  use Roots\Sage\Titles;
  global $post;
  $id = $post->ID;
  $kicker = get_post_meta($post->ID, 'kicker', true);
  $date = date('F j, Y', strtotime(get_the_date()));

  $display_title = get_post_meta($post->ID, 'display_title', true);
  if (!empty($display_title)) {
    $title = $display_title;
  } else {
    $title = App\title();
  }

  $header_background_image = get_post_meta($post->ID, 'header_background_image', true);
  if (!empty($header_background_image)) {
    $thumb_id = $header_background_image;
  } else if (get_post_thumbnail_id($id)) {
    $thumb_id = get_post_thumbnail_id($id);
  } else {
    $thumb_id = NULL;
  }

  if (has_excerpt()) {
    $excerpt = get_the_excerpt($id);
    $excerpt_length = 200;
  }

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

  if ($thumb_id) {
    $picture = true;
    $thumb_size = 'horiz__4x3';
    $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
    $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
    $image_l = wp_get_attachment_image_src($thumb_id, $thumb_size . '--l')[0];
    $image_break_m = "500";
    $image_break_l = "900";
    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
    $block_class = "c-block__inline c-media-block__inine c-block--reversed c-media-block--reversed l-grid--7-col";
    $block_img_class = "l-grid-item u-padding--zero--sides";
    $block_content_class = "l-grid-item u-border-left--black--at-large u-theme--border-color--darker--left u-theme--color--lighter u-theme--background-color--darker u-padding--top u-padding--bottom";
    $block_title_class = "u-color--white u-font--primary u-font-weight--bold";
  } else {
    $block_class = "c-block__inline c-media-block__inine l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7 u-theme--background-color--darker can-be--dark-dark u-padding--top u-padding--bottom";
    $block_img_class = false;
    $block_content_class = "u-shift--left--1-col--at-large l-grid-item l-grid-item--m--6-col l-grid-item--l--4-col l-grid-item--xl--3-col u-border--left u-theme--border-color--light--left u-theme--color--lighter";
    $block_title_class = "u-color--white u-font--primary--l";
  }
@endphp
<header class="c-page-header c-page-header__feature">
  <div class="c-page-header__content">
    @include('patterns.01-molecules.blocks.media-block')
  </div>
</header> <!-- /.c-page-header -->
