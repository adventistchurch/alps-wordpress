<?php function adventist_edit_pastor() { 
	$pastor = new Pastor( intval($_GET['id']) );
?>
	<div class="wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?= __("Edit Staff Directory", "adventist") ?></h2>
	<form action="admin.php?page=adventist_pastors&action=update-pastor" method="post" enctype="multipart/form-data">
		<input type="hidden" value="<?= $pastor->id ?>" name="pastor_id" />
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="name"><?= __("Name", "adventist") ?></label></th>
					<td><input value="<?= $pastor -> name ?>" type="text" name="name" class="regular-text" id="name"></td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="rank"><?= __("Rank", "adventist") ?></label></th>
					<td><input value="<?= $pastor -> rank ?>" type="text" name="rank" class="regular-text" id="rank"></td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="phone"><?= __("Phone", "adventist") ?></label></th>
					<td><input value="<?= $pastor -> phone ?>" type="text" name="phone" class="regular-text" id="phone"></td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="email"><?= __("Email", "adventist") ?></label></th>
					<td><input value="<?= $pastor -> email ?>" type="email" name="email" class="regular-text" id="email"></td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="description"><?= __("Description", "adventist") ?></label></th>
					<td><textarea class="regular-text" name="description" id="description" rows="5" cols="60"><?= $pastor -> description ?></textarea></td>
				</tr>

				<tr valign="top">
					<th scope="row">
					<label for="image"><?= __("Image", "adventist") ?></label></th>
					<td>
						<img src="<?= $pastor -> image_url?>" /><br/>
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