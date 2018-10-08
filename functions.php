<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**
 * Comments formatting
 */
function alps_comments($comment, $args, $depth) {
  if ('div' === $args['style']) {
    $tag = 'div';
    $add_below = 'comment';
  } else {
    $tag = 'li';
    $add_below = 'div-comment';
  }
  ?>
  <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']): ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment--inner">
    <?php endif; ?>
    <div class="comment__avatar round">
      <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
    </div>
    <div class="comment__body spacing--quarter">
      <div class="comment__meta">
        <span class="byline font--secondary--s gray can-be--white theme--secondary-text-color"><?php printf( __('%s'), get_comment_author_link()); ?></span>
        <span class="divider">|</span>
        <span class="pub_date font--secondary--s gray can-be--white"><?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')) . __(' ago', 'sage'); ?></span><span class="comment__edit-link font--secondary--s theme--primary-text-color"><?php edit_comment_link( __('(Edit)', 'sage'), '  ', ''); ?></span>
      </div>
      <p class="comment__content"><?php comment_text(); ?></p>
      <?php if ($comment->comment_approved == '0'): ?>
        <p><em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sage'); ?></em><p>
      <?php endif; ?>
      <div class="comment__reply">
        <span class="font--secondary--s theme--primary-text-color">
          <?php
            comment_reply_link(
              array_merge(
                $args, array(
                  'add_below' => $add_below,
                  'depth' => $depth,
                  'max_depth' => $args['max_depth']
                )
              )
            );
          ?>
        </span>
      </div>
    </div>
  <?php if ('div' != $args['style']): ?>
    </div>
  <?php endif; ?>
<?php }

/**
 * Allowing links in captions
 */
function custom_img_caption_shortcode( $a , $attr, $content = null) {
  extract(shortcode_atts(array(
    'id'    => '',
    'align' => 'alignnone',
    'width' => '',
    'caption' => ''
  ), $attr));

  if ( 1 > (int) $width || empty($caption) )
    return $content;

  $caption = html_entity_decode( $caption );  //Here's our new line to decode the html tags

  if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

  return '<figure ' . $id . 'class="figure wp-caption ' . esc_attr($align) . '" style="width: ' . (10 + (int) $width) . 'px">'
  . do_shortcode( $content ) . '<figcaption class="figcaption"><p class="font--secondary--xs">' . $caption . '</p></figcaption></figure>';
}
//Add the filter to override the standard shortcode
add_filter( 'img_caption_shortcode', 'custom_img_caption_shortcode', 10, 3 );

/**
 * Fix for Piklist fields not saving
 */
function my_custom_init() {
  remove_post_type_support( 'post', 'custom-fields' );
  remove_post_type_support( 'page', 'custom-fields' );
}
add_action( 'init', 'my_custom_init' );

/**
 * Piklist Theme Settings
 */
add_filter('piklist_admin_pages', 'piklist_theme_setting_pages');
function piklist_theme_setting_pages($pages) {
   $pages[] = array(
    'page_title' => __('ALPS Custom Settings', 'sage')
    ,'menu_title' => __('Settings', 'sage')
    ,'sub_menu' => 'themes.php' //Under Appearance menu
    ,'capability' => 'manage_options'
    ,'menu_slug' => 'custom_settings'
    ,'setting' => 'alps_theme_settings'
    ,'menu_icon' => plugins_url('piklist/parts/img/piklist-icon.png')
    ,'page_icon' => plugins_url('piklist/parts/img/piklist-page-icon-32.png')
    ,'single_line' => true
    ,'default_tab' => 'Basic'
    ,'save_text' => 'Save ALPS Theme Settings'
  );
  return $pages;
}

/**
 * Reformat text widget
 */
add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets() {
  register_widget( 'My_Text_Widget' );
}

class My_Text_Widget extends WP_Widget_Text {
function widget( $args, $instance ) {
  extract($args);
  $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
  $text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
  echo $before_widget;
  if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
    <div class="text spacing">
      <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
    </div>
    <?php echo $after_widget;
  }
}

/**
 * Breadcrumbs
 */
function wordpress_breadcrumbs() {
  $name = __('Home', 'sage'); //text for the 'Home' link
  $current_before = '<li class="breadcrumbs__list-item font--secondary--xs upper dib"><a class="breadcrumbs__link can-be--white">';
  $current_after = '</a></li>';
  $li_class = 'breadcrumbs__list-item font--secondary--xs upper dib';
  $link_class = 'breadcrumbs__link can-be--white';
  if (!is_home() && !is_front_page() || is_paged()) {
    echo '<nav class="breadcrumbs" role="navigation"><ul class="breadcrumbs__list">';
    global $post;
    $home = get_bloginfo('url');
    echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . $home . '">' . $name . '</a></li>';
    if (is_category()) {
      global $wp_query;
      $cat_obj   = $wp_query->get_queried_object();
      $thisCat   = $cat_obj->term_id;
      $thisCat   = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) {
        echo (get_category_parents($parentCat, TRUE, ''));
        echo $current_before . __('Archive by category', 'sage') . ' &#39;';
        single_cat_title();
        echo '&#39;' . $current_after;
      }
    }
    elseif (is_day()) {
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
      echo $current_before . get_the_time('d') . $current_after;
    }
    elseif (is_month()) {
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo $current_before . get_the_time('F') . $current_after;
    }
    elseif (is_year()) {
      echo $current_before . get_the_time('Y') . $current_after;
    }
    elseif (is_single()) {
      $cat = get_the_category();
      $cat = $cat[0];
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . home_url( '/' ) . $cat->category_nicename . '">' . $cat->name . '</a></li>';
      echo $current_before;
      echo __('Article', 'sage');
      echo $current_after;
    }
    elseif (is_page() && !$post->post_parent) {
      echo $current_before;
      the_title();
      echo $current_after;
    }
    elseif (is_page() && $post->post_parent) {
      $parent_id = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) {
        echo $crumb . '';
        echo $current_before;
        the_title();
        echo $current_after;
      }
    }
    elseif (is_search()) {
      echo $current_before . __('Search results for', 'sage') . ' &#39;' . get_search_query() . '&#39;' . $current_after;
    }
    elseif (is_tag()) {
      echo $current_before . __('Posts tagged', 'sage') . ' &#39;';
      single_tag_title();
      echo '&#39;' . $current_after;
    }
    elseif (is_author()) {
      global $author;
      $userdata = get_userdata($author);
      echo $current_before . __('Articles posted by ', 'sage') . $userdata->display_name . $current_after;
    }
    elseif (is_404()) {
      echo $current_before . __('Error 404', 'sage') . $current_after;
    }
    if (get_query_var('paged')) {
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
        echo ' (';
        echo __('Page', 'sage') . ' ' . get_query_var('paged');
      }
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
        echo ')';
      }
    }
    echo '</nav>';
  }
}

/**
 * Require plugins on theme install
 */
require_once get_template_directory() . '/lib/plugin-activation.php';
add_action( 'tgmpa_register', 'adventist_register_required_plugins' );
function adventist_register_required_plugins() {
  $plugins = array(
    array(
      'name'               => 'Piklist', // The plugin name.
      'slug'               => 'piklist', // The plugin slug (typically the folder name).
      'source'             => get_template_directory() . '/lib/plugins/piklist.zip', // The plugin source.
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),
    // WordPress SEO
		array(
			'name'     => 'WordPress SEO by Yoast',
			'slug'     => 'wordpress-seo',
			'required' => false,
		)
  );
  $config = array(
    'id'           => 'adventist',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
  );
  tgmpa( $plugins, $config );
}

/**
 * Register sidebar navigation
 */
function register_my_menus() {
  register_nav_menus(
    array(
      'tertiary_navigation' => __( 'Tertiary Navigation', 'sage')
    )
  );
}
add_action( 'init', 'register_my_menus' );

/**
 * Function to add classes to Prev & Next pagination links
 */
function posts_link_attributes() {
  return 'class="pagination__page theme--secondary-background-color white"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

/**
 * Allow SVG's through WP media uploader
 */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Provides automatic updates for the WordPress theme and plugins (http://wp-updates.com/)
 */
require_once('wp-updates-theme.php');
new WPUpdatesThemeUpdater_1948( 'http://wp-updates.com/api/2/theme', basename(get_template_directory()) );
