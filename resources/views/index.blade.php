@extends('layouts.app')
@section('content')
  @php
    do_action('alps_custom_sidebar_widgets');

    // Show the sidebar when "index_hide_sidebar"
    $isVisibleSidebar = \App\TemplateHelpers::isVisibleSidebarOnFront();

    $sidebar = [
      'id' => 'sidebar-page',
      'isVisible' => $isVisibleSidebar,
    ];

    /**
     * Header data
     */
    $headerType = \App\TemplateHelpers::POST_HEADER_TYPE_SIMPLE;
    $headerTitle = get_alps_option('posts_page_title');
    if (!$headerTitle) {
        $headerTitle = __('Recent Posts', 'alps');
    }
  @endphp

  @include('patterns.02-organisms.sections.page-header-v2')
  @include('patterns.02-organisms.content.content-posts')

@endsection
