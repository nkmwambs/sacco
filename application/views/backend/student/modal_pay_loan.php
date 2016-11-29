<?php
	$active_loans = $this->db->get_where("loans",array("member_id"=>$param2,"status"=>"active"))->result_array();
	//print_r($active_loans);
?>
						<?php echo form_open(base_url() . 'index.php?student/loan/repay' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('payment_date');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control datepicker" name="payment_date" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('loan_paying_for');?></label>
                                <div class="col-sm-5">
                                    <select name="loan_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
			                            <option value=""><?php echo get_phrase('select');?></option>
			                            	<?php
												foreach($active_loans as $loan):
											?>
												<option value="<?php echo $loan['loan_id'];?>"><?php echo $loan['loan_type'];?> - <?php echo $loan['details'];?></option>
										  	<?php
                        						endforeach;
                        					?>
		                          </select>
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('extra_payment');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="extra_pay" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                </div>
                            </div> 
                            
	                      <div class="form-group">
							<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('bank_slip');?></label>
	                        
							<div class="col-sm-5">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
										<img src="http://placehold.it/200x200" alt="...">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
									<div>
										<span class="btn btn-white btn-file">
											<span class="fileinput-new">Select File</span>
											<span class="fileinput-exists">Change</span>
											<input type="file" name="userfile" accept="image/*" data-validate="required" data-message-required="<?php echo get_phrase('file_required');?>">
										</span>
										<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
									</div>
								</div>
							</div>
						</div>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn btn-info"><?php echo get_phrase('pay');?></button>
                                </div>
							</div>

                       </form>
                           
                           
