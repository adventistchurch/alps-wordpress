<?php 

	get_header(); 



	$title = __("Posts from ", "adventist");

	if ( is_author() ) {

		$title .= get_the_author();

	} else if ( is_category() ) {
		$cat123 = get_the_category();
		$cat123 = $cat123[0];
		$title .= $cat123 -> name;

	} else if ( is_date() ) {

		$title .= get_the_date();

	} else {

		$title = __("Recent entries", "adventist");

	}

?>

	<div class="container">

		<div id="title">

			<h1><?= __("Archive", "adventist") ?></h1>

		</div> <!-- End #title -->

		<div id="content">
			<?php if (is_active_sidebar('blog-sidebar')) { ?>
				<div class="two-thirds-<?= inverse_position(get_option('blog-sidebar-position')) ?>">
			<?php } else { ?>
				<div class="block">
			<?php } ?>

				<h3 class="divider"><?= $title ?></h3>



				<?= get_template_part('templates/posts', 'list'); ?>



				<div class="navigation"><p><?php posts_nav_link(); ?></p></div>

			</div> <!-- End .two-thirds-left -->
			<?php if (is_active_sidebar('blog-sidebar')) { ?>
				<div class="third-<?= get_option('blog-sidebar-position') ?>">

					<?php dynamic_sidebar('blog-sidebar'); ?>

				</div> <!-- End .third-right -->
			<?php } ?>

		</div> <!-- End .content -->



<?php get_footer(); ?>