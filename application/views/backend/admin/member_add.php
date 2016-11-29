<div class="row">
	<div class="col-md-12">
		
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#basic" data-toggle="tab"><i class="entypo-user-add"></i> 
					<?php echo get_phrase('basic_information');?>
                    	</a></li>
			<li>
            	<a href="#additional" data-toggle="tab"><i class="fa fa-info-circle"></i>
					<?php echo get_phrase('additional_information');?>
                    	</a></li>
		</ul>
		
		
		<div class="tab-content">
		<!----TABLE LISTING STARTS-->
		<div class="tab-pane box active" id="basic">
		
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('basic_information');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/member/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('roll');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="roll" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control"  data-provide="datepicker" data-start-view="2" data-date-end-date="0d" data-date-format="yyyy-mm-dd" name="birthday" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-5">
							<select name="sex" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" >
						</div> 
					</div>

					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('department');?></label>
                        <div class="col-sm-5">
                            <select name="department_id" class="form-control" required>
                                <option value=""><?php echo get_phrase('select_department');?></option>
                                <?php 
                                	$department = $this->db->get('department')->result_array();
                                	foreach ($department as $row):
                                ?>
                                <option value="<?php echo $row['department_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('membership_date');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" data-provide="datepicker" data-date-end-date="0d" data-date-format="yyyy-mm-dd"  name="membershipdate" value="" data-start-view="2">
						</div> 
					</div>
                    
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('monthly_share_rate');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="monthly_share_rate" value="">
						</div> 
					</div>                    
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="email" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" value="" >
						</div> 
					</div>

					
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
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
                    

                
            </div>
        </div>
    </div>
    
    <div class="tab-pane box" id="additional">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('additional_information');?>
            	</div>
            </div>
			<div class="panel-body">
				
			<?php
			echo $this->crud_model->form_add_additional_fields('membership');
			?>	
				    	
                    <hr><div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_member');?></button>
						</div>
					</div>
 			</div>
 		</div>
 		   
    </div>		
    <?php echo form_close();?>	
</div>
</div>
</div>


