@php
  global $post;
  if (is_active_sidebar('sidebar-primary') && get_post_meta($post->ID, 'hide_sidebar', true) != 'true') {
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--xl--3-col';
  } else {
    $section_offset = 'u-shift--left--1-col--at-large';
    $article_offset = '';
  }
@endphp
@include('patterns.02-organisms.sections.page-header-hero')
<section class="l-grid l-grid--7-col {{ $section_offset }} l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
  <article class="c-article l-grid-item l-grid-item--l--4-col {{ $article_offset }}">
    <div class="c-article__body">
      <div class="text u-spacing">
        @include('patterns.01-molecules.navigation.breadcrumbs')
        @php(the_content())
        @include('patterns.02-organisms.sections.related-pages')
      </div>
    </div>
  </article>
  @if (is_active_sidebar('sidebar-primary') && get_post_meta($post->ID, 'hide_sidebar', true) != 'true')
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      <div class="u-spacing--double u-padding--right">
        @php(dynamic_sidebar('sidebar-primary'))
      </div>
    </div> <!-- /.c-sidebar -->
  @endif
</section>
