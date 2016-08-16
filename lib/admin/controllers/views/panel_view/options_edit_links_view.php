<?php function links_edit_view() { ?>

	<div class="wrap">

	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>

	<h2><?= __("Theme Links", "adventist") ?></h2>



	<form method="post" action="admin.php?page=adventist_links&action=update">

		<table class="form-table">

			<tbody>

				<tr valign="top">

				<th scope="row">

					<label for="twitter_acc"><?= __("Twitter", "adventist") ?></label></th><td>

					<input value="<?= get_option('twitter_acc') ?>" id="twitter_acc" name="twitter_acc" type="text" class="regular-text">

				</td></tr>

				<tr valign="top">

					<th scope="row">

					<label for="facebook_acc"><?= __("Facebook", "adventist") ?></label></th><td>

					<input value="<?= get_option('facebook_acc') ?>" id="facebook_acc" name="facebook_acc" type="text" class="regular-text">

				</td></tr>

				<tr valign="top">

					<th scope="row">

					<label for="rss_acc"><?= __("RSS (default setting is /feed)", "adventist") ?></label></th><td>

					<input value="<?= get_option('rss_acc') ?>" id="rss_acc" name="rss_acc" type="text" class="regular-text">

				</td></tr>



<!-- 				<tr valign="top">

					<th scope="row">

					<label for="watch-link"><?= __("Watch", "adventist") ?></label></th><td>

					<input value="<?= get_option('watch-link') ?>" type="text" class="regular-text" id="watch-link" name="watch-link">

				</td></tr>



				<tr valign="top">

					<th scope="row">

					<label for="signup-link"><?= __("Signup", "adventist") ?></label></th><td>

					<input value="<?= get_option('signup-link') ?>" type="text" class="regular-text" id="signup-link" name="signup-link">

				</td></tr>



				<tr valign="top">

					<th scope="row">

					<label for="subscribe-link"><?= __("Subscribe", "adventist") ?></label></th><td>

					<input value="<?= get_option('subscribe-link') ?>" type="text" class="regular-text" id="subscribe-link" name="subscribe-link">

				</td></tr> -->

<!-- 

				<tr valign="top">

					<th scope="row">

					<label for="small-link"><?= __("Beliefs", "adventist") ?></label></th><td>

					<input value="<?= get_option('small-link') ?>" type="text" class="regular-text" id="small-link" name="small-link">

				</td></tr>



				<tr valign="top">

					<th scope="row">

					<label for="first-link"><?= __("Spirituality", "adventist"), " ", __("link", "adventist") ?></label></th><td>

					<input value="<?= get_option('first-link') ?>" type="text" class="regular-text" id="first-link" name="first-link">

				</td></tr>



				<tr valign="top">

					<th scope="row">

					<label for="second-link"><?= __("Vitality", "adventist"), " ", __("link", "adventist") ?></label></th><td>

					<input value="<?= get_option('second-link') ?>" type="text" class="regular-text" id="second-link" name="second-link">

				</td></tr>



				<tr valign="top">

					<th scope="row">

					<label for="third-link"><?= __("Service", "adventist"), " ", __("link", "adventist") ?></label></th><td>

					<input value="<?= get_option('third-link') ?>" type="text" class="regular-text" id="third-link" name="third-link">

				</td></tr> -->

			</tbody>

		</table>

		<p class="submit">

		<input type="submit" class="button button-primary pull-left" value='<?= __("Update", "adventist") ?>'/></p>

	</form>

</div>

<?php } ?>