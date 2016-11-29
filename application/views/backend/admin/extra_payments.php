<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('payment_date');?></div></th>
            <th><div><?php echo get_phrase('extra_pay');?></div></th>
            <th><div><?php echo get_phrase('status');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
    	<?php 
        	$count = 1;
			
			$extra = $this->db->get_where("extra_payments",array("status"=>"pending"))->result_array();
			
			foreach($extra as $row):
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $row['payment_date']?></td>
            <td><?php echo $row['extra_pay']?></td>
            <td><?php echo $row['status']?></td>
            <td>
            	 <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                       
                       <!-- Acceptance LINK -->

                        <li>
                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/extra_payments/approve/<?php echo $row['payment_id'];?>');">
                            	<i class="entypo-check"></i>
									<?php echo get_phrase('accept');?>
                               	</a>
                       	</li> 
                       	
                       	<li class="divider"></li>
                       	
                       	<!--DeclineLink-->
                       	
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?Admin/modal_extra_payment_decline/<?php echo $row['payment_id'];?>');">
                            	<i class="entypo-cancel"></i>
									<?php echo get_phrase('decline');?>
                               	</a>
                       	</li> 
                       	
                                           	
                    </ul>
                </div>
            </td>
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