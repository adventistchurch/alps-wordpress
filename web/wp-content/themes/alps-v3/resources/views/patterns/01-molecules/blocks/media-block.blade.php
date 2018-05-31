<div class="c-media-block c-block @if (isset($block_class)){{ $block_class }}@endif">
  @if (isset($image) or isset($picture))
    <div class="c-media-block__image c-block__image @if (isset($block_img_class)){{ $block_img_class }}@endif @if (isset($block_type)) c-block__icon c-block__icon--{{ $block_type }}@endif">
      <div class="c-block__image-wrap @if (isset($block_img_wrap_class)){{ $block_img_wrap_class }}@endif">
        @if (isset($picture))
          <picture class="picture">
            <!--[if IE 9]><video style="display: none;"><![endif]-->
            @if (isset($image_break_xl))
              <source srcset="{{ $image_xl }}" media="(min-width: {{ $image_break_xl }}px)">
            @endif
            @if (isset($image_break_l))
              <source srcset="{{ $image_l }}" media="(min-width: {{ $image_break_l }}px)">
            @endif
            <source srcset="{{ $image_m }}" media="(min-width: {{ $image_break_m }}px)">
            <!--[if IE 9]></video><![endif]-->
            <img itemprop="image" srcset="{{ $image_s }}" alt="{{ $alt }}">
          </picture>
        @elseif (isset($image))
          <img src="{{ $image }}" itemprop="image" alt="{{ $alt }}" />
        @endif
      </div>
    </div> <!-- c-media-block__image -->
  @endif
  <div class="c-media-block__content c-block__content u-spacing @if (isset($block_content_class)){{ $block_content_class }}@endif">
    <div class="u-spacing c-block__group c-media-block__group @if (isset($block_group_class)){{ $block_group_class }}@endif">
      <div class="u-spacing u-width--100p">
        @if (isset($kicker))
          <h4 class="c-media-block__kicker c-block__kicker @if (isset($block_kicker_class)){{ $block_kicker_class }}@endif">{{ $kicker }}</h4>
        @endif
        @if (isset($title))
          <h3 class="c-media-block__title c-block__title @if (isset($block_title_class)){{ $block_title_class }}@endif @if (isset($kicker)){{ 'u-space--zero'}}@endif">
            @if (isset($link))
              <a href="{{ $link }}" class="c-block__title-link u-theme--link-hover--dark">
            @endif
            {{ $title }}
            @if (isset($link))
              </a>
            @endif
          </h3>
        @endif
        @if (!empty($excerpt))
          <p class="c-media-block__description c-block__description">
            @php
              if (strlen($excerpt) > $excerpt_length) {
                echo trim(mb_substr($excerpt, 0, $excerpt_length)) . '&hellip;';
              } else {
                echo $excerpt;
              }
            @endphp
          </p>
        @elseif (!empty($body))
          <p class="c-media-block__description c-block__description">
            @php
              if (strlen($body) > $excerpt_length) {
                echo trim(mb_substr($body, 0, $excerpt_length)) . '&hellip;';
              } else {
                echo $body;
              }
            @endphp
          </p>
        @endif
      </div>
      <div class="c-media-block__meta c-block__meta @if (isset($block_meta_class)){{ $block_meta_class }}@endif">
        @if (isset($category))
          <span class="c-block__category u-text-transform--upper">{{ $category }}</span>
        @endif
        @if (isset($date))
          <time class="c-block__date u-text-transform--upper">{{ $date }}</time>
        @endif
      </div>
      @if (isset($cta))
        <a href="{{ $link }}" class="c-block__button o-button o-button--outline">{{ $cta }}<span class="u-icon u-icon--m u-path-fill--base u-space--half--left">{% include '@atoms/icons/icon-arrow-long-right.twig')</span></a>
      @endif
    </div>
  </div> <!-- c-media-block__content -->
</div> <!-- c-media-block -->
