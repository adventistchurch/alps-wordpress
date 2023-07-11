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

  $remove_spacing = get_post_meta($post->ID, '_remove_spacing', true);
  if ($remove_spacing){
    $main_classes = 'l-main';
  }else{
    $main_classes = 'l-main u-spacing--double u-padding--double--bottom';
  }

  $template = get_post_meta($post->ID, '_wp_page_template', true);
  if ($template == 'template-custom.blade.php'){
    $theme_color_class.= ' template-custom';
  }
@endphp
<html class="{{ $theme_color_class }}" {{ language_attributes() }}>
  @include('patterns.02-organisms.global.head')
  <body @php body_class() @endphp>
    <div class="l-wrap">
      <div class="l-wrap__content l-content" role="document">
        @php do_action('get_header') @endphp
        @include('patterns.02-organisms.global.header')
        <main class="{{ $main_classes }}" role="main">
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
