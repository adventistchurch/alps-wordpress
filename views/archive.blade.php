@extends('layouts.app')
@section('content')
  @php
    /**
     * Header data
     */
    switch (get_option('show_on_front')) {
      case 'page':
        extract(\App\TemplateHelpers::getRootPostData());
        break;
      default:
        $headerTitle = get_alps_option('archive_page_title');
        if (!$headerTitle) {
            $headerTitle = __('Archives', 'alps');
        }
    }

    // Show the sidebar when both "index_hide_sidebar" and "archive_hide_sidebar" are false
    $isVisibleSidebar = \App\TemplateHelpers::isVisibleSidebarOnArchive();

    $sidebar = [
      'id' => 'sidebar-posts',
      'isVisible' => $isVisibleSidebar,
    ];


  @endphp

  @include('patterns.02-organisms.sections.page-header-v2')
  @include('patterns.02-organisms.content.content-posts')

@endsection
