@if (has_nav_menu('footer_primary_navigation'))
  <nav class="c-footer__primary-nav__list u-spacing--half">
    @php
      $menu_name = 'footer_primary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
      $footer_primary_nav = wp_get_nav_menu_items( $menu->term_id);
      $footer_primary_nav = json_decode(json_encode($footer_primary_nav), true);
    @endphp
    @foreach ($footer_primary_nav as $nav)
      <a href="{{ $nav['url'] }}" class="c-footer__primary-nav__link u-theme--link-hover--light u-link--white"><strong>{{ $nav['title'] }}</strong></a>
    @endforeach
    @php(wp_reset_postdata())
  </nav> <!-- /.c-footer__primary-nav -->
@endif
