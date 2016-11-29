
<a href="<?php echo base_url();?>index.php?admin/member/" 
class="btn btn-primary pull-right">
<i class="entypo-back"></i>
<?php echo get_phrase('back');?>
</a> 
<?php
//print_r($this->crud_model->get_member_details(13,array("submitted_loan_guarantors")));
?>
<br><br>
<div class="row">
	<div class="col-md-12">
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">

			<li>
            	<a href="#incomplete" data-toggle="tab"><i class="fa fa-stack-overflow"></i> 
					<?php echo get_phrase('incomplete_applications');?> 
					<?php
					
						$loan_incomplete_count = $this->db->get_where('loans',array('status'=>'new'))->num_rows();
						
						if($loan_incomplete_count>0):
					?>
							<span class="badge badge-danger"><?= $loan_incomplete_count;?></span>
					
						<?php endif;?>
                </a>
            </li>
            
			<li>
            	<a href="#new" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('submitted_applications');?> 
					<?php
					
						$loan_submitted_count = $this->db->get_where('loans',array('status'=>'submitted'))->num_rows();
						
						if($loan_submitted_count>0):
					?>
							<span class="badge badge-danger"><?= $loan_submitted_count;?></span>
					
						<?php endif;?>
                </a>
            </li>
            <li>
            	<a href="#deferred" data-toggle="tab"><i class="entypo-back-in-time"></i>
					<?php echo get_phrase('deferred_loans');?> 
					
					<?php
					
						$loan_deferred_count = $this->db->get_where('loans',array('status'=>'deferred'))->num_rows();
						
						if($loan_deferred_count>0):
					?>
					<span class="badge badge-danger"><?= $loan_deferred_count;?></span>
					
					<?php endif;?>
                </a>
            </li>

            <li>
            	<a href="#declined" data-toggle="tab"><i class="entypo-cancel-circled"></i>
					<?php echo get_phrase('declined_applications');?> 
					
					<?php
					
						$loan_declined_count = $this->db->get_where('loans',array('status'=>'declined'))->num_rows();
						
						if($loan_declined_count>0):
					?>
					<span class="badge badge-danger"><?= $loan_declined_count;?></span>
					
					<?php endif;?>
                </a>
            </li>

			<li class="active">
            	<a href="#active" data-toggle="tab"><i class="entypo-air"></i>
					<?php echo get_phrase('active_loans');?>
					
					<?php
					
						$loan_active_count = $this->db->get_where('loans',array('status'=>'active'))->num_rows();
						
						if($loan_active_count>0):
					?>
					<span class="badge badge-danger"><?= $loan_active_count;?></span>
					
					<?php endif;?>
                </a>
            </li>
		</ul>
    	<!------CONTROL TABS END------>
<div class="tab-content">
<!----TABLE LISTING STARTS-->
<div class="tab-pane box" id="incomplete">
<table class="table table-bordered datatable" id="">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('application_date');?></div></th>
            <th><div><?php echo get_phrase('loan_applied');?></div></th>
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
        	$new_loan = $this->db->get_where('loans',array('status'=>'new'))->result_array();
		
        	foreach ($new_loan as $row):
				
				$details = $this->crud_model->get_member_details($row['member_id']);
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $details['member']['name'];?></td>
            <td><?php echo $row['application_date']?></td>
            <td><?php echo number_format($row['principle'],2);?></td>
            <td><?php echo $row['repayment_period'];?></td>
            <td><?php echo number_format($row['sched_pay']+$row['extra_pay'],2);?></td>
            <td><?php echo number_format($details['shares']['amount'],2);?></td>
            <td><?php echo number_format($details['submitted_loan_guarantors'][$row['loan_type']],2);?></td>
            <td><?php echo number_format($details['submitted_loan_guarantor_deficit'][$row['loan_type']],2);?></td>
       
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                       <li class="divider"></li>                       	
						<!--View Loan Link-->
                       	
                        <li>
                        	<a href="<?php echo base_url();?>index.php?admin/apply_loan/<?php echo $row['loans_id'];?>">
                            	<i class="entypo-doc"></i>
									<?php echo get_phrase('view_application');?>
                               	</a>
						</li>                       	 
                       	                   	                    	
						<!--View Loan Link-->
                       	
                        <li>
                        	<a href="<?php echo base_url();?>index.php?admin/loans/delete/<?php echo $row['loans_id'];?>">
                            	<i class="entypo-cancel-squared"></i>
									<?php echo get_phrase('Delete_application');?>
                               	</a>
						</li> 
						                       	
                                            	
                    </ul>
                </div>
                
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

</div>


<div class="tab-pane box" id="new">
<table class="table table-bordered datatable" id="">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('application_date');?></div></th>
            <th><div><?php echo get_phrase('loan_applied');?></div></th>
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
        	$new_loan = $this->db->get_where('loans',array('status'=>'submitted'))->result_array();
		
        	foreach ($new_loan as $row):
				
				$details = $this->crud_model->get_member_details($row['member_id']);
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $details['member']['name'];?></td>
            <td><?php echo $row['application_date']?></td>
            <td><?php echo number_format($row['principle'],2);?></td>
            <td><?php echo $row['repayment_period'];?></td>
            <td><?php echo number_format($row['sched_pay']+$row['extra_pay'],2);?></td>
            <td><?php echo number_format($details['shares']['amount'],2);?></td>
            <td><?php echo number_format($details['submitted_loan_guarantors'][$row['loan_type']],2);?></td>
            <td><?php echo number_format($details['submitted_loan_guarantor_deficit'][$row['loan_type']],2);?></td>
       
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- Approve LINK -->
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/loans/approve/<?php echo $row['loans_id']."/".$share_deficit."/".$row['loan_type'];?>');">
                            	<i class="entypo-check"></i>
									<?php echo get_phrase('approve');?>
                               	</a>
                        				</li>
                        <li class="divider"></li>

                        <!-- Defer Loan -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_loan_defer/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-back-in-time"></i>
									<?php echo get_phrase('defer');?>
                               	</a>
                       	</li>
                       	
                       <li class="divider"></li>
                        
                        <!-- Decline LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_loan_decline/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-cancel-circled"></i>
									<?php echo get_phrase('decline');?>
                               	</a>
                       	</li>
                       	
                       <li class="divider"></li>
                       	                       	
                       	<!--Add Guarantors Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_guarantor/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-plus-circled"></i>
									<?php echo get_phrase('add_guarantor');?>
                               	</a>
                       	</li>   

                       <li class="divider"></li>                       	
						<!--View Loan Link-->
                       	
                        <li>
                        	<a href="<?php echo base_url();?>index.php?admin/apply_loan/<?php echo $row['loans_id'];?>">
                            	<i class="entypo-doc"></i>
									<?php echo get_phrase('view_application');?>
                               	</a>
						</li>                       	 
                       	                   	                    	
                       	
                                            	
                    </ul>
                </div>
                
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

</div>

<div class="tab-pane box" id="deferred">
<table class="table table-bordered datatable" id="">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('application_date');?></div></th>
            <th><div><?php echo get_phrase('loan_applied');?></div></th>
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
        	$new_loan = $this->db->get_where('loans',array('status'=>'deferred'))->result_array();
		
        	foreach ($new_loan as $row):
				
				$details = $this->crud_model->get_member_details($row['member_id']);
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $details['member']['name'];?></td>
            <td><?php echo $row['application_date']?></td>
            <td><?php echo number_format($row['principle'],2);?></td>
            <td><?php echo $row['repayment_period'];?></td>
            <td><?php echo number_format($row['sched_pay']+$row['extra_pay'],2);?></td>
            <td><?php echo number_format($details['shares']['amount'],2);?></td>
            <td><?php echo number_format($details['submitted_loan_guarantors'][$row['loan_type']],2);?></td>
            <td><?php echo number_format($details['submitted_loan_guarantor_deficit'][$row['loan_type']],2);?></td>
       
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- Approve LINK -->
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/loans/approve/<?php echo $row['loans_id']."/".$share_deficit."/".$row['loan_type'];?>');">
                            	<i class="entypo-check"></i>
									<?php echo get_phrase('approve');?>
                               	</a>
           				</li>
           				
                        <!-- Decline LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_loan_decline/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-cancel-circled"></i>
									<?php echo get_phrase('decline');?>
                               	</a>
                       	</li>           				

                       	
                       <li class="divider"></li>
                        
                       	                       	
                       	<!--Add Guarantors Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_guarantor/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-plus-circled"></i>
									<?php echo get_phrase('add_guarantor');?>
                               	</a>
                       	</li>    

						<li class="divider"></li>                       	
						<!--View Loan Link-->
                       	
                        <li>
                        	<a href="<?php echo base_url();?>index.php?admin/apply_loan/<?php echo $row['loans_id'];?>">
                            	<i class="entypo-doc"></i>
									<?php echo get_phrase('view_application');?>
                               	</a>
						</li>
                       	
                       <li class="divider"></li>
                        
                       	                       	
                       	<!--View Comments Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_loan_comments/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-eye"></i>
									<?php echo get_phrase('comments');?>
                               	</a>
                       	</li>                        	                   	                    	
                       	
                                            	
                    </ul>
                </div>
                
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>		
</div>

<div class="tab-pane box" id="declined">
<table class="table table-bordered datatable" id="">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('application_date');?></div></th>
            <th><div><?php echo get_phrase('loan_applied');?></div></th>
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
        	$new_loan = $this->db->get_where('loans',array('status'=>'declined'))->result_array();
		
        	foreach ($new_loan as $row):
				
				$details = $this->crud_model->get_member_details($row['member_id']);
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $details['member']['name'];?></td>
            <td><?php echo $row['application_date']?></td>
            <td><?php echo number_format($row['principle'],2);?></td>
            <td><?php echo $row['repayment_period'];?></td>
            <td><?php echo number_format($row['sched_pay']+$row['extra_pay'],2);?></td>
            <td><?php echo number_format($details['shares']['amount'],2);?></td>
            <td><?php echo number_format($details['submitted_loan_guarantors'][$row['loan_type']],2);?></td>
            <td><?php echo number_format($details['submitted_loan_guarantor_deficit'][$row['loan_type']],2);?></td>
       
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- Approve LINK -->
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/loans/approve/<?php echo $row['loans_id']."/".$share_deficit."/".$row['loan_type'];?>');">
                            	<i class="entypo-check"></i>
									<?php echo get_phrase('approve');?>
                               	</a>
                        				</li>
                        <li class="divider"></li>

                        <!-- Defer Loan -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_loan_defer/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-back-in-time"></i>
									<?php echo get_phrase('defer');?>
                               	</a>
                       	</li>
                       	
                       <li class="divider"></li>
                        
                       	                       	
                       	<!--Add Guarantors Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_guarantor/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-plus-circled"></i>
									<?php echo get_phrase('add_guarantor');?>
                               	</a>
                       	</li>  


                       <li class="divider"></li>
                        
                       	                       	
                       	<!--View Loan Link-->
                       	
                        <li>
                        	<a href="<?php echo base_url();?>index.php?admin/apply_loan/<?php echo $row['loans_id'];?>">
                            	<i class="entypo-doc"></i>
									<?php echo get_phrase('view_application');?>
                               	</a>
						</li>

                       	
                       <li class="divider"></li>
                        
                       	                       	
                       	<!--View Comments Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_loan_comments/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-eye"></i>
									<?php echo get_phrase('comments');?>
                               	</a>
                       	</li>                         	  
                       	                   	                    	
                       	
                                            	
                    </ul>
                </div>
                
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>	
</div>

<div class="tab-pane box active" id="active">
	<table class="table table-bordered datatable table-hover" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('application_date');?></div></th>
            <th><div><?php echo get_phrase('loan_id');?></div></th>
            <th><div><?php echo get_phrase('loan_type');?></div></th>
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
        	$active_loan = $this->db->get_where('loans',array('status'=>'active'))->result_array();
		
        	foreach ($active_loan as $row):
				
				$details = $this->crud_model->get_member_details($row['member_id']);
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $details['member']['name'];?></td>
            <td><?php echo $row['application_date']?></td>
            <td><?php echo $row['loans_id'];?></td>
            <td><?php echo ucfirst($row['loan_type']);?></td>
            <td><?php echo number_format($row['principle'],2);?></td>
            <td><?php echo number_format($this->sacco_model->loan_balance($row['loans_id']),2);?></td>
            <td><?php echo $row['repayment_period'];?></td>
            <td><?php echo number_format($this->sacco_model->scheduled_repayments($row['loans_id']),2);?></td>
            <td><?php echo number_format($this->sacco_model->gross_shares($row['member_id']),2);?></td>
            <td><?php echo number_format($this->sacco_model->guaranteed_shares_loan_id($row['loans_id']),2);?></td>
            <td><?php echo number_format($this->sacco_model->shares_due($row['loans_id'],$row['member_id']),2);?></td>
       
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

                       	<li class="divider"></li>
                       	
                       	<!-- Payment Schedule -->
                       	<li>
                        	<a href="<?php echo base_url();?>index.php?admin/loan_calculator/<?php echo $row['loans_id']."/".$row['member_id'];?>">
                            	<i class="entypo-list"></i>
									<?php echo get_phrase('loan_schedule');?>
                               	</a>
                       	</li>     
                       	
                       
                       <li class="divider"></li>
                       	<!-- Loan Statement -->
                       	<li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_adjust_scheduled_extra_pay/<?php echo $row['loans_id']."/".$row['member_id'];?>');">
                            	<i class="entypo-adjust"></i>
									<?php echo get_phrase('edit_scheduled_extra_payment');?>
                               	</a>
                       	</li>      
                       	
                       <li class="divider"></li>
                       	                       	
                       	<!--Add Schedule Link-->
                       	
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/loan_schedules/<?php echo $row['member_id'];?>/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-attach"></i>
									<?php echo get_phrase('add_loan_schedule');?>
                               	</a>
                       	</li>                       	                            	

                       	<li class="divider"></li>

                       	<!--Delete Payment Schedules Link-->
                       	                       	
                        <li>
                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/loan_schedules/delete/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-cancel"></i>
									<?php echo get_phrase('delete_loan_schedule');?>
                               	</a>
                        </li>  

                       <li class="divider"></li>
                       	                       	
                       	<!--Add Guarantors Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_guarantor/<?php echo $row['loans_id'];?>');">
                            	<i class="entypo-plus-circled"></i>
									<?php echo get_phrase('add_guarantor');?>
                               	</a>
                       	</li> 
                       	
                                            	
                    </ul>
                </div>
                
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
    </table>	
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
						"mColumns": [1,2,3,4,6]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2,3,4,6]
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

