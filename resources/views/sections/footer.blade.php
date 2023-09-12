@php
  $hide_sabbath = get_alps_option('sabbath_hide');
  $footer_logo = get_alps_option('footer_logo_icon');
  $footer_logo_type = get_alps_option('footer_logo_type');
  $footer_text = crb_get_i18n_theme_option( 'footer_description' );
    if (empty($footer_text)) {
      if ( empty( get_alps_option('footer_description')['footer_description_en']) ) {
        $footer_text = 'An official website of the Seventh-day Adventist World church.';
      } else {
        $footer_text = get_alps_option('footer_description')['footer_description_en'];
      }
    }
  $footer_copyright = get_alps_option('footer_copyright');

  // CARBON FIELDS STORES COMPLEX FIELDS WITH A MULTIDIMENSIONAL FORMAT
  $footer_address = get_alps_option('footer_address');
  if (!empty($footer_address))  {
    $footer_address_street = $footer_address['footer_address_street'];
    $footer_address_city = $footer_address['footer_address_city'];
    $footer_address_state = $footer_address['footer_address_state'];
    $footer_address_zip = $footer_address['footer_address_zip'];
    $footer_address_country = $footer_address['footer_address_country'];
    $footer_address_phone = $footer_address['footer_phone'];
  }
  else {
    // PIKLIST
    $footer_address_street = get_alps_option('footer_address_street');
    $footer_address_city = get_alps_option('footer_address_city');
    $footer_address_state = get_alps_option('footer_address_state');
    $footer_address_zip = get_alps_option('footer_address_zip');
    $footer_address_country = get_alps_option('footer_address_country');
    $footer_address_phone = get_alps_option('footer_phone');
  }

  $alpsVersion = \App\Core\ALPSVersions::get();
@endphp
@if (is_active_sidebar('footer-region'))
  <div class="c-footer-widgets u-spacing">
    @php dynamic_sidebar('footer-region') @endphp
  </div>
@endif
<footer class="c-footer u-theme--background-color--primary u-theme--background-color--darker" role="contentinfo">
  <div class="c-footer--inner u-color--white l-grid l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7">
    <div class="l-grid-item l-grid-item--m--3-col c-footer__description">
      <p class="c-footer__description-text u-font--secondary--m">
        {!! $footer_text !!}
      </p>
    </div> <!-- /.c-footer__description -->
    <div class="l-grid-item l-grid-item--m--3-col l-grid-item--l--1-col c-footer__primary-nav">
      @include('patterns.01-molecules.navigation.footer-primary-navigation')
    </div> <!-- /.c-footer__primary-nav -->
    <div class="l-grid-item l-grid-item--m--3-col l-grid-item--l--2-col c-footer__secondary-nav">
      @include('patterns.01-molecules.navigation.footer-secondary-navigation')
    </div> <!-- /.c-footer__secondary-nav -->
    @if ($hide_sabbath == true)
      <div class="l-grid-item--7-col l-grid-item--m--1-col c-footer__logo u-path-fill--white">
        @if ($footer_logo)
          <img class="style-svg" src="{{ wp_get_attachment_url($footer_logo) }}" alt="{{ get_post_meta($footer_logo, '_wp_attachment_image_alt', true) }}">
        @else
          @if ($footer_logo_type == "square")
            @include('patterns.00-atoms.icons.icon-logo-footer-square')
          @else
            @include('patterns.00-atoms.icons.icon-logo-footer')
          @endif
        @endif
      </div> <!-- /.c-footer__logo -->
    @endif
    <div class="l-grid-item l-grid-item--m--3-col c-footer__legal">
      <p class="c-footer__copyright">© {{ date('Y') }}@if ($footer_copyright) {{ $footer_copyright }} @endif</p>
      <address class="c-footer__address" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
        @if ($footer_address_street)<span itemprop="streetAddress">{{ $footer_address_street }}</span>@endif
        @if ($footer_address_city)<span itemprop="addressLocality">{{ ' ' .  $footer_address_city }}</span>@endif{{ ""
        }}@if ($footer_address_state)<span itemprop="addressRegion">{{ ', ' .  $footer_address_state }}</span>@endif
        @if ($footer_address_zip)<span itemprop="postalCode">{{ ' ' .  $footer_address_zip }}</span>@endif
        {{ $footer_address_country }}
        @if ($footer_address_phone)<a itemprop="telephone" href="tel:{{ $footer_address_phone }}" class="c-footer__phone u-link--white u-theme--link-hover--light">{{ $footer_address_phone }}</a>@endif
      </address>
    </div> <!-- /.c-footer__legal -->
  </div> <!-- /.c-footer--inner -->
</footer> <!-- /.c-footer -->

<script src="{{ $alpsVersion['scripts']['main'] }}" type="text/javascript" async></script>
