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

        if(!$this->session->userdata('is_customer_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
   
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
	     $data['profile'] = $this->sale_model->profile($id);
 
        if($data['profile'][0]['franchise'] > 0) {
          $data['sale'] = $this->sale_model->get_all_merchant_sale($id);
          $sale = $this->sale_model->get_all_sale_by_id($customer_id);
          $data['sale'] = array_merge($data['sale'],$sale);

          $tdate = array_column($data['sale'], 'tdate');
          array_multisort($tdate, SORT_DESC,$data['sale']);
         
        }
        else {
           $data['sale'] = $this->sale_model->get_all_sale_by_id($customer_id);
        }
        

  
	
	//load the view
      $data['main_content'] = 'admin/sale_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
   public function stock_detail() {
   
    $id = $this->session->userdata('cust_id');
      $data['profile'] = $this->sale_model->profile($id);
    
        
        $data['sale'] = $this->sale_model->get_all_stock_detail_sale($id);
    
  
  //load the view
      $data['main_content'] = 'admin/sale_stock';
      $this->load->view('includes/admin/template', $data);   
  }
    public function wallet_history() {
   
    $id = $this->session->userdata('cust_id');
    $customer_id = $this->session->userdata('bliss_id');
     $data['profile'] = $this->sale_model->profile($id);
	 if ($this->input->server('REQUEST_METHOD') === 'POST'){
    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
    	} else {
    	    $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
    	}
	$data['wallet_history'] = $this->sale_model->get_all_wallet_history($customer_id,$sdate,$edate);
	//load the view
      $data['main_content'] = 'admin/wallet_history';
      $this->load->view('includes/admin/template', $data);   
  }

   public function repurchase_wallet_history() {
   
    $id = $this->session->userdata('cust_id');
    $customer_id = $this->session->userdata('bliss_id');
     $data['profile'] = $this->sale_model->profile($id);
	 if ($this->input->server('REQUEST_METHOD') === 'POST'){
    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
    	} else {
    	    $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
    	}
	$data['wallet_history'] = $this->sale_model->get_all_repurchase_wallet_history($customer_id,$sdate,$edate);
	//load the view
      $data['main_content'] = 'admin/wallet_history';
      $this->load->view('includes/admin/template', $data);   
  }

public function pininsale() {
       
      $id = $this->session->userdata('cust_id');
      $customer_id = $this->session->userdata('bliss_id');
      $data['profile'] = $this->sale_model->profile($id);
  $data['sale'] = $this->sale_model->get_all_pin_sale($customer_id);
  //echo '<pre>'; print_r($data['sale']); die();
  
  //load the view
      $data['main_content'] = 'admin/pin_sale_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
    public function pininvoice() {
      $id = $this->uri->segment(3);
    $cid = $this->session->userdata('cust_id');
    $customer_id = $this->session->userdata('bliss_id');
    $data['profile'] = $this->sale_model->profile($cid);
     //echo '<pre>'; print_r($data['profile']); die();
      $data['customer_info'] = '';
      $data['invoice'] = $this->sale_model->get_all_sale_id($id); 
  //  echo '<pre>'; print_r($data['invoice']); die();
  if(!empty($data['invoice'])) {
            $data['customer_info'] = $this->sale_model->get_customer_info($data['invoice'][0]['customer']); 
            if($data['customer_info'][0]['parent_customer_id']!='') { $data['sponser_name'] = $this->sale_model->get_customer_info($data['customer_info'][0]['parent_customer_id']);  }
          }
  //load the view
      $data['main_content'] = 'admin/pin_invoice';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function invoice() {
	  $cid = $this->session->userdata('cust_id');$customer_id = $this->session->userdata('bliss_id');
	    $data['profile'] = $this->sale_model->profile($cid);
      $id = $this->uri->segment(4);
      $data['customer_info'] = '';
    	$data['invoice'] = $this->sale_model->get_all_sale_id($id); 
	if(!empty($data['invoice'])) {
            $data['customer_info'] = $this->sale_model->get_customer_info($data['invoice'][0]['customer']); 
            if($data['customer_info'][0]['parent_customer_id']!='') { 
                $data['sponser_name'] = $this->sale_model->get_customer_info($data['customer_info'][0]['parent_customer_id']);  }
          }
		  $data['center'] = $this->sale_model->get_center_detail($data['invoice'][0]['center_id']);
		  
	//load the view
      $data['main_content'] = 'admin/sale_invoice';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function add_pv_income( $cid, $caping, $user_level, $reward, $position, $distribution_amount, $cust_id, $order_id, $repurchase, $lbv, $rbv, $count_left, $count_right, $left_child, $right_child ) {

    if ( $cid == '0' || $user_level == '0' || $cid == '' || $left_child + $right_child < 2 ) {
      return '';
    }
    if ( $repurchase == 'yes' ) {
      $sale_type = '2';
    } else {
      $sale_type = '1';
    }
    $pv_info = $this->sale_model->get_pv( $cid, $sale_type );
    $left = $right = $matching = 0;
    if ( !empty( $pv_info ) ) {

      $total_final_pv = 0;
      $date = date( 'Y-m-d' );
      $redeem_pv = $this->sale_model->get_matching_pv_by_date( $cid, $date );
      $total_final_pv = $this->sale_model->get_matching_pv( $cid );
      if ( !empty( $redeem_pv ) ) {
        $matching = $redeem_pv[ 0 ][ 'redeem_pv' ];
      }
      if ( $matching == '' ) {
        $matching = 0;
      }
      if ( !empty( $total_final_pv ) ) {
        $total_final_pv = $total_final_pv[ 0 ][ 'total_pv' ];
      }
      if ( $total_final_pv == '' ) {
        $total_final_pv = 0;
      }

      $update_ids = array();
      $d_left = $d_right = 0;
      foreach ( $pv_info as $val ) {
        if ( strstr( $val[ 'type' ], 'right' ) && $val[ 'status' ] == 'Active' ) {
          $right = $right + $val[ 'amount' ];
          $d_right = $d_right + 1;
          $update_ids[] = $val[ 'id' ];


        }
        if ( strstr( $val[ 'type' ], 'left' ) && $val[ 'status' ] == 'Active' ) {
          $left = $left + $val[ 'amount' ];
          $d_left = $d_left + 1;
          $update_ids[] = $val[ 'id' ];


        }

      }
      $total = $left + $right;
      $add_income = 'true';
      $first_cut_off = 'false';
      if ( $sale_type == '1' || $sale_type == '2' ) {
        if($total_final_pv < 50) {
          if ( ( $d_left >= 1 && $d_right >= 2 ) ||  ( $d_left >= 2 && $d_right >= 1 ) )  {
            $first_cut_off = 'true';
          }
          else {
            $add_income = 'false';
          }
        }
        elseif ( $left >= 500 && $right >= 500 ) {}
        else {
          $add_income = 'false';
        }

      } else {
        $add_income = 'false';
      }


      if ( $add_income == 'true' ) {
          if ( $left > $right ) {
            $final_total = $right;
          } else {
            $final_total = $left;
          }
        

        /************  add matching ********/
        $final_income_dm = 0;
        $income_pv = (60/100)*$final_total;
        $income_pv = round( $income_pv, 2 );
        $matching_type = 'Matching';
        $add_matching_pv = 'true';

        if ( $matching >= $caping ) {
          $matching_type = 'Capping';
        } else {

          $total_income_pv_dm = $matching + $income_pv;
          if ( $total_income_pv_dm <= $caping ) {
            $final_income_dm = $income_pv;
          } else {
            $add_matching_pv = 'false';
            /************** cping PV *******************/
            $final_income_pv_dm = $total_income_pv_dm - $caping;
            $add_pv = array( 'order_id' => $order_id, 'amount' => $final_income_pv_dm, 'user_id' => $cid, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'pay_level' => '0', 'type' => 'Capping', 'status' => 'Active' );
            $this->sale_model->add_distribution( $add_pv );
            /**************** matching pv ****************/
            $final_income_pv_dm = $caping - $matching;
            $add_pv = array( 'order_id' => $order_id, 'amount' => $final_income_pv_dm, 'user_id' => $cid, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'pay_level' => '0', 'type' => 'Matching', 'status' => 'Active' );
            $this->sale_model->add_distribution( $add_pv );
            $this->matching_id[] = $cid;

          }
        }
        if ( $income_pv > 0 && $add_matching_pv == 'true' ) {
          $add_pv = array( 'order_id' => $order_id, 'amount' => $income_pv, 'user_id' => $cid, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'pay_level' => '0', 'type' => $matching_type, 'status' => 'Active' );
          $this->sale_model->add_distribution( $add_pv );
          $this->matching_id[] = $cid;
        }
        if ( $repurchase == 'yes' ) {
          $income = $income_pv;
          $type = 'Repurchase';
        } else {
          $income = $income_pv;
          $type = 'Purchase';
        }
        /***************** add income ***********/
        $final_income = 0;
        if ( $income > 0 && $matching < $caping ) {
          $total_income_pv = $matching + $income;
          if ( $total_income_pv <= $caping ) {
            $final_income = $income;
          } else {


            $final_income = $caping - $matching;
          }

          $this->income[] = array( 'user_id' => $cid, 'amount' => $final_income, 'tds' => $final_income / 20, 'admin' => $final_income / 20, 'net_income' => ( 9 / 10 ) * $final_income, 'user_send_by' => $cust_id, 'order_id' => $order_id );
          $this->matching_amount[] = array( 'cid' => $cid, 'matching_amt' => $final_income );


        }

        /**************** add carry forward *************/
        if ( $left > $right ) {
          $carry_forward = $left - $right;
          $position = 'left';
        } elseif ( $left < $right ) {
          $carry_forward = $right - $left;
          $position = 'right';
        }
        else {
          $carry_forward = 0;
        }
        if($first_cut_off=='true') { $carry_forward = $carry_forward - 500; }

        if ( $carry_forward > 0 ) {
          $add_pv = array( 'order_id' => '0', 'amount' => $carry_forward, 'user_id' => $cid, 'user_id_send_by' => '0', 'sale_type' => $sale_type, 'type' => 'BV ' . $position, 'pay_level' => '0', 'status' => 'Active' );
          $this->sale_model->add_distribution( $add_pv );
        }
        /****************** update pv status to redeem **************/
        if ( !empty( $update_ids ) ) {
          $this->sale_model->update_gbv_status_by_ids( $update_ids );
        }

      }



    }

  }
  
   
   
   
  public function repurchase_distribution($userid,$amount,$total_lbv,$user_send_by,$order_id,$position,$self,$current_percentage){

  // checkout/repurchase_distribution/25/500/5/127/140

        //$current_percentage = 0;
        $update_bv = array();
        $team_bussiness = array();
        $remender_percentage = 40;
        $direct_id = $userid;
        $loop = 0;
        $total_countlbv = 0;
        $level = 1;
        $rank = 1;
        $dis_income = array(0,5,4,3,2,1);
        $dis_amount = $total_lbv ;
          while($loop < 1) {
        $total_countlbv = 0;
        $direct_balace_bv = 0;
        //$direct = $this->checkout_model->get_pv_team($direct_id);
        $direct = $this->sale_model->get_reuser_with_direct_info_by_id($direct_id);
        
        if(!empty($direct)) {

        $children = $this->sale_model->get_reuser_with_direct_info_direct($direct[0]['customer_id']);
        if(!empty($children)) {
          if($children[0]['amount'] >= 30000 && $direct_id[0]['royality']==0) {
            $single_team_bv = $children[0]['amount'];
            $total_team_bv = array_sum(array_column($children, 'amount')) - $single_team_bv;
            $team_percentage = array_count_values(array_column($children, 'percentage'));
            $rank_dir = 0;
            if(!empty($team_percentage)) {
              foreach($team_percentage as $key=>$val) {
                if($key >= 21) { $rank_dir = $rank_dir + 1; }
              }
            }
            if($rank_dir >=3 && $total_team_bv >= 90000) {
              $this->sale_model->update_profile($direct_id[0]['id'],array('royality'=>1));
            }


          }
          elseif($children[0]['amount'] >= 50000 && $direct_id[0]['royality']==1) {
            $single_team_bv = $children[0]['amount'];
            $total_team_bv = array_sum(array_column($children, 'amount')) - $single_team_bv;
            $team_percentage = array_count_values(array_column($children, 'percentage'));
            $rank_dir = 0;
            if(!empty($team_percentage)) {
              foreach($team_percentage as $key=>$val) {
                if($key >= 25) { $rank_dir = $rank_dir + 1; }
              }
            }
            if($rank_dir >=3 && $total_team_bv >= 150000) {
              $this->sale_model->update_profile($direct_id[0]['id'],array('royality'=>2));
            }


          }
          elseif($children[0]['amount'] >= 80000 && $direct_id[0]['royality']==2) {
            $single_team_bv = $children[0]['amount'];
            $total_team_bv = array_sum(array_column($children, 'amount')) - $single_team_bv;
            $team_percentage = array_count_values(array_column($children, 'percentage'));
            $rank_dir = 0;
            if(!empty($team_percentage)) {
              foreach($team_percentage as $key=>$val) {
                if($key >= 30) { $rank_dir = $rank_dir + 1; }
              }
            }
            if($rank_dir >=3 && $total_team_bv >= 200000) {
              $this->sale_model->update_profile($direct_id[0]['id'],array('royality'=>3));
            }


          }
          elseif($children[0]['amount'] >= 120000 && $direct_id[0]['royality']==3) {
            $single_team_bv = $children[0]['amount'];
            $total_team_bv = array_sum(array_column($children, 'amount')) - $single_team_bv;
            $team_percentage = array_count_values(array_column($children, 'percentage'));
            $rank_dir = 0;
            if(!empty($team_percentage)) {
              foreach($team_percentage as $key=>$val) {
                if($key >= 35) { $rank_dir = $rank_dir + 1; }
              }
            }
            if($rank_dir >=3 && $total_team_bv >= 270000) {
              $this->sale_model->update_profile($direct_id[0]['id'],array('royality'=>4));
            }


          }
        }
        //$this->add_distribution_amount($dis_income[$level],$direct[0]['id'],$user_send_by,$level,$order_id,'Active','Level');

        $total_countlbv = $direct[0]['amount'];

        $rank_bv = $total_countlbv+$total_lbv;

        if(!empty($direct) && $remender_percentage > 0 && $direct[0]['sbv'] >= 3000 && $self >= 3000) {
        
          
          if($rank_bv > 0) {

            $user_percentage = $this->get_user_percentage($rank_bv,$direct[0]['id'],$direct[0]['percentage']);

            if($user_percentage >= $current_percentage) {
            
            $percentage = $user_percentage - $current_percentage; $income_type = 'Purchase'; 

            $remender_percentage = $remender_percentage - $percentage;

            $current_percentage = $user_percentage;

            $income = ($percentage / 100) * $dis_amount;

            $income = round($income,2);

            $final_income = $income;
            
            if($final_income > 0 && $percentage > 0) {
              
              $this->repurchase[] = array('amount'=>round($final_income*0.60,2),'user_id'=>$direct[0]['id'],'user_send_by'=>$user_send_by,'type'=>'Team Performance Bonus','order_id'=>$order_id,'pay_level'=>$level);
              

            }

            }

          }
          
        } 
        
        if($direct[0]['sbv'] >= 3000) {
          $team_bussiness[] = array( 'order_id' => $order_id, 'amount' => $total_lbv, 'user_id' => $direct[0]['id'], 'user_id_send_by' => $user_send_by, 'pay_level' => $level, 'position' => $position );
          if($self >= 3000) {
            if($level <= 5) {
            $dis_array = array(10,6,4,2,1);
            $this->repurchase[] = array('amount'=>round(($dis_array[$level-1]/100)*$total_lbv*0.60,2),'user_id'=>$direct[0]['id'],'user_send_by'=>$user_send_by,'type'=>'Team Level Bonus','order_id'=>$order_id,'pay_level'=>$level);
            }
          }
          
        }
        $direct_id = $direct[0]['did'];
        $position = $direct[0]['position'];
        
        }
        else { $loop = 2; } 

        $level++;

        }
        if(!empty($team_bussiness)) {
           $this->sale_model->insert_batch('team_bussiness',$team_bussiness);
        }
       

  }
  
  public function get_user_percentage($rank_bv,$cust_id,$percent) {

    

    if($rank_bv >=120001 ) { $percentage = 35; }

    elseif($rank_bv >=80001 ) { $percentage = 30; }

    elseif($rank_bv >=45001  ) { $percentage = 25; }

    elseif($rank_bv >=20001 ) { $percentage = 21; }

    elseif($rank_bv >=5001  ) { $percentage = 16; }

    elseif($rank_bv >=1001 ) { $percentage = 12; }

    else { $percentage = 7; }

    if($percentage > $percent) {
        $this->sale_model->update_profile($cust_id,array('percentage'=>$percentage));
    }

    return $percentage;

  }

  public function add_distribution_amount($amount,$user_id,$user_send_by,$level,$order_id,$status,$type){

    

    $add_income = array(

            'user_id' => $user_id,

            'amount' => round($amount,2),

            'user_send_by' => $user_send_by,

            'pay_level' => $level,

            'type' => $type,

           // 'orderid' => $order_id,

            'status' => $status

    ); 

        $this->sale_model->add_data_in_table($add_income,'incomes');

    

    //if($status=='Active') {

      $add_transactional = array(

            'send_by' => $user_send_by,

            'amount' => $amount,

            'userid' => $user_id,

            'description' => 'Reward Points',

            'credit' => '1',

            'type' => $type,

            'orderid' => $order_id,

            'status' => 'Credit'

      ); 


    

  }

  public function update_rank_capping($cid,$left,$right,$reward,$sbv) {
    if($right >= 12 && $left >= 6 && $sbv >= 3000 && $reward==0) {
      $data_to_store = array('capping'=>3000,'rank'=>'Bronze','reward'=>1);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 1800;
    }
    if($right >= 42 && $left >= 21  && $sbv >= 3000 && $reward==1) {
      $data_to_store = array('capping'=>4500,'rank'=>'Silver','reward'=>2);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 4500;
    }
    if($right >= 118 && $left >= 59 && $sbv >= 3000 && $reward==2) {
      $data_to_store = array('capping'=>6000,'rank'=>'Gold','reward'=>3);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 11400;
    }
    if($right >= 308 && $left >= 154 && $sbv >= 3000 && $reward==3) {
      $data_to_store = array('capping'=>7500,'rank'=>'Platinum','reward'=>4);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 28500;
    }
    if($right >= 784 && $left >= 392 && $sbv >= 3000 && $reward==4) {
      $data_to_store = array('rank'=>'Emerald','reward'=>5);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 65000;
    }
    if($right >= 1974 && $left >= 987 && $sbv >= 3000 && $reward==5) {
      $data_to_store = array('rank'=>'Rubi','reward'=>6);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 153000;
    }
    if($right >= 4948 && $left >= 2474 && $sbv >= 3000 && $reward==6) {
      $data_to_store = array('rank'=>'Sapphire','reward'=>7);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 400000;
    }
    if($right >= 12384 && $left >= 6192 && $sbv >= 3000 && $reward==7) {
      $data_to_store = array('rank'=>'Diamond','reward'=>8);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 1011000;
    }
    if($right >= 30974 && $left >= 15487 && $sbv >= 3000 && $reward==8) {
      $data_to_store = array('rank'=>'Double Diamond','reward'=>9);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 2021000;
    }
    if($right >= 77454 && $left >= 38727 && $sbv >= 3000 && $reward==9) {
      $data_to_store = array('rank'=>'Blue Diamond','reward'=>10);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 6551000;
    }
    if($right >= 193654 && $left >= 96827 && $sbv >= 3000 && $reward==10) {
      $data_to_store = array('rank'=>'Black Diamond','reward'=>11);
      $this->sale_model->update_profile($cid,$data_to_store);
      $m_reward = 11111000;
    }
    
    

        if (!empty($m_reward)) {
          
          $add_income = array( 'reward' => $m_reward, 'user_id' => $cid );
          $this->sale_model->add_data_in_table( $add_income,'reward'  );

          $add_income = array( 'amount' => $m_reward, 'user_id' => $cid );
          $this->sale_model->add_data_in_table( $add_income,'reward_income'  );
        }
        return 0;

  }

  public function update_rank_bonanza($id,$rank) {


    $bonanza = $this->sale_model->get_bonanza();

    $team_sb = $this->sale_model->get_left_right_sb_for_bonanza( $id,$bonanza[ 0 ][ 'start_date' ],$bonanza[ 0 ][ 'end_date' ] );

    $left = $right = 0;
    if(!empty($team_sb)) {
      foreach($team_sb as $sb) {
        if($sb['type']=='BV left') {  $left = $sb['amount']; }
        else { $right = $sb['amount']; }
        }
      }

    $reward_history = $this->sale_model->get_all_reward($id,$bonanza[ 0 ][ 'start_date' ]);
    $reward_rank = array_column($reward_history, 'rank');

    if(!empty($bonanza)) {
      foreach($bonanza as $bon) {
        $lbv = $bon[ 'lbv' ];
        $rbv = $bon[ 'rbv' ];
        $rn = $bon[ 'rank' ];
        $reward = $bon[ 'reward' ];
        if($left >= $lbv && $right >=$rbv && in_array($rn, $reward_rank) && $rank==$rn) {
        $bonanza_user = $this->sale_model->get_user_bonanza( $id,$bon[ 'id' ]);
          if(empty($bonanza_user)) {
            $add_income = array( 'reward' => $reward, 'user_id' => $id ,'bonanza_id'=>$bon[ 'id' ]);
            $this->sale_model->add_data_in_table( $add_income,'reward'  );
          }
        
        }

      }

    }

  }
  public function add(){
	  $id = $this->session->userdata('cust_id');$customer_id = $this->session->userdata('bliss_id');
	    $data['profile'] = $this->sale_model->profile($id);
	   
     if($data['profile'][0]['franchise'] == 0) { redirect('admin'); }
	$data['products'] = $this->sale_model->get_all_product($id);
	
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('gtotal')!='')
        {
             $this->form_validation->set_rules('customer', 'customer', 'required');
                $this->form_validation->set_rules('pid_array', 'product', 'required');
                $this->form_validation->set_rules('payment_type', 'payment type', 'required');
                $this->form_validation->set_rules('before_tax_amount', 'before tax amount', 'required|numeric');
                $this->form_validation->set_rules('gtotal', 'grand total', 'required|numeric');
                $customer = $this->input->post('customer');
                $customer_id = $this->sale_model->get_reuser_with_direct_info($customer);
                if(empty($customer_id)) { 
                  $this->form_validation->set_rules('customerid', 'customer', 'required');
                  $this->form_validation->set_message('required', 'This customer id is not exist.');
                }
                
                if ($this->form_validation->run() == FALSE) {}
                else {

          //start the transaction
            $this->db->trans_begin();
					$pid = $this->input->post('pid');
					$pname = $this->input->post('pname');
					$code = $this->input->post('code');
					$qty = $this->input->post('qty');
					$size = $this->input->post('size');
					$price = $this->input->post('price');
					$gst = $this->input->post('gst');
					$total_gst = $this->input->post('total_gst');
					$tprice = $this->input->post('tprice');
					$gst_percentage = $this->input->post('gst_percentage');
					$total_bv = $this->input->post('total_bv');
          $free_id = $this->input->post('free_id');
					$products_array = array();
					if(count($pid) > 0) {
						for($i=0;$i<count($pid);$i++) {
							$products_array[] = $pid[$i].'~~'.$pname[$i].'~~'.$code[$i].'~~'.$qty[$i].'~~'.$size[$i].'~~'.$price[$i].'~~'.$gst[$i].'~~'.$tprice[$i].'~~'.$gst_percentage[$i];
							$this->sale_model->update_stock_qty($id,$pid[$i],$qty[$i]);
              $free_product = $this->sale_model->get_all_free_product($free_id[$i]);
              if(!empty($free_product)) {
                foreach($free_product as $prod) {
                  $products_array[] = $prod['id'].'~~'.$prod['pname'].'~~'.$prod['sku'].'~~'.$qty[$i].'~~'.$size[$i].'~~'.$prod['price'].'~~'.$prod['t_class'].'~~0~~0';
                  $this->sale_model->update_free_product_qty($prod['id'],$qty[$i]);
                }
              }
						}
					$products = json_encode($products_array);
					}
					$data_store = array( 
                    'gtotal' => $this->input->post('gtotal'),
                    'bv' => $this->input->post('total_bv'),
                    'products' => $products,
                    'before_tax_amount' => $this->input->post('before_tax_amount'),
                    'discount' => $this->input->post('discount'), 					               
					         'wallet_credit' => $this->input->post('wallet_credit'), 
                    'payment_type' => $this->input->post('payment_type'), 
                    'slip_no' => $this->input->post('slip_no'), 
                    'total_gst' => $this->input->post('total_gst'), 
                    'customer' => $this->input->post('customer'),
                    'center_id' => $id
					);
          $order_id = $this->sale_model->store_sale($data_store);
					$user = $customer_id[0];
          $distribution_amount = $total_bv;
          $cust_id = $customer_id[0]['id'];
          $total_sbv = $customer_id[0]['sbv']+$distribution_amount;
          
        //$distribution_amount = $this->session->userdata('order_sub_total') + 0;
        if($cust_id =='' || $cust_id ==' ') { $cust_id = 0; }
        $repurchase = '';
        $sale_one_bv= $sale_two_bv = 0;
        if($customer_id[0]['consume'] == 0) {

        if($total_sbv >= 500) {
          $this->sale_model->load_wallet( $user[ 'did' ], '1', 'direct' );
            if ( $user[ 'position' ] == 'left' ) {
              $this->sale_model->load_wallet( $user[ 'did' ], '1', 'left_direct' );
            } else {
              $this->sale_model->load_wallet( $user[ 'did' ], '1', 'right_direct' );
            }
        }

        if($customer_id[0]['sbv'] <  500) {
          if($total_sbv > 500) { 
            $repurchase = 'both'; 
            $sale_one_bv = 500-$customer_id[0]['sbv']; 
            $sale_two_bv = $distribution_amount - $sale_one_bv;
            if($sale_two_bv > 2500) {
              $sale_two_bv = 2500-$customer_id[0]['sbv']; 
            }
            } else { 
             $repurchase = 'no';
             $sale_one_bv = $distribution_amount;

             }
            }
            else {
              $repurchase = 'no';
              $sale_one_bv = $distribution_amount;
             }
        }  else if($customer_id[0]['sbv'] <  3000){
          if($total_sbv > 3000) { 
            $sale_two_bv = 3000-$customer_id[0]['sbv']; 
          } else {
            $sale_two_bv = $distribution_amount;
          }
          $repurchase = 'yes';
          
        }
        
        if($total_sbv > 3000) { 

            if($customer_id[0]['sbv'] >= 3000) { 
              $balance_sb = $distribution_amount; }
              else {
                $balance_sb = $total_sbv-3000;
              }


          $direct_customer_id = $user['direct_customer_id']; 
          $dis_level = 1;
          $p = 0;
          $compare_date = date('Y-m');
          if($direct_customer_id != '') {
          $damount = $balance_sb;
          $distribute_level = 0;  
          $parentid = $user['did'];
          $position = $user['position'];

          $total_countlbv = $user['amount'];

          $rank_bv = $total_countlbv+$balance_sb;
          $user_percentage = $this->get_user_percentage($rank_bv,$user['id'],$user['percentage']);
          $this->repurchase[] = array('amount'=>round(($user_percentage/100)*$balance_sb*0.60,2),'user_id'=>$cust_id,'user_send_by'=>$cust_id,'type'=>'Team Performance Bonus','order_id'=>$order_id,'pay_level'=>1); 

          $team_bussiness[] = array( 'order_id' => $order_id, 'amount' => $balance_sb, 'user_id' => $cust_id, 'user_id_send_by' => $cust_id, 'pay_level' => 0, 'position' => 'Self' );
   
          $this->repurchase_distribution($parentid,$damount,$balance_sb,$cust_id,$order_id,$position,$total_sbv,$user_percentage);
          if(!empty($team_bussiness)) {
             $this->sale_model->insert_batch('team_bussiness',$team_bussiness);
            }
          } 

          
          }

          if($repurchase=='no' || $repurchase=='both') {
          $sale_type = 1;
          $position = $user[ 'position' ];

          $parent_customer_id = $user[ 'parent_customer_id' ];
          $dis_level = 1;
          $p = 0;
          $compare_date = date( 'Y-m' );
          if ( $parent_customer_id != '' && $repurchase != '' && $sale_one_bv > 0 ) {
            while ( $p < 1 ) {
              $parent_user = $this->sale_model->profile_by_customer_id( $parent_customer_id );
              if ( !empty( $parent_user ) ) {
                $add_pv = array( 'order_id' => $order_id, 'amount' => $sale_one_bv, 'user_id' => $parent_user[ 0 ][ 'id' ], 'type' => 'BV ' . $position, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'status' => 'Active', 'pay_level' => $dis_level );
                
                $this->sale_model->add_distribution( $add_pv );
                
                $this->add_pv_income( $parent_user[ 0 ][ 'id' ], $parent_user[ 0 ][ 'capping' ], $parent_user[ 0 ][ 'consume' ], $parent_user[ 0 ][ 'reward' ], $position, $sale_one_bv, $cust_id, $order_id, $repurchase, $parent_user[ 0 ][ 'lbv' ], $parent_user[ 0 ][ 'rbv' ], $parent_user[ 0 ][ 'plcount' ], $parent_user[ 0 ][ 'prcount' ], $parent_user[ 0 ][ 'left_direct' ], $parent_user[ 0 ][ 'right_direct' ] );

                $parent_customer_id = $parent_user[ 0 ][ 'parent_customer_id' ];
                $position = $parent_user[ 0 ][ 'position' ];

                $dis_level = $dis_level + 1;
                $p = 0;
              } else {
                $p++;
              }
            }
          }

          
        }


        if($repurchase=='yes' || $repurchase=='both') {
          $sale_type = 2;
          $position = $user[ 'position' ];

          $parent_customer_id = $user[ 'parent_customer_id' ];
          $dis_level = 1;
          $p = 0; 
          $compare_date = date( 'Y-m' );
          if ( $parent_customer_id != '' && $repurchase != '' && $sale_two_bv > 0 ) {
            while ( $p < 1 ) {
              $parent_user = $this->sale_model->profile_by_customer_id( $parent_customer_id );
              if ( !empty( $parent_user ) ) {

                $team_sb = $this->sale_model->get_left_right_sb( $parent_user[ 0 ][ 'id' ] );
                $left = $right = 0;
                if(!empty($team_sb)) {
                  foreach($team_sb as $sb) {
                    if($sb['type']=='BV left') {  $left = $sb['amount']; }
                    else { $right = $sb['amount']; }
                  }
                }
                if($parent_user[ 0 ][ 'sbv' ] >= 3000 ) {
                  $add_pv = array( 'order_id' => $order_id, 'amount' => $sale_two_bv, 'user_id' => $parent_user[ 0 ][ 'id' ], 'type' => 'BV ' . $position, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'status' => 'Active', 'pay_level' => $dis_level );
                
                  $this->sale_model->add_distribution( $add_pv );
                } else {
                  $add_pv = array( 'order_id' => $order_id, 'amount' => $sale_two_bv, 'user_id' => $parent_user[ 0 ][ 'id' ], 'type' => 'BV ' . $position, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'status' => 'Lapse', 'pay_level' => $dis_level );
                
                  $this->sale_model->add_distribution( $add_pv );
                }
                
                if($position == 'left') {
                  $left = $left + $sale_two_bv;
                } else { $right = $right + $sale_two_bv; } 

                $this->update_rank_capping($parent_user[ 0 ][ 'id' ],$left/500,$right/500,$parent_user[ 0 ][ 'reward' ],$parent_user[ 0 ][ 'sbv' ]);

                $this->update_rank_bonanza($parent_user[ 0 ][ 'id' ],$parent_user[ 0 ][ 'rank' ]);
                $parent_customer_id = $parent_user[ 0 ][ 'parent_customer_id' ];
                $position = $parent_user[ 0 ][ 'position' ];

                $dis_level = $dis_level + 1;
                $p = 0;
              } else {
                $p++;
              }
            }
          }

          
        }


        if(!empty($add_pv_array)) {
          $this->sale_model->insert_batch( 'team_bussiness', $add_pv_array );
        }
        if ( !empty( $this->income ) ) {
          $this->sale_model->insert_batch( 'binary_income', $this->income );
        }


        if(!empty($this->add_pv)) {     
          $this->sale_model->insert_batch('distribution_amount',$this->add_pv);   
        }         
        if(!empty($this->repurchase)) {     
          $this->sale_model->insert_batch('repurchase_income',$this->repurchase);         } 
        if(!empty($count_bv)) {
           $this->sale_model->update_batch('repurchase_bv',$count_bv,'user_id');   
        }


        $data_profile_array['sbv'] = $total_sbv;
            if($total_sbv >= 500 && $customer_id[0]['consume'] == 0) { 
              $data_profile_array['consume'] = 1;
              $data_profile_array['capping'] = 600;
              $data_profile_array['user_level'] = 500;
              
            

                }
            if($total_sbv >= 3000) {
              $data_profile_array['capping'] = 1500;
            }
        
        $this->sale_model->update_profile($cust_id,$data_profile_array);
        
        
          
        //make transaction complete
              $this->db->trans_complete();
              //check if transaction status TRUE or FALSE
              if ($this->db->trans_status() === FALSE) {
                  //if something went wrong, rollback everything
                  $this->db->trans_rollback();
              } else {
                  //if everything went right, commit the data to the database
                  $this->db->trans_commit();
                  $return = TRUE;
              } 


          
					/* $own_profile = $this->sale_model->profile_by_id($id);
					$franchise_amt = ($own_profile[0]['franchise']/100)*$total_bv;
					$add_income = array('amount'=>round($franchise_amt,0),'user_id'=>$id,'type'=>'Franchise Income','status'=>'Active');
					$this->sale_model->add_income($add_income);*/
			//		$franchise_amt = $total_bv/100;
				//	$add_income1 = array('amount'=>round($franchise_amt,0),'user_id'=>$own_profile[0]['did'],'type'=>'Franchise Referal','status'=>'Active');
			//		$this->sale_model->add_income($add_income1);
                //if the insert has returned true then we show the flash message
				if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['tax'] = $this->sale_model->get_all_tax();
        $data['main_content'] = 'admin/sale_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 $cid = $this->session->userdata('cust_id');$customer_id = $this->session->userdata('bliss_id');
	    $data['profile'] = $this->sale_model->profile($cid);
	  //sale id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
             $this->form_validation->set_rules('user_id', 'User id', 'required|trim');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
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

       
        $data['sale'] = $this->sale_model->get_all_sale_id($id,$cid); 
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