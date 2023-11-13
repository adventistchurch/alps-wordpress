@if ($title_h1)
  @php $h_tag = 'h1' @endphp
@else
  @php $h_tag = 'h3' @endphp
@endif
@if (isset($title_div))
  @php $h_tag = 'div' @endphp
@endif
<div class="c-media-block c-block @if (isset($block_class)){{ $block_class }}@endif">
  @if (isset($image) or isset($picture))
    <div class="c-media-block__image c-block__image @if (isset($block_img_class)){{ $block_img_class }}@endif @if (isset($block_type))c-block__icon c-block__icon--{{ $block_type }}@endif @if (isset($background_image)){{ 'u-background--cover c-media-block__background-image c-background-image--' . $thumb_id }}@endif">
      <div class="c-block__image-wrap @if (isset($block_img_wrap_class)){{ $block_img_wrap_class }}@endif">
        @if (isset($background_image))
          <style type="text/css">
            .c-background-image--{{ $thumb_id }} {
              background-image: url({{ $image_s }});
            }
            @media (min-width: {{ $image_break_m . 'px'}}) {
              .c-background-image--{{ $thumb_id }} {
                background-image: url({{ $image_m }});
              }
            }
            @if (isset($image_break_l))
              @media (min-width: {{ $image_break_l . 'px' }}) {
                .c-background-image--{{ $thumb_id }} {
                  background-image: url({{ $image_l }});
                }
              }
            @endif
            @if (isset($image_break_xl))
              @media (min-width: {{ $image_break_xl . 'px' }}) {
                .c-background-image--{{ $thumb_id }} {
                  background-image: url({{ $image_xl }});
                }
              }
            @endif
          </style>
        @else
          @if (isset($picture))
            <picture class="picture @if (isset($picture_class)){{ $picture_class }}@endif">
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
        @endif
      </div>
    </div> <!-- c-media-block__image -->
  @endif
  <div class="c-media-block__content c-block__content u-spacing @if (isset($block_content_class)){{ $block_content_class }}@endif">
    <div class="u-spacing c-block__group c-media-block__group @if (isset($block_group_class)){{ $block_group_class }}@endif">
      <div class="u-spacing u-width--100p @if (isset($block_text_class)){{ $block_text_class }}@endif">
        @if (isset($kicker))
          <h4 class="c-media-block__kicker c-block__kicker @if (isset($block_kicker_class)){{ $block_kicker_class }}@endif">{{ $kicker }}</h4>
        @endif
        @if (isset($title))
          <{{ $h_tag }} class="c-media-block__title c-block__title @if (isset($block_title_class)){{ $block_title_class }}@endif @if (isset($kicker)){{ 'u-space--zero'}}@endif">
            @if (isset($link))
              <a href="{{ $link }}" class="c-block__title-link @if (isset($block_title_link_class)){{ $block_title_link_class }}@else{{ 'u-theme--link-hover--dark' }}@endif">
            @endif
              @if (isset($eyebrow))<em class="u-theme--color--lighter">{{ $eyebrow . ' ' }}</em>@endif
              {!! $title !!}
            @if (isset($link))
              </a>
            @endif
          </{{ $h_tag }}>
        @endif
        @if (!empty($excerpt))
          <p class="c-media-block__description c-block__description">
            @php
              if (str_word_count($excerpt) > $excerpt_length) {
                echo strip_shortcodes(wp_trim_words($excerpt, $excerpt_length));
              } else {
                echo strip_shortcodes(strip_tags($excerpt));
              }
            @endphp
          </p>
        @elseif (!empty($body))
          <p class="c-media-block__description c-block__description">this is
            @php
              if (str_word_count($body) > $excerpt_length) {
                echo strip_shortcodes(wp_trim_words($body, $excerpt_length));
              } else {
                echo strip_shortcodes($body);
              }
            @endphp
          </p>
        @endif
      </div>
      @if (isset($category) or isset($date))
        <div class="c-media-block__meta c-block__meta @if (isset($block_meta_class)){{ $block_meta_class }}@endif">
          @if (isset($category))
            <span class="c-block__category u-text-transform--upper">{!! $category !!}</span>
          @endif
          @if (isset($date))
            <time itemprop="datePublished" class="c-block__date u-text-transform--upper">{{ $date }}</time>
          @endif
        </div>
      @endif
      @if (isset($cta))
         <?php if (isset($cta)): ?>
        <a href="{{ $link }}" class="c-block__button o-button o-button--outline"><span class="u-icon u-icon--m u-path-fill--base u-space--half--right">@include('patterns.00-atoms.icons.icon-arrow-long-right')</span>{{ $cta }}</a>
      <?php endif; ?>
      @endif
    </div>
  </div> <!-- .c-media-block__content -->
</div> <!-- .c-media-block -->
