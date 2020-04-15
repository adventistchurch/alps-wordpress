<div class="c-carousel__item--inset u-position--relative">
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
  <div class="c-carousel__item-text__wrap u-theme--background-color-trans--dark">
    <div class="l-container">
      <div class="c-carousel__item-text u-spacing--half">
        <div class="c-carousel__item-text--inner">
          @if (isset($heading))
            <h2 class="u-font--primary--xl c-carousel__item-heading">
              {!! $heading !!}
            </h2>
          @endif
          @if (isset($dek))
            <div class="c-carousel__item-dek u-padding--half--bottom u-theme--primary-transparent-background-color">
              <p>{!! $dek !!}</p>
            </div>
          @endif
        </div>
        @if ( isset($url) && !empty($cta) )
          <a href="{{ $url }}" class="c-carousel__item-cta o-button o-button--small u-theme--secondary-background-color">
            {!! $cta !!}
          </a>
        @endif
      </div>
    </div>
  </div>
</div>
