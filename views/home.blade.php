@extends('layouts.app')
@section('content')
  @php
    if (get_option('show_on_front') === 'posts') {
      /**
       * Home with latest posts
       */
      $isVisibleSidebar = \App\TemplateHelpers::isVisibleSidebarOnFront();

      $sidebar = [
        'id' => 'sidebar-page',
        'isVisible' => $isVisibleSidebar,
      ];

      /**
       * Header data
       */
      $headerTitle = get_alps_option('posts_page_title');
      if (!$headerTitle) {
          $headerTitle = __('Recent Posts', 'alps');
      }
    } else {
      /**
       * Custom archive page
       */
      $isVisibleSidebar = \App\TemplateHelpers::isVisibleSidebarOnArchive();

      $sidebar = [
        'id' => 'sidebar-posts',
        'isVisible' => $isVisibleSidebar,
      ];

      /**
       * Header data
       */
      extract(\App\TemplateHelpers::getRootPostData());
    }

  @endphp

  @include('patterns.02-organisms.sections.page-header-v2')
  @include('patterns.02-organisms.content.content-posts')

@endsection
