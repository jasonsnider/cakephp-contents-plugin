<table class="table table-bordered table-condensed table-hover table-hover table-striped">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($jscForms as $jscForm): ?>
		<tr>
			<td>
				<?php 
					echo $this->Html->link(
						$jscForm['JscForm']['name'], 
						"/admin/contents/jsc_forms/edit/{$jscForm['JscForm']['id']}"
					); 
				?>
			</td>
		</tr>
	</tbody>
	<?php endforeach; ?>
</table>

