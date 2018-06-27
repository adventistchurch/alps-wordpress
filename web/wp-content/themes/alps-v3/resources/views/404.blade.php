@extends('layouts.app')
@section('content')
  <header class="c-page-header c-page-header__simple u-theme--background-color--dark">
    <div class="c-page-header__simple--inner u-padding">
      <h1 class="u-font--primary--xxl u-color--white">
        Page not found
      </h1>
    </div>
  </header> <!-- /.c-page-header-->
  <section class="l-grid l-grid--7-col u-shift--left--1-col--at-large l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
    <div class="c-article l-grid-item l-grid-item--l--4-col u-padding--zero--sides">
      <article @php(post_class('c-article__body'))>
        <div class="text u-spacing--double">
          <p>{{ __('Sorry, no results were found.', 'sage') }}</p>
          <a href="/" class="o-button">Go to homepage</a>
        </div>
      </article>
    </div>
  </section>
@endsection
