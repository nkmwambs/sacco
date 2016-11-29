<?php
//print_r($this->sacco_model->loans());
//echo $this->db->select_max('repayment_id')->get_where('repayment',array('loans_id'=>'17'))->row()->repayment_id;
?>
<div class="row">
	<div class="panel panel-primary">
				<div class="panel-heading">
						<div class="panel-title">Statistics Tiles</div>
				
						<div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div>
					</div>
			
			<div class="panel-body">		
            <div class="col-sm-3 col-xs-6">

            <!-- Number Of Members -->
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('student');?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('students');?></h3>
                   <p><?php echo get_phrase("total_members");?></p>
                </div>
			</div>

             <!-- Current Year Interest Earned -->
             <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="fa fa-info"></i></div>
                    <?php
						
						$this->db->where('YEAR(`repayment_date`)',date('Y'));
						
						$interest = $this->db->select_sum('intr')->get('repayment')->row()->intr;

                    ?>
                    <div class="num" data-start="0" data-end="<?php echo $interest;?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('current_year_interest');?></h3>
                   <p><?php echo get_phrase("interest_earned");?></p>
                </div>  
              </div>  
                                
             <!-- Total Active Loans -->
             <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="fa fa-money"></i></div>
                    <?php
                    	$loan_balance_query = $this->db->get("student")->result_array();
						
						$loan_balance = 0;
						
						foreach($loan_balance_query as $row):
							$details = $this->crud_model->get_member_details($row['student_id']);
							
							$loan_types_query = $this->db->get("loan_settings")->result_array();
							
							foreach($loan_types_query as $type):
								$loan_balance += $details['loan_balance'][$type['loan_type']];
							endforeach;
							
						endforeach;
                    ?>
                    <div class="num" data-start="0" data-end="<?php echo $loan_balance;?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('Loans');?></h3>
                   <p><?php echo get_phrase("loan_balance");?></p>
                </div>
                </div>
                
             <!-- Total Shares Saved -->
             <div class="col-sm-3 col-xs-6">
                <div class="tile-stats tile-brown">
                    <div class="icon"><i class="fa fa-share-square"></i></div>
                    <?php
                    	$member_query = $this->db->get("student")->result_array();
						
						$total_shares = 0;
						
						foreach($member_query as $row):
							$details = $this->crud_model->get_member_details($row['student_id']);
							$total_shares += $details['shares']['amount'];
						endforeach;
                    ?>
                    <div class="num" data-start="0" data-end="<?php echo $total_shares;?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('shares');?></h3>
                   <p><?php echo get_phrase("total_shares");?></p>
                </div>                
            </div>
           </div>
           </div>
    	</div>
    	
    	<div class="row">
    		<div class="col-sm-8">
    			<div class="panel panel-primary" id="charts_env">
    				<div class="panel-heading">
						<div class="panel-title">Sacco Trends</div>
		
						<div class="panel-options">
							
							<ul class="nav nav-tabs">
								<li  class="active"><a href="#interest-chart" data-toggle="tab">Interest Earned</a></li>
								<li><a href="#shares-chart" data-toggle="tab">Shares</a></li>
								<li class=""><a href="#loans-chart" data-toggle="tab">Loans</a></li>
							</ul>
							
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							
						</div>
					</div>
            
            		<div class="panel-body">
		
						<div class="tab-content">
							
            				<div class="tab-pane active" id="interest-chart">
            					<div id="interest-chart-body">  </div>
            				</div>
            				
            				<div class="tab-pane" id="shares-chart">
            					<div id="shares-chart-body">  </div>
            				</div>	
            				
            				<div class="tab-pane" id="loans-chart">
            					<div id="loans-chart-body">  </div>
            				</div>	
            			
            			</div>
            			
            		</div>	
            
            	</div>
            </div>
            
        </div>
    

		

	



<?php

//Interest	  			
$rst = $this->db->select('Year(repayment_date) as year')->select_sum('intr')->select_sum('end_bal')->group_by('Year(repayment_date)')->get('repayment')->result_object();

//SELECT YEAR(`repayment_date`) as  year,SUM(`intr`),SUM(end_bal) FROM `repayment` GROUP BY YEAR(`repayment_date`)  

//$bal = $this->db->select('Year(repayment_date) as year')->select_sum('end_bal')->group_by('Year(repayment_date)')->get('repayment')->result_object();

$data = '';
foreach ($rst as $row) { 
  $data .= "{ year: '".$row->year."', intr: ".$row->intr.",bal:".$row->end_bal."},";
} 

//Shares

$total_shares = $this->db->select_sum('amount')->get('shares')->row()->amount;
$guaranteed_shares = $this->db->select_sum('share_guaranteed')->get_where('guarantors',array('status'=>'accepted'))->row()->share_guaranteed;
$free_shares = $total_shares - $guaranteed_shares;

  //$data2 = "{ year: '".$row->year."', value: '".$row->amount."'},";
 
 //print_r(rtrim($data, ","));
	  		
?>


<script>
  $(document).ready(function() {
	  
	  		
					//Chart
				
				new Morris.Line({
				  // ID of the element in which to draw the chart.
				  element: 'interest-chart',
				  // Chart data records -- each entry in this array corresponds to a point on
				  // the chart.
				  data:[<?php echo rtrim($data, ",");?>],
				  // The name of the data record attribute that contains x-values.
				  xkey: 'year',
				  // A list of names of data record attributes that contain y-values.
				  ykeys: ['intr','bal'],
				  // Labels for the ykeys -- will be displayed when you hover over the
				  // chart.
				  labels: ['Interest Earned','Loan Balance']
				});
		

					//Chart
				
				Morris.Donut({
				  element: 'shares-chart',
				  data: [
				    {label: "Guaranteed Shares", value: <?php echo $guaranteed_shares;?>},
				    {label: "Free Shares", value: <?php echo $free_shares;?>},
				    {label: "Total Shares", value: <?php echo $total_shares;?>},
				    
				  ]
				});
				
				
		
				
	});

</script>
  


  
