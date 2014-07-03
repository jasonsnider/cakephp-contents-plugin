<?php if(!empty($jscForms)): ?>
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
<?php else: ?>
	<div class="well well-sm">
		No forms have been created. 
		<?php 
			echo $this->Html->link(
				__('Create one now.'), 
				"/admin/contents/jsc_forms/add"
			); 
		?>
	</div>
<?php endif; ?>


