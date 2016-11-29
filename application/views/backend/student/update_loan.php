<hr />
<a href="<?php echo base_url();?>index.php?student/member/" 
    class="btn btn-primary pull-right">
        <i class="entypo-back"></i>
        <?php echo get_phrase('back');?>
    </a> 
<br>

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered datatable">
			<caption>Your Loans</caption>
			<thead>
				<tr>
					<th>Loan ID</th>
					<th>Application Date</th>
					<th>Loan Type</th>
					<th>Loan Amount</th>
					<th>Loan Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$cond = "member_id='".$this->session->userdata('login_user_id')."' AND status IN ('new','submitted','declined')";
					$loans = $this->db->where($cond)->get('loans')->result();
					
					foreach($loans as $row):
				?>
				<tr>
					<td><?= $row->loans_id;?></td>
					<td><?= $row->application_date;?></td>
					<td><?= $row->loan_type;?></td>
					<td><?= $row->principle;?></td>
					<td><?= $row->status;?></td>
					<td>
						<a class="btn btn-icon btn-green" href="<?php echo base_url();?>index.php?student/loan/view/<?php echo $row->loans_id;?>">
							View <i class="fa fa-eye"></i>							
						</a>
						<div class="btn btn-icon btn-danger" onclick="confirm_action('<?php echo base_url();?>index.php?student/loan/delete/<?php echo $row->loans_id;?>');">Delete <i class="fa fa-undo"></i></div>
					</td>
				</tr>
				<?php
					endforeach;
				?>
			</tbody>
		</table>
	</div>

</div>

<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		
		
	});
</script>