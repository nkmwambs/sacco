<?php
		
		
		echo form_open(base_url() . 'index.php?Admin/loan_types/add/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));
		
?>


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('loan_type');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="loan_type" name="loan_type" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('interest_rate');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="interest_rate" name="interest_rate" value="0.00"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>
  
  
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo get_phrase('guarantor_required');?></label>
					<div class="col-sm-5">
						<select name="guarantee_required" id="guarantee_required" class="form-control selectboxit">
			                    <option value=""><?php echo get_phrase('select');?></option>
			                    <option value="yes">Yes</option>
			                    <option value="no">No</option>
		                </select>
					</div> 
			</div>


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('loan_life');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="max_loan_life" name="max_loan_life" value="0"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>              


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('loan_limit_by_amount');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="loan_limit_by_amount" name="loan_limit_by_amount" value="0"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div> 

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('loan_limit_by_ratio');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="loan_limit_by_ratio" name="loan_limit_by_ratio" value="0"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>               
			
			<div class="form-group">
                 <div class="col-sm-offset-3 col-sm-5">
                       <button type="submit" class="btn btn-info"><?php echo get_phrase('add');?></button>
                 </div>
			</div>  
			          

</form>


<script type="text/javascript">

</script>