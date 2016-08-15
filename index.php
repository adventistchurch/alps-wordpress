<?php get_header(); ?>

	<div class="container">

		<div id="title">

			<h1><?= __("Blog", "adventist") ?></h1>

		</div> <!-- End #title -->

		<div id="content">

			<?php if (is_active_sidebar('blog-sidebar')) { ?>
				<div class="two-thirds-<?= inverse_position(get_option('blog-sidebar-position')) ?>">
			<?php } else { ?>
				<div class="block">
			<?php } ?>

				<?php if ($paged < 2) { 

					$cat_id = get_option('featured_category'); //the certain category ID

					$latest_cat_post = new WP_Query( array('posts_per_page' => 1, 'category__in' => array($cat_id)));

					while( $latest_cat_post->have_posts() ) : $latest_cat_post->the_post();  ?> 

						<div id="featured-post" class="post">

							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

							<h6><?= get_the_date() ?>   •   <?= __("By", "adventist") ?> <?php the_author_posts_link(); ?> • <?= __("in", "adventist") ?> <?= the_category(', ') ?></h6>

							<p><?= get_the_excerpt() ?> <a href="<?= the_permalink(); ?>" class="read-more"><?= __("Read more", "adventist") ?></a></p>

						</div>

				<?php 

					endwhile;

				} ?>



				<h3 class="divider"><?= __("Recent entries", "adventist") ?></h3>



				<?php get_template_part('templates/posts', 'list'); ?>



				<div class="navigation"><p><?php posts_nav_link(); ?></p></div>

			</div> <!-- End .two-thirds-left -->

			<?php if (is_active_sidebar('blog-sidebar')) { ?>
				<div class="third-<?= get_option('blog-sidebar-position') ?>">

					<?php dynamic_sidebar('blog-sidebar'); ?>

				</div> <!-- End .third-right -->
			<?php } ?>
		</div> <!-- End .content -->



<?php get_footer(); ?>