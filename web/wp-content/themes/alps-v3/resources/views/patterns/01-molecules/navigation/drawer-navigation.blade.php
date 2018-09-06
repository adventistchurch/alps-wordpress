@php
  $theme_options = get_option('alps_theme_settings');
  $site_branding_statement = $theme_options['site_branding_statement'];
  $global_branding_statement = $theme_options['global_branding_statement'];
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
        <ul class="c-drawer__subnav u-theme--background-color--darker">
        </ul>
      </div>
      <div class="c-drawer__nav-secondary">
        @include('patterns.01-molecules.navigation.secondary-navigation')
      </div>
    </div> <!-- .c-drawer__nav -->
    <div class="c-drawer__logo">
      <a href="/">
        <span class="u-icon u-icon--l u-path-fill--white">
          @include('patterns.00-atoms.icons.icon-logo')
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
      <div class="c-drawer__about-right u-spacing--half">
        @if (has_nav_menu('drawer_secondary_navigation'))
          <h3 class="u-font--secondary--s u-text-transform--upper"><strong>Learn More:</strong></h3>
          @php
            $menu_name = 'drawer_secondary_navigation';
            $menu_locations = get_nav_menu_locations();
            $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
            $drawer_secondary_nav = wp_get_nav_menu_items( $menu->term_id);
            $drawer_secondary_nav = json_decode(json_encode($drawer_secondary_nav), true);
          @endphp
          <p class="u-spacing--half">
            @foreach ($drawer_secondary_nav as $nav)
              <a href="{{ $nav['url'] }}" target="_blank" class="u-link--white">{{ $nav['title'] }}</a>
            @endforeach
          </p>
          {!! wp_reset_postdata() !!}
        @endif
      </div>
    </div> <!-- .c-drawer__about -->
  </div> <!-- .c-drawer__container -->
</div> <!-- .c-drawer-->
