<?php
		$member = $this->db->get_where("student",array("student_id"=>$param2))->result_array();
		
		echo form_open(base_url() . 'index.php?Admin/loans/add/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));
				
		foreach($member as $row):				
?>

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('member_id');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id='member_id' name="member_id" value="<?php echo $row['student_id']?>" readonly="readonly" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('member');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" name="" value="<?php echo $row['name']?>" readonly="readonly" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('entry_date');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control"  data-provide="datepicker" data-start-view="2" data-date-end-date="0d" data-date-format="yyyy-mm-dd" data-start-view="2"  id="application_date" name="application_date" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>
              
              <?php
              		$loan_types = $this->db->get("loan_settings")->result_array();
              ?>
              
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo get_phrase('loan_type');?></label>
					<div class="col-sm-5">
						<select name="loan_type" id="loan_type" class="form-control">
			                    <option value=""><?php echo get_phrase('select');?></option>
								<?php
									foreach($loan_types as $type):
								?>
									<option value="<?php echo $type['loan_type'];?>"><?php echo $type['loan_type'];?></option>
								<?php
									endforeach;
								?>
		                </select>
					</div> 
			</div>              
              

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('details');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="details" name="details" value="Conversion" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>
              
              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('repayment_period');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="repayment_period" name="repayment_period" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('interest_rate');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="rate" name="rate" value="" readonly="readonly" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>              
              
              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('principal');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="principle" name="principle" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('scheduled_payment');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="sched_pay" name="sched_pay" readonly="readonly" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('extra_payment');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="extra_pay" name="extra_pay" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>
              
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo get_phrase('loan_status');?></label>
					<div class="col-sm-5">
						<select name="status" id="status" class="form-control">
			                    <option value=""><?php echo get_phrase('select');?></option>
								<option value="new" selected>New</option>
								<option value="active">Active</option>
		                </select>
					</div> 
			</div>              
			
			<div class="form-group">
                 <div class="col-sm-offset-3 col-sm-5">
                       <button type="submit" class="btn btn-info"><?php echo get_phrase('add');?></button>
                 </div>
			</div>  
			
			<?php
				endforeach;
			?>            
        
</form>


<script type="text/javascript">
	jQuery(document).ready(function($)
	{

		
		$("#repayment_period,#principle,#loan_type").change(function(){
			var princ = $("#principle").val();
			var intr = $("#rate").val()/ 1200;
			var term = $("#repayment_period").val();
			
			//Calculate Repayments			
			var sched_pay = 0;
				if($("#repayment_period").val()!==''||$("#repayment_period").val()!==0){
					sched_pay = princ * intr / (1 - (Math.pow(1/(1 + intr), term)));
				}
			
    		$("#sched_pay").val(sched_pay);
						
			//Get Interest Rate	
			var loan_type = $("#loan_type").val();
			var url = '<?php echo base_url();?>index.php?admin/rate/'+loan_type;
			$.ajax({
					url: url,
					success: function(response)
					{
						jQuery('#rate').val(response);
					}
				});	
		});
	
	});
</script>