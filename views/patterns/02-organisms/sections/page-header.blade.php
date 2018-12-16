@php
  use Roots\Sage\Titles;
  if (!is_home()) {
    global $post;

    if (get_post_meta($post->ID, 'header_background_image', true)) {
      $header_background_image = get_post_meta($post->ID, 'header_background_image', true);
      $page_header_class = "c-background-image blended u-background--cover u-gradient--bottom";
    } elseif (get_post_thumbnail_id($post->ID)) {
      $header_background_image = get_post_thumbnail_id($post->ID);
      $page_header_class = "c-background-image blended u-background--cover u-gradient--bottom";
    } else {
      $header_background_image = "";
      $page_header_class = NULL;
    }
  }

  if (is_home()) {
    $display_title = _e("Recent Posts", "sage");
    $title = NULL;
  } else if (is_archive()) {
    $kicker = _e("Category", "sage") }};
    $display_title = '';
    $title = single_cat_title( '', false );
  } else {
    $kicker = get_post_meta($post->ID, 'kicker', true);
    $display_title = get_post_meta($post->ID, 'display_title', true);
    $title = get_the_title($post->ID);
  }
@endphp
<header class="c-page-header c-page-header__simple u-theme--background-color--dark @if(isset($page_header_class)){{ $page_header_class }}@endif">
  @if (!empty($header_background_image))
    <style type="text/css">
      .c-background-image {
        background-image: url(<?php echo wp_get_attachment_image_url( $header_background_image, 'featured__hero--m' ); ?>);
      }
      @media (min-width: 900px) {
        .c-background-image {
          background-image: url(<?php echo wp_get_attachment_image_url( $header_background_image, 'featured__hero--l' ); ?>);
        }
      }
      @media (min-width: 1100px) {
        .c-background-image {
          background-image: url(<?php echo wp_get_attachment_image_url( $header_background_image, 'featured__hero--xl' ); ?>);
        }
      }
    </style>
  @endif
  <div class="c-page-header__simple--inner u-padding">
    @if (!empty($kicker))
      <span class="o-kicker u-color--white">{{ $kicker }}</span>
    @elseif (is_page() && $post->post_parent != '0')
      <span class="o-kicker u-color--white">{{ get_the_title($post->post_parent) }}</span>
    @endif
    <h1 class="u-font--primary--xxl u-color--white">
      @if (!empty($display_title))
        {{ $display_title }}
      @else
        {!! $title !!}
      @endif
    </h1>
  </div>
</header> <!-- /.c-page-header-->
