<?php
	function adventist_new_slide() { ?>
	<div class="wrap">
		<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
		<h2><?= __("New slide", "adventist") ?></h2>
		<form action="admin.php?page=adventist_slides&action=create-slide" method="post" enctype="multipart/form-data">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="title"><?= __("Title", "adventist") ?></label>
						</th><td>
							<input type="text" name="title" class="regular-text" id="title"></td>
					</tr>

					<tr valign="top">
						<th scope="row">
						<label for="description"><?= __("Description", "adventist") ?></label></th><td>
						<textarea class="regular-text" name="description" id="description" rows="5" cols="60"></textarea></td>
					</tr>

					<tr valign="top">
						<th scope="row">
						<label for="image"><?= __("Image", "adventist") ?><br/> <?= __("Minimum image size: 739px x 457px", "adventist") ?></label></th><td>
							<input type="file" id="image" name="image">
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit">
			<input type="submit" value='<?= __("Create", "adventist") ?>' class="button button-primary" />
			</p>
		</form>
	</div>
<?php	}