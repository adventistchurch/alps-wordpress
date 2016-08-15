<?php

	class Slide	{
		public $id;
		public $title;
		public $description;
		public $image_url;

		function __construct( $arrgs = NULL ) {
			global $wpdb;
			$table_name = $wpdb->prefix . "adventist_slides";
			if ( is_int ($arrgs) ) {
				$aux = $wpdb -> get_results(
					$wpdb -> prepare (
						"SELECT * FROM $table_name WHERE id=%d", $arrgs
					)
				);
				$this -> id = $aux[0] -> id;
				$this -> title = stripslashes($aux[0] -> title);
				$this -> description = stripslashes($aux[0] -> description);
				$this -> image_url = $aux[0] -> image_url;
			} else if (is_array($arrgs)) {
				$wpdb -> query (
					$wpdb -> prepare (
						"INSERT INTO $table_name (title, description, image_url, created_at) VALUES (%s, %s, %s, now())", $arrgs["title"], $arrgs["description"], $arrgs["image_url"]
					)
				);
			}
		}

		function all() {
			global $wpdb;
			$table_name = $wpdb->prefix . "adventist_slides";

			return $wpdb -> get_results (
				$wpdb -> prepare (
					"SELECT * FROM $table_name ORDER BY id DESC", ''
				), OBJECT_K
			);

		}

		function update( $id, $arrgs ) {
			global $wpdb;
			$table_name = $wpdb->prefix . "adventist_slides";
			$wpdb -> update (
				$table_name,
				$arrgs,
				array( 'id' => $id)
				);
		}

		public function delete( $id ) {
			global $wpdb;
			$table_name = $wpdb->prefix . "adventist_slides";

			$wpdb -> query (
				$wpdb -> prepare (
					"DELETE FROM $table_name WHERE id=%d", $id
				)
			);
		}
	}

?>