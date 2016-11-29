<br><br>
<?php
//echo $this->crud_model->get_type_name_by_id("student",10);
?>
<table class="table table-bordered datatable table-hover" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('loan_repayment');?></div></th>
            <th><div><?php echo get_phrase('share_contribution');?></div></th>
            <th><div><?php echo get_phrase('total_deductions');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        	$count = 1;
        	$members = $this->db->get('student')->result_array();
    foreach ($members as $row):
        	
			//$details = $this->email_model->loan_data($row['student_id'],"active","loans",FALSE);
			$details = $this->crud_model->get_member_details($row['student_id']);
			
			//print_r($details);
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $row['name'];?></td>  
            
            <?php 
				
				$payment = array_sum($details['loan_payment']);
            ?>
           
            <td><?php echo number_format($payment,2);?></td>          
            <td><?php echo number_format($details['share_rate'],2);?></td>
            <td><?php echo number_format($payment+$details['share_rate'],2);?></td>
            <td>&nbsp;</td>
         </tr>
         <?php
    endforeach;
         ?>    	
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
						"mColumns": [1,2,3,4]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2,3,4]
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
