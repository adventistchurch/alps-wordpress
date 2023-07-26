@php
  global $post;
  $cf_ = '_';

  $has_sidebar = true;
  $section_offset = 'u-shift--left--1-col--at-large';
  $article_offset = 'l-grid-item--xl--3-col';

  if (get_post_meta($post->ID , $cf_.'hide_sidebar', true) == true ) {
    $has_sidebar = false;
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--l--5-col';
  }

@endphp
<section id="top" class="l-main__content l-grid l-grid--7-col {{ $section_offset }} l-grid-wrap--6-of-7 u-spacing--double--until-large">
  <div class="c-article l-grid-item l-grid-item--l--3-col {{ $article_offset }}">
    <article @php post_class('text c-article__body u-spacing @isset($GLOBALS["classes"])') @endphp>
      @php the_content() @endphp
      @include('patterns.02-organisms.sections.article-footer')
    </article>
    @include('patterns.02-organisms.sections.comments')
  </div>
  @if ($has_sidebar)
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      @php dynamic_sidebar('sidebar-posts') @endphp
    </div>
  @endif
</section>
