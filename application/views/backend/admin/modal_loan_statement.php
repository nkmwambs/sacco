<?php 
$pay_data	=	$this->db->get_where('repayment' , array('loans_id' => $param2) )->result_array();

$member_name = $this->db->get_where("student",array("student_id"=>$param3))->row()->name;
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('loan_statement');?>
            	</div>
            </div>
			
			<center>
			    <a onClick="PrintElem('#statement_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
			        Print Statement
			        <i class="entypo-print"></i>
			    </a>
			</center>
			
			    <br><br>
				
				    <div id="statement_print">
				    	<?php

							$loan_data = $this->db->get_where("loans",array("loans_id"=>$param2))->result_array();
							
							$extra_pay = 0;
							$intr = 0;
							$extra_pay_arr = $this->db->select_sum('extra_pay')->get_where("repayment",array("loans_id"=>$param2))->result_array();
							$intr_arr = $this->db->select_sum('intr')->get_where("repayment",array("loans_id"=>$param2))->result_array();
							
							if(count($extra_pay_arr)>0){
								$extra_pay=$extra_pay_arr[0]['extra_pay'];						
							}
							
							if(count($intr_arr)>0){
								$intr=$intr_arr[0]['intr'];
							}
							
				    	?>
				        <table width="100%" border="0">
				            <tr>
				                <td align="right">
				                	<h5><?php echo get_phrase('member_name'); ?> : <?php echo $member_name;?></h5><br>
				                <?php
				                	foreach($loan_data as $header):
				                ?>
				                	
				                    <h5><?php echo get_phrase('scheduled_payment'); ?> : <?php echo number_format($header['sched_pay'],2);?></h5><br>
				                    <h5><?php echo get_phrase('scheduled_number_of_payments'); ?> : <?php echo $header['repayment_period'];?></h5><br>
				                    
				                    <?php 
				                    //Calculate Actual Number Of Repayments
										$actual_num_of_payments = $header['repayment_period']-($extra_pay/$header['sched_pay']); 
									?>
				                    
				                    <h5><?php echo get_phrase('actual_number_of_payments'); ?> : <?php echo number_format($actual_num_of_payments,0);?></h5><br>
				                    <h5><?php echo get_phrase('total_early_payments'); ?> : <?php echo number_format($extra_pay,2);?></h5><br>
				                    <h5><?php echo get_phrase('total_interest'); ?> : <?php echo number_format($intr,2);?></h5><br>
				                <?php
				                	endforeach;
				                ?>
				                </td>
				            </tr>
				        </table>
				        <hr>
				
						<table class="table table-bordered datatable" id="table_export">
						    <thead>

						        <tr>
						            <th><div>#</div></th>
						            <th><div><?php echo get_phrase('payment_date');?></div></th>
						            <th><div><?php echo get_phrase('beginning_balance');?></div></th>
						            <th><div><?php echo get_phrase('scheduled_payment');?></div></th>
						            <th><div><?php echo get_phrase('extra_payment');?></div></th>
						            <th><div><?php echo get_phrase('total_payment');?></div></th>
						            <th><div><?php echo get_phrase('interest');?></div></th>
						            <th><div><?php echo get_phrase('ending_balance');?></div></th>
						        </tr>

						    </thead>
						    <tbody>
						    	<?php
						    		$cnt = 1;
						    		foreach ($pay_data as $row):
						    	?>
						    		<tr>
						    			<td><?php echo $cnt++;?></td>
						    			<td><?php echo $row['repayment_date'];?></td>
						    			<td><?php echo $row['beg_bal'];?></td>
						    			<td><?php echo $row['sched_pay'];?></td>
						    			<td><?php echo $row['extra_pay'];?></td>
						    			<td><?php echo $row['extra_pay']+$row['sched_pay'];?></td>
						    			<td><?php echo $row['intr'];?></td>
						    			<td><?php echo $row['end_bal'];?></td>
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

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'Share_Statement', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Share Statement</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>