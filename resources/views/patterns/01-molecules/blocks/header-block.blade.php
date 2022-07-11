@php
  /**
   * Simple Header Block
   *
   * @var string $headerTitle
   * @var string $headerKicker
   * @var string $headerSubtitle
   * @var string $headerBackgroundImage
   */

  $headerClasses = [
    'c-page-header',
    'c-page-header__long',
    'u-theme--background-color--dark',
    'u-space--zero--top',
  ];
  $headerInnerClasses = [
    'c-page-header__long--inner',
    'l-grid',
    'l-grid--7-col',
  ];
  $headerContentClasses = [
    'c-page-header__content',
    'c-page-header__long__content',
    'l-grid-wrap',
    'l-grid-wrap--5-of-7',
    'u-shift--left--1-col--at-xxlarge'
  ];

  if (@isset($headerBackgroundImage)) {
    $headerClasses[] = 'o-background-image';
    $headerClasses[] = 'u-background--cover';
    $headerClasses[] = 'has-background';
    $headerInnerClasses[] = 'u-gradient--bottom';
    $headerContentClasses[] = 'u-border-left--white--at-large';
  }
@endphp

@if (@isset($headerBackgroundImage))
  <style type="text/css">
    .o-background-image {
      background-image: url({{ wp_get_attachment_image_url($headerBackgroundImage, 'featured__hero--m') }});
    }
    @media (min-width: 900px) {
      .o-background-image {
        background-image: url({{ wp_get_attachment_image_url($headerBackgroundImage, 'featured__hero--l') }});
      }
    }
    @media (min-width: 1100px) {
      .o-background-image {
        background-image: url({{ wp_get_attachment_image_url($headerBackgroundImage, 'featured__hero--xl') }});
      }
    }
  </style>
@endif

<header class="{{ join(' ', $headerClasses) }}">
  <div class="{{ join(' ', $headerInnerClasses) }}">
    <div class="{{ join(' ', $headerContentClasses) }}">
      @if (@isset($headerKicker))
        <span class="o-kicker u-color--white">{{ $headerKicker }}</span>
      @endif
      <h1 class="u-font--primary--xl u-color--white u-font-weight--bold">
        {!! $headerTitle !!}
      </h1>
    </div>
  </div>
</header>

@if (@isset($GLOBALS["headerSubtitle"]))
  <div class="c-page-header__subtitle c-page-header__long__subtitle l-grid l-grid--7-col u-space--top--zero">
    <div class="l-grid-wrap l-grid-wrap--5-of-7 u-shift--left--1-col--at-medium u-border--left u-font--secondary--m">
      {{ $headerSubtitle }}
    </div>
  </div>
@endif
