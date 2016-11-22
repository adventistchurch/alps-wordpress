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
 * Creates options page for ACF
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
}

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
 	'key' => 'group_58051dd302385',
 	'title' => 'Home: Story Block',
 	'fields' => array (
 		array (
 			'key' => 'field_58051df550d2a',
 			'label' => 'Title',
 			'name' => 'sb_title',
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
 			'maxlength' => '',
 		),
 		array (
 			'key' => 'field_5805223d50d2b',
 			'label' => 'Subtitle',
 			'name' => 'sb_dek',
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
 			'maxlength' => '',
 		),
 		array (
 			'key' => 'field_5805226550d2c',
 			'label' => 'Background Image',
 			'name' => 'sb_background_image',
 			'type' => 'image',
 			'instructions' => 'Choose an image to display in the background (optional).',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '33',
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
 			'key' => 'field_580522b350d2d',
 			'label' => 'Thumbnail',
 			'name' => 'sb_thumbnail',
 			'type' => 'image',
 			'instructions' => 'Image to appear in the top left area of the block.',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '33',
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
 			'key' => 'field_5805232f50d2e',
 			'label' => 'Side Image',
 			'name' => 'sb_side_image',
 			'type' => 'image',
 			'instructions' => 'Optionally include an image with the body copy.',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '34',
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
 			'key' => 'field_5805240250d2f',
 			'label' => 'Is Video',
 			'name' => 'is_video',
 			'type' => 'true_false',
 			'instructions' => 'If the side image is a video thumbnail, check this box.',
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
 			'key' => 'field_5805248250d30',
 			'label' => 'Body',
 			'name' => 'sb_body',
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
 			'media_upload' => 1,
 		),
 		array (
 			'key' => 'field_580524c850d31',
 			'label' => 'URL',
 			'name' => 'sb_url',
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
 			'maxlength' => '',
 		),
 		array (
 			'key' => 'field_580524e250d32',
 			'label' => 'Call to Action Text',
 			'name' => 'sb_cta',
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
 	'key' => 'group_57cf369073a9c',
 	'title' => 'Pages: Carousel',
 	'fields' => array (
 		array (
 			'key' => 'field_57cf3697caea8',
 			'label' => 'Carousel Slides',
 			'name' => 'carousel_slides',
 			'type' => 'repeater',
 			'instructions' => 'Choose a photo and add copy to build each slide.',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'collapsed' => '',
 			'min' => '',
 			'max' => '',
 			'layout' => 'row',
 			'button_label' => 'Add Slide',
 			'sub_fields' => array (
 				array (
 					'key' => 'field_57cf3ee866bbf',
 					'label' => 'Photo',
 					'name' => 'photo',
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
 					'key' => 'field_57cf3f1366bc0',
 					'label' => 'Title',
 					'name' => 'title',
 					'type' => 'text',
 					'instructions' => 'Title of slide',
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
 				array (
 					'key' => 'field_57cf3f3f66bc1',
 					'label' => 'Subtitle',
 					'name' => 'subtitle',
 					'type' => 'text',
 					'instructions' => 'Choose an optional subtitle.',
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
 				array (
 					'key' => 'field_57cf3f5a66bc2',
 					'label' => 'Description',
 					'name' => 'description',
 					'type' => 'textarea',
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
 					'maxlength' => 200,
 					'rows' => 2,
 					'new_lines' => '',
 				),
 				array (
 					'key' => 'field_57cf40c266bc5',
 					'label' => 'Link Text',
 					'name' => 'link_text',
 					'type' => 'text',
 					'instructions' => 'Optional linked text to follow description.',
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
 					'key' => 'field_57cf410166bc6',
 					'label' => 'Link URL',
 					'name' => 'link_url',
 					'type' => 'text',
 					'instructions' => 'This can be an absolute path (http://site.com) or a relative one (/about-us).',
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
 		),
 		array (
 			'key' => 'field_57cf421d466db',
 			'label' => 'Carousel Type',
 			'name' => 'carousel_type',
 			'type' => 'radio',
 			'instructions' => 'Choose the carousel type to display.',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'choices' => array (
 				'large_format_inset' => 'Large format with text overlay',
 				'large_format_2_col_4x3' => 'Two column large format with 4:3 image ratio',
 				'large_format_2_col_16x9' => 'Two column large format with 16:9 image ratio',
 				'standard_square_inset' => 'Standard square format with text overlay',
 				'small_format_inset' => 'Small format with text overlay featured in primary content',
 			),
 			'allow_null' => 1,
 			'other_choice' => 0,
 			'save_other_choice' => 0,
 			'default_value' => 'large_format_inset',
 			'layout' => 'vertical',
 			'return_format' => 'value',
 		),
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'page',
 			),
 		),
 		array (
 			array (
 				'param' => 'page_template',
 				'operator' => '==',
 				'value' => 'default',
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

 acf_add_local_field_group(array (
 	'key' => 'group_58346896c4e35',
 	'title' => 'Settings: Theme',
 	'fields' => array (
 		array (
 			'key' => 'field_58347930b7e94',
 			'label' => 'Logo Square',
 			'name' => 'logo_square',
 			'type' => 'image',
 			'instructions' => 'Upload the default logo that will be used at the large breakpoints',
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
 			'key' => 'field_583479c08d3a5',
 			'label' => 'Logo Horizontal',
 			'name' => 'logo_horizontal',
 			'type' => 'image',
 			'instructions' => 'Upload the horizontal format of the logo that will be used at the small breakpoints',
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
 			'key' => 'field_58347988b7e95',
 			'label' => 'Logo Text',
 			'name' => 'logo_text',
 			'type' => 'image',
 			'instructions' => 'Uploaded an image of the text to appear below the main logo',
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
 			'key' => 'field_583468b22cc26',
 			'label' => 'Primary Theme Color',
 			'name' => 'primary_theme_color',
 			'type' => 'select',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'choices' => array (
 				'emperor' => 'Emperor',
 				'earth' => 'Earth',
 				'grapevine' => 'Grapevine',
 				'denim' => 'Denim',
 				'campfire' => 'Campfire',
 				'treefrog' => 'Tree Frog',
 				'ming' => 'Ming',
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
 			'key' => 'field_58346d7e2cc27',
 			'label' => 'Secondary Theme Color',
 			'name' => 'secondary_theme_color',
 			'type' => 'select',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'choices' => array (
 				'cool' => 'Cool',
 				'warm' => 'Warm',
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
 			'key' => 'field_58346dac2cc28',
 			'label' => 'Dark Theme',
 			'name' => 'dark_theme',
 			'type' => 'true_false',
 			'instructions' => 'Select if you would like the theme to be dark',
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
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'options_page',
 				'operator' => '==',
 				'value' => 'acf-options',
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
 	'key' => 'group_5805511ade866',
 	'title' => 'Sitewide: Breakout Block',
 	'fields' => array (
 		array (
 			'key' => 'field_580551295be46',
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
 			'default_value' => 'Our Beliefs',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 		array (
 			'key' => 'field_580551435be47',
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
 			'key' => 'field_580551545be48',
 			'label' => 'Body',
 			'name' => 'body',
 			'type' => 'textarea',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => 'Seventh-day Adventist beliefs are meant to permeate your whole life. Growing out of scriptures that paint a compelling portrait of God, you are invited to explore, experience and know the One who desires to make us whole.',
 			'placeholder' => '',
 			'maxlength' => '',
 			'rows' => 3,
 			'new_lines' => '',
 		),
 		array (
 			'key' => 'field_580551715be49',
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
 			'default_value' => '/beliefs',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 		array (
 			'key' => 'field_5805518c5be4a',
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
 			'default_value' => 'Read More',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'post',
 			),
 			array (
 				'param' => 'post_category',
 				'operator' => '!=',
 				'value' => 'category:news',
 			),
 			array (
 				'param' => 'post_category',
 				'operator' => '!=',
 				'value' => 'category:articles',
 			),
 		),
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'page',
 			),
 			array (
 				'param' => 'page_template',
 				'operator' => '!=',
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

 acf_add_local_field_group(array (
 	'key' => 'group_57ebe99a09eb8',
 	'title' => 'Sitewide: Feature Image Settings',
 	'fields' => array (
 		array (
 			'key' => 'field_57ebe9b1d773c',
 			'label' => 'Hide Featured Image',
 			'name' => 'hide_featured_image',
 			'type' => 'true_false',
 			'instructions' => 'Check this to hide the featured image from the page, but keep it in all meta fields.',
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
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'post',
 			),
 		),
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'page',
 			),
 		),
 	),
 	'menu_order' => 0,
 	'position' => 'side',
 	'style' => 'default',
 	'label_placement' => 'top',
 	'instruction_placement' => 'label',
 	'hide_on_screen' => '',
 	'active' => 1,
 	'description' => '',
 ));

 acf_add_local_field_group(array (
 	'key' => 'group_582223c4db1a2',
 	'title' => 'Sitewide: Featured Video',
 	'fields' => array (
 		array (
 			'key' => 'field_582223cb05ced',
 			'label' => 'Video Url',
 			'name' => 'video_url',
 			'type' => 'url',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => array (
 				array (
 					array (
 						'field' => '',
 						'operator' => '==',
 					),
 				),
 			),
 			'wrapper' => array (
 				'width' => '',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 		),
 		array (
 			'key' => 'field_582223e505cee',
 			'label' => 'Video Caption',
 			'name' => 'video_caption',
 			'type' => 'textarea',
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
 			'maxlength' => '',
 			'rows' => '',
 			'new_lines' => '',
 		),
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'post',
 			),
 			array (
 				'param' => 'post_format',
 				'operator' => '==',
 				'value' => 'video',
 			),
 		),
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'page',
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
 	'key' => 'group_57d994d465c85',
 	'title' => 'Sitewide: Template Additions',
 	'fields' => array (
 		array (
 			'key' => 'field_57d994e667bca',
 			'label' => 'Display Title',
 			'name' => 'display_title',
 			'type' => 'text',
 			'instructions' => 'Set a page title different from the default title.',
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
 			'maxlength' => '',
 		),
 		array (
 			'key' => 'field_5820cb9697242',
 			'label' => 'Kicker',
 			'name' => 'kicker',
 			'type' => 'text',
 			'instructions' => 'Enter a kicker that will display above the title.',
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
 			'maxlength' => '',
 		),
 		array (
 			'key' => 'field_57d9950f67bcb',
 			'label' => 'Subtitle',
 			'name' => 'subtitle',
 			'type' => 'textarea',
 			'instructions' => 'Appears coupled with Title/Display Title. Cannot Exceed 200 characters.',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '50',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'maxlength' => 200,
 			'rows' => 2,
 			'new_lines' => '',
 		),
 		array (
 			'key' => 'field_57d9e60979f4d',
 			'label' => 'Intro',
 			'name' => 'intro',
 			'type' => 'textarea',
 			'instructions' => 'Intro paragraph to be included above page/post body content and used in referenced blocks.',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '50',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'maxlength' => '',
 			'rows' => 5,
 			'new_lines' => '',
 		),
 		array (
 			'key' => 'field_57e043a1a1473',
 			'label' => 'Header Background Image',
 			'name' => 'header_background_image',
 			'type' => 'image',
 			'instructions' => 'Add a background image to the header (not available on all pages).',
 			'required' => 0,
 			'conditional_logic' => 0,
 			'wrapper' => array (
 				'width' => '50',
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
 			'key' => 'field_5820fb89fb178',
 			'label' => 'Header Block Text',
 			'name' => 'header_block_text',
 			'type' => 'true_false',
 			'instructions' => 'Check if you would like to include a block of text in the header.',
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
 		array (
 			'key' => 'field_5820fbbefb179',
 			'label' => 'Header Block Title',
 			'name' => 'header_block_title',
 			'type' => 'text',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => array (
 				array (
 					array (
 						'field' => 'field_5820fb89fb178',
 						'operator' => '==',
 						'value' => '1',
 					),
 				),
 			),
 			'wrapper' => array (
 				'width' => '50',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 		array (
 			'key' => 'field_5820fbddfb17a',
 			'label' => 'Header Block Subtitle',
 			'name' => 'header_block_subtitle',
 			'type' => 'text',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => array (
 				array (
 					array (
 						'field' => 'field_5820fb89fb178',
 						'operator' => '==',
 						'value' => '1',
 					),
 				),
 			),
 			'wrapper' => array (
 				'width' => '50',
 				'class' => '',
 				'id' => '',
 			),
 			'default_value' => '',
 			'placeholder' => '',
 			'prepend' => '',
 			'append' => '',
 			'maxlength' => '',
 		),
 		array (
 			'key' => 'field_5820fbe8fb17b',
 			'label' => 'Header Block Image',
 			'name' => 'header_block_image',
 			'type' => 'image',
 			'instructions' => '',
 			'required' => 0,
 			'conditional_logic' => array (
 				array (
 					array (
 						'field' => 'field_5820fb89fb178',
 						'operator' => '==',
 						'value' => '1',
 					),
 				),
 			),
 			'wrapper' => array (
 				'width' => '50',
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
 	),
 	'location' => array (
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'post',
 			),
 		),
 		array (
 			array (
 				'param' => 'post_type',
 				'operator' => '==',
 				'value' => 'page',
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
