<?php 

	get_header(); 

	if ( have_posts() ) the_post();

?>



<div class="container">

	<div id="title">

			<h1><?= the_title(); ?></h1>

			<h3><?= get_post_meta($post->ID, 'adventist_bx_page_description', true); ?></h3>

	</div> <!-- End #title -->



	<ul id="mobile-sub-nav">

		<?php get_template_part('templates/subnav-pages') ?>

	</ul>

	<div id="content">
		<?php if (is_active_sidebar('pages-sidebar')) { ?>
			<div class="two-thirds-<?= inverse_position(get_option('page-sidebar-position')) ?>">
		<?php } else { ?>
			<div class="block">
		<?php } ?>

			<?= the_content() ?>

		</div> <!-- End .two-thirds-left -->

		<?php if (is_active_sidebar('pages-sidebar')) { ?>
			<div class="third-<?= get_option('page-sidebar-position') ?>">

				<?php dynamic_sidebar('pages-sidebar'); ?>

			</div> <!-- End .third-right -->
		<?php } ?>
	</div> <!-- End .content -->



<?php get_footer(); ?>