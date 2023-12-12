@php
  use Roots\Sage\Titles;

  $cf_ = '_';

  // SET TO INITIALIZE / OVERRIDE
  $header_background_image = '';
  $long_header_title = '';
  $long_header_kicker = '';
  $long_header_subtitle = '';
  $page_header_class = '';
  $page_header_inner_class = '';
  $page_header_content_class = 'u-shift--left--1-col--at-xxlarge';

  $isPostsPage = is_archive() && !get_option( 'page_for_posts' );

  $page_sub_title = get_post_meta( $post->ID, 'page_sub_title', true );

  if (is_home()) {
    if (get_alps_option('posts_page_title')) {
      $long_header_title = get_alps_option('posts_page_title');
    } else {
      $long_header_title = __('Recent Posts', 'alps');
    }
  }
  elseif ($isPostsPage) {
    if (get_alps_option('posts_label')) {
      $long_header_kicker = __('Category', 'alps');
    }
    if (get_alps_option('archive_page_title')) {
      $long_header_title = get_alps_option('archive_page_title');
    } else {
      $long_header_title = single_cat_title('', false);
    }
  }

  if (!is_home() && !$isPostsPage) {
    global $post;
    // PAGE FIELDS
    $remove_header = get_post_meta($post->ID, $cf_.'remove_header', true);
    $hide_featured_image = get_post_meta($post->ID, $cf_.'hide_featured_image', true);
    $long_header_kicker = get_post_meta($post->ID, $cf_.'kicker', true);
    $long_header_title = get_post_meta($post->ID, $cf_.'display_title', true);
    $long_header_subtitle = carbon_get_the_post_meta('long_header_subtitle');
    $header_background_image = get_post_meta($post->ID, $cf_.'header_background_image', true);
    $title = get_the_title($post->ID);
    if (!$long_header_title) {
      $long_header_title = $title;
    }
    if (!$header_background_image && empty($hide_featured_image)) {
      $header_background_image = get_post_thumbnail_id($post->ID);
    }
  }

  $page_header_classes = 'c-page-header c-page-header__long u-theme--background-color--dark  u-space--zero--top';
  $feature_image_hero = get_post_meta($post->ID, $cf_.'featured_image_hero_layout', true);
  if ($feature_image_hero == 'page-header'){
    $page_header_classes = 'c-page-header c-page-header__long c-page-header__longer u-theme--background-color--dark  u-space--zero--top';
  }
@endphp

@if ($header_background_image)
  @php
    $page_header_class = 'o-background-image u-background--cover has-background';
    $page_header_inner_class = 'u-gradient--bottom';
    $page_header_content_class .= ' u-border-left--white--at-large';

    if (is_page_template('views/template-posts.blade.php')) {
      $page_header_content_class = '';
    }
  @endphp
  <style type="text/css">
    .o-background-image {
      background-image: url(<?php echo wp_get_attachment_image_url($header_background_image, 'featured__hero--m'); ?>);
    }
    @media (min-width: 900px) {
      .o-background-image {
        background-image: url(<?php echo wp_get_attachment_image_url($header_background_image, 'featured__hero--l'); ?>);
      }
    }
    @media (min-width: 1100px) {
      .o-background-image {
        background-image: url(<?php echo wp_get_attachment_image_url($header_background_image, 'featured__hero--xl'); ?>);
      }
    }
  </style>
@endif

@if (empty($remove_header))
  <header class="{{ $page_header_classes }} {{ $page_header_class }}">
    <div class="c-page-header__long--inner l-grid l-grid--7-col {{ $page_header_inner_class }}">
      <div class="c-page-header__content c-page-header__long__content l-grid-wrap l-grid-wrap--5-of-7 u-border--left {{ $page_header_content_class }}">
        @if ($long_header_kicker)
          <span class="o-kicker u-color--white">{{ $long_header_kicker }}</span>
        @endif
        <h1 class="u-font--primary--xl u-color--white u-font-weight--bold">
          {!! $long_header_title !!}
        </h1>
        @if ($page_sub_title)
          <span class="o-kicker u-color--white">{{ $page_sub_title }}</span>
        @endif
      </div>
    </div>
  </header>
  @if ($long_header_subtitle)
    <div class="c-page-header__subtitle c-page-header__long__subtitle l-grid l-grid--7-col u-space--top--zero">
      <div class="l-grid-wrap l-grid-wrap--5-of-7 u-shift--left--1-col--at-medium u-border--left u-font--secondary--m">
        {{ $long_header_subtitle }}
      </div>
    </div>
  @endif
@endif
