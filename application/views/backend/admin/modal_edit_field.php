<?php
$fields = $this->db->get_where('member_additional_field',array('	member_additional_field_id'=>$param2))->row();
?>
<div class="row">
	<div class="row">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_field');?>
            	</div>
            </div>
			<div class="panel-body">
			 <?php echo form_open(base_url() . 'index.php?admin/additional_fields/edit/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
				<div class="form-group">
					<label class="col-sm-4 control-label"><?= get_phrase('field_name');?></label>
					<div class="col-sm-8"><input type="text" name="field_name" class="form-control" value="<?= $fields->name;?>"/></div>
				</div><hr>
	
				<div class="form-group">
					<label class="col-sm-4 control-label"><?= get_phrase('field_type');?></label>
					<div class="col-sm-8"><select name="field_type" class="form-control">
						<option><?php echo get_phrase('select');?></option>
						<?php
							$types = $this->db->get('additional_fields_type')->result_object();
							
							foreach($types as $rw):
						?>
						
							<option value="<?= $rw->additional_fields_type_id;?>" <?php if($fields->field_type_id===$rw->additional_fields_type_id) echo 'selected';?>><?= ucfirst($rw->name);?></option>
						
						<?php endforeach;?>
					</select></div>
				</div><hr>
				
				<div class="form-group">
					<label for="category" class="col-sm-4 control-label"><?= get_phrase('category');?></label>
					<div class="col-sm-8">
						<select name="category" class="form-control">
							<option><?php echo get_phrase('select');?></option>
							
							<?php 
								$category = $this->db->get('additional_fields_category')->result_object();
								
								foreach($category as $cat):
							?>
								<option value="<?= $cat->name;?>" <?php if($cat->name===$fields->category) echo 'selected';?>><?= $cat->name;?></option>
							
							<?php endforeach;?>
							
						</select>
					</div>
				</div><hr>
	
				<div class="form-group">
					<label class="col-sm-4 control-label"><?= get_phrase('active');?></label>
					<div class="col-sm-8"><select name="active" class="form-control">
						<option><?php echo get_phrase('select');?></option>
						<option value="yes" <?php if($fields->active === 'yes') echo 'selected';?>>Yes</option>
						<option value="no" <?php if($fields->active === 'no') echo 'selected';?>>No</option>
					</select></div>
				</div><hr>
				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="suibmit" class="btn btn-primary btn-icon"><i class="fa fa-edit""></i>Edit</button>
					</div>
				</div>
			
			</form>
									
			</div>
	</div>
</div>			
</div>