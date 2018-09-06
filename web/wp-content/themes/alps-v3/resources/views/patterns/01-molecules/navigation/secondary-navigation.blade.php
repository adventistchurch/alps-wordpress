<nav class="c-secondary-nav" role="navigation">
  @if (has_nav_menu('secondary_navigation'))
    @php
      $menu_name = 'secondary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
      $secondary_nav = wp_get_nav_menu_items( $menu->term_id);
      $count = 0;
      $submenu = false;
    @endphp
    <ul class="c-secondary-nav__list">
      @php
        $languages = apply_filters('wpml_active_languages', NULL);
      @endphp
      @if (!empty($languages))
        <li class="c-secondary-nav__list-item c-secondary-nav__list-item__language c-secondary-nav__list-item__toggle is-priority">
          <select class="u-font--secondary-nav u-color--gray">
          <option value="language">Language</option>
          @foreach ($languages as $language)
            <option value="{{ $language['code'] }}">{{ $language['translated_name'] }}</option>
          @endforeach
          </select>
        </li>
      @endif
      @php
        $secondary_nav = json_decode(json_encode($secondary_nav), true);
      @endphp
      @foreach ($secondary_nav as $nav)
        @if (isset($secondary_nav[$count + 1]))
          @php
            $parent = $secondary_nav[$count + 1]['menu_item_parent'];
          @endphp
        @endif
        @if (!$nav['menu_item_parent'])
          @php $parent_id = $nav['ID']; @endphp
          <li class="c-secondary-nav__list-item has-subnav @if ($nav['classes']){{ $nav['classes']}}@endif">
            <a href="{{ $nav['url'] }}" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base">
              @if ($nav['attr_title'])<span class="u-icon u-icon--xs u-path-fill--gray">@include('patterns.00-atoms.icons.icon-' . $nav['attr_title'] )</span>@endif
              {{ $nav['title'] }}
            </a>
        @endif
        @if ($parent_id == $nav['menu_item_parent'])
          @if (!$submenu)
            @php $submenu = true; @endphp
            <ul class="c-secondary-nav__subnav c-subnav">
          @endif
            <li class="c-secondary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light">
              <a class="c-secondary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base" href="{{ $nav['url'] }}">{{ $nav['title'] }}</a>
            </li>
            @if ($parent != $parent_id && $submenu)
              </ul> <!-- /.c-secondary-nav__subnav -->
              @php $submenu = false; @endphp
            @endif
        @endif
        @if ($parent != $parent_id)
          </li>
          @php $submenu = false; @endphp
        @endif
        @php $count++; @endphp
      @endforeach
      {!! wp_reset_postdata() !!}
    @endif
    <li class="c-secondary-nav__list-item c-secondary-nav__list-item__search c-secondary-nav__list-item__toggle js-toggle-menu js-toggle-search is-priority">
      <a href="#" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base">
        <span class="u-icon u-icon--xs u-path-fill--gray">@include('patterns.00-atoms.icons.icon-search')</span>Search
      </a>
    </li>
    <li class="c-secondary-nav__list-item c-secondary-nav__list-item__menu c-secondary-nav__list-item__toggle js-toggle-menu is-priority">
      <a href="#" class="c-secondary-nav__link u-font--secondary-nav u-color--gray u-theme--link-hover--base">
        <span class="u-icon u-icon--xs u-path-fill--gray">@include('patterns.00-atoms.icons.icon-menu')</span>Menu
      </a>
    </li>
  </ul> <!-- /.c-secondary-nav__list -->
</nav> <!-- /.c-secondary-nav -->
