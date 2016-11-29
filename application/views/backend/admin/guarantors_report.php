<?php
$members = $this->db->get("student");
?>
<div class="row">
<div class="col-md-12">
	<table class="table table-bordered datatable table-hover"  id="table_export">
		<thead>
			<tr>
				<th><div><?php echo get_phrase('name')?></div></th>
				<th><div><?php echo get_phrase('members_guaranteed_count');?></div></th>
				<th><div><?php echo get_phrase('total_guaranteed_amount')?></div></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php
					//foreach():
						
					//endforeach;
				?>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
	</table>
</div>	
</div>