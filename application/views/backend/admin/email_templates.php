<?php
$templates = $this->db->get('mail_template')->result_object();
$phrases= $this->db->get('mail_phrase')->result_object();
?>
<hr/>
<div class="row">
	
<div class="tabs-vertical-env">	
	
			<ul class="nav tabs-vertical">
			<?php
				foreach($templates as $tabs):
			?>	
			<li class="_tabs">
					<a href="#<?= $tabs->mail_template_id;?>" data-toggle="tab">
						<?= $tabs->name;?>
					</a>
			</li>
			<?php
				endforeach;
			?>	
			</ul>	

<div class="tab-content">			

<?php
	
	foreach($templates as $row):
?>	
<div class="tab-pane" id="<?= $row->mail_template_id;?>">
	<div class="col-sm-9">
		
		
		<?php echo form_open(base_url() . 'index.php?Admin/email_templates/update/'.$row->mail_template_id , array('id'=>$row->mail_template_id,'class' => 'validate', 'enctype' => 'multipart/form-data'));?>
			
			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2">
					<button type="button" class="btn btn-green btn-icon">
						Update
						<i class="entypo-check"></i>
					</button>
				</div>
				
				<div class="col-sm-offset-1 col-sm-9">
					<input type="text" class="form-control" value="<?= $row->name;?>" name="post_title" readonly="readonly"/>
				</div>
			</div>
			
			<br />
			
			<!-- WYSIWYG - Content Editor class wysihtml5 -->
			<div class="row">
				<div class="col-sm-12">
					<textarea class="form-control" id="mail-template_<?= $row->mail_template_id;?>" rows="18"  name="post_content" id="post_content"><?= $row->content;?></textarea>
				</div>
			</div>
			
		</form>
		
	</div>
</div>	
<?php
	endforeach;
?>
</div>
</div>

</div>

<hr/>

<h3 style="">
           	<i class="entypo-right-circled"></i> 
				<?php echo get_phrase('mail_phrases');?>
</h3>

<hr/>

<div class="row">
	<div class="col-sm-12">
		
		<?php 
		foreach($phrases as $rw):
		?>
		
		<div class="col-sm-3">
		
		<?php echo form_open(base_url() . 'index.php?Admin/email_templates/update_phrase/'.$rw->mail_phrase_id , array('id'=>$row->mail_phrase_id));?>
		 <div class="tile-stats tile-gray">
                    <div class="icon"><i class="fa fa-mail-reply-all"></i></div> 
                    <div class="form-group">
                    	<label class="control-label tile-label" for="description"><h3>{<?= $rw->name;?>}</h3></label>
                    	<input class="form-control" name="description" id="description" value="<?= $rw->description;?>"/>    
                    </div>
                 <span class="fa fa-arrow-circle-o-right update_phrase"> Update</span>   
                </div>
                
         </form>
         
         </div>
         <?php endforeach;?>       
	</div>
</div>

<script>
	$(document).ready(function(){
		
		//Update a mail template
		
		$('button').click(function(){
			var frm = $(this).closest('form');
			var postData = $(frm).serializeArray();
		    var formURL = $(frm).attr("action");
		    $.ajax(
		    {
		        url : formURL,
		        type: "POST",
		        data : postData,
		        success:function(data, textStatus, jqXHR) 
		        {
					
		            alert('Template Updated successfully!');
		            
		        },
		        error: function(jqXHR, textStatus, errorThrown) 
		        {
		            alert(textStatus);      
		        }
		    });
		    e.preventDefault(); //STOP default action
		    e.unbind(); //unbind. to stop multiple form submit.
		});


		//Update a mail phrase
		
		$('.update_phrase').click(function(){
			var frm = $(this).closest('form');
			var postData = $(frm).serializeArray();
		    var formURL = $(frm).attr("action");
		    $.ajax(
		    {
		        url : formURL,
		        type: "POST",
		        data : postData,
		        success:function(data, textStatus, jqXHR) 
		        {
					
		            alert('Phrase Updated successfully!');
		            
		        },
		        error: function(jqXHR, textStatus, errorThrown) 
		        {
		            alert(textStatus);      
		        }
		    });
		    e.preventDefault(); //STOP default action
		    e.unbind(); //unbind. to stop multiple form submit.
		});
		
		//Make the first template active
		
		$.each($('.tab-pane'),function(i){
			if(i===0){
				$(this).addClass('active');
			}
		});
		
		$.each($('._tabs'),function(i){
			if(i===0){
				$(this).addClass('active');
			}
		});
		
		
	});
</script>