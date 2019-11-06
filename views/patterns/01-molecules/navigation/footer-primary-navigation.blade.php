@if (has_nav_menu('footer_primary_navigation'))
  <nav class="c-footer__primary-nav__list u-spacing--half">
    @php
      $menu_name = 'footer_primary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object($menu_locations[ $menu_name ]);
      $footer_primary_nav = wp_get_nav_menu_items($menu->term_id);
      $footer_primary_nav = json_decode(json_encode($footer_primary_nav), true);
    @endphp
    @foreach ($footer_primary_nav as $nav)
      @php
        $link_url = $nav['url'];
        $link_text = $nav['title'];
        $link_classes = ($nav['classes'] ? ' ' . implode(' ', $nav['classes']) : '');
        $link_target = ($nav['target'] ? ' target="'. $nav['target'] . '"' : '');
        $link_title = ($nav['attr_title'] ? ' title="'. $nav['attr_title'] . '"' : '');
        $link_description = ($nav['description'] ? ' description="' . $nav['description'] . '"' : '');
        $link_rel = ($nav['xfn'] ? ' rel="'. $nav['xfn'] . '"' : '');
      @endphp
      <a href="{{ $link_url }}" class="c-footer__primary-nav__link u-theme--link-hover--light u-link--white{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}><strong>{!! $link_text !!}</strong></a>
    @endforeach
    {!! wp_reset_postdata() !!}
  </nav> <!-- /.c-footer__primary-nav -->
@endif
