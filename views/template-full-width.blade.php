{{--
  Template Name: Full-Width Page Template
--}}

@extends('layouts.app')
@section('content')
  @while(have_posts())
    {!! the_post() !!}
    @include('patterns.02-organisms.content.content-page-full-width')
  @endwhile
@endsection
