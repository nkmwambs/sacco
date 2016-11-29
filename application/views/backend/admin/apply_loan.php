<?php

$rec_cond = "loans_id=".$loans_id."";

//echo $_id;

$rec = $this->db->where($rec_cond)->get('loans')->result_object();

foreach($rec as $row):

$available_shares = $this->sacco_model->gross_shares($row->member_id);

$loan_type_obj = $this->db->get_where('loan_settings',array('loan_type'=>$row->loan_type))->row();

$loan_limit = $this->sacco_model->loan_limit($row->loan_type,$row->member_id);

$loans_id = $row->loans_id;

$loan_status = ucfirst($row->status);

//echo $row->member_id;

//$member_name = $this->crud_model->get_type_name_by_id('student',$row->member_id);

?>

<hr />
<div class="row">
<a href="<?php echo base_url();?>index.php?admin/member/" 
    class="btn btn-primary pull-right">
        <i class="entypo-back"></i>
        <?php echo get_phrase('back');?>
    </a> 
<br>
</div>

<div class="row">
	
	<div class="well well-sm">
			<h4>Please fill the details to apply a new loan.</h4>
		</div>
		
		<!--<form id="frmwizard" method="post" action="" class="form-wizard validate">-->
		<?php echo form_open(base_url() . 'index.php?admin/loans/save/'.$row->member_id , array('id'=>'frmwizard','class' => 'form-wizard validate', 'enctype' => 'multipart/form-data'));?>
			
			<div class="steps-progress">
				<div class="progress-indicator"></div>
			</div>
			
			<ul>
				<li id="id-tab2-1">
					<a href="#tab2-1" data-toggle="tab"><span>1</span><?php echo get_phrase('personal_information');?></a>
				</li>
				<li id="id-tab2-2">
					<a href="#tab2-2" data-toggle="tab"><span>2</span><?php echo get_phrase('loan_application_and_repayment');?></a>
				</li>
				<li id="id-tab2-3">
					<a href="#tab2-3" data-toggle="tab"><span>3</span><?php echo get_phrase('loan_purpose');?></a>
				</li>
				<li id="id-tab2-4">
					<a href="#tab2-4" data-toggle="tab"><span>4</span><?php echo get_phrase('loan_security');?></a>
				</li>
				<!--<li id="id-tab2-5">
					<a href="#tab2-5" data-toggle="tab"><span>5</span><?php echo get_phrase('declaration');?></a>
				</li>-->
				<li id="id-tab2-5">
					<a href="#tab2-5" data-toggle="tab"><span>5</span><?php echo get_phrase('repayment_guarantee');?></a>
				</li>				
				<li id="id-tab2-6">
					<a href="#tab2-6" data-toggle="tab"><span>6</span><?php echo get_phrase('employer_confirmation');?></a>
				</li>				
				
				<li id="id-tab2-7">
					<a href="#tab2-7" data-toggle="tab"><span>7</span><?php echo get_phrase('additional_information');?></a>
				</li>	
					
				<li id="id-tab2-8">
					<a href="#tab2-8" data-toggle="tab"><span>8</span><?php echo get_phrase('loan_status');?></a>
				</li>							
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane" id="tab2-1">
					
					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="full_name"><?php echo get_phrase('full_name');?></label>
								
								<?php
									$rst = $this->db->get_where("student",array("student_id"=>$row->member_id))->row();
								?>
								<input class="form-control" name="full_name" id="full_name" value="<?php echo $rst->name;?>" readonly/>
							</div>
						</div>
						
						<div class="col-md-5 col-md-offset-2">
							<div class="form-group">
								<label class="control-label" for="monthly_income"><?php echo get_phrase("present_income_per_month");?></label>
								<input class="form-control" name="monthly_income" id="monthly_income" value="<?php if($row->monthly_income==='0') echo ''; else echo $row->monthly_income;?>" data-validate="number"  placeholder="<?php echo get_phrase("present_income_per_month");?>" />
							</div>
						</div>
						
					</div>
					
					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="member_address"><?php echo get_phrase('member_address');?></label>
								<input class="form-control" name="member_address" id="member_address" data-validate="required" value="<?php echo $rst->address;?>" readonly/>
							</div>
						</div>
						
						<div class="col-md-5 col-md-offset-2">
							<div class="form-group">
								<label class="control-label" for="monthly_expenditure"><?php echo get_phrase("monthly_expenditure");?></label>
								<input class="form-control" name="monthly_expenditure" id="monthly_expenditure" value="<?php if($row->monthly_expenditure==='0') echo ''; else echo $row->monthly_expenditure;?>" data-validate="number" data-message-required="<?php echo get_phrase('value_required');?>"  placeholder="<?php echo get_phrase("monthly_expenditure");?>" />
							</div>
						</div>
						
					</div>
					
					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="id_number"><?php echo get_phrase('id_number');?></label>
								<input class="form-control" name="id_number" id="id_number" data-validate="required" value="<?php echo $rst->id_number;?>" readonly/>
							</div>
						</div>
						
						<div class="col-md-5 col-md-offset-2">
							<div class="form-group">
								<label class="control-label" for="position_employed"><?php echo get_phrase("position_employed");?></label>
								<input class="form-control" name="position_employed" id="position_employed" data-validate="required"  value="None" readonly/>
							</div>
						</div>
						
					</div>	
					
					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="membership_number"><?php echo get_phrase('membership_number');?></label>
								<input class="form-control" name="membership_number" id="membership_number" data-validate="required" value="<?php echo $rst->roll;?>" readonly/>
							</div>
						</div>
						
						<div class="col-md-5 col-md-offset-2">
							<div class="form-group">
								<label class="control-label" for="birthday"><?php echo get_phrase("date_of_birth");?></label>
								<input class="form-control" name="birthday" id="birthday" data-validate="required" data-mask="date" value="<?php echo $rst->birthday;?>" readonly/>
							</div>
						</div>
						
					</div>										
					
					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="department"><?php echo get_phrase('department');?></label>
								
								<input class="form-control" name="department" id="department" value="<?php echo $this->crud_model->get_type_name_by_id('department',$rst->department_id);?>" readonly/>
								
							</div>
						</div>
					
						
					</div>						
					
					
					<div class="row">
						<div class="col-md-6">	
							<div class="form-group">
									<label class="col-sm-3 control-label">Attach 3 recent payslips</label>
									
									<div class="col-sm-5">
										
										<input type="file" class="form-control file2 inline btn btn-primary" data-validate="required" multiple="1" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />
										
									</div>
								</div>
						</div>
					</div>	
					
				</div>
				
				<div class="tab-pane" id="tab2-2">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
									<label class="control-label" for="loan_type"><?php echo get_phrase("loan_type");?></label>
									
									<select class="form-control" name="loan_type" id="loan_type">
										<option value=""><?php echo get_phrase('select');?></option>
										<?php 
											$type = $this->db->get_where('loan_settings',array('active'=>'yes'))->result_object();
											
											foreach($type as $rw):
										?>
											<option value="<?php echo $rw->loan_type;?>"<?php echo $row->loan_type===$rw->loan_type?'selected':'';?>><?php echo ucfirst($rw->loan_type);?></option>
										<?php 
											endforeach;
										?>
									</select>
								</div>		
							</div>	
							
							<div class="col-md-5 col-md-offset-2">
								<div class="form-group">
									<label class="control-label" for="rate"><?php echo get_phrase("interest_rate");?></label>
									<input class="form-control" name="rate" readonly="readonly" id="rate" value="<?php echo $row->rate;?>" data-validate="required" placeholder="<?php echo get_phrase('interest_rate');?>" />
								</div>
							</div>						
					</div>
					
					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="principle"><?php echo get_phrase('loan_applied');?></label>
								<input class="form-control" name="principle" id="principle" value="<?php echo $row->principle;?>" data-validate="required" placeholder="<?php echo get_phrase('loan_applied');?>" />
							</div>
						</div>
						
						<div class="col-md-5 col-md-offset-2">
							<div class="form-group">
								<label class="control-label" for="repayment_period"><?php echo get_phrase("repament_period_in_months");?></label>
								<input class="form-control" name="repayment_period" id="repayment_period" value="<?php echo $row->repayment_period;?>" data-validate="required" data-mask="date" placeholder="<?php echo get_phrase("repament_period_in_months");?>" />
							</div>
						</div>
						
					</div>
					
					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="sched_pay"><?php echo get_phrase('installments');?></label>
								<input class="form-control" name="sched_pay" id="sched_pay" value="<?php echo $row->sched_pay;?>" readonly="readonly" data-validate="required" placeholder="<?php echo get_phrase('installments');?>" />
							</div>
						</div>
						
						<div class="col-md-5 col-md-offset-2">
							<div class="form-group">
								<label class="control-label" for="proposed_date"><?php echo get_phrase("commence_payment_on");?></label>
								<input type="text" readonly="readonly" class="form-control" value="<?php echo $row->proposed_date;?>" name="proposed_date" id="proposed_date" data-provide="datepicker" data-start-view="2" data-date-start-date="0d" data-date-format="yyyy-mm-dd" value="" >
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<?php 
									$max_life = $this->db->get_where('loan_settings',array('loan_type'=>$row->loan_type))->row()->max_loan_life;
								?>
								<label class="control-label" for="loan_max_life"><?php echo get_phrase('loan_maximum_life');?></label>
								<input class="form-control" name="loan_max_life" id="loan_max_life" readonly="readonly" value="<?php echo $max_life;?>" data-validate="required"/>
							</div>
						</div>
						
						<div class="col-md-5 col-md-offset-2">
							<div class="form-group">
								<label class="control-label" for="extra_pay"><?php echo get_phrase('extra_payment');?></label>
								<input class="form-control" name="extra_pay" id="extra_pay" value="<?php echo $row->extra_pay;?>" data-validate="required" />
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="loan_limit" class="control-label"><?= get_phrase('loan_limit');?></label>
								<input type="text" class="form-control" value="<?= $loan_limit;?>" name="loan_limit" id="loan_limit" readonly/>
							</div>
						</div>
					</div>
					
					
					
					<div class="row">
						<div class="well well-sm">
							<h4>If this loaned is approved please process the payment into the following;</h4>
						</div>
					</div>
					
					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="account_name"><?php echo get_phrase('account_name');?></label>
								<input class="form-control" name="account_name" id="account_name" value="<?php echo $row->account_name;?>" data-validate="required" placeholder="<?php echo get_phrase('account_name');?>" />
							</div>
						</div>
						
						<div class="col-md-5 col-md-offset-2">
							<div class="form-group">
								<label class="control-label" for="account_number"><?php echo get_phrase("account_number");?></label>
								<input class="form-control" name="account_number" id="account_number" value="<?php echo $row->account_number;?>"  data-validate="required"  placeholder="<?php echo get_phrase("account_number");?>" />
							</div>
						</div>
						
					</div>					

					<div class="row">
						
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label" for="bank_name"><?php echo get_phrase('bank_name');?></label>
								<input class="form-control" name="bank_name" id="bank_name"  value="<?php echo $row->bank_name;?>"  data-validate="required" placeholder="<?php echo get_phrase('bank_name');?>" />
							</div>
						</div>
						
						<div class="col-md-5 col-md-offset-2">
							<div class="form-group">
								<label class="control-label" for="branch_name"><?php echo get_phrase("branch_name");?></label>
								<input class="form-control" name="branch_name" id="account_number"  value="<?php echo $row->branch_name;?>"  data-validate="required" placeholder="<?php echo get_phrase("branch_name");?>" />
							</div>
						</div>
						
					</div>						
					
				</div>
				
				<div class="tab-pane" id="tab2-3">
					<div class="row">
						<button class="btn btn-orange btn-icon" id="btn-purpose"><i class="entypo-plus-circled"></i>Add</button>
						<button class="btn btn-red btn-icon" id="btn-remove"><i class="entypo-minus-circled"></i>Remove</button>
					</div>
					<div class="row">
						<table class="table table-hover" id="tbl_purpose">
							<thead>
								<tr>
									<th><input type="checkbox" class="form-control" id="action-all" style="width: 40%"/></th>
									<th>Purpose</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$purpose = $this->db->get_where('loan_purpose',array('loans_id'=>$row->loans_id))->result_array();
									
									if(count($purpose)>0){
										
									
									foreach($purpose as $pur):
								?>
									<tr>
										<td><input type="checkbox" class="form-control action-box" style="width: 40%"/></td>
										<td><input type="text" class="form-control purpose" name="purpose[]" value="<?php echo $pur['name'];?>"/></td>
										<td><input type="text" class="form-control purpose_amount" name="purpose_amount[]" value="<?php echo $pur['amount'];?>"/></td>
									</tr>
								
								<?php
									endforeach;
									}else{
								?>
									<tr>
										<td><input type="checkbox" class="form-control action-box" style="width: 40%"/></td>
										<td><input type="text" class="form-control purpose" name="purpose[]" value="<?php echo $pur['purpose'];?>"/></td>
										<td><input type="text" class="form-control purpose_amount" name="purpose_amount[]" value="<?php echo $pur['purpose_amount'];?>"/></td>
									</tr>
								
								<?php
									}
								?>
														
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="tab-pane" id="tab2-4">
					<div class="row">
						<button class="btn btn-green btn-icon" id="security-add"><i class="entypo-plus-circled"></i>Add</button>
						<button class="btn btn-red btn-icon" id="security-minus"><i class="entypo-minus-circled"></i>Remove</button>
					</div>
					
					<div class="row">
						<table class="table table-hover" id="tbl_security">
							<thead>
								<tr>
									<th><input type="checkbox" class="form-control" id="security-action" style="width:40%;"/></th>
									<th>Security</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>&nbsp;</td>
									<td><select class="form-control" name="security[]" readonly><option value="1">Shares</option></select></td>
									<td><input type="text" class="form-control" id="security" name="security_amt[]" value="<?= $available_shares?>" readonly/></td>
								</tr>
								<!--<tr>
									<td><input type="checkbox" class="security-box" style="width: 40%;"/></td>
									<td>
										<select class="form-control" name="security[]">
											<option value=""><?php echo get_phrase('select');?></option>
											<?php 
												$security = $this->db->get('security')->result_object();
												
												foreach($security as $row):
											?>
												<option value="<?php echo $row->security_id;?>"><?php echo $row->name;?></option>
											<?php
												endforeach;
											?>
										</select>										
									</td>
									<td><input type="text" class="form-control" name="security_amt[]"/></td>
								</tr>-->
							</tbody>
						</table>
					</div>
				</div>
				
				<!--<div class="tab-pane" id="tab2-5">
					<div class="row">
						<div class="well well-sm">
							<h4>
								<input type="checkbox" name="terms" id="terms" data-validate="required" value="1"/>I hereby declare that the foregoing particulars are true to the best of my knowledge and belief and agree to abide by the By-Laws of the society, and any variations by the Credit Committee, in respect of section B above. I hereby authorize the necessary deductions, including one percent interest monthly, to be made from my salary as repayment of this loan. I declare that I am not indebted to any other Credit Society, bank or loan agency (except as listed herein) either as a borrower or endorser.
							</h4>
						</div>
					</div>
						
				</div>-->
				
				
				<div class="tab-pane" id="tab2-5">
					<div class="row">
						<div class="well well-sm">
							<h4>We, the undersigned, hereby accept jointly and severally, liability for the repayment of the loan in the event of the borrower’s default. We understand that the amount of default may be recovered by an offset against our shares in the society or by attachment of our property or salary, and that we shall not be eligible for loans unless the amount in default has been cleared in full.</h4>
						</div>
					</div>
					
					<div class="row">
						<table class="table table-bordered datatable example">
							<caption>Your Guarantors</caption>
							<thead>
								<tr>
									<th>Free a Guarantor</th>
									<th><?php echo get_phrase('member_name');?></th>
									<th><?php echo get_phrase('amount');?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$guarantor_cond = "loans_id=".$loans_id." AND status<>'freed'";
									$guarantors = $this->db->where($guarantor_cond)->get('guarantors')->result();
									
									$t_guaranteed = 0;
									
									foreach($guarantors as $r):
									
									$g_name = $this->db->get_where('student',array('student_id'=>$r->member_id))->row();
								?>
								<tr>
									<td><div onclick="confirm_action('<?php echo base_url();?>index.php?admin/update_loan/free_guarantor/<?php echo $r->member_id;?>/<?php echo $loans_id;?>');" class="btn btn-icon btn-info">
										
										Free a guarantor<i class="entypo-lock-open"></i>
										
										</div></td>
									<td><input type="text" class="form-control" readonly="readonly" name="member[]" value="<?= $g_name->name;?>"/></td>
									<td><input type="text" class="form-control" readonly="readonly" name="guaranteed_amount[]" value="<?= $r->share_guaranteed;?>"/></td>
								</tr>
								<?php
									$t_guaranteed += $r->share_guaranteed;
									endforeach;
									
									if($t_guaranteed === 0){
										$t_guaranteed = "";
									}
								?>
								<tr>
									<td colspan="2">Total Shares Guaranteed</td>
									<td><input class="form-control" id="total_guarantors" readonly="readonly" type="text" value="<?= $t_guaranteed;?>"/></td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div class="row">

						<table class="table table-bordered datatable example">
							<caption>Request for Guarantorship</caption>
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo get_phrase('member_name');?></th>
									<th><?php echo get_phrase('guaranteed_status');?></th>
									<th><?php echo get_phrase('options');?></th>
								</tr>
								
							</thead>
						    	<?php
						    	$cond = "member_id != '".$this->session->userdata("login_user_id")."'";
								$shares = $this->db->select_sum('amount')->select('member_id')->group_by('member_id')->where($cond)->from('shares')->get()->result_array();
								//print_r($shares);
						
						    		$count=1;
						    		foreach ($shares as $rws) {
						    				$cond = "member_id='".$rws['member_id']."'";
											$this->db->select_sum('share_guaranteed');
											$this->db->where($cond);
											$this->db->from("guarantors");
											$guaranteed=$this->db->get()->row()->share_guaranteed;
											
											$dif = $rws['amount']-$guaranteed;
											
											//Check if a request has aleady been place
											$cnd = "member_id='".$rws['member_id']."' AND loans_id = '".$loans_id."' AND status!='freed'";
											$chk_req = $this->db->where($cnd)->get('guarantors')->result();
											//print_r($chk_req);
											if($dif>0&&count($chk_req)===0){
								?>
										<tr>
											<td><?php echo $count;?></td>
											<td><?php echo $this->db->get_where("student",array("student_id"=>$rws['member_id']))->row()->name;?></td>
											<td><?php echo $dif>0?"Available":"Unavailable";?></td>
											<td>
												<div class="btn-group">
	                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
	                        Action <span class="caret"></span>
	                    </button>
	                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
	                       
	                       <!-- Guarantee Request Link -->
	                        <li>
	                            <a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/update_loan/create_gurantor/<?php echo $rws['member_id'];?>/<?php echo $loans_id;?>/<?php echo $row->member_id;?>');">
	                            	<i class="entypo-alert"></i>
										<?php echo get_phrase('request');?>
	                               	</a>
	                       	</li>
	
	                     	
	                    </ul>
	                </div>
											</td>
										</tr>
								<?php
												$count++;
											}
									}
						    	
						    	?>
						</table>							
					</div>					
				</div>
				
				<div class="tab-pane" id="tab2-6">
					<div class="form-group">
						<div class="row">
								<div class="well well-sm">
									<h4>Please download an employer's confirmation template below and have it filled by your employer. Upload the letter below</h4>
								</div>
						</div>
						
						<div class="row">
							 <div class="col-xs-6">               
	                         	<a href="<?php echo base_url();?>uploads/blank_template.docx" target="_blank" 
	                         			class="btn btn-info btn-sm"><i class="entypo-download"></i> Download a Template</a>
							</div>	
							
							<div class="col-xs-6">  	
								<input type="file" class="form-control file2 inline btn btn-primary" data-validate="required" multiple="1" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Upload Employer's Confirmation" />
							</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane" id="tab2-7">
					
					<div class="row">
						<div class="col-xs-12">
							<?php 
								echo $this->crud_model->form_edit_additional_fields($loans_id,'loan_application');
							?>
						</div>
					</div>
				</div>			
				
				
				<div class="tab-pane" id="tab2-8">
					
					<div class="row">
						<div class="col-xs-5">
							<div class="form-group">
								<label class="control-label">Reasons for Deferred Loans</label>
								<?php $deferred_comment = $this->db->select_max('loan_comments_id')->select('comment')->get_where('loan_comments',array('loans_id'=>$_id,"comment_code"=>'2'))->row(); ?>
								<textarea class="form-control" name="deferred_comment" name="deferred_comment" cols="12" rows="5"><?= $deferred_comment->comment;?></textarea>
							</div>
						</div>
						
						<div class="col-xs-5 col-xs-offset-2">
							<div class="form-group">
								<label class="control-label">Reasons for Declining Loans </label>
								<?php
									$declined_comment = $this->db->select_max('loan_comments_id')->select('comment')->get_where('loan_comments',array('loans_id'=>$_id,"comment_code"=>'1'))->row();
									//print_r($declined_comment);
								?>
								<textarea class="form-control" name="declined_comment" id="declined_comment" cols="12" rows="5"><?php echo $declined_comment->comment;?></textarea>
						</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-5">
							<div class="form-group">
								<label for="action_date" class="control-label">Deferred Date</label>
								<input type="text" class="form-control" name="action_date" id="action_date" data-provide="datepicker" data-start-view="2" data-date-start-date="0d" data-date-format="yyyy-mm-dd" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-xs-5">
							<div class="form-group">
								<label class="control-label">Loan Status</label>
								<input type="text" class="form-control" value="<?php echo $loan_status;?>" readonly="readonly"/>
							</div>
						</div>
						<div class="col-xs-5 col-xs-offset-2">
							<div class="form-group">
								<label class="control-label">Submit Status</label>
								<select class="form-control" name="status" id="status">
									<!--<option value=""><?php echo get_phrase('select');?></option>-->
									<option value="new">Not Submitted</option>
									<option value="submitted" <?php if($loan_status==='Submitted') echo 'selected';?>>Submitted</option>
									<option value="deferred" <?php if($loan_status==='deferred') echo 'selected';?>>Deferred</option>
									<option value="declined" <?php if($loan_status==='declined') echo 'selected';?>>Declined</option>
								</select>
							</div>
						</div>
					</div>
										
				</div>
				
				
				<ul class="pager wizard">
					<li class="previous">
						<a href="#"><i class="entypo-left-open"></i> Previous</a>
					</li>
					
					<li class="current">
						<button id='btn-save' class="btn btn-info btn-icon pull-four">
							Save 
							<i class="fa fa-save"></i>
						</button>
					</li>
					
					<li class="next">
						<a href="#">Next <i class="entypo-right-open"></i></a>
					</li>
				</ul>
			</div>
		
		</form>
	
</div>

<?php
endforeach;
?>

<script type="text/javascript">

$('#btn-save').click(function(){ 
	
	//Remove empty rows in the loan purpose section
	$('.must-filled').each(function(){
		if($(this).val().length===0){
			$(this).closest('tr').remove();
		}
	});
	
	

	var principle = $('#principle').val();
	
	//Check loan limit if exceeded
	var loan_limit_setting = $('#loan_limit').val();
	
	if(parseInt(principle)>parseInt(loan_limit_setting)){
		alert('Amount applied exceeds the allowable limit!');
		$('#principle').css('border','1px red solid');
		//return false;
	}	
	
	
	//Check if the loan purpose amount matches the loan principle amount, return false if not	
	var purpose_amount = 0;
		    $(".purpose_amount").each(function(){
		        purpose_amount += +$(this).val();
		    });
    
    
	if(parseInt(principle)!==parseInt(purpose_amount)&&purpose_amount!==0){
		alert('Loan purpose should be equal to the loan applied');
		return false;
	}
	
	//Check if loan maximmum life has been exceed, if yes return false
	
	var max_loan_life = $('#loan_max_life').val();
	var repayment_period = $('#repayment_period').val();
	
	
	if(parseInt(repayment_period)>parseInt(max_loan_life)){
		alert('Repayment Period has exceeded the Maximum possible loan life!');
		$('#repayment_period').css('border','1px red solid');
		return false;
	}
	
		
		$("#frmwizard").submit(function(e)
		{
		    var postData = $(this).serializeArray();
		    var formURL = $(this).attr("action");
		    $.ajax(
		    {
		        url : formURL,
		        type: "POST",
		        data : postData,
		        //dataType: "json",
		        success:function(data, textStatus, jqXHR) 
		        {
					
		            alert('Application saved successfully!');
		            //alert(data);
		            //location.reload();
		            
		        },
		        error: function(jqXHR, textStatus, errorThrown) 
		        {
		            //if fails
		            alert(textStatus+' - '+ errorThrown);      
		        }
		    });
		    e.preventDefault(); //STOP default action
		    e.unbind(); //unbind. to stop multiple form submit.
		});
		 
		//$("#frmwizard").submit(); //Submit  the FORM
		
});


	jQuery(document).ready(function($)
	{
		//Check if loan is fully guaranteed
		$('#status').on('change',function(){
			
			//Principle
			var p = $('#principle').val();
			
			//Guarantors
			var g = $('#total_guarantors').val();
			
			//Shares
			var shares = $('#security').val();
			
			if(p>(parseInt(g)+parseInt(shares))){
				alert('The loan is not fully guaranteed!');
				location.reload();
				return false;
			}
			//var status  = $(this).val();
			//confirm_action('<?php echo base_url();?>index.php?admin/update_loan/status/'+status+'/<?php echo $loans_id;?>');
			
		});
		//Control Form Wizard
			$('.tab-pane').each(function(){
				var emptyFields = 0,
           		inputs = $(this).find("input:text");

		        inputs.each(function () {
		            if (!$(this).val()) {
		                emptyFields += 1;
		            }
		        });
		
		        //return emptyFields;
		        var list_id = 'id-'+$(this).attr('id');
		        
		        if(emptyFields>0){
		        	$(this).addClass('active');
		        	$('#'+list_id).addClass('active');
		        	//alert($('#'+list_id).attr('class'));		        	
		        	return false;
		        }else{
		        	$(this).addClass('completed');
		        	$('#id-'+list_id).addClass('completed');
		        }
		        
			});
		
		
	
		
		 $('#action-all').change(function(e){

		 	    if($(this).is(":checked")) {
		            $('.action-box').prop('checked', true);
		        }else{
		        	$('.action-box').prop('checked', false);
		        }
		        
		 	e.preventDefault();
		 });

		$('#security-action').change(function(e){

		 	    if($(this).is(":checked")) {
		            $('.security-box').prop('checked', true);
		        }else{
		        	$('.security-box').prop('checked', false);
		        }
		        
		 	e.preventDefault();
		 });		 
		
		$('#btn-purpose').click(function(e){
			$('#tbl_purpose tr:last').after('<tr><td><input type="checkbox" class="action-box" style="width: 50%"/></td><td><input type="text" class="form-control purpose must-filled" name="purpose[]"/></td><td><input type="text" class="form-control purpose_amount must-filled" name="purpose_amount[]" /></td></tr>');
			e.preventDefault();
		});
		
		$('#security-add').click(function(e){
			//alert('Add');
			var opt = "";
				<?php 
					$this->db->where(array('security_id>'=>"1"));
					$security = $this->db->get('security')->result_object();
									
					foreach($security as $row):
				?>
					opt += '<option value="<?php echo $row->security_id;?>"><?php echo $row->name;?></option>';				
				<?php
					endforeach;
				?>
			$('#tbl_security tr:last').after('<tr><td><input type="checkbox" class="security-box" style="width: 50%"/></td><td><select class="form-control security" name="security[]"><option value=""><?php echo get_phrase('select');?></option>'+opt+'</select></td><td><input type="text" class="form-control" name="security_amt[]" /></td></tr>');
			e.preventDefault();
		});
		
		$('#security-minus').click(function(e){
			var count = $('.security-box:checked').length;
			if(count===0){
				alert('You must select an action checkbox');
				return false;
			}
			//else if($('.security-box').length===1){
				//alert("You can't remove this row");
				//return false;
			//}else if(count===$('.security-box').length){
				//alert("You can't remove all rows");
				//return false;
			//}
			$('.security-box:checked').closest('tr').remove();
			e.preventDefault();
		});
		
		$('#btn-remove').click(function(e){
			//var count = $("[type='checkbox']:checked").length;
			var count = $('.action-box:checked').length;
			if(count===0){
				alert('You must select an action checkbox');
				return false;
			}else if($('.purpose').length===1){
				alert("You can't remove this row");
				return false;
			}else if(count===$('.purpose').length){
				alert("You can't remove all rows");
				return false;
			}
			$('.action-box:checked').closest('tr').remove();
			e.preventDefault();
		});
		
		
	//Get Scheduled Repayments
		$('#repayment_period,#principle,#loan_type').change(function(){
			var princ = $("#principle").val();
			var intr = $("#rate").val()/ 1200;
			var term = $("#repayment_period").val();
			var sched_pay = princ * intr / (1 - (Math.pow(1/(1 + intr), term)));
    		$("#sched_pay").val(sched_pay);
		});
	
		//Get Interest Rate
		$("#loan_type").change(function(){
			var loan = $('#loan_type').val();
			//alert(loan);
			var url = '<?php echo base_url();?>index.php?student/rate/'+loan;
			$.ajax({
			url: url,
			success: function(response)
			{
				var rst = jQuery.parseJSON(response);
				//alert(rst.interest_rate);
				var rate = rst.interest_rate;
				var life = rst.max_loan_life;
				jQuery('#rate').val(rate);
				jQuery('#loan_max_life').val(life);
			}
		});
		});
	});
</script>