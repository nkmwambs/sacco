<?php
		
		
		echo form_open(base_url() . 'index.php?Admin/guarantors/add/'.$param2 , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));
		
		$member = $this->db->get("student")->result_array();		
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapse='0'>
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus-circled"></i>
					<?php echo get_phrase("add_guarantors");?>
				</div>
			</div>	
		
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo get_phrase('guarantor');?></label>
					<div class="col-sm-5">
						<select name="member_id" id="member_id" class="form-control">
			                    <option value=""><?php echo get_phrase('select');?></option>
								<?php
									foreach($member as $member_id):
								?>
									<option value="<?php echo $member_id['student_id'];?>"><?php echo $member_id['name'];?></option>
								<?php
									endforeach;
								?>
		                </select>
					</div> 
			</div>


              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('guarantor_potential');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="guarantor_potential" name="guarantor_potential" value="0" readonly="readonly" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>

              <div class="form-group">
                   <label class="col-sm-3 control-label"><?php echo get_phrase('amount');?></label>
                        <div class="col-sm-5">
                             <input type="text" class="form-control" id="share_guaranteed" name="share_guaranteed" value="0"  data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" />
                        </div>
              </div>
  
			
			<div class="form-group">
                 <div class="col-sm-offset-3 col-sm-5">
                       <button type="submit" class="btn btn-info"><?php echo get_phrase('add');?></button>
                 </div>
			</div>  
		</div>
	</div>
</div>

</div>
				          
        
</form>


<script type="text/javascript">
	jQuery(document).ready(function($)
	{

		
		$("#member_id").change(function(){
						
			//Get Interest Rate	
			var member_id = $("#member_id").val();
			//alert(member_id);
			var url = '<?php echo base_url();?>index.php?admin/guarantor_check/'+member_id;
			$.ajax({
					url: url,
					success: function(response)
					{
						jQuery('#guarantor_potential').val(response);
					}
				});	
		});
	
	});
</script>