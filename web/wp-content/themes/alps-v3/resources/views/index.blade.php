@php
  $id = get_queried_object_id();
  $link = get_permalink($id);
  $posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'post_status' => 'publish'
  ));
@endphp
@extends('layouts.app')
@section('content')
  <section class="section section__main">
    <div class="layout-container">
      @if ($posts->have_posts())
        <div class="narrow--xl center-block spacing--double">
          @while ($posts->have_posts()) @php($posts->the_post())
            @php
              $id = get_the_ID();
              $title = get_the_title($id);
              $excerpt = get_the_excerpt($id);
              $thumb_id = get_post_thumbnail_id($id);
              $link = get_permalink($id);
              $date = date('F j, Y', strtotime(get_the_date()));
            @endphp
            @include('patterns.01-molecules.blocks.media-block')
          @endwhile
          @php(wp_reset_query())
          @php echo do_shortcode('[ajax_load_more container_type="div" css_classes="spacing--double" post_type="post" category="news" scroll="false" transition_container="false" button_label="Load More" posts_per_page="5" offset="5"]'); @endphp
        </div>
      @else
        <p>{{ __('Sorry, no results were found.', 'sage') }}</p>
        {!! get_search_form(false) !!}
      @endif
    </div>
  </section>
@endsection
