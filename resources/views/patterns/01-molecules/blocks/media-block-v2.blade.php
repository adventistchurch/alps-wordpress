@php
  /**
   * Media Block
   *
   * @var string $mediaBlockTitle
   * @var string $mediaBlockTitleLink
   * @var string $mediaBlockDesc
   * @var string $mediaBlockKicker
   * @var string $mediaBlockImageCaption
   * @var string $mediaBlockDate
   * @var string $mediaBlockCategory
   */
@endphp

<div class="c-media-block c-block c-block__inline c-block--reversed l-grid--7-col">

  <div class="c-block__image l-grid-item u-padding--zero--sides">
    <div class="c-block__image-outer-wrap">
      <div class="c-block__image-wrap">
        <picture class="picture">
          <!--[if IE 9]><video style="display: none;"><![endif]-->
          @foreach ($mediaBlockImages as $image)
            @if (!empty($image[4]))
              <source srcset="{{ $image[0] }}" media="(min-width: {{ $image[4] }}px)">
            @endif
          @endforeach
          <!--[if IE 9]></video><![endif]-->
          <img itemprop="image" srcset="{{ $mediaBlockImages['s'][0] }}" alt="{{ $mediaBlockImageCaption }}">
        </picture>
        @if ($mediaBlockImageCaption)
        <div class="c-block__caption u-padding--top u-padding--bottom u-color--white-transparent u-padding--sides">
          {{ $mediaBlockImageCaption }}
        </div>
        @endif
      </div>
    </div>
  </div>

  <div class="c-block__content u-spacing l-grid-item u-border-left--black--at-large u-theme--border-color--darker--left u-theme--color--lighter u-theme--background-color--darker u-padding--top u-padding--bottom">
    <div class="u-spacing c-block__group ">
      <div class="u-width--100p u-spacing">
        @if ($mediaBlockKicker)
        <h4 class="c-block__kicker u-space--quarter--bottom">{{ $mediaBlockKicker }}</h4>
        @endif

        <h1 class="c-block__title u-theme--color--lighter u-font--primary u-font-weight--bold u-space--zero">
          @if ($mediaBlockTitleLink)
          <a href="{{ $mediaBlockTitleLink }}" class="c-block__title-link u-theme--link-hover--light">
          @endif

          {{  $mediaBlockTitle  }}

          @if ($mediaBlockTitleLink)
          </a>
          @endif
        </h1>
        <p class="c-block__description">{{ $mediaBlockDesc }}</p>
      </div>
      @if ($mediaBlockCategory || $mediaBlockDate)
      <div class="c-block__meta ">
        @if ($mediaBlockCategory)
        <span class="c-block__category u-text-transform--upper">{{ $mediaBlockCategory }}</span>
        @endif
        @if ($mediaBlockDate)
        <span class="c-block__date u-text-transform--upper">{{ $mediaBlockDate }}</span>
        @endif
      </div>
      @endif
    </div>
  </div>

</div>
