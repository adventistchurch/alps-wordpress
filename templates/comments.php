<?php
if (post_password_required()) {
  return;
}
?>
<hr>
<section id="comments" class="comments spacing padding-bottom">
  <?php if (have_comments()) : ?>
    <h2 class="font--tertiary--l theme--primary-text-color"><?php printf(_nx('One comment', '%1$s comments', get_comments_number(), 'comments', 'sage'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>'); ?></h2>
    <hr>
    <?php $comments = get_comments(); ?>
    <?php foreach($comments as $comment): ?>
      <div class="comment">
        <div class="comment__avatar">
          <?php echo get_avatar($comment, 32 ); ?>
        </div>
        <div class="comment__body">
          <div class="comment__meta">
            <span class="byline font--secondary--s gray can-be--white"><?php comment_author($comment->ID); ?></span>
            <span class="divider">|</span>
            <span class="pub_date font--secondary--s gray can-be--white"><?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')) . ' ago'; ?></span>
          </div>
          <p class="comment__content"><?php	echo $comment->comment_content; ?></p>
        </div>
      </div>
    <?php endforeach; ?>
    <hr>
  <?php endif; // have_comments() ?>

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Comments are closed.', 'sage'); ?>
    </div>
  <?php endif; ?>
  <div class="comment__form text">
    <?php comment_form(); ?>
  </div>
</section>
