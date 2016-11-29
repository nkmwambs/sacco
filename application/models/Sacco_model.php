<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sacco_model extends CI_Model {
	
private $member;	
private $loans;
private $loan_types;
private $default_loan_type;
private $result;

	function __construct()
    {
        parent::__construct();
    }
	
	function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
	
	
	

	/** MEMBERS **/
	
	function get_member($member_id) {
        $member = (object)$this->db->get_where('student', array('student_id' => $member_id))->first_row();
        return $member;
    }
	
	function default_loan_type(){
		$default_loan_type = $this->db->get_where('loan_settings',array('default_type'=>'yes'))->row()->loan_type;
		
		return $default_loan_type;
	}
	
	function loan_types(){
			//if(!empty($loan_type)){
				$loan_types_query = $this->db->get("loan_settings",array('loan_type'=>$loan_type,'active'=>'yes'))->result_object();
			//}else{
				//$loan_types_query = $this->db->get_where("loan_settings",array('loan_type'=>$this->default_loan_type()))->row();
			//}
			
			foreach($loan_types_query as $row):
				$loan_types[$row->loan_type]=$row;
			endforeach;
			
			return $loan_types;
	}
	
	
	function loans($status='active',$member_id=''){
		
			foreach($this->loan_types() as $type):
				

			$active_loan_query = $this->db->get_where("loans",array("status"=>$status,'member_id'=>$member_id));
			
			
			//if($active_loan_query->num_rows()==0){
				//$loans[$type->loan_type] = (object)$this->crud_model->set_empty_result($active_loan_query);
			//}else{
				foreach($active_loan_query->result_object() as $row):
					$loans[] = (object)$row;
				endforeach;
			//}
			
		endforeach;
		
		return $loans;
	}

	function loan_limit($loan_type='',$member_id=''){
		$loan_type_obj = $this->db->get_where('loan_settings',array('loan_type'=>$loan_type))->row();
	
		$loan_limit_by	= $loan_type_obj->preferred_limit_setting;
		
		$loan_limit_setting = $loan_type_obj->$loan_limit_by;
		
		$shares = $this->db->get_where('shares',array('member_id'=>$member_id))->row();
		
		if($loan_limit_by === 'loan_limit_by_ratio'){
			$loan_limit = $loan_limit_setting*$shares->amount;
		}elseif($loan_limit_by === 'loan_limit_by_amount'){
			$loan_limit = $loan_limit_setting;
		}
		
		return $loan_limit;
	}
	
	function add_loan_lists($input1="",$input2="",$loanid="",$tbl="",$loan_exist = true){
		if($loan_exist===true){
			for($i=0;$i<count($input1);$i++):
				$arr['name'] = $input1[$i];
				$arr['amount'] = $input2[$i];
				$arr['loans_id'] = $loanid;
				$list_arr[] = $arr;
			endfor;					
				
			//check if item exists
			$list_exists = $this->db->get_where($tbl,array('loans_id'=>$loanid))->result_array();
			
			if(count($list_exists)>0){
				$this->db->delete($tbl,array('loans_id'=>$loanid));
				$this->db->insert_batch($tbl,$list_arr);
			}else{
				$this->db->insert_batch($tbl,$list_arr);		
			}
		}else{
			
				for($i=0;$i<count($input1);$i++):
					$list_arr['name'] = $input1[$i];
					$list_arr['amount'] = $input2[$i];
					$list_arr['loans_id'] = $loanid;
						
					$this->db->insert($tbl,$list_arr);
				endfor;			
			
		}		
	}

	function gross_shares($param1=''){
		$result = $this->db->select_sum('amount')->get_where('shares',array('member_id'=>$param1))->result();
		
		return $result[0]->amount;
	}
	function loan_principle($param1='',$status='new'){
		$result = $this->db->get_where('loans',array('member_id'=>$param1,'status'=>$status))->result();
		
		return $result[0]->principle;
	}	

	function loan_principle_by_loan_id($param1=''){
		$result = $this->db->get_where('loans',array('loans_id'=>$param1))->result();
		
		return $result[0]->principle;
	}	
	function guaranteed_shares_loan_id($param1=''){
		$result = $this->db->select_sum('share_guaranteed')->get_where('guarantors',array('loans_id'=>$param1))->result();
		
		return $result[0]->share_guaranteed;
	}

	function guaranteed_shares_member_id($param1=''){
		//$cond = "member_id='".$param1."' AND status='accepted'";
		$result = $this->db->select_sum('share_guaranteed')->get_where('guarantors',array('member_id'=>$param1,'status'=>'accepted'))->result();
		
		return $result[0]->share_guaranteed;
	}
	
	function guaranteed_shares_member_and_loan_id($param1='',$param2=''){
		//$cond = "member_id='".$param1."' AND status='accepted'";
		$result = $this->db->select_sum('share_guaranteed')->get_where('guarantors',array('member_id'=>$param1,'loans_id'=>$param2,'status'=>'accepted'))->result();
		
		return $result[0]->share_guaranteed;
	}		
	
	function net_shares($param1=''){
		$result = $this->gross_shares($param1)-$this->guaranteed_shares_member_id($param1);
		
		return $result;
	}	
	
	function shares_due($loans_id='',$member_id=''){
		
		//Check if self Guaranteeing is allowed
		
		$self = $this->db->get_where('sacco_setting',array('name'=>'self_guarantee'))->row()->info;
		
		$due = $this->loan_principle_by_loan_id($loans_id)-($this->guaranteed_shares_loan_id($loans_id));
		
		if($self==='yes'){
			$due = $this->loan_principle_by_loan_id($loans_id)-($this->guaranteed_shares_loan_id($loans_id)+$this->gross_shares($member_id));			
		}
		
		
		return $due;
	}
	
	function last_loan_repayment($loan_id){
		
		$max_repayment_id = $this->db->select_max('repayment_id')->get_where('repayment',array('loans_id'=>$loan_id))->row()->repayment_id;
		
		$last_loan_repayment = $this->db->select(array('end_bal','sched_pay','extra_pay','repayment_date'))->get_where('repayment',array('repayment_id'=>$max_repayment_id))->row();
		
		return $last_loan_repayment;
		
	}
	
	function loan_balance($loan_id){
		
		$loan_balance = 0;
		
		if(empty($this->last_loan_repayment($loan_id))){
			$loan_balance = $this->db->get_where('loans',array('loans_id'=>$loan_id))->row()->principle;
		}else{
			$loan_balance = $this->last_loan_repayment($loan_id)->end_bal;
		}
		
		return $loan_balance;
	}
	
	function scheduled_repayments($loan_id){
		$loan = $this->db->get_where('loans',array('loans_id'=>$loan_id))->row();
		
		$sched = $loan->sched_pay;
		$extra = $loan->extra_pay;
		
		return $total = $sched+$extra;
	}

}

