@php
  $site_branding_statement = '';
  $global_branding_statement = '';
  $site_branding_statement = get_alps_option('site_branding_statement');
  $global_branding_statement = get_alps_option('global_branding_statement') ;
@endphp
<div class="c-drawer l-grid l-grid--7-col">
  <div class="c-drawer__toggle js-toggle-parent u-theme--background-color-trans--darker">
    <div class="u-icon o-icon__close">
      <span></span>
      <span></span>
    </div>
  </div> <!-- .c-drawer__toggle -->
  <div class="l-grid-wrap--6-of-7 l-grid-item--s--6-col c-drawer__container u-spacing u-theme--background-color--darker">
    <div class="c-drawer__search">
      @include('patterns.01-molecules.forms.search')
    </div> <!-- .c-drawer__search -->
    <div class="c-drawer__nav">
      <div class="c-drawer__nav-primary">
        @include('patterns.01-molecules.navigation.primary-navigation')
      </div>
      <div class="c-drawer__nav-secondary">
        @include('patterns.01-molecules.navigation.secondary-navigation')
      </div>
    </div> <!-- .c-drawer__nav -->
    <div class="c-drawer__logo">
      <a href="/">
        <span class="u-icon u-icon--l u-path-fill--white">
          @include('patterns.00-atoms.logos.alps-icon-logo')
        </span>
      </a>
    </div> <!-- .c-drawer__logo -->
    <div class="c-drawer__about">
      <div class="c-drawer__about-left u-spacing">
        @if ($site_branding_statement)
          <p>{{ $site_branding_statement }}</p>
        @endif
        @if ($global_branding_statement)
          <p>{{ $global_branding_statement }}</p>
        @endif
      </div>
      @if (has_nav_menu('learn_more_navigation'))
        <div class="c-drawer__about-right u-spacing--half">
          @php
            $menu_slug = 'learn_more_navigation';
            $menu_locations = get_nav_menu_locations();
            $menu = wp_get_nav_menu_object($menu_locations[$menu_slug]);
            $tertiary_nav = wp_get_nav_menu_items($menu->term_id);
            $tertiary_nav = json_decode(json_encode($tertiary_nav), true);
          @endphp
          <div class="u-font--secondary--s u-text-transform--upper"><strong>{{ $menu->name }}:</strong></div>
          <p class="u-spacing--half">
            @foreach ($tertiary_nav as $nav)
              @php
                $link_url = $nav['url'];
                $link_text = $nav['title'];
                $link_classes = ($nav['classes'] ? ' ' . implode(' ', $nav['classes']) : '');
                $link_target = ($nav['target'] ? ' target="'. $nav['target'] . '"' : '');
                $link_title = ($nav['attr_title'] ? ' title="'. $nav['attr_title'] . '"' : '');
                $link_description = ($nav['description'] ? ' description="' . $nav['description'] . '"' : '');
                $link_rel = ($nav['xfn'] ? ' rel="'. $nav['xfn'] . '"' : '');
              @endphp
              <a href="{{ $link_url }}" class="u-link--white{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{{ $link_text }}</a>
            @endforeach
          </p>
          {!! wp_reset_postdata() !!}
        </div>
      @endif
    </div> <!-- .c-drawer__about -->
  </div> <!-- .c-drawer__container -->
</div> <!-- .c-drawer-->
