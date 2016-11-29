<?php 
$edit_data		=	$this->db->get_where('share_rate' , array('member_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('share_statement');?>
            	</div>
            </div>
			<div class="panel-body">
				
							
			<center>
			    <a onClick="PrintElem('#statement_print')" class="btn btn-default btn-icon icon-left hidden-print pull-right">
			        Print Statement
			        <i class="entypo-print"></i>
			    </a>
			</center>
			
			
				<br><br>
				
				<div id="statement_print">

				        <table width="100%" border="0">
				            <tr>
				                <td align="right">
				                
				                <?php
				                	$member = $this->crud_model->get_member_details($param2);
				                ?>
				                
				                	<h5><?php echo get_phrase('member_name'); ?> : <?php echo $member['member']['name'];?></h5><br>				                	
				                    <h5><?php echo get_phrase('monthly_share_rate'); ?> : <?php echo $member['share_rate'];?></h5><br>
				                    <h5><?php echo get_phrase('total_shares'); ?> : <?php echo $member['shares']['amount'];?></h5><br>				                    
				                    <h5><?php echo get_phrase('guaranteed_shares'); ?> : <?php echo $member['shares']['guaranteed'];?></h5><br>
				                    <h5><?php echo get_phrase('unguaranteed_shares'); ?> : <?php echo $member['shares']['amount']-$member['shares']['guaranteed'];?></h5><br>

				                <?php
				                	//endforeach;
				                ?>
				                </td>
				            </tr>
				        </table>
				        <hr>
				
						<table class="table table-bordered datatable" id="table_export">
						    <thead>

						        <tr>
						            <th><div><?php echo get_phrase('date');?></div></th>
						            <th><div><?php echo get_phrase('contribution');?></div></th>
						            <th><div><?php echo get_phrase('guaranteed');?></div></th>
						        </tr>

						    </thead>
						    <tbody>
						    	<?php
						    		$share_query = $this->crud_model->get_member_details($param2);
									$contribution = 0;
									$guaranteed=0;
									foreach($share_query['share_statement'] as $row):
						    	?>
						    		<tr>
						    			<td><?php echo date('d-m-Y',strtotime($row['date']));?></td>
						    			<td><?php echo $row['contribution']?></td>
						    			<td><?php echo $row['guaranteed']?></td>
						    		</tr>
						    	
						    	<?php
						    		$contribution +=$row['contribution']; 
									$guaranteed +=$row['guaranteed'];
						    		endforeach;
						    	?>
						    	<tr>
						    		<th>Totals</th>
						    		<th><?php echo $contribution;?></th>
						    		<th><?php echo $guaranteed;?></th>
						    	</tr>
						    </tbody>
						    </table>
				
				</div>    
                
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>

<script type="text/javascript">

    // Statement function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'Loan_Statement', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Loan Statement</title>');
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