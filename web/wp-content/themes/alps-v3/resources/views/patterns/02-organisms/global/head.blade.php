@php
  $theme_options = get_option('alps_theme_settings');
  $theme_color = $theme_options['theme_color'];
@endphp
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @php(wp_head())
  <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon<?php if ($theme_color): echo '--' . $theme_color; endif; ?>.png">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i|Noto+Serif:400,400i,700,700i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.adventist.org/alps/3/latest/css/main.css" media="all">
  <script src="//cdn.adventist.org/alps/3/latest/js/head-script.min.js" type="text/javascript"></script>
</head>
