<div class="c-block c-block__text @if (isset($thumb_id)){{ 'has-image' }}@endif u-theme--border-color--darker u-border--left @if (isset($block_class)){{ $block_class }}@endif">
  @if (isset($thumb_id))
    <img class="c-block__image" src="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0] }}" />
  @endif
  <h3 class="u-theme--color--darker @if (isset($block_title_class)){{ $block_title_class }}@endif">
    @if (isset($link))
      <a href="{{ $link }}" class="c-block__title-link u-theme--link-hover--dark">
    @endif
    <strong>{!! $title !!}</strong>
    @if (isset($link))
      </a>
    @endif
  </h3>
  @if (!empty($excerpt))
    <p class="c-block__body text">
      @php
        if (strlen($excerpt) > $excerpt_length) {
          echo do_shortcode( strip_tags(trim(mb_substr($excerpt, 0, $excerpt_length))) . '&hellip;' );
        } else {
          echo do_shortcode( strip_tags($excerpt) );
        }
      @endphp
    </p>
  @elseif (!empty($body))
    <p class="c-block__body text">
      @php
        if (strlen($body) > $excerpt_length) {
          echo do_shortcode( strip_tags(trim(mb_substr($body, 0, $excerpt_length))) . '&hellip;' );
        } else {
          echo do_shortcode( strip_tags($body) );
        }
      @endphp
    </p>
  @endif
  @if (isset($category) || isset($date))
    <span class="c-block__meta u-theme--color--dark u-font--secondary--xs">
      @if (isset($category))
        <span class="c-block__category u-text-transform--upper">{{ $category }}</span>
      @endif
      @if (isset($date))
        <time class="c-block__date u-text-transform--upper">{{ $date }}</time>
      @endif
    </span>
  @endif
  @if (isset($expand_body))
    <div class="c-block__content">
      <p>{{ $expand_body }}</p>
    </div>
  @endif
  @if (isset($expand))
    <a href="" class="o-button o-button--outline o-button--expand js-toggle-parent"></a>
  @else
    @if (isset($cta))
      <a href="{{ $link }}" class="c-block__button o-button o-button--outline">{{ $cta }}<span class="u-icon u-icon--m u-path-fill--base u-space--half--left">@include('patterns.00-atoms.icons.icon-arrow-long-right')</span></a>
    @endif
  @endif
</div>
