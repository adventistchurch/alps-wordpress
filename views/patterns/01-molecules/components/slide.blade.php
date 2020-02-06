<div class="c-carousel__item u-position--relative" >
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

    <div class="c-carousel__item-text__wrap l-grid l-grid--7-col u-shift--left--1-col--at-large" >
        <div class="l-grid-item l-grid-item--m--4-col l-grid-item--xl--3-col">
            <div class="c-carousel__item-text  u-spacing u-padding--double--top u-padding--double--bottom">
                <div class="c-carousel__item-text--inner u-spacing--half">

                    @if (isset($heading))
                        <h2 class="c-carousel__item-heading u-font--primary--xl">
                            {!! $heading !!}
                        </h2>
                    @endif

                    @if (isset($subtitle))
                        <h3 class="c-carousel__item-subtitle u-font--secondary--s u-text-transform--upper">
                            <strong>{!! $subtitle !!}</strong>
                        </h3>
                    @endif

                    @if (isset($dek))
                        <div class="c-carousel__item-dek">
                            <p>{!! $dek !!}</p>
                        </div>
                    @endif
                </div>
                @if ( isset($url) && !empty($cta) )
                    <a href="{{ $url }}" class="c-carousel__item-cta o-button u-theme--secondary-background-color">
                      {!! $cta !!}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
