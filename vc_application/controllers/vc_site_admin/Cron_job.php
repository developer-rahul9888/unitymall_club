<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron_job extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Cron_model');
       
    }

    public function index() {
        
        $income = array();
        $date = date('Y-m-d');
        $currentdate = date('Y-m-d');
        $past_roi = $this->Cron_model->get_salary_user_last($date);
        
        if(!empty($past_roi)) {
            $date = date('Y-m-d',strtotime($past_roi[0]['pay_date']));
        }

        $allsalary = $this->Cron_model->get_salary($date);
        
        if(!empty($allsalary)) {

        foreach($allsalary as $salary) {

        if($salary['user_id']!='' && $salary['amount']!='' && $salary['roi_count'] > 0) {

            if($salary['type'] == 'D') {
                $nexttdate = date('Y-m-d H:i:s',strtotime("+ 1 day",strtotime($date)));
            }
            if($salary['type'] == 'W') {
                $nexttdate = date('Y-m-d H:i:s',strtotime("+ 7 day",strtotime($date)));
            }
            if($salary['type'] == 'M') {
                $nexttdate = date('Y-m-d H:i:s',strtotime("+ 1 Month",strtotime($date)));
            }

            $roi_count = $salary['roi_count'] - 1;
            $no_salary = '';
            $get_amt = $salary['paid_amount'] + $salary['amount'];
            $pay_days = $salary['pay_days'] + 1; 
            
            $daily_roi = $salary['amount'];
            $description = $salary['description'].'~-~'.$currentdate;
            $update_salary = array('roi_count'=>$roi_count,'paid_amount'=>$salary['paid_amount']+$daily_roi,'description'=>$description,'pay_date'=>$nexttdate,'pay_days'=>$pay_days);
            $this->Cron_model->update_salary_by_id($salary['id'],$update_salary);

            if($daily_roi > 0) {

                $add_income = array('amount'=>$daily_roi,'user_id'=>$salary['user_id'],'type'=>'Cashback','user_send_by'=>$salary['user_id'],'description'=>$salary['order_id'],'status'=>'Active','c_date'=> $date);
                $this->Cron_model->add_income($add_income);

                $this->Cron_model->substract_wallet($salary['user_id'],$daily_roi,'bliss_amount');
                }
            }
        }
    }
   }
}
?>