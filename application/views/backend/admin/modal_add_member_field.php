<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_field');?>
            	</div>
            	
            </div>
			<div class="panel-body">
				<?php echo form_open(base_url() . 'index.php?admin/additional_fields/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
				
				<div class="form-group">
					<label for="field_name" class="col-sm-4 control-label"><?= get_phrase('field_name');?></label>
					<div class="col-sm-8"><input class="form-control" type="text" name="field_name" id="field_name"/></div>
				</div>
				
				<div class="form-group">
					<label for="field_type" class="col-sm-4 control-label"><?= get_phrase('field_type');?></label>
					<div class="col-sm-8">
						<select class="form-control" name="field_type" id="field_type">
							<option><?= get_phrase('select');?></option>
							<?php
								$types = $this->db->get('additional_fields_type')->result_object();
								
								foreach($types as $opt):
							?>
								<option value="<?= $opt->additional_fields_type_id;?>"><?= ucfirst($opt->name);?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="category" class="control-label col-sm-4"><?= get_phrase('category');?></label>
					<div class="col-sm-8">
						<select class="form-control" name="category" id="category">
							<option><?= get_phrase('select');?></option>
							<?php
								$category = $this->db->get('additional_fields_category')->result_object();
								
								foreach($category as $cat):
							?>
								<option value="<?= $cat->name;?>"><?= ucfirst($cat->name);?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="active_status" class="col-sm-4 control-label"><?= get_phrase('active');?></label>
					<div class="col-sm-8">
						<select class="form-control" name="active_status" id="active_status">
							<option><?= get_phrase('select');?></option>
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
				</div>	
				
				<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_field');?></button>
						</div>
					</div>			
				
				<?php echo form_close();?>	
			</div>
		</div>
	</div>
</div>
				