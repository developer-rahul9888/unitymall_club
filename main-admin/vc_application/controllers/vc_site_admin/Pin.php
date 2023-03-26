<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Pin extends CI_Controller {
		
		 public function __construct()
		{
			parent::__construct();
			
			$this->load->library('session');
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('coupon_model');
			$this->load->helper('string');		
			if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
		}
		
	  public function index() {
		  
				 $sdate = date('Y-m-1 00:00:01');
				 $edate = date('Y-m-t 23:59:59');
				 $status = ''; 	
			
			 if ($this->input->server('REQUEST_METHOD') === 'POST') {
			 
				   if($this->input->post('sdate')!='') { $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate'))); }
				   if($this->input->post('edate')!='') { $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); }
				   $status = $this->input->post('st'); 
			}
			
			$data['pin'] = $this->coupon_model->get_all_pin($sdate, $edate ,$status);
		
		//load the view
		  $data['main_content'] = 'admin/pin_list';
		  $this->load->view('includes/admin/template', $data);   
	  }
	  
	  
	 
	   public function my_pin_transfer() {
		  
			$userid = '';
			 if ($this->input->server('REQUEST_METHOD') === 'POST') {
			   if($this->input->post('sdate')!=''){
				   $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
			   }
			   if($this->input->post('edate')!=''){
				   $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
			   }
			   $userid = $this->input->post('transferto'); 
			}else{ 
				 $sdate = date('Y-m-1 00:00:01');
				 $edate = date('Y-m-t 23:59:59'); 
			}
			
			$data['pin'] = $this->coupon_model->my_transfer_all_pin($sdate, $edate,$userid);
		
		//load the view
		  $data['main_content'] = 'admin/my_pins_transfer';
		  $this->load->view('includes/admin/template', $data);   
	  }
	  
	  
	  
	   public function reward() {
		   
		   
	   
			 if ($this->input->server('REQUEST_METHOD') === 'POST') {
			 
				   $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('s_name')));
				   $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('e_name'))); 
				  
			}else{
				
				 $sdate = date('Y-m-1 00:00:01');
				 $edate = date('Y-m-t 23:59:59');
					 
				
			}
		$data['reward'] = $this->coupon_model->get_reward_by_date($sdate,$edate);
		
		//load the view
		  $data['main_content'] = 'admin/reward';
		  $this->load->view('includes/admin/template', $data);   
	  }
	  
		  public function payouts() {
		   $last_friday = date('Y-m-d 00:00:01',strtotime("last thursday"));
		  $week_end = date('Y-m-d 23:59:59',strtotime("+ 6 days",strtotime($last_friday)));
		  $data['error_msg'] = '';
		  
		   if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit') == 'Search') {
			 
				   $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
				   $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));  
			}else{ 
				 $sdate = date('Y-m-1 00:00:01');
				 $edate = date('Y-m-t 23:59:59'); 
			}
		  
		  $payouts = $this->coupon_model->get_all_payout_merge('Weekly Closing',$sdate,$edate);
		  
			if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit') != 'Search') {
				$user_ids = $this->input->post('userid');
				if(empty($user_ids) || empty($payouts)){
					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please select at least one user.</strong></div>';
				} else {
					
					//foreach($user_ids as $uid) {
					foreach($payouts as $userinfo) {
					if($userinfo['amount'] >= 300) {
					  if(in_array($userinfo['userid'],$user_ids)) { 
						//$this->coupon_model->update_income_status($userinfo[0]);
						$tr_log = array('status'=>'Bank Process');
						$this->coupon_model->update_transactional_log_byid($userinfo['userid'],'Weekly Closing',$tr_log);
						/***************** transectional email ******************/
						
						
						/***************** SMS ******************/
						
				
						
if(!empty($userinfo['account_no']) && $userinfo['phone']!=''){
$sms_msg = urlencode("Congrats ".$userinfo['f_name']." total payout for A/C ***".substr($userinfo['account_no'], -4)." is Rs. ".$userinfo['net_income']." weekly has been transferred and will be credited within 48 hours.\n
fdnmarketting.");

$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-aurasway&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$userinfo['phone']."&source=AURASW&message=".$sms_msg;

//file_get_contents($smstext);
}

/***************** SMS ******************/
				 		
			if($userinfo['email']!='') {
				 $to = $userinfo['email'];
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: fdnmarketting <info@fdnmarketting.com>' . "\r\n"; 
				$subject = 'fdnmarketting weekly closing.';
$message = 'Congratulation <strong>'.$userinfo['f_name'].' '.$userinfo['l_name'].'</strong> total payout for A/C '.$userinfo['account_no'].' is <strong>Rs. '.$userinfo['net_income'].'</strong> weekly has been transferred and will be credited within 48 hours in your bank.
</b><br> 
From - fdnmarketting<br>
Date: '.date('d F Y h:i:s A').'
';
				//mail($to,$subject,$message,$headers);
			}
			
					  }
					}
					}
					$this->session->set_flashdata('flash_message', 'updated');
					redirect(current_url());
					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Payout Successfully.</strong></div>';
					$payouts = $this->coupon_model->get_all_payout('Weekly Closing',$sdate,$edate);
				}
			}
			
		$data['payouts'] = $payouts;
		
		//load the view
		  $data['main_content'] = 'admin/payouts';
		  $this->load->view('includes/admin/template', $data);   
	  }
	 
	 public function bank_process() { 
		  $data['error_msg'] = '';
		  $payouts = $this->coupon_model->get_all_payout_merge('Bank Process');
		  
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
				$user_ids = $this->input->post('userid');
				$banktrid = $this->input->post('banktrid');
				if(empty($user_ids) || empty($payouts)){
					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please select at least one user.</strong></div>';
				} else {
					
					//foreach($user_ids as $uid) {
					for($p=0;$p<count($payouts);$p++) {
					    $userinfo = $payouts[$p];
					  if(in_array($userinfo['userid'],$user_ids)) {  
						$tr_log = array('status'=>'Clear','bank_tran'=>$banktrid[$p],'udate'=>date('Y-m-d'));
						$this->coupon_model->update_transactional_log_byid($userinfo['userid'],'Bank Process',$tr_log);
						//$this->coupon_model->update_income_status_clear($userinfo['userid']);
						
						$tds = (5 / 100) * $userinfo['amount'];
						if($userinfo['pancard'] == '') { $payable = $userinfo['amount'] - 2*$tds; } else { $payable = $userinfo['amount'] - 2*$tds ; }
						$payable = round($payable,2);
						$phone = $userinfo['phone'];
						/***************** SMS ******************/
		$sms_msg = urlencode('Hi Dear '.$userinfo['f_name'].' '.$userinfo['l_name'].' Glad to inform you that your this week payout amount is Rs. '.$payable.' .Congratulation & keep up the good work continue ahead.
From - Firstdealnet
Date: '.date('d F Y h:i:s A').'');

$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-firstdealne&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=FSTDEL&message=".$sms_msg;
 // file_get_contents($smstext);

/***************** SMS ******************/
							if($userinfo['email']!='') {
				
				 $to = $userinfo['email'];
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: Firstdealnet <info@firstdealnet.in>' . "\r\n"; 
				$subject = 'Firstdealnet weekly closing.';
$message = 'Hi Dear '.$userinfo['f_name'].' '.$userinfo['l_name'].'</strong> Glad to inform you that your this week payout amount is <strong>Rs. '.$payable.'</strong> .Congratulation & keep up the good work continue ahead.
</b><br> 
From - Firstdealnet<br>
Date: '.date('d F Y h:i:s A').'
';
			//	mail($to,$subject,$message,$headers);
			}
					  }
					}
					/*foreach($payouts as $userinfo) {
					  if(in_array($userinfo['userid'],$user_ids)) {  
						$tr_log = array('status'=>'Clear');
						$this->coupon_model->update_transactional_log($userinfo['userid'],$tr_log);
						$this->coupon_model->update_income_status_clear($userinfo['userid']);
					  }
					}*/
					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Bank Process Compleded Successfully.</strong></div>';
					$payouts = $this->coupon_model->get_all_payout('Bank Process');
				}
			}
			
		$data['payouts'] = $payouts;
		
		//load the view
		  $data['main_content'] = 'admin/bank_process';
		  $this->load->view('includes/admin/template', $data);   
	  }
	   public function bank_statement() { 
		  $data['error_msg'] = '';
		  
		   if ($this->input->server('REQUEST_METHOD') === 'POST') {
			 
				   $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
				   $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));  
			}else{ 
				 $sdate = date('Y-m-1 00:00:01');
				 $edate = date('Y-m-t 23:59:59'); 
			}
			
		  $payouts = $this->coupon_model->get_all_payout('Clear',$sdate,$edate);
		  
			
		$data['payouts'] = $payouts;
		
		//load the view
		  $data['main_content'] = 'admin/bank_statement';
		  $this->load->view('includes/admin/template', $data);   
	  }
	  
	   public function weekly_closing() {
	       
	       
	    /*  $logs =   $this->coupon_model->get_all_trans();
	      $manual_array = array();
	      $repuchase_wallet = array();
	      if(!empty($logs)) {
	          foreach ($logs as $log) {
	              if($log['amount'] > 0) {
	              $manual_array[] = array('user_id'=>$log['customer_id'],'credit_amt'=>(90/100)*$log['amount'],'receiver_id'=>$log['customer_id'],'sender_id'=>'admin','receive_date'=>date('Y-m-d',strtotime($log['rdate'])),'TranDescription'=>'Daily-Closing-Income','Cause'=>'Daily Closing Payout Income');
	          
	              $repuchase_wallet[] = array('user_id'=>$log['customer_id'],'credit_amt'=>(10/100)*$log['amount'],'receiver_id'=>$log['customer_id'],'sender_id'=>'admin','receive_date'=>date('Y-m-d',strtotime($log['rdate'])),'TranDescription'=>'Daily-Closing-Income','Cause'=>'Daily Closing Payout Income');
	              } 
	          }
	      } */
	       
	     //  echo '<pre>'; print_r($manual_array); echo '</pre>';
	       
	    //   $this->coupon_model->insert_batch('credit_debit',$manual_array);
	     //  $this->coupon_model->insert_batch('repurchase_wallet',$repuchase_wallet);
	       
	       
	       
		   $last_friday = date('Y-m-d 00:00:01',strtotime("last thursday"));
		   $closing_date = date('Y-m-d 23:59:59',strtotime("+ 6 days",strtotime($last_friday)));
		   if(date('l')=='Thursday') { $last_friday = date('Y-m-d 00:00:01'); }
		   $week_end = date('Y-m-d 23:59:59',strtotime("+ 6 days",strtotime($last_friday)));
		   
	$data['insentive'] = $this->coupon_model->get_payout_by_date_table('binary_income');
	/*$data['cashback'] = $this->coupon_model->get_payout_by_date_table('binary_level_income');
	$data['rahul'] = $this->coupon_model->get_payout_by_date_table('direct_income');
	$data['turnover_income'] = $this->coupon_model->get_payout_by_date_table('turnover_income');
	$data['repurchase_income'] = $this->coupon_model->get_payout_by_date_table('repurchase_income');*/
	//print_r($data['insentive']);   
		   
		   $payouts = array();

    if(!empty($data['insentive'])) {
     foreach($data['insentive'] as $con){ 
        if (array_key_exists($con['user_id'],$payouts)){
            $payouts[$con['user_id']]['total_amount'] = $payouts[$con['user_id']]['total_amount'] + $con['amt'];
        }
        else {
            $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard'],'var_status'=>$con['var_status'],'repurchase'=>'No');
        }
     }
    }		   
	
	/*$user_ids = array_column($payouts, 'user_id');  
    	if(!empty($user_ids)) {
    		$customer_data = $this->coupon_model->get_all_customer_idds($user_ids);
    	}

    	if(!empty($customer_data)) {
     foreach($customer_data as $con){ 
        if (array_key_exists($con['id'],$payouts)){
            $payouts[$con['id']]['repurchase'] = 'Yes';
        }
     }
    }*/

		  $data['error_msg'] = '';
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
			   // $payouts = $this->coupon_model->get_payout_by_date('',$closing_date,'Active');
				$user_ids = $this->input->post('userid');
				if(1==2) { 
					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>You can not close week before Thursday 12 AM.</strong></div>';
				} 
				/* elseif(empty($user_ids)){
					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please select at least one user.</strong></div>';
				} */ else {
					$all_users = array();
					$manual_array = array();
					$repuchase_wallet = array();
					foreach($payouts as $con){ 
			//			if($con['total_amount'] > 0) { $all_insentive_users[] = $con['user_id']; }
			//if($con['amt'] > 0) { $all_cash_back_users[] = $con['user_id']; }
					    $all_users[] = $con['user_id'];
						if($con['var_status']=='yes') { $tds = (5 / 100) * $con['total_amount'];   } else {
							$tds = (10 / 100) * $con['total_amount'];
						}
						$admin = (5 / 100) * $con['total_amount'];
						$net_income = $con['total_amount'] - $tds - $admin;
						$description = $con['user_id'].'~~'.$con['total_amount'].'~~'.$tds;
							
						$tr_log[] = array('userid'=>$con['user_id'],'amount'=>$con['total_amount'],'tds'=>$tds,'admin'=>$admin,'net_income'=>$net_income,'type'=>'Weekly closing','description'=>$description,'status'=>'Weekly Closing');
						$manual_array[] = array('user_id'=>$con['customer_id'],'credit_amt'=>(90/100)*$con['total_amount'],'receiver_id'=>$con['customer_id'],'sender_id'=>'admin','receive_date'=>date('Y-m-d'),'TranDescription'=>'Daily-Closing-Income','Cause'=>'Daily Closing Payout Income');
						
						
						
					}
					if(!empty($all_users)) {
					    $this->coupon_model->update_income_status_all_user('binary_income',$all_users);
					    if(!empty($manual_array)) {
					    	$this->coupon_model->insert_batch('credit_debit',$manual_array);
					    }
					    
	                 //  $this->coupon_model->insert_batch('repurchase_wallet',$repuchase_wallet);	     
						$this->coupon_model->insert_batch('transaction_log',$tr_log);
					}
					$this->session->set_flashdata('flash_message', 'updated');
					redirect(current_url());
					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Closing Successfully.</strong></div>';
				}
				
			}
		//$payouts = $this->coupon_model->get_payout_by_date('',$week_end,'Active');	
		$data['payouts'] = $payouts;
		
		//load the view
		  $data['main_content'] = 'admin/weekly_closing';
		  $this->load->view('includes/admin/template', $data);   
	  }
	  

	   public function monthly_closing() {
	       
		   $last_friday = date('Y-m-d 00:00:01',strtotime("last thursday"));
		   $closing_date = date('Y-m-d 23:59:59',strtotime("+ 6 days",strtotime($last_friday)));
		   if(date('l')=='Thursday') { $last_friday = date('Y-m-d 00:00:01'); }
		   $week_end = date('Y-m-d 23:59:59',strtotime("+ 6 days",strtotime($last_friday)));
		   
	//$data['insentive'] = $this->coupon_model->get_payout_by_date_table('binary_income');
	$data['cashback'] = $this->coupon_model->get_payout_by_date_table('binary_level_income');
	$data['rahul'] = $this->coupon_model->get_payout_by_date_table('direct_income');
	$data['turnover_income'] = $this->coupon_model->get_payout_by_date_table('turnover_income');
	$data['repurchase_income'] = $this->coupon_model->get_payout_by_date_table('repurchase_income');
	$data['reward_income'] = $this->coupon_model->get_payout_by_date_table('reward_income');
	//print_r($data['insentive']);   
		   
		   $payouts = array();
    if(!empty($data['cashback'])) {
     foreach($data['cashback'] as $con){
        $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard'],'var_status'=>$con['var_status'],'repurchase'=>'No');
     }
    }

    if(!empty($data['insentive'])) {
     foreach($data['insentive'] as $con){ 
        if (array_key_exists($con['user_id'],$payouts)){
            $payouts[$con['user_id']]['total_amount'] = $payouts[$con['user_id']]['total_amount'] + $con['amt'];
        }
        else {
            $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard'],'var_status'=>$con['var_status'],'repurchase'=>'No');
        }
     }
    }
	if(!empty($data['rahul'])) {
     foreach($data['rahul'] as $con){ 
        if (array_key_exists($con['user_id'],$payouts)){
            $payouts[$con['user_id']]['total_amount'] = $payouts[$con['user_id']]['total_amount'] + $con['amt'];
        }
        else {
            $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard'],'var_status'=>$con['var_status'],'repurchase'=>'No');
        }
     }
    }	
	if(!empty($data['turnover_income'])) {
     foreach($data['turnover_income'] as $con){ 
        if (array_key_exists($con['user_id'],$payouts)){
            $payouts[$con['user_id']]['total_amount'] = $payouts[$con['user_id']]['total_amount'] + $con['amt'];
        }
        else {
            $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard'],'var_status'=>$con['var_status'],'repurchase'=>'No');
        }
     }
    }	   
	if(!empty($data['repurchase_income'])) {
     foreach($data['repurchase_income'] as $con){ 
        if (array_key_exists($con['user_id'],$payouts)){
            $payouts[$con['user_id']]['total_amount'] = $payouts[$con['user_id']]['total_amount'] + $con['amt'];
        }
        else {
            $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard'],'var_status'=>$con['var_status'],'repurchase'=>'No');
        }
     }
    }	   
	if(!empty($data['reward_income'])) {
     foreach($data['reward_income'] as $con){ 
        if (array_key_exists($con['user_id'],$payouts)){
            $payouts[$con['user_id']]['total_amount'] = $payouts[$con['user_id']]['total_amount'] + $con['amt'];
        }
        else {
            $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard'],'var_status'=>$con['var_status'],'repurchase'=>'No');
        }
     }
    }

    	$user_ids = array_column($payouts, 'user_id');  
    	if(!empty($user_ids)) {
    		$customer_data = $this->coupon_model->get_all_customer_idds($user_ids);
    	}
    	

    	if(!empty($customer_data)) {
     foreach($customer_data as $con){ 
        if (array_key_exists($con['id'],$payouts)){
            $payouts[$con['id']]['repurchase'] = 'Yes';
        }
     }
    }

		  $data['error_msg'] = '';
			if ($this->input->server('REQUEST_METHOD') === 'POST') {
			   // $payouts = $this->coupon_model->get_payout_by_date('',$closing_date,'Active');
				$user_ids = $this->input->post('userid');
				if(1==2) { 
					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>You can not close week before Thursday 12 AM.</strong></div>';
				} else {
					$all_users = array();
					$manual_array = array();
					$repuchase_wallet = array();
					foreach($payouts as $con){ 
					    $all_users[] = $con['user_id'];

						if($con['var_status']=='yes') { $tds = (5 / 100) * $con['total_amount'];   } else {
							$tds = (10 / 100) * $con['total_amount'];
						}
						$tds = (5 / 100) * $con['total_amount'];
						$admin = (5 / 100) * $con['total_amount'];
						$net_income = $con['total_amount'] - $tds - $admin;
						$description = $con['user_id'].'~~'.$con['total_amount'].'~~'.$tds;
						if($con['repurchase'] == 'Yes' || 1==1) {
							
						$tr_log[] = array('userid'=>$con['user_id'],'amount'=>$con['total_amount'],'tds'=>$tds,'admin'=>$admin,'net_income'=>$net_income,'type'=>'Weekly closing','description'=>$description,'status'=>'Weekly Closing');
						$manual_array[] = array('user_id'=>$con['customer_id'],'credit_amt'=>(90/100)*$con['total_amount'],'receiver_id'=>$con['customer_id'],'sender_id'=>'admin','receive_date'=>date('Y-m-d'),'TranDescription'=>'Daily-Closing-Income','Cause'=>'Daily Closing Payout Income');
						}
						else {
							$tr_log[] = array('userid'=>$con['user_id'],'amount'=>$con['total_amount'],'tds'=>$tds,'admin'=>$admin,'net_income'=>$net_income,'type'=>'Weekly closing','description'=>$description,'status'=>'Flash');
						}
						
						
						//}
					}
					if(!empty($all_users)) {
					   // $this->coupon_model->update_income_status_all_user('binary_income',$all_users);
					    $this->coupon_model->update_income_status_all_user('binary_level_income',$all_users);
					    $this->coupon_model->update_income_status_all_user('direct_income',$all_users);
					    $this->coupon_model->update_income_status_all_user('turnover_income',$all_users);
					    $this->coupon_model->update_income_status_all_user('repurchase_income',$all_users);
					    $this->coupon_model->update_income_status_all_user('reward_income',$all_users);
					    
					    if(!empty($manual_array)) {
					    	$this->coupon_model->insert_batch('credit_debit',$manual_array);
					    }
	                 //  $this->coupon_model->insert_batch('repurchase_wallet',$repuchase_wallet);	     
						$this->coupon_model->insert_batch('transaction_log',$tr_log);
					}
					$this->coupon_model->update_business_status_all_user('team_bussiness');
					$this->session->set_flashdata('flash_message', 'updated');
					redirect(current_url());
					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Closing Successfully.</strong></div>';
				}
				
			}
		//$payouts = $this->coupon_model->get_payout_by_date('',$week_end,'Active');	
		$data['payouts'] = $payouts;
		
		//load the view
		  $data['main_content'] = 'admin/weekly_closing';
		  $this->load->view('includes/admin/template', $data);   
	  }

	  public function add(){

		  $data['image_error'] = 'false';
		  
		  $cimage = '';
		  if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				//form validation
				$this->form_validation->set_rules('pins', 'No of pins', 'required|trim');
				$this->form_validation->set_rules('pinid', 'Plan Package', 'required|trim');
				$package_data = $this->coupon_model->get_all_package_id($this->input->post('pinid'));
				
				if(empty($package_data) ) {
					$this->form_validation->set_rules('Package', 'Package', 'required');
				}
				
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
				//if the form has passed through the validation
				if ($this->form_validation->run())
				{ 
			
			$no_of_pin=$this->input->post('pins');
			
			$order_id='';
			
			for ($x = 1; $x <= $no_of_pin; $x++) {
				
				$data_to_store = array(
						 'pinid' => random_string('alnum',6).random_string('alnum',4),
						'p_amount' => $package_data[0]['amount'],

						'b_volume' => $package_data[0]['pv'],
						'capping' => $package_data[0]['capping'],
						'percentage' => $package_data[0]['percentage'],
						'franchisee' => $package_data[0]['franchisee'],
						'package' => $package_data[0]['id']
						);
		 $order_id = $this->coupon_model->store_pin($data_to_store);
			} 
			
					if(is_numeric($order_id)){
						
						$this->session->set_flashdata('flash_message', 'updated');
						redirect('admin/pin/add');
					}else{
						$this->session->set_flashdata('flash_message', 'not_updated');
					}
					
					
					
				}//validation run

			}
		   
			$data['package'] = $this->coupon_model->get_all_package('active');
			//if we are updating, and the data did not pass trough the validation
			//the code below wel reload the current data
	 
			//load the view

			$data['main_content'] = 'admin/pin_addnew'; 
			$this->load->view('includes/admin/template', $data); 
		  
	  }
	  
	   public function package_add(){

		  $data['image_error'] = 'false';
		  
		  $cimage = '';
		  if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				//form validation
				$this->form_validation->set_rules('title', 'Title', 'required');
				$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
				$this->form_validation->set_rules('pv', 'PV', 'required|numeric');
				$this->form_validation->set_rules('status', 'status', 'required');
				$this->form_validation->set_rules('franchisee', 'franchisee', 'required');
				$this->form_validation->set_rules('percentage', 'percentage', 'required');
				
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
				//if the form has passed through the validation
				if ($this->form_validation->run())
				{ 
			
			
			
			
				
				$data_to_store = array(
						 'title' => $this->input->post('title'),
						'amount' => $this->input->post('amount'),
						'percentage' => $this->input->post('percentage'),
						'pv' => $this->input->post('pv'),
						'capping' => $this->input->post('capping'),
						'franchisee' => $this->input->post('franchisee'),
						'status' => $this->input->post('status')
						);
		 $order_id = $this->coupon_model->store_package($data_to_store);
			
			
					if(is_numeric($order_id)){
						
						$this->session->set_flashdata('flash_message', 'updated');
						redirect('admin/package/add');
					}else{
						$this->session->set_flashdata('flash_message', 'not_updated');
					}
					
					
					
				}//validation run

			}
		   

			//if we are updating, and the data did not pass trough the validation
			//the code below wel reload the current data
	 
			//load the view

			$data['main_content'] = 'admin/package_addnew'; 
			$this->load->view('includes/admin/template', $data); 
		  
	  }
	  
	  
	   public function package_list() {
		  
				
			
			$data['package'] = $this->coupon_model->get_all_package();
		
		//load the view
		  $data['main_content'] = 'admin/package_list';
		  $this->load->view('includes/admin/template', $data);   
	  }
	   
	  public function add1(){

		  $data['image_error'] = 'false';
		  
		  $cimage = '';
		  if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				//form validation
				$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
				$this->form_validation->set_rules('b_volume', 'business volume', 'required|trim');
				
				$user = $this->coupon_model->get_customer_by_id($this->input->post('assign_to'));
				if(empty($user)) {
				   $this->form_validation->set_rules('start_date', '', 'required'); 
				   $this->form_validation->set_message('required', 'This user is not exist'); 
				}
				
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
				//if the form has passed through the validation
				if ($this->form_validation->run())
				{ 
					$data_to_store = array(
						 'assign_to' => $this->input->post('assign_to'),
						'b_volume' => $this->input->post('b_volume'),
						'pinid' => $this->input->post('pinid'),
						'status' => $this->input->post('status')
						
					); 
					$order_id = $this->coupon_model->store_pin($data_to_store);
					if(is_numeric($order_id)){
						
					/**************** payment distribution *******************/
					
					$bliss_code =  $user[0]['customer_id'];
					$cust_id = $user[0]['id']; 
					$distribution_amount = $this->input->post('b_volume');
					  if($bliss_code != '' && $cust_id != '' && $distribution_amount > 1) { 
					  
						/************ update  his rank ***********/
						if($user[0]['bsacode']=='') {
							$data_update_rank = array('bsacode'=>'BDM','repurchase'=>'yes');
							$this->coupon_model->update_profile($cust_id,$data_update_rank);
						}
						/************ update  parent rank ***********/
						if($user[0]['parent_customer_id']!='') {
							$parent_child_bdm = $this->coupon_model->get_parent_child_bdm($user[0]['parent_customer_id']);
							if(!empty($parent_child_bdm) && count($parent_child_bdm) > 2) {
								$data_update_rank = array('bsacode'=>'Diamond BDM');
								$this->coupon_model->update_profile_by_customer_id($user[0]['parent_customer_id'],$data_update_rank);
							}
							$parent_ids = $this->coupon_model->parent_bliss($cust_id);
						  if(!empty($parent_ids) && $parent_ids[0]['pid']!='') {
							$parent_id = $parent_ids[0]['pid'];
							/*************** direct distribution ************/
							
								$direct_dis_amount = (10 / 100) * $distribution_amount;
								$this->coupon_model->add_distribution_amount($direct_dis_amount,$parent_id,'1',$order_id,$cust_id);
							
							/************ reward ************/
							$left = $right = 0; $left_cid = $right_cid =array();
							if(!empty($parent_child_bdm)) {
								foreach($parent_child_bdm as $bdm) {
									if($bdm['consume']=='0' && $bdm['position']=='power') { $left = $left + 1; $left_cid[] = $bdm['id']; }
									if($bdm['consume']=='0' && $bdm['position']=='other') { $right = $right + 1; $right_cid[] = $bdm['id']; }
								}
							}
							$parent_child_dia_bdm = $this->coupon_model->get_parent_child_diamond_bdm($user[0]['parent_customer_id']);
							if(!empty($parent_child_dia_bdm)) {
								foreach($parent_child_dia_bdm as $diabdm) {
									if($diabdm['consume']=='0' && $diabdm['position']=='power') { $left = $left + 1; $left_cid[] = $diabdm['id']; }
									if($diabdm['consume']=='0' && $diabdm['position']=='other') { $right = $right + 1; $right_cid[] = $diabdm['id']; }
								}
							}
							$level = $parent_ids[0]['level'];
							if($level=='0' && $left > 2 && $right > 1) {
								$this->coupon_model->add_reward($parent_id,$order_id,'3:2','1');
								$consume_id = array();
								for($i=0;$i<3;$i++) { $consume_id[] = $left_cid[$i]; }
								for($i=0;$i<2;$i++) { $consume_id[] = $right_cid[$i]; }
								if(!empty($consume_id)) {
									$this->coupon_model->update_consume_user($consume_id,$parent_id,'1');
								}
							}
							if($level=='1' && $left > 5 && $right > 3) {
								$this->coupon_model->add_reward($parent_id,$order_id,'6:4','2');
								$consume_id = array();
								for($i=0;$i<6;$i++) { $consume_id[] = $left_cid[$i]; }
								for($i=0;$i<4;$i++) { $consume_id[] = $right_cid[$i]; }
								if(!empty($consume_id)) {
									$this->coupon_model->update_consume_user($consume_id,$parent_id,'2');
								}
							} 
							if($level=='2' && $left > 11 && $right > 7) {
								$this->coupon_model->add_reward($parent_id,$order_id,'12:8','3');
								$consume_id = array();
								for($i=0;$i<12;$i++) { $consume_id[] = $left_cid[$i]; }
								for($i=0;$i<8;$i++) { $consume_id[] = $right_cid[$i]; }
								if(!empty($consume_id)) {
									$this->coupon_model->update_consume_user($consume_id,$parent_id,'3');
								}
							}
							if($level=='3' && $left > 23 && $right > 15) {
								$this->coupon_model->add_reward($parent_id,$order_id,'24:16','4');
								$consume_id = array();
								for($i=0;$i<24;$i++) { $consume_id[] = $left_cid[$i]; }
								for($i=0;$i<16;$i++) { $consume_id[] = $right_cid[$i]; }
								if(!empty($consume_id)) {
									$this->coupon_model->update_consume_user($consume_id,$parent_id,'4');
								}
							}
							if($level=='4' && $left > 47 && $right > 31) {
								$this->coupon_model->add_reward($parent_id,$order_id,'48:32','5');
								$consume_id = array();
								for($i=0;$i<48;$i++) { $consume_id[] = $left_cid[$i]; }
								for($i=0;$i<32;$i++) { $consume_id[] = $right_cid[$i]; }
								if(!empty($consume_id)) {
									$this->coupon_model->update_consume_user($consume_id,$parent_id,'5');
								}
							}
							if($level=='5' && $left > 95 && $right > 63) {
								$this->coupon_model->add_reward($parent_id,$order_id,'96:64','6');
								$consume_id = array();
								for($i=0;$i<96;$i++) { $consume_id[] = $left_cid[$i]; }
								for($i=0;$i<64;$i++) { $consume_id[] = $right_cid[$i]; }
								if(!empty($consume_id)) {
									$this->coupon_model->update_consume_user($consume_id,$parent_id,'6');
								}
							}
							if($level=='6' && $left > 191 && $right > 127) {
								$this->coupon_model->add_reward($parent_id,$order_id,'192:128','7');
								$consume_id = array();
								for($i=0;$i<192;$i++) { $consume_id[] = $left_cid[$i]; }
								for($i=0;$i<128;$i++) { $consume_id[] = $right_cid[$i]; }
								if(!empty($consume_id)) {
									$this->coupon_model->update_consume_user($consume_id,$parent_id,'7');
								}
							}
							/********* reward end *************/
						  }
						}
						
						$all_diamond_bdm = $this->coupon_model->get_all_diamond_bdm();
						$distribute_level = 0; 
						if(!empty($all_diamond_bdm) && count($all_diamond_bdm) > 0) {
						   $dis_amount = (40 / 100) * $distribution_amount;
						   $final_dis_amount = $dis_amount / count($all_diamond_bdm);
						   $final_dis_amount = round($final_dis_amount,2);
						   
						   foreach($all_diamond_bdm as $uid) {
							$this->coupon_model->add_distribution_amount($final_dis_amount,$uid['id'],'0',$order_id,$cust_id); 
						   }
						}
					  }
				  /**************** end payment distribution *******************/
				  
						$this->session->set_flashdata('flash_message', 'updated');
						redirect('admin/pin/add');
					}else{
						$this->session->set_flashdata('flash_message', 'not_updated');
					}
					
					

				}//validation run

			}
		   

			//if we are updating, and the data did not pass trough the validation
			//the code below wel reload the current data
	 
			//load the view

			$data['main_content'] = 'admin/pin_addnew'; 
			$this->load->view('includes/admin/template', $data); 
		  
	  }
	  
	  public function update(){
			 $data['success_msg'] = '';
			/*if save button was clicked, get the data sent via post*/
			if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				/*form validation*/
				$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
				$this->form_validation->set_rules('pins', 'No. of E-Pin', 'required|trim|numeric');
				
				
				
				 $user = $this->coupon_model->get_customer_by_id($this->input->post('assign_to'));
				if(empty($user)) {
				   $this->form_validation->set_rules('start_date', '', 'required'); 
				   $this->form_validation->set_message('required', 'This user is not exist'); 
				} 
				
				//$pinid = $this->input->post('pinid');
				$pinidss = explode("~",$this->input->post('pinid'));
				$pinid = $pinidss[0];
				$pinid_type = $pinidss[1];
				//echo $pinid.' '.$pinid_type.' ';
				$number_of_pins = $this->input->post('pins');
				$countpin = $this->coupon_model->count_available_pins($pinid,$number_of_pins,$pinid_type);
				
				//print_r($countpin);
				if(count($countpin)<$number_of_pins) {
				   $this->form_validation->set_rules('epins', '', 'required'); 
				   $this->form_validation->set_message('required', 'Pins not available'); 
				}
				
				//print_r($countpin);
				//$this->form_validation->set_rules('epins', '', 'required'); 
				//$this->form_validation->set_message('required', 'Pins not available'); 
				   
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
				//if the form has passed through the validation
				if ($this->form_validation->run())
				{ 
			
			$consume = $user[0]['consume'];
		/* 	if($pinid >='15000'){
				$rank = '';
				if($pinid=='30000' || $pinid=='15000'){
					$package='Area Franchise'; $consume = '1'; 
					if($user[0]['bsacode']=='') { $rank = '2 Star'; }
				}
				elseif($pinid=='100000'){
					$package='Distt. Franchise'; $consume = '2'; 
					if($user[0]['bsacode']=='' || $user[0]['bsacode']=='2 Star') { $rank = '3 Star'; }
					$date = date('Y-m-d H:i:s');
					$day = date('d');
					if($day >= 15) { $pay_date = date('Y-m-08 H:i:s',strtotime("+ 2 month",strtotime(date('Y-m-d')))); }
					else { $pay_date = date('Y-m-08 H:i:s',strtotime("+ 1 month",strtotime(date('Y-m-d')))); }
					$add_salary = array('user_id'=>$user[0]['id'],'amount'=>'20000','tmonth'=>'12','description'=>$date,'pay_date'=>$pay_date,'status'=>'Active');
					$this->coupon_model->add_salary($add_salary);
				}
				
				else { $consume = '0'; }
				
				$data_to_store = array(
						'user_id' => $this->input->post('assign_to'),
						'amount' => $pinid,
						'package' => $package,
						'status' => 'Active',
						);
				 $return = $this->coupon_model->add_franchise_pin($data_to_store);
				$data_to_stores = array();
				if($user[0]['consume'] < $consume) { $data_to_stores['consume'] = $consume; }
				if($rank!='') { $data_to_stores['bsacode'] = $rank; }
				if(!empty($data_to_stores)) {
				 $this->coupon_model->update_profile_by_customer_id($user[0]['customer_id'], $data_to_stores);
				}			
			} */
			
			
			if(!empty($countpin)){ 
		  foreach ($countpin as $value) {
				 
				 $data_to_store = array(
						'assign_to' => $user[0]['customer_id'],
						'status' => 'Active',
						);
				
				 /************* Franchise Referral ****************/
				/* if($pinid >='20000' && $user[0]['did']!='' && $value['franchisee'] == '1'){
					 if($user[0]['consume'] > 0){
					if($user[0]['consume'] == 1){ $data_to_store['area_franc'] = $user[0]['id']; } 
					elseif($user[0]['consume'] == 2){ $data_to_store['dist_franc'] = $user[0]['id']; } 
					elseif($user[0]['consume'] == 3){ $data_to_store['state_franc'] = $user[0]['id']; }  
				}
					 $data_to_store['status'] = 'Used';
					 $data_to_store['used_by'] = $user[0]['customer_id'];
					 $data_to_store['used_on'] = date('Y-m-d');
					 $income = (5 / 100) * $value['p_amount'];
					 $income = round($income,2);
					 $pindesc = $pinid.'---'.$value['p_amount'].'--- ---'.$user[0]['f_name'].' '.$user[0]['l_name'].'---'.$user[0]['customer_id'];
					 $add_income = array('user_id'=>$user[0]['did'],'amount'=>$income,'type'=>'Franchies Referral','description'=>$pindesc,'status'=>'Active');
					 $this->coupon_model->add_income($add_income);
				 }*/
				 $return = $this->coupon_model->update_pin($value['id'], $data_to_store);
				 $add_transfer_pin = array('pinid'=>$value['id'],'assign_from'=>'moneycash','assign_to'=>$user[0]['customer_id']);
				 $this->coupon_model->add_transfer_pin($add_transfer_pin);
				 
				 //$this->coupon_model->update_profile($user[0]['id'],array('franchise'=>$value['b_volume']));
				 
				}
			}

				 if($return == TRUE){
					 
					  $success_msg = $number_of_pins.' Pin successfully transfer to '.$user[0]['f_name'].' '.$user[0]['l_name'].' ('.$user[0]['customer_id'].') Rs. '.$pinid;
						$this->session->set_flashdata('success_msg', $success_msg);
						$this->session->set_flashdata('flash_message', 'updated');
						redirect('admin/pin/edit');
					}else{
						$this->session->set_flashdata('flash_message', 'not_updated');
					}
					

				}/*validation run*/

			}
		   

			//if we are updating, and the data did not pass trough the validation
			//the code below wel reload the current data
			$data['package'] = $this->coupon_model->get_all_package('active');
		   
			//$data['pin'] = $this->coupon_model->get_all_pin_id($); 
			//load the view
			$data['main_content'] = 'admin/pin_update'; 
			$this->load->view('includes/admin/template', $data); 
	  }
	  
	  public function package_update(){

	  	

	 

	  //category id 

        $id = $this->uri->segment(4);

  

        /*if save button was clicked, get the data sent via post*/

        if ($this->input->server('REQUEST_METHOD') === 'POST')

        {

            /*form validation*/

              $this->form_validation->set_rules('title', 'title', 'required');

			$this->form_validation->set_rules('amount', 'amount', 'required|numeric');
			$this->form_validation->set_rules('pv', 'pv', 'required|numeric');
			$this->form_validation->set_rules('status', 'status', 'required');
			$this->form_validation->set_rules('percentage', 'percentage', 'required');

			

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation

            if ($this->form_validation->run())

            { 
			
		 

			        //----- end file upload -----------

                $data_to_store = array(

                    'title' => $this->input->post('title'),

					'amount' => $this->input->post('amount'), 
						'percentage' => $this->input->post('percentage'), 

					'pv' => $this->input->post('pv'), 
					'capping' => $this->input->post('capping'), 

					'status' => $this->input->post('status')

					); 

             $return = $this->coupon_model->update_package($id, $data_to_store);



             if($return == TRUE){

                    $this->session->set_flashdata('flash_message', 'updated');

					redirect('admin/package/edit/'.$id.'');

                }else{

                    $this->session->set_flashdata('flash_message', 'not_updated');

                }

                



            }/*validation run*/



        }

       



        //if we are updating, and the data did not pass trough the validation

        //the code below wel reload the current data



       

        $data['package'] = $this->coupon_model->get_all_package_id($id); 

        //load the view

        $data['main_content'] = 'admin/package_update'; 

        $this->load->view('includes/admin/template', $data); 

  }

	public function tds_report() {
	   $sdate = $edate = '';
		 if ($this->input->server('REQUEST_METHOD') === 'POST') {
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
        } else {
            $sdate = date('Y-m-01 00:00:01');
		    $edate = date('Y-m-t 23:59:59'); 
        }
		 //$this->load->model('Users_model');
	//	$data['cashback'] = $this->coupon_model->cashback();
	$data['payouts'] = $this->coupon_model->get_payout_by_date_tds($sdate, $edate); 
	
	//load the view
      $data['main_content'] = 'admin/tds_report';
      $this->load->view('includes/admin/template', $data);   
  }	
  
  public function admin_report() {
	   $sdate = $edate = '';
		 if ($this->input->server('REQUEST_METHOD') === 'POST') {
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
        } else {
            $sdate = date('Y-m-01 00:00:01');
		    $edate = date('Y-m-t 23:59:59'); 
        }
		 //$this->load->model('Users_model');
	//	$data['cashback'] = $this->coupon_model->cashback();
	$data['payouts'] = $this->coupon_model->get_payout_by_date_admin($sdate, $edate); 
	
	//load the view
      $data['main_content'] = 'admin/admin_report';
      $this->load->view('includes/admin/template', $data);   
  }	
  
     public function generatecsv(){
      //https://www.adwinhouse.com/main-admin/index.php/vc_site_admin/pin/generatecsv
     
	 
	
	 $filename = 'users_'.date('YmdHis').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   
   // file creation 
   $file = fopen('php://output', 'w');
 
   $header = array("S. No.User","Name","Customer ID","Amount","Bank","Branch","Bank A/c No","IFSC","PAN No.","Date"); 
   fputcsv($file, $header);
   	 $payouts = $this->coupon_model->get_all_payout('Bank Process');
   	if(!empty($payouts)) {
		$i = 1;
       foreach ($payouts as $key=>$line){ 
	   $tax = ($line['amount']*10)/100;
	$tdss = $tax/2;
	   $payble = $line['amount'] - $tax;
	     $csv_val = array($i,$line['f_name'].' '.$line['l_name'].'',$line['customer_id'],$payble,$line['bank_name'],$line['branch'],' \' '.$line['account_no'],$line['ifsc'],$line['pancard'],date('d F Y',strtotime($line['rdate'])));
         fputcsv($file,$csv_val); 
		 $i++;
       }
       fclose($file); 
       exit; 
   	}
	
  }
  	
	  public function generatecsv_payout(){
      //https://www.adwinhouse.com/main-admin/index.php/vc_site_admin/pin/generatecsv
     
	 
	
	 $filename = 'users_'.date('YmdHis').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   
   // file creation 
   $file = fopen('php://output', 'w');
 
   $header = array("S. No.User","Name","Customer ID","Amount","Bank","Branch","Bank A/c No","IFSC","PAN No.","Date"); 
   fputcsv($file, $header);
   	 $payouts = $this->coupon_model->get_all_payout('Weekly Closing');
   	if(!empty($payouts)) {
		$i = 1;
       foreach ($payouts as $key=>$line){ 
	   $tax = ($line['amount']*10)/100;
	$tdss = $tax/2;
	   $payble = $line['amount'] - $tax;
	     $csv_val = array($i,$line['f_name'].' '.$line['l_name'].'',$line['customer_id'],$payble,$line['bank_name'],$line['branch'],' \' '.$line['account_no'],$line['ifsc'],$line['pancard'],date('d F Y',strtotime($line['rdate'])));
         fputcsv($file,$csv_val); 
		 $i++;
       }
       fclose($file); 
       exit; 
   	}
	
  }
  
  
  
   public function generatecsv_tds(){
      //https://www.adwinhouse.com/main-admin/index.php/vc_site_admin/pin/generatecsv
       if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('sdate')!='' && $this->input->post('edate')!='') {
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
        } else {
            $sdate = date('Y-m-01 00:00:01');
		    $edate = date('Y-m-t 23:59:59'); 
        }
	 
	
	 $filename = 'users_'.date('YmdHis').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   
   // file creation 
   $file = fopen('php://output', 'w');
 
   $header = array("S. No.User","Name","Customer ID","Amount","Tds(%)","Tds","PAN No.","Date"); 
   fputcsv($file, $header);
   	$payouts = $this->coupon_model->get_payout_by_date_tds($sdate, $edate);
   	if(!empty($payouts)) {
		$i = 1;
       foreach ($payouts as $key=>$line){ 
	   $tax = ($line['amount']*10)/100;
	$tdss = $tax;
	   $payble = $line['amount'] - $tax;
	     $csv_val = array($i,$line['f_name'].' '.$line['l_name'].'',$line['customer_id'],$line['amount'],'10 %',round($tdss,2),$line['pancard'],date('d F Y',strtotime($line['rdate'])));
         fputcsv($file,$csv_val); 
		 $i++;
       }
       fclose($file); 
       exit; 
   	}
	
  }
  	 
    
	  public function generatecsv_admin(){
      //https://www.adwinhouse.com/main-admin/index.php/vc_site_admin/pin/generatecsv
       if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('sdate')!='' && $this->input->post('edate')!='') {
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
        } else {
            $sdate = date('Y-m-01 00:00:01');
		    $edate = date('Y-m-t 23:59:59'); 
        }
	 
	
	 $filename = 'users_'.date('YmdHis').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   
   // file creation 
   $file = fopen('php://output', 'w');
 
   $header = array("S. No.User","Name","Customer ID","Amount","Admin(%)","Admin","PAN No.","Date"); 
   fputcsv($file, $header);
   	$payouts = $this->coupon_model->get_payout_by_date_tds($sdate, $edate);
   	if(!empty($payouts)) {
		$i = 1;
       foreach ($payouts as $key=>$line){ 
	   $tax = ($line['amount']*10)/100;
	$tdss = $tax/2;
	   $payble = $line['amount'] - $tax;
	     $csv_val = array($i,$line['f_name'].' '.$line['l_name'].'',$line['customer_id'],$line['amount'],'10% ',round($tdss,2),$line['pancard'],date('d F Y',strtotime($line['rdate'])));
         fputcsv($file,$csv_val); 
		 $i++;
       }
       fclose($file); 
       exit; 
   	}
	
  }
  	 
    
	
	  public function del(){
	  
	  $id = $this->uri->segment(4); 
			 $return = $this->coupon_model->delete_pin($id); 
			  $this->session->set_flashdata('delete', 'true'); 
		  redirect(base_url().'admin/pin');
	 }  
	 
	 	  public function package_del(){
	  
	  $id = $this->uri->segment(4); 
			 $return = $this->coupon_model->delete_package($id); 
			  $this->session->set_flashdata('delete', 'true'); 
		  redirect(base_url().'admin/package');
	 }  
	}