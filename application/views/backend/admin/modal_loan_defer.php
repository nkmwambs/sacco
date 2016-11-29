<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('loan_deferment_details');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/loans/defer/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="reason" class="col-sm-3 control-label"><?php echo get_phrase('deferment_reason');?></label>
                        
						<div class="col-sm-6">
							<input type="text" class="form-control" name="reason" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="action_date" class="col-sm-3 control-label"><?php echo get_phrase('deferment_date');?></label>
                        
						<div class="col-sm-6">
							
							<input type="text" class="form-control" name="action_date" id="action_date" data-provide="datepicker" data-start-view="2" data-date-start-date="0d" data-date-format="yyyy-mm-dd" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" >
							
						</div>
					</div>					
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('defer');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>