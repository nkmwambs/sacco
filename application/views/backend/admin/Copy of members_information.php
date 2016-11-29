<hr/>
<div class="col-sm-2 pull-right">
	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/member_add/');" 
	class="btn btn-primary ">
	<i class="entypo-plus-circled"></i>
	<?php echo get_phrase('admit_student');?>
	</a> 
</div>

<div class="col-sm-2 pull-right">
<a class="btn btn-icon btn-info" href="<?php echo base_url();?>index.php?admin/member/single/"><i class="fa fa-user-md"></i><?= get_phrase('user_profiles')?></a>
</div>
<?php
	//print_r($this->crud_model->get_member_details("8",array('deductions')));
?>
<br><br>
<div class="row">
	<div class="col-md-12">
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#active" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('active_members');?>
                    	</a></li>
			<li>
            	<a href="#inactive" data-toggle="tab"><i class="entypo-cancel"></i>
					<?php echo get_phrase('inactive_members');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
<div class="tab-content">
<!----TABLE LISTING STARTS-->
<div class="tab-pane box active" id="active">
<table class="table table-bordered datatable table-hover" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('photo');?></div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('roll');?></div></th>
            <th><div><?php echo get_phrase('loan_balance');?></div></th>
            <th><div><?php echo get_phrase('loan_payment');?></div></th>            
            <th><div><?php echo get_phrase('monthly_share_rate');?></div></th>
            <th><div><?php echo get_phrase('member_deductions');?></div></th>            
            <th><div><?php echo get_phrase('total_shares');?></div></th>
            <th><div><?php echo get_phrase('guaranteed_shares');?></div></th>
            <th><div><?php echo get_phrase('member_value');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        	$count = 1;
        	$members = $this->db->get("student")->result_array();
        	foreach ($members as $row):
				
				$details = $this->crud_model->get_member_details($row['student_id']);
				
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['roll'];?></td> 
            <td><?php echo array_sum($details['loan_balance']);?></td>
            <td><?php echo array_sum($details['loan_payment']);?></td>              
            <td><?php echo $details['share_rate'];?></td>
            <td><?php echo $details['deductions']?></td>            
            <td><?php echo $details['shares']['amount'];?></td>
            <td><?php echo $details['shares']['guaranteed'];?></td>
            <td><?php echo $details['worthiness'];?></td>

            
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- Member EDITING LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_member/<?php echo $row['student_id'];?>');">
                            	<i class="entypo-pencil"></i>
									<?php echo get_phrase('edit');?>
                               	</a>
                        </li>
                        <li class="divider"></li>
                        
                        <!-- Deactivate Member LINK -->
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/member/deactivate/<?php echo $row['student_id'];?>');">
                            	<i class="entypo-trash"></i>
									<?php echo get_phrase('deactivate_member');?>
                               	</a>
                       	</li>
                       	
                       	<li class="divider"></li>
                       
                       <!-- Share Statement LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_share_statement/<?php echo $row['student_id'];?>');">
                            	<i class="entypo-list"></i>
									<?php echo get_phrase('share_statement');?>
                               	</a>
                       	</li>
                       	
                       	<li class="divider"></li>
                       	
                       	<!--Change Share Rate Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_share_rate/<?php echo $row['student_id'];?>');">
                            	<i class="entypo-check"></i>
									<?php echo get_phrase('change_share_rate');?>
                               	</a>
                       	</li> 

                       	<li class="divider"></li>
                       	                       	
                       	<!--Take Share Link-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_share/<?php echo $row['student_id'];?>');">
                            	<i class="entypo-list-add"></i>
									<?php echo get_phrase('share_contribution');?>
                               	</a>
                       	</li>     
                       	
                       
                       <li class="divider"></li>
                       	                       	
                       	<!--Add Loan Link-->
                       	
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/loans/apply/<?php echo $row['student_id'];?>');">
                            	<i class="entypo-window"></i>
									<?php echo get_phrase('add_loan');?>
                               	</a>
                       	</li>  
                       	
                       <li class="divider"></li>
                       	                       	
                       	<!--Add Payments Link-->
                       	
                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/add_loan_schedules/<?php echo $row['student_id'];?>');">
                            	<i class="entypo-attach"></i>
									<?php echo get_phrase('add_loan_schedule');?>
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


<div class="tab-pane box" id="inactive">
	<table class="table table-bordered datatable" id="">
		<thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('photo');?></div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('roll');?></div></th>
            <th><div><?php echo get_phrase('normal_loan');?></div></th>
            <th><div><?php echo get_phrase('emergency_loan');?></div></th>
            <th><div><?php echo get_phrase('shares');?></div></th>
            <th><div><?php echo get_phrase('guaranteed');?></div></th>
            <th><div><?php echo get_phrase('member_value');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        	$count = 1;
        	$inactive_members = $this->db->get_where("student",array("active"=>"no"))->result_array();
        	foreach ($inactive_members as $row):
				
				$inactive_details = $this->crud_model->get_member_details($row['student_id']);
        	
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['roll'];?></td> 
            <td>&nbsp</td>
            <td>&nbsp</td>              
            <td>&nbsp</td>
            <td>&nbsp</td>            
            <td>&nbsp;</td>

            
            <td>&nbsp;</td></tr>
            <?php
            	endforeach;
            ?>
            </tbody>
	</table>
</div>

</div>
</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"aaSorting": [[ 2, "asc" ]],
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					"select_all",
					"select_none",
					//{
						//"sExtends":    "collection",
						//"sButtonText": "Export",
						//"aButtons":    [ "csv", "xls", "pdf","print" ]
					//},
					
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

