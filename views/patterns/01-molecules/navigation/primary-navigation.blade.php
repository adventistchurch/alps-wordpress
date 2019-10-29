<<<<<<< HEAD
@if ( has_nav_menu( 'primary_navigation' ) )
=======
@if (has_nav_menu('primary_navigation'))

>>>>>>> 22d623d9487eeedf00a9b183efc2a9edce6f489a
  <nav class="c-primary-nav c-priority-nav" role="navigation">
    <ul class="c-primary-nav__list c-priority-nav__list">
    @php
      $menu_locations = get_nav_menu_locations();
<<<<<<< HEAD
      $menu           = wp_get_nav_menu_object( $menu_locations[ 'primary_navigation' ] );
      $nav_items      = wp_get_nav_menu_items( $menu->term_id );
      $parent_level   = array_filter( $nav_items, function( $item ) { return $item->menu_item_parent == 0; } );
    @endphp
    @foreach ( $parent_level as $parent => $nav )
      @php
        $show_subnav  = '';
        $has_subnav   = array_search( $nav->ID, array_column( $nav_items, 'menu_item_parent' ) );
        if ( $has_subnav ) $show_subnav = ' has-subnav';
      @endphp
       <li class="c-primary-nav__list-item{{ $show_subnav }}">
          <a href="{{ $nav->url }}" class="c-primary-nav__link u-font--primary-nav u-color--gray--dark u-theme--link-hover--base u-theme--border-color--base">{{ $nav->title }}</a>
      @if ( $has_subnav )
        @php
          $parentID = $nav->ID;
          $sub_items = array_filter( $nav_items, function( $item ) use ( $parentID ) { return $item->menu_item_parent == $parentID; } );
        @endphp
        <span class="c-primary-nav__arrow c-subnav__arrow o-arrow--down u-path-fill--gray"></span>
        <ul class="c-primary-nav__subnav c-subnav">
          @foreach ( $sub_items as $sub_item => $sub )
            @php
              $show_sub_subnav  = '';
              $has_sub_subnav   = array_search( $sub->ID, array_column( $nav_items, 'menu_item_parent' ) );
              if ( $has_sub_subnav ) $show_sub_subnav = ' has-subnav js-this';
            @endphp
            <li class="c-primary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light u-theme--border-color--dark{{ $show_sub_subnav }}">
              <a class="c-primary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base" href="{{ $sub->url }}">{{ $sub->title }}</a>
              @if ( $has_sub_subnav )
                <span class="c-primary-nav__subnav__arrow c-subnav__arrow o-arrow--down u-path-fill--gray js-toggle" data-toggled="this" data-prefix="this"></span>
                <ul class="c-primary-nav__subnav__subnav c-subnav">
                  @php
                    $parentID = $sub->ID;
                    $sub_subitems = array_filter( $nav_items, function( $item ) use ( $parentID ) { return $item->menu_item_parent == $parentID; } );
                  @endphp
                  @foreach ( $sub_subitems as $sub_subitem => $sub_item )
                    <li class="c-primary-nav__subnav__subnav__list-item c-subnav__list-item u-theme--background-color--base">
                      <a class="c-primary-nav__subnav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--lighter" href="{{ $sub_item->url }}">{{ $sub_item->title }}</a>
                    </li>
                  @endforeach
                </ul>
              @endif
=======
      $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
      $primary_nav = wp_get_nav_menu_items( $menu->term_id );

      $count = 0;
      $submenu = false;
    @endphp
    <ul class="c-primary-nav__list c-priority-nav__list">
      @php $primary_nav = json_decode(json_encode($primary_nav), true); @endphp
      @foreach ($primary_nav as $nav)
        @php
          $link_url = $nav['url'];
          $link_text = $nav['title'];
          $link_classes = ($nav['classes'] ? ' ' . implode(' ', $nav['classes']) : '');
          $link_target = ($nav['target'] ? ' target="'. $nav['target'] . '"' : '');
          $link_title = ($nav['attr_title'] ? ' title="'. $nav['attr_title'] . '"' : '');
          $link_description = ($nav['description'] ? ' description="' . $nav['description'] . '"' : '');
          $link_rel = ($nav['xfn'] ? ' rel="'. $nav['xfn'] . '"' : '');
        @endphp
        @if (isset($primary_nav[$count + 1]))
          @php
            $parent = $primary_nav[$count + 1]['menu_item_parent'];
          @endphp
        @endif
        @if (!$nav['menu_item_parent'])
          @php $parent_id = $nav['ID']; @endphp
          <li class="c-primary-nav__list-item has-subnav">
            <a href="{{ $link_url }}" class="c-primary-nav__link u-font--primary-nav u-color--gray--dark u-theme--link-hover--base u-theme--border-color--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{{ $link_text }}</a>
        @endif
        @if ($parent_id == $nav['menu_item_parent'])
          @if (!$submenu)
            @php $submenu = true; @endphp
            <span class="c-subnav__arrow o-arrow--down u-path-fill--gray"></span>
            <ul class="c-primary-nav__subnav c-subnav">
          @endif
            <li class="c-primary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light">
              <a href="{{ $link_url }}" class="c-primary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{{ $link_text }}</a>
>>>>>>> 22d623d9487eeedf00a9b183efc2a9edce6f489a
            </li>
          @endforeach
        </ul>
      @endif
      </li>
    @endforeach
    </ul>
  </nav>
@endif
