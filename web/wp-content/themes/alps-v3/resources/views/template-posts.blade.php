{{--
  Template Name: Posts Template
--}}
@php
  global $post;
  // List
  $post_feed_list = get_post_meta($post->ID, 'post_feed_list', true);
  $post_feed_list_title = get_post_meta($post->ID, 'post_feed_list_title', true);
  $post_feed_list_link = get_post_meta($post->ID, 'post_feed_list_link', true);
  $post_feed_list_custom = get_post_meta($post->ID, 'post_feed_list_custom_array');
  $post_feed_list_category = get_post_meta($post->ID, 'post_feed_list_category_array', true);
  $post_feed_list_count = get_post_meta($post->ID, 'post_feed_list_count', true);

  // Archive
  $post_feed_archive = get_post_meta($post->ID, 'post_feed_archive', true);
  $post_feed_archive_title = get_post_meta($post->ID, 'post_feed_archive_title', true);
  $post_feed_archive_link = get_post_meta($post->ID, 'post_feed_archive_link', true);
  $post_feed_archive_category = get_post_meta($post->ID, 'post_feed_archive_category_array');
  $post_feed_archive_count = get_post_meta($post->ID, 'post_feed_archive_count', true);
@endphp
@extends('layouts.app')
@section('content')
  @while(have_posts()) @php(the_post())
    @php
      $post->ID = get_queried_object_id();
      if (is_active_sidebar('sidebar-posts') && get_post_meta($post->ID, 'hide_sidebar', true) != 'true') {
        $section_offset = 'u-shift--left--1-col--at-xxlarge';
        $article_offset = 'l-grid-item--xl--3-col';
      } else {
        $section_offset = 'u-shift--left--1-col--at-large';
        $article_offset = '';
      }
    @endphp
    <div>
      @include('patterns.02-organisms.sections.page-header')
      @include('patterns.02-organisms.sections.page-header-feature')
    </div>
    <section class="l-grid l-grid--7-col l-grid-wrap--6-of-7 u-spacing--double--until-large">
      <article class="c-article l-grid-item l-grid-item--l--4-col u-padding--zero--sides u-spacing--double">
        @if (get_the_content())
          <div class="text u-spacing">
            @php(the_content())
          </div>
        @endif
        @if ($post_feed_list != 'post_feed_list_false')
          <div class="c-block-wrap u-spacing--double">
            @if ($post_feed_list_title || $post_feed_list_link)
              <div class="c-block__heading u-theme--border-color--darker">
                @if ($post_feed_list_title)
                  <h3 class="c-block__heading-title u-theme--color--darker">{{ $post_feed_list_title }}</h3>
                @endif
                @if ($post_feed_list_link)
                  <a href="{{ $post_feed_list_link }}" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">See All</a>
                @endif
              </div>
            @endif
            @if ($post_feed_list == 'post_feed_list_category')
              @php
                if ($post_feed_list_count) {
                  $post_feed_list_count = $post_feed_list_count;
                } else {
                  $post_feed_list_count = 3;
                }
                $posts = new WP_Query(array(
                  'post_type' => 'post',
                  'posts_per_page' => $post_feed_list_count,
                  'post_status' => 'publish',
                  'category__in' => $post_feed_list_category,
                  'order_by' => 'date'
                ));
              @endphp
              <div class="c-block-wrap__content u-spacing--double">
                @while ($posts->have_posts()) @php($posts->the_post())
                  @php
                    $picture = NULL;
                    $id = get_the_ID();
                    $title = get_the_title($id);
                    $link = get_permalink($id);
                    $date = date('F j, Y', strtotime(get_the_date('', $id)));
                    $category = get_the_category($id);
                    if ($category) {
                      if (class_exists('WPSEO_Primary_Term')) {
                        $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
                        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                        $term = get_term($wpseo_primary_term);
                        if (is_wp_error($term)) {
                          $category = $category[0]->name;
                        } else {
                          $category = $term->name;
                        }
                      }
                      else {
                        $category = $category[0]->name;
                      }
                    }
                    $header_background_image = get_post_meta($id, 'header_background_image', true);
                    if (!empty($header_background_image)) {
                      $thumb_id = $header_background_image;
                    } else if (get_post_thumbnail_id($id)) {
                      $thumb_id = get_post_thumbnail_id($id);
                    } else {
                      $thumb_id = NULL;
                    }
                    if ($thumb_id) {
                      $picture = true;
                      $thumb_size = 'horiz__4x3';
                      $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                      $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
                      $image_break_m = "500";
                      $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                    }
                    $block_class = "c-block__stacked--until-small u-spacing--until-small l-grid--7-col l-grid-wrap l-large-break";
                    $block_img_class = "l-grid-item l-grid-item--s--2-col l-grid-item--l--1-col u-padding--zero--sides";
                    $block_content_class = "l-grid-item l-grid-item--s--4-col l-grid-item--l--3-col u-flex--justify-start u-padding--left";
                    $block_title_class = "u-theme--color--dark u-font--primary--l";
                    $block_meta_class = "u-theme--color--base";
                  @endphp
                  @include('patterns.01-molecules.blocks.media-block')
                @endwhile
                @php(wp_reset_query())
                @php(wp_reset_postdata())
              </div>
            @elseif ($post_feed_list == 'post_feed_list_custom')
              @php
                $posts = $post_feed_list_custom;
              @endphp
              <div class="c-block-wrap__content u-spacing--double">
                @foreach($posts as $post)
                  @php
                    $picture = NULL;
                    $id = $post;
                    $title = get_the_title($id);
                    $link = get_permalink($id);
                    $date = date('F j, Y', strtotime(get_the_date('', $id)));
                    $category = get_the_category($id);
                    if ($category) {
                      if (class_exists('WPSEO_Primary_Term')) {
                        $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
                        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                        $term = get_term($wpseo_primary_term);
                        if (is_wp_error($term)) {
                          $category = $category[0]->name;
                        } else {
                          $category = $term->name;
                        }
                      }
                      else {
                        $category = $category[0]->name;
                      }
                    }
                    $header_background_image = get_post_meta($id, 'header_background_image', true);
                    if (!empty($header_background_image)) {
                      $thumb_id = $header_background_image;
                    } else if (get_post_thumbnail_id($id)) {
                      $thumb_id = get_post_thumbnail_id($id);
                    } else {
                      $thumb_id = NULL;
                    }
                    if ($thumb_id) {
                      $picture = true;
                      $thumb_size = 'horiz__4x3';
                      $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                      $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
                      $image_break_m = "500";
                      $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                    }
                    $block_class = "c-block__stacked--until-small u-spacing--until-small l-grid--7-col l-grid-wrap l-large-break";
                    $block_img_class = "l-grid-item l-grid-item--s--2-col l-grid-item--l--1-col u-padding--zero--sides";
                    $block_content_class = "l-grid-item l-grid-item--s--4-col l-grid-item--l--3-col u-flex--justify-start u-padding--left";
                    $block_title_class = "u-theme--color--dark u-font--primary--l";
                    $block_meta_class = "u-theme--color--base";
                  @endphp
                  @include('patterns.01-molecules.blocks.media-block')
                @endforeach
                @php(wp_reset_postdata())
              </div>
            @endif
            @if ($post_feed_list_link)
              <a href="{{ $post_feed_list_link }}" class="o-button o-button--outline o-button--with-arrow u-space--left">See All<span class="u-icon u-icon--arrow--long u-theme--path-fill--base u-space--half--right">@include('patterns.00-atoms.icons.icon-arrow-long-right')</span></a>
            @endif
          </div>
        @endif
      </article>
      @if (is_active_sidebar('sidebar-posts') && get_post_meta($post->ID, 'hide_sidebar', true) != 'true')
        <div class="c-sidebar l-grid-item l-grid-item--l--2-col u-padding--zero--sides">
          <div class="u-spacing--double u-padding--right">
            @php(dynamic_sidebar('sidebar-posts'))
          </div>
        </div> <!-- /.c-sidebar -->
      @endif
    </section>
    @if ($post_feed_archive != 'post_feed_archive_false')
      <section class="l-grid l-grid--7-col u-shift--left--1-col--at-large l-grid-wrap--6-of-7">
        <div class="c-article l-grid-item l-grid-item--l--4-col u-spacing--triple">
          <div class="c-block-wrap u-spacing--double">
            @if ($post_feed_archive_title || $post_feed_archive_link)
              <div class="c-block__heading u-theme--border-color--darker">
                @if ($post_feed_archive_title)
                  <h3 class="c-block__heading-title u-theme--color--darker">{{ $post_feed_archive_title }}</h3>
                @endif
                @if ($post_feed_archive_link)
                  <a href="{{ $post_feed_archive_link }}" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">See All</a>
                @endif
              </div>
            @endif
            @php
              if ($post_feed_archive_count) {
                $post_feed_archive_count = $post_feed_archive_count;
              } else {
                $post_feed_archive_count = 10;
              }
              $archive_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => $post_feed_archive_count,
                'post_status' => 'publish',
                'category__in' => $post_feed_archive_category,
                'order_by' => 'date'
              ));
            @endphp
            @if ($archive_posts->have_posts())
              <div class="c-block-wrap__content u-spacing--double">
                @while ($archive_posts->have_posts()) @php($archive_posts->the_post())
                  @php
                    $picture = NULL;
                    $id = get_the_ID();
                    $title = get_the_title($id);
                    $link = get_permalink($id);
                    $date = date('F j, Y', strtotime(get_the_date('', $id)));
                    $category = get_the_category($id);
                    if ($category) {
                      if (class_exists('WPSEO_Primary_Term')) {
                        $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
                        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                        $term = get_term($wpseo_primary_term);
                        if (is_wp_error($term)) {
                          $category = $category[0]->slug;
                        } else {
                          $category = $term->slug;
                        }
                      }
                      else {
                        $category = $category[0]->slug;
                      }
                    }
                    $header_background_image = get_post_meta($id, 'header_background_image', true);
                    if (!empty($header_background_image)) {
                      $thumb_id = $header_background_image;
                    } else if (get_post_thumbnail_id($id)) {
                      $thumb_id = get_post_thumbnail_id($id);
                    } else {
                      $thumb_id = NULL;
                    }
                    if ($thumb_id) {
                      $picture = true;
                      $thumb_size = 'horiz__4x3';
                      $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                      $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
                      $image_break_m = "500";
                      $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                    }
                    $block_class = "c-block--reversed c-media-block--reversed l-grid-wrap l-grid-wrap--6-of-7  l-grid--7-col";
                    $block_img_class = "l-grid-item--2-col l-grid-item--m--1-col l-grid-item--l--1-col u-padding--zero--sides";
                    $block_content_class = "l-grid-item--4-col l-grid-item--m--3-col l-grid-item--l--3-col u-flex--justify-start u-border--left";
                    $block_title_class = "u-theme--color--dark u-font--primary--l";
                    $block_meta_class = "u-theme--color--base";
                  @endphp
                  @include('patterns.01-molecules.blocks.media-block')
                @endwhile
                @php(wp_reset_query())
                @php(wp_reset_postdata())
              </div>
            @endif
            @if ($post_feed_archive_link)
              <a href="{{ $post_feed_archive_link }}" class="o-button o-button--outline o-button--with-arrow u-space--left">See All<span class="u-icon u-icon--arrow--long u-theme--path-fill--base u-space--half--right">@include('patterns.00-atoms.icons.icon-arrow-long-right')</span></a>
            @endif
          </div>
        </div>
      </section>
    @endif
  @endwhile
@endsection
