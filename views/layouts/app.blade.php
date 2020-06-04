<!doctype html>
@php
  // Add class if theme color is selected
  $theme_color = get_alps_option('theme_color');
  if ($theme_color) {
    $theme_color_class = 'u-theme--' . $theme_color;
  } else {
    $theme_color_class = 'u-theme--ming';
  }

  if (is_singular()) {
      wp_enqueue_script('comment-reply');
  }
@endphp
<html class="{{ $theme_color_class }}" {{ get_language_attributes() }}>
  @include('patterns.02-organisms.global.head')
  <body @php body_class() @endphp>
    <div class="l-wrap">
      <div class="l-wrap__content l-content" role="document">
        @php do_action('get_header') @endphp
        @include('patterns.02-organisms.global.header')
        <main class="l-main u-spacing--double u-padding--double--bottom" role="main">
          @yield('content')
        </main> <!-- /.l-main -->
        @php do_action('get_footer') @endphp
        @include('patterns.02-organisms.global.footer')
        @php wp_footer() @endphp
      </div> <!-- /.l-content -->
      @include('patterns.02-organisms.asides.sabbath')
    </div><!-- ./l-wrap -->
  </body>
</html>
