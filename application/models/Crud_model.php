<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }
	
	
	function set_empty_result($query){
				$fields = $query->list_fields();
				$query=array();
				foreach($fields as $field):
						$query[0][$field] = 0;
				endforeach;
				
				return $query;
	}
	
	function custom_fields($category){
		$additional_fields = $this->db->select('name')->get_where('member_additional_field',array('active'=>'yes','category'=>$category))->result_object();
		
		$fld_arr = array();
		foreach($additional_fields as $fields):
			$fld_arr[]=$fields->name;
		endforeach;
		
		return $fld_arr;
	}
		
	function set_additional_field($param=array()){
		//($type='',$name='',$fld_id='',$value='')
		$options = $this->db->get_where('additional_field_items',array('member_additional_field_id'=>$param['id']))->result_object();
		$str = "";
			
		if($param['type']==='text'){
			$str = '<input type="text" name="'.$param['name'].'" class="form-control" value="'.$param['value'].'"/>';
		}
		
		if($param['type']==='select'){
			$str = '<select name="'.$param['name'].'" class="form-control">';
				$str .= '<option value="">'.get_phrase('select').'</option>';
				foreach($options as $opt):
					if($opt->item===$param['value']){
						$str .="<option value='".$opt->item."' selected>".$opt->item."</option>";
					}else{
						$str .="<option value='".$opt->item."'>".$opt->item."</option>";
					}	
						 
				
				endforeach;
			$str .= '<select>';
		}
		
		if($param['type']==='radio'){
			foreach($options as $opt):
				if($opt->item===$param['value']){
					$str .="<input type='radio'  name='".$param['name']."' value='".$opt->item."' checked/>".ucfirst($opt->item)."<br>";
				}else{
					$str .="<input type='radio'  name='".$param['name']."' value='".$opt->item."'/>".ucfirst($opt->item)."<br>";
				}
			endforeach;
		}
		
		if($param['type']==='checkbox'){
			foreach($options as $opt):
				if($opt->item===$param['value']){
					$str .="<input type='checkbox' class='form-control' name='".$param['name']."[]' checked value='".$opt->item."'/>".ucfirst($opt->item)."<br>";
				}else{
					$str .="<input type='checkbox' class='form-control' name='".$param['name']."[]' value='".$opt->item."'/>".ucfirst($opt->item)."<br>";
				}
			endforeach;			
		}
		
		return $str;
	}
	
	function form_add_additional_fields($category){
		$str = '';
		$additional_fields = $this->db->get_where('member_additional_field',array('active'=>'yes','category'=>$category))->result_object();
					
		foreach($additional_fields as $flds):
			$str .= '<div class="form-group">';
					$str .= '<label for="<?= $flds->name;?>" class="col-sm-3 control-label ">'.get_phrase($flds->name).'</label>';
					$str .= '<div class="col-sm-5">'. $this->set_additional_field(array('type'=>$this->additional_field_type($flds->field_type_id),'name'=>$flds->name,'id'=>$flds->member_additional_field_id)).'</div>';
					$str .= '</div><br><hr>';
				
		endforeach;
		
		return $str;
	}
	

	
	function form_edit_additional_fields($member_id,$category){
		
		$str = '';
		
		$additional_fields = $this->custom_fields($category);
						
			foreach($additional_fields as $field_name):
							
				$custom_field = $this->db->get_where('member_additional_field',array('name'=>$field_name))->row();
							
				$field = $this->db->get_where('member_additional_info',array('additional_field_id'=>$custom_field->member_additional_field_id,'member_id'=>$member_id))->row();	
							
					$str .= '<div class="row"><div class="form-group">';
					$str .= '<label for="field-1" class="col-sm-3 control-label">'. get_phrase(str_replace('_',' ',$field_name)).'</label>';
					$str .= '<div class="col-sm-5">';
					$str .= $this->crud_model->set_additional_field(array('type'=>$this->crud_model->additional_field_type($custom_field->field_type_id),'name'=>$custom_field->name,'id'=>$custom_field->member_additional_field_id,'value'=>$field->additional_info));
					$str .= '</div>';
					$str .= '</div></div><hr>';
					
			endforeach;
			
	return $str;		
	}
	
	function form_view_additional_fields(){
		
	}

	function insert_additional_info($member_id,$category){
			foreach($this->custom_fields($category) as $val):
				$data3['member_id'] = $member_id;
				$data3['additional_field_id'] = $this->db->get_where('member_additional_field',array('name'=>$val))->row()->member_additional_field_id;
				$data3['additional_info'] = $this->input->post($val);	
				
				$this->db->insert("member_additional_info",$data3);
			endforeach;			
	}
	
	function update_additional_info($member_id,$category){
		foreach($this->custom_fields($category) as $val):

				$custom_field = $this->db->get_where('member_additional_field',array('name'=>$val))->row();	
				
				$this->db->where(array('additional_field_id'=>$custom_field->member_additional_field_id,'member_id'=>$member_id));
				
				//Info exists
				
				$info = $this->db->get('member_additional_info')->row();
				
				if(count($info)>0){
				
					$this->db->where(array('additional_field_id'=>$custom_field->member_additional_field_id,'member_id'=>$member_id));
				
					$data2['additional_info'] = $this->input->post($val);	
				
					$this->db->update("member_additional_info",$data2);
				}else{
					$data2['member_id'] = $member_id;
					$data2['additional_field_id'] = $this->db->get_where('member_additional_field',array('name'=>$val))->row()->member_additional_field_id;
					$data2['additional_info'] = $this->input->post($val);	
					
					$this->db->insert("member_additional_info",$data2);					
				}
			endforeach;
	}	
	function additional_field_type($field_type_id=""){
		
		$name = $this->db->get_where('additional_fields_type',array('additional_fields_type_id'=>$field_type_id))->row()->name;
		
		return $name;
	}

    ////////MEMBERS/////////////
    function get_member($member_id) {
        $query = $this->db->get_where('student', array('student_id' => $member_id))->result_object('members');
        //return $this;
        return $query;
    }
	
	 function get_members() {
        $query = $this->db->get('student')->row(0);//->result_object('members');
        //return $this;
        return $query;
    }
	
	
	function get_member_details($member_id,$tag=array()){
		
		/*
		 * Main Array Elements Initialization
		 */
		
		$computed = array();
		$main = array(); //This can only have a maximum depth of 2
		
		//Member Details
		$main['member']=array();// Has one Element
		
		//Loan Types
		$main['loan_types']=array();
		
		//Initialize Loan Details
		$main['active_loan']=array();// number of elements depends on loan types from loans_settings table
		$main['submitted_loan']=array();// number of elements depends on loan types from loans_settings table
		$main['loan_balance']=array();// number of elements depends on loan types from loans_settings table
		$main['effective_loan_balance']=array();
		$main['unsubmitted_loan']=array();// number of elements depends on loan types from loans_settings table
		$main['loan_payment'] = array();// number of elements depends on loan types from loans_settings table
		$main['one_time_extra_payment'] = array();//number of elements depends on loan types from loans_settings table
		$main['scheduled_extra_payment'] = array();
		$main['scheduled_payment']=array();
		$main['excess_payment']=array();
		$main['pmt']=array();
		
		//Initialize Department Details
		$main['department']=array();
		
		//Initialize Share Details
		$main['shares']=array(); // Has two elements: amount and guaranteed
		$main['share_rate'] = 0;
		$main['share_statement']=array();
		
		//Initialize Worthiness
		$main['worthiness']=0;		
		
		//Initialize Guarantorship
		$main['unsubmitted_loan_guarantors'] = array();// number of elements depends on loan types from loans_settings table
		$main['unsubmitted_loan_guarantor_deficit'] = array();// number of elements depends on loan types from loans_settings table
		$main['submitted_loan_guarantors'] = array();// number of elements depends on loan types from loans_settings table
		$main['submitted_loan_guarantor_deficit'] = array();// number of elements depends on loan types from loans_settings table	
		$main['active_loan_guarantors'] = array();// number of elements depends on loan types from loans_settings table
		$main['active_loan_guarantor_deficit'] = array();// number of elements depends on loan types from loans_settings table
		
		//Initialize Total Deductions
		$main['deductions'] = 0;
		
		/*
		 * 
		 * Main Array Values 
		 * 
		 */
		 
		//Member Details
			//$member_query = $this->db->get_where("student",array("student_id"=>$member_id))->result_array();
			
			$member_query = $this->db->query('CALL get_member(?)',array($member_id))->result_array();
			
			foreach($member_query as $row):
				$main['member'] = $row;
			endforeach;
			
		//Loan Types
			//$loan_types_query = $this->db->get("loan_settings")->result_array();
			$loan_types_query = $this->db->query('CALL loan_types')->result_array();
			foreach($loan_types_query as $row):
				$main['loan_types'][$row['loan_type']] = $row;
			endforeach;
			

		//Active Loan Details
		foreach($main['loan_types'] as $type):
				
			//$active_loan_query = $this->db->get_where("loans",array("member_id"=>$member_id,"status"=>"active","loan_type"=>$type['loan_type']));
			
			$active_loan_query = $this->db->query('CALL loan(?,?,?)',array($member_id,"active",$type['loan_type']));
			
			if($active_loan_query->num_rows()==0){
				$main['active_loan'][$type['loan_type']] = $this->set_empty_result($active_loan_query);
			}else{
				foreach($active_loan_query->result_array() as $row):
					$main['active_loan'][$type['loan_type']] = $row;
				endforeach;
			}
			
		endforeach;
		
		//New/ Submitted Loan Details
		foreach($main['loan_types'] as $type):
			$submitted_loan_query = $this->db->get_where("loans",array("member_id"=>$member_id,"status"=>"submitted","loan_type"=>$type['loan_type']));
			
			//$submitted_loan_query - $this->db->query('CALL loan(?,?,?)',array($member_id,"submitted",$type['loan_type']));
			
			if($submitted_loan_query->num_rows()===0){
				$main['submitted_loan'][$type['loan_type']] = $this->set_empty_result($submitted_loan_query);
			}else{
				foreach($submitted_loan_query->result_array() as $row):
					$main['submitted_loan'][$type['loan_type']] = $row;
				endforeach;
			}
		endforeach;	
				

		//Unsubmitted Loan Details
		foreach($main['loan_types'] as $type):
				
			$unsubmitted__loan_query = $this->db->get_where("loans_history",array("member_id"=>$member_id,"status"=>"new","loan_type"=>$type['loan_type']));
			
			//$unsubmitted__loan_query - $this->db->query('CALL loans_origin(?,?,?)',array($member_id,"new",$type['loan_type']));
			
			if($unsubmitted__loan_query->num_rows()==0){
				$main['unsubmitted_loan'][$type['loan_type']] = $this->set_empty_result($unsubmitted__loan_query);
			}else{
				foreach($unsubmitted__loan_query->result_array() as $row):
					$main['unsubmitted_loan'][$type['loan_type']] = $row;
				endforeach;
			}
			
		endforeach;
				
		
		//Loan Balance
		foreach($main['loan_types'] as $type):
			$loan_id_query = $this->db->get_where("loans",array("loan_type"=>$type['loan_type'],"status"=>"active","member_id"=>$member_id));
			//$loan_id_query - $this->db->query('CALL loan(?,?,?)',array($member_id,"active",$type['loan_type']));
			
			if($loan_id_query->num_rows() === 0){
				$main['loan_balance'][$type['loan_type']] = 0;
			}else{
				
				$loan_id = $loan_id_query->row()->loans_id;
				
				//Total Principal Paid
				if($this->db->select_sum("princ")->get_where("repayment",array("loans_id"=>$loan_id))->num_rows() === 0){
					$paid_principal=0;
				}else{
					$paid_principal = $this->db->select_sum("princ")->get_where("repayment",array("loans_id"=>$loan_id))->row()->princ;
				}
				
				
				//Loan Principal				
				$principal = $main['active_loan'][$type['loan_type']]['principle'];
				
				$main['loan_balance'][$type['loan_type']] = $principal-$paid_principal;
			}
			
		endforeach;		

		//Effective Loan Balance
		
		foreach($main['loan_types'] as $type):
			$loan_balance = $main['loan_balance'][$type['loan_type']];
			
			$efrate = $main['loan_types'][$type['loan_type']]['interest_rate']/12;
			$main['effective_loan_balance'][$type['loan_type']] = $loan_balance+($efrate*$loan_balance);
			
		endforeach;


		//Member One time Extra Payment							
		foreach($main['loan_types'] as $type):
		$added_pay_query = $this->db->select_sum('extra_pay')->get_where("extra_payments",array("loans_id"=>$main['active_loan'][$type['loan_type']]['loans_id'],"status"=>"approved"));
				
		if($added_pay_query->num_rows()  === 0){
			$main['one_time_extra_payment'][$type['loan_type']]=0;	
		}else{
			$main['one_time_extra_payment'][$type['loan_type']] = $added_pay_query->row()->extra_pay;
		}
		endforeach;
		
		
		//Scheduled Payment
		
		foreach($main['loan_types'] as $type):
			$loan_sched_payment_query = $this->db->get_where("loans",array("member_id"=>$member_id,"status"=>"active","loan_type"=>$type['loan_type']));	
			
			if($loan_sched_payment_query->num_rows === 0){
				$main['scheduled_payment'][$type['loan_type']]  = 0;
			}else{
				$main['scheduled_payment'][$type['loan_type']] = $loan_sched_payment_query->row()->sched_pay;
			}
		endforeach;			
		
		
		//Scheduled Extra Payment
		
		foreach($main['loan_types'] as $type):
			$loan_extra_payment_query = $this->db->get_where("loans",array("member_id"=>$member_id,"status"=>"active","loan_type"=>$type['loan_type']));	
			
			if($loan_extra_payment_query->num_rows === 0){
				$main['scheduled_payment'][$type['loan_type']]  = 0;
			}else{
				
				$main['scheduled_extra_payment'][$type['loan_type']] = $loan_extra_payment_query->row()->extra_pay;
				
				$one_time_extra_payment  = $main['one_time_extra_payment'][$type['loan_type']];
				$scheduled_extra_payment = $main['scheduled_extra_payment'][$type['loan_type']];
				$scheduled_payment = $main['scheduled_payment'][$type['loan_type']];
				$combined_extra_payment = $one_time_extra_payment+$scheduled_extra_payment;
				
				$eff = $main['effective_loan_balance'][$type['loan_type']];
				
				if($one_time_extra_payment>$eff){
					$main['scheduled_payment'][$type['loan_type']] = 0;
					$main['scheduled_extra_payment'][$type['loan_type']] = 0;
					$main['excess_payment'][$type['loan_type']] = $one_time_extra_payment-$eff;
				}elseif($combined_extra_payment>$eff){
					$main['scheduled_payment'][$type['loan_type']] = 0;
					$main['scheduled_extra_payment'][$type['loan_type']]  = $eff-$one_time_extra_payment;
					$main['excess_payment'][$type['loan_type']] = 0;
				}
				
			}
		endforeach;		
		
		
				
		//Loan Repayments
		foreach($main['loan_types'] as $type):
			$loan_payment_query = $this->db->get_where("loans",array("member_id"=>$member_id,"status"=>"active","loan_type"=>$type['loan_type']));
			
			if($loan_payment_query->num_rows() === 0){
				$main['loan_payment'][$type['loan_type']] = 0;
			}else{
				
					$regular_payment = $main['scheduled_payment'][$type['loan_type']]+$main['scheduled_extra_payment'][$type['loan_type']];
					$one_time_extra_payment = $main['one_time_extra_payment'][$type['loan_type']];
					
					$main['loan_payment'][$type['loan_type']] =$regular_payment; //$loan_payment_query->row()->sched_pay+$loan_payment_query->row()->extra_pay;
					
					
			}
		endforeach;
		
		//Payment Month
		
		foreach($main['loan_types'] as $type):
				$count_payments_query = $this->db->get_where("repayment",array("loans_id"=>$main['active_loan'][$type['loan_type']]['loans_id']));
			
			if($count_payments_query->num_rows() === 0){
				$main['pmt'][$type['loan_type']] = 1;
			}else{
				$main['pmt'][$type['loan_type']] = $count_payments_query->num_rows()+1;
			}
		endforeach;		

		//Department Details
		
		$department_query = $this->db->get_where("department",array("department_id"=>$main['member']['department_id']));
		
		if($department_query->num_rows() === 0){
			$main['department'] = $this->set_empty_result($department_query);
		}else{
			foreach($department_query->result_array() as $row):
				$main['department']=$row;
			endforeach;
		}
		
		//Share Details Amount and Details
		$shares_amount_query = $this->db->select_sum("amount")->get_where("shares",array("member_id"=>$member_id));
		
		if($shares_amount_query->num_rows()===0){
			$main['shares']['amount'] = 0;
		}else{
			$main['shares']['amount'] = $shares_amount_query->row()->amount;
		}
		
		$shares_guaranteed_query = $this->db->select_sum('share_guaranteed')->get_where("guarantors",array("member_id"=>$member_id,"status"=>"accepted"));
		
		if($shares_guaranteed_query->num_rows() === 0){
			$main['shares']['guaranteed'] = 0;
		}else{
			$main['shares']['guaranteed'] = $shares_guaranteed_query->row()->share_guaranteed;
				
		}
		
		
		//Worthiness
		$balance - 0;
		foreach($main['loan_types'] as $type):
			$balance += $main['loan_balance'][$type['loan_type']];
		endforeach;
		$main['worthiness'] = $main['shares']['amount']-($main['shares']['guaranteed']+$balance);
		
		
		//Active loan guarantorship
		
		foreach($main['loan_types'] as $type):
			if(!isset($main['active_loan'][$type['loan_type']]['loans_id'])){
				$main['active_loan_guarantors'][$type['loan_type']] = 0;				
			}else{
				$loan_id = $main['active_loan'][$type['loan_type']]['loans_id'];
				
				$active_loan_guarantors_query = $this->db->select_sum("share_guaranteed")->get_where("guarantors",array("loans_id"=>$loan_id));
				
				if($active_loan_guarantors_query->num_rows() === 0){
					$main['active_loan_guarantors'][$type['loan_type']] = 0;
				}else{
					$main['active_loan_guarantors'][$type['loan_type']] = $active_loan_guarantors_query->row()->share_guaranteed;
				}
			}
		endforeach;


		//New loan guarantorship
		
		foreach($main['loan_types'] as $type):
			if(!isset($main['submitted_loan'][$type['loan_type']]['loans_id'])){
				$main['new_loan_guarantors'][$type['loan_type']] = 0;				
			}else{
				$loan_id = $main['submitted_loan'][$type['loan_type']]['loans_id'];
				
				$new_loan_guarantors_query = $this->db->select_sum("share_guaranteed")->get_where("guarantors",array("loans_id"=>$loan_id));
				
				if($new_loan_guarantors_query->num_rows() === 0){
					$main['submitted_loan_guarantors'][$type['loan_type']] = 0;
				}else{
					$main['submitted_loan_guarantors'][$type['loan_type']] = $new_loan_guarantors_query->row()->share_guaranteed;
				}
			}
		endforeach;
		
		//Active Loan Guarantor Deficit 
		foreach($main['loan_types'] as $type):
			if(!isset($main['active_loan'][$type['loan_type']]['loans_id'])){
				$main['active_loan_guarantor_deficit'][$type['loan_type']] = 0;				
			}else{
				$main['active_loan_guarantor_deficit'][$type['loan_type']] = $main['active_loan'][$type['loan_type']]['principle']-$main['active_loan_guarantors'][$type['loan_type']];
			}
		endforeach;		
		
		
		//Submitted Loan Guarantor Deficit 
		foreach($main['loan_types'] as $type):
			if(!isset($main['submitted_loan'][$type['loan_type']]['loans_id'])){
				$main['submitted_loan_guarantor_deficit'][$type['loan_type']] = 0;				
			}else{
				$main['submitted_loan_guarantor_deficit'][$type['loan_type']] = $main['submitted_loan'][$type['loan_type']]['principle']-$main['submitted_loan_guarantors'][$type['loan_type']];
			}
		endforeach;		
		

		//Unsubmitted loan guarantorship
		
		foreach($main['loan_types'] as $type):
			if(!isset($main['unsubmitted_loan'][$type['loan_type']]['loans_history_id'])){
				$main['unsubmitted_loan_guarantors'][$type['loan_type']] = 0;				
			}else{
				$loan_id = $main['unsubmitted_loan'][$type['loan_type']]['loans_history_id'];
				
				$unsubmitted_loan_guarantors_query = $this->db->select_sum("share_guaranteed")->get_where("guarantors",array("loans_id"=>$loan_id));
				
				if($unsubmitted_loan_guarantors_query->num_rows() === 0){
					$main['unsubmitted_loan_guarantors'][$type['loan_type']] = 0;
				}else{
					$main['unsubmitted_loan_guarantors'][$type['loan_type']] = $unsubmitted_loan_guarantors_query->row()->share_guaranteed;
				}
			}
		endforeach;
		
		//Unsubmitted Loan Guarantor Deficit 
		foreach($main['loan_types'] as $type):
			if(!isset($main['unsubmitted_loan'][$type['loan_type']]['loans_history_id'])){
				$main['unsubmitted_loan_guarantor_deficit'][$type['loan_type']] = 0;				
			}else{
				$main['unsubmitted_loan_guarantor_deficit'][$type['loan_type']] = $main['unsubmitted_loan'][$type['loan_type']]['principle']-$main['unsubmitted_loan_guarantors'][$type['loan_type']];
			}
		endforeach;			
		
		
		//Share Rate
		
		$share_rate_query = $this->db->get_where("share_rate",array("member_id"=>$member_id,"approved"=>"approved"));
		
		if($share_rate_query->num_rows() === 0){
			$main['share_rate'] = 0;
		}else{
			$main['share_rate'] = $share_rate_query->row()->monthly_share_rate;
		}
		
		//Share Statement
		$share_statement_query = $this->db->get_where("shares",array("member_id"=>$member_id));
		$guarantors_query = $this->db->get_where("guarantors",array("member_id"=>$member_id,"status"=>"accepted"));
		
		if($share_statement_query->num_rows === 0){
			$main['share_statement'][] = array("date"=>"0000-00-00","contribution"=>0,"guaranteed"=>0);
		}else{
			foreach($share_statement_query->result_array() as $row):
				$main['share_statement'][strtotime($row['timestamp'])] = array("date"=>date('d-m-Y',strtotime($row['timestamp'])),"contribution"=>$row['amount'],"guaranteed"=>0);
			endforeach;
			
			if($guarantors_query->num_rows !== 0){
				foreach($guarantors_query->result_array() as $rows):
					$main['share_statement'][strtotime($rows['timestamp'])] = array("date"=>date('d-m-Y',strtotime($rows['timestamp'])),"contribution"=>0,"guaranteed"=>$rows['share_guaranteed']);					
				endforeach;
			}
		}
		
		sort($main['share_statement']);
		
		
		//Total Deductions
		
		$main['deductions'] = array_sum($main['loan_payment'])+$main['share_rate'];
		
		
		
		
		//Compute the final array
		if(!empty($tag)){
			
				foreach($tag as $key => $row):

					if(!is_array($row)){
					$computed[$row]=array();						
							if(array_key_exists($row, $main)){								
									$computed[$row] = $main[$row];
							}else{
								$computed[$row] = Null;
							}
					}else{
					$computed[$key]=array();						
									foreach($row as $inner_row):
										$computed[$key][$inner_row] = $main[$key][$inner_row];
									endforeach;						
					}
				endforeach;

		}else{
				$computed = $main;
		}
		
			
		
		return $computed;
	}
    /////////ADMIN/////////////
    function get_admin() {
        $query = $this->db->get('admin');
        return $query->result_array();
    }

    function get_admin_name($admin_id) {
        $query = $this->db->get_where('admin', array('teacher_id' => $admin_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_admin_info($admin_id) {
        $query = $this->db->get_where('admin', array('admin_id' => $admin_id));
        return $query->result_array();

		
    }

    //////////LOANS/////////////

	
    ////////////SHARES///////////
  	

	
	//////////DEDUCTIONS///////////

		
	/////////GUARANTORS////////////
	

    //////////INTERESTS/////////////
	

	////////// DEPARTMENT /////////////
	
	function get_departments(){
		$query = $this->db->get("department");
		return $query->result_array();
		
	}
  
  	function count_members_in_department($department_id){
  		$query = $this->db->get_where("student",array("department_id"=>$department_id));
		
		return $query->num_rows();
  	}
  
  /////////////////SYSTEM///////////////

    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings() {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    ////////BACKUP RESTORE/////////
    function create_backup($type) {
        $this->load->dbutil();


        $options = array(
            'format' => 'txt', // gzip, zip, txt
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n"               // Newline character used in backup file
        );


        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = & $this->dbutil->backup(array_merge($options, $tables));


        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
    function restore_backup() {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();


        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );
        $restore = & $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }

    /////////DELETE DATA FROM TABLES///////////////
    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('loans');
            $this->db->truncate('loans_history');
            $this->db->truncate('guarantors');
            $this->db->truncate('repayment');
            $this->db->truncate('department');
            $this->db->truncate('extra_payments');
			$this->db->truncate('loan_decline_reason');
			$this->db->truncate('loan_settings');
			$this->db->truncate('message');
			$this->db->truncate('message_thread');
			$this->db->truncate('noticeboard');
			$this->db->truncate('shares');
			$this->db->truncate('share_rate');
        } else {
            $this->db->truncate($type);
        }
    }

    ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    ////////DOCUMENTS//////////
    function save_document_info()
    {
        $data['timestamp']      = strtotime($this->input->post('timestamp'));
        $data['title'] 		= $this->input->post('title');
        $data['description']    = $this->input->post('description');
        $data['file_name'] 	= $_FILES["file_name"]["name"];
        $data['file_type'] 	= $this->input->post('file_type');
        $data['student_id'] 	= $this->input->post('student_id');
        
        $this->db->insert('document',$data);
        
        $document_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
    }
    
    function select_document_info()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('document')->result_array(); 
    }
    
    function select_document_info_for_student()
    {
        $student_id = $this->session->userdata('student_id');
        $this->db->order_by("timestamp", "desc");
        return $this->db->get_where('document', array('student_id' => $student_id))->result_array();
    }
    

    function delete_document_info($document_id)
    {
        $this->db->where('document_id',$document_id);
        $this->db->delete('document');
    }
    
    ////////private message//////
    function send_new_private_message() {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));

        $reciever   = $this->input->post('reciever');
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();

        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        // notify email to email reciever
        //$this->email_model->notify_email('new_message_notification', $this->db->insert_id());

        return $message_thread_code;
    }

    function send_reply_message($message_thread_code) {
        $message    = $this->input->post('message');
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');


        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('message', $data_message);

        // notify email to email reciever
        //$this->email_model->notify_email('new_message_notification', $this->db->insert_id());
    }

    function mark_thread_messages_read($message_thread_code) {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }
	
	public function numberOfMonths($date1, $date2)
		{
		    $begin = new DateTime( $date1 );
		    $end = new DateTime( $date2 );
		    $end = $end->modify( '+1 month' );
		
		    $interval = DateInterval::createFromDateString('1 month');
		
		    $period = new DatePeriod($begin, $interval, $end);
		    $counter = 0;
		    foreach($period as $dt) {
		        $counter++;
		    }
		
		    return $counter;
}
}
