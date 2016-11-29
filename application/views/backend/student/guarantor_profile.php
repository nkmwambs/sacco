<hr />
<a href="<?php echo base_url();?>index.php?student/member/" 
    class="btn btn-primary pull-right">
        <i class="entypo-back"></i>
        <?php echo get_phrase('back');?>
    </a> 
<br>

<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('loan_number');?></div></th>
            <th><div><?php echo get_phrase('loan_beneficiary');?></div></th>
            <th><div><?php echo get_phrase('loan_status');?></div></th>
            <th><div><?php echo get_phrase('available_shares');?></th>
            	<th><div><?php echo get_phrase('guaranteed_amount');?></th>
            <th><div><?php echo get_phrase('guaranteed_shares_due');?></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        	$count = 1;
			$cond = "status NOT IN ('freed','declined') AND member_id=".$this->session->userdata('student_id')."";
        	$guarantor = $this->db->where($cond)->get('guarantors')->result_array();
			//print_r($guarantor);
        	foreach ($guarantor as $row):
			
			$beneficiary_loan = $this->db->get_where('loans',array('loans_id'=>$row['loans_id']))->row();	
			$beneficiary_name = $this->db->get_where('student',array('student_id'=>$beneficiary_loan->member_id))->row()->name;
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $beneficiary_loan->loans_id;?></td>
            <td><?= $beneficiary_name;?></td>
            <td><?= $beneficiary_loan->status;?></td>
            
            <!-- Net Shares = Gross Shares - Guaranteed_shares -->
            
            <?php
            	$net_shares = $this->sacco_model->net_shares($this->session->userdata('student_id'));
            ?>
            
            <td><?= $net_shares;?></td>
            
            <?php
            	$guaranteed = $this->sacco_model->guaranteed_shares_member_and_loan_id($this->session->userdata('student_id'),$beneficiary_loan->loans_id);
            ?>
            
            <td><?= $guaranteed;?></td>
            
            <!-- Shares due to be guaranteed (Loan Principle - (members shares + guaranteed shares)) -->
            
            <?php
				
				$share_guaranteed_due = $this->sacco_model->shares_due($beneficiary_loan->member_id,$beneficiary_loan->loans_id);
				
				if($share_guaranteed_due<0){
					$share_guaranteed_due = 0;
				}
            ?>
            
            <td><?= $share_guaranteed_due;?></td>

            
            <td>
                
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                       
                       <!-- Acceptance LINK -->

                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_guarantor_acceptance/<?php echo $row['guarantors_id'];?>');">
                            	<i class="entypo-check"></i>
									<?php echo get_phrase('accept');?>
                               	</a>
                       	</li> 
                       	
                       	<li class="divider"></li>
                       	
                       	<!--DeclineLink-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?student/modal_guarantor_decline/<?php echo $row['guarantors_id'];?>');">
                            	<i class="entypo-cancel"></i>
									<?php echo get_phrase('decline');?>
                               	</a>
                       	</li> 
                       	
                                           	
                    </ul>
                </div>
                
            </td>
        </tr>
        <?php endforeach;?>
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

