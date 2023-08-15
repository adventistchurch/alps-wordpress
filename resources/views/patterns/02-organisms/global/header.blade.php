@php
  $current_language = apply_filters('wpml_current_language', NULL);

  if ($current_language) {
    $logo = get_alps_option('logo_' . $current_language);
    $logo_inverted = get_alps_option('logo_inverted_' . $current_language);
  } else {
    $logo = get_alps_option('logo');
    $logo_inverted = get_alps_option('logo_inverted' . $current_language);
  }

  if (!empty(get_alps_option('dark_theme'))) {
    if (!empty($logo_inverted)){
      $logo = $logo_inverted;
    }
    $dark_theme = get_alps_option('dark_theme');
  } else {
    $header_logo_class = "";
  }

  $header_type = carbon_get_the_post_meta('head_type');
  if (carbon_get_the_post_meta('hero_type') == 'full_overlay' || $header_type == 'overlay' || $header_type == 'overlay_gradient') {
    if (!empty($logo_inverted)){
      $logo = $logo_inverted;
    }
    if (carbon_get_the_post_meta('head_type') == 'overlay'){
      $header_class = " c-header--overlay";
    }else{
      $header_class = " c-header--overlay u-theme--gradient--top";
    }
    $logo_class = "u-path-fill--white";
  } else {
    $header_class = "";
    $logo_class = "u-theme--path-fill--base";
  }

  $logoContainerClass = ['c-header__logo', 'c-logo'];
  if (get_alps_option('is_wide_logo')) {
      $logoContainerClass[] = 'c-header__logo--wide';
  }

  if (!empty(get_alps_option('logo_recolor')) && get_alps_option('logo_recolor')){
    $header_logo_class = " u-theme--path-fill--base";
  }
@endphp

@if ($header_type != 'remove')
<header class="c-header{{ $header_class }}" role="banner" id="header">
  <div class="c-header--inner">
    <div class="c-header__nav-secondary">
      @include('patterns.01-molecules.navigation.secondary-navigation')
    </div>
    <div class="{{ implode(' ', $logoContainerClass) }}">
      <a href="{{ get_home_url() }}" class="c-logo__link{{ $header_logo_class }}">
        @if ($logo)
          <img class="style-svg" src="{{ wp_get_attachment_url($logo) }}" alt="{{ get_post_meta($logo, '_wp_attachment_image_alt', true) }}">
        @else
          <span class="{{ $logo_class }}">
            @includeFirst(['patterns.00-atoms.logos.alps-logo-custom', 'patterns.00-atoms.logos.alps-logo'])
          </span>
        @endif
      </a>
    </div> <!-- /.c-header__logo -->
    <div class="c-header__nav-primary">
      @include('patterns.01-molecules.navigation.primary-navigation')
    </div>
  </div> <!-- /.c-header--inner -->
  @if (carbon_get_the_post_meta('hero_type') == 'full_overlay')
    <div class="c-header__sabbath u-theme--gradient--top">
      <div class="o-logo u-path-fill--white">
        @if (!empty(get_alps_option('sabbath_icon')))
          <img class="style-svg" src="{{ wp_get_attachment_url(get_alps_option('sabbath_icon')) }}" alt="{{ get_post_meta(get_alps_option('sabbath_icon'), '_wp_attachment_image_alt', true) }}">
        @else
          @include('patterns.00-atoms.logos.alps-icon-logo')
        @endif
      </div>
    </div>
  @endif
</header> <!-- .c-header -->
@endif
@include('patterns.01-molecules.navigation.drawer-navigation')
