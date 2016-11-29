<a class="btn btn-icon btn-green" href="<?php echo base_url();?>index.php?student/loan/new/<?php echo $member_id;?>"><i class="entypo-plus-circled"></i><?= get_phrase('new_loan_application');?></a>
<a class="btn btn-icon btn-info" href="<?php echo base_url();?>index.php?student/loan/update/<?php echo $member_id;?>"><i class="entypo-plus-circled"></i><?= get_phrase('update_loan_application');?></a>
<hr>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('photo');?></div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('roll');?></div></th>
            <th><div><?php echo get_phrase('normal_loan_balance');?></div></th>
            <th><div><?php echo get_phrase('emergency_loan_balance');?></div></th>
            <th><div><?php echo get_phrase('monthly_share_rate');?></div></th>
            <th><div><?php echo get_phrase('shares');?></div></th>
            <th><div><?php echo get_phrase('guaranteed');?></div></th>
            <th><div><?php echo get_phrase('loan_payment');?></div></th> 
            <th><div><?php echo get_phrase('member_deductions');?></div></th>                       
            <th><div><?php echo get_phrase('member_value');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        	$count = 1;
			$member_id=$this->session->userdata('student_id');

			$member = $this->crud_model->get_member_details($this->session->userdata('student_id'));

				if(isset($member['active_loan']['normal']['sched_pay'])) {$normal_sched = $member['active_loan']['normal']['sched_pay'];} else {$normal_sched=0;}
				if(isset($member['active_loan']['normal']['extra_pay'])) {$normal_extra = $member['active_loan']['normal']['extra_pay'];} else {$normal_extra=0;}
			
				if(isset($member['active_loan']['emergency']['sched_pay'])) {$emergency_sched = $member['active_loan']['emergency']['sched_pay'];} else {$emergency_sched=0;}
				if(isset($member['active_loan']['emergency']['extra_pay'])) {$emergency_extra = $member['active_loan']['emergency']['extra_pay'];} else {$emergency_extra=0;}

				$total_payments = $normal_sched+$normal_extra+$emergency_sched+$emergency_extra ;	
				
				//Member Deductions
				$deductions = 0;	
																				
			
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><img src="<?php echo $this->crud_model->get_image_url('student',$this->session->userdata('student_id'));?>" class="img-circle" width="30" /></td>
            <td><?php echo $member['member']['name'];?></td>
            <td><?php echo $member['member']['roll'];?></td>
            <td><?php echo $member['loan_balance']['normal'];?></td>
            <td><?php echo $member['loan_balance']['emergency'];?>
            <td><?php echo $member['share_rate'];?></td>
            <td><?php echo $member['shares']['amount'];?></td>
            <td><?php echo $member['shares']['guaranteed'];?></td>        
            <td><?php echo $total_payments;?></td>
            <td><?php echo $deductions;?></td>                
            <td><?php echo $member['worthiness'];?></td>

            
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                       
                       <!-- Share Statement LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?student/shares/view/<?php echo $member_id;?>');">
                            	<i class="entypo-list"></i>
									<?php echo get_phrase('share_statement');?>
                               	</a>
                       	</li>

                       	
                       	<li class="divider"></li>
                       	
                       	<!--Change Share Rate Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?student/shares/rate/<?php echo $member_id;?>');">
                            	<i class="entypo-check"></i>
									<?php echo get_phrase('change_share_rate');?>
                               	</a>
                       	</li> 
                       	
                       	                       	
                       	<li class="divider"></li>
                       	
                       	<!--New Loan Application Link-->
                       	
                        <li>
                        	<a href="<?php echo base_url();?>index.php?student/loan/new/<?php echo $member_id;?>">
                            	<i class="fa fa-certificate"></i>
									<?php echo get_phrase('new_loan_application');?>
                               	</a>
                       	</li>

                       	<li class="divider"></li>
                       	
                       	<!--Update Loan Application Link-->
                       	
                        <li>
                        	<a href="<?php echo base_url();?>index.php?student/loan/update/<?php echo $member_id;?>">
                            	<i class="fa fa-exchange"></i>
									<?php echo get_phrase('update_loan_application');?>
                               	</a>
                       	</li>                       	
                       	                       	
                       	<li class="divider"></li>
                       	
                       <!--Loan Repayment Notification  Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_pay_loan/<?php echo $member_id;?>');">
                            	<i class="entypo-reply"></i>
									<?php echo get_phrase('extra_loan_repayment');?>
                               	</a>
                       	</li>
                       	
                       	<li class="divider"></li>
                       	
                       	<!--Loan Statement  Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?student/loan/view/<?php echo $member_id;?>');">
                            	<i class="entypo-list"></i>
									<?php echo get_phrase('loan_statement');?>
                               	</a>
                       	</li>
                       	
                       <li class="divider"></li>
                       	
                       	<!--Loan Guarantee Requests  Link-->
                       	
                        <li>
                        	<a href="<?php echo base_url();?>index.php?student/guarantor/profile/<?php echo $member_id;?>">
                            	<i class="entypo-palette"></i>
									<?php echo get_phrase('guarantor_profile');?>
                               	</a>
                       	</li>
                     	
                    </ul>
                </div>
                
            </td>
        </tr>

    </tbody>
</table>



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
						"mColumns": [1,2,3,4,5]
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
							datatable.fnSetColumnVis(6, false);
							
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

