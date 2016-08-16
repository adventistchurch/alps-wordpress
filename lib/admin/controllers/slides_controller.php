<?php
	include ('views/slides_view/slide_new_view.php');
	include ('views/slides_view/slide_edit_view.php');
	include ('views/slides_view/slides_view.php');

	function adventist_slides() { 
		if ( isset($_GET['delete_slide']) ) {
			Slide::delete( $_GET['delete_slide'] );
		}

		if ( isset($_GET['action']) ) {
			switch ($_GET['action']) {
				case 'new-slide':
					adventist_new_slide();
					return;
					break;

				case 'create-slide':

					if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
					$uploadedfile = $_FILES['image'];
					$upload_overrides = array( 'test_form' => false );
					$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

					if ( $movefile ) {
					    echo "Successfully created.\n";
					    $image_url = $movefile["url"];
					    $image = wp_get_image_editor( $image_url );
						// if ( ! is_wp_error( $image ) ) {
						//     $image->resize( 739, 457, true );
						//     $image->save( $image_url );
						// }
					    new Slide( array(
					    		'title' => $_POST['title'],
					    		'description' => $_POST['description'],
					    		'image_url' => $image_url
					    	) );
					} else {
					    echo "Possible file upload attack!\n";
					}

					break;

				case 'edit-slide':
					adventist_edit_slide();
					return;
					break;

				case 'update-slide':
					$slide = new Slide( intval($_POST['slide_id']) );
					$image_url = $slide -> image_url;

					if ( $_FILES['image']["size"] > 0 ) {
						if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
						$uploadedfile = $_FILES['image'];
						$upload_overrides = array( 'test_form' => false );
						$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
						if ( $movefile ) {
						    echo "Successfully created.\n";
						    $image_url = $movefile["url"];
						    $image = wp_get_image_editor( $image_url ); // Return an implementation that extends <tt>WP_Image_Editor</tt>

							// if ( ! is_wp_error( $image ) ) {
							//     $image->resize( 739, 457, true );
							//     $image->save( $image_url );
							// }
						} else {
						    echo "Possible file upload attack!\n";
						}
					}

				    Slide::update($_POST['slide_id'], array(
				    		'title' => $_POST['title'],
				    		'description' => $_POST['description'],
				    		'image_url' => $image_url
				    	) );

					break;
			}
		}

		slides_view();

	}



?>