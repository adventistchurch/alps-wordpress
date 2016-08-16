<?php function adventist_edit_slide() { 
	$slide = new Slide( intval($_GET['id']) );
?>
	<div class="wrap">
		<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
		<h2><?= __("Edit slide", "adventist") ?></h2>
		<form action="admin.php?page=adventist_slides&action=update-slide" method="post" enctype="multipart/form-data">
			<input type="hidden" name="slide_id" value="<?= $slide -> id ?>">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="title"><?= __("Title", "adventist") ?></label>
						</th><td>
							<input value="<?= $slide -> title ?>" type="text" name="title" class="regular-text" id="title"></td>
					</tr>

					<tr valign="top">
						<th scope="row">
						<label for="description"><?= __("Description", "adventist") ?></label></th><td>
						<textarea class="regular-text" name="description" id="description" rows="5" cols="60"><?= $slide -> description ?></textarea></td>
					</tr>

					<tr valign="top">
						<th scope="row">
						<label for="image"><?= __("Image", "adventist") ?><br/> <?= __("Minimum image size: 739px x 457px", "adventist") ?></label></th><td>
							<img src="<?= $slide -> image_url ?>" /><br/>
							<input type="file" id="image" name="image">
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit">
			<input type="submit" value='<?= __("Update", "adventist") ?>' class="button button-primary" /></p>
		</form>
	</div>
<?php } ?>