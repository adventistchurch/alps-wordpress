@extends('layouts.app')
@section('content')
  @while(have_posts())
    {!! the_post() !!}
    @include('patterns.02-organisms.content.content-front-page')
  @endwhile
@endsection