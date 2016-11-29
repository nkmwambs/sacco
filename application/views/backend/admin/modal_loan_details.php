<hr />
<?php
$loans = $this->sacco_model->loans('active',$param2);
//print_r($loans);
?>
<div class="row">
	<div class="col-md-12">
	
		<div class="tabs-vertical-env">
		
			<ul class="nav tabs-vertical">
				
				<?php foreach($loans as $key=>$row):?>
				
					<li class="<?php if($key===0) echo 'active';?>"><a href="#<?php echo $row->loan_type;?>" data-toggle="tab"><?php echo ucfirst($row->loan_type);?></a></li>
				
				<?php endforeach;?>
				
			</ul>
			
			<div class="tab-content">
				
				<?php foreach($loans as $key=>$row):?>

				<div class="tab-pane <?php if($key===0) echo 'active';?>" id="<?php echo $row->loan_type;?>">
				
				<form>
					<div class="row">
						<div class="form-group">	
							<div class="col-sm-6"><label class="control-label"><?php echo get_phrase('loan_advanced_date');?></label></div>
							<div class="col-sm-6"><input class="form-control" value="<?php echo $row->timestamp;?>"  readonly="readonly"/></div>
						</div>
					</div><br>

					<div class="row">
						<div class="form-group">	
							<div class="col-sm-6"><label class="control-label"><?php echo get_phrase('loan_advanced');?></label></div>
							<div class="col-sm-6"><input class="form-control" value="<?php echo $row->principle;?>"  readonly="readonly"/></div>
						</div>
					</div><br>
					
					<div class="row">
						<div class="form-group">
							<div class="col-sm-6"><label class="control-label"><?php echo get_phrase('loan_balance');?></label></div>
							<div class="col-sm-6"><input class="form-control" readonly="readonly" value="<?php echo $this->sacco_model->loan_balance($row->loans_id);?>"/></div>
						</div>	
					</div><br>
					
					<div class="row">
						<div class="form-group">
							<div class="col-sm-6"><label class="control-label"><?php echo get_phrase('scheduled_payment');?></label></div>
							<div class="col-sm-6"><input class="form-control" readonly="readonly" value="<?= $row->sched_pay;?>"/></div>
						</div>	
					</div><br>					

					<div class="row">
						<div class="form-group">
							<div class="col-sm-6"><label class="control-label"><?php echo get_phrase('extra_payment');?></label></div>
							<div class="col-sm-6"><input class="form-control" readonly="readonly" value="<?= $row->extra_pay;?>"/></div>
						</div>	
					</div><br>	

					<div class="row">
						<div class="form-group">	
							<div class="col-sm-6"><label class="control-label"><?php echo get_phrase('last_repayment_date');?></label></div>
							<div class="col-sm-6"><input class="form-control"  readonly="readonly" value="<?php echo $this->sacco_model->last_loan_repayment($row->loans_id)->repayment_date?>"/></div>
						</div>	
					</div><br>
					
					<div class="row">
						<div class="form-group">	
							<div class="col-sm-6"><label class="control-label"><?php echo get_phrase('defaulter');?></label></div>
							<div class="col-sm-6"><input class="form-control"  readonly="readonly" value="<?php echo ucfirst($row->defaulter);?>"/></div>
						</div>	
					</div>
					
				</form>
					
				</div>
				
				<?php endforeach;?>

								
			</div>
			
		</div>	
	
	</div>
</div>

