<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron_job extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
         $this->load->model('coupon_model');

       //if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
       
    }
	
  public function index() {
	 
    $date = date('Y-m-',strtotime("-1 month",strtotime(date('Y-m-d'))));
    $date = date('Y-m-');
	$currentdate = date('Y-m-d H:i:s');
	$comparedate = date('Y-m');
	 $salary_day = date('d');
	if($salary_day == '08') {
    	$allsalary = $this->coupon_model->get_salary($date);
    	//print_r($allsalary);
    	if(!empty($allsalary)) {
    		foreach($allsalary as $salary) {
    			
    			if($salary['user_id']!='' && $salary['amount']!='' && $salary['tmonth'] > 0) {
    				
                    if(strstr($salary['package_used'],$comparedate)){ 
                        $description = $salary['description'].'~-~'.$currentdate;
                        $month = $salary['tmonth'] - 1;
                    } else {
                        $description = $salary['description'].'~-~no~'.$currentdate;
                        $month = $salary['tmonth'];
                    }
    				$next_date = date('Y-m-d H:i:s',strtotime("+1 month",strtotime(date('Y-m-d'))));
    				$update_salary = array('tmonth'=>$month,'description'=>$description,'pay_date'=>$next_date); 
    				$this->coupon_model->update_salary($salary['id'],$update_salary);
    				if(strstr($salary['package_used'],$comparedate)){
    				    $add_income = array('amount'=>$salary['amount'],'user_id'=>$salary['user_id'],'type'=>'Recognise Income','status'=>'Active');
    				    $this->coupon_model->add_income($add_income);
    				}
    			}
    		}
    	}
    }
  }
  public function weekly_closing(){
	  
	  $data['insentive'] = $this->coupon_model->get_payout_by_date_table('binary_income');
	$data['cashback'] = $this->coupon_model->get_payout_by_date_table('binary_level_income');
	$data['rahul'] = $this->coupon_model->get_payout_by_date_table('direct_income');
	$data['turnover_income'] = $this->coupon_model->get_payout_by_date_table('turnover_income');
	//print_r($data['insentive']);   
		   
		   $payouts = array();
    if(!empty($data['cashback'])) {
     foreach($data['cashback'] as $con){
        $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>'0','amt'=>$con['amt'],'account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard']);
     }
    }

    if(!empty($data['insentive'])) {
     foreach($data['insentive'] as $con){ 
        if (array_key_exists($con['user_id'],$payouts)){
            $payouts[$con['user_id']]['total_amount'] = $payouts[$con['user_id']]['total_amount'] + $con['amt'];
        }
        else {
            $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard']);
        }
     }
    }
	if(!empty($data['rahul'])) {
     foreach($data['rahul'] as $con){ 
        if (array_key_exists($con['user_id'],$payouts)){
            $payouts[$con['user_id']]['total_amount'] = $payouts[$con['user_id']]['total_amount'] + $con['amt'];
        }
        else {
            $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard']);
        }
     }
    }	
	if(!empty($data['turnover_income'])) {
     foreach($data['turnover_income'] as $con){ 
        if (array_key_exists($con['user_id'],$payouts)){
            $payouts[$con['user_id']]['total_amount'] = $payouts[$con['user_id']]['total_amount'] + $con['amt'];
        }
        else {
            $payouts[$con['user_id']] = array('user_id'=>$con['user_id'],'customer_id'=>$con['customer_id'],'f_name'=>$con['f_name'],'l_name'=>$con['l_name'],'total_amount'=>$con['amt'],'amt'=>'0','account_no'=>$con['account_no'],'bank_name'=>$con['bank_name'],'ifsc'=>$con['ifsc'],'pancard'=>$con['pancard']);
        }
     }
    }	   
	  
	  echo 'rahul';
      $all_users = array();
					foreach($payouts as $con){ 
		
					    $all_users[] = $con['user_id'];
						$tds = (5 / 100) * $con['total_amount'];
						$payable = $con['total_amount'] - 4*$tds;
						$payable = round($payable,2);
						
						$description = $con['user_id'].'~~'.$con['total_amount'].'~~'.$tds;
						$tr_log = array('userid'=>$con['user_id'],'amount'=>$con['total_amount'],'type'=>'Weekly closing','description'=>$description,'status'=>'Clear');
						$this->coupon_model->add_transactional_log($tr_log);
						$this->coupon_model->load_wallet($con['user_id'],(9/10)*$con['total_amount'],$con['total_amount']/10);
					}
					if(!empty($all_users)) {
					    $this->coupon_model->update_income_status_all_user('binary_income',$all_users);
					    $this->coupon_model->update_income_status_all_user('binary_level_income',$all_users);
					    $this->coupon_model->update_income_status_all_user('direct_income',$all_users);
					    $this->coupon_model->update_income_status_all_user('turnover_income',$all_users);
					}
  }
}
?>