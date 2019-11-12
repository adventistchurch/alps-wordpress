@php
  global $post;
  $cf = get_option('alps_cf_converted');
  $cf_ = '';
  if ($cf) {
    $cf_ = '_';
   }

  $has_sidebar = true;
  $section_offset = 'u-shift--left--1-col--at-large';
  $article_offset = '';

  if (get_post_meta($post->ID , $cf_.'hide_sidebar', true) == true ) {
    $has_sidebar = false;
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--xl--3-col';
  }

  $has_dropcap = true;
  $classes = "has-dropcap";

  if (get_post_meta($post->ID , $cf_.'hide_dropcap', true) == true) {
    $has_dropcap = false;
    $classes = "";
  }
@endphp
@include('patterns.02-organisms.sections.page-header-feature')
<section id="top" class="l-main__content l-grid l-grid--7-col {{ $section_offset }} l-grid-wrap--6-of-7 u-spacing--double--until-large">
  <div class="c-article l-grid-item l-grid-item--l--4-col {{ $article_offset }}">
    <article @php post_class("text c-article__body u-spacing--double $classes") @endphp>
      @php the_content() @endphp
      @include('patterns.02-organisms.sections.article-footer')
    </article>
  </div>
  @if ($has_sidebar)
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      @include('patterns.02-organisms.asides.related-stories')
    </div>
  @endif
</section>
