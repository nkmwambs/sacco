<a href="<?php echo base_url();?>index.php?admin/loans/" 
class="btn btn-primary pull-right">
<i class="entypo-back"></i>
<?php echo get_phrase('back');?>
</a> 
<br><br>
<?php
//$princ = 350000;

$arr = $this->db->get_where("loans",array("loans_id"=>$loans_id))->result_array();

foreach($arr as $values):
	$princ = $values['principle'];
	$term = $values['repayment_period'];
	$efrate = ($values['rate'])/12;
	$repayments = $values['sched_pay'];
	$extra_pay = $values['extra_pay'];
endforeach;





//$repayments = $princ * ($efrate/(1-pow((1+$efrate),-$term)));

//Testing - Extra Payments

//$extra_pay = 0;//12000;

//Additional Extra-Pay at Pmt 5

$addition_extra_pay = array();

$payments = $this->db->get_where("repayment",array("loans_id"=>$loans_id))->result_array();

$cnt=0;
//foreach($payments as $val):
	//$addition_extra_pay[++$cnt]=$val['extra_pay'];
//endforeach;

//print_r($addition_extra_pay);

$pmt = count($payments);


?>

<table table class="table table-bordered datatable" id="table_export">
	<thead>
		<tr>
			<th>Pmt No</th><th>Payment Date</th><th>Begining Balance</th><th>Scheduled Payment</th>
			<th>Extra-Payment</th><th>Total Payment</th><th>Principal</th><th>Interest</th><th>Ending Balance</th>
		</tr>
	</thead>
	<tbody>
		<?php
		
			for ($i=1; $i <= $term; $i++) {
				$added = 0;
		//		if(array_key_exists($i, $addition_extra_pay)){
			//		$added=$addition_extra_pay[$i];
				//}
				
				
				$total_repay = $repayments+$extra_pay+$added;
				$intr = $efrate*$princ;
				$r_princ = $total_repay - $intr; 
				//$end = $princ - $r_princ;
				$end = $princ-$r_princ;
				
				$style ="";
				if($i<=$pmt){
					 $style= "style='background-color:yellow;'";
				}
				
				$repayments_date = "";
				if(isset($payments[$i-1]['repayment_date'])){
					$repayments_date = $payments[$i-1]['repayment_date'];
				}
				
				if($end>=0){
		?>
			<tr <?php echo $style;?>>
				<td><?php echo $i;?></td>
				<td><?php echo $repayments_date;?></td>
				<td><?php echo number_format($princ,2);?></td>
				<td><?php echo number_format($repayments,2);?></td>
				<td><?php echo $extra_pay+$added;?></td>
				<td><?php echo number_format($total_repay,2);?></td>
				<td><?php echo number_format($r_princ,2);?></td>
				<td><?php echo number_format($intr,2);?></td>
				<td><?php echo number_format($end,2);?></td>
			</tr>
		
		<?php
				}elseif($intr>0){
						$extra_pay = 0;
						$total_repay = $princ+($efrate*$princ);
						$r_princ = $total_repay - $intr; 
						$end = $princ - $r_princ;
					?>
					<tr>		
						<td><?php echo $i;?></td>
						<td>&nbsp;</td>
						<td><?php echo number_format($princ,2);?></td>
						<td><?php echo number_format($repayments,2);?></td>
						<td><?php echo $extra_pay+$added;?></td>
						<td><?php echo number_format($total_repay,2);?></td>
						<td><?php echo number_format($r_princ,2);?></td>
						<td><?php echo number_format($intr,2);?></td>
						<td><?php echo number_format($end,2);?></td>		
								
					</tr>
					
					<?php
				}
				
				$princ -= $r_princ;
			}
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
						"mColumns": [1,2,3,4,5,6,7,8,9]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2,3,4,5,6,7,8,9]
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