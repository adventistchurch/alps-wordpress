@php
  $theme_color = get_alps_option('theme_color');
  $alpsVersion = \App\Core\ALPSVersions::get();

  $stylesUrl = $alpsVersion['styles']['main'];
  if ($theme_color && isset($alpsVersion['styles']['themes'][$theme_color])) {
      $stylesUrl = $alpsVersion['styles']['themes'][$theme_color];
  }
@endphp
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @php wp_head() @endphp

  @php
    $schemamarkup = get_post_meta(get_the_ID(), 'schemamarkup', true);
    if(!empty($schemamarkup)) {
      echo $schemamarkup;
    }
  @endphp

  <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon<?php if ($theme_color): echo '--' . $theme_color; endif; ?>.png">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-sans/NotoSans-Italic.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-sans/NotoSans-Regular.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-sans/NotoSans-Bold.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-sans/NotoSans-BoldItalic.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-serif/NotoSerif-Italic.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-serif/NotoSerif-Regular.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-serif/NotoSerif-BoldItalic.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-serif/NotoSerif-Italic.ttf">
  <link rel="stylesheet" type="text/css" href="{{ $stylesUrl }}" media="all">
  <script src="{{ $alpsVersion['scripts']['head'] }}" type="text/javascript" async></script>
</head>
