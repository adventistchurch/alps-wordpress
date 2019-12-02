@php
  $current_language = apply_filters('wpml_current_language', NULL);

  if (carbon_get_the_post_meta('hero_type') == 'full') {
    $header_class = ' c-header--overlay u-theme--gradient--top';
  } else {
    $header_class = "";
  }

  if ($current_language) {
    $logo = get_alps_option('logo_' . $current_language);
  } else {
    $logo = get_alps_option('logo');
  }

  if (!empty(get_alps_option('dark_theme'))) {
    $dark_theme = get_alps_option('dark_theme');
    $header_logo_class = "u-theme--path-fill--base";
  } else {
    $header_logo_class = "";
  }
@endphp
<header class="c-header{{ $header_class }}" role="banner" id="header">
  <div class="c-header--inner">
    <div class="c-header__nav-secondary">
      @include('patterns.01-molecules.navigation.secondary-navigation')
    </div>
    <div class="c-header__logo c-logo">
      <a href="{{ get_home_url() }}" class="c-logo__link {{ $header_logo_class }}">
        @if ($logo)
          <img class="style-svg" src="{{ wp_get_attachment_url($logo) }}" alt="{{ get_post_meta($logo, '_wp_attachment_image_alt', true) }}">
        @else
          <span class="u-theme--path-fill--base">
            @include('patterns.00-atoms.logos.alps-logo')
          </span>
        @endif
      </a>
    </div> <!-- /.c-header__logo -->
    <div class="c-header__nav-primary">
      @include('patterns.01-molecules.navigation.primary-navigation')
    </div>
  </div> <!-- /.c-header--inner -->
  @if (carbon_get_the_post_meta('hero_type') == 'full' && get_alps_option('sabbath_icon'))
    <div class="c-header__sabbath u-theme--gradient--top">
      <div class="o-logo u-path-fill--white">
        @include('patterns.00-atoms.logos.icon-logo-dark')
      </div>
    </div>
  @endif
</header> <!-- .c-header -->
@include('patterns.01-molecules.navigation.drawer-navigation')
