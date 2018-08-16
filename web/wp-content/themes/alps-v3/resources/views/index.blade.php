@extends('layouts.app')
@section('content')
  @php
    if (is_active_sidebar('sidebar-posts') && get_post_meta('hide_sidebar', true) != 'true') {
      $section_offset = 'u-shift--left--1-col--at-xxlarge';
      $article_offset = 'l-grid-item--xl--3-col';
    } else {
      $section_offset = 'u-shift--left--1-col--at-large';
      $article_offset = '';
    }
  @endphp
  @include('patterns.02-organisms.sections.page-header')
  <section class="l-grid l-grid--7-col {{ $section_offset }} l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
    <article class="c-article l-grid-item l-grid-item--l--4-col {{ $article_offset }}">
      <div class="c-article__body">
        <div class="text u-spacing--double">
          @if (have_posts())
            @while (have_posts())
              @php
                the_post();
                $id = get_the_ID();
                $title = get_the_title($id);
                $excerpt = get_the_excerpt($id);
                $excerpt_length = 300;
                $body = get_the_content($id);
                $link = get_permalink($id);
                $cta = "Read More";
                $block_class = "u-theme--border-color--darker u-border--left u-spacing";
              @endphp
              @include('patterns.01-molecules.blocks.content-block')
            @endwhile
            {!! wp_reset_query() !!}
            @if (shortcode_exists('ajax_load_more'))
              {!! do_shortcode('[ajax_load_more container_type="div" css_classes="u-spacing--double" post_type="post" category="'. get_the_category()[0]->slug .'" scroll="false" transition_container="false" button_label="Load More" posts_per_page="10" offset="10"]') !!}
            @endif
          @else
            <p>Sorry, there are no posts at this time.</p>
          @endif
        </div>
      </div>
    </article>
    @if (is_active_sidebar('sidebar-posts') && get_post_meta('hide_sidebar', true) != 'true')
      <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
        <div class="u-spacing--double u-padding--right">
          @php dynamic_sidebar('sidebar-primary') @endphp
        </div>
      </div> <!-- /.c-sidebar -->
    @endif
  </section>
@endsection
