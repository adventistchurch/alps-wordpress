<?php 
	include ('views/panel_view/panel_edit_view.php');
	include ('views/panel_view/options_edit_links_view.php');

	function adventist_panel_controller() {
		switch ($_GET['action']) {
			case 'update':
				foreach ($_POST as $key => $value) {
					if ( !add_option($key, $value) ) {
						update_option($key, $value);
					}
				}
				break;
			
		}


		panel_edit_view();
	}

	function adventist_links() {
		switch ($_GET['action']) {
			case 'update':
				foreach ($_POST as $key => $value) {
					if ( !add_option($key, $value) ) {
						update_option($key, $value);
					}
				}
				break;
			
		}

		links_edit_view();
	}

?>