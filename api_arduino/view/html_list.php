<div class="row">
	<div class="col-sm-4 col-sm-offset-4">
		<br>
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="warning">
					<th>ID Arduino</th>
					<th>Dado</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($dados as $key => $dado): ?>
					<tr title="Arduino row_id = <?php echo $dado['id'] ?>">
						<td>
							<?php echo $dado['id_arduino'] ?>
						</td>
						<td>
							<?php echo $dado['dado'] ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>	