<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function account_opening_email($account_type = '' , $email = '')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		
		$email_msg		=	"Welcome to ".$system_name."<br />";
		$email_msg		.=	"Your account type : ".$account_type."<br />";
		$email_msg		.=	"Your login password : ".$this->db->get_where($account_type , array('email' => $email))->row()->password."<br />";
		$email_msg		.=	"Login Here : ".base_url()."<br />";
		
		$email_sub		=	"Account opening email";
		$email_to		=	$email;
		
		$this->do_email($email_msg , $email_sub , $email_to);
	}
	
	function loan_application_email()
	{
		
	}
	function loan_guarantor_request_email(){
		
	}
	function loan_guarantor_freed_email(){
		
	}
	function add_share_email($amount = '' , $email = '')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		
		$email_msg		=	"Dear member ".$system_name."<br />";
		$email_msg		.=	"Your share record has updated with Kes. ".$amount."<br />";
		//$email_msg		.=	"Your login password : ".$this->db->get_where($account_type , array('email' => $email))->row()->password."<br />";
		$email_msg		.=	"Login Here to view your current share statement: ".base_url()."<br />";
		
		$email_sub		=	"Shares Updated";
		$email_to		=	$email;
		
		$this->do_email($email_msg , $email_sub , $email_to);
	}
	
	function password_reset_email($new_password = '' , $account_type = '' , $email = '')
	{
		$query			=	$this->db->get_where($account_type , array('email' => $email));
		if($query->num_rows() > 0)
		{
			
			$email_msg	=	"Your account type is : ".$account_type."<br />";
			$email_msg	.=	"Your password is : ".$new_password."<br />";
			
			$email_sub	=	"Password reset request";
			$email_to	=	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{	
			return false;
		}
	}
	
	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{
		
		$config = array();
        $config['useragent']	= "CodeIgniter";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";
        $config['smtp_host']	= "localhost";
        $config['smtp_port']	= "25";
        $config['mailtype']		= 'html';
        $config['charset']		= 'utf-8';
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;

        $this->load->library('email');

        $this->email->initialize($config);

		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		if($from == NULL)
			$from		=	$this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;
		
		$this->email->from($from, $system_name);
		$this->email->from($from, $system_name);
		$this->email->to($to);
		$this->email->subject($sub);
		
		$msg	=	$msg;//"<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://codecanyon.net/item/fps-school-management-system-pro/6087521?ref=joyontaroy\">&copy; 2013 FPS School Management System Pro</a></center>";
		$this->email->message($msg);
		
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}

//Not email model related function
function loan_settings($loan_type){
	$loan_settings = $this->db->get_where("loan_settings",array("loan_type"=>$loan_type))->result_array();
	
	$settings_arr = array();
	/*
	foreach($loan_settings as $settings):
		//interest
		$settings_arr['rate'] = $settings['interest_rate'];
		$settings_arr['guarantee_required'] = $settings['guarantee_required'];
		$settings_arr['max_loan_life'] = $settings['max_loan_life'];
		$settings_arr['loan_limit_by_amount'] = $settings['loan_limit_by_amount'];
		$settings_arr['loan_limit_by_ratio'] = $settings['loan_limit_by_ratio'];
	endforeach;
	*/
	return $loan_settings[0];
	
}
function member_data($id,$status,$tbl,$single=TRUE){
		//All Loans
			$loans = $this->db->get_where($tbl,array("member_id"=>$id,"status"=>$status))->result_array();
			
			//Principals (active)
				$loans_data['normal_principal'] = $this->db->select_sum('principle')->get_where("loans",array("member_id"=>$id,"loan_type"=>'normal',"status"=>'active'))->row()->principle;
				$loans_data['emergency_principal'] = $this->db->select_sum('principle')->get_where("loans",array("member_id"=>$id,"loan_type"=>'emergency',"status"=>'active'))->row()->principle;
				$loans_data['total_principal']=$loans_data['normal_principal']+$loans_data['emergency_principal'];
			
			//Rates
				$loans_data['normal_rate'] = $this->db->get_where("loan_settings",array("loan_type"=>"normal"))->row()->interest_rate;
				$loans_data['emergency_rate'] = $this->db->get_where("loan_settings",array("loan_type"=>"emergency"))->row()->interest_rate;
				
			//Payable
				$payable = 0;
				$normal_payable=0;
				$emergency_payable=0;
				$rate=$loans_data['normal_rate'];
				foreach($loans as $loan):
					//Individual principal
					if($loan['loan_type']==='emergency'){
						$rate = $loans_data['emergency_rate'];
						$emergency_payable+=$loan['principle']+($rate*$loan['principle']*($loan['repayment_period']/12));
					}else{
						$normal_payable+=$loan['principle']+($rate*$loan['principle']*($loan['repayment_period']/12));
					}
					$payable+=$loan['principle']+($rate*$loan['principle']*($loan['repayment_period']/12));
				endforeach;
				$loans_data['normal_payable'] = $normal_payable;
				$loans_data['emergency_payable'] = $emergency_payable;
				$loans_data['total_payable'] = $payable;			
			//Member Total Shares
				$loans_data['shares']=$this->db->select_sum('amount')->get_where("shares",array("member_id"=>$id))->row()->amount;	
			//Member Name
				$loans_data['member'] = $this->db->get_where('student',array('student_id'=>$id))->row()->name;	
			//Loan IDs and Names
				foreach($loans as $loans_identity):
					$loans_data['loans_identity'][$loans_identity['loans_id']] = $loans_identity['details'];
				endforeach;
			//Loan Repayment (Splitted)
			$normal_paid = 0;
			$emergency_paid = 0;
			foreach($loans as $details):
				if($details['loan_type']==='normal'){
					$normal_paid += $this->db->get_where("repayment",array("loans_id"=>$details['loans_id']))->row()->paid;					
				}else{
					$emergency_paid += $this->db->get_where("repayment",array("loans_id"=>$details['loans_id']))->row()->paid;	
				}
			endforeach;
			$loans_data['normal_paid'] = $normal_paid;
			$loans_data['emergency_paid'] = $emergency_paid;
			$loans_data['total_paid'] = $loans_data['normal_paid']+$loans_data['emergency_paid'];
			
			//Balance
			$loans_data['normal_balance'] = $loans_data['normal_payable']-$loans_data['normal_paid'];
			$loans_data['emergency_balance'] = $loans_data['emergency_payable']-$loans_data['emergency_paid'];
			$loans_data['total_balance'] = $loans_data['normal_balance']+$loans_data['emergency_balance'];
			
			//Guaranted Shares
				$loans_data['guaranteed']=$this->db->select_sum('guarantors.share_guaranteed')->join("loans","guarantors.loans_id=loans.loans_id","left")->get_where("guarantors",array("guarantors.member_id"=>$id,"guarantors.status"=>'accepted',"loans.status"=>"active"))->row()->share_guaranteed;
			
			//Net Worth
			
			$loans_data['net'] = $loans_data['shares']-($loans_data['total_balance']+$loans_data['guaranteed']);
			
			//Return
			
			return $loans_data;
				
				
}
function loan_data($id,$status,$tbl,$single=TRUE)
	{
		$loans_data=array();
		
		//Get all loan elements
		if($single===TRUE){
				$loan_arr = $this->db->get_where($tbl,array("loans_id"=>$id,"status"=>$status))->result_array();
				
				foreach($loan_arr as $loan):	
			
			//Rate
				$loans_data['rate'] = $this->db->get_where("loan_settings",array("loan_type"=>$loan['loan_type']))->row()->interest_rate;
			//Amount Payable
				$loans_data['payable']=$loan['principle']+($loans_data['rate']*$loan['principle']*($loan['repayment_period']/12));
			//Total Principal Amount
				$loans_data['principle'] = $loan['principle']; 
			//Monthly Repayments
				$loans_data['repayments']=$loans_data['payable']/$loan['repayment_period'];
			//Member Total Shares
				$loans_data['shares']=$this->db->select_sum('amount')->get_where("shares",array("member_id"=>$loan['member_id']))->row()->amount;
			//Shares Guaranteed
			if(sizeof($this->db->get_where('guarantors',array('loans_id'=>$id,"status"=>'accepted'))->result_array())===0){
				$loans_data['shares_guaranteed']=0;
			}else{
				$loans_data['shares_guaranteed'] = $this->db->select_sum('share_guaranteed')->get_where('guarantors',array('loans_id'=>$id,"status"=>'accepted'))->row()->share_guaranteed;
				
			}
				
			//Member Name
				$ln = $this->db->get_where($tbl,array("loans_id"=>$id))->row()->member_id;
				$loans_data['member'] = $this->db->get_where('student',array('student_id'=>$ln))->row()->name;
			//Share Deficit
				$loans_data['share_deficit'] = $loans_data['principle']-$loans_data['shares_guaranteed'];
			//Total Loan Payment
				if(sizeof($this->db->get_where("repayment",array("loans_id"=>$id))->result_array())===0){
					$loans_data['total_paid'] =0;
				}else{
					$loans_data['total_paid'] = $this->db->get_where("repayment",array("loans_id"=>$id))->row()->sched_pay;
				}
			//Loan Balance
				$loans_data['balance'] = $loans_data['payable']-$loans_data['total_paid'];
			//Guarantors List with share commitment
				$loans_data['guarantors']=$this->db->get_where("guarantors",array("loans_id"=>$loan['loans_id']))->result_array();
				
			endforeach;
		
		}else{
			//All Loans
			$loans = $this->db->get_where($tbl,array("member_id"=>$id,"status"=>$status))->result_array();
			
			//Principals (active)
				$loans_data['normal_principal'] = $this->db->select_sum('principle')->get_where("loans",array("member_id"=>$id,"loan_type"=>'normal',"status"=>'active'))->row()->principle;
				$loans_data['emergency_principal'] = $this->db->select_sum('principle')->get_where("loans",array("member_id"=>$id,"loan_type"=>'emergency',"status"=>'active'))->row()->principle;
				$loans_data['total_principal']=$loans_data['normal_principal']+$loans_data['emergency_principal'];
			
			//Rates
				$loans_data['normal_rate'] = $this->db->get_where("loan_settings",array("loan_type"=>"normal"))->row()->interest_rate;
				$loans_data['emergency_rate'] = $this->db->get_where("loan_settings",array("loan_type"=>"emergency"))->row()->interest_rate;
				
			//Payable
				$payable = 0;
				$normal_payable=0;
				$emergency_payable=0;
				$rate=$loans_data['normal_rate'];
				foreach($loans as $loan):
					//Individual principal
					if($loan['loan_type']==='emergency'){
						$rate = $loans_data['emergency_rate'];
						$emergency_payable+=$loan['principle']+($rate*$loan['principle']*($loan['repayment_period']/12));
					}else{
						$normal_payable+=$loan['principle']+($rate*$loan['principle']*($loan['repayment_period']/12));
					}
					$payable+=$loan['principle']+($rate*$loan['principle']*($loan['repayment_period']/12));
				endforeach;
				$loans_data['normal_payable'] = $normal_payable;
				$loans_data['emergency_payable'] = $emergency_payable;
				$loans_data['total_payable'] = $payable;			
			//Member Total Shares
				$loans_data['shares']=$this->db->select_sum('amount')->get_where("shares",array("member_id"=>$id))->row()->amount;	
			//Member Name
				$loans_data['member'] = $this->db->get_where('student',array('student_id'=>$id))->row()->name;	
			//Loan IDs and Names
				foreach($loans as $loans_identity):
					$loans_data['loans_identity'][$loans_identity['loans_id']] = $loans_identity['details'];
				endforeach;
			//Loan Repayment (Splitted)
			$normal_paid = 0;
			$emergency_paid = 0;
			foreach($loans as $details):
				if($details['loan_type']==='normal'){
					$normal_paid += $this->db->select_sum('repayment.sched_pay')->join('loans',"repayment.loans_id=loans.loans_id",'left')->get_where("repayment",array("loans.loans_id"=>$details['loans_id'],"loans.status"=>'active'))->row()->sched_pay;
					//$normal_paid += $this->db->get_where("repayment",array("loans_id"=>$details['loans_id']))->row()->paid;					
				}else{
					$emergency_paid += $this->db->select_sum('repayment.sched_pay')->join('loans',"repayment.loans_id=loans.loans_id",'left')->get_where("repayment",array("loans.loans_id"=>$details['loans_id'],"loans.status"=>'active'))->row()->sched_pay;
				}
			endforeach;
			$loans_data['normal_paid'] = $normal_paid;
			$loans_data['emergency_paid'] = $emergency_paid;
			$loans_data['total_paid'] = $loans_data['normal_paid']+$loans_data['emergency_paid'];
			
			//Balance
			$loans_data['normal_balance'] = $this->db->select_min("end_bal")->join("loans","repayment.loans_id=loans.loans_id","left")->get_where("repayment",array("loans.loan_type"=>"normal","loans.status"=>"active","loans.member_id"=>$id))->row()->end_bal;//$loans_data['normal_payable']-$loans_data['normal_paid'];
			$loans_data['emergency_balance'] = $this->db->select_min("end_bal")->join("loans","repayment.loans_id=loans.loans_id","left")->get_where("repayment",array("loans.loan_type"=>"emergency","loans.status"=>"active","loans.member_id"=>$id))->row()->end_bal;//$loans_data['emergency_payable']-$loans_data['emergency_paid'];
			$loans_data['total_balance'] = $loans_data['normal_balance']+$loans_data['emergency_balance'];
			
			//Guaranted Shares
				$loans_data['guaranteed']=$this->db->select_sum('guarantors.share_guaranteed')->join("loans","guarantors.loans_id=loans.loans_id","left")->get_where("guarantors",array("guarantors.member_id"=>$id,"guarantors.status"=>'accepted',"loans.status"=>"active"))->row()->share_guaranteed;
			
			//Net Worth
			
				$loans_data['net'] = $loans_data['shares']-($loans_data['total_balance']+$loans_data['guaranteed']);
		}
		
		//Return
		
		return $loans_data;
		
	}
}

