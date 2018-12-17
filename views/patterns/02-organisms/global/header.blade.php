@php
  $theme_options = get_option('alps_theme_settings');
  $current_language = apply_filters('wpml_current_language', NULL);
  if ($current_language) {
    $logo = $theme_options['logo_' . $current_language][0];
  } else {
    $logo = $theme_options['logo'][0];
  }

  if ($theme_options['dark_theme']) {
    $header_logo_class = "u-theme--path-fill--base";
  } else {
    $header_logo_class = "";
  }
@endphp
<header class="c-header" role="banner" id="header">
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
</header> <!-- .c-header -->
@include('patterns.01-molecules.navigation.drawer-navigation')
