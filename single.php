<?php 

get_header(); 



if (have_posts()) the_post();

?>

	<div class="container">

		<div id="title">

			<h1><?= __("Blog", "adventist") ?></h1>

			<h3><?= get_option('blog-description') ?></h3>

		</div> <!-- End #title -->



		<div id="content">
			<?php if (is_active_sidebar('blog-sidebar')) { ?>
				<div class="two-thirds-<?= inverse_position(get_option('blog-sidebar-position')) ?>">
			<?php } else { ?>
				<div class="block">
			<?php } ?>

				<div id="featured-post" class="post">

					<h3><?= the_title() ?></h3>

					<h6><?= get_the_date() ?>   •   <?= __("By", "adventist") ?> <?php the_author_posts_link(); ?> •   <?= __("in", "adventist") ?> <?= the_category(', ') ?></h6>

					<?= the_content(); ?>

				</div>



				<?php $comments = get_comments( array('post_id' => $post->ID, 'status' => 'approve', 'order' => 'ASC')); ?>

				<h3 class="divider"><?= count($comments) ?> Comments</h3>

				<?php foreach ($comments as $comment) { ?>

					<div class="comment">

						<a href="<?= $comment -> comment_author_url ?>"><?= $comment -> comment_author ?></a> says:

						<p><?= $comment -> comment_content ?></p>
						<p class="comment-details"><?= date_format(date_create($comment -> comment_date), 'F j, Y • g:ia' ) ?></p>

					</div> <!-- End .comment -->


				<?php } ?>
			
				<?php comment_form( array(
						'title_reply' => __('Leave a Reply', 'adventist'),
						'title_reply_to' => __('Leave a Reply to %s', 'adventist'),
						'cancel_reply_link' => __('Cancel Reply', 'adventist'),
						'label_submit' => __('Post Comment', 'adventist')
					) ); ?>



			</div> <!-- End .two-thirds-left -->


			<?php if (is_active_sidebar('blog-sidebar')) { ?>
				<div class="third-<?= get_option('blog-sidebar-position') ?>">

					<?php dynamic_sidebar('blog-sidebar'); ?>

				</div> <!-- End .third-right -->
			<?php } ?>


		</div> <!-- End .content -->

<?php get_footer(); ?>