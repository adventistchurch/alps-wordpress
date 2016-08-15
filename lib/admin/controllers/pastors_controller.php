<?php
	include ('views/pastors_view/pastor_new_view.php');
	include ('views/pastors_view/pastor_edit_view.php');
	include ('views/pastors_view/pastors_view.php');

	function adventist_pastors() { 
		if ( isset($_GET['delete_pastor']) ) {
			Pastor::delete( $_GET['delete_pastor'] );
		}

		if ( isset($_GET['action']) ) {
			switch ($_GET['action']) {
				case 'new-pastor':
					adventist_new_pastor();
					return;
					break;

				case 'edit-pastor':
					adventist_edit_pastor();
					return;
					break;

				case 'create-pastor':

					if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
					$uploadedfile = $_FILES['image'];
					$upload_overrides = array( 'test_form' => false );
					$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
					if ( $movefile ) {
					    echo "Successfully created.\n";
					    new Pastor( array(
					    		'name' => $_POST['name'],
					    		'rank' => $_POST['rank'],
					    		'phone' => $_POST['phone'],
					    		'email' => $_POST['email'],
					    		'description' => $_POST['description'],
					    		'image_url' => $movefile["url"]
					    	) );
					} else {
					    echo "Possible file upload attack!\n";
					}

					break;

				case 'update-pastor':
					$pastor = new Pastor( intval($_POST['pastor_id']) );
					$image_url = $pastor -> image_url;

					if ( $_FILES['image']["size"] > 0 ) {
						if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
						$uploadedfile = $_FILES['image'];
						$upload_overrides = array( 'test_form' => false );
						$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
						if ( $movefile ) {
						    echo "Successfully created.\n";
						    $image_url = $movefile["url"];
						} else {
						    echo "Possible file upload attack!\n";
						}
					}

				    Pastor::update($_POST['pastor_id'], array(
				    		'name' => $_POST['name'],
				    		'rank' => $_POST['rank'],
				    		'phone' => $_POST['phone'],
				    		'email' => $_POST['email'],
				    		'description' => $_POST['description'],
				    		'image_url' => $image_url
				    	) );

					break;
			}
		}

		pastors_view();

	}



?>