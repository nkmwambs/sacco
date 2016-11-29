<a href="<?php echo base_url();?>index.php?admin/member/" 
class="btn btn-primary pull-right">
<i class="entypo-back"></i>
<?php echo get_phrase('back');?>
</a> 

<div class="row">			
			<div class="col-md-3 col-sm-5">
				
				<form method="get" role="form" class="search-form-full">
				
					<div class="form-group">
						<input type="text" class="form-control" name="s" id="search-input" placeholder="Search..." />
						<i class="entypo-search"></i>
					</div>
					
				</form>
				
			</div>
		</div>
		
		
		<!-- Member Entries -->
		<?php
        	$members = $this->db->get("student")->result_array();
        	foreach ($members as $row):		
		?>
		<!-- Single Member -->
		<div class="member-entry">
				
			<a href="extra-timeline.html" class="member-img">
				<img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-rounded" />
				<i class="entypo-forward"></i>
			</a>
			
			<div class="member-details">
				<h4>
					<a href="<?= base_url();?>index.php?admin/activity"><?= $row['name'];?></a>
				</h4>
				
				<!-- Details with Icons -->
				<div class="row info-list">
					
					<div class="col-sm-4">
						<i class="entypo-briefcase"></i>
						Co-Founder at <a href="#">Complete Tech</a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-twitter"></i>
						<a href="#">@johnnie</a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-facebook"></i>
						<a href="#">fb.me/johnnie</a>
					</div>
					
					<div class="clear"></div>
					
					<div class="col-sm-4">
						<i class="entypo-location"></i>
						<a href="#">Prishtina</a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-mail"></i>
						<a href="#">john@gmail.com</a>
					</div>
					
					<div class="col-sm-4">
						<i class="entypo-linkedin"></i>
						<a href="#">johnkennedy</a>
					</div>
					
				</div>
			</div>
			
		</div>
		
		<?php endforeach;?>
		
		
		<!-- Pager for search results -->
		<div class="row">
			<div class="col-md-12">
				<ul class="pager">
					<li><a href="#"><i class="entypo-left-thin"></i> Previous</a></li>
					<li><a href="#">Next <i class="entypo-right-thin"></i></a></li>
				</ul>
			</div>
		</div>
		
		
		
		
		
		
		
		
		
		
		




