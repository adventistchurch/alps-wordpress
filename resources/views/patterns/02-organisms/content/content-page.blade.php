@php
  global $post;

  do_action('alps_custom_sidebar_widgets');
  $cf_ = '_';
  // SIDEBAR CONFIGURATION OPTIONS
  $active_sidebar = is_active_sidebar('sidebar-page');
  $entry_hide_sidebar = get_post_meta($post->ID, $cf_.'hide_sidebar', true);
  $theme_hide_sidebar = get_alps_option('index_hide_sidebar');

  // If has sidebar and hide sidebar is not true for entry or theme
  if ($active_sidebar && !$entry_hide_sidebar && !$theme_hide_sidebar) {
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--xxl--3-col';
  } else {
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
  @if ($active_sidebar && !$theme_hide_sidebar  && !$entry_hide_sidebar)
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      <div class="u-spacing--double u-padding--right">
        @php dynamic_sidebar('sidebar-page') @endphp
      </div>
    </div> <!-- /.c-sidebar -->
  @endif
</section>
