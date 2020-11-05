@extends('layouts.app')
@section('content')
  @php
    do_action('alps_custom_sidebar_widgets');

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
        $headerType = \App\TemplateHelpers::POST_HEADER_TYPE_SIMPLE;
        $headerTitle = single_cat_title('', false);
        if (get_alps_option('posts_label')) {
            $headerKicker = __('Category', 'alps');
        }
    }
  @endphp

  @include('patterns.02-organisms.sections.page-header-v2')
  @include('patterns.02-organisms.content.content-posts')

@endsection
