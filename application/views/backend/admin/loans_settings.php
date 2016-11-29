<?php
$settings_query = $this->db->get("system")->result_array(); 
?>
<div class="row">
	<div class="col-md-6">		
		
			<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-cog"></i>
					<?php echo get_phrase("loan_fees")?>
				</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<a href="#" class="btn btn-icon btn-primary" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_fee/');"><?= get_phrase('add_fee');?><i class="entypo-plus-circled"></i></a>
				<a href="#" class="btn btn-icon btn-danger"><?= get_phrase('remove_fee');?><i class="entypo-minus-circled"></i></a>
				
				<table class="table table-striped">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Fee</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="checkbox" /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</tbody>
				</table>
				
			</div>
		</div>
		
	</div>
	
	
	<div class="col-md-6">		
		
			<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-cog"></i>
					<?php echo get_phrase("loan_application_set_up")?>
				</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
			<div class="panel-body">
				
				<table class="table table-striped">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Setting</th>
							<th>Value</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="checkbox" /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</tbody>
				</table>
				
			</div>
		</div>
		
	</div>
		
	
</div>

<div class="row">
	<div class="col-sm-12">
		
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-cog"></i>
					<?php echo get_phrase("loan_types")?>
				</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
			<div class="panel-body">
					<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_loan_type/');" 
					class="btn btn-primary pull-right">
					<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_loan_type');?>
					</a> 
					<br><br><hr>
					<table class="table table-bordered datatable table-hover" id="">
					    <thead>
					        <tr>
					            <th><div>#</div></th>
					            <th><div><?php echo get_phrase('loan_type');?></div></th>
					            <th><div><?php echo get_phrase('interest_rate');?></div></th>
					            <th><div><?php echo get_phrase('guarantors_required');?></div></th>
					            <th><div><?php echo get_phrase('loan_life');?></div></th>
					            <th><div><?php echo get_phrase('loan_limit_by_amount');?></div></th>
					            <th><div><?php echo get_phrase('loan_limit_by_ratio');?></div></th>
					            <th><div><?php echo get_phrase('active');?></div></th>
					            <th><div><?php echo get_phrase('options');?></div></th>
					        </tr>
					    </thead>
					    <tbody>
					    		<?php
					    		     			
					    			$settings = $this->db->get("loan_settings")->result_array();
					    		
					    			$count=0;
								
									foreach($settings as $row):
					    		?>
					    	<tr>
					    		<td><?php echo ++$count;?></td>
					    		<td><?php echo ucfirst($row['loan_type'])?></td>
					    		<td><?php echo $row['interest_rate']?></td>
					    		<td class="<?php if($row['guarantee_required']==='yes'){echo 'entypo-check';}else{echo 'entypo-cancel';}?>"></td>
					    		<td><?php echo $row['max_loan_life']?></td>
					    		<td><?php echo $row['loan_limit_by_amount']?></td>
					    		<td><?php echo $row['loan_limit_by_ratio']?></td>
					    		<td class="<?php if($row['active']==='yes'){echo 'entypo-check';}else{echo 'entypo-cancel';}?>"></td>
					    		<td>
					    			<div class="btn-group">
					                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
					                        Action <span class="caret"></span>
					                    </button>
					                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
					                        
					                        <!-- Loan Type EDITING LINK -->
					                        <li>
					                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_loan_type_edit/<?php echo $row['loan_settings_id'];?>');">
					                            	<i class="entypo-pencil"></i>
														<?php echo get_phrase('edit');?>
					                               	</a>
					                        </li>
					                        <li class="divider"></li>
					                       	                       	                 	
					                                 	
					                    </ul>
					                </div>
					    		</td>
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
			

			
<script type="text/javascript">
						
	jQuery(document).ready(function($)
	{
		
	    $('#label-toggle-switch').on('switch-change', function(e, data) {
	       // alert(data.value);
			
	        var set_to = "no";
	        if(data.value==true){
	        	set_to = "yes";
	        }
	        
	        	var url = '<?php echo base_url();?>index.php?admin/system_settings/loan_self_guaranteeing/'+set_to;	
				$.ajax({
						url: url,
						success: function(response)
						{
							//jQuery('#rate').val(response);
							alert(response);
						},
						error:function(response){
							alert(response);
						}
					});	
	        
	    });

	});
</script>