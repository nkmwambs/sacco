<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('comments');?>
            	</div>
            </div>
			<div class="panel-body">
				<?php 
					$comments = $this->db->get_where('loan_comments',array('loans_id'=>$param2))->result_object();
					
					$comment_text = '';
					
					foreach($comments as $row):
					
					if($row->comment_code==='1'):
						$comment_text = 'Declined Comment dated '.$row->stamp. ' by '. $this->db->get_where('admin',array('admin_id'=>$row->comment_by))->row()->name;
					endif;
						
					if($row->comment_code==='2'):
						$comment_text = 'Deferred Comment dated '.$row->stamp. ' by '. $this->db->get_where('admin',array('admin_id'=>$row->comment_by))->row()->name;
					endif;
				?>
				
				<div class="panel panel-info">
					        <div class="panel-heading">
			            	<div class="panel-title" >
			            		<i class="entypo-plus-circled"></i>
								<?= $comment_text;?>
			            	</div>
			            </div>
			            <div class="panel-body">
			            	<?= $row->comment;?>
			            </div>
				</div>
				
				<?php
					endforeach;
				?>
					
					
            </div>
        </div>
    </div>
</div>