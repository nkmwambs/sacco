<div class="row">
	<div class="col-md-12">
			
			
					
					<?php echo form_open(base_url() . 'index.php?student/guarantor/allocate/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('shares_guaranteed');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="share_guaranteed" value="" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                                </div>
                            </div>
                                                 
                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn btn-info"><?php echo get_phrase('accept_guarantorship');?></button>
                                </div>
							</div>
                        </form>
					
			
			
	</div>
</div>