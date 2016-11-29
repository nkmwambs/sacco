<?php
$transaction_header_id= $param2;

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('transaction_slip');?>
            	</div>
            </div>
			<div class="panel-body">
				
							
			<center>
			    <a onClick="PrintElem('#slip_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
			        Print Slip
			        <i class="entypo-print"></i>
			    </a>
			</center>
			
			
				<br><br>
				
				<div id="slip_print">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Date</th>
								<th>Details</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$edit_data =	$this->db->get_where('transaction' , array('transaction_header_id' => $transaction_header_id) )->result_object();
								
								$type = $this->db->get_where('transaction_header',array('transaction_header_id'=>$transaction_header_id))->row();
								
								$total = 0;
								
								foreach ($edit_data as $row):
							?>
								<tr>
									<td><?php echo $row->stamp;?></td>
									<td><?php echo $type->transaction_type;?></td>
									<td><?php echo number_format($row->amount,2);?></td>
								</tr>
							
							<?php
								$total +=$row->amount;
								endforeach;
							?>
							<tr>
								<td>Total</td>
								<td colspan="2"><?php echo number_format($total,2);?></td>
							</tr>
					</tbody>
					</table>
				</div>    
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    // Statement function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'Transaction Slip', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Transaction Slip</title>');
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