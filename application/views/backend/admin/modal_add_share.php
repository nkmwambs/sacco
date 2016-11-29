<?php 
$edit_data		=	$this->db->get_where('student' , array('student_id' => $param2) )->result_array();

foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_share');?>
            	</div>
            </div>
			<div class="panel-body">
				
				    <br><br>

				    <div id="invoice_print">
				    	<?php
				    		$total_share_qry = $this->db->select_sum('amount');
							$total_share = $this->db->get_where("shares",array("member_id"=>$param2))->row()->amount;
							
							$share_rate_arr = $this->db->get_where("share_rate",array('member_id'=>$param2))->result_array();
							$share_rate=0;
							if(count($share_rate_arr)>0){
								$share_rate=$share_rate_arr[0]['monthly_share_rate'];
							}
										
				    	?>
				        <table width="100%" border="0">
				            <tr>
				                <td align="right">
				                    <h5><?php echo get_phrase('total_shares'); ?> : <?php echo $total_share;?></h5>
				                </td>
				            </tr>
				        </table>
				        <hr>
				
				
                <?php echo form_open(base_url() . 'index.php?admin/share/create/'.$row['student_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('details');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="details" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="amount" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $share_rate;?>">
						</div>
					</div>
						
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('share month');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control"  data-provide="datepicker" data-start-view="2" data-date-end-date="0d" data-date-format="yyyy-mm-dd" data-start-view="2"  name="sharemonth" value="" data-start-view="2">
						</div> 
					</div>			

					                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_share');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>

<script type="text/javascript">

</script>