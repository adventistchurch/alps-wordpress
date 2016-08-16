<?php function panel_edit_view() {



if ($handle = opendir(get_template_directory() . '/languages')) {

    $list_languages = array();

    /* This is the correct way to loop over the directory. */

    while (false !== ($entry = readdir($handle))) {

    	$key = explode(".", $entry);
    	$key = $key[0];

    	if ($key != "default" && $key != "") {

        	$list_languages[$key] = $key;

        }

    }

    closedir($handle);

}



?>

	<div class="wrap">

		<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>

		<h2><?= __("Theme options", "adventist") ?></h2>



		<form method="post" action="admin.php?page=adventist&action=update">

			<table class="form-table">

				<tbody>

					<tr valign="top">

						<th scope="row">

							<label for="featured_category"><?= __("Featured Category", "adventist") ?></label></th><td>



							<?php 

							wp_dropdown_categories(array(

								'name' => 'featured_category', 

								'id' => 'featured_category',

								'selected' => get_option('featured_category')

							)); ?>

					</td></tr>



					<tr valign="top">

						<th scope="row">

							<label for="title_name"><?= __("Name (under logo)", "adventist") ?></label></th><td>



							<input value="<?= get_option('title_name') ?>" id="title_name" name="title_name" type="text" class="regular-text">

					</td></tr>

					<tr valign="top">

						<th scope="row">

							<label for="title_desc"><?= __("Description (under logo)", "adventist") ?></label></th><td>

							<input value="<?= get_option('title_desc') ?>" id="title_desc" name="title_desc" type="text" class="regular-text">

					</td></tr>


					<tr valign="top">

						<th scope="row">

							<label for="title_copyright"><?= __("Copyright", "adventist") ?></label></th><td>

							<input value="<?= get_option('title_copyright') ?>" id="title_copyright" name="title_copyright" type="text" class="regular-text">

					</td></tr>


					<tr valign="top">

						<th scope="row">

							<label for="slider_option_visible"><?= __("Slideshow Status", "adventist") ?></label></th><td>

							<select name="slider_option_visible" id="slider_option_visible">

								<option value="true" <?= (get_option('slider_option_visible') == "true")?"selected":"" ?> ><?= __("Enabled", "adventist") ?></option>

								<option value="asd" <?= (get_option('slider_option_visible') == "asd")?"selected":"" ?>> <?= __("Disabled", "adventist") ?> </option>

							</select>

					</td></tr>



					<tr valign="top">

						<th scope="row">

							<label for="slider_option"><?= __("Slideshow Display Options (if enabled)", "adventist") ?></label></th><td>

							<select name="slider_option" id="slider_option">

								<option value="" <?= (get_option('slider_option') == "")?"selected":"" ?> ><?= __("Simple", "adventist") ?></option>

								<option value="fullwidth" <?= (get_option('slider_option') == "fullwidth")?"selected":"" ?>> <?= __("Full width", "adventist") ?> </option>

								<option value="sidenav" <?= (get_option('slider_option') == "sidenav")?"selected":"" ?>> <?= __("With sidebar", "adventist") ?> </option>

							</select>

					</td></tr>



					<tr valign="top">

						<th scope="row">

							<label for="home-callout-visible"><?= __("My Whole Life / Beliefs on Homepage is", "adventist") ?></label></th><td>

							<select name="home-callout-visible" id="home-callout">

								<option value="true" <?= (get_option('home-callout-visible') == "true")?"selected":"" ?> ><?= __("Enabled", "adventist") ?></option>

								<option value="qwe" <?= (get_option('home-callout-visible') == "qwe")?"selected":"" ?>> <?= __("Disabled", "adventist") ?> </option>

							</select>

					</td></tr>



					<tr valign="top">

						<th scope="row">

							<label for="home-callout"><?= __("My Whole Life / Beliefs on Homepage Position (if enabled)", "adventist") ?></label></th><td>

							<select name="home-callout" id="home-callout">

								<option value="right" <?= (get_option('home-callout') == "right")?"selected":"" ?> ><?= __("Right", "adventist") ?></option>

								<option value="left" <?= (get_option('home-callout') == "left")?"selected":"" ?>> <?= __("Left", "adventist") ?> </option>

							</select>

					</td></tr>



					<tr valign="top">

						<th scope="row">

						<label for="blog-sidebar-position"><?= __("Sidebar Position on Blog", "adventist") ?></label></th><td>

						<select name="blog-sidebar-position" id="blog-sidebar-position">

							<option value="right" <?= (get_option('blog-sidebar-position') == "right")?"selected":"" ?> ><?= __("Right", "adventist") ?></option>

							<option value="left" <?= (get_option('blog-sidebar-position') == "left")?"selected":"" ?>><?= __("Left", "adventist") ?></option>

						</select>

					</td></tr>



					<tr valign="top">

						<th scope="row">

						<label for="page-sidebar-position"><?= __("Sidebar Position on Pages", "adventist") ?></label></th><td>

						<select name="page-sidebar-position" id="page-sidebar-position">

							<option value="right" <?= (get_option('page-sidebar-position') == "right")?"selected":"" ?> ><?= __("Right", "adventist") ?></option>

							<option value="left" <?= (get_option('page-sidebar-position') == "left")?"selected":"" ?>><?= __("Left", "adventist") ?></option>

						</select>

					</td></tr>



					<tr valign="top">

						<th scope="row">

						<label for="menu-position"><?= __("Main Menu Location", "adventist") ?></label></th><td>

						<select name="menu-position" id="menu-position">

							<option value="right" <?= (get_option('menu-position') == "right")?"selected":"" ?> ><?= __("Right", "adventist") ?></option>

							<option value="left" <?= (get_option('menu-position') == "left")?"selected":"" ?>><?= __("Left", "adventist") ?></option>

						</select>

					</td></tr>



					<tr valign="top">

						<th scope="row">

							<label for="language"><?= __("Theme Language", "adventist") ?></label><br/>

						</th>

						<td>

							<select name="adventist_language">

								<?php foreach ($list_languages as $key => $value): ?>

									<option value="<?= $key ?>" <?= ($key == get_option('adventist_language'))?"selected":"" ?>><?= $key ?></option>

								<?php endforeach; ?>

							</select>

						</td>

					</tr>

					<tr valign="top">

						<th scope="row">

							<label for="googlea_acc"><?= __("Google Analytics Account (format 'UA-XXXXX-X')", "adventist") ?></label>

						</th>

						<td>

							<input value="<?= get_option('googlea_acc') ?>" type="text" class="regular-text" id="googlea_acc" name="googlea_acc">

						</td>

					</tr>



				</tbody>

			</table>

			<p class="submit">

			<input type="submit" class="button button-primary pull-left" value='<?= __("Update", "adventist") ?>'/></p>

		</form>	

	</div>

<?php } ?>