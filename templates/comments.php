<?php
if (post_password_required()) {
  return;
}
?>
<hr>
<section id="comments" class="comments padding-bottom">
	<?php if (have_comments()): ?>
    <h2 class="font--tertiary--l theme--primary-text-color"><?php printf(_nx('One comment', '%1$s comments', get_comments_number(), 'comments', 'sage'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>'); ?></h2>
		<?php the_comments_navigation(); ?>
		<ul class="comment-list spacing--one-and-half">
			<?php wp_list_comments('type=comment&callback=alps_comments&max_depth=2&avatar_size=50'); ?>
		</ul>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>
	<?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')):?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'sage'); ?></p>
	<?php endif; ?>
  <div class="comment__form spacing--half">
  	<?php
  		comment_form(
        array(
    			'title_reply_before' => '<h3 class="comment-reply-title font--tertiary--m theme--primary-text-color">',
    			'title_reply_after'  => '</h3>',
          'logged_in_as' => '',
          'title_reply' => __('Leave a Comment', 'sage'),
          'label_submit' => __('Submit', 'sage'),
          'class_form' => 'spacing--half'
    		)
      );
  	?>
  </div>
</section>
