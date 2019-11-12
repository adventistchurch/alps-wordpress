@php
  // SET VARS
  $sabbath_icon = '';
  $sabbath_background = '';
  $sabbath_icon_class = '';

  // DEFINE VARS
  $sabbath_icon = get_alps_option('sabbath_icon');
  $sabbath_background = get_alps_option('sabbath_background');
  if (get_alps_option('sabbath_scroll')) {
    $sabbath_icon_class = 'js-show-on-scroll is-hidden';
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
  @else
    <div class="l-sabbath__logo js-sticky">
      <div class="l-sabbath__logo--inner @if (!empty($sabbath_icon_class)){{ $sabbath_icon_class }}@endif">
        <div class="l-sabbath__logo-light u-path-fill--white">
          @if (!empty($sabbath_icon))
            <img class="style-svg" src="{{ wp_get_attachment_url($sabbath_icon) }}" alt="{{ get_post_meta($sabbath_icon, '_wp_attachment_image_alt', true) }}">
          @else
            @include('patterns.00-atoms.logos.alps-icon-logo')
          @endif
        </div>
        <div class="l-sabbath__logo-dark u-theme--path-fill--base">
          @if (!empty($sabbath_icon))
            <img class="style-svg" src="{{ wp_get_attachment_url($sabbath_icon) }}" alt="{{ get_post_meta($sabbath_icon, '_wp_attachment_image_alt', true) }}">
          @else
            @include('patterns.00-atoms.logos.alps-icon-logo')
          @endif
        </div>
      </div>
    </div>
    <div class="l-sabbath__overlay u-theme--background-color--base"></div>
  @endif
</aside>
