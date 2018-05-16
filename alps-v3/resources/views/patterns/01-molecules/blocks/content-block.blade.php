<div class="c-block c-block__text @if (isset($thumb_id)){{ 'has-image' }}@endif u-theme--border-color--darker u-border--left @if (isset($block_class)){{ $block_class }}@endif">
  @if (isset($thumb_id))
    <img class="c-block__image" src="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0] }}" />
  @endif
  <h3 class="u-theme--color--darker @if (isset($title_class)){{ $title_class }}@endif">
    @if (isset($url))
      <a href="{{ $url }}" class="c-block__title-link u-theme--link-hover--dark">
    @endif
    <strong>{{ $title }}</strong>
    @if (isset($url))
      </a>
    @endif
  </h3>
  <p class="c-block__body text">
    @if (!empty($excerpt))
      @php
        if (strlen($excerpt) > $excerpt_length) {
          echo trim(mb_substr($excerpt, 0, $excerpt_length)) . '&hellip;';
        } else {
          echo $excerpt;
        }
      @endphp
    @elseif (!empty($body))
      @php
        if (strlen($body) > $excerpt_length) {
          echo trim(mb_substr($body, 0, $excerpt_length)) . '&hellip;';
        } else {
          echo $body;
        }
      @endphp
    @endif
  </p>
  @if (isset($category))
    <span class="c-block__meta u-theme--color--dark u-font--secondary--xs">{{ $category }}</span>
  @endif
  @if (isset($body))
    <div class="c-block__content">
      <p>{{ $body }}</p>
    </div>
  @endif
  @if (isset($expand))
    <a href="" class="o-button o-button--outline o-button--expand js-toggle-parent"></a>
  @else
    @if (isset($cta))
      <a href="{{ $url }}" class="c-block__button o-button o-button--outline">{{ $cta }}<span class="u-icon u-icon--m u-path-fill--base u-space--half--left">@include('patterns.00-atoms.icons.icon-arrow-long-right')</span></a>
    @endif
  @endif
</div>
