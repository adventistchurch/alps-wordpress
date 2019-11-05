  @if ( has_nav_menu( 'primary_navigation' ) )
    <nav class="c-primary-nav c-priority-nav" role="navigation">
      <ul class="c-primary-nav__list c-priority-nav__list">
      @php
      $menu_locations = get_nav_menu_locations();
      $menu           = wp_get_nav_menu_object( $menu_locations[ 'primary_navigation' ] );
      $nav_items      = wp_get_nav_menu_items( $menu->term_id );
      $parent_level   = array_filter( $nav_items, function( $item ) { return $item->menu_item_parent == 0; } );
      @endphp
      @foreach ( $parent_level as $parent => $nav )
        @php
          $show_subnav  = '';
          $has_subnav   = array_search( $nav->ID, array_column( $nav_items, 'menu_item_parent' ) );
          if ( $has_subnav ) $show_subnav = 'has-subnav';
        @endphp
         <li class="c-primary-nav__list-item {{ $show_subnav }}">
            <a href="{{ $nav->url }}" class="c-primary-nav__link u-font--primary-nav u-color--gray--dark u-theme--link-hover--base u-theme--border-color--base">{!! $nav->title !!}</a>
        @if ( $has_subnav )
          @php
            $parentID = $nav->ID;
            $sub_items = array_filter( $nav_items, function( $item ) use ( $parentID ) { return $item->menu_item_parent == $parentID; } );
          @endphp
          <span class="c-subnav__arrow o-arrow--down u-path-fill--gray"></span>
          <ul class="c-primary-nav__subnav c-subnav">
          @foreach ( $sub_items as $sub_item => $sub )
            <li class="c-primary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light">
              <a class="c-primary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base" href="{{ $sub->url }}">{!! $sub->title !!}</a>
              @php
                $show_sub_subnav  = '';
                $has_sub_subnav   = array_search( $sub->ID, array_column( $nav_items, 'menu_item_parent' ) );
                if ( $has_sub_subnav ) $show_sub_subnav = 'has-subnav';
              @endphp
              @if ( $has_sub_subnav )
                <ul class="c-primary-nav__subnav c-subnav">
                 @php
                  $parentID = $sub->ID;
                  $sub_subitems = array_filter( $nav_items, function( $item ) use ( $parentID ) { return $item->menu_item_parent == $parentID; } );
                @endphp
                @foreach ( $sub_subitems as $sub_subitem => $sub_item )
                <li class="c-primary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light">
                <a class="c-primary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base" href="{{ $sub_item->url }}">{!! $sub_item->title !!}</a></li>
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
    </nav>
@endif
