<?php
		
		
		echo form_open(base_url() . 'index.php?Admin/loan_types/edit/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));
		
		$loan_settings = $this->db->get_where("loan_settings",array("loan_settings_id"=>$param2))->result_array();	
		
		foreach($loan_settings as $row):	
?>


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('loan_type');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="loan_type" name="loan_type" value="<?php echo $row['loan_type'];?>" readonly="readonly" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('interest_rate');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="interest_rate" name="interest_rate" value="<?php echo $row['interest_rate'];?>"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>
  
  
			<div class="form-group">
				<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('guarantor_required');?></label>
                       
				<div class="col-sm-5">
					<select name="guarantee_required" id="guarantee_required" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('select');?></option>
                            <option value="yes" <?php if($row['guarantee_required'] == 'yes')echo 'selected';?>><?php echo get_phrase('Yes');?></option>
                            <option value="no"<?php if($row['guarantee_required'] == 'no')echo 'selected';?>><?php echo get_phrase('No');?></option>
                        </select>
				</div> 
			</div>


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('loan_life');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="max_loan_life" name="max_loan_life" value="<?php echo $row['max_loan_life'];?>"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>              


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('loan_limit_by_amount');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="loan_limit_by_amount" name="loan_limit_by_amount" value="<?php echo $row['loan_limit_by_amount'];?>"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div> 

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('loan_limit_by_ratio');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="loan_limit_by_ratio" name="loan_limit_by_ratio" value="<?php echo $row['loan_limit_by_ratio'];?>"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>               

			<div class="form-group">
				<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('active');?></label>
				<div class="col-sm-5">
					<select name="active" id="active" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('select');?></option>
                            <option value="yes" <?php if($row['active'] == 'yes')echo 'selected';?>><?php echo get_phrase('Yes');?></option>
                            <option value="no"<?php if($row['active'] == 'no')echo 'selected';?>><?php echo get_phrase('No');?></option>
                        </select>
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


<script type="text/javascript">

</script>