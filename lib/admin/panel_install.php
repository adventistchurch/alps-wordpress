<?php



	function adventist_panel_install() {

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );



		global $wpdb;

		

		$table_name = $wpdb->prefix . "adventist_slides";

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (

		  `id` int(11) NOT NULL AUTO_INCREMENT,

		  `order` int(11) NOT NULL,

		  `title` tinytext NOT NULL,

		  `description` text,

		  `image_url` text,

		  `created_at` datetime NOT NULL,

		  PRIMARY KEY (`id`),

		  UNIQUE KEY id (id)

		);";

   		dbDelta( $sql );



		$table_name = $wpdb->prefix . "adventist_pastors";

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (

		  `id` int(11) NOT NULL AUTO_INCREMENT,

		  `name` tinytext NOT NULL,

		  `rank` tinytext NOT NULL,

		  `phone` tinytext,

		  `email` tinytext,

		  `description` text,

		  `image_url` text,

		  `created_at` datetime NOT NULL,

		  PRIMARY KEY (`id`),

		  UNIQUE KEY id (id)

		);";

   		dbDelta( $sql );





   		add_option("menu-position", "right");

   		add_option("home-callout", "left");

   		add_option("blog-sidebar-position", "left");

   		add_option("page-sidebar-positiont", "left");

   		add_option("rss_acc", "/feed");

   		add_option('home-callout-visible', 'true');

   		add_option('slider_option_visible', 'true');

		add_option('title_copyright', 'Seventh-day Adventist Church');


		if (get_page_by_title( 'Blog' ) == NULL) {
			// Create post object
			$my_post = array(
			  'post_title'    => wp_strip_all_tags( "Blog" ),
			  'post_content'  => '',
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_type'     => 'page'
			);
			wp_insert_post( $my_post );
			
			$my_post = get_page_by_title( 'Blog' );
			update_option( 'page_for_posts', $my_post->ID );
		}

		if (get_page_by_title( 'Main' ) == NULL) {
			// Create post object
			$my_post = array(
			  'post_title'    => wp_strip_all_tags( "Main" ),
			  'post_content'  => '',
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_type'     => 'page'
			);
			wp_insert_post( $my_post );

			$my_post = get_page_by_title( 'Main' );
			update_option( 'page_on_front', $my_post->ID );
			update_option( 'show_on_front', 'page' );
		}

		if (get_page_by_path( 'staff-directory' ) == NULL) {
			// Create post object
			$my_post = array(
			  'post_title'    => wp_strip_all_tags( "Staff Directory" ),
			  'post_content'  => '',
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_type'     => 'page'
			);
			wp_insert_post( $my_post );
		}
	}

?>