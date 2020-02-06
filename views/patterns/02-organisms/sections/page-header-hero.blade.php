@php
  $cf = get_option('alps_cf_converted');
  $cf_ = '';
  if ($cf) {
    $cf_ = '_';
  }
  $hero_type = get_alps_field('hero_type');
  if (empty($hero_type) && $cf) {
    $hero_type = carbon_get_the_post_meta('hero_type');
  }
  if ($hero_type == 'false' || $hero_type == NULL)  {
    $hero = false;
  }
  else {
    $hero = true;
    $hero_image = [];
    $extended = '';
    $extended = get_post_meta($post->ID, $cf_.'hero_image_extended', true);
    $scroll_hint = '';
    if ($hero_type == 'full') {
      array_push($hero_image,  get_post_meta($post->ID, $cf_.'hero_image', true));
      $block_group_class = 'u-flex--justify-center u-overlay--dark';
      $block_title_class = 'l-grid-item--5-col l-grid-item--m--2-col u-font--primary--xl u-flex--justify-center';
      $block_title_link_class = 'u-theme--link-hover--lighter';
      $scroll_class = '';
      $scroll_hint = get_post_meta($post->ID, $cf_.'hero_scroll_hint', true);
      if ($scroll_hint) {
        $scroll_class = ' has-scroll';
      }
      if ($extended) {
        $block_content_class = 'l-grid--7-col l-grid-wrap l-grid-wrap--7-of-7 u-color--white';
        $block_class = 'c-block__full c-media-block__full' . $scroll_class;
      }
      else {
        $block_content_class = 'l-grid--7-col l-grid-wrap l-grid-wrap--7-of-7 u-color--white';
        $block_class = 'c-block__full c-media-block__full l-grid-wrap l-grid-wrap--6-of-7' . $scroll_class;
      }
    }
    elseif ($hero_type == 'column') {
      $hero_image[] = get_alps_field('hero_column');
      $block_class = 'c-block__column c-media-block__column';
      $block_group_class = 'u-flex--justify-center u-overlay--dark';
      $block_content_class = 'u-color--white';
      $block_title_class = 'u-font--primary--xl u-flex--justify-center';
      $block_title_link_class = 'u-theme--link-hover--light';
    }
    elseif ($hero_type == 'carousel') {
      $hero_image[] = get_alps_field('hero_carousel');
    }
    elseif ($hero_type == 'default') {
      array_push($hero_image, get_post_meta($post->ID, $cf_.'hero_image', true));
      $block_class = 'c-block__inset c-media-block__inset';
      $block_title_class = 'l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col u-font--primary--xl';
      $block_title_link_class = 'u-theme--link-hover--light';
      $block_meta_class = 'l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col';
      if ($extended) {
        $block_img_class = 'l-grid-wrap l-grid-wrap--7-of-7';
        $block_content_class = 'l-grid--7-col l-grid-wrap l-grid-wrap--7-of-7 u-shift--left--1-col--at-xxlarge u-border-left--white--at-large u-theme--background-color--darker u-color--white';
        $block_group_class = ' ';
      }
      else {
        $block_content_class = 'l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7 u-theme--background-color--darker u-color--white';
      }
    }
  }
@endphp

@if ($hero)
  <header class="c-hero c-page-header c-page-header__feature @if($hero_type == 'column'){{ 'c-page-header__3-col' }}@endif {{ $scroll_class }}">
    <div class="c-page-header__content">
      @php
      $hero_data = array();
        if ($hero_type == 'column' || $hero_type == 'carousel') {
          $hero_data = $hero_image[0];
        }
        else {
          $hero_data = $hero_image;
        }
      @endphp
      @if ( $hero_type == 'carousel' ) {
        @include('patterns.01-molecules.components.carousel');
      @else
        @foreach ($hero_data as $image)
          @php
            if ($hero_type == 'column') {
              if ($cf) {
                $thumb_id = $image['hero_image_column'];
              } else {
                $thumb_id = $image['hero_image_column'][0];
              }
              $eyebrow = $image['hero_kicker_column'];
              $title = $image['hero_title_column'];
              $link = NULL;
              if (isset($image['hero_link_url'])) {
                $link = $image['hero_link_url'];
              }
            } else {
              $thumb_id = $image;
              $title = get_post_meta($post->ID, $cf_.'hero_title', true) ;
              $category = NULL;
              $link = NULL;
              if (get_post_meta($post->ID, $cf_.'hero_kicker', true)) {
                $category = get_post_meta($post->ID, $cf_.'hero_kicker', true);
              }
              if (get_post_meta($post->ID, $cf_.'hero_link_url', true)) {
                $link = get_post_meta($post->ID, $cf_.'hero_link_url', true);
              }
            }
            if ($hero_type == 'default') {
              $thumb_size = 'featured__hero';
              $image_break_m = '500';
              $image_break_l = '800';
              $image_break_xl = '1100';
            }
            else {
              $background_image = true;
              $thumb_size = 'flex-height';
              $image_break_m = '350';
              $image_break_l = '700';
              $image_break_xl = '900';
            }
            $picture = true;
            $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
            $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
            $image_l = wp_get_attachment_image_src($thumb_id, $thumb_size . '--l')[0];
            $image_xl = wp_get_attachment_image_src($thumb_id, $thumb_size . '--xl')[0];
            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
          @endphp
          @include('patterns.01-molecules.blocks.media-block')
        @endforeach
      @endif
    </div>
    @if (get_alps_field('hero_scroll_hint') == true)
      <a href="#top" class="c-page-header__scroll"></a>
    @endif
  </header> <!-- /.c-page-header -->
@else
  @include('patterns.02-organisms.sections.page-header')
@endif
