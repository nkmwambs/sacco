<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_add_loan_type/');" 
class="btn btn-primary pull-right">
<i class="entypo-plus-circled"></i>
<?php echo get_phrase('add_loan_type');?>
</a> 
<br><br><hr>
<table class="table table-bordered datatable table-hover" id="">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('loan_type');?></div></th>
            <th><div><?php echo get_phrase('interest_rate');?></div></th>
            <th><div><?php echo get_phrase('guarantors_required');?></div></th>
            <th><div><?php echo get_phrase('loan_life');?></div></th>
            <th><div><?php echo get_phrase('loan_limit_by_amount');?></div></th>
            <th><div><?php echo get_phrase('loan_limit_by_ratio');?></div></th>
            <th><div><?php echo get_phrase('active');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
    		<?php
    		     			
    			$settings = $this->db->get("loan_settings")->result_array();
    		
    			$count=0;
			
				foreach($settings as $row):
    		?>
    	<tr>
    		<td><?php echo ++$count;?></td>
    		<td><?php echo ucfirst($row['loan_type'])?></td>
    		<td><?php echo $row['interest_rate']?></td>
    		<td class="<?php if($row['guarantee_required']==='yes'){echo 'entypo-check';}else{echo 'entypo-cancel';}?>"></td>
    		<td><?php echo $row['max_loan_life']?></td>
    		<td><?php echo $row['loan_limit_by_amount']?></td>
    		<td><?php echo $row['loan_limit_by_ratio']?></td>
    		<td class="<?php if($row['active']==='yes'){echo 'entypo-check';}else{echo 'entypo-cancel';}?>"></td>
    		<td>
    			<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- Loan Type EDITING LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_loan_type_edit/<?php echo $row['loan_settings_id'];?>');">
                            	<i class="entypo-pencil"></i>
									<?php echo get_phrase('edit');?>
                               	</a>
                        </li>
                        <li class="divider"></li>
                       	                       	                 	
                                 	
                    </ul>
                </div>
    		</td>
    	</tr>
	    	<?php
	    		endforeach;
	    	?>
    </tbody>
    </table>	