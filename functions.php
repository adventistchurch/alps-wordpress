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
 * Function to add classes to Prev & Next pagination links
 */
function posts_link_attributes() {
  return 'class="pagination__page theme--secondary-background-color white"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');


/**
 * Custom menu output.
 */
function alps_walker_nav_menu_start_el($item_output, $item, $depth, $args) {
  $menu_locations = get_nav_menu_locations();

  // Primary navigation customizations.
  if (has_term($menu_locations['primary_navigation'], 'nav_menu', $item)) {
    $item_output = preg_replace('/<a /', '<a class="primary-nav__link theme--primary-text-color" ', $item_output, 1);
    // Add custom "active" class to active links.
    if ($item->current == 1){
      $item_output = preg_replace('/<a /', '<a class="primary-nav__link theme--secondary-text-color active" ', $item_output, 1);
    }
    // If the link is within a submenu, update classes.
    if ($depth === 1){
      $item_output = preg_replace('/<a /', '<a class="primary-nav__subnav__link theme--primary-text-color" ', $item_output, 1);
    }
  }
  // Secondary navigation customizations.
  if (has_term($menu_locations['secondary_navigation'], 'nav_menu', $item)) {
    $item_output = preg_replace('/<a /', '<a class="secondary-nav__link theme--secondary-text-color" ', $item_output, 1);
    // Add custom "active" class to active links.
    if ($item->current == 1){
      $item_output = preg_replace('/<a /', '<a class="secondary-nav__link theme--secondary-text-color active" ', $item_output, 1);
    }
    // Add "js-toggle-parent" class to first link item (should be language dropdown).
    if ($item->menu_order == 1){
      $item_output = preg_replace('/<a /', '<a class="secondary-nav__link theme--secondary-text-color js-toggle-parent" ', $item_output, 1);
    }
    // If the link is within a submenu, update classes.
    if ($depth === 1){
      $item_output = preg_replace('/<a /', '<a class="secondary-nav__subnav__link theme--secondary-background-hover-color--at-medium" ', $item_output, 1);
    }
  }
  // Footer navigation customizations.
  if (has_term($menu_locations['footer_navigation'], 'nav_menu', $item)) {
    $item_output = preg_replace('/<a /', '<a class="footer__nav-link font--secondary link--white" ', $item_output, 1);
  }
  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'alps_walker_nav_menu_start_el', 10, 4);

/**
 * ACF
 */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_581266d14421a',
	'title' => 'Posts: Primary Structured Content',
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
							'name' => 'grid_item_1',
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
							'name' => 'grid_item_2',
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
							'name' => 'grid_item_3',
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
							'media_upload' => 1,
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
								'breakout' => 'Breakout with Parallax',
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
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
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
