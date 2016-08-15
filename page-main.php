<?php get_header(); ?>

	<div class="container">



		<?php

			if (get_option('slider_option_visible') == "true") {

				get_template_part('templates/slider', get_option('slider_option'));

			}



			if (get_option('home-callout-visible') == "true") {

				get_template_part('templates/home-callout'); 

			}

		?>



		<div id="content">
			<?php if (is_active_sidebar('main-sidebar')) { ?>
				<div class="two-thirds-right">
			<?php } else { ?>
				<div class="block">
			<?php } ?>

				<h3 class="divider"><?= __("From the Blog", "adventist") ?></h3>



				<?php 

					$args = array(

						'posts_per_page' => 4,

						'paged' => 1,

						'order'=> 'DESC', 

						'orderby' => 'post_date',

						);

					query_posts( $args );



					get_template_part('templates/posts', 'list');



					wp_reset_postdata();

				?>



				<a href="<?= get_permalink(get_page_by_title('Blog') -> ID) ?>" class="btn"><?= __("View all blog entries", "adventist") ?></a>

			</div> <!-- End .two-thirds-left -->
			<?php if (is_active_sidebar('main-sidebar')) { ?>
				<div class="third-left">

					<!-- <div id="big-links" class="block">

						<a href="<?= get_option('watch-link') ?>" id="ico-eye" class="big-link"><strong><?= __("Watch", "adventist") ?></strong><?= __("our weekly services live", "adventist") ?></a>

						<a href="<?= get_option('signup-link') ?>" id="ico-email" class="big-link"><strong><?= __("Sign up", "adventist") ?></strong><?= __("for our email newsletter", "adventist") ?></a>

						<a href="<?= get_option('subscribe-link') ?>" id="ico-mic" class="big-link"><strong><?= __("Subscribe", "adventist") ?></strong><?= __("to the Simple Truths Podcast", "adventist") ?></a>

					</div> -->

					<?php dynamic_sidebar('main-sidebar'); ?>

				</div>
			<?php } ?>

		</div> <!-- End .content -->

<?php get_footer(); ?>