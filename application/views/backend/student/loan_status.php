<div class="row">
	<div class="col-md-12">
			
			<ul class="nav nav-tabs bordered">
				<li>
					<a href="#new" data-toggle="tab">
						<span class="hidden-xs entypo-list-add"><?php echo get_phrase('submitted_loans');?></span>
					</a>
				</li>
				<li class="active">
					<a href="#approved" data-toggle="tab">
						<span class="hidden-xs entypo-alert"><?php echo get_phrase('active_loans');?></span>
					</a>
				</li>
				
			</ul>
			
			
			<div class="tab-content">
				<div class="tab-pane" id="new">
					<?php
					$new_loan = $this->db->get_where("loans",array("status"=>"submitted"))->result_array();
				//	if(count($new_loan)>0){
					?>	
					  <table class="table table-bordered datatable"  id="table_export">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo get_phrase("application_date");?></th>
								<th><?php echo get_phrase('member_name');?></th>
								<th><?php echo get_phrase('loan_status');?></th>
								<th><?php echo get_phrase('options');?></th>
							</tr>
							
						</thead>
						<tbody>
							<?php
								$cnt = 1;
								foreach($new_loan as $row):
									$name = $this->db->get_where("student",array("student_id"=>$row['member_id']))->row()->name;
							?>
								<tr>
									<td><?php echo $cnt++;?></td>
									<td><?php echo $row['application_date'];?></td>
									<td><?php echo $name;?></td>
									<td><?php echo $row['status'];?></td>
									<td>

											<div class="btn-group">
								                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
								                        Action <span class="caret"></span>
								                    </button>
								                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
								                        
								                        <!-- Department EDITING LINK -->
								                        <li>
								                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_member/<?php echo $row['loans_id'];?>');">
								                            	<i class="entypo-pencil"></i>
																	<?php echo get_phrase('payment_schedule');?>
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
					<?php
					//	}else{
							?>
                            	<!--<p>There are no records available</p>-->

							<?php
						//}
					?>	
				</div>
		
				<div class="tab-pane active" id="approved">
					<?php
					$approved_loan = $this->db->get_where("loans",array("member_id"=>$this->session->userdata('student_id'),"status"=>"active"))->result_array();
					if(count($approved_loan)>0){
					?>	
					<table class="table table-bordered datatable">
				    <thead>
				        <tr>
				            <th><div>#</div></th>
				            <th><div><?php echo get_phrase('name');?></div></th>
				            <th><div><?php echo get_phrase('application_date');?></div></th>
				            <th><div><?php echo get_phrase('loan_applied');?></div></th>
				            <th><div><?php echo get_phrase('loan_balance');?></div></th>
				            <th><div><?php echo get_phrase('period_in_months');?></div></th>
				            <th><div><?php echo get_phrase('monthly_repayments');?></div></th>
				            <th><div><?php echo get_phrase('total_member_shares');?></div></th>
				            <th><div><?php echo get_phrase('share_guaranteed');?></div></th>
				            <th><div><?php echo get_phrase('share_guaranteed_deficit');?></div></th>
				            <th><div><?php echo get_phrase('options');?></div></th>
				        </tr>
				    </thead>
				    <tbody>
				        <?php 
				        	$count = 1;
				        	$active_loan = $this->db->get_where('loans',array("member_id"=>$this->session->userdata('student_id'),'status'=>'active'))->result_array();
						
				        	foreach ($active_loan as $row):
								//$loan_data = $this->email_model->loan_data($row['loans_id'],"active","loans",TRUE);
								$member = $this->crud_model->get_member_details($this->session->userdata('student_id'));
				        ?>
				        <tr>
				            <td><?php echo $count++;?></td>
				            <td><?php echo $member['member']['name'];?></td>
				            <td><?php echo $row['application_date']?></td>
				            <td><?php echo number_format($row['principle'],2);?></td>
				            
				            <?php 
				            	//$loan_bal = $member['loan_balance'][$row['loan_type']];
				            ?>
				           
				            <td><?php echo number_format($member['loan_balance'][$row['loan_type']],2);?></td>
				            <td><?php echo $row['repayment_period']?></td>
				            <td><?php echo number_format($row['sched_pay'],2);?></td>
				            <td><?php echo number_format($member['shares']['amount'],2);?></td>
				            <td><?php echo number_format($member['active_loan_guarantors'][$row['loan_type']],2);?></td>
				            <td><?php echo number_format($member['active_loan_guarantor_deficit'][$row['loan_type']],2);?></td>
				       
				            <td>
				                
				                <div class="btn-group">
				                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
				                        Action <span class="caret"></span>
				                    </button>
				                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
				                        
				                        <!-- Loan Pay -->
				                       	<li>
				                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_pay_loan/<?php echo $row['loans_id'];?>');">
				                            	<i class="entypo-list-add"></i>
													<?php echo get_phrase('loan_repayment');?>
				                               	</a>
				                       	</li> 
				                       	
				                       	<li class="divider"></li>
				                       	<!-- Loan Statement -->
				                       	<li>
				                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_loan_statement/<?php echo $row['loans_id']."/".$row['member_id'];?>');">
				                            	<i class="entypo-list"></i>
													<?php echo get_phrase('loan_statement');?>
				                               	</a>
				                       	</li> 
				                                              	
				                                            	
				                    </ul>
				                </div>
				                
				            </td>
				        </tr>
				        <?php endforeach;?>
				    </tbody>
				    </table>
					<?php
						}else{
							?>
                            	<p>There are no records available for the current user</p>

							<?php
						}
					?>	
				</div>				
						
			</div>


</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2,3,4,5,6,7,8,9]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2,3,4,5]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(9, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
									  datatable.fnSetColumnVis(6, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

