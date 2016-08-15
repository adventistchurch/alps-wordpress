<?php 
function pastors_view() { 
	$pastors = Pastor::all();
?>
<style type="text/css">
.row-actions {
padding: 2px 0 5px 0 !important;
}
</style>
	<div class="wrap">
		<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
		<h2><?= __("Staff Directory", "adventist") ?> <a href="admin.php?page=adventist_pastors&action=new-pastor" class="add-new-h2"><?= __("Add New", "adventist") ?></a></h2>
		<ul class="subsubsub"></ul>

		<table class="wp-list-table widefat fixed">
			<thead>
				<th scope="col" id="cb" class="manage-column column-cb check-column" style=""></th>
				<th class="manage-column"><?= __("Name", "adventist") ?></th>
				<th class="manage-column"><?= __("Description", "adventist") ?></th>
			</thead>
			<tbody>
				<?php foreach ($pastors as $pastor) { ?>
					<tr>
						<th scope="row" class="check-column"></th>
						<td class="post-title page-title column-title">
							<span class="row-title"><a href="admin.php?page=adventist_pastors&action=edit-pastor&id=<?= $pastor->id ?>"><?= $pastor->name ?></a></span>
							<div class="row-actions">
								<span class="edit">
									<a href="admin.php?page=adventist_pastors&action=edit-pastor&id=<?= $pastor->id ?>"><?= __("Edit", "adventist") ?></a> | 
								</span>
								<span class="trash"><a href="admin.php?page=adventist_pastors&delete_pastor=<?= $pastor->id ?>"><?= __("Delete", "adventist") ?></a></span>
							</div>
						</td>
						<td><?= $pastor->description ?></td>

					</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<th scope="col" id="cb" class="manage-column column-cb check-column" style=""></th>
				<th class="manage-column"><?= __("Name", "adventist") ?></th>
				<th class="manage-column"><?= __("Rank", "adventist") ?></th>
			</tfoot>
		</table>
	</div>
<?php } ?>