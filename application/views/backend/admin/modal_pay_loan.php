<?php
	$loan_detail = $this->db->get_where("loans",array("loans_id"=>$param2))->result_array();
	
	//print_r($this->crud_model->get_member_details(8,array("loan_types")));
			
							foreach($loan_detail as $loan):
							 
							$details = $this->crud_model->get_member_details($loan['member_id']);

							$one_time_extra_pay = $details['one_time_extra_payment'][$loan['loan_type']];
							
							$scheduled_extra_pay = $details['scheduled_extra_payment'][$loan['loan_type']];
							
							$scheduled_pay=$details['scheduled_payment'][$loan['loan_type']];							
							
							$excess_payment = $details['excess_payment'][$loan['loan_type']];
							
							$pmt = $details['pmt'][$loan['loan_type']];


							echo form_open(base_url() . 'index.php?Admin/loans/repay/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));
							
						?>
					<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('pay_loan');?>
            	</div>
            </div>
					<div class="panel-body">	
							<div class="form-group">
								<label class="col-sm-3 control-label"><?php echo get_phrase('information');?></label>
								<?php 
									echo "You have an extra payment done of Kes.".$excess_payment." and will be converted to your shares";
									
								?>
							</div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('payment_month');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="pmt" value="<?php echo $pmt;?>" readonly="readonly" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                </div>
                            </div>							
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('payment_date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" data-provide="datepicker" data-date-end-date="0d" data-date-format="yyyy-mm-dd" name="repayment_date" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('scheduled_payment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  name="sched_pay" readonly="readonly" value="<?php echo $scheduled_pay;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                </div>
                            </div> 
 
                             <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('scheduled_extra_payment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="extra_pay" readonly="readonly" value="<?php echo $scheduled_extra_pay;?>" />
                                </div>
                            </div>                            
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('one_time_extra_payment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="one_time_extra_pay" readonly="readonly" value="<?php echo $one_time_extra_pay;?>" />
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('excess_payment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="excess_payment" readonly="readonly" value="<?php echo $excess_payment;?>" />
                                </div>
                            </div>                             
                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn btn-info"><?php echo get_phrase('pay');?></button>
                                </div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
						
                       </form>
                         <?php
							endforeach;
						?>  
                           
