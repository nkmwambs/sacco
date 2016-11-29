<hr>
<div class="row">
<div class="col-sm-6">	
	<div class="panel panel-primary" >            
         <div class="panel-heading">
             <div class="panel-title">
                  <?php echo get_phrase('system_reset');?>
           </div>
          </div>
                
          <div class="panel-body">
          	<a href="#" class="btn btn-icon btn-green" onclick="confirm_action('<?php echo base_url();?>index.php?admin/system_reset/backup');"><i class="fa fa-compress" ></i><?= get_phrase('back_up');?></a>
          	<button class="btn btn-icon btn-red" id="deleting"><i class="entypo-cancel-squared"></i><?= get_phrase('delete');?></button>
          	<hr>
                <?php
                	$map = directory_map('./backup/', FALSE, TRUE);
                ?>
                <table class="table table-hover table-striped">
                	<thead>
                		<tr>
                			<th><?= get_phrase('select');?></th>
                			<th><?= get_phrase('backup_file');?></th>
                			<th><?= get_phrase('backup_date');?></th>
                			<th><?= get_phrase('backup_size');?></th>
                		</tr>
                	</thead>
                	<tbody>
                		<?php foreach($map as $row): $prop = (object)get_file_info('backup/'.$row);?>
                		<tr>
                			<td><input type="checkbox" class="chk"/></td>
                			<td><a href="#" onclick="confirm_action('<?php echo base_url();?>index.php?admin/system_reset/download/<?= $row;?>');"><?= $row;?></a></td>
                			<td><?= date('d-m-Y',$prop->date);?></td>
                			<td><?= number_format(($prop->size/1000000),2).' MB';?></td>
                		</tr>
                		<?php endforeach;?>
                	</tbody>
                </table>
                
                <hr>
                <button class="btn btn-icon btn-red" onclick="confirm_action('<?php echo base_url();?>index.php?admin/system_reset/reset');"><?= get_phrase('reset');?></button>
          </div>
     </div>                	
</div>
</div>

<script>
	$(document).ready(function($){
		$('#deleting').click(function{
			alert('Hello');
		});
	});
</script>