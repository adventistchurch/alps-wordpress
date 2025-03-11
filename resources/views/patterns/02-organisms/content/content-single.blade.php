@php
  global $post;
  $cf_ = '_';

  $has_sidebar = true;
  $section_offset = 'u-shift--left--1-col--at-large';
  $article_offset = 'l-grid-item--xl--3-col';

  if (get_post_meta($post->ID , $cf_.'hide_sidebar', true) == true ) {
    $has_sidebar = false;
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--l--5-col';
  }

  $is_sermon = (get_post_type() === 'wpfc_sermon');
  $sermon_audio = get_post_meta(get_the_ID(), 'sermon_audio', true);
  $sermon_duration = get_post_meta(get_the_ID(), '_wpfc_sermon_duration', true);
  $sermon_video_embed = get_post_meta(get_the_ID(), 'sermon_video', true);
  $sermon_bible_passage = get_post_meta(get_the_ID(), 'bible_passage', true);
@endphp

<section id="top" class="l-main__content l-grid l-grid--7-col {{ $section_offset }} l-grid-wrap--6-of-7 u-spacing--double--until-large">
  <div class="c-article l-grid-item l-grid-item--l--3-col {{ $article_offset }}">
    <article @php post_class('text c-article__body u-spacing @isset($GLOBALS["classes"])') @endphp>

      @if ($is_sermon)
        @if (!empty($sermon_bible_passage))
          <div class="sermon-bible-passage">
            <p>{{ esc_html($sermon_bible_passage) }}</p>
          </div>
        @endif

        @if (!empty($sermon_video_embed))
          <div class="sermon-video">
            {!! $sermon_video_embed !!}
          </div>
        @endif

        @if (!empty($sermon_audio))
          <div class="sermon-audio">
            <audio controls>
              <source src="{{ esc_url($sermon_audio) }}" type="audio/mpeg">
            </audio>
            @if (!empty($sermon_duration))
              <p>Duration: {{ esc_html($sermon_duration) }}</p>
            @endif
          </div>
        @endif
      @endif

      @php the_content() @endphp
      @include('patterns.02-organisms.sections.article-footer')
    </article>

    @include('patterns.02-organisms.sections.comments')
  </div>

  @if ($has_sidebar)
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      @php dynamic_sidebar('sidebar-posts') @endphp
    </div>
  @endif
</section>
