@if (has_nav_menu('primary_navigation'))
  <nav class="c-primary-nav c-priority-nav" role="navigation">
    <ul class="c-primary-nav__list c-priority-nav__list">
      @php
        $menu_locations = get_nav_menu_locations();
        $menu = wp_get_nav_menu_object($menu_locations[ 'primary_navigation' ]);
        $nav_items = wp_get_nav_menu_items($menu->term_id);
        $parent_level = array_filter($nav_items, function($item) { return $item->menu_item_parent == 0; });
      @endphp
      @foreach ($parent_level as $parent => $nav)
        @php
          $link_url = $nav->url;
          $link_text = $nav->title;
          $link_classes = ($nav->classes ? ' ' . implode(' ', $nav->classes) : '');
          $link_target = ($nav->target ? ' target="'. $nav->target . '"' : '');
          $link_title = ($nav->attr_title ? ' title="'. $nav->attr_title . '"' : '');
          $link_description = ($nav->description ? ' description="' . $nav->description . '"' : '');
          $link_rel = ($nav->xfn ? ' rel="'. $nav->xfn . '"' : '');
          $show_subnav = '';
          $has_subnav = array_search($nav->ID, array_column($nav_items, 'menu_item_parent'));
          if ($has_subnav) $show_subnav = ' has-subnav';
        @endphp
        <li class="c-primary-nav__list-item{{ $show_subnav }}">
          <a href="{{ $link_url}}" class="c-primary-nav__link u-font--primary-nav u-color--gray--dark u-theme--link-hover--base u-theme--border-color--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{!! $link_text !!}</a>
          @if ($has_subnav)
            @php
              $parentID = $nav->ID;
              $sub_items = array_filter($nav_items, function($item) use ($parentID) { return $item->menu_item_parent == $parentID; });
            @endphp
            <span class="c-primary-nav__arrow c-subnav__arrow o-arrow--down u-path-fill--gray"></span>
            <ul class="c-primary-nav__subnav c-subnav">
              @foreach ($sub_items as $sub_item => $sub)
                @php
                  $link_url = $sub->url;
                  $link_text = $sub->title;
                  $link_classes = ($sub->classes ? ' ' . implode(' ', $sub->classes) : '');
                  $link_target = ($sub->target ? ' target="'. $sub->target . '"' : '');
                  $link_title = ($sub->attr_title ? ' title="'. $sub->attr_title . '"' : '');
                  $link_description = ($sub->description ? ' description="' . $sub->description . '"' : '');
                  $link_rel = ($sub->xfn ? ' rel="'. $sub->xfn . '"' : '');
                  $show_sub_subnav = '';
                  $has_sub_subnav = array_search($sub->ID, array_column($nav_items, 'menu_item_parent'));
                  if ($has_sub_subnav) $show_sub_subnav = ' has-subnav js-this';
                @endphp
                <li class="c-primary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light u-theme--border-color--dark{{ $show_sub_subnav }}">
                  <a href="{{ $link_url}}" class="c-primary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{!! $link_text !!}</a>
                  @if ($has_sub_subnav)
                    <span class="c-primary-nav__subnav__arrow c-subnav__arrow o-arrow--down u-path-fill--gray js-toggle" data-toggled="this" data-prefix="this"></span>
                    <ul class="c-primary-nav__subnav__subnav c-subnav">
                      @php
                        $parentID = $sub->ID;
                        $sub_subitems = array_filter($nav_items, function($item) use ($parentID) { return $item->menu_item_parent == $parentID; });
                      @endphp
                      @foreach ($sub_subitems as $sub_subitem => $sub_item)
                        @php
                          $link_url = $sub_item->url;
                          $link_text = $sub_item->title;
                          $link_classes = ($sub_item->classes ? ' ' . implode(' ', $sub_item->classes) : '');
                          $link_target = ($sub_item->target ? ' target="'. $sub_item->target . '"' : '');
                          $link_title = ($sub_item->attr_title ? ' title="'. $sub_item->attr_title . '"' : '');
                          $link_description = ($sub_item->description ? ' description="' . $sub_item->description . '"' : '');
                          $link_rel = ($sub_item->xfn ? ' rel="'. $sub_item->xfn . '"' : '');
                          $has_sub_subnav_sub_items = array_search($sub_item->ID, array_column($nav_items, 'menu_item_parent'));
                          $show_sub_subnav_subnav = '';
                          if ($has_sub_subnav_sub_items) $show_sub_subnav_subnav = ' has-subnav ';
                        @endphp
                        <li class="c-primary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light u-theme--border-color--dark{{ $show_sub_subnav_subnav }}">
                          <a href="{{ $link_url}}" class="c-primary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{!! $link_text !!}</a>
                          @if ($has_sub_subnav_sub_items)
                            <span class="c-primary-nav__subnav__arrow c-subnav__arrow o-arrow--down u-path-fill--gray js-toggle" data-toggled="this" data-prefix="this"></span>
                            <ul class="c-primary-nav__subnav__subnav c-subnav">
                              @php
                                $parentID = $sub_item->ID;
                                $sub_subitems_sub = array_filter($nav_items, function($item) use ($parentID) { return $item->menu_item_parent == $parentID; });
                              @endphp
                              @foreach ($sub_subitems_sub as $sub_subitem_sub => $sub_subitem)
                                @php
                                  $link_url = $sub_subitem->url;
                                  $link_text = $sub_subitem->title;
                                  $link_classes = ($sub_subitem->classes ? ' ' . implode(' ', $sub_subitem->classes) : '');
                                  $link_target = ($sub_subitem->target ? ' target="'. $sub_subitem->target . '"' : '');
                                  $link_title = ($sub_subitem->attr_title ? ' title="'. $sub_subitem->attr_title . '"' : '');
                                  $link_description = ($sub_subitem->description ? ' description="' . $sub_subitem->description . '"' : '');
                                  $link_rel = ($sub_subitem->xfn ? ' rel="'. $sub_subitem->xfn . '"' : '');
                                  $has_sub_subnav_sub_items = array_search($sub_subitem->ID, array_column($sub_subitems_sub, 'menu_item_parent'));
                                @endphp
                                <li class="c-primary-nav__subnav__subnav__list-item c-subnav__list-item u-theme--background-color--base">
                                  <a href="{{ $link_url }}" class="c-primary-nav__subnav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--lighter{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{!! $link_text !!}</a>
                                  @endforeach
                                  @endif

                                </li>
                              @endforeach
                            </ul>
                          @endif
                        </li>
                      @endforeach
                    </ul>
                  @endif
                </li>
              @endforeach
            </ul>
  </nav> <!-- /.c-primary-nav -->
@endif
