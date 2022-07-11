@php
  /**
   * Posts Display View
   *
   * @var array{
   *   id: string|null ID or name of dynamic sidebar to show (default = null),
   *   isVisible: bool Show/hide the dynamic sidebar (default = true),
   * } $sidebar Sidebar props
   *
   * @var int|null $postsRootPostId Displays the custom post content on posts page (default = null)
   */

  /**
   * @var string Display posts as List
   */
  const POST_LAYOUT_LIST = 'list';
  /**
   * @var string Display posts as Grid
   */
  const POST_LAYOUT_GRID = 'grid';
  /**
   * @var string Posts layout type. Could be List or Grid
   */
  $postsLayoutType = get_alps_option('posts_grid') ? POST_LAYOUT_GRID : POST_LAYOUT_LIST;
  /**
   * @var bool Used only with Grid Posts Layout and disabled Sidebar
   */
  $postsLayoutGrid3Up = (bool)get_alps_option('posts_grid_3up');

  /**
   * @var string Display featured image as Rect
   */
  const POST_IMAGE_RECT = 'rect';
  /**
   * @var string Display featured image as Circle
   */
  const POST_IMAGE_CIRCLE = 'circle';
  /**
   * @var bool Should post featured image be displayed
   */
  $isPostImageVisible = (bool)get_alps_option('posts_image');
  /**
   * @var string Should post featured image be displayed
   */
  $postImageDisplayType = get_alps_option('posts_image_round') ? POST_IMAGE_CIRCLE : POST_IMAGE_RECT;

  /**
   * @var bool Should sidebar be displayed on this page
   */
  $hasSidebar = is_active_sidebar($sidebar['id']) && $sidebar['isVisible'];

  /**
   * @var string[] Root Section classes
   */
  $rootSectionClasses = [
    'l-main__content',
    'l-grid',
    'l-grid--7-col',
    'l-grid-wrap--6-of-7',
    'u-spacing--double--until-xxlarge',
    'u-padding--zero--sides',
    $hasSidebar ? 'u-shift--left--1-col--at-xxlarge' : 'u-shift--left--1-col--at-large',
  ];
  /**
   * @var string[] Root Article classes
   */
  $rootArticleClasses = [
    'c-article',
    'l-grid-item',
    'l-grid-item--l--4-col',
    $hasSidebar ? 'l-grid-item--xl--4-col l-grid-item--xxl--3-col' : null,
  ];

  /**
   * Content of root post
   */
  $rootArticleContent = null;
  if (get_option('page_for_posts')) {
      $rootArticleClasses = get_post_class($rootArticleClasses, $postsRootPostId);
      $rootArticleContent = get_the_content(null, false, $postsRootPostId);
  }
@endphp

<section id="top" class="{{ join(' ', $rootSectionClasses) }}">
  <article class="{{ join(' ', $rootArticleClasses) }}">
    <div class="c-article__body">
      @if (is_active_sidebar('category-top'))
        @php dynamic_sidebar('category-top') @endphp
      @endif

      @if (have_posts())
        <div class="text u-spacing--double u-space--double--top">
          {!! $rootArticleContent !!}
          @php
            if ($postsLayoutType == POST_LAYOUT_GRID) {
              if (!$hasSidebar) {
                if ($postsLayoutGrid3Up) {
                  $grid_class = "l-grid-item--6-col l-grid-item--l--4-col l-grid-item--xxl--6-col u-shift--right--1-col--at-large  u-shift--left--1-col--standard u-no-gutters ";
                  $grid_item_class = "l-grid-item--s--3-col l-grid-item--l--2-col";
                } else {
                  $grid_class = "l-grid-item--6-col l-grid-item--m--4-col u-no-gutters";
                  $grid_item_class = "l-grid-item--xs--3-col l-grid-item--m--2-col";
                }
              } else {
                $grid_class = "l-grid-item--6-col l-grid-item--l--4-col u-shift--left--1-col--standard u-no-gutters";
                $grid_item_class = "l-grid-item--s--3-col l-grid-item--l--2-col";
              }
            }
          @endphp
          @if ($postsLayoutType == POST_LAYOUT_GRID) <div class="l-grid l-grid--7-col {{ $grid_class  }}"> @endif
          @while (have_posts())
            @php
              the_post();
              $id = get_the_ID();
              $title = get_the_title($id);
              $excerpt = get_the_excerpt($id);
              $excerpt_length = 55;
              $body = get_the_content($id);
              $link = get_permalink($id);
              $cta = __("Read More", "alps");
              $category = null;
              $date = null;
              $block_class = "u-spacing--half";
              $block_title_class = "u-theme--color--darker u-font--primary--m";
              $block_meta_class = "hide";

              $thumb_id = $isPostImageVisible ? get_post_thumbnail_id($id) : false;
              if ($thumb_id) {
                $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                if ($postsLayoutType == POST_LAYOUT_GRID) {
                  $excerpt_length = 25;
                  $thumb_size = 'horiz__16x9';
                  $block_class = "c-media-block__stacked c-block__stacked u-space--right u-space--double--bottom";
                  $block_content_class = "u-border--left u-theme--border-color--darker--left";
                  $picture = true;
                  $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size)[0];
                  $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                  $image_break_m = "500";
                } else {
                  $block_img_wrap_class = ($postImageDisplayType == POST_IMAGE_CIRCLE) ? 'u-round u-space--left' : '';
                  $excerpt_length = 35;
                  $thumb_size = 'thumbnail';
                  $thumb_id = get_post_thumbnail_id($id);
                  $image = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                  $block_group_class = "u-flex--justify-start";
                  if (!$hasSidebar) {
                    $block_class = "c-media-block__row c-block__row l-grid--7-col l-grid-wrap";
                    $block_img_class = "l-grid-item l-grid-item--2-col l-grid-item--m--1-col u-padding--zero--sides";
                    $block_content_class = "l-grid-item l-grid-item--4-col l-grid-item--m--3-col";
                  } else {
                    $block_class = "c-media-block__row c-block__row l-grid--7-col l-grid-wrap l-standard-break";
                    $block_img_class = "l-grid-item l-grid-item--2-col l-grid-item--m--1-col l-grid-item--xl--1-col u-padding--zero--sides";
                    $block_content_class = "l-grid-item l-grid-item--4-col l-grid-item--m--3-col l-grid-item--xl--2-col";
                  }
                }
              } else {
                $thumb_id = null;
                if ($postsLayoutType == POST_LAYOUT_GRID) {
                  $block_class = "u-spacing u-padding--right u-space--double--bottom";
                }
              }
            @endphp

            @if ($postsLayoutType == POST_LAYOUT_GRID)<div class="l-grid-item {{ $grid_item_class }}">@endif
            @if ($thumb_id)
              @include('patterns.01-molecules.blocks.media-block')
            @else
              @include('patterns.01-molecules.blocks.content-block')
            @endif
            @if ($postsLayoutType == POST_LAYOUT_GRID)</div>@endif

          @endwhile
          @if ($postsLayoutType == POST_LAYOUT_GRID)</div>@endif
        </div>

      @php wp_reset_query() @endphp
      @if (shortcode_exists('ajax_load_more'))
        {!! do_shortcode('[ajax_load_more container_type="div" css_classes="u-spacing--double" post_type="post" category="'. get_the_category()[0]->slug .'" scroll="false" transition_container="false" button_label="Load More" posts_per_page="10" offset="10"]') !!}
      @else
        @php pagination_nav() @endphp
      @endif

      @else
        <p class="u-padding--left">{{ __('Sorry, no results were found.', 'alps') }}</p>
      @endif

      @if (is_active_sidebar('category-bottom'))
        @php dynamic_sidebar('category-bottom') @endphp
      @endif
    </div>
  </article>

  @if ($hasSidebar)
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      <div class="u-spacing--double u-padding--right">
        @php dynamic_sidebar($sidebar['id']) @endphp
      </div>
    </div>
  @endif

</section>
