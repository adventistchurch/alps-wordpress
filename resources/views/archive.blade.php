@extends('layouts.app')
@section('content')
  @php
    do_action('alps_custom_sidebar_widgets');

    /**
     * Header data
     */
    switch (get_option('show_on_front')) {
      case 'page':
        extract(\App\TemplateHelpers::getRootPostData());
        break;
      default:
        $headerType = \App\TemplateHelpers::POST_HEADER_TYPE_SIMPLE;
        $headerTitle = get_alps_option('archive_page_title');
        if (!$headerTitle) {
            $headerTitle = __('Archives', 'alps');
        }
    }

    $isVisibleSidebar = \App\TemplateHelpers::isVisibleSidebarOnArchive();

    $sidebar = [
      'id' => 'sidebar-posts',
      'isVisible' => $isVisibleSidebar,
    ];


  @endphp

  @include('patterns.02-organisms.sections.page-header-v2')
  @include('patterns.02-organisms.content.content-posts')

@endsection
