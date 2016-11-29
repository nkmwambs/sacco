<div class="row">
 	<div class="col-sm-6">
   		<div class="panel panel-primary" id="charts_env">
    		<div class="panel-heading">
				<div class="panel-title">Generate Transaction Slips</div>
	
				<div class="panel-options">
						
					<ul class="nav nav-tabs">
						<li  class="active"><a href="#income" data-toggle="tab">Income Slip</a></li>
						<li><a href="#expense" data-toggle="tab">Expense Slip</a></li>
					</ul>
					
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							
				</div>
			</div>
            
          		<div class="panel-body">
          			
          				<div class="tab-content">
							
            				<div class="tab-pane active" id="income">
            					<div class="row">
            					<div class="col-sm-6">
	            					<div class="form-group">
	            						<label class="control-label">Income Type</label>
	            						<select class="form-control" name="transaction_type" id="transaction_type">
	            							<option value=""><?= get_phrase('select');?></option>
	            							<option value="shares">Shares</option>
	            							<option value="repayment">Repayment</option>
	            						</select>
	            						
	            					</div><br>
            				
            						
            						<div class="btn btn-icon btn-green"><i class="entypo-attach"></i>Create</div>
            					</div>
            					</div>
            					
            					
            				</div>
            				
            				<div class="tab-pane" id="expense">
            					<div id="shares-chart-body">  </div>
            				</div>	
            					
            			
            			</div>
            			
				</div>
		</div>
	</div>
	
	<div class="col-sm-6">
		  <div class="panel panel-primary" id="charts_env">
    		<div class="panel-heading">
				<div class="panel-title">View Transaction Slips</div>
	
				<div class="panel-options">
					
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							
				</div>
			</div>
			
			<div class="panel-body">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>Date</th>
							<th>Record Type</th>
							<th>Transaction Type</th>
							<th>Amount</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$rec = $this->db->get('transaction_header')->result_object();
							
							foreach($rec as $row):
						?>	
							<tr>
								<td><?php echo $row->stamp;?></td>
								<td><?php echo $row->transaction_type;?></td>
								<td><?php echo $row->account;?></td>
								<?php
									$amount = $this->db->select_sum('amount')->get_where('transaction',array('transaction_header_id'=>$row->transaction_header_id))->row()->amount;
								?>
								<td><?php echo number_format($amount,2);?></td>
								<td><a href="#" class="btn btn-icon btn-info" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_transaction_slip/<?php echo $row->transaction_header_id;?>');"><i class="entypo-eye"></i>View Slip</a></td>
							</tr>
							
						<?php	
							endforeach;
						?>
					</tbody>
				</table>
				
			</div>
		</div>
			
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#transaction_type').change(function(){
			var type = $(this).val();
			var url = '<?php echo base_url();?>index.php?admin/create_transaction/create_income/'+type;
			
			$.ajax({
			url: url,
			success: function(response)
			{
				alert(response);
			}
		});
		});
	});
</script>
				