<?php
		$loan_query = $this->db->get_where("loans",array("loans_id"=>$param2))->result_array();
		
		echo form_open(base_url() . 'index.php?Admin/loans/extra/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));
				
		foreach($loan_query as $row):				
?>

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('current_scheduled_extra_payment');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" name="old_extra_pay" value="<?php echo $row['extra_pay']?>" readonly="readonly" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('new_scheduled_extra_payment');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" name="extra_pay" value="0" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>
              
			
			<div class="form-group">
                 <div class="col-sm-offset-3 col-sm-5">
                       <button type="submit" class="btn btn-info"><?php echo get_phrase('edit');?></button>
                 </div>
			</div>  
			
			<?php
				endforeach;
			?>            
        
</form>