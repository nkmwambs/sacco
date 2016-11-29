<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 20 August, 2013
 *	University Of Dhaka, Bangladesh
 *	FPS School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class Student extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('student_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    /**MANAGE MEMBER**/
    
    function member($param1='',$param2=''){
    	if ($this->session->userdata('student_login') != 1)
          redirect(base_url(), 'refresh');
		  
		$student_id = $this->session->userdata('student_id');
		  
		$page_data['page_name']  = 'members_information';
        $page_data['page_title'] = get_phrase('member_details');
		$data['student_id'] = $this->session->userdata('student_id');
        $this->load->view('backend/index', $page_data);
    }

   /** RATE **/
   
   function rate($param1=''){
   		$rate = $this->db->get_where("loan_settings",array("loan_type"=>$param1))->row();
		
		//header('Content-Type:application/json');
		//header('Content-Type:text/plain');
		echo json_encode($rate);
   }
   
   function get_loan_limit($param1=''){
   		$rst = $this->sacco_model->loan_limit($param1,$this->session->userdata('login_user_id'));
		
		echo $rst;
   }
   
   /////LOAN BALANCE////
   function loan_balance($param1="",$param2=""){
   	 $balance = $this->crud_model->get_member_last_loan_repayment($param1,$param2);
	 if($balance['end_bal']>0){
	 	echo $balance['end_bal'];
	 }else{
	 	echo 0;
	 }
	 
   }
   
    /**LOAN**/
    function loan_save(){
			
				$data['member_id'] = $this->session->userdata('login_user_id'); 
				$data['monthly_income'] = $this->input->post('monthly_income');
				$data['monthly_expenditure'] = $this->input->post('monthly_expenditure');
				$data['loan_type'] = $this->input->post('loan_type');
				$data['principle'] = $this->input->post('principle');
				$data['repayment_period'] = $this->input->post('repayment_period');
				$data['rate'] = $this->input->post('rate');
				$data['sched_pay'] = $this->input->post('sched_pay');
				$data['account_name'] = $this->input->post('account_name');
				$data['account_number'] = $this->input->post('account_number');
				$data['bank_name'] = $this->input->post('bank_name');
				$data['branch_name'] = $this->input->post('branch_name');
				$data['proposed_date'] = $this->input->post('proposed_date');
				$data['extra_pay'] = $this->input->post('extra_pay');
				
				$existing_loan = $this->db->get_where('loans',array('status'=>'new','member_id'=>$this->session->userdata('login_user_id')));				
				
				$purpose = $this->input->post('purpose');
				$amount = $this->input->post('purpose_amount');
				for($i=0;$i<count($this->input->post('purpose'));$i++):
					$arr['purpose'] = $purpose[$i];
					$arr['purpose_amount'] = $amount[$i];
					$arr['loans_id'] = $existing_loan->row()->loans_id;
					$purpose_arr[] = $arr;
				endfor;

				$security = $this->input->post('security');
				$amount = $this->input->post('security_amt');
				for($i=0;$i<count($this->input->post('security'));$i++):
					$sec_arr['name'] = $security[$i];
					$sec_arr['amount'] = $amount[$i];
					$sec_arr['loans_id'] = $existing_loan->row()->loans_id;
					$security_arr[] = $sec_arr;
				endfor;	
				
			$files = $_FILES['payslips'];			
			
			//header('Content-Type: text/plain');
			print_r($files);   	
    }
    
    function loan($param1='',$param2='',$param3=''){
    	if ($this->session->userdata('student_login') != 1)
          redirect(base_url(), 'refresh'); 
		
		$student_id = $this->session->userdata('student_id');
		
		if($param1=='save'){
				$data['member_id'] = $this->session->userdata('login_user_id'); 
				$data['monthly_income'] = $this->input->post('monthly_income');
				$data['monthly_expenditure'] = $this->input->post('monthly_expenditure');
				$data['loan_type'] = $this->input->post('loan_type');
				$data['principle'] = $this->input->post('principle');
				$data['repayment_period'] = $this->input->post('repayment_period');
				$data['rate'] = $this->input->post('rate');
				$data['sched_pay'] = $this->input->post('sched_pay');
				$data['account_name'] = $this->input->post('account_name');
				$data['account_number'] = $this->input->post('account_number');
				$data['bank_name'] = $this->input->post('bank_name');
				$data['branch_name'] = $this->input->post('branch_name');
				$data['proposed_date'] = $this->input->post('proposed_date');
				$data['extra_pay'] = $this->input->post('extra_pay');
				
				
				//Check if there is a loan for the current user with a new status
				
				$existing_loan = $this->db->get_where('loans',array('member_id'=>$this->session->userdata('login_user_id')));
				$purpose = $this->input->post('purpose');
				$amount = $this->input->post('purpose_amount');
				$tbl = "loan_purpose";
									
				
				$security = $this->input->post('security');
				$security_amount = $this->input->post('security_amt');
				$tbl_security = "loan_security";
							
				$loanid = $existing_loan->row()->loans_id;
									
				if(count($existing_loan->result_array())>0){
					//Update the record
					$this->db->where(array('member_id'=>$this->session->userdata('login_user_id')));
					$this->db->update('loans',$data);
					
					//Loan Purpose Array
					
					$this->sacco_model->add_loan_lists($purpose,$amount,$loanid,$tbl);
					$this->sacco_model->add_loan_lists($security,$security_amount,$loanid,$tbl_security);
					
				}else{
					//Insert a new record					 
					$this->db->insert('loans',$data);
					$loans_id = $this->db->insert_id();
					
					//Insert Loan Purposes
						
					$this->sacco_model->add_loan_lists($purpose,$amount,$loanid,$tbl,false);
					$this->sacco_model->add_loan_lists($security,$security_amount,$loanid,$tbl_security,false);
					
				}	
				
				$this->do_upload($loanid);
				
				
				
				$this->session->set_flashdata('flash_message' , get_phrase('application_saved_successfully'));
				redirect(base_url() . 'index.php?student/loan/view/'.$loanid, 'refresh');
		}
				
		if($param1==='delete'){
			//Check if a loan is new
			
			$new_check = $this->db->get_where('loans',array('loans_id'=>$param2))->row()->status;
			
			if($new_check==='new'||$new_check==='declined'){
				
				//Delete database records
				
				$this->db->delete("loans",array('loans_id'=>$param2));
				$this->db->delete('guarantors',array('loans_id'=>$param2));
				$this->db->delete('loan_purpose',array('loans_id'=>$param2));
				$this->db->delete('loan_security',array('loans_id'=>$param2));
				
				//Remove uploaded files
				
				$this->delete_payslip($param2);
				
				//Freed Guarantors
				
	            $this->session->set_flashdata('flash_message' , get_phrase('application_cancelled_successfully'));				
			}else{
				$this->session->set_flashdata('flash_message' , get_phrase('process_failed'));
			}
			

            $page_data['page_name']  = 'update_loan';
	    	$page_data['page_title'] = get_phrase('loan_list');			
		}

		if($param1==='repay'){		
            $data['payment_date']       = $this->input->post('payment_date');
			$data['extra_pay'] = $this->input->post('extra_pay');
			$data['loan_id'] = $this->input->post('loan_id');
		   
            $this->db->insert('extra_payments', $data);
			
            $payment_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/document/bank_slips/' . $payment_id . '.jpg');
			
            $this->session->set_flashdata('flash_message' , get_phrase('loan_repayment_successful'));
            redirect(base_url() . 'index.php?student/member/', 'refresh');	
		}
		
		if($param1==='new'){
			
			$data['member_id']=$this->session->userdata('login_user_id');
			
			//Check for an existing new loan 
			$exist_new = $this->db->get_where('loans',array('status'=>'new'))->result_object();	
			
			if(count($exist_new)===0){
				
				$this->db->insert('loans',$data);
				
				$id = $this->db->insert_id();
				
				$this->session->set_flashdata('flash_message' , get_phrase('record_created_successfully'));
				
				redirect(base_url() . 'index.php?student/loan/view/'.$id, 'refresh');	
							
			}else{
				$this->session->set_flashdata('flash_message' , get_phrase('process_failed'));
				
				redirect(base_url() . 'index.php?student/member/', 'refresh');
			}
			

		}	
		
		if($param1==='update'){
           	$page_data['page_name']  = 'update_loan';
	    	$page_data['page_title'] = get_phrase('loan_list');	
		}
				
		if($param1==='view'){
			$page_data['_id'] = $param2;		
			$page_data['page_name']  = 'add_loan';
	    	$page_data['page_title'] = get_phrase('new_loan');				
		}		
			

	        $this->load->view('backend/index', $page_data); 
  	
    }
	
  function do_upload($id,$key='1',$param2='payslip')
        {
			$name = $_FILES[$param2]["name"];
			$ext = end((explode(".", $name)));
			
			if (!file_exists('uploads/'.$param2.'/'.$id)) {
			    mkdir('uploads/'.$param2.'/'.$id, 0777, true);
			}
							
			move_uploaded_file($_FILES[$param2]['tmp_name'], 'uploads/'.$param2.'/'.$id.'/' . ucfirst($param2.'_'.$key) . '.'.$ext);
                
        }
	
	function force_download($param1='',$param2='',$param3='payslip'){

			force_download('uploads/'.$param3.'/'.$param1.'/'.$param2,NULL);
		
	}
	
	function delete_payslip($param1='',$param2='payslip'){
    	if ($this->session->userdata('student_login') != 1)
          redirect(base_url(), 'refresh');
		  
		delete_files('./uploads/'.$param2.'/'.$param1);
		
		$this->session->set_flashdata('flash_message' , get_phrase('file_deleted_successfully'));
		redirect(base_url() . 'index.php?student/loan/view/'.$param1, 'refresh');	
	}
	
	function update_loan($param1 = '', $param2 = '', $param3 = ''){
    	if ($this->session->userdata('student_login') != 1)
          redirect(base_url(), 'refresh'); 
		
		if($param1=='create_gurantor'){
			$data['member_id']           = $param2;
            $data['loans_id']       = $param3;
			$data['status']       = "requested";
			
			$share_due = $this->sacco_model->shares_due($this->session->userdata('login_user_id'),$param3);
		   
		   	if($share_due>0){
            	$this->db->insert('guarantors', $data);
            	$this->session->set_flashdata('flash_message' , get_phrase('request_sent_successfully'));
				$this->email_model->loan_guarantor_request_email();		   		
		   	}else{
		   		$this->session->set_flashdata('flash_message' , get_phrase('process_failed'));
		   	}
            
            redirect(base_url() . 'index.php?student/loan/view/'.$param3, 'refresh');
		}
		
		if($param1=='free_guarantor'){
			$data['member_id']           = $param2;
            $data['loans_id']       = $param3;
			$data['status']       = "freed";
			
			//$share_due = $this->sacco_model->shares_due($this->session->userdata('login_user_id'),$param3);
		   		$this->db->where(array('loans_id'=>$param3,"member_id"=>$param2));
            	$this->db->update('guarantors', $data);
            	$this->session->set_flashdata('flash_message' , get_phrase('guarantor_freed_successfully'));
				$this->email_model->loan_guarantor_freed_email();		   		
            
            redirect(base_url() . 'index.php?student/loan/view/'.$param3, 'refresh');
		}
		
		if($param1==='submit'){
            $data['loans_id']     = $param2;
			$data['application_date'] = date('Y-m-d');
			$data['status']       = "submitted";
			
			//Check if the loan is fully guaranteed
			
		   		$this->db->where(array('loans_id'=>$param2));
            	$this->db->update('loans', $data);
            	$this->session->set_flashdata('flash_message' , get_phrase('loan_submitted_successfully'));
				$this->email_model->loan_guarantor_freed_email();		   		
            
            redirect(base_url() . 'index.php?student/loan/view/'.$param2, 'refresh');			
		}
		
			$page_data['page_name']  = 'update_loan';
	        $page_data['page_title'] = get_phrase('update_loan');
	        $this->load->view('backend/index', $page_data);
	}
	
	function guarantor($param1 = '', $param2 = '', $param3 = ''){
    	if ($this->session->userdata('student_login') != 1)
          redirect(base_url(), 'refresh'); 
			
			if($param1==='accept'){
				$page_data['page_name']  = 'guarantor_acceptance';
		        $page_data['page_title'] = get_phrase('guarantor_acceptance');
		        $this->load->view('backend/index', $page_data);				
			}	
			if($param1==="delete"){
				$status = $this->db->get_where("guarantors",array("loan_id"=>$param2,"member_id"=>$param3))->row()->status;
				if($status!=="accepted"){
					$this->db->where(array("loan_id"=>$param2,"member_id"=>$param3));
					$this->db->delete("guarantors");
				}
				$page_data['page_name']  = 'update_loan';
	        	$page_data['page_title'] = get_phrase('update_loan');
	        	$this->load->view('backend/index', $page_data);	
			}
			if($param1==='allocate'){
				
				//Check if loan is active	
				$loans_id = $this->db->get_where('guarantors',array('guarantors_id'=>$param2))->row()->loans_id; 
				$loan_status = $this->db->get_where('loans',array('loans_id'=>$loans_id))->row()->status;
				$member_id = $this->db->get_where('loans',array('loans_id'=>$loans_id))->row()->member_id;
				
				//Get Due shares to be guaranteed
				$shares_due = $this->sacco_model->shares_due($member_id,$loans_id);
				$share_to_be_guaranteed = $this->input->post('share_guaranteed');
				if($shares_due<$this->input->post('share_guaranteed')){
					$share_to_be_guaranteed = $this->input->post('share_guaranteed')-$shares_due;
				}
				
				//Get Net Shares
				$net_shares = 	$this->sacco_model->net_shares($this->session->userdata('student_id'));
				
				if($net_shares>0&&$this->input->post('share_guaranteed')<=$net_shares&&$loan_status==='new'&&$shares_due>0){				
						$data['share_guaranteed'] = $share_to_be_guaranteed;//$this->input->post('share_guaranteed');
			            $data['status']       = "accepted";
					   
			            $this->db->where('guarantors_id', $param2);
			            $this->db->update('guarantors', $data);
			            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
				}else{
						$this->session->set_flashdata('flash_message' , get_phrase('process_failed'));
				}

	            redirect(base_url() . 'index.php?student/guarantor/', 'refresh');
			}
			$page_data['page_name']  = 'guarantor_profile';
	        $page_data['page_title'] = get_phrase('guarantor_profile');
	        $this->load->view('backend/index', $page_data);		

	}
    /**********WATCH NOTICEBOARD AND EVENT ********************/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $page_data);
        
    }
    
    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?student/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?student/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('student_id', $this->session->userdata('student_id'));
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $this->session->userdata('student_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?student/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('student', array(
                'student_id' => $this->session->userdata('student_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('student_id', $this->session->userdata('student_id'));
                $this->db->update('student', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?student/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
   
}