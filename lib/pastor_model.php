<?php

	class Pastor {
		public $id;
		public $name;
		public $rank;
		public $phone;
		public $email;
		public $description;
		public $image_url;

		function __construct( $arrgs = NULL ) {
			global $wpdb;
			$table_name = $wpdb->prefix . "adventist_pastors";
			if ( is_int ($arrgs) ) {
				$aux = $wpdb -> get_results(
					$wpdb -> prepare (
						"SELECT * FROM $table_name WHERE id=%d", $arrgs
					)
				);

				$this -> id = $aux[0] -> id;
				$this -> name = $aux[0] -> name;
				$this -> rank = $aux[0] -> rank;
				$this -> phone = $aux[0] -> phone;
				$this -> email = $aux[0] -> email;
				$this -> description = $aux[0] -> description;
				$this -> image_url = $aux[0] -> image_url;
			} else if (is_array($arrgs)) {
				$wpdb -> query (
					$wpdb -> prepare (
						"INSERT INTO $table_name 
							(name, rank, phone, email, description, image_url, created_at) 
							VALUES (%s, %s, %s, %s, %s, %s, now())", 
							$arrgs["name"], $arrgs["rank"], $arrgs["phone"], $arrgs["email"], $arrgs["description"], $arrgs["image_url"]
					)
				);
			}
		}

		function all() {
			global $wpdb;
			$table_name = $wpdb->prefix . "adventist_pastors";

			return $wpdb -> get_results (
				$wpdb -> prepare (
					"SELECT * FROM $table_name", ''
				), OBJECT_K
			);

		}

		function all_dropdown() {
			global $wpdb;
			$table_name = $wpdb->prefix . "adventist_pastors";

			$aux = $wpdb -> get_results (
				$wpdb -> prepare (
					"SELECT * FROM $table_name", ''
				), OBJECT_K
			);
			$list = array();
			foreach ($aux as $key)
				$list[$key->id] = $key->name;
			
			return $list;
		}

		function update( $id, $arrgs ) {
			global $wpdb;
			$table_name = $wpdb->prefix . "adventist_pastors";
			$wpdb -> update (
				$table_name,
				$arrgs,
				array( 'id' => $id)
				);
		}

		public function delete( $id ) {
			global $wpdb;
			$table_name = $wpdb->prefix . "adventist_pastors";

			$wpdb -> query (
				$wpdb -> prepare (
					"DELETE FROM $table_name WHERE id=%d", $id
				)
			);
		}
	}


?>