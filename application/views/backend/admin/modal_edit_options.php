<div class="row">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_fields');?>
            	</div>
            </div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12"><?= get_phrase('existing_field_options')?></div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-striped">
							<thead>
								<tr>
									<th><?= get_phrase('field_options')?></th>
									<th><?= get_phrase('action')?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$qry_fields = $this->db->get_where('additional_field_items',array('member_additional_field_id'=>$param2))->result_object(); 
									
									foreach($qry_fields as $rows):
								?>
								<tr>
									<td><?= $rows->item;?></td>
									<td><button class="btn btn-red" onclick="confirm_action('<?php echo base_url();?>index.php?admin/additional_fields/delete_options/<?php echo $rows->additional_field_items_id;?>');">Delete</button></td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
			</div><hr>
				 <?php echo form_open(base_url() . 'index.php?admin/additional_fields/options_create/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
				
				<div class="well well-sm">
					<i class="entypo-info-circled"></i>
					<?php echo get_phrase('to_create_multiple_options,_separate_the_option_values_with_semi-colon');?>
				</div>
				
				<div class="form-group">
					<label for="" class="control-label col-sm-4"><?= get_phrase('field_name');?></label>
					<div class="col-sm-8"><input type="text" class="form-control" name="item" id="item"/></div>					
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="suibmit" class="btn btn-primary btn-icon"><i class="fa fa-save""></i>Save</button>
					</div>
				</div>
				</form>	
			</div>
		</div>		
</div>