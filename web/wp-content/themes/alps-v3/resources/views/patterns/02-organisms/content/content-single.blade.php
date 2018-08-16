@php
  global $post;
  if (get_post_meta($post->ID, 'hide_sidebar', true) != 'true') {
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--xl--3-col';
  } else {
    $section_offset = 'u-shift--left--1-col--at-large';
    $article_offset = '';
  }
@endphp
@include('patterns.02-organisms.sections.page-header-feature')
<section class="l-grid l-grid--7-col {{ $section_offset }} l-grid-wrap--6-of-7 u-spacing--double--until-large">
  <div class="c-article l-grid-item l-grid-item--l--4-col {{ $article_offset }}">
    <article @php post_class('text c-article__body u-spacing--double has-dropcap') @endphp>
      @php the_content() @endphp
      @include('patterns.02-organisms.sections.article-footer')
    </article>
  </div>
  @if (get_post_meta($post->ID, 'hide_sidebar', true) != 'true')
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      @include('patterns.02-organisms.asides.related-stories')
    </div>
  @endif
</section>
