@extends('layouts.app')
@section('content')
  <section class="l-grid l-grid--7-col u-shift--left--1-col--at-large l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
    <div class="c-article l-grid-item l-grid-item--l--4-col u-padding--zero--sides">
      <article class="c-article__body u-padding--right">
        @include('patterns.02-organisms.sections.page-header')
        <div class="c-search-results u-spacing--double text">
          @if (have_posts())
            @while (have_posts()) @php(the_post())
              @php
                $id = get_the_ID();
                $title = get_the_title($id);
                $excerpt = get_the_excerpt($id);
                $excerpt_length = 300;
                $body = get_the_content($id);
                $url = get_permalink($id);
                $cta = "Learn More";
                $block_class = "u-spacing";
              @endphp
              @include('patterns.01-molecules.blocks.content-block')
            @endwhile
            @php echo do_shortcode('[ajax_load_more container_type="div" css_classes="u-spacing--double" post_type="post, page" scroll="false" transition_container="false" button_label="Load More" posts_per_page="10" offset="10"]'); @endphp
          @else
            <p>{{ __('Sorry, no results were found.', 'sage') }}</p>
            {!! get_search_form(false) !!}
          @endif
        </div>
      </article>
    </div>
  </section>
@endsection
