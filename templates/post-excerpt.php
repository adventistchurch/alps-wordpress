<?php global $post; ?>
<div class="post">
	<h3><a href="<?= the_permalink(); ?>"><?= the_title() ?></a></h3>
	<h6><?= get_the_date() ?>  •   <?= __("By", "adventist") ?> <?php the_author_posts_link(); ?></h6>
	<p><?= get_the_excerpt() ?>   <a href="<?= the_permalink(); ?>" class="read-more"><?= __("Read more", "adventist") ?></a></p>
</div> <!-- End .post -->