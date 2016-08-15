<?php 

	get_header(); 

?>

	<div class="container">

		<div id="title">

			<h1><?= the_title(); ?></h1>

			<h3><?= get_post_meta($post->ID, 'adventist_bx_page_description', true); ?></h3>

		</div> <!-- End #title -->

		<div id="content">
			<?php if (is_active_sidebar('blog-sidebar')) { ?>
				<div class="two-thirds-<?= inverse_position(get_option('blog-sidebar-position')) ?>">
			<?php } else { ?>
				<div class="block">
			<?php } ?>

				<?php get_search_form(); ?>



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