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
					<?php echo get_phrase('edit_member');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/member/do_update/'.$row['student_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                
                	<div class="well well-sm">Basic Information</div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'];?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('roll');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="roll" value="<?php echo $row['roll'];?>" >
						</div> 
					</div>
						
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('membership_date');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" data-provide="datepicker" data-date-end-date="0d" data-date-format="yyyy-mm-dd" name="membershipdate" value="<?php echo $row['membershipdate'];?>" data-start-view="2">
						</div> 
					</div>			
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" data-provide="datepicker" data-date-end-date="0d" data-date-format="yyyy-mm-dd" name="birthday" value="<?php echo $row['birthday'];?>" data-start-view="2">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                              <option value="female"<?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['address'];?>">
						</div>
					</div>
					

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['phone'];?>">
						</div>
					</div>
					
										
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('department');?></label>
                        
						<div class="col-sm-5">
							<select name="department_id" class="form-control select2" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$department = $this->db->get_where('department')->result_array();
									foreach($department as $row3):
										?>
                                		<option value="<?php echo $row3['department_id'];?>"
                                        	<?php if($row['department_id'] == $row3['department_id'])echo 'selected';?>>
													<?php echo $row3['name'];?>
                                                </option>
	                                <?php
									endforeach;
								  ?>
                          </select>
						</div> 
					</div>
					
										                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>">
						</div>
					</div>
					
					<div class="well well-sm">Additional Information</div>
					
					<?php
						echo $this->crud_model->form_edit_additional_fields($param2,'membership');
					?>
					                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_member');?></button>
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