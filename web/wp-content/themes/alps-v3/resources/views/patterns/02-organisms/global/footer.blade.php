@php
  $theme_options = get_option('alps_theme_settings');
  $footer_logo = $theme_options['footer_logo_icon'][0];
  $footer_text = $theme_options['footer_description'];
  $footer_copyright = $theme_options['footer_copyright'];
  $footer_address_street = $theme_options['footer_address_street'];
  $footer_address_zip = $theme_options['footer_address_zip'];
  $footer_address_city = $theme_options['footer_address_city'];
  $footer_address_state = $theme_options['footer_address_state'];
  $footer_address_country = $theme_options['footer_address_country'];
  $footer_address_phone = $theme_options['footer_phone'];
@endphp
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
    @if ($footer_logo)
      <div class="l-grid-item--7-col l-grid-item--m--1-col c-footer__logo u-path-fill--white">
        <img class="style-svg" src="{{ wp_get_attachment_url($footer_logo) }}" alt="{{ get_post_meta($footer_logo, '_wp_attachment_image_alt', true) }}">
      </div> <!-- /.c-footer__logo -->
    @endif
    <div class="l-grid-item l-grid-item--m--3-col c-footer__legal">
      <p class="c-footer__copyright">{{ $footer_copyright }}</p>
      <address class="c-footer__address" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
        <span itemprop="streetAddress">{{ $footer_address_street }}</span>,
        <span itemprop="addressPostCode"> {{ $footer_address_zip }}</span>
        <span itemprop="addressLocality"> {{ $footer_address_city }}</span>,
        <span itemprop="addressRegion"> {{ $footer_address_state }}</span>
        {{ $footer_address_country }}
        <a itemprop="telephone" href="tel:{{ $footer_address_phone }}" class="c-footer__phone u-link--white u-theme--link-hover--light">{{ $footer_address_phone }}</a>
      </address>
    </div> <!-- /.c-footer__legal -->
  </div> <!-- /.c-footer--inner -->
</footer> <!-- /.c-footer -->

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="//cdn.adventist.org/alps/3/latest/js/script.min.js" type="text/javascript"></script>
