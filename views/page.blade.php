@extends('layouts.app')
@section('content')
  @php
    do_action('alps_custom_sidebar_widgets');
  @endphp
  @while(have_posts())
    {!! the_post() !!}
    @include('patterns.02-organisms.content.content-page')
  @endwhile
@endsection
