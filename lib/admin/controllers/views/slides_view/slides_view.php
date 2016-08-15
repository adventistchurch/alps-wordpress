<?php
	function slides_view() {
		$slides = Slide::all();
?>
<style type="text/css">
.row-actions {
padding: 2px 0 5px 0 !important;
}
</style>
	<div class="wrap">
		<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
		<h2><?= __("Slides", "adventist") ?> <a href="admin.php?page=adventist_slides&action=new-slide" class="add-new-h2"><?= __("Add New", "adventist") ?></a></h2>
		<ul class="subsubsub"></ul>
		<table class="wp-list-table widefat fixed">
			<thead>
				<th scope="col" id="cb" class="manage-column column-cb check-column" style=""></th>
				<th class="manage-column"><?= __("Title", "adventist") ?></th>
				<th class="manage-column"><?= __("Description", "adventist") ?></th>
			</thead>
			<tbody>
				<?php foreach ($slides as $slide) { ?>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="post-title page-title column-title"><span class="row-title"><a href="admin.php?page=adventist_slides&action=edit-slide&id=<?= $slide->id ?>"><?= stripslashes($slide -> title) ?></a></span>
							<div class="row-actions">
								<span class="edit">
									<a href="admin.php?page=adventist_slides&action=edit-slide&id=<?= $slide->id ?>"><?= __("Edit", "adventist") ?></a> | 
								</span>
								<span class="trash"><a class="submitdelete" href="admin.php?page=adventist_slides&delete_slide=<?= $slide->id ?>"><?= __("Delete", "adventist") ?></a></span>
							</div>
						</td>
						<td><?= stripslashes($slide -> description) ?></td>
					</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<th scope="col" id="cb" class="manage-column column-cb check-column" style=""></th>
				<th class="manage-column"><?= __("Title", "adventist") ?></th>
				<th class="manage-column"><?= __("Description", "adventist") ?></th>
			</tfoot>
		</table>
	</div>
<?php
	}
?>