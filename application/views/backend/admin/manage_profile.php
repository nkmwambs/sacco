
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/admin_add/');" 
class="btn btn-primary pull-right">
<i class="entypo-plus-circled"></i>
<?php echo get_phrase('admit_administrator');?>
</a> 
<br><hr>
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('manage_profile');?>
                    	</a>
            </li>
			
			<li class="">
            	<a href="#password" data-toggle="tab"><i class="entypo-lock"></i> 
					<?php echo get_phrase('change_password');?>
                    	</a>
            </li>
                        
           <li class="">
            	<a href="#admins" data-toggle="tab"><i class="entypo-users"></i> 
					<?php echo get_phrase('manage_administrators');?>
                    	</a>
            </li>
                    	            
            
		</ul>
    	<!------CONTROL TABS END------>
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
					<?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'index.php?admin/manage_profile/update_profile_info' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('admin' , $row['admin_id']);?>" alt="...">
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
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
            <!----EDITING FORM ENDS-->
            
            <!--MANAGE OTHER ADMINS-->
            <div class="tab-pane box" id="admins" style="padding: 5px">
            	<div class="box-content">
            	
	            	<table class="table table-bordered datatable" id="">
					    <thead>
					        <tr>
					            <th><div><?php echo get_phrase('name');?></div></th>
					            <th><div><?php echo get_phrase('email');?></div></th>
					            <th><div><?php echo get_phrase('active');?></div></th>
					            <th><div><?php echo get_phrase('options');?></div></th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php
					    		$admins = $this->db->get("admin")->result_array();
								
								foreach($admins as $row):
					    	?>
					    		<tr>
					    			<td><?php echo $row['name']?></td>
					    			<td><?php echo $row['email']?></td>
					    			<td><?php echo $row['active']?></td>
					    			<td>&nbsp;</td>
					    		</tr>
					    	<?php
					    		endforeach;
					    	?>
					    	
					    </tbody>
					  </table>  	
            	
            	
            	</div>
            </div>
            
            <!-- END MANAGE OTHER ADMINS -->
            
            <!--PASSWORD --->
            
            <div class="tab-pane box" id="password" style="padding: 5px">
                <div class="box-content padded">
					<?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'index.php?admin/manage_profile/change_password' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
            
            <!-- END PASSWORD --->
            
		</div>
	</div>
</div>
