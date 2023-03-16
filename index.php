<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  $theme_color = get_alps_option('theme_color');
  ?>

  <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon<?php if ($theme_color): echo '--' . $theme_color; endif; ?>.png">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-sans/NotoSans-Italic.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-sans/NotoSans-Regular.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-sans/NotoSans-Bold.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-sans/NotoSans-BoldItalic.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-serif/NotoSerif-Italic.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-serif/NotoSerif-Regular.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-serif/NotoSerif-BoldItalic.ttf">
  <link rel="application/font-sfnt" href="<?php bloginfo('template_directory'); ?>/assets/fonts/noto-serif/NotoSerif-Italic.ttf">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action('get_header'); ?>

<div id="app">
  <?php echo view(app('sage.view'), app('sage.data'))->render(); ?>
</div>

<?php do_action('get_footer'); ?>
</body>
</html>
