{{--
  Template Name: Page Builder Template
  Template Post Type: post, page
--}}

@extends('layouts.app')

@php
  global $post;
  extract(\App\TemplateHelpers::getPostData($post->ID));
@endphp

@section('content')
  @while(have_posts()) @php(the_post())
    @include('patterns.02-organisms.sections.page-header-hero')
    @include('partials.content-page')
  @endwhile
@endsection
