<section class="c-hero-carousel">
  <div class="c-carousel u-position--relative">
    <div class="c-carousel__slides js-carousel__single-item">

    @foreach ($hero_data as $slide)
        @php
        $thumb_id  = ( $cf ) ? $slide['slide_image'] : $slide['slide_image'][0];
        $heading   = $slide['slide_heading'];
        $subtitle  = $slide['slide_subtitle'];
        $dek       = $slide['slide_dek'];
        $cta       = $slide['slide_cta'];
        $url       = ( isset($slide['slide_url']) ) ? $slide['slide_url'] : null;

        $picture  = true;
        $image_s  = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
        $image_m  = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
        $image_l  = wp_get_attachment_image_src($thumb_id, $thumb_size . '--l')[0];
        $image_xl = wp_get_attachment_image_src($thumb_id, $thumb_size . '--xl')[0];
        $alt      = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        @endphp

        @include('patterns.01-molecules.components.slide');
    @endforeach

    </div>
  </div>
</section>
