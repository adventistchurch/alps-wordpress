<nav class="c-secondary-nav" role="navigation">
  <ul class="c-secondary-nav__list">
    @if (has_nav_menu('secondary_navigation') or apply_filters('wpml_active_languages', NULL, 'skip_missing=0'))
      @if (apply_filters('wpml_active_languages', NULL, 'skip_missing=0') && !get_alps_option('project_alps_languages_hide_selector'))
        @php $languages = icl_get_languages('skip_missing=0'); @endphp
        <li class="c-secondary-nav__list-item c-secondary-nav__list-item__languages has-subnav">
          <a href="" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base"><span class="u-icon u-icon--xs u-path-fill--gray">@include('patterns.00-atoms.icons.icon-language')</span>Languages</a>
          <span class="c-subnav__arrow o-arrow--down u-path-fill--gray"></span>
          <ul class="c-secondary-nav__subnav c-subnav">
            @foreach ($languages as $language)
              <li class="c-secondary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light">
                <a href="{{ $language['url'] }}" class="c-secondary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base">
                  @if ($language['native_name'])
                    {{ icl_disp_language($language['native_name']) }}
                  @endif
                  @if ($language['translated_name'])
                    {{ icl_disp_language(' (' . $language['translated_name'] . ')') }}
                  @endif
                </a>
              </li>
            @endforeach
          </ul>
        </li>
      @endif
      @if (has_nav_menu('secondary_navigation'))
        @php
          $menu_locations = get_nav_menu_locations();
          $menu = wp_get_nav_menu_object($menu_locations[ 'secondary_navigation' ]);
          $nav_items = wp_get_nav_menu_items($menu->term_id);
          $parent_level = array_filter($nav_items, function($item) { if ($item->type != 'wpml_ls_menu_item') {return $item->menu_item_parent == 0;} });
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
          <li class="c-secondary-nav__list-item{{ $show_subnav }}">
            <a href="{{ $link_url }}" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{!! $link_text !!}</a>
            @if ($has_subnav)
              @php
                $parentID = $nav->ID;
                $sub_items = array_filter($nav_items, function($item) use ($parentID) { return $item->menu_item_parent == $parentID; });
              @endphp
              <span class="c-subnav__arrow o-arrow--down u-path-fill--gray"></span>
              <ul class="c-secondary-nav__subnav c-subnav">
                @foreach ($sub_items as $sub_item => $sub)
                  @php
                    $link_url = $sub->url;
                    $link_text = $sub->title;
                    $link_classes = ($sub->classes ? ' ' . implode(' ', $sub->classes) : '');
                    $link_target = ($sub->target ? ' target="'. $sub->target . '"' : '');
                    $link_title = ($sub->attr_title ? ' title="'. $sub->attr_title . '"' : '');
                    $link_description = ($sub->description ? ' description="' . $sub->description . '"' : '');
                    $link_rel = ($sub->xfn ? ' rel="'. $sub->xfn . '"' : '');
                  @endphp
                  <li class="c-secondary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light">
                    <a href="{{ $link_url }}" class="c-secondary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{!! $link_text !!}</a>
                  </li>
                @endforeach
              </ul> <!-- /.c-secondary-nav__subnav -->
            @endif
          </li>
        @endforeach
      @endif
    @endif
    <li class="c-secondary-nav__list-item c-secondary-nav__list-item__toggle js-toggle-menu js-toggle-search is-priority">
      <a href="#" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base">
        <span class="u-icon u-icon--xs u-path-fill--gray">@include('patterns.00-atoms.icons.icon-search')</span>{{__('Search', 'alps') }}
      </a>
    </li>
    <li class="c-secondary-nav__list-item c-secondary-nav__list-item__toggle js-toggle-menu is-priority">
      <a href="#" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base">
        <span class="u-icon u-icon--xs u-path-fill--gray">@include('patterns.00-atoms.icons.icon-menu')</span>{{ __('Menu', 'alps') }}
      </a>
    </li>
  </ul> <!-- /.c-secondary-nav__list -->
</nav> <!-- /.c-secondary-nav -->
