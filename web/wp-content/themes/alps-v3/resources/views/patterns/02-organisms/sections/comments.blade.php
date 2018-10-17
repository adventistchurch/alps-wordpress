@php
if (post_password_required()) {
  return;
}
@endphp
<section id="comments" class="c-comments js-this can-be--dark-dark u-background-color--gray--light u-border--left u-theme--border-color--darker--left">
  <div class="c-comments--inner u-padding">
    @if (have_comments())
      <h2 class="u-theme--color--darker">
        {!! sprintf(_nx('One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sage'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>') !!}
      </h2>
      <ol class="comment-list">
        {!! wp_list_comments(['style' => 'ol', 'short_ping' => true]) !!}
      </ol>
      @if (get_comment_pages_count() > 1 && get_option('page_comments'))
        <nav>
          <ul class="pager">
            @if (get_previous_comments_link())
              <li class="previous">@php(previous_comments_link(__('&larr; Older comments', 'sage')))</li>
            @endif
            @if (get_next_comments_link())
              <li class="next">@php(next_comments_link(__('Newer comments &rarr;', 'sage')))</li>
            @endif
          </ul>
        </nav>
      @endif
    @endif
    @if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments'))
      <p>{{ __('Sorry, no results were found.', 'sage') }}</p>
    @endif
    @php
      comment_form(
        array(
          'title_reply_before' => '<h3 class="comment-reply-title u-theme--color--darker">',
          'title_reply_after'  => '</h3>',
          'logged_in_as' => '',
          'title_reply' => 'Leave a Comment',
          'label_submit' => 'Submit',
          'class_form' => 'u-spacing'
        )
      );
    @endphp
  </div>
</section>
