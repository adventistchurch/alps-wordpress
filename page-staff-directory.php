<?php get_header(); ?>

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

				<?php

					$pastors = Pastor::all();

					foreach ($pastors as $pastor) { ?>

						<div class="pastor">

							<div class="img">

								<img src="<?= $pastor -> image_url ?>" class="r" />

							</div> <!-- End .img -->

							<div class="details">

								<h2><?= $pastor -> name ?></h2>

								<h5><?= $pastor -> rank ?></h5>

								<h6><?= $pastor -> phone ?>   •   <a href="#"><?= $pastor -> email ?></a></h6>

								<p><?= $pastor -> description ?></p>

							</div> <!-- End .details -->

						</div> <!-- End .pastor -->

				<?php

					}

				?>



			</div> <!-- End .two-thirds-left -->


			<?php if (is_active_sidebar('pages-sidebar')) { ?>
				<div class="third-<?= get_option('page-sidebar-position') ?>">

					<?php dynamic_sidebar('pages-sidebar'); ?>

				</div> <!-- End .third-right -->
			<?php } ?>

		</div> <!-- End .content -->

<?php get_footer(); ?>