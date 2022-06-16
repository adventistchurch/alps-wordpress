@php
  $current_language = apply_filters('wpml_current_language', NULL);

  if ($current_language) {
    $logo = get_alps_option('logo_' . $current_language);
  } else {
    $logo = get_alps_option('logo');
  }

  if (!empty(get_alps_option('dark_theme'))) {
    $dark_theme = get_alps_option('dark_theme');
    $header_logo_class = " u-theme--path-fill--base";
  } else {
    $header_logo_class = "";
  }

  if (carbon_get_the_post_meta('hero_type') == 'full_overlay') {
    $header_class = " c-header--overlay u-theme--gradient--top";
    $logo_class = "u-path-fill--white";
  } else {
    $header_class = "";
    $logo_class = "u-theme--path-fill--base";
  }

  $logoContainerClass = ['c-header__logo', 'c-logo'];
  if (get_alps_option('is_wide_logo')) {
      $logoContainerClass[] = 'c-header__logo--wide';
  }
@endphp
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
            @include('patterns.00-atoms.logos.alps-logo-icon')
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
@include('patterns.01-molecules.navigation.drawer-navigation')
