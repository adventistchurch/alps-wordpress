@php
  $theme_options = get_option('alps_theme_settings');

  if ($theme_options['sabbath_icon']) {
    $sabbath_icon = $theme_options['sabbath_icon'][0];
  } else {
    $sabbath_icon = '';
  }

  if ($theme_options['sabbath_background']) {
    $sabbath_background = $theme_options['sabbath_background'][0];
  } else {
    $sabbath_background = '';
  }

  if ($theme_options['sabbath_scroll']) {
    $sabbath_icon_class = 'js-show-on-scroll is-hidden';
  } else {
    $sabbath_icon_class = '';
  }
@endphp
<aside class="l-wrap__sabbath l-sabbath js-sticky-parent js-toggle-menu @if (!empty($sabbath_background)){{'u-background-image--sabbath'}}@endif">
  @if (!empty($sabbath_background))
    <style>
      .u-background-image--sabbath {
        background-image: url('{{ wp_get_attachment_url($sabbath_background) }}') !important;
      }
    </style>
    @if (!empty($sabbath_icon))
      <div class="l-sabbath__logo u-path-fill--white js-sticky">
        <img class="style-svg" src="{{ wp_get_attachment_url($sabbath_icon) }}" alt="{{ get_post_meta($sabbath_icon, '_wp_attachment_image_alt', true) }}">
      </div>
    @endif
  @elseif (!empty($sabbath_icon))
    <div class="l-sabbath__logo js-sticky">
      <div class="l-sabbath__logo--inner {{ $sabbath_icon_class }}">
        <div class="l-sabbath__logo-light u-path-fill--white">
          <img class="style-svg" src="{{ wp_get_attachment_url($sabbath_icon) }}" alt="{{ get_post_meta($sabbath_icon, '_wp_attachment_image_alt', true) }}">
        </div>
        <div class="l-sabbath__logo-dark u-theme--path-fill--base">
          <img class="style-svg" src="{{ wp_get_attachment_url($sabbath_icon) }}" alt="{{ get_post_meta($sabbath_icon, '_wp_attachment_image_alt', true) }}">
        </div>
      </div>
    </div>
    <div class="l-sabbath__overlay u-theme--background-color--base"></div>
  @endif
</aside>
