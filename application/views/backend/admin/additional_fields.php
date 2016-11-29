<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('additional_membership_fields');?>
            	</div>
            	
            </div>
			<div class="panel-body">
			<button class="btn btn-primary btn-icon" onclick="showAjaxModal('<?php base_url();?>index.php?modal/popup/modal_add_member_field')"><i class="entypo-plus-squared"></i><?= get_phrase('add_field');?></button>				
				<table class="table table-striped">
					<thead>
						<tr>
							<th><?= get_phrase('field_name');?></th>
							<th><?= get_phrase('field_type');?></th>
							<th><?= get_phrase('category');?></th>
							<th><?= get_phrase('active');?></th>
							<th><?= get_phrase('options');?></th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$flds = $this->db->get('member_additional_field')->result_object();
							
							foreach($flds as $fld):
						?>
							<tr>
								<td><?= get_phrase($fld->name);?></td>
								<td><?= ucfirst($this->crud_model->additional_field_type($fld->field_type_id));?></td>
								<td><?= ucfirst($fld->category);?></td>
								<td><?= ucfirst($fld->active);?></td>
								<td>
									
									<div class="btn-group">
									                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
									                        Action <span class="caret"></span>
									                    </button>
									                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

									                        <li>
									                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_field/<?php echo $fld->member_additional_field_id;?>');">
									                            	<i class="fa fa-edit"></i>
																		<?php echo get_phrase('edit_field');?>
									                               	</a>
									                       	</li>     

									                       <li class="divider"></li>
									                                           	
									                       	<!--Edit Options-->
									                       	
									                       	<?php if($this->crud_model->additional_field_type($fld->field_type_id)!=='text'){?>
									                       	
									                        <li>
									                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_options/<?php echo $fld->member_additional_field_id;?>');">
									                            	<i class="fa fa-adjust"></i>
																		<?php echo get_phrase('edit_options');?>
									                               	</a>
									                       	</li> 									                       	
									                       
									                       <li class="divider"></li>
									                        
									                        <?php }?>
									                                           	
									                       	<!--Deactivate-->
									                       	
									                        <li>
									                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/additional_fields/deactivate/<?php echo $fld->member_additional_field_id;?>/<?php echo $fld->active;?>');">
									                            	<i class="entypo-back-in-time"></i>
																		<?php echo $fld->active==='yes'?get_phrase('deactivate'):get_phrase('activate');?>
									                               	</a>
									                       	</li>     
									                       	
									                       
									                       <li class="divider"></li>

									                       	                       	
									                       	<!--Delete Field-->
									                       	
									                        <li>
									                        	<a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/additional_fields/delete/<?php echo $fld->member_additional_field_id;?>');">
									                            	<i class="entypo-cancel-squared"></i>
																		<?php echo get_phrase('delete');?>
									                               	</a>
									                       	</li>     	                       	                 	
									                                 	
									                    </ul>
									                </div>									
									
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
				
	</div>
</div>