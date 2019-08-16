@php
  global $post;
  $hide_sabbath = get_option('alps_theme_settings')['sabbath_hide'];
  // If has sidebar and hide sidebar is not true
  if (is_active_sidebar('sidebar-page') && get_post_meta($post->ID, 'hide_sidebar', true) != 'true') {
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--xl--3-col';
  }
  // If
  elseif ($hide_sabbath == 'true') {
    $section_offset = 'u-shift--left--1-col--at-large';
    $article_offset = 'l-grid-item--xl--4-col';
  }
  else {
    $section_offset = 'u-shift--left--1-col--at-large';
    $article_offset = '';
  }
@endphp
@include('patterns.02-organisms.sections.page-header-hero')
<section id="top" class="l-main__content l-grid l-grid--7-col {{ $section_offset }} l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
  <article @php post_class("c-article l-grid-item l-grid-item--l--4-col $article_offset") @endphp>
    <div class="c-article__body">
      <div class="text u-spacing">
        @include('patterns.01-molecules.navigation.breadcrumbs')
        @if (is_active_sidebar('section-page-top'))
          @php dynamic_sidebar('section-page-top') @endphp
        @endif
        @php the_content() @endphp
        @include('patterns.02-organisms.sections.related-pages')
        @if (is_active_sidebar('section-page-bottom'))
          @php dynamic_sidebar('section-page-bottom') @endphp
        @endif
      </div>
    </div>
  </article>
  @if (is_active_sidebar('sidebar-page') && get_post_meta($post->ID, 'hide_sidebar', true) != 'true')
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      <div class="u-spacing--double u-padding--right">
        @php dynamic_sidebar('sidebar-page') @endphp
      </div>
    </div> <!-- /.c-sidebar -->
  @endif
</section>
