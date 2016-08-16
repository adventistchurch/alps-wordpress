<?php



include ("lib/update_theme.php");



include ("lib/adventist_custom_menu.php");

// include ("lib/customize.php");



include ("lib/slide_model.php");

include ("lib/pastor_model.php");

include ("lib/admin/config.php");



include ("lib/widgets/sermons_widget.php");

include ("lib/widgets/small_menu_widget.php");

include ("lib/widgets/big_menu_widget.php");



add_theme_support( 'post-thumbnails' ); 


function my_admin_notice() {
	$raw_response = wp_remote_post("http://mirror1.adventistdeploy.org/get_messages.php");
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
		$response = unserialize($raw_response['body']);
		foreach ($response as $res) {
			if ($res['level'] == 'red') { ?>
		    	<div class="error">
		<?php } else if ($res['level'] == 'yellow') { ?>
				<div class="updated">
		<?php } else if ($res['level'] == 'green') { ?>
				<div class="error" style="background: #0DFF71; border-color: #008D0A;">
		<?php } ?>
		        <p><?= $res['content'] ?></p>
		    </div>
    <?php }}
}
add_action( 'admin_notices', 'my_admin_notice' );

add_filter( 'locale', 'my_theme_localized' );

function my_theme_localized( $locale ) {

	return get_option('adventist_language');

}



add_action('after_setup_theme', 'my_theme_setup');

function my_theme_setup(){

    load_theme_textdomain( 'adventist', get_template_directory().'/languages' );

}



function register_menus() {

  register_nav_menus(

    array(

      'header-menu' => __( 'Header Menu' ),

      'footer-menu' => __( 'Footer Menu' )

    )

  );

}



add_action( 'init', 'register_menus' );





function register_mysidebars() {

	register_sidebar(array(

		'name'          => __( 'Index Sidebar', "adventist"),

		'id'            => 'main-sidebar',

		'description'   => __('Widgets in this area will be shown on the left side on the index.', "adventist"),

		'before_title'  => '<h3 class="divider">',

		'after_title'   => '</h3>',

		'before_widget' => '<div class="block">',

		'after_widget'  => '</div>'

	));



	register_sidebar(array(

		'name'          => __( 'Blog Sidebar', "adventist" ),

		'id'            => 'blog-sidebar',

		'description'   => __('Widgets in this area will be shown on blog pages.', "adventist"),

		'before_title'  => '<h3 class="divider">',

		'after_title'   => '</h3>',

		'before_widget' => '<div class="block">',

		'after_widget'  => '</div>'

	));



	register_sidebar(array(

		'name'          => __( 'Pages Sidebar', "adventist" ),

		'id'            => 'pages-sidebar',

		'description'   => __('Widgets in this area will be shown on pages.', "adventist"),

		'before_title'  => '<h3 class="divider">',

		'after_title'   => '</h3>',

		'before_widget' => '<div class="block">',

		'after_widget'  => '</div>'

	));

}

add_action( 'init', 'register_mysidebars');


add_action( 'widgets_init', 'reg_widgets' );
function reg_widgets() {

	register_widget( "SermonsWidget" );

	register_widget( "SmallMenuWidget" );

	register_widget( "BigMenuWidget" );

}



function inverse_position( $string ) {

	return ($string == "right")?"left":"right";

}



require_once("lib/meta-box-class/my-meta-box-class.php");



$config = array(

	'id'             => 'new_meta_box_page',          // meta box id, unique per meta box

	'title'          => __('Theme options', "adventist"),          // meta box title

	'pages'          => array('page'),      // post types, accept custom post types as well, default is array('post'); optional

	'context'        => 'side',            // where the meta box appear: normal (default), advanced, side; optional

	'priority'       => 'high',            // order of meta box: high (default), low; optional

	'fields'         => array(),            // list of meta fields (can be added by field arrays)

	'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)

	'use_with_theme' => get_template_directory_uri() . '/lib/meta-box-class'            //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).

);



$pages_new_meta = new AT_Meta_Box($config);

$pages_new_meta->addText('adventist_bx_page_description',array('name'=> __('Description', "adventist")));

$pages_new_meta->Finish();



$config = array(

	'id'             => 'new_meta_box_post',          // meta box id, unique per meta box

	'title'          => __('Theme options', "adventist"),          // meta box title

	'pages'          => array('post'),      // post types, accept custom post types as well, default is array('post'); optional

	'context'        => 'side',            // where the meta box appear: normal (default), advanced, side; optional

	'priority'       => 'low',            // order of meta box: high (default), low; optional

	'fields'         => array(),            // list of meta fields (can be added by field arrays)

	'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)

	'use_with_theme' => get_template_directory_uri() . '/lib/meta-box-class'            //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).

);



$posts_new_meta = new AT_Meta_Box($config);

$list = Pastor::all_dropdown();

$list[0] = __("None", "adventist");

$posts_new_meta->addSelect(

	'adventist_bx_post_pastor',

	$list,

	array('name'=> __('Pastor selected', "adventist"), 'std'=> array('0'))

);

$posts_new_meta->Finish();

?>