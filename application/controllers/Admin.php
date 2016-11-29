<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Nicodemus Karisa
 *	date		: May, 2016
 *	
 */

class Admin extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		$this->load->helper('directory');
		$this->load->helper('download'); 
		$this->load->helper('file'); 
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    function activity()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'activity';
        $page_data['page_title'] = get_phrase('activity');
        $this->load->view('backend/index', $page_data);
    }	
	
	function add_record($param1="",$param2="",$param3=""){
		
		$additional_fields = $this->db->select('name')->get_where('member_additional_field',array('active'=>'yes'))->result_object();
		
		$fld_arr = array();
		foreach($additional_fields as $fields):
			$fld_arr[]=$fields->name;
		endforeach;
		
		print_r($fld_arr);
	}
	
    /*** MANAGE ADMINS****/
    function admins($param1='',$param2=''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1==='create'){
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['active'] = $this->input->post('active');
			
			$this->db->insert("admin",$data);
			
            $this->session->set_flashdata('flash_message' , get_phrase('admin_added_successfully'));
            //$this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');			
		}
			
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $this->load->view('backend/index', $page_data);    	
    }
    /****MANAGE MEMBERS DEPARTMENTWISE*****/
    function additional_fields($param1='',$param2,$param3=""){
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1==='create'){
			$data['name'] = str_replace(' ','_', $this->input->post('field_name'));
			$data['field_type_id'] = $this->input->post('field_type');
			$data['category'] = $this->input->post('category');
			$data['active'] = $this->input->post('active_status');
			
			$this->db->insert("member_additional_field",$data);
			
            $this->session->set_flashdata('flash_message' , get_phrase('operation_successful'));
            redirect(base_url() . 'index.php?admin/additional_fields/', 'refresh');
		}
		if($param1==='options_create'){
			//Check if a separator is present
			
			$items  = explode(';',$this->input->post('item'));
			
			if(count($items)>0){
				foreach($items as $row):
					$data['item'] = $row;
					$data['member_additional_field_id'] = $param2;
					
					$this->db->insert('additional_field_items',$data);
				endforeach;
				
			}else{
				
				$data['item'] = $this->input->post('item');
				$data['member_additional_field_id'] = $param2;
			
				$this->db->insert('additional_field_items',$data);	
			}
			
			
			
			$this->session->set_flashdata('flash_message' , get_phrase('operation_successful'));
            redirect(base_url() . 'index.php?admin/additional_fields/', 'refresh');	
		}
	
		if($param1==='edit'){
			$data['name'] = $this->input->post('field_name');
			$data['field_type_id'] = $this->input->post('field_type');
			$data['category'] = $this->input->post('category');
			$data['active'] = $this->input->post('active');			
			
			$this->db->where(array('member_additional_field_id'=>$param2));
			$this->db->update('member_additional_field',$data);
			
			$this->session->set_flashdata('flash_message' , get_phrase('operation_successful'));
            //$this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/additional_fields/', 'refresh');				
		}
		
		if($param1=='delete_options'){
			$this->db->where(array('additional_field_items_id'=>$param2));
			
			$this->db->delete('additional_field_items');
			
			$this->session->set_flashdata('flash_message' , get_phrase('operation_successful'));
            //$this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/additional_fields/', 'refresh');
		}
		
		if($param1==='deactivate'){
			$active = "no";
			if($param3===$active){
				$active ='yes';
			}
			
			$this->db->where(array('member_additional_field_id'=>$param2));
			$data['active'] = $active;
			
			$this->db->update('member_additional_field',$data);
			
			$this->session->set_flashdata('flash_message' , get_phrase('operation_successful'));
            redirect(base_url() . 'index.php?admin/additional_fields/', 'refresh');			
		}
		
		if($param1==='delete'){
			
			//Check if field has been used
			
			$vals = $this->db->get_where('member_additional_info',array('additional_field_id'=>$param2))->row();
			
			if(count($vals)===0){
				$field_cond = $this->db->where(array('member_additional_field_id'=>$param2));
				$field_qry = $this->db->delete('member_additional_field',$field_cond);
				$options_cond = $this->db->where(array('member_additional_field_id'=>$param2));
				$option_qry = $this->db->delete('additional_field_items',$options_cond);
				
				$this->session->set_flashdata('flash_message' , get_phrase('operation_successful'));
	            redirect(base_url() . 'index.php?admin/additional_fields/', 'refresh');				
            }else{
            	$this->session->set_flashdata('flash_message' , get_phrase('operation_aborted'));
	            redirect(base_url() . 'index.php?admin/additional_fields/', 'refresh');		
            }
		}
			
		$page_data['page_name']  = 'additional_fields';
		$page_data['page_title'] = get_phrase('additional_fields');
		$this->load->view('backend/index', $page_data);    	
    }
    
	function member_add()
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			
		$page_data['page_name']  = 'member_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}
	
	function member_bulk_add($param1 = '',$param2="")
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
		if ($param1 == 'import_schedules')
		{

			    $file = $_FILES['userfile']['tmp_name'];
				$handle = fopen($file,"r");
				
				$flag = true;
				
			 	while(($rec = fgetcsv($handle,1000,",","'"))!== FALSE){
			 		
			 		if($flag) { $flag = false; continue; }
					
					if (array(null) !== $rec&&$rec[0]!=='0') { // ignore blank lines
					
						$data['loans_id']=$param2;
						$data['pmt']=$rec[0];
						$data['repayment_date']=$rec[1];
						$data['beg_bal']=$rec[2];
						$data['sched_pay']=$rec[3];
						$data['extra_pay']=$rec[4];
						$data['princ']=$rec[5];
						$data['intr']=$rec[6];
						$data['end_bal']=$rec[7];
						$data['approval']="approved";

						$this->db->insert('repayment' , $data);
					}
				}
			
			
			redirect(base_url() . 'index.php?admin/loans/', 'refresh');
		}
		
		if ($param1 == 'import_excel')
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_import.xlsx');
			// Importing excel sheet for bulk student uploads

			include 'simplexlsx.class.php';
			
			$xlsx = new SimpleXLSX('uploads/student_import.xlsx');
			
			list($num_cols, $num_rows) = $xlsx->dimension();
			$f = 0;
			foreach( $xlsx->rows() as $r ) 
			{
				// Ignore the inital name row of excel file
				if ($f == 0)
				{
					$f++;
					continue;
				}
				for( $i=0; $i < $num_cols; $i++ )
				{
					if ($i == 0)	    $data['name']			=	$r[$i];
					else if ($i == 1)	$data['birthday']		=	$r[$i];
					else if ($i == 2)	$data['sex']		    =	$r[$i];
					else if ($i == 3)	$data['address']		=	$r[$i];
					else if ($i == 4)	$data['phone']			=	$r[$i];
					else if ($i == 5)	$data['email']			=	$r[$i];
					else if ($i == 6)	$data['password']		=	$r[$i];
					else if ($i == 7)	$data['roll']			=	$r[$i];
				}
				
				$this->db->insert('student' , $data);
				//print_r($data);
			}
			redirect(base_url() . 'index.php?admin/member/' . $this->input->post('class_id'), 'refresh');
		}
		$page_data['page_name']  = 'member_bulk_add';
		$page_data['page_title'] = get_phrase('add_bulk_member');
		$this->load->view('backend/index', $page_data);
	}
	
	
    function member($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		if($param1==='single'){
			$page_data['page_name']  = 'single_member';
        	$page_data['page_title'] = get_phrase('user_profiles');
        	$this->load->view('backend/index', $page_data);
		}
        if ($param1 == 'create') {
            $data['name']           = $this->input->post('name');
            $data['birthday']       = $this->input->post('birthday');
			$data['roll']       = $this->input->post('roll');
            $data['sex']            = $this->input->post('sex');
            $data['address']        = $this->input->post('address');
            $data['phone']          = $this->input->post('phone');
            $data['email']          = $this->input->post('email');
            $data['password']       = $this->input->post('password');
            $data['department_id']       = $this->input->post('department_id');
           	$data['membershipdate']       = $this->input->post('membershipdate');
		   
            $this->db->insert('student', $data);
            $member_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $member_id . '.jpg');
			
			//Insert Share Rate
			$data2['monthly_share_rate'] = $this->input->post('monthly_share_rate');
			$data2['member_id'] = $member_id;
			$data2['approved'] = "approved";
			$this->db->insert("share_rate",$data2);
			
			//Insert Additional Information
			
			$this->crud_model->insert_additional_info($member_id,'membership');
			
			
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/member/'.$student_id, 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']           = $this->input->post('name');
            $data['birthday']       = $this->input->post('birthday');
            $data['sex']            = $this->input->post('sex');
            $data['address']        = $this->input->post('address');
            $data['phone']          = $this->input->post('phone');
            $data['email']          = $this->input->post('email');
            $data['department_id']       = $this->input->post('department_id');
            $data['roll']           = $this->input->post('roll');
			$data['membershipdate']           = $this->input->post('membershipdate');
            
            $this->db->where('student_id', $param2);
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param2 . '.jpg');
			
			//Update Additional Information
			
			$this->crud_model->update_additional_info($param2,'membership');	
			
            $this->crud_model->clear_cache();
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/member/' . $param2, 'refresh');
        } 
		
        if ($param1 == 'deactivate') {
			
			/**
			 * Check if has successfully applied for withdrawal of membership OR Apply for withdrawal by admin
			 * a) Clear all loans
			 * b) Authorization to be free from guaranteeing
			 * c) Refunded all shares - Done past withdrawal
			 * 
			 * */
			
			//Check for active loans
			$active_loans = $this->db->get_where("loans",array("member_id"=>$param2,"status"=>"active"))->result_array();
			$err = 0;
			if(count($active_loans)>0){
				$err+=1;
			}
			
			//Check for unfreed guaranteed shares
			$unfreed = $this->db->get_where("guarantors",array("status"=>"accepted","member_id"=>$param2))->result_array();
			if(count($unfreed)>0){
				$err+=1;
			}
			
			if($err>0){
		            $this->session->set_flashdata('flash_message' , get_phrase('member_deactivation_failure'));
		            redirect(base_url() . 'index.php?admin/member/' . $param2, 'refresh');					
			}else{
		            $this->db->where('student_id', $param2);
					$data['active'] = 'no';
					$data['withdrawaldate'] = date('d/m/Y');
					
		            $this->db->update('student',$data);
		            $this->session->set_flashdata('flash_message' , get_phrase('member_deactivated'));
		            redirect(base_url() . 'index.php?admin/member/' . $param2, 'refresh');				
			}
			

        }
		$page_data['page_name']  = 'members_information';
        $page_data['page_title'] = get_phrase('student_information');
        $this->load->view('backend/index', $page_data);
    }
	/**GENERAL**/
	function schedule($param1 = '', $param2 = '', $param3=''){
		if ($this->session->userdata('admin_login') != 1)
        redirect('login', 'refresh');
			
		$page_data['page_name']  = 'payment_schedule';
        $page_data['page_title'] = get_phrase('payment_schedule');
        $this->load->view('backend/index', $page_data);			
	}
	/**SHARES**/
	
	function share($param1 = '', $param2 = '', $param3='')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		
		if($param1==='create'){
            $data['member_id']           = $param2;
            $data['amount']       = $this->input->post('amount');
			$data['details'] = $this->input->post('details');
			$data['sharemonth']       = $this->input->post('sharemonth');
		   
            $this->db->insert('shares', $data);
            //$student_id = $this->db->insert_id();
           
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            $this->email_model->add_share_email($data['amount'], $param3); //SEND EMAIL SHARE UPDATE EMAIL
            redirect(base_url() . 'index.php?admin/member', 'refresh');			
		}
		
		if($param1==='to_update'){
			
		}
		if($param1==='delete'){
			
		}
		
		
		$page_data['page_name']  = 'shares';
        $page_data['page_title'] = get_phrase('share_information');
        $this->load->view('backend/index', $page_data);		
	}
	function share_rate($param1 = '', $param2 = '', $param3=''){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		
		if($param1==='create'){
            $data['member_id']           = $param2;
            $data['monthly_share_rate']       = $this->input->post('monthly_share_rate');
		   	$data['approved']='approved';
			
            $this->db->insert('share_rate', $data);
           
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/member', 'refresh');			
		}
		if($param1==='to_update'){
            $data['monthly_share_rate']       = $this->input->post('monthly_share_rate');
		   
		   	$this->db->where("member_id",$param2);
            $this->db->update('share_rate', $data);
           
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/member', 'refresh');	
		}		
	}
	//// REPORTS////
	function shares_report($param1=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');			
		
		$page_data['page_name']  = 'shares_report';
        $page_data['page_title'] = get_phrase('shares_report');
        $this->load->view('backend/index', $page_data);			
	}

	function loans_report($param1=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');			
		
		$page_data['page_name']  = 'loans_report';
        $page_data['page_title'] = get_phrase('loans_report');
        $this->load->view('backend/index', $page_data);			
	}

	function guarantors_report($param1=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');			
		
		$page_data['page_name']  = 'guarantors_report';
        $page_data['page_title'] = get_phrase('guarantors_report');
        $this->load->view('backend/index', $page_data);			
	}

	function interest_report($param1=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');			
		
		$page_data['page_name']  = 'interest_report';
        $page_data['page_title'] = get_phrase('interest_report');
        $this->load->view('backend/index', $page_data);			
	}

	function transactions($param1="",$param2=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');			
		
		
		$page_data['page_name']  = 'transactions';
        $page_data['page_title'] = get_phrase('transactions');
        $this->load->view('backend/index', $page_data);			
	}
	function create_transaction($param1="",$param2=""){
			
			if($param1==='create_income'){
				if($param2==='shares'){
					$untransacted_shares  = $this->db->get_where('shares',array('transacted'=>'No'))->result_object();
					
					if(count($untransacted_shares)>0){
							//Create transaction header
							
							$data['account']='CR';
							$data['transaction_type'] = $param2;
							
							$this->db->insert('transaction_header',$data);
							
							$headerid = $this->db->insert_id();
							
							//Create transaction
							
							foreach($untransacted_shares as $row):
								$data2['transaction_header_id'] = $headerid;
								$data2['transaction_type_id'] = $row->shares_id;
								$data2['amount'] = $row->amount;
								
								$this->db->insert('transaction',$data2);
							endforeach;	
							
							//Update all un-transacted share records
							
							$update_cond = $this->db->where('transacted','No');
							$data3['transacted'] = 'Yes';
							
							$this->db->update('shares',$data3);
							
					
						//print_r(json_encode($data));
						echo 'Transaction serial number '.$headerid.' has been created for '.$param2;
					}else{
						echo "All ".$param2." records were transacted";
					}
						
				}


			if($param2==='repayment'){
				$untransacted_repayment  = $this->db->get_where('repayment',array('transacted'=>'No'))->result_object();
				
				if(count($untransacted_repayment)>0){
							//Create transaction header
							
							$data['account']='CR';
							$data['transaction_type'] = $param2;
							
							$this->db->insert('transaction_header',$data);
							
							$headerid = $this->db->insert_id();
							
							//Create transaction
							
							foreach($untransacted_repayment as $row):
								$data2['transaction_header_id'] = $headerid;
								$data2['transaction_type_id'] = $row->repayment_id;
								$data2['amount'] = $row->sched_pay+$row->extra_pay;
								
								$this->db->insert('transaction',$data2);
							endforeach;
							
						//Update all un-transacted repayment records
							
							$update_cond = $this->db->where('transacted','No');
							$data3['transacted'] = 'Yes';
							
							$this->db->update('repayment',$data3);
							
					
						//print_r(json_encode($data));
						echo 'Transaction serial number '.$headerid.' has been created for '.$param2;
				}else{
					echo "All ".$param2." records were transacted";
				}
				
			}
			
			}
			
		}
	/**LOANS**/
	function loans_settings($param1="",$param2=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');			
		
		$page_data['page_name']  = 'loans_settings';
        $page_data['page_title'] = get_phrase('loans_and_shares_settings');
        $this->load->view('backend/index', $page_data);			
	}
	
	function loan_types($param1="",$param2=""){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');		
		
		if($param1==="add"){
			$data['loan_type'] = $this->input->post('loan_type');
			$data['interest_rate']  = $this->input->post('interest_rate');
			$data['guarantee_required']  = $this->input->post('guarantee_required');
			$data['max_loan_life']  = $this->input->post('max_loan_life');
			$data['loan_limit_by_amount']  = $this->input->post('loan_limit_by_amount');
			$data['loan_limit_by_ratio']  = $this->input->post('loan_limit_by_ratio');
			
			$this->db->insert("loan_settings",$data);
			
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/loan_types', 'refresh');	
		}
		if($param1==="edit"){
			$data['loan_type'] = $this->input->post('loan_type');
			$data['interest_rate']  = $this->input->post('interest_rate');
			$data['guarantee_required']  = $this->input->post('guarantee_required');
			$data['max_loan_life']  = $this->input->post('max_loan_life');
			$data['loan_limit_by_amount']  = $this->input->post('loan_limit_by_amount');
			$data['loan_limit_by_ratio']  = $this->input->post('loan_limit_by_ratio');
			$data['active']  = $this->input->post('active');
			
			$this->db->where("loan_settings_id",$param2);
			
			$this->db->update("loan_settings",$data);
			
			
			$this->session->set_flashdata('flash_message' , get_phrase('data_edited_successfully'));
            redirect(base_url() . 'index.php?admin/loan_types', 'refresh');	
		}		
		$page_data['page_name']  = 'loan_types';
        $page_data['page_title'] = get_phrase('loan_types');
        $this->load->view('backend/index', $page_data);			
	}
	function apply_loan($param1 = '', $param2 = '', $param3='')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		
			$page_data['page_name']  = 'apply_loan';
        	$page_data['page_title'] = get_phrase('apply_loan');
			$page_data['loans_id'] = $param1;
			$this->load->view('backend/index', $page_data);
		
	}

	function update_loan($param1 = '', $param2 = '', $param3 = '',$param4 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh'); 
		
		if($param1=='create_gurantor'){
			$data['member_id']           = $param2;
            $data['loans_id']       = $param3;
			$data['status']       = "requested";
			
			$share_due = $this->sacco_model->shares_due($param4,$param3);
		   
		   	if($share_due>0){
            	$this->db->insert('guarantors', $data);
            	$this->session->set_flashdata('flash_message' , get_phrase('request_sent_successfully'));
				$this->email_model->loan_guarantor_request_email();		   		
		   	}else{
		   		$this->session->set_flashdata('flash_message' , get_phrase('process_failed'));
		   	}
            
            redirect(base_url() . 'index.php?admin/loan/', 'refresh');
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
            
            redirect(base_url() . 'index.php?admin/loans/', 'refresh');
		}
		
			$page_data['page_name']  = 'apply_loan';
	        $page_data['page_title'] = get_phrase('update_loan');
	        $this->load->view('backend/index', $page_data);
	}

	function loans($param1 = '', $param2 = '', $param3='', $param4='')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		if($param1=='save'){
				$data['member_id'] = $param2; 
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
				
				$existing_loan = $this->db->get_where('loans',array('member_id'=>$param2));
				$purpose = $this->input->post('purpose');
				$amount = $this->input->post('purpose_amount');
				$tbl = "loan_purpose";
									
				
				$security = $this->input->post('security');
				$security_amount = $this->input->post('security_amt');
				$tbl_security = "loan_security";
							
				$loanid = $existing_loan->row()->loans_id;
									
				if(count($existing_loan->result_array())>0){
					//Update the record
					$this->db->where(array('member_id'=>$param2));
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
				
			if($this->input->post('status')!=='new'){
				   	if($this->input->post('status')==='submitted') $data3['application_date'] = date('Y-m-d');
					$data3['status'] = $this->input->post('status');
					
					
				   	$this->db->where(array('loans_id'=>$loanid));
		            $this->db->update('loans', $data3);			
			}
			
			if($this->input->post('status')==='declined'||$this->input->post('status')=='deferred'){
				   	$data4['loans_id'] = $loanid;
					if($this->input->post('status')==='deferred') $data4['comment_code'] = '2';
					if($this->input->post('status')==='declined') $data4['comment_code'] = '1';
					if($this->input->post('status')==='declined') $data4['comment'] = $this->input->post('declined_comment');
					if($this->input->post('status')==='deferred') $data4['comment'] = $this->input->post('deferred_comment');
					$data4['comment_by'] = $this->session->userdata('admin_id');
					if($this->input->post('status')==='deferred') $data4['next_action_date'] = $this->input->post('action_date');
					
					
				   	//$this->db->where(array('loans_id'=>$loanid));
		            $this->db->insert('loan_comments', $data4);			
			}
			
			//Additional Fields
			$this->crud_model->update_additional_info($loanid,'loan_application');
			
		}
		
		if($param1==='approve'&&$param3<1){
			
			
			//Get Member ID
			$member_id = $this->db->get_where("loans",array("loans_id"=>$param2))->row()->member_id;
			
			//Check if member has an active loan balance
			$chk_active_loan = $this->db->get_where("loans",array("status"=>"active","member_id"=>$member_id,"loan_type"=>$param4))->result_array();// Add loan_type
			$active_bal = 0;
			if(count($chk_active_loan)>0){
				$active_bal = $this->db->select_min("end_bal")->get_where("repayment",array("loan_id"=>$chk_active_loan[0]['loans_id']))->row()->end_bal;
			}
			
			//Check if top up
			$top_up = $this->db->get_where("loans",array("loans_id"=>$param2))->row()->top_up;
			
			//Rate
			$rate = $this->db->get_where("loans",array("loans_id"=>$param2))->row()->rate;
			
			//Term
			$term = $this->db->get_where("loans",array("loans_id"=>$param2))->row()->repayment_period;
			
			//Scheduled Pay
			$sched_pay = $this->db->get_where("loans",array("loans_id"=>$param2))->row()->sched_pay;
			
			if($top_up>0&&$active_bal>0){
				$princ = $active_bal+$top_up;
				$data['principle'] = $princ;
				$efrate = $rate/12;
				$data['sched_pay'] = round($princ * ($efrate/(1-pow((1+$efrate),-$term))),2);
			}
            
            if($top_up>0&&$active_bal>0){
            	//Get loan id of the active loan
            	$prev_loan_id = $this->db->get_where("loans",array("member_id"=>$member_id,"status"=>"active"))->row()->loans_id;
            	
				//Update Old Loan Guarantors to new Loan
				$this->db->where("loans_id",$prev_loan_id);
				$data2['loans_id'] = $param2;
				$this->db->update("guarantors",$data2);
				
				
				//Deactivate Previous Active Loan
				$crt = "loans_id!=".$param2." AND member_id='".$member_id."' AND status='active'";
				$this->db->where($crt);
				$data3['status']="inactive";
				$this->db->update("loans",$data3);
				
			}

			$data['status']= 'active';
			$data['loan_date'] = date("Y-m-d");
			           
            $this->db->where('loans_id', $param2);
            $this->db->update('loans', $data);
			
			
            $this->session->set_flashdata('flash_message' , get_phrase('loan_approved_successfully'));
            redirect(base_url() . 'index.php?admin/loans/', 'refresh');
		}elseif($param3>0){
			$this->session->set_flashdata('flash_message' , get_phrase('loan_not_approved_due_to_share_deficit'));
            redirect(base_url() . 'index.php?admin/loans/', 'refresh');			
		}

		if($param1==='decline'){
			$data['status'] = 'declined';
            
            $this->db->where('loans_id', $param2);
            $this->db->update('loans', $data);
			
			$data2['comment_by'] = $this->session->userdata('admin_id');
            $data2['loans_id']       = $param2;
			$data2['comment'] = $this->input->post('reason');
			$data2['comment_code'] = 1;
		   
            $this->db->insert('loan_comments', $data2);
			
            $this->session->set_flashdata('flash_message' , get_phrase('loan_approved_successfully'));
            redirect(base_url() . 'index.php?admin/loans/', 'refresh');			
		}
		
		if($param1==='defer'){
			$data['status'] = 'deferred';
            
            $this->db->where('loans_id', $param2);
            $this->db->update('loans', $data);
			
			$data2['comment_by'] = $this->session->userdata('admin_id');
            $data2['loans_id']       = $param2;
			$data2['comment'] = $this->input->post('reason');
			$data2['next_action_date'] = $this->input->post('action_date');
			$data2['comment_code'] = 2;
		   
            $this->db->insert('loan_comments', $data2);
			
            $this->session->set_flashdata('flash_message' , get_phrase('loan_approved_successfully'));
            redirect(base_url() . 'index.php?admin/loans/', 'refresh');			
		}
		
		if($param1==="extra"){
			$data6['extra_pay'] = $this->input->post('extra_pay');
			$this->db->where("loans_id",$param2);
			
			$this->db->update("loans",$data6);
			
			$this->session->set_flashdata('flash_message' , get_phrase('scheduled_extra_payment_updated'));
            redirect(base_url() . 'index.php?admin/loans/', 'refresh');
		}
		
		if($param1==="apply"){
			$data['member_id']=$param2;
			
			$this->db->insert('loans',$data);
			
			$loans_id = $this->db->insert_id();
			
			$this->session->set_flashdata('flash_message' , get_phrase('record_created_successfully'));

            redirect(base_url() . 'index.php?admin/apply_loan/'.$loans_id, 'refresh');
		}
		
		if($param1==='repay'){
			$data['pmt'] = $this->input->post('pmt');		
            $data['repayment_date'] = $this->input->post('repayment_date');
			$data['sched_pay'] = $this->input->post('sched_pay');
			$data['extra_pay'] = $this->input->post('extra_pay')+$this->input->post('one_time_extra_pay');
			if($this->input->post('excess_payment')>0){
				$data['extra_pay'] -=$this->input->post('excess_payment');
			}
			$data['loans_id'] = $param2;

			//Calculate begining balance
			$beg_bal = $this->db->get_where("loans",array("loans_id"=>$param2))->row()->principle;
			$sum_princ = $this->db->select_sum('princ')->get_where("repayment",array("loans_id"=>$param2))->row()->princ;
			
				if($sum_princ>0){
					$beg_bal -=  $sum_princ;
				}
				
			$data['beg_bal'] = $beg_bal;
			
			//Calculate the Principal and Interest
			$rate = $this->db->get_where("loans",array("loans_id"=>$param2))->row()->rate;
			$total_pay = $data['sched_pay']+$data['extra_pay'];
			
			$intr = ($rate/12)*$beg_bal;
			$princ = $total_pay-$intr;
			
			$data['princ'] = $princ;
			
			$data['intr'] = $intr;
			
			//Calculate End Balance
			$end_bal = $beg_bal-$princ;
			$data['end_bal']=$end_bal;
			
			$data['approval']="approved";
		   
            $this->db->insert('repayment', $data);
			
			if(number_format($end_bal,0)==='0'){
				$data3['status'] = "inactive";
				$this->db->where(array("loans_id"=>$param2))->update("loans",$data3);	
				
				$data3['status'] = 'freed';
				$this->db->where("loans_id",$param2);
				$this->db->update("guarantors",$data4);
			}
			
			//Update extra-payment table approved records to transfered
			
			$data2['status'] = "transfered";
			
			$this->db->where(array("status"=>"approved","loans_id"=>$param2))->update("extra_payments",$data2);
			
			//Update Shares if excess payment is done
			
			if($this->input->post('excess_payment')>0){
						
				$member_id = $this->db->get_where("loans",array("loans_id"=>$param2))->row()->member_id;
								
				$data4['amount'] = $this->input->post('excess_payment');
				$data4['member_id'] =  $member_id;
				$data4['details'] = "Excess loan payment converted for loan id ".$param2;
				$data4['sharemonth'] = date("m/d/Y");
				$this->db->insert("shares",$data4);
			}
			
			
            $this->session->set_flashdata('flash_message' , get_phrase('loan_repayment_successful'));
            redirect(base_url() . 'index.php?admin/loans/', 'refresh');	
		}
		
		if($param1==='delete'){
			//Check if a loan is new
			
			$new_check = $this->db->get_where('loans',array('loans_id'=>$param2))->row()->status;
			
			if($new_check==='new'||$new_check==='declined'){
				//$this->db->where("loans_id",$param2);
				$this->db->delete("loans",array('loans_id'=>$param2));
				$this->db->delete('guarantors',array('loans_id'=>$param2));
				$this->db->delete('loan_purpose',array('loans_id'=>$param2));
				$this->db->delete('loan_security',array('loans_id'=>$param2));
				
	            $this->session->set_flashdata('flash_message' , get_phrase('application_cancelled_successfully'));				
			}else{
				$this->session->set_flashdata('flash_message' , get_phrase('process_failed'));
			}
					
		}
		
		$page_data['page_name']  = 'loans';
        $page_data['page_title'] = get_phrase('process_loan');
        $this->load->view('backend/index', $page_data);		
	}
	function loan_schedules($param1='',$param2=""){
		 if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		 
		 if($param1==='delete'){
		 	
			$data['loans_id'] = $param2;
			
			$this->db->delete("repayment",$data);
			
            $this->session->set_flashdata('flash_message' , get_phrase('payment_schedule_deleted'));
            redirect(base_url() . 'index.php?admin/loans/', 'refresh');		 	
		 }

		$page_data['page_name']  = 'add_loan_schedules';
        $page_data['page_title'] = get_phrase('add_loan_schedules');
		$page_data['member_id'] = $param1;
		$page_data['loans_id'] = $param2;
        $this->load->view('backend/index', $page_data);			 		
	}
	function loan_calculator($param1='',$param2='',$param3=''){
		 if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		 
		$page_data['page_name']  = 'loan_calculator';
        $page_data['page_title'] = get_phrase('loan_schedule');
		$page_data['loans_id'] = $param1;
        $this->load->view('backend/index', $page_data);			 		
	}
	
	/** EXTRA PAYMENTS PROCESSING **/
	
	function extra_payments($param1='',$param2='',$param3=''){
		 if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		 
		 if($param1==='approve'){
		 	$data['status'] = "approved";
			
			$this->db->where("payment_id",$param2);
			$this->db->update("extra_payments",$data);
            $this->session->set_flashdata('flash_message' , get_phrase('loan_extra_repayment_approved'));
            redirect(base_url() . 'index.php?admin/extra_payments/', 'refresh');				
		 }
		 
		
		
		$page_data['page_name']  = 'extra_payments';
        $page_data['page_title'] = get_phrase('extra_payments');
        $this->load->view('backend/index', $page_data);	
	}
	//////RATE//////
	
	function rate($param1=''){
		$rate = $this->db->get_where("loan_settings",array("loan_type"=>$param1))->row()->interest_rate;
		
		echo $rate;//$rate;
	}
	
	
	/////GUARANTORS////
	
	function guarantor_check($param1=""){
		$details = $this->crud_model->get_member_details($param1);
		
		$guarantor_potential = $details['shares']['amount']-$details['shares']['guaranteed'];
		
		if($guarantor_potential!== 0){
			echo $guarantor_potential;
		}else{
			echo 0;
		}
		
	}
	function guarantors($param1='',$param2=""){
		if($this->session->userdata('admin_login')!= 1)
		redirect(base_url(),'refresh');
		
		if($param1==="add"){
			
			$data['member_id'] = $this->input->post('member_id');
			$data['loans_id'] = $param2;
			$data['share_guaranteed'] = $this->input->post("share_guaranteed");
			$data['status'] = 'accepted';
			
			$this->db->insert("guarantors",$data);
			
            $this->session->set_flashdata('flash_message' , get_phrase('operation_successful'));
            redirect(base_url() . 'index.php?admin/loans/', 'refresh');			
		}
		
		$page_data['page_name']  = 'loans';
        $page_data['page_title'] = get_phrase('process_loan');
        $this->load->view('backend/index', $page_data);			
	}
	/**DEPARTMENTS**/
	function departments($param1 = ''){
		if($this->session->userdata('admin_login')!= 1)
		redirect(base_url(),'refresh');
		
		if($param1=== 'create'){
            $data['name']     = $this->input->post('name');
            $this->db->insert('department', $data);		
			$this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/departments', 'refresh');	
		}
		
		if($param1==='to_update'){
			
		}
		
		if($param1==='delete'){
			
		}
		
		$page_data['page_name']  = 'departments';
        $page_data['page_title'] = get_phrase('manage_departments');
        $page_data['departments']    = $this->db->get('department')->result_array();
        $this->load->view('backend/index', $page_data);
	}
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations
                $students = $this->db->get('student')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
 
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'index.php?admin/message/message_read/' . $param2, 'refresh');
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
    
    /*****SITE/SYSTEM SETTINGS*********/

    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
		if($param1=="loan_self_guaranteeing"){
			
			$data['set_to'] = $param2;
			$this->db->where("name","self_guaranteeing");
			
			$this->db->update("system",$data);
			
			echo get_phrase('setting_set_successful');exit;
			//$this->session->set_flashdata('flash_message', get_phrase('setting_set_successful'));
            //redirect(base_url() . 'index.php?admin/loans_settings/', 'refresh');
		}
        if ($param1 == 'do_update') {
			 
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type' , 'text_align');
            $this->db->update('settings' , $data);
			
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated')); 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected')); 
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh'); 
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
	
	/***** UPDATE PRODUCT *****/
	
	function update( $task = '', $purchase_code = '' ) {
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            
        // Create update directory.
        $dir    = 'update';
        if ( !is_dir($dir) )
            mkdir($dir, 0777, true);
        
        $zipped_file_name   = $_FILES["file_name"]["name"];
        $path               = 'update/' . $zipped_file_name;
        
        move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);
        
        // Unzip uploaded update file and remove zip file.
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            $zip->extractTo('update');
            $zip->close();
            unlink($path);
        }
        
        $unzipped_file_name = substr($zipped_file_name, 0, -4);
        $str                = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
        $json               = json_decode($str, true);
        

			
		// Run php modifications
		require './update/' . $unzipped_file_name . '/update_script.php';
        
        // Create new directories.
        if(!empty($json['directory'])) {
            foreach($json['directory'] as $directory) {
                if ( !is_dir( $directory['name']) )
                    mkdir( $directory['name'], 0777, true );
            }
        }
        
        // Create/Replace new files.
        if(!empty($json['files'])) {
            foreach($json['files'] as $file)
                copy($file['root_directory'], $file['update_directory']);
        }
        
        $this->session->set_flashdata('flash_message' , get_phrase('product_updated_successfully'));
        redirect(base_url() . 'index.php?admin/system_settings');
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'twilio') {

            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        if ($param1 == 'active_service') {

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'index.php?admin/sms_settings/', 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;	
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);
			
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = get_phrase('manage_language');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);	
    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('admin_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

	function system_reset($param1='',$param2=''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
		
		if($param1==='backup'){
			
		       date_default_timezone_set('Asia/Calcutta');
		      // Load the DB utility class 
		      $this->load->dbutil(); 
		      $prefs = array( 'format' => 'zip', // gzip, zip, txt 
		                               'filename' => 'backup_'.date('d_m_Y_H_i_s').'.sql', 
		                                                      // File name - NEEDED ONLY WITH ZIP FILES 
		                                'add_drop' => TRUE,
		                                                     // Whether to add DROP TABLE statements to backup file
		                               'add_insert'=> TRUE,
		                                                    // Whether to add INSERT data to backup file 
		                               'newline' => "\n"
		                                                   // Newline character used in backup file 
		                              ); 
		         // Backup your entire database and assign it to a variable 
		         $backup = $this->dbutil->backup($prefs); 
		         // Load the file helper and write the file to your server 
		         
		         write_file('backup/'.'dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup); 
		         // Load the download helper and send the file to your desktop 
		         
		         force_download('dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup);
		}
		
		if($param1==='download'){
			force_download('backup/'.$param2,NULL);
		}
		if($param1==='reset'){
			$tables = array("document","extra_payments","guarantors","loans","loan_comments","loan_purpose","repayment","shares","share_rate","transaction","transaction_header");
			foreach($tables as $table) {
			  $this->db->empty_table($table); 
			}
		}
		
		$page_data['page_name']  = 'system_reset';
        $page_data['page_title'] = get_phrase('system_reset');
		$this->load->view('backend/index', $page_data);		
	}
    
	function email_templates($param1='',$param2=''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');	
		
		if($param1==='update'){
			//$data['name'] = $this->input->post('post_title');
			$data['content'] = $this->input->post('post_content');
			
			$this->db->where(array('mail_template_id'=>$param2));
			$this->db->update('mail_template',$data);
		}
		
		if($param1==='update_phrase'){
			$data['description'] = $this->input->post('description');
			
			$this->db->where(array('mail_phrase_id'=>$param2));
			$this->db->update('mail_phrase',$data);
		}	

		$page_data['page_name']  = 'email_templates';
        $page_data['page_title'] = get_phrase('email_templates');
		$this->load->view('backend/index', $page_data);	
	}
}
