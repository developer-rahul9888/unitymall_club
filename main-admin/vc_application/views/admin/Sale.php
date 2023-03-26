<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sale extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('string');	
        $this->load->model('sale_model');	 	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	 
	$data['sale'] = $this->sale_model->get_all_sale();
	
	//load the view
      $data['main_content'] = 'admin/sale_list';
      $this->load->view('includes/admin/template', $data);   
  } 
  
  public function invoice() {
      $id = $this->uri->segment(4);
      $data['customer_info'] = '';
    	$data['invoice'] = $this->sale_model->get_all_sale_id($id); 
	if(!empty($data['invoice'])) {
            $data['customer_info'] = $this->sale_model->get_customer_info($data['invoice'][0]['customer']); 
            if($data['customer_info'][0]['parent_customer_id']!='') { $data['sponser_name'] = $this->sale_model->get_customer_info($data['customer_info'][0]['parent_customer_id']);  }
          }
	//load the view
      $data['main_content'] = 'admin/sale_invoice';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
    public function pininsale() {
    	 
	$data['sale'] = $this->sale_model->get_all_pin_sale();
	
	//load the view
      $data['main_content'] = 'admin/pin_sale_list';
      $this->load->view('includes/admin/template', $data);   
  }
   public function gst_report() {
    	
		
		 $sdate = $edate = '';
		 if ($this->input->server('REQUEST_METHOD') === 'POST') {
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
        } else {
            $sdate = date('Y-m-01 00:00:01');
		    $edate = date('Y-m-t 23:59:59'); 
        }
		
	$data['sale'] = $this->sale_model->get_all_total_sale($sdate,$edate);
	
	//load the view
      $data['main_content'] = 'admin/gst_report';
      $this->load->view('includes/admin/template', $data);   
  }
  
    public function generatecsv(){
     
	  $sdate = $edate = '';
		 if ($this->input->post('sdate') != '' && $this->input->post('edate') != '') {
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
 
   $header = array("S. No.User","Name","Customer ID","Amount","GST","Bank","Branch","Bank A/c No","IFSC","PAN No.","Date"); 
   fputcsv($file, $header);
   	 $payouts = $this->sale_model->get_all_total_sale($sdate,$edate);
	
   	if(!empty($payouts)) {
		$i = 1;
       foreach ($payouts as $key=>$line){ 
	   
	     $csv_val = array($i,$line['f_name'].' '.$line['l_name'].'',$line['customer_id'],$line['before_tax_amount'],$line['total_gst'],$line['bank_name'],$line['branch'],' \' '.$line['account_no'],$line['ifsc'],$line['pancard'],date('d F Y',strtotime($line['tdate'])));
         fputcsv($file,$csv_val); 
		 $i++;
       }
       fclose($file); 
       exit; 
   	}
	
  }
  	
  
    public function pininvoice() {
      $id = $this->uri->segment(3);
      $data['customer_info'] = '';
    	$data['invoice'] = $this->sale_model->get_all_sale_id($id); 
	if(!empty($data['invoice'])) {
            $data['customer_info'] = $this->sale_model->get_customer_info($data['invoice'][0]['customer']); 
            if($data['customer_info'][0]['parent_customer_id']!='') { $data['sponser_name'] = $this->sale_model->get_customer_info($data['customer_info'][0]['parent_customer_id']);  }
          }
	//load the view
      $data['main_content'] = 'admin/pin_invoice';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  public function daily_weekly_income(){
	  $data['daily_weakly_in'] = array();
	if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		$edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
	//	$data['daily_weakly_in'] = $this->sale_model->all_daily_weakly_in($sdate, $edate);
    } else {
	  $sdate = date('Y-m-d 00:00:01');
	  $edate = date('Y-m-d 23:59:59');
     // $data['daily_weakly_in'] = $this->sale_model->all_daily_weakly_in($sdate ,$edate);			 
	}
	
			$binary_income = $this->sale_model->daily_weakly_in_by_table('binary_income',$sdate, $edate); 
			$binary_level_income = $this->sale_model->daily_weakly_in_by_table('binary_level_income',$sdate, $edate); 
			$direct_income = $this->sale_model->daily_weakly_in_by_table('direct_income',$sdate, $edate); 
			$repurchase_income = $this->sale_model->daily_weakly_in_by_table('repurchase_income',$sdate, $edate); 
			$turnover_income = $this->sale_model->daily_weakly_in_by_table('turnover_income',$sdate, $edate);

	
			
			 $data['daily_weakly_in'] = array_merge($binary_income,$binary_level_income,$direct_income,$repurchase_income,$turnover_income);
		//	echo '<pre>'; print_r($data['daily_weakly_in']); echo '</pre>';
		
	//load the view
    $data['main_content'] = 'admin/daily_weekly_income';
    $this->load->view('includes/admin/template', $data); 
  }
  
  public function daily_sale_report(){
	  $pin = '';
	if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $sdate = date('Y-m-d',strtotime($this->input->post('sdate')));
		$edate = date('Y-m-d',strtotime($this->input->post('edate'))); 
		$pin = $this->input->post('pin'); 
		$data['daily_weakly_pin'] = $this->sale_model->daily_weakly_pin($sdate, $edate,$pin);
    } else {
	  $sdate = date('Y-m-d');
	  $edate = date('Y-m-d');
      $data['daily_weakly_pin'] = $this->sale_model->daily_weakly_pin($sdate ,$edate,$pin);			 
	}
	//load the view
    $data['main_content'] = 'admin/daily_sale_report';
    $this->load->view('includes/admin/template', $data); 
  }
  
  public function cut_off_report(){
	  
	if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		$edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
		$data['cut_off_report'] = $this->sale_model->cut_off_report($sdate, $edate);
    } else {
	  $sdate = date('Y-m-d 00:00:01');
	  $edate = date('Y-m-d 23:59:59');
      $data['cut_off_report'] = $this->sale_model->cut_off_report($sdate ,$edate);			 
	}
	//load the view
    $data['main_content'] = 'admin/cut_off_report';
    $this->load->view('includes/admin/template', $data); 
  }
  
  public function add_pv_income_00($cid,$user_level,$reward,$position,$distribution_amount,$cust_id,$order_id,$repurchase,$customer_id,$package,$lbv,$rbv,$sbv) { 
		if($cid=='0' || $cid == '' || $user_level=='0' || $lbv < 1000 || $rbv < 1000) { return ''; }
		if($repurchase=='yes') { $sale_type = '2';  $caping = 800000;} 
		else { $sale_type = '1'; $caping = 800000; }
		
		$left = $right =  $matching = 0;
		
			$total_final_pv = 0;
			$date = date('Y-m-d');
			$this_week_sd = date('Y-m-d 00:00:01',strtotime("first day of this month"));
			$this_week_ed = date('Y-m-d 00:00:01',strtotime("last day of this month"));
			$redeem_pv = $this->sale_model->get_matching_pv_by_date($cid,$date,$sale_type);
			if(!empty($redeem_pv)) {
				$matching = $redeem_pv[0]['redeem_pv'];
			}
			if($matching=='') { $matching = 0; }
		
			$update_ids = array();
			$add_income = 'true';
			if($lbv >= $rbv - $distribution_amount && $position == 'right') { } elseif($lbv - $distribution_amount <= $rbv && $position == 'left') { } 
			else { $add_income = 'false'; }
			$first_cut = 'no';
			if($position == 'left') { 
				if($lbv - $distribution_amount < 1000) { $lbv = $lbv - 1000; $first_cut = 'yes';  }
				else { if($lbv >= $rbv ) { $matching_bv = $distribution_amount - ($lbv - $rbv); }
				else { $matching_bv = $distribution_amount; }
				}

			} else {
				if($rbv - $distribution_amount < 1000) { $rbv = $rbv - 1000;$first_cut = 'yes'; }
				else { if($rbv >= $lbv ) { $matching_bv = $distribution_amount - ($rbv - $lbv); } else {
					$matching_bv = $distribution_amount;
				} }
			}
			
			if($add_income == 'true') {
				if($first_cut == 'yes') {
					if($lbv > $rbv) { $matching_bv = $rbv;  }
					else { $matching_bv = $lbv; }
				}
				
				/************  add matching ********/			
				if($lbv < 5000 && $rbv < 5000) {  $income_pv = (12/100)*$matching_bv; }			
				elseif($lbv < 10000 && $rbv < 10000) {  $income_pv = (14/100)*$matching_bv; }		
				elseif($lbv < 25000 && $rbv < 25000) {  	
				if($sbv>= 300) { $income_pv = (16/100)*$matching_bv; }		
				else { $income_pv = (14/100)*$matching_bv; }			
				}			
				elseif($lbv < 50000 && $rbv < 50000) {  $income_pv = (17/100)*$matching_bv; }	
				elseif($lbv < 70000 && $rbv < 70000) {  $income_pv = (18/100)*$matching_bv; }	
				elseif($lbv < 100000 && $rbv < 100000) {  		
				if($sbv>= 500) { $income_pv = (19/100)*$matching_bv; }		
				else { $income_pv = (18/100)*$matching_bv; } 		
				}			
				elseif($lbv >= 100000 && $rbv >= 100000) {  	
				if($sbv>= 1000) {$income_pv = (21/100)*$matching_bv; }			
				elseif($sbv>= 500) { $income_pv = (19/100)*$matching_bv; }		
				else { $income_pv = (18/100)*$matching_bv; }		
				}		
				else { $income_pv = (21/100)*$matching_bv; }
				$income_pv = round($income_pv,2);
				$matching_type = 'Matching';
				$add_matching_pv = 'true';
				if($matching >= $caping) { $matching_type = 'Capping'; }
				else {
					$total_income_pv_dm = $matching + $income_pv;
					if($total_income_pv_dm <= $caping) { $final_income_dm = $income_pv; }
					else { 
						$add_matching_pv = 'false';
						/************** cping PV *******************/
						$final_income_pv_dm = $total_income_pv_dm - $caping; 
						$this->add_pv[] = array('order_id'=>$order_id,'amount'=>$final_income_pv_dm,'user_id'=>$cid,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'pay_level'=>'0','type'=>'Capping','status'=>'Active');
					
						/**************** matching pv ****************/
						$final_income_pv_dm = $caping - $matching; 
						$this->add_pv[] = array('order_id'=>$order_id,'amount'=>$final_income_pv_dm,'user_id'=>$cid,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'pay_level'=>'0','type'=>'Matching','status'=>'Active');
					
						
					}  
				}
				if($income_pv > 0 && $add_matching_pv == 'true') {
				  $this->add_pv[] = array('order_id'=>$order_id,'amount'=>$income_pv,'user_id'=>$cid,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'pay_level'=>'0','type'=>$matching_type,'status'=>'Active');
				  
				 
				}
				
				$income = $income_pv;
				$type = 'Repurchase'; 
				/***************** add income ***********/
				$final_income = 0;
				if($income > 0 && $matching < $caping) {
					$total_income_pv = $matching + $income;
					if($total_income_pv <= $caping) { $final_income = $income; }
					else { 
						$final_income = $caping - $matching; 
					}
					$this->income[] = array('amount'=>$final_income,'user_id'=>$cid,'matching'=>$matching_bv,'type'=>$type,'status'=>'Active');
				}

				/****************** update pv status to redeem **************/
				  
					 if($lbv >= 50000 && $lbv >= 50000 && $reward == '' ) { 
					$package = array('rank'=>'Star');
					$this->sale_model->update_profile($cid,$package);
					}
					
					if($lbv >= 100000 && $lbv >= 100000 && $reward == 'Star'  ) {  
					$package = array('rank'=>'Silver Star');
					$this->sale_model->update_profile($cid,$package);
					}
					
					if($lbv >= 175000 && $lbv >= 1750000 && $reward == 'Silver Star' ) {
                    $package = array('rank'=>'Gold Star');
					$this->sale_model->update_profile($cid,$package);
					}
			}
		
	}
	
  
  public function add_pv_income_o($cid,$user_level,$reward,$position,$distribution_amount,$cust_id,$order_id,$repurchase,$customer_id,$package,$lbv,$rbv,$sbv) { 
		if($cid=='0' || $cid == '' || $user_level=='0' || $lbv < 1000 || $rbv < 1000) { return ''; }
		if($repurchase=='yes') { $sale_type = '2';  $caping = 800000;} 
		else { $sale_type = '1'; $caping = 800000; }
		
		$left = $right =  $matching = 0;
		
			$total_final_pv = 0;
			$date = date('Y-m-d');
			$this_week_sd = date('Y-m-d 00:00:01',strtotime("first day of this month"));
			$this_week_ed = date('Y-m-d 00:00:01',strtotime("last day of this month"));
			$redeem_pv = $this->sale_model->get_matching_pv_by_date($cid,$date,$sale_type);
			if(!empty($redeem_pv)) {
				$matching = $redeem_pv[0]['redeem_pv'];
			}
			if($matching=='') { $matching = 0; }
		
			$update_ids = array();
			$add_income = 'true';
			$decrease_bv = 0;
			$carry_bv = 0;
			$ff = 0;
			if($lbv >= $rbv && $position == 'right') { } elseif($lbv <= $rbv && $position == 'left') { } 
			elseif($lbv < $rbv && $position == 'right') { 
				$decrease_bv = $rbv - $lbv; 
				$dus_amt = $rbv - $distribution_amount;
				if($dus_amt <= $lbv) { $add_income = 'false'; }
			}
			elseif($lbv > $rbv && $position == 'left') { 
				$decrease_bv = $lbv - $rbv;
				$dus_amt = $lbv - $distribution_amount;
				if($dus_amt <= $rbv) { $add_income = 'false'; }
			}
			else { $add_income = 'false'; }
			
			if($position == 'left') { 
				if($lbv - $distribution_amount < 1000) { $carry_bv = $lbv - 1000; $ff = 1000 - $carry_bv; }

			} else {
				if($rbv - $distribution_amount < 1000) { $carry_bv = $rbv - 1000; $ff = 1000 - $carry_bv; }
			}
			
			$matching_bv = $distribution_amount - $decrease_bv - $ff;
		echo $distribution_amount; echo '<br>';echo $decrease_bv; echo '<br>'; echo $ff; echo '<br>'; echo $cid; 
			if($add_income == 'true') {
				
				/************  add matching ********/			
				if($lbv < 5000 && $rbv < 5000) {  $income_pv = (12/100)*$matching_bv; }			
				elseif($lbv < 10000 && $rbv < 10000) {  $income_pv = (14/100)*$matching_bv; }		
				elseif($lbv < 25000 && $rbv < 25000) {  	
				if($sbv>= 300) { $income_pv = (16/100)*$matching_bv; }		
				else { $income_pv = (14/100)*$matching_bv; }			
				}			
				elseif($lbv < 50000 && $rbv < 50000) {  $income_pv = (17/100)*$matching_bv; }	
				elseif($lbv < 70000 && $rbv < 70000) {  $income_pv = (18/100)*$matching_bv; }	
				elseif($lbv < 100000 && $rbv < 100000) {  		
				if($sbv>= 500) { $income_pv = (19/100)*$matching_bv; }		
				else { $income_pv = (18/100)*$matching_bv; } 		
				}			
				elseif($lbv >= 100000 && $rbv >= 100000) {  	
				if($sbv>= 1000) {$income_pv = (21/100)*$matching_bv; }			
				elseif($sbv>= 500) { $income_pv = (19/100)*$matching_bv; }		
				else { $income_pv = (18/100)*$matching_bv; }		
				}		
				else { $income_pv = (21/100)*$matching_bv; }
				$income_pv = round($income_pv,2);
				$matching_type = 'Matching';
				$add_matching_pv = 'true';
				if($matching >= $caping) { $matching_type = 'Capping'; }
				else {
					$total_income_pv_dm = $matching + $income_pv;
					if($total_income_pv_dm <= $caping) { $final_income_dm = $income_pv; }
					else { 
						$add_matching_pv = 'false';
						/************** cping PV *******************/
						$final_income_pv_dm = $total_income_pv_dm - $caping; 
						$this->add_pv[] = array('order_id'=>$order_id,'amount'=>$final_income_pv_dm,'user_id'=>$cid,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'pay_level'=>'0','type'=>'Capping','status'=>'Active');
					
						/**************** matching pv ****************/
						$final_income_pv_dm = $caping - $matching; 
						$this->add_pv[] = array('order_id'=>$order_id,'amount'=>$final_income_pv_dm,'user_id'=>$cid,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'pay_level'=>'0','type'=>'Matching','status'=>'Active');
					
						
					}  
				}
				if($income_pv > 0 && $add_matching_pv == 'true') {
				  $this->add_pv[] = array('order_id'=>$order_id,'amount'=>$income_pv,'user_id'=>$cid,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'pay_level'=>'0','type'=>$matching_type,'status'=>'Active');
				  
				 
				}
				
				$income = $income_pv;
				$type = 'Repurchase'; 
				/***************** add income ***********/
				$final_income = 0;
				if($income > 0 && $matching < $caping) {
					$total_income_pv = $matching + $income;
					if($total_income_pv <= $caping) { $final_income = $income; }
					else { 
						$final_income = $caping - $matching; 
					}
					$this->income[] = array('amount'=>$final_income,'user_id'=>$cid,'type'=>$type,'status'=>'Active');
				}

				/****************** update pv status to redeem **************/
				  
					 if($lbv >= 50000 && $lbv >= 50000 && $reward == '' ) { 
					$package = array('rank'=>'Star');
					$this->sale_model->update_profile($cid,$package);
					}
					
					if($lbv >= 100000 && $lbv >= 100000 && $reward == 'Star'  ) {  
					$package = array('rank'=>'Silver Star');
					$this->sale_model->update_profile($cid,$package);
					}
					
					if($lbv >= 175000 && $lbv >= 1750000 && $reward == 'Silver Star' ) {
                    $package = array('rank'=>'Gold Star');
					$this->sale_model->update_profile($cid,$package);
					}
			}
		
	}
	
	
    public function add_pv_income($cid,$caping,$user_level,$reward,$position,$distribution_amount,$cust_id,$order_id,$repurchase,$lbv,$rbv,$count_left,$count_right,$left_child,$right_child) { 
   
		if($cid=='0' || $user_level == '0' || $cid == '' || $left_child =='0' || $right_child=='0') { return ''; }
		if($repurchase=='yes') { $sale_type = '2'; } 
		else { $sale_type = '1'; }
		$pv_info = $this->sale_model->get_pv($cid,$sale_type);
		$left = $right =  $matching = 0; 
		if(!empty($pv_info)) { 
		
			$total_final_pv = 0;
			$date = date('Y-m-d');
			$redeem_pv = $this->sale_model->get_matching_pv_by_date111($cid,$date);
			if(!empty($redeem_pv)) {
				$matching = $redeem_pv[0]['redeem_pv'];
			}
			if($matching=='') { $matching = 0; }
			
			$matching_pv = $this->sale_model->get_matching_pv($cid);
			if(!empty($matching_pv)) {
				$total_final_pv = $matching_pv[0]['total_pv'];
			}
			if($total_final_pv=='') { $total_final_pv = 0; }
			$update_ids = array();
			$amount_left = array();
			$amount_right = array();
			$d_left = $d_right = 0;
			if($position == 'left') { $left = $distribution_amount; $count_left =$count_left +1; $amount_left[] = $distribution_amount;  } else { $right = $distribution_amount; $count_right =  $count_right+ 1; $amount_right[] = $distribution_amount; }
			foreach($pv_info as $val) { 
				if(strstr($val['type'],'right') && $val['status']=='Active') { 
					$right = $right + $val['amount']; 
					
					$update_ids[] = $val['id']; 
					$amount_right[] = $val['amount'];
					
					
				}
				if(strstr($val['type'],'left') && $val['status']=='Active') { 
					$left = $left + $val['amount'];
					
					$update_ids[] = $val['id']; 
					$amount_left[] = $val['amount'];
					
					
				}
				
			}
			$total = $left + $right;
			
			
			$add_income = 'true';
			$first_cut_off = 'false';
			if($sale_type == '1') {
				
				if($total_final_pv < 19) {
					if(($count_left > 0 && $count_right > 1) || ($count_right > 0 && $count_left > 1)) { $first_cut_off = 'true'; } 
					else { $add_income = 'false'; }
				}
					elseif($left >= 50 && $right >= 50) {}
					else { $add_income = 'false'; }
				
			} 
			 else { $add_income = 'false'; }
		
		
			if($add_income == 'true' ) {
				if($first_cut_off == 'true' && ($count_left == 1 && $count_right == 2) || ($count_right == 1 && $count_left == 2)) {
					if($left > $right) { 
					
					if(count($amount_right) > 1) { if($amount_right[0] > $amount_right[1]) { $final_total = $amount_right[1]; } else { $final_total = $amount_right[0]; }


					$carry_forward = $right-$final_total-$final_total;
					if($carry_forward > 0) {
						$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id'=>$cid,'user_id_send_by'=>'0','sale_type'=>$sale_type,'type'=>'BV right','pay_level'=>'0','status'=>'Active');
					}
					$carry_forward = $left-$final_total;
					if($carry_forward > 0) {
						$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id'=>$cid,'user_id_send_by'=>'0','sale_type'=>$sale_type,'type'=>'BV left','pay_level'=>'0','status'=>'Active');
					}

					}
					elseif(count($amount_left) > 1) { if($amount_left[0] > $amount_left[1]) { $final_total = $amount_left[1]; } else { $final_total = $amount_left[0]; }
					$carry_forward = $left-$final_total-$final_total;
					if($carry_forward > 0) {
						$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id'=>$cid,'user_id_send_by'=>'0','sale_type'=>$sale_type,'type'=>'BV left','pay_level'=>'0','status'=>'Active');
					}
					
					$carry_forward = $right-$final_total;
					if($carry_forward > 0) {
						$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id'=>$cid,'user_id_send_by'=>'0','sale_type'=>$sale_type,'type'=>'BV right','pay_level'=>'0','status'=>'Active');
					}

					}
					
					
					  }
					elseif($right > $left) { 
					if(count($amount_right) > 1) { if($amount_right[0] > $amount_right[1]) { $final_total = $amount_right[1]; } else { $final_total = $amount_right[0]; }
					$carry_forward = $right-$final_total-$final_total;
					if($carry_forward > 0) {
						$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id'=>$cid,'user_id_send_by'=>'0','sale_type'=>$sale_type,'type'=>'BV right','pay_level'=>'0','status'=>'Active');
					}
					$carry_forward = $left-$final_total;
					if($carry_forward > 0) {
						$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id'=>$cid,'user_id_send_by'=>'0','sale_type'=>$sale_type,'type'=>'BV left','pay_level'=>'0','status'=>'Active');
					}

					}
					elseif(count($amount_left) > 1) { if($amount_left[0] > $amount_left[1]) { $final_total = $amount_left[1]; } else { $final_total = $amount_left[0]; } 

					$carry_forward = $left-$final_total-$final_total;
					if($carry_forward > 0) {
						$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id'=>$cid,'user_id_send_by'=>'0','sale_type'=>$sale_type,'type'=>'BV left','pay_level'=>'0','status'=>'Active');
					}
					 
					$carry_forward = $right-$final_total;
					if($carry_forward > 0) {
						$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id'=>$cid,'user_id_send_by'=>'0','sale_type'=>$sale_type,'type'=>'BV right','pay_level'=>'0','status'=>'Active');
					}

					}
					
					

					}
					else { $final_total = $left-$amount_left[0]; }
					
				} else {
					if($left > $right) { $final_total = $right;  }
				else { $final_total = $left; }
				}
				
				/************  add matching ********/
				$final_income_dm =0;
				$income_pv = $final_total;
				$income_pv = round($income_pv,2);
				$matching_type = 'Matching';
				$add_matching_pv = 'true';
				
				if($matching >= $caping) { $matching_type = 'Capping'; }
				else {
					$total_income_pv_dm = $matching + $income_pv;
					if($total_income_pv_dm <= $caping) { $final_income_dm = $income_pv; }
					else { 
						$add_matching_pv = 'false';
						/************** cping PV *******************/
						$final_income_pv_dm = $total_income_pv_dm - $caping; 
						$this->add_pv[] = array('order_id'=>$order_id,'amount'=>$final_income_pv_dm,'user_id'=>$cid,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'pay_level'=>'0','type'=>'Capping','status'=>'Active');
						/**************** matching pv ****************/
						$final_income_pv_dm = $caping - $matching; 
						$this->add_pv[] = array('order_id'=>$order_id,'amount'=>$final_income_pv_dm,'user_id'=>$cid,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'pay_level'=>'0','type'=>'Matching','status'=>'Active');
						$this->matching_id[] = $cid;
						
					}  
				}
				if($income_pv > 0 && $add_matching_pv == 'true') {
				  $this->add_pv[] = array('order_id'=>$order_id,'amount'=>$income_pv,'user_id'=>$cid,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'pay_level'=>'0','type'=>$matching_type,'status'=>'Active');
				  $this->matching_id[] = $cid;
				}
				if($repurchase=='yes') {
					$income = $income_pv;
					$type = 'Repurchase'; 
				} else {
					$income = $income_pv;
					$type = 'Purchase'; 
				}
				/***************** add income ***********/
				$final_income = 0;
				if($income > 0 && $matching < $caping) {
					$total_income_pv = $matching + $income;
					if($total_income_pv <= $caping) { $final_income = $income; }
					else { 
					
						
						$final_income = $caping - $matching; 
					}

					$this->income[] = array('user_id'=>$cid,'amount'=>$final_income,'tds'=>$final_income/20,'admin'=>$final_income/20,'net_income'=>(9/10)*$final_income,'user_send_by'=>$cust_id);
					$this->matching_amount[] = array('cid'=>$cid,'matching_amt'=>$final_income);
					
				
				}
				
				/**************** add carry forward *************/
				if($left > $right) { $carry_forward = $left - $right; $position = 'left'; }
				elseif($left < $right) { $carry_forward = $right - $left; $position = 'right'; }
				else { $carry_forward = 0; } 
				
				if($first_cut_off == 'true' ) { 
				if(($count_left == 1 && $count_right == 2) || ($count_right == 1 && $count_left == 2)){
					$carry_forward = 0;
				} else { $carry_forward = $carry_forward-200; }
				
				



				}
				
				if($carry_forward > 0  ) {
					$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id'=>$cid,'user_id_send_by'=>'0','sale_type'=>$sale_type,'type'=>'BV '.$position,'pay_level'=>'0','status'=>'Active');
				}
				/****************** update pv status to redeem **************/
				if(!empty($update_ids)) {
				  $this->sale_model->update_gbv_status_by_ids($update_ids);
				}
				 $lbv = $lbv/400;
				$rbv = $rbv/400;
				$m_reward = ''; 
					if($lbv >= 20 && $rbv >= 20 && $reward == '0' ) { 
					$package = array('reward'=>'1');
					$this->sale_model->update_profile($cid,$package);
					$m_reward = 'T-shirts';
					}
					
					if($lbv >= 70 && $rbv >= 70 && $reward == '1'  ) {  
					$package = array('reward'=>'2');
					$this->sale_model->update_profile($cid,$package);
					$m_reward = 'Smartphone'; }
					
					if($lbv >= 170 && $rbv >= 170 && $reward == '2' ) {
                    $package = array('reward'=>'3');
					$this->sale_model->update_profile($cid,$package);
					$m_reward = '32" LED TV'; }
					
					if($lbv >= 420 && $rbv >= 420 &&  $reward == '3' ) { 
                    $package = array('reward'=>'4');
					$this->sale_model->update_profile($cid,$package);
					$m_reward = '11000 DP for Laptop'; }
					
					if($lbv >= 920 && $rbv >= 920 && $reward == '4' ) { 
                    $package = array('reward'=>'5');
					$this->sale_model->update_profile($cid,$package);
					$m_reward = '21000 DP for Bike'; }
					
					if($lbv >= 2020 && $rbv >= 2020 && $reward == '5' ) { 
                    $package = array('reward'=>'6');
					$this->sale_model->update_profile($cid,$package);
					$m_reward = '65000 DP for Alto';}
					
					if($lbv >= 4520 && $rbv >= 4520 && $reward == '6' ) { 
                    $package = array('reward'=>'7');
					$this->sale_model->update_profile($cid,$package);
					$m_reward = '135000 DP for Swift';}
					
					if($lbv >= 9520 && $rbv >= 9520 && $reward == '7' ) { 
                    $package = array('reward'=>'8');
					$this->sale_model->update_profile($cid,$package);
					$m_reward = '270000 DP for Brezza'; }
					
					if($lbv >= 20520 && $rbv >= 20520 && $reward == '8' ) { 
					$package = array('reward'=>'9');
					$this->sale_model->update_profile($cid,$package);
					$m_reward = '500000 DP for Creta'; }
					
					if($m_reward != '') {
						if($lbv > $rbv) { $pair_bv = $rbv; }
						else { $pair_bv = $lbv; }
						 $add_income = array('reward'=>$m_reward,'user_id'=>$cid,'pair_bv'=>$pair_bv);
					   $this->sale_model->insert_table_data('reward',$add_income); 
					} 
				
			}
		
		
		
		}
		
	}
	

  
  public function add(){
    /*$myfriendss = $this->sale_model->my_friends('400002'); 
	echo '<pre>';print_r($myfriendss); echo '</pre>';*/
	$data['products'] = $this->sale_model->get_all_product();
	
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('gtotal')!='')
        {
             $this->form_validation->set_rules('customer', 'customer', 'required');
                $this->form_validation->set_rules('pid_array', 'product', 'required');
                $this->form_validation->set_rules('payment_type', 'payment type', 'required');
                $this->form_validation->set_rules('before_tax_amount', 'before tax amount', 'required|numeric');
                $this->form_validation->set_rules('gtotal', 'grand total', 'required|numeric');
              //  $this->form_validation->set_rules('idate', 'date', 'required');
                
				$customer = $this->input->post('customer');
				$gtotal = $this->input->post('gtotal');
				$customer_id = $this->sale_model->get_customer_by_id($customer);
				if(empty($customer_id)) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'This customer id is not exist.');
				}
				/* if($gtotal < 8499) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'Minimum amount must be 8500');
				} */
				
				 $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');	
                if ($this->form_validation->run() == FALSE) {  }
                else {			

			//	echo '<pre>'; print_r($this->input->post()); echo '</pre>'; die();
					$pid = $this->input->post('pid');
					$pname = $this->input->post('pname');
					$code = $this->input->post('code');
					$qty = $this->input->post('qty');
					$size = $this->input->post('size');
					$price = $this->input->post('price');
					$gst = $this->input->post('gst');
					$tprice = $this->input->post('tprice');
					$gst_percentage = $this->input->post('gst_percentage');
					$total_bv = $this->input->post('total_bv');
					
					$products_array = array();
					if(count($pid) > 0) {
						for($i=0;$i<count($pid);$i++) {
							$products_array[] = $pid[$i].'~~'.$pname[$i].'~~'.$code[$i].'~~'.$qty[$i].'~~'.$size[$i].'~~'.$price[$i].'~~'.$gst[$i].'~~'.$tprice[$i].'~~'.$gst_percentage[$i];
							$this->sale_model->update_product_qty($pid[$i],$qty[$i]);
						}
					//$products_array = array('pname'=>$pname,'qty'=>$qty,'qty_type'=>$qty_type,'qty_box'=>$qty_box,'price'=>$price);
					$products = json_encode($products_array);
					}
					//$iidate = $this->input->post('idate');
					//$idate = date('Y-m-d H:i:s',strtotime($iidate));
					$data_store = array(
                    'gtotal' => $this->input->post('gtotal'),
					'bv' => $this->input->post('total_bv'),
                    'products' => $products,
                    'before_tax_amount' => $this->input->post('before_tax_amount'),
                    'discount' => $this->input->post('discount'), 
                    'payment_type' => $this->input->post('payment_type'), 
                    'customer' => $this->input->post('customer'),
                    'total_gst' => $this->input->post('total_gst')
                   // 'tdate' => $idate
					);
                //if the insert has returned true then we show the flash message
				$sale_id = $this->sale_model->store_sale($data_store);
				


				
				
				$distribution_amount = $total_bv;
				$order_id = 0;
				$distribution = FALSE;
				$repurchase ='no';
				$sale_type ='1';
				$this->matching_id = array();
				$this->matching_amount = array();
				$this->add_pv = array();
				$this->income = array();
				$this->binary_level_income = array();
				
				$position = $customer_id[0]['position']; 
				$cust_id = $customer_id[0]['id']; 
				$package = array('sbv'=>$customer_id[0]['sbv']+$distribution_amount);
				if($customer_id[0]['consume'] == 0) {
					$package['consume']=1;
					$package['user_level']=$total_bv;
					$this->sale_model->load_wallet($customer_id[0]['did'],'1','direct'); 
					if($customer_id[0]['ddirect'] >= 10 && $customer_id[0]['duser_level'] > 0 && $customer_id[0]['dup_req'] == '0') {

						$arr = array('up_req'=>1);
						$this->Users_model->update_profile($customer_id[0]['did'],$arr);

					} 
					if($customer_id[0]['position'] == 'left') {
              $this->sale_model->load_wallet($customer_id[0]['did'],'1','left_direct');
            } else {
              $this->sale_model->load_wallet($customer_id[0]['did'],'1','right_direct');
            }
						
				}
					$this->sale_model->update_profile($cust_id,$package);
					$this->sale_model->load_wallet($customer_id[0]['did'],$total_bv,'direct_sale'); 
				 	$add_income = array('user_id'=>$customer_id[0]['did'],'payby'=>$cust_id,'amount'=>$distribution_amount*(10/100),'net_income'=>$distribution_amount*(5/100));
            		$this->sale_model->insert_table_data('direct_income',$add_income);
					$parent_customer_id = $customer_id[0]['parent_customer_id']; 
					$dis_level = 1;
					$count_bv = array();
					$p = 0;
					$compare_date = date('Y-m'); 
					if($parent_customer_id != '' && $repurchase != '') {  
				
				 	while($p < 1) {
						$parent_user = $this->sale_model->profile_by_customer_id($parent_customer_id); 
						if(!empty($parent_user)) {
							$this->add_pv[] = array('order_id'=>$order_id,'amount'=>$distribution_amount,'user_id'=>$parent_user[0]['id'],'type'=>'BV '.$position,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'status'=>'Active','pay_level'=>$dis_level);
							
							
							 $this->add_pv_income($parent_user[0]['id'],$parent_user[0]['capping'],$parent_user[0]['user_level'],$parent_user[0]['reward'],$position,$distribution_amount,$cust_id,$order_id,$repurchase,$parent_user[0]['lbv'],$parent_user[0]['rbv'],$parent_user[0]['plcount'],$parent_user[0]['prcount'],$parent_user[0]['left_direct'],$parent_user[0]['right_direct']); 
							
						  
						  if($position == 'left') {
							if($customer_id[0]['user_level']=='0') { $plcount = $parent_user[0]['plcount']+1;  } else { $plcount = $parent_user[0]['plcount']; }
							 $count_bv[] = array('id'=>$parent_user[0]['id'],'lbv'=>$parent_user[0]['lbv']+$distribution_amount,'rbv'=>$parent_user[0]['rbv'],'plcount'=>$plcount,'prcount'=>$parent_user[0]['prcount'],'left_sale'=>$parent_user[0]['left_sale']+$total_bv,'right_sale'=>$parent_user[0]['right_sale']);
						  }
						 else {
							 if($customer_id[0]['user_level']=='0') { $prcount = $parent_user[0]['prcount']+1;  } else { $prcount = $parent_user[0]['prcount']; }
							 $count_bv[] = array('id'=>$parent_user[0]['id'],'lbv'=>$parent_user[0]['lbv'],'rbv'=>$parent_user[0]['rbv']+$distribution_amount,'plcount'=>$parent_user[0]['plcount'],'prcount'=>$prcount,'left_sale'=>$parent_user[0]['left_sale'],'right_sale'=>$parent_user[0]['right_sale']+$total_bv); 
						 }
						  $parent_customer_id = $parent_user[0]['parent_customer_id'];
						  $position = $parent_user[0]['position'];
						 
						  $dis_level = $dis_level + 1;
						  $p = 0;
						} else { $p++; }
					}
				 
				 
				 
				 
				  }
				
				
				      
				      
				      if(!empty($this->matching_amount)) {
				        
				          foreach ($this->matching_amount as $matching) {
				        $p_amount = $matching['matching_amt'];
				        $parent_id = $matching['cid']; 
						$dis_level = 1;
						$p = 0;
						$dis_amount = 0;
						
						$parent_user = $this->sale_model->parent_bliss($parent_id);
						if(!empty($parent_user)) { 
						$dis_amount = $p_amount/20;
						/*$dir_id = array(); 
						$direct_id = $this->sale_model->get_first_two_direct_user_ids($parent_user[0]['direct_customer_id']);
						if(!empty($direct_id)) {
							foreach($direct_id as $id) {
								$dir_id[] = $id['id'];
							}
							
						}*/
						
						if($dis_amount > 0 && $parent_user[0]['pid'] != '' /*&& $parent_user[0]['dleft_direct'] > 0 && $parent_user[0]['dright_direct'] > 0 && !in_array($parent_id,$dir_id)*/) {
						
						$this->binary_level_income[] = array('user_id'=>$parent_user[0]['pid'],'payby'=>$cust_id,'amount'=>$dis_amount,'tds'=>$dis_amount/20,'admin'=>$dis_amount/20,'net_income'=>(9/10)*$dis_amount,'user_send_by'=>$matching['cid']);
						}
						  $p++;
								} 
							} } 

							 if(!empty($this->add_pv)) {
					  $this->sale_model->insert_batch('distribution_amount',$this->add_pv);
				  }
				  if(!empty($this->income)) {
					  $this->sale_model->insert_batch('binary_income',$this->income);
				  }
				  if(!empty($this->matching_id)) {
					  $this->sale_model->update_distribution_amount($this->matching_id,$cust_id,$sale_type,array('status' => 'Redeem'));
				  }
				  if(!empty($this->binary_level_income)) {
					  $this->sale_model->insert_batch('binary_level_income',$this->binary_level_income);
				  }
				  
				  if(!empty($count_bv)) {
					  $this->sale_model->update_batch('customer',$count_bv,'id');
					 
				  }
				 // die();
				  if(!empty($sale_id)){
				$this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
		 }

        }
      

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['tax'] = $this->sale_model->get_all_tax();
        $data['main_content'] = 'admin/sale_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  
    public function franchise_stock(){
    /*$myfriendss = $this->sale_model->my_friends('400002'); 
	echo '<pre>';print_r($myfriendss); echo '</pre>';*/
	$data['products'] = $this->sale_model->get_all_product();
	
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('gtotal')!='')
        {
             $this->form_validation->set_rules('customer', 'customer', 'required');
                $this->form_validation->set_rules('pid_array', 'product', 'required');
                $this->form_validation->set_rules('payment_type', 'payment type', 'required');
                $this->form_validation->set_rules('before_tax_amount', 'before tax amount', 'required|numeric');
                $this->form_validation->set_rules('gtotal', 'grand total', 'required|numeric');
                $this->form_validation->set_rules('idate', 'date', 'required');
                
				$customer = $this->input->post('customer');
				$gtotal = $this->input->post('gtotal');
				$customer_id = $this->sale_model->get_customer_info($customer);
				if(empty($customer_id)) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'This customer id is not exist.');
				}
				/* if($gtotal < 8499) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'Minimum amount must be 8500');
				} */
				
				 $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');	
                if ($this->form_validation->run() == FALSE) {}
                else {
					$pid = $this->input->post('pid');
					$pname = $this->input->post('pname');
					$code = $this->input->post('code');
					$qty = $this->input->post('qty');
					$size = $this->input->post('size');
					$price = $this->input->post('price');
					$gst = $this->input->post('gst');
					$tprice = $this->input->post('tprice');
					$gst_percentage = $this->input->post('gst_percentage');
					
					$products_array = array();
					if(count($pid) > 0) {
						for($i=0;$i<count($pid);$i++) {
							$products_array[] = $pid[$i].'~~'.$pname[$i].'~~'.$code[$i].'~~'.$qty[$i].'~~'.$size[$i].'~~'.$price[$i].'~~'.$gst[$i].'~~'.$tprice[$i].'~~'.$gst_percentage[$i];
							$this->sale_model->update_product_qty($pid[$i],$qty[$i]);
							
							$stock = $this->sale_model->get_all_franchise_stock_id($customer_id[0]['id'],$pid[$i]);
							if(!empty($stock)) {
								$this->sale_model->update_franchise_stock_qty($stock[0]['id'],$qty[$i]);
							} else {
								$data_to_stock = array('user_id'=>$customer_id[0]['id'],'p_id'=>$pid[$i],'qty'=>$qty[$i],'status'=>'Active');
								$this->sale_model->store_franchise_stock($data_to_stock);
							}
							
						}
					//$products_array = array('pname'=>$pname,'qty'=>$qty,'qty_type'=>$qty_type,'qty_box'=>$qty_box,'price'=>$price);
					$products = json_encode($products_array);
					}
					 $iidate = $this->input->post('idate');
					$idate = date('Y-m-d H:i:s',strtotime($iidate));
					$data_store = array(
                    'gtotal' => $this->input->post('gtotal'),
                    'products' => $products,
                    'before_tax_amount' => $this->input->post('before_tax_amount'),
                    'discount' => $this->input->post('discount'), 
                    'payment_type' => $this->input->post('payment_type'), 
                    'customer' => $this->input->post('customer'),
                    'total_gst' => $this->input->post('total_gst'),
                    'tdate' => $idate
					); 
                //if the insert has returned true then we show the flash message
				$sale_id = $this->sale_model->store_sale($data_store);
				
				if(!empty($sale_id)){
				$this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/franchise_stock');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
		 }

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['tax'] = $this->sale_model->get_all_tax();
        $data['main_content'] = 'admin/franchise_stock'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  
   public function lavel_distribution($parent_customer_id,$customer,$customer_rank,$sale_id,$grant_total){
	   
	   	$customer_id = $this->sale_model->my_parent($parent_customer_id);
		
		if($customer_rank=='3' && $customer_id[0]['p_rank']=='3' && $customer_id[0]['rank']=='3' ){ }
else{	
	   if($parent_customer_id != '' && $customer_id[0]['p_customer_id']!='') { 
	   
	    if($customer_id[0]['p_rank'] > $customer_rank) {
			$current_rank = $customer_id[0]['p_rank'] - $customer_id[0]['rank'];
			if($current_rank=='1') {
				$distribution_amount = (10 * $grant_total) / 100;
				$distribution_data = array(
				  'user_id'=> $customer_id[0]['p_customer_id'],
				  'amount'=> $distribution_amount,
				  'user_id_send_by'=> $customer,
				  'pay_level'=> '2',
				  'status'=>'active',
				  'order_id'=> $sale_id,
				  'rank'=> $customer_id[0]['p_rank']
				);
				$this->sale_model->store_distribution_amount($distribution_data);
				$this->sale_model->update_customer_distribution_amount($distribution_amount,$customer_id[0]['p_customer_id']);
			}
		}
	    
			  }
   }
  }
 
  
  
  
  public function update(){  
	  	
	 
	  //sale id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
             $this->form_validation->set_rules('user_id', 'User id', 'required|trim');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
                $data_to_store = array(
				    'user_id' => $this->input->post('user_id'),
				    'amount' => $this->input->post('amount'),
					'gst_val' => $this->input->post('gst_val'),
					'msd_val' => $this->input->post('msd_val'),
					'how_to_pay' => $this->input->post('how_to_pay'),
					'gst_amt' => $this->input->post('gst_amt'),
					'msd_amt' => $this->input->post('msd_amt'),
					'total_amount' => $this->input->post('total_amount'),
					); 
             $return = $this->Sale_model->update_sale($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['sale'] = $this->sale_model->get_all_sale_id($id); 
        //load the view
        $data['main_content'] = 'admin/sale_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->sale_model->delete_sale($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/sale');
 }  
}