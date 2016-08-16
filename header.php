<!doctype html>

<html id="home" lang="en">

<head>

	<meta charset="utf-8">

	<title><?php bloginfo( 'name' ); ?> <?php wp_title( '|' ); ?></title>

	<meta name="description" content="">

	<meta name="HandheldFriendly" content="True" />

	<meta name="lOptimized" content="width" />

	<meta http-equiv="cleartype" content="on" />

	<meta name="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1,user-scalable=yes">

	<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/-/css/style.css">

	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>

		<script>document.createElement("nav");document.createElement("footer");document.createElement("header");</script>

		<script src="<?= get_template_directory_uri(); ?>/-/js/respond.min.js"></script>

	<![endif]-->

		<style>

			header h1 a {

				background: url(<?= get_template_directory_uri(), "/", __("-/img/logos/logo.png", "adventist") ?>) no-repeat top left;

			}

		</style>
	<?= wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="menu-<?= get_option('menu-position') ?>">

		<h1><a href="<?= site_url() ?>"><?php bloginfo( 'name' ); ?></a></h1>

		<h2><strong><?= get_option('title_name') ?></strong> <?= get_option('title_desc') ?></h2>

		<a href="#" id="mobile-menu">Menu</a>



		<?php wp_nav_menu( array( 

				'theme_location' => 'header-menu',

				'items_wrap' => '<nav>%3$s</nav>',

				'container' => '',

				'walker' => new adventist_custom_menu

				 ) ); ?>



		<form id="site-search" method="get" action="<?= site_url() ?>">

			<?php if (get_option("twitter_acc") != "") { ?>
				<a href="<?= get_option("twitter_acc") ?>" id="ico-twitter"><?= __("Twitter", "adventist") ?></a>
			<?php } ?>

			<?php if (get_option("facebook_acc") != "") { ?>
				<a href="<?= get_option("facebook_acc") ?>" id="ico-facebook"><?= __("Facebook", "adventist") ?></a>
			<?php } ?>

			<?php if (get_option("rss_acc") != "") { ?>
				<a href="<?= get_option("rss_acc") ?>" id="ico-rss"><?= __("RSS", "adventist") ?></a>
			<?php } ?>

			<input type="text" id="search" name="s"/>

		</form>

	</header>