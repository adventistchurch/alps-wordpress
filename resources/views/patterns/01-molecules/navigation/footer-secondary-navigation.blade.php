@if (has_nav_menu('footer_secondary_navigation'))
  <nav class="c-footer__secondary-nav__list u-spacing--half">
    @php
      $menu_name = 'footer_secondary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object($menu_locations[ $menu_name ]);
      $footer_secondary_nav = wp_get_nav_menu_items($menu->term_id);
      $footer_secondary_nav = json_decode(json_encode($footer_secondary_nav), true);
    @endphp
    @foreach ($footer_secondary_nav as $nav)
      @php
        $link_url = $nav['url'];
        $link_text = $nav['title'];
        $link_classes = ($nav['classes'] ? ' ' . implode(' ', $nav['classes']) : '');
        $link_target = ($nav['target'] ? ' target="'. $nav['target'] . '"' : '');
        $link_title = ($nav['attr_title'] ? ' title="'. $nav['attr_title'] . '"' : '');
        $link_description = ($nav['description'] ? ' description="' . $nav['description'] . '"' : '');
        $link_rel = ($nav['xfn'] ? ' rel="'. $nav['xfn'] . '"' : '');
      @endphp
      <a href="{{ $link_url }}" class="c-footer__secondary-nav__link u-theme--link-hover--light u-link--white{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>
        <span class="u-icon u-icon--xs u-path-fill--white u-space--half--right">@include('patterns.00-atoms.icons.icon-legal')</span><font>{!! $link_text !!}</font>
      </a>
    @endforeach
    {!! wp_reset_postdata() !!}
  </nav> <!-- /.c-footer__secondary-nav -->
@endif
