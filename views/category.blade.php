@extends('layouts.app')
@section('content')
  @php
    $isVisibleSidebar = \App\TemplateHelpers::isVisibleSidebarOnArchive();

    $sidebar = [
      'id' => 'sidebar-posts',
      'isVisible' => $isVisibleSidebar,
    ];

    /**
     * Header data
     */
    switch (get_option('show_on_front')) {
      case 'page':
        extract(\App\TemplateHelpers::getRootPostData());
        break;
      default:
        $headerTitle = single_cat_title('', false);
    }
  @endphp

  @include('patterns.02-organisms.sections.page-header-v2')
  @include('patterns.02-organisms.content.content-posts')

@endsection
