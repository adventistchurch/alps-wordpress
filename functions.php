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
 * Piklist Theme Settings
 */
add_filter('piklist_admin_pages', 'piklist_theme_setting_pages');
function piklist_theme_setting_pages($pages) {
   $pages[] = array(
    'page_title' => __('Custom Settings')
    ,'menu_title' => __('Settings', 'piklist')
    ,'sub_menu' => 'themes.php' //Under Appearance menu
    ,'capability' => 'manage_options'
    ,'menu_slug' => 'custom_settings'
    ,'setting' => 'alps_theme_settings'
    ,'menu_icon' => plugins_url('piklist/parts/img/piklist-icon.png')
    ,'page_icon' => plugins_url('piklist/parts/img/piklist-page-icon-32.png')
    ,'single_line' => true
    ,'default_tab' => 'Basic'
    ,'save_text' => 'Save Theme Settings'
  );
  return $pages;
}

/**
 * Breadcrumbs
 */
function wordpress_breadcrumbs() {
  $name = 'Home'; //text for the 'Home' link
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
        echo $current_before . 'Archive by category &#39;';
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
      echo 'Article';
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
      echo $current_before . 'Search results for &#39;' . get_search_query() . '&#39;' . $current_after;
    }
    elseif (is_tag()) {
      echo $current_before . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $current_after;
    }
    elseif (is_author()) {
      global $author;
      $userdata = get_userdata($author);
      echo $current_before . 'Articles posted by ' . $userdata->display_name . $current_after;
    }
    elseif (is_404()) {
      echo $current_before . 'Error 404' . $current_after;
    }
    if (get_query_var('paged')) {
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
        echo ' (';
        echo __('Page') . ' ' . get_query_var('paged');
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
      'name'               => 'Advanced Custom Fields', // The plugin name.
      'slug'               => 'advanced-custom-fields', // The plugin slug (typically the folder name).
      'source'             => get_template_directory() . '/lib/plugins/advanced-custom-fields.zip', // The plugin source.
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
      'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),
    array(
      'name'               => 'Advanced Custom Fields Pro',
      'slug'               => 'advanced-custom-fields-pro',
      'source'             => get_template_directory() . '/lib/plugins/advanced-custom-fields-pro.zip',
      'required'           => true,
    ),
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
      'tertiary_navigation' => __( 'Tertiary Navigation' ),
      'sidebar_navigation' => __( 'Sidebar Navigation' )
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
 * Markup for Yoast breadcrumbs
 */
function ss_breadcrumb_single_link( $link_output, $link ) {
    $element = 'li';
    $link_output = '<' . $element . ' class="breadcrumbs__list-item font--secondary--xs upper dib" . typeof="v:Breadcrumb">';
    if ( isset( $link['url'] ) && ( $i < ( count( $links ) - 1 ) || $paged ) ) {
        $link_output .= '<a href="' . esc_url( $link['url'] ) . '" rel="v:url" property="v:title">' . esc_html( $link['text'] ) . '</a>';
    } else {
        if ( isset( $opt['breadcrumbs-boldlast'] ) && $opt['breadcrumbs-boldlast'] ) {
            $link_output .= '<strong class="breadcrumb_last" property="v:title">' . esc_html( $link['text'] ) . '</strong>';
        } else {
            $link_output .= '<li class="breadcrumb_last" property="v:title">' . esc_html( $link['text'] ) . '</li>';
        }
    }
    $link_output .= '</' . $element . '>';
    return $link_output;
}
add_filter( 'wpseo_breadcrumb_single_link', 'ss_breadcrumb_single_link', 10, 2 );

/**
 * All SVG's through WP media uploader
 */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Sidebars
 */
function sidebars() {
  register_sidebar(
    array(
      'name' => 'Sidebar (Breakout Block)',
      'id' => 'sidebar_breakout_block',
      'before_widget' => '<div id="%2$s" class="widget sidebar__widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="font--tertiary--m theme--primary-text-color pad--btm">',
      'after_title' => '</h2>'
    )
  );
  register_sidebar(
    array(
      'name' => 'Sidebar',
      'id' => 'sidebar',
      'before_widget' => '<div id="%2$s" class="widget sidebar__widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="font--tertiary--m theme--secondary-text-color space--btm">',
      'after_title' => '</h3>'
    )
  );
}
add_action( 'widgets_init', 'sidebars' );

/**
 * Widget - 'Social Links'
 */
class social extends WP_Widget {
  // Sets up the widgets name etc
  public function __construct() {
    $widget_ops = array(
      'classname' => 'social',
      'description' => 'Social media links.',
    );
    parent::__construct('social', 'Social', $widget_ops);
  }

  // Outputs the content of the widget
  public function widget($args, $instance) {
    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }
    extract($args);
    $before_list = '<ul class="aside-nav__list spacing--quarter">';
    $after_list = '</ul>';
    $before_link = '<li class="aside-nav__list-item rel">';
    $after_link = '</a></li>';
    $link_classes = 'aside-nav__link theme--primary-text-color font--primary--xs';
    $add_hr = !empty($instance['add_hr']) ? true : false;
    $facebook = empty($instance['facebook']) ? '' : $instance['facebook'];
    $twitter = empty($instance['twitter']) ? '' : $instance['twitter'];
    $flickr = empty($instance['flickr']) ? '' : $instance['flickr'];
    $youtube = empty($instance['youtube']) ? '' : $instance['youtube'];
    $vimeo = empty($instance['vimeo']) ? '' : $instance['vimeo'];
    $email = empty($instance['email']) ? '' : $instance['email'];

    if ($add_hr) {
      echo '<hr class="theme--primary-transparent-background-color--30">';
    }
    echo $before_widget;
    echo $before_list;
    if ($facebook) {
      echo $before_link;
      echo '<a href="' . $facebook . '" class="' . $link_classes . '" target="_blank">';
      echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="-491 493.4 16.6 16.5"><path d="M-475,508.4c0,0.5-0.4,1-1,1h-3.9v-6.1h1.9l0.3-2.2h-2.3v-1.8c0-0.6,0.3-1,1-1h1.5v-2 c0,0-0.7-0.1-1.6-0.1c-2.1,0-3.2,1.2-3.2,3v1.9h-1.9v2.2h1.9v6.1h-7.4c-0.5,0-1-0.4-1-1v-13.6c0-0.5,0.4-1,1-1h13.6c0.5,0,1,0.4,1,1 V508.4z"></path></svg></span>';
      echo 'Facebook';
      echo $after_link;
    }
    if ($twitter) {
      echo $before_link;
      echo '<a href="' . $twitter . '" class="' . $link_classes . '" target="_blank">';
      echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="-491 493.2 16.6 13.8"><path d="M-474.5,495.2c-0.4,0.7-1,1.2-1.6,1.7v0.4c0,0.9-0.1,1.7-0.4,2.6c-0.2,0.9-0.6,1.7-1.1,2.5 c-0.5,0.8-1.1,1.5-1.8,2.1c-0.7,0.6-1.6,1.1-2.6,1.4c-1,0.4-2.1,0.5-3.2,0.5c-1.9,0-3.6-0.4-4.9-1.3c0.3,0,0.5,0.1,0.8,0.1 c1.4,0,2.7-0.5,4-1.5c-0.7,0-1.3-0.2-1.9-0.6c-0.5-0.4-0.9-0.9-1.1-1.6c0.2,0,0.4,0.1,0.6,0.1c0.3,0,0.6,0,0.9-0.1 c-0.7-0.1-1.3-0.5-1.8-1.1c-0.5-0.6-0.7-1.3-0.7-2v0c0.5,0.3,0.9,0.4,1.4,0.4c-1-0.6-1.4-1.5-1.4-2.7c0-0.5,0.1-1,0.4-1.6 c0.8,1,1.8,1.8,2.9,2.3c1.1,0.6,2.4,0.9,3.7,1c0-0.2-0.1-0.5-0.1-0.7c0-0.9,0.3-1.6,0.9-2.3c0.6-0.6,1.4-0.9,2.3-0.9 c0.9,0,1.7,0.3,2.4,1c0.7-0.1,1.4-0.4,2-0.8c-0.2,0.8-0.7,1.4-1.4,1.8C-475.7,495.7-475.1,495.5-474.5,495.2z"></path></svg></span>';
      echo 'Twitter';
      echo $after_link;
    }
    if ($flickr) {
      echo $before_link;
      echo '<a href="' . $flickr . '" class="' . $link_classes . '" target="_blank">';
      echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.63 44.28"><path d="M21.9,72.61a22.14,22.14,0,0,1,0-44.28A22.14,22.14,0,0,1,21.9,72.61Zm56.19,0A22.14,22.14,0,1,1,99.81,50.48,21.93,21.93,0,0,1,78.09,72.61Z" transform="translate(-0.19 -28.33)"></path></svg></span>';
      echo 'Flickr';
      echo $after_link;
    }
    if ($youtube) {
      echo $before_link;
      echo '<a href="' . $youtube . '" class="' . $link_classes . '" target="_blank">';
      echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 97.45 68.54"><path d="M97.75,30.52s-1-6.72-3.87-9.67C90.17,17,86,16.94,84.11,16.72c-13.64-1-34.09-1-34.09-1h0s-20.46,0-34.09,1C14,16.94,9.83,17,6.12,20.84c-2.92,3-3.87,9.67-3.87,9.67a147.37,147.37,0,0,0-1,15.77v7.39a147.37,147.37,0,0,0,1,15.77s1,6.72,3.87,9.67C9.83,83,14.7,82.88,16.87,83.29c7.8,0.75,33.13,1,33.13,1s20.48,0,34.11-1C86,83,90.17,83,93.88,79.13c2.92-3,3.87-9.67,3.87-9.67a147.59,147.59,0,0,0,1-15.77V46.29A147.59,147.59,0,0,0,97.75,30.52ZM39.94,62.64V35.26L66.27,49Z" transform="translate(-1.28 -15.73)"></path></svg></span>';
      echo 'Youtube';
      echo $after_link;
    }
    if ($vimeo) {
      echo $before_link;
      echo '<a href="' . $vimeo . '" class="' . $link_classes . '" target="_blank">';
      echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99 88"><path d="M99,27.12C93.48,58.87,62.57,85.75,53.27,91.89s-17.78-2.46-20.86-9C28.89,75.52,18.34,35.32,15.58,32S4.52,35.32,4.52,35.32l-4-5.37S17.34,9.46,30.15,6.9C43.74,4.18,43.72,28.15,47,41.46c3.16,12.87,5.29,20.24,8,20.24s8-7.18,13.82-18.18S68.6,22.77,57.29,29.68C61.81,2,104.54-4.62,99,27.12Z" transform="translate(-0.5 -6)"></path></svg></span>';
      echo 'Vimeo';
      echo $after_link;
    }
    if ($email) {
      echo $before_link;
      echo '<a href="mailto:' . $email . '" class="' . $link_classes . '" target="_blank">';
      echo '<span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.3 79.87"><path d="M96.92,10.25L1.64,43.83c-1.53.54-1.87,1.86-.05,2.59l20.48,8.21h0l12.15,4.87L93.49,16a0.81,0.81,0,0,1,1.14,1.14L52.15,63h0l-2.44,2.72,3.23,1.74h0L79.82,82a2.75,2.75,0,0,0,4.06-1.81L99.56,12.58C100,10.73,98.77,9.6,96.92,10.25ZM34.1,88.65c0,1.33.75,1.7,1.79,0.76C37.24,88.18,51.26,75.6,51.26,75.6L34.1,66.72V88.65Z" transform="translate(-0.35 -10.07)"></path></svg></span>';
      echo 'Email';
      echo $after_link;
    }
    echo $after_list;
    echo $after_widget;
  }

  // Outputs the options form on admin
  public function form($instance) {
    $instance = wp_parse_args((array) $instance, array(
      'facebook' => '',
      'twitter' => '',
      'flickr' => '',
      'youtube' => '',
      'vimeo' => '',
      'email' => '',
    ));
    $facebook = $instance['facebook'];
    $twitter = $instance['twitter'];
    $flickr = $instance['flickr'];
    $youtube = $instance['youtube'];
    $vimeo = $instance['vimeo'];
    $email = $instance['email'];
    ?>
      <p>
        <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook Url'); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter Url'); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr Url'); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo $flickr; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube Url'); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo $youtube; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo Url'); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo $vimeo; ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email Address'); ?>:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
      </p>
      <p>
          <input type="checkbox" id="<?php echo $this->get_field_id('add_hr'); ?>" name="<?php echo $this->get_field_name('add_hr'); ?>" <?php checked(isset($instance['add_hr']) ? $instance['add_hr'] : 0); ?> />
          <label for="<?php echo $this->get_field_id('add_hr'); ?>"><?php _e('Add a horizontal rule above the block'); ?></label>
      </p>
    <?php
  }

  // Processing widget options on save
  public function update($new_instance, $old_instance) {
    foreach ($new_instance as $key => $value) {
      $updated_instance[$key] = sanitize_text_field($value);
    }
    $instance['add_hr'] = isset($new_instance['add_hr']);
    return $updated_instance;
  }
}
add_action('widgets_init', function() {
  register_widget('social');
});


/**
 * ACF
 */
 if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_5833610cf0da2',
	'title' => 'Home: Row Block',
	'fields' => array (
		array (
			'key' => 'field_5820fccf504e4',
			'label' => 'Primary Promotional Content',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_57d9958767bcc',
			'label' => 'Primary Promotional Content',
			'name' => 'primary_promotional_content',
			'type' => 'flexible_content',
			'instructions' => 'Choose the type of content you would like to appear in the primary content column.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'button_label' => 'Add Block',
			'min' => '',
			'max' => '',
			'layouts' => array (
				array (
					'key' => '57d995f5b3096',
					'name' => 'content_block_freeform',
					'label' => 'Content Block: Freeform',
					'display' => 'block',
					'sub_fields' => array (
						array (
							'key' => 'field_57d9ceeccd5ca',
							'label' => 'Kicker',
							'name' => 'kicker',
							'type' => 'text',
							'instructions' => 'Heading to display above the block\'s title.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => 100,
						),
						array (
							'key' => 'field_57d9969167bcd',
							'label' => 'Title',
							'name' => 'title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => 200,
						),
						array (
							'key' => 'field_57d9ce29cd5c6',
							'label' => 'Image',
							'name' => 'image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array (
							'key' => 'field_57d9ce69cd5c7',
							'label' => 'Body',
							'name' => 'body',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'basic',
							'media_upload' => 0,
						),
						array (
							'key' => 'field_57d9ce88cd5c8',
							'label' => 'Button Text',
							'name' => 'button_text',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => 100,
						),
						array (
							'key' => 'field_57d9ceaccd5c9',
							'label' => 'Button URL',
							'name' => 'button_url',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => 'http://example.com',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array (
							'key' => 'field_57d9cf46cd5cb',
							'label' => 'Left Color Border',
							'name' => 'left_color_border',
							'type' => 'color_picker',
							'instructions' => 'Apply a left color border to this block.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
						),
						array (
							'key' => 'field_57d9d0a7cd5cd',
							'label' => 'Make the Image Round',
							'name' => 'make_the_image_round',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '57d9d2518d87b',
					'name' => 'content_block_reference',
					'label' => 'Content Block: Reference',
					'display' => 'block',
					'sub_fields' => array (
						array (
							'key' => 'field_57d9d3e88d885',
							'label' => 'Referenced Content',
							'name' => 'referenced_content',
							'type' => 'relationship',
							'instructions' => 'Select from a list of site posts and pages to assemble a promotional block.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'post_type' => array (
								0 => 'post',
								1 => 'page',
							),
							'taxonomy' => array (
							),
							'filters' => array (
								0 => 'search',
								1 => 'post_type',
								2 => 'taxonomy',
							),
							'elements' => array (
								0 => 'featured_image',
							),
							'min' => '',
							'max' => '',
							'return_format' => 'object',
						),
						array (
							'key' => 'field_57d9d2518d880',
							'label' => 'Button Text',
							'name' => 'button_text',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '34',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => 100,
						),
						array (
							'key' => 'field_57d9d2518d882',
							'label' => 'Left Color Border',
							'name' => 'left_color_border',
							'type' => 'color_picker',
							'instructions' => 'Apply a left color border to this block.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '33',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
						),
						array (
							'key' => 'field_57d9d2518d884',
							'label' => 'Make the Image Round',
							'name' => 'make_the_image_round',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '33',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
						),
					),
					'min' => '',
					'max' => '',
				),
			),
		),
		array (
			'key' => 'field_582359a58127a',
			'label' => 'Display Blocks in Two Columns',
			'name' => 'display_blocks_in_two_columns',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5820fcbc504e3',
			'label' => 'Secondary Promotional Content',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_58052e9db3705',
			'label' => 'Secondary Promotional Content',
			'name' => 'secondary_promotional_content',
			'type' => 'flexible_content',
			'instructions' => 'Choose the type of content you would like to appear in the secondary (right rail) content column.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'button_label' => 'Add Block',
			'min' => '',
			'max' => '',
			'layouts' => array (
				array (
					'key' => '57d995f5b3096',
					'name' => 'content_block_freeform',
					'label' => 'Content Block: Freeform',
					'display' => 'block',
					'sub_fields' => array (
						array (
							'key' => 'field_58052e9db3706',
							'label' => 'Kicker',
							'name' => 'kicker',
							'type' => 'text',
							'instructions' => 'Heading to display above the block\'s title.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => 100,
						),
						array (
							'key' => 'field_58052e9db3707',
							'label' => 'Title',
							'name' => 'title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => 200,
						),
						array (
							'key' => 'field_58052e9db3708',
							'label' => 'Image',
							'name' => 'image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array (
							'key' => 'field_58052e9db3709',
							'label' => 'Body',
							'name' => 'body',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
						),
						array (
							'key' => 'field_58052e9db370a',
							'label' => 'Button text',
							'name' => 'button_text',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => 100,
						),
						array (
							'key' => 'field_58052e9db370b',
							'label' => 'Button URL',
							'name' => 'button_url',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '50',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => 'http://example.com',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '57d9d2518d87b',
					'name' => 'content_block_reference',
					'label' => 'Content Block: Reference',
					'display' => 'block',
					'sub_fields' => array (
						array (
							'key' => 'field_58052e9db370e',
							'label' => 'Referenced Content',
							'name' => 'referenced_content',
							'type' => 'relationship',
							'instructions' => 'Select from a list of site posts and pages to assemble a promotional block.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'post_type' => array (
								0 => 'post',
								1 => 'page',
							),
							'taxonomy' => array (
							),
							'filters' => array (
								0 => 'search',
								1 => 'post_type',
								2 => 'taxonomy',
							),
							'elements' => array (
								0 => 'featured_image',
							),
							'min' => '',
							'max' => '',
							'return_format' => 'object',
						),
						array (
							'key' => 'field_58052e9db370f',
							'label' => 'Button text',
							'name' => 'button_text',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '34',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => 100,
						),
					),
					'min' => '',
					'max' => '',
				),
			),
		),
		array (
			'key' => 'field_580553c656e18',
			'label' => 'Secondary Promotional Content Column Title',
			'name' => 'column_title',
			'type' => 'text',
			'instructions' => 'Add a header to the column (optional).',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page',
				'operator' => '==',
				'value' => '55',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_581266d14421a',
	'title' => 'Pages: Primary Structured Content',
	'fields' => array (
		array (
			'key' => 'field_581276d910d72',
			'label' => 'Primary Structured Content',
			'name' => 'primary_structured_content',
			'type' => 'flexible_content',
			'instructions' => 'Choose the type of content you would like to appear in the primary content column.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'button_label' => 'Add Block',
			'min' => '',
			'max' => '',
			'layouts' => array (
				array (
					'key' => '581276e82b51a',
					'name' => 'content_block_grid',
					'label' => 'Content Block: Grid',
					'display' => 'block',
					'sub_fields' => array (
						array (
							'key' => 'field_58126aecc010a',
							'label' => 'Layout',
							'name' => 'grid_layout',
							'type' => 'select',
							'instructions' => 'Select a layout for the content.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array (
								'2up-70-30' => '2 Columns (70/30)',
								'2up-30-70' => '2 Columns (30/70)',
								'2up-50-50' => '2 Columns (50/50)',
								'3up' => '3 Columns',
							),
							'default_value' => array (
							),
							'allow_null' => 0,
							'multiple' => 0,
							'ui' => 0,
							'ajax' => 0,
							'return_format' => 'value',
							'placeholder' => '',
						),
						array (
							'key' => 'field_58126e4ea683c',
							'label' => 'Column 1',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'top',
							'endpoint' => 0,
						),
						array (
							'key' => 'field_58126deca683b',
							'label' => 'Body',
							'name' => 'grid_item_body_1',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 0,
						),
						array (
							'key' => 'field_5817af2e09cad',
							'label' => 'Image',
							'name' => 'grid_item_image_1',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array (
							'key' => 'field_581272c03c7bd',
							'label' => 'Column 2',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'top',
							'endpoint' => 0,
						),
						array (
							'key' => 'field_58127216bec3f',
							'label' => 'Body',
							'name' => 'grid_item_body_2',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 0,
						),
						array (
							'key' => 'field_5817af3a09cae',
							'label' => 'Image',
							'name' => 'grid_item_image_2',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array (
							'key' => 'field_581272e93c7be',
							'label' => 'Column 3',
							'name' => '',
							'type' => 'tab',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_58126aecc010a',
										'operator' => '==',
										'value' => '3up',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'placement' => 'top',
							'endpoint' => 0,
						),
						array (
							'key' => 'field_58127222bec40',
							'label' => 'Body',
							'name' => 'grid_item_body_3',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_58126aecc010a',
										'operator' => '==',
										'value' => '3up',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 0,
						),
						array (
							'key' => 'field_5817af0a09cac',
							'label' => 'Image',
							'name' => 'grid_item_image_3',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array (
								array (
									array (
										'field' => 'field_58126aecc010a',
										'operator' => '==',
										'value' => '3up',
									),
								),
							),
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'id',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '58135cc5f2258',
					'name' => 'content_block_image',
					'label' => 'Content Block: Image',
					'display' => 'block',
					'sub_fields' => array (
						array (
							'key' => 'field_581275f1f7417',
							'label' => 'Layout',
							'name' => 'image_layout',
							'type' => 'select',
							'instructions' => 'Select an image layout.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'choices' => array (
								'full_width' => 'Full Width',
								'breakout' => 'Breakout',
								'breakout_parallax' => 'Breakout with Parallax',
							),
							'default_value' => array (
							),
							'allow_null' => 0,
							'multiple' => 0,
							'ui' => 0,
							'ajax' => 0,
							'return_format' => 'value',
							'placeholder' => '',
						),
						array (
							'key' => 'field_58136969e0d58',
							'label' => 'Image',
							'name' => 'image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'id',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
					),
					'min' => '',
					'max' => '',
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'template-single.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));





endif;
