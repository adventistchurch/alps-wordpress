<section class="c-hero-carousel">
  <div class="c-carousel c-carousel--inset u-position--relative">
    <div class="c-carousel__slides js-carousel__single-item">
      @foreach ($hero_data as $slide)
        @php
          $heading = $slide['slide_heading'];
          $dek = $slide['slide_dek'];
          $cta = $slide['slide_cta'];
          $url = ( isset($slide['slide_url']) ) ? $slide['slide_url'] : null;
          $picture = true;
          $thumb_id = $slide['slide_image'];
          $thumb_size = 'horiz__16x9';
          $image_break_m = '500';
          $image_break_l = '800';
          $image_break_xl = '1100';
          $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
          $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
          $image_l = wp_get_attachment_image_src($thumb_id, $thumb_size . '--l')[0];
          $image_xl = wp_get_attachment_image_src($thumb_id, $thumb_size . '--xl')[0];
          $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        @endphp
        @include('patterns.01-molecules.components.slide')
      @endforeach
    </div>
  </div>
</section>
