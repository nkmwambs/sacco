<a href="<?php echo base_url();?>index.php?admin/loans/" 
class="btn btn-primary pull-right">
<i class="entypo-back"></i>
<?php echo get_phrase('back');?>
</a> 
<br><br>
<?php
//echo $member_id;

$loans_query = $this->db->get_where("loans",array("loans_id"=>$loans_id,"status"=>"active"));

$member_name = $this->db->get_where("student",array("student_id"=>$member_id))->row()->name;

$msg = "";

if($loans_query->num_rows() === 0){
	$msg = "No active loan available";
}else{
	$loans = $loans_query->result_array();
}

echo form_open(base_url() . 'index.php?admin/member_bulk_add/import_schedules/'.$loans_id , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));
?>

             <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('member');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="" name="" readonly="readonly" value="<?php echo $member_name;?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
             </div>

			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select_excel_file');?></label>
                        
					<div class="col-sm-5">
                      	<input type="file" name="userfile" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                           <br>
                        <a href="<?php echo base_url();?>uploads/blank_excel_schedule_file.csv" target="_blank" 
                         		class="btn btn-info btn-sm"><i class="entypo-download"></i> Download blank excel file</a>
					</div>
			</div>


           <div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" class="btn btn-info"><?php echo get_phrase('upload_and_import');?></button>
				</div>
     	   </div>
</form>