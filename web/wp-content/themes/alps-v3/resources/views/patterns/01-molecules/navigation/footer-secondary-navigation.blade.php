@if (has_nav_menu('footer_secondary_navigation'))
  <nav class="c-footer__secondary-nav__list u-spacing--half">
    @php
      $menu_name = 'footer_secondary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
      $footer_secondary_nav = wp_get_nav_menu_items( $menu->term_id);
      $footer_secondary_nav = json_decode(json_encode($footer_secondary_nav), true);
    @endphp
    @foreach ($footer_secondary_nav as $nav)
      <a href="{{ $nav['url'] }}" class="c-footer__secondary-nav__link u-theme--link-hover--light u-link--white">
        <span class="u-icon u-icon--xs u-path-fill--white u-space--half--right">@include('patterns.00-atoms.icons.icon-legal')</span><font>{{ $nav['title'] }}</font>
      </a>
    @endforeach
    @php(wp_reset_postdata())
  </nav> <!-- /.c-footer__secondary-nav -->
@endif
