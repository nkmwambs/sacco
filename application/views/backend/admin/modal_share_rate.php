<div class="row">
	<div class="col-md-12">
		
		 <?php 
		 	$share_rate = $this->db->get_where("share_rate",array('member_id'=>$param2,"approved"=>'approved'))->result_array();
			$param1 = "create";
			$value="";
			if(sizeof($share_rate)>0){
				$param1='to_update';
				$value=$share_rate[0]['monthly_share_rate'];
			}
		 	echo form_open(base_url() . 'index.php?admin/share_rate/'.$param1.'/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('monthly_share_rate');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="monthly_share_rate" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $value;?>">
						</div>
					</div>
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('new_share_rate');?></button>
						</div>
					</div>
         <?php echo form_close();?>					
</div>
</div>