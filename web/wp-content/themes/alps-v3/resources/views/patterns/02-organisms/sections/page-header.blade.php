@php
  use Roots\Sage\Titles;
  global $post;
  $display_title = '';
  $kicker = '';
  $header_background_image = '';
  if (is_page() || is_single()) {
    $display_title = get_post_meta($post->ID, 'display_title', true);
    $kicker = get_post_meta($post->ID, 'kicker', true);
    $header_background_image = get_post_meta($post->ID, 'header_background_image', true);
  }

  if (is_single()) {
    // SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
    $category = get_the_category();
    // If post has a category assigned.
    if ($category) {
      $kicker = '';
      $display_title = '';
      if (class_exists('WPSEO_Primary_Term')) {
        // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
        $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
        $term = get_term($wpseo_primary_term);
        if (is_wp_error($term)) {
          // Default to first category (not Yoast) if an error is returned
          $kicker = '';
          $display_title = $category[0]->name;
        } else {
          // Yoast Primary category
          if ($term->parent != 0) {
            $term_parent = get_term($term->parent, 'category')->name;
            $kicker = $term_parent;
            $display_title = $term->name;
          } else {
            $kicker = '';
            $display_title = $term->name;
          }
        }
      }
      else {
        // Default, display the first category in WP's list of assigned categories
        $kicker = '';
        $display_title = $category[0]->name;
      }
    }
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
    @if ($kicker && !is_category() && !is_home())
      <span class="o-kicker u-color--white">{{ $kicker }}</span>
    @elseif (is_page() && $post->post_parent != '0')
      <span class="o-kicker u-color--white">{{ get_the_title($post->post_parent) }}</span>
    @endif
    <h1 class="u-font--primary--xxl u-color--white">
      @if ($display_title)
        {{ $display_title }}
      @else
        {!! App\title() !!}
      @endif
    </h1>
  </div>
</header> <!-- /.c-page-header-->
