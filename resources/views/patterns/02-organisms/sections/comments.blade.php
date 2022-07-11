@php
if (post_password_required()) {
  return;
}

class ALPS_Walker_Comment extends Walker_Comment {
    public function __construct() {
        add_filter('comment_reply_link', function ($link) {
            return str_replace('class=\'comment-reply-link\'', 'class=\'comment-reply-link u-font--secondary--s u-theme--color--base\'', $link);
        });
    }

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
		    $GLOBALS['comment_depth'] = $depth + 1;
        $output .= '<ul class="c-comment__children__list children u-spacing">';
		}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {
		    $GLOBALS['comment_depth'] = $depth + 1;
		    $output .= '</ul>';
	  }

    protected function html5_comment($comment, $depth, $args) {
        $authorLink = get_comment_author_link($comment);
        $createdAt = sprintf( __( '%1$s at %2$s', 'alps' ), get_comment_date( '', $comment ), get_comment_time() );

        ob_start();
        comment_text($comment->comment_ID);
        $content = ob_get_clean();

        $avatar = get_avatar($comment, 50, 'mm', '', ['class' => 'avatar']);

        ob_start();
        edit_comment_link( '(' . __( 'Edit', 'alps' ) . ')', '<span class="c-comment__edit-link u-font--secondary--s u-theme--color--base">', '</span>' );
        $editLink = ob_get_clean();

        $replyOpts = [
            'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="c-comment__reply">',
						'after'     => '</div>',
        ];
        $replyLink = get_comment_reply_link(array_merge($args, $replyOpts), $comment);

        if ($depth <= 1) {
            $listItemClass = 'c-comment__list-item';
        } else if ($depth > 1 && $depth < 5) {
            $listItemClass = 'c-comment__children__list-item c-comment__children__list-item__depth-' . $depth;
        } else {
            $listItemClass = 'c-comment__children__list-item c-comment__children__list-item__depth-5';
        }

        echo <<<HTML
<li class="$listItemClass comment u-spacing" id="comment-$comment->comment_ID">
  <div class="c-comment--inner u-border--left u-theme--border-color--darker" id="div-comment-$comment->comment_ID">
    <div class="c-comment__avatar u-space--right">
      $avatar
    </div>
    <div class="c-comment__body u-spacing--quarter">
      <div class="c-comment__meta">
        <span class="byline u-font--secondary--s can-be--white u-theme--color--darker">$authorLink</span>
        <span class="o-divider">|</span>
        <span class="pub_date u-font--secondary--s u-color--gray can-be--white">$createdAt</span>
        $editLink
      </div>
      <p class="c-comment__content">$content</p>
      $replyLink
    </div>
  </div>
</li>
HTML;
    }
}
$walker = new ALPS_Walker_Comment();

ob_start();
comments_template( '', true);
ob_end_clean();

$customCommentTemplate = apply_filters('comments_template', 'alps.php');
if ($customCommentTemplate !== 'alps.php') {
    if (file_exists($customCommentTemplate)) {
        require $customCommentTemplate;
    }
}

@endphp

@if ($customCommentTemplate === 'alps.php')
<section class="c-comments u-spacing--double">
  @if (have_comments())
    <ul class="c-comment__list u-spacing">
      <div class="c-block__heading u-theme--border-color--darker">
        <h3 class="c-block__heading-title u-theme--color--darker">{{ get_comments_number() }} comments</h3>
      </div>
      {!! wp_list_comments(['style' => 'ol', 'short_ping' => true, 'walker' => $walker]) !!}
    </ul>
  @endif
  @php
    comment_form([
      'title_reply_before' => '<h3 class="u-font--secondary--m comment-reply-title u-theme--color--darker">',
      'title_reply_after' => '</h3>',
      'logged_in_as' => '',
      'title_reply' => __("Leave a Comment", "alps"),
      'label_submit' => __('Submit', "sage"),
      'class_form' => 'u-spacing'
    ]);
  @endphp
</section>
@endif
