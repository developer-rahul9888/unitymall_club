<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('cart');
        $this->load->model('customer_model');	
        $this->load->model('checkout_model');	
		$cart = $this->cart->contents();
		
		// if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('emi_payment')=='Online') {}
		// elseif(isset($_POST['encResp']) && $_POST['encResp']!='') {}
        // elseif(empty($cart)) { redirect(base_url().'cart'); }
    }
	
	public function network_distribution() {
		
		echo json_encode($this->input->post());
		die;
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			$cust_id = $this->input->post('cust_id');
			$how_to_pay = $this->input->post('how_to_pay');
			$comm_dis = $this->input->post('comm_dis');
			$reward_point = $this->input->post('reward_point');
			$data['profile'] = $this->checkout_model->get_reuser_with_direct_info($cust_id);
			$user = $data['profile'][0];
			$this->payment_distribution($user);

		}
		
	}

	function payment_distribution($user) {
		$package_level = 1; $p_amount = 1000;
		$cust_id = $user['id'];
		$distribution_amount = $user['comm_dis'] + 0;
		$reward_point = $user['reward_point'] + 0;
		$total_sbv = $user['sbv']+$distribution_amount;
		$direct_id = $user['did'];
		$points = $user['points'] + $distribution_amount + 0;
		$reward_wallet = $user['reward_wallet'] - $reward_point + 0;
		$data_profile_array = array('reward_wallet'=>$reward_wallet);
		$this->checkout_model->update_profile($cust_id,$data_profile_array);
		if($reward_point > 0) {
			$data_to_store = array(
							'user_id' => $cust_id,
							'send_to' => $cust_id,
							'status' => 'Debit',
							'wallet_type ' => 'Reward Point',
							'amount ' => $reward_point
						);
			$this->checkout_model->add_transactions($data_to_store);
		}

		if($user['consume'] == 0) {
			$this->checkout_model->load_wallet($direct_id, '1', 'direct' );
			if($user[ 'ddirect' ] >= 10 && $user[ 'dbooster' ]==0) {
				$this->checkout_model->update_profile($direct_id,array('booster'=>1));
			}
			elseif($user[ 'ddirect' ] >= 15 && $user[ 'dbooster' ]==1) {
				$this->checkout_model->update_profile($direct_id,array('booster'=>2));
			}
			$data_to_store = array('consume'=>1, 'user_level'=>1,'sbv'=>$total_sbv, 'package_used' => date('Y-m-d H:i:s'));
				if($total_sbv >= 100) {
				$this->autopool($cust_id,$direct_id,$package_level,$p_amount,$user['ddirect']+1);
					$data_to_store['user_level'] = 2;
			}
				$this->checkout_model->update_profile($cust_id,$data_to_store);
				$this->first_level_income($user['direct_customer_id'],$cust_id);
			} else {
				if($total_sbv >= 100 && $user[ 'user_level' ]==1) {
					$this->autopool($cust_id,$direct_id,$package_level,$p_amount,$user['ddirect']);
					$this->checkout_model->update_profile($cust_id,array('user_level'=>2));
				}
			}
	}

	function first_level_income($direct_customer_id,$cust_id) {
		$p = 0;
		$dis_level = 1;
		$dis_income = array(5,4,2,2,1,1,1);
		while($p<6) {
			$direct_user = $this->checkout_model->profile_by_customer_id($direct_customer_id);
				if(!empty($direct_user)) {
						$data_to_store = array(
								'user_id' => $direct_user[0]['id'],
								'type' => 'Level Income',
								'pay_level' => $dis_level,
								'amount' => $dis_income[$p],
								'status ' => 'Active',
								'user_send_by ' => $cust_id
						);
						$this->checkout_model->add_income($data_to_store);
						$p++;
						$dis_level++;
						$direct_customer_id = $direct_user[0]['direct_customer_id'];
				} else { $p = 40; }
			}
}


function autopool($user_id,$direct_id,$package_level,$package_name,$directs) {
	/* start **/
	$placement_id = array();
	//$user_info = $this->checkout_model->get_user_info($user_id);
	$check = $this->checkout_model->check_autopool($direct_id);
	if(!empty($check)) {	
		$placement_id = $check;
	} else {  $placement_id = $this->checkout_model->get_autopool_placement(); }
			$data_to = array(
			'user_id' => $user_id,
			'parent_id' => $placement_id[0]['id'],
			'direct_id' => $direct_id
			); 
			$insert_id = $this->checkout_model->insert_autopool_data($data_to); 
			$this->checkout_model->add_childress(array('user_id' => $user_id,'matrix_id'=>$insert_id));
			$this->checkout_model->update_autopool_child_num($placement_id[0]['id']);
			if($placement_id[0]['children']==0 && 1==2) {
				$sponsor_data = $this->checkout_model->get_autopool_by_id($placement_id[0]['parent_id']);
				if(!empty($sponsor_data)) {
					$data_to_store = array(
					'user_id' => $sponsor_data[0]['user_id'],
					'amount' => 100,
					'user_send_by ' => $user_id,
					'type' => 'Upgrade Income',
					'pay_level' => 2,
					'status ' => 'Active'
					);
					$this->checkout_model->add_income($data_to_store);
					$data_to_store = array(
						'user_id' => $sponsor_data[0]['user_id'],
						'send_to' => $sponsor_data[0]['user_id'],
						'amount' => 100,
						'status ' => 'Credit',
						'wallet_type' => 'Point',
						);
					$this->checkout_model->add_transactions($data_to_store);
					$this->checkout_model->load_wallet($sponsor_data[0]['user_id'], 100, 'points' );
				}
			} else {
				if($placement_id[0]['children']<2) { $coin = 50; } else { $coin = 100; }
				$data_to_store = array(
					'user_id' => $direct_id,
					'amount' => $coin,
					'user_send_by ' => $user_id,
					'type' => 'Upgrade Income',
					'pay_level' => 1,
					'status ' => 'Active'
				);
				$this->checkout_model->add_income($data_to_store);
				$data_to_store = array(
						'user_id' => $direct_id,
						'send_to' => $direct_id,
						'amount' => $coin,
						'status ' => 'Credit',
						'wallet_type' => 'Point',
				);
				$this->checkout_model->add_transactions($data_to_store);
				$this->checkout_model->load_wallet($direct_id, $coin, 'points' );
			}
			if($placement_id[0]['children']<2) {
				$this->checkout_model->load_wallet($placement_id[0]['user_id'], $package_name, 'sbv' );
				$this->checkout_model->load_children($placement_id[0]['user_id'],1,'level_1' );
			}
			if($placement_id[0]['children']==1) {
				$package_level = 3;
				$this->checkout_model->update_profile($placement_id[0]['user_id'],array('user_level'=>3));
				$this->reverse_matrix_income($placement_id[0]['user_id'],$placement_id[0]['direct_id'],$package_level);
			}

}

function reverse_matrix_income($user_id,$direct_id,$package_level) {
	$user_info = $this->checkout_model->get_user_info($user_id);
	$dis_level = 1;
	$p = 0;
	$sponsor = $user_info[0]['parent_id'];
	while($p<6) {
	$sponsor_data = $this->checkout_model->get_autopool_by_id($sponsor);
	if(!empty($sponsor_data)) {
	if($package_level==3 && $dis_level == 2) { $level_inome = 100; $level='level_2'; }
	elseif($package_level == 4 && $dis_level == 3) { $level_inome = 200; $level='level_3'; }
	elseif($package_level == 5 && $dis_level == 4) { $level_inome = 800; $level='level_4'; }
	elseif($package_level == 6 && $dis_level == 5) { $level_inome = 6400; $level='level_5'; }
	elseif($package_level == 7 && $dis_level == 6) { $level_inome = 102400; $level='level_6'; }
	else { $level_inome = 0; }
	if($level_inome > 0) {
			if($sponsor_data[0][$level] < pow(2, $dis_level)) { $coin = $level_inome/2; } else { $coin = $level_inome; }
			$data_to_store = array(
				'type' => 'Upgrade Income',
				'pay_level' => $dis_level,
				'amount' => $coin,
				'status ' => 'Active',
				'user_send_by ' => $user_id,
				'description ' =>$package_level
			);
			if($sponsor_data[0]['user_level']>=$package_level) {
				/*if($sponsor_data[0]['user_level'] == $dis_level+1) { 
					$this->checkout_model->load_wallet($data_to_store['user_id'], $package_name, 'sbv' );
				}*/
				$data_to_store['user_id'] = $sponsor_data[0]['user_id'];
			} else { 
				$data_to_store['user_id'] = 1061;
			}
			$this->checkout_model->load_wallet($data_to_store['user_id'], $coin, 'points' );
			$this->checkout_model->load_children($sponsor_data[0]['user_id'],1,$level);
			$this->checkout_model->add_income($data_to_store);
			$p=50;
			}
			$sponsor = $sponsor_data[0]['parent_id'];
			} else { $p=50; }
			$p++;
			$dis_level++;
	}
	if(!empty($sponsor_data)) {
			$cust_id = $sponsor_data[0]['user_id'];
			if($sponsor_data[0]['level_2'] >= 4 && $sponsor_data[0][ 'user_level' ]==3) {
				$package_level = 3;
				$this->reverse_matrix_income($cust_id,$direct_id,$package_level);
				$this->checkout_model->update_profile($cust_id,array('user_level'=>4));
			}
			if($sponsor_data[0]['level_3'] >= 8 && $sponsor_data[0][ 'user_level' ]==4) {
				$package_level = 4;
				$this->reverse_matrix_income($cust_id,$direct_id,$package_level);
				$this->checkout_model->update_profile($cust_id,array('user_level'=>5));
			}
			if($sponsor_data[0]['level_4'] >= 16 && $sponsor_data[0][ 'user_level' ]==5) {
				$package_level = 5;
				$this->reverse_matrix_income($cust_id,$direct_id,$package_level);
				$this->checkout_model->update_profile($cust_id,array('user_level'=>6));
			}
			if($sponsor_data[0]['level_5'] >= 32 && $sponsor_data[0][ 'user_level' ]==6) {
				$package_level = 6;
				$this->reverse_matrix_income($cust_id,$direct_id,$package_level);
				$this->checkout_model->update_profile($cust_id,array('user_level'=>7));
			}
			if($sponsor_data[0]['level_6'] >= 64 && $sponsor_data[0][ 'user_level' ]==7) {
				$package_level = 7;
				$this->reverse_matrix_income($cust_id,$direct_id,$package_level);
				$this->checkout_model->update_profile($cust_id,array('user_level'=>8));
			}
	}		
}
	
	public function index()
	{
        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'checkout';
        $data['page_title'] = 'Checkout';
		$cust_id = $this->session->userdata('cust_id');
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('address', 'address', 'required|trim'); 
            $this->form_validation->set_rules('city', 'city', 'required|trim');
            $this->form_validation->set_rules('state', 'state', 'required|trim');
            $this->form_validation->set_rules('zip', 'zip', 'required|trim|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$this->session->set_userdata('p_name',$this->input->post('name'));
				$this->session->set_userdata('p_email',$this->input->post('email'));
				$this->session->set_userdata('p_phone',$this->input->post('phone'));
				$this->session->set_userdata('p_address',$this->input->post('address'));
				$this->session->set_userdata('p_address2',$this->input->post('address2'));
				$this->session->set_userdata('p_city',$this->input->post('city'));
				$this->session->set_userdata('p_state',$this->input->post('state'));
				$this->session->set_userdata('p_zip',$this->input->post('zip'));
				$this->session->set_userdata('spl_note',$this->input->post('message'));
				redirect(base_url().'payment');
			}
			
		}
		    $data['category_list'] = $this->customer_model->get_category_list();
		    $data['customer_add'] = $this->customer_model->get_customer_address($cust_id);
	        $data['main_content'] = 'checkout';
            $this->load->view('includes/front/front_template', $data); 

	}

	public function add_pv_income( $cid, $user_level, $reward, $position, $distribution_amount, $cust_id, $order_id, $repurchase) {

		if ( $cid == '0' || $user_level == '0' || $cid == '' ) {
			return '';
		}
		if ( $repurchase == 'yes' ) {
			$sale_type = '2';
		} else {
			$sale_type = '1';
		}
		$caping = 10000000;
		$pv_info = $this->checkout_model->get_pv( $cid, $sale_type );
		$left = $right = $matching = 0;
		if ( !empty( $pv_info ) ) {

			$total_final_pv = 0;
			$date = date( 'Y-m-d' );
			$redeem_pv = $this->checkout_model->get_matching_pv_by_date( $cid, $date );
			$total_final_pv = $this->checkout_model->get_matching_pv( $cid );
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
				/*if($total_final_pv < 50) {
					if ( ( $d_left >= 1 && $d_right >= 2 ) ||  ( $d_left >= 2 && $d_right >= 1 ) )  {
						$first_cut_off = 'true';
					}
					else {
						$add_income = 'false';
					}
				}
				else*/if ( $left >= 1 && $right >= 1 ) {}
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
				$income_pv = (8/100)*$final_total;
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
						$this->checkout_model->add_distribution( $add_pv );
						/**************** matching pv ****************/
						$final_income_pv_dm = $caping - $matching;
						$add_pv = array( 'order_id' => $order_id, 'amount' => $final_income_pv_dm, 'user_id' => $cid, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'pay_level' => '0', 'type' => 'Matching', 'status' => 'Active' );
						$this->checkout_model->add_distribution( $add_pv );
						$this->matching_id[] = $cid;

					}
				}
				if ( $income_pv > 0 && $add_matching_pv == 'true' ) {
					$add_pv = array( 'order_id' => $order_id, 'amount' => $income_pv, 'user_id' => $cid, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'pay_level' => '0', 'type' => $matching_type, 'status' => 'Active' );
					$this->checkout_model->add_distribution( $add_pv );
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
				if ( $carry_forward > 0 ) {
					$add_pv = array( 'order_id' => '0', 'amount' => $carry_forward, 'user_id' => $cid, 'user_id_send_by' => '0', 'sale_type' => $sale_type, 'type' => 'BV ' . $position, 'pay_level' => '0', 'status' => 'Active' );
					$this->checkout_model->add_distribution( $add_pv );
				}
				/****************** update pv status to redeem **************/
				if ( !empty( $update_ids ) ) {
					$this->checkout_model->update_gbv_status_by_ids( $update_ids );
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
				$direct = $this->checkout_model->get_reuser_with_direct_info($direct_id);
				
				if(!empty($direct)) {

				$children = $this->checkout_model->get_reuser_with_direct_info_direct($direct[0]['customer_id']);
				if(!empty($children)) {
					if($children[0]['amount'] >= 30000 && $direct[0]['royality']==0) {
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
							$this->checkout_model->update_profile($direct_id[0]['id'],array('royality'=>1));
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
							$this->checkout_model->update_profile($direct_id[0]['id'],array('royality'=>2));
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
							$this->checkout_model->update_profile($direct_id[0]['id'],array('royality'=>3));
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
							$this->checkout_model->update_profile($direct_id[0]['id'],array('royality'=>4));
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
			  	 $this->checkout_model->insert_batch('team_bussiness',$team_bussiness);
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
				$this->checkout_model->update_profile($cust_id,array('percentage'=>$percentage));
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

        $this->checkout_model->add_data_in_table($add_income,'incomes');

		

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

      //    $this->checkout_model->add_data_in_table($add_transactional,'transaction_wallet');

		// $this->checkout_model->add_reward_points_in_customer($user_id,$amount);

		//}

		

	}
	 
	public function payment()
	{


        $data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'payment';
        $data['page_title'] = 'Payment';  
        $data['coupon_error'] = '';
		$cust_id = $this->session->userdata('cust_id');
		if($cust_id!='') { 
			$data['profile'] = $this->checkout_model->get_reuser_with_direct_info($cust_id);
			$user = $data['profile'][0];
			//redirect(base_url().'checkout'); 
		} else {
                   $this->session->set_flashdata('flash_message', 'need_login');
	           redirect(base_url().'checkout');
                }
		
		//echo '<pre>'; print_r($this->session->userdata()); die();
		
		$ccavenue = $paytm = $razorpay = 'false'; 	
					
		$data['veryfied_msg']="false"; $data['veryfied_msg_otp'] = ''; $data['veryfied_no_expire'] = '';
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			
            //form validation
            $this->form_validation->set_rules('p_name', 'name', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('p_email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('p_phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('p_address', 'address', 'required|trim'); 
            $this->form_validation->set_rules('p_city', 'city', 'required|trim');
            $this->form_validation->set_rules('p_state', 'state', 'required|trim');
            $this->form_validation->set_rules('p_zip', 'zip', 'required|trim|numeric');

			if($data['profile'][0]['bliss_amount'] < $this->session->userdata('order_total') && $this->input->post('how_to_pay')!='paytm' && $this->input->post('how_to_pay')!='razorpay') {
				$this->form_validation->set_rules('bliss_perk_error', 'bliss_perk_error', 'required|trim');
				$this->form_validation->set_message('required', 'Your Wallet amount is less then your order.');
              }
             /*else if($data['profile'][0]['consume'] == 0 && $this->session->userdata('comm_dis') < 50) {
				$this->form_validation->set_rules('bliss_perk_error', 'bliss_perk_error', 'required|trim');
				$this->form_validation->set_message('required', 'First Purchase must be of minimum 50 BV.');
              }*/
		   
		   //echo '<pre>'; print_r($this->input->post()); die();
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  
				$cart = $this->cart->contents();
                $items = json_encode($cart);
				$coupon = $this->session->userdata('coupon_code');
				$coupon_val = $this->session->userdata('coupon_val');
				$distribution_amount = $this->session->userdata('comm_dis') + 0;
				$reward_point = $this->session->userdata('reward_point') + 0;
				$total_sbv = $data['profile'][0]['sbv']+$distribution_amount;
				//start the transaction
        		//$this->db->trans_begin();
				if($cust_id =='' || $cust_id ==' ') { $cust_id = 0; }
				$repurchase = '';
				$direct_id = $user['did']; 

				if($this->input->post('how_to_pay')=='paytm') { $status= 'Process'; $paytm = 'true'; }
				if($this->input->post('how_to_pay')=='razorpay') { $status= 'Process'; $razorpay = 'true'; }
				else{ $status = 'Pending'; }
		        $data_to_store = array(
					'user_id' => $cust_id,
                     'p_name' => $this->input->post('p_name'),
					 'p_email' => $this->input->post('p_email'), 
					 'p_phone' => $this->input->post('p_phone'),
					 'p_address' => $this->input->post('p_address'),
					 'p_address2' => $this->input->post('p_address2'),
					 'p_city' => $this->input->post('p_city'),
					 'p_state' => $this->input->post('p_state'),
					 'p_zip' => $this->input->post('p_zip'),
					 'spl_note' => $this->input->post('message'),
					 'how_to_pay' => $this->input->post('how_to_pay'),
                     'shipping' => $this->session->userdata('order_shipping'),
                     'tax' => $this->session->userdata('order_tax'),
                     'total_amount' => $this->session->userdata('order_total'),
					 'comm_dis' => $distribution_amount,
					 'items' => $items,
					 'coupon_val' => $coupon_val,
					 'coupon' => $coupon,
					 'status' => $status,
					 'o_date' => date('Y-m-d H:i:s')
					 ); 
			  	$order_id = $this->checkout_model->add_order($data_to_store);


				  	if(!empty($cart)) {
							foreach($cart as $car) {
								$this->checkout_model->update_stock($car['id'],$car['qty'],'p_qty');
						}
					}
					$package_level = 1; $p_amount = 1000;
					if($this->input->post('how_to_pay')=='wallet') {
						$this->payment_distribution($user);
					}

				/*if($user['consume']==0) {
				if($user['ddirect'] == 0) {
				$position = 'X';
				$direct_income = (10/100)*$distribution_amount;
				$package_array = array('position'=>'X');
				$this->checkout_model->update_profile($cust_id,$package_array);
				}
				elseif($user['ddirect'] == 1) {
				$position = 'Y';
				$direct_income = (10/100)*$distribution_amount;
				$package_array = array('position'=>'Y');
				$this->checkout_model->update_profile($cust_id,$package_array);
				}
				else {
				$position = 'Z';
				$direct_income = (45/100)*$distribution_amount;
				$package_array = array('position'=>'Z');
				$this->checkout_model->update_profile($cust_id,$package_array);
				}
				} 
				else {
					if($user['position']=='X' || $user['position']=='Y') {
						$direct_income = (10/100)*$distribution_amount;
					} else { $direct_income = (45/100)*$distribution_amount; }
					$position = $user['position'];
					
				}

				$direct_customer_id = $user['direct_customer_id'];
				$p=0;
				$dis_level=1;
				$depth_level=1;
				$depth_inc = TRUE;
				if($position!='Z') {
				while($p<1) {
					
					$direct_parent = $this->checkout_model->parent_profile($direct_customer_id);
					if(!empty($direct_parent)) {
						$get_rank = '';

						if($position=='Z' && $dis_level > 1 && $depth_inc==TRUE) {

							$dis_amount = (10/100)*$distribution_amount;
							$add_income = array('amount'=>$dis_amount,'user_id'=>$direct_parent[0]['id'],'type'=>'Depth income','user_send_by'=>$cust_id,'pay_level'=>$dis_level,'status'=>'Active');
							$this->checkout_model->add_income($add_income);
							$depth_inc = FALSE; $p++;
						}
						if($direct_parent[0]['direct_customer_id']=='') { $p++; }
						$direct_customer_id = $direct_parent[0]['direct_customer_id'];
						$position = $direct_parent[0]['position'];
						$dis_level++;
					}
					else { $p++; }
					
					
				}
			}*/
				
				  
			  /**************** end payment distribution *******************/
			
		
				if($this->input->post('how_to_pay')=='wallet') { 
				    $updated_amount = $data['profile'][0]['bliss_amount'] - $this->session->userdata('order_total') + 0;
				    $cashback_amount = $data['profile'][0]['cashback_amount'] + $this->session->userdata('order_total') + 0;
				    $data_profile_array = array('bliss_amount'=>$updated_amount);
				   	//$this->checkout_model->load_wallet( $user[ 'did' ], $distribution_amount, 'direct_sale' );
				    $this->checkout_model->update_profile($cust_id,$data_profile_array);
				    if($reward_point > 0) {
				    	$data_to_store = array(
							'user_id' => $cust_id,
							'send_to' => $cust_id,
							'status' => 'Debit',
							'wallet_type ' => 'Reward Point',
							'amount ' => $reward_point
						);
						$this->checkout_model->add_transactions($data_to_store);
				    }
				    
				    /*if($distribution_amount > 0) {
						$data_to_store = array(
								'user_id' => $cust_id,
								'send_to' => $cust_id,
								'status' => 'Credit',
								'wallet_type ' => 'Point',
								'amount ' => $distribution_amount
						);
						$this->checkout_model->add_transactions($data_to_store);
					}*/


				    //make transaction complete
        			/*$this->db->trans_complete();
        			//check if transaction status TRUE or FALSE
			        if ($this->db->trans_status() === FALSE) {
			            //if something went wrong, rollback everything
			            $this->db->trans_rollback();
			        } else {
			            //if everything went right, commit the data to the database
			            $this->db->trans_commit();
			            $return = TRUE;
			        }	*/
			      	//die();
				   // $this->checkout_model->load_wallet_by_repurchase($cust_id,$distribution_amount,'sbv');
					$this->session->set_userdata('how_to_payment','wallet');
					$this->session->set_userdata('last_order_id',$order_id);
					$phone = $this->input->post('p_phone');
					$this->session->set_userdata('phone_msg',$phone);
					redirect(base_url().'thankyou');
				}
			}
			
		}
		
		if($paytm == 'true') {  
		$this->session->set_userdata('how_to_payment','paytm');
		$data['order_id'] = $order_id;
		$data['user_id'] = $cust_id;
		$data['order_amt'] = $this->session->userdata('order_total');
		$data['oname'] = $this->input->post('p_name');
		$data['phone'] = $this->input->post('p_phone');
		$data['email'] = $this->input->post('p_email'); 
		$data['callback'] = base_url()."paymentresponce/".$cust_id ;
		$data['main_content'] = 'admin/paytmredirect'; 
		}
		elseif($razorpay == 'true') {
		$this->session->set_userdata('how_to_payment','razorpay');
		$data['order_id'] = $order_id;
		$data['user_id'] = $cust_id;
		$data['order_amt'] = $this->session->userdata('order_total');
		$data['oname'] = $this->input->post('p_name');
		$data['phone'] = $this->input->post('p_phone');
		$data['email'] = $this->input->post('p_email');
		$data['callback'] = "checkout/callback/".$cust_id;
		$data['returnuri'] = "payment";
		$data['main_content'] = 'admin/razorpay'; 
		} else {
			$data['main_content'] = 'payment';
		}
		$data['category_list'] = $this->customer_model->get_category_list();
        $this->load->view('includes/front/front_template', $data); 

	}


	



	function repurchase_level_income($direct_customer_id,$distribution_amount,$cust_id) {
					$p = 0;
					$dis_level = 1;
					$dis_income2 = array(3,2,1,1,1);
					while($p<5) {
						$direct_user = $this->checkout_model->profile_by_customer_id($direct_customer_id);
						if(!empty($direct_user)) {
									$data_to_store = array(
									'user_id' => $direct_user[0]['id'],
									'type' => 'Level Income',
									'pay_level' => $dis_level,
									'amount' => round(($dis_income2[$p]/100)*$distribution_amount,2),
									'status ' => 'Active',
									'user_send_by ' => $cust_id
									);
									$this->checkout_model->add_income($data_to_store);
								
							$p++;
							$dis_level++;
							$direct_customer_id = $direct_user[0]['direct_customer_id'];
						} else { $p = 40; }
					}
	}



	
	
	public function thankyou()
	{
		
            $data['page_keywords'] = '';
            $data['page_description'] = '';
            $data['page_slug'] = 'thankyou';
            $data['page_title'] = 'Thank you';  
			$send_msg = 'false';
			$send_msg_order = '';	
			$data['message'] = 'Thank you for shopping with us. We will be shipping your order to you soon.';
				
				
		 if($this->session->userdata('how_to_payment')=='emi_payment' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. We will be shipping your order to you soon. Your order ID is #".$order_id;
			 $this->checkout_model->update_emi_status($order_id);
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }	
		 elseif($this->session->userdata('how_to_payment')=='wallet' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. Your Wallet has been charged and your transaction is successful. We will be shipping your order to you soon. Your order ID is #".$order_id;
			 $this->checkout_model->update_distribution_status($order_id);
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }
		 elseif($this->session->userdata('how_to_payment')=='paytm' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. Your transaction is successful. We will be shipping your order to you soon. Your order ID is #".$order_id;
			 $this->checkout_model->update_distribution_status($order_id);
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }
		 elseif($this->session->userdata('how_to_payment')=='razorpay' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. Your transaction is successful. We will be shipping your order to you soon. Your order ID is #".$order_id;
			 $this->checkout_model->update_distribution_status($order_id);
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }	
		 elseif($this->session->userdata('how_to_payment')=='cod' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. Your transaction is successful. We will be shipping your order to you soon. Your order ID is #".$order_id;
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }		
         elseif($this->session->userdata('how_to_payment')=='coupon' && $this->session->userdata('last_order_id')!='') {
			 $order_id = $this->session->userdata('last_order_id');
			 $data['message'] = "Thank you for shopping with us. We will be shipping your order to you soon. Your order ID is #".$order_id;
		//	 $this->checkout_model->update_distribution_status($order_id);
			 $this->cart->destroy();
			 $send_msg = 'true'; $send_msg_order = $order_id;
		 }		 
         elseif(isset($_POST['encResp']) && $_POST['encResp']!='') {
			 $working_key = 'F534EEE73E7A9AC7ED35376A2AFDD378';//Shared by CCAVENUES
			$encResponse = $_POST["encResp"];	//This is the response sent by the CCAvenue Server
			$rcvdString = $this->decrypt($encResponse,$working_key);//Crypto Decryption used as per the specified working key.
			$order_status = $order_id = "";
			$decryptValues = explode('&', $rcvdString);
			$dataSize = sizeof($decryptValues);
			for($i = 0; $i < $dataSize; $i++) {
				$information = explode('=',$decryptValues[$i]);
				if($i==0) {	$order_id = $information[1]; }
				if($i==3) {	$order_status=$information[1]; }
			}

			if($order_status==="Success") {
				$emi_payment_msg = $this->session->userdata('emi_payment');
				if($emi_payment_msg=='yes') {
					$data['message'] = "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be ship your order after your 2nd installment. Your order ID is #".$order_id;
				} else {
					$data['message'] = "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon. Your order ID is #".$order_id;
				}
				
				$this->checkout_model->update_distribution_status($order_id);
				$this->cart->destroy();
				$send_msg = 'true';  $send_msg_order = $order_id;
			}
			else if($order_status==="Aborted") {
				$data['message'] = "Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
			}
			else if($order_status==="Failure") {
				$data['message'] = "Thank you for shopping with us.However,the transaction has been declined.";
			}
			else {
				$data['message'] = "Security Error. Illegal access detected"; 
			} 
		 }
	     /******************* send order message *********************/
	     /* $phone = $this->session->userdata('phone_msg');
	    if($send_msg == 'true' && $phone != '') {
			 $sms_msg = urlencode("Your order has been successfully placed. Order ID is #".$send_msg_order.".\n
Thank you
Team Blisszon");  
					$smstext = "http://sms.digimiles.in/bulksms/bulksms?username=di78-blisszon&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=BLISSZ&message=".$sms_msg;
					file_get_contents($smstext);
		} */
		      
		        $this->session->unset_userdata('no_veryfied','');
				$this->session->unset_userdata('otp_number','');
				
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'thankyou';
            $this->load->view('includes/front/front_template', $data); 
	}
	 

	public function get_user_limit($userid) {
		$bliss_code =  $this->session->userdata('bliss_id');
		$cust_id = $this->session->userdata('cust_id');
		$distributor_amount = $this->checkout_model->get_distributer_amount_by_userid($userid);
		$dist_amount = 0;
		if(!empty($distributor_amount)) {
			foreach($distributor_amount as $val) {
				if($val['status']!='Pending') { $dist_amount = $dist_amount + $val['amount']; }
			}
		}
		
		$orderId = '';
		$child_id_array = array();
		$ciruserlimit = 0;
		$child_ids = $this->checkout_model->get_child_id($bliss_code);
		foreach($child_ids as $childid) {
			$child_id_array[] = $childid['id']; 
		}
		if(!empty($child_id_array)){
        $circle_order = $this->checkout_model->my_first_circle_order($child_id_array);
		$cirorder = array(); 
		if(!empty($circle_order)) {
			foreach($circle_order as $cir_oder) {
			  if($cir_oder['status']!='Pending') {
				if(in_array($cir_oder['user_id'],$cirorder)){ $ciruserlimit = $ciruserlimit + 2000; } 
				else {	$cirorder[] = $cir_oder['user_id'];
				$ciruserlimit = $ciruserlimit + 4000; } 
				$orderId .= $cir_oder['id'].'('.$cir_oder['user_id'].') '; 
			  }
			}
		} 
		}
		
		return array('limit'=>$ciruserlimit,'amount'=>$dist_amount,'order'=>$orderId);
	}
	

	function hextobin($hexString) 
   	 { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) 
        	{       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 
        	    if ($count==0) { $binString = $packedString; } 
        	    else { $binString .= $packedString; }  
		    $count+=2; 
        	} 
  	        return $binString; 
    	  } 
	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}
	function decrypt($encryptedText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=$this->hextobin($encryptedText);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
	 	mcrypt_generic_deinit($openMode);
		return $decryptedText;
		
	}
	function encrypt($plainText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = $this->pkcs5_pad($plainText, $blockSize);
	  	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
		      $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	      mcrypt_generic_deinit($openMode);
		      			
		} 
		return bin2hex($encryptedText);
	}
	public function paytmpaymentresponce() {   
    
	require_once("./././paytmkit/lib/config_paytm.php");
	require_once("./././paytmkit/lib/encdec_paytm.php");

	$cust_id = $this->uri->segment(2);
	$is_valid = $this->checkout_model->super_admin_validate_by_id($cust_id);
	if($is_valid['login']=='true')
		{
			$data = array('full_name'=>$is_valid['full_name'], 'email'=>$is_valid['email'], 'bliss_id'=>$is_valid['bliss_id'],  'cust_id'=>$is_valid['cust_id'], 'cust_img'=>$is_valid['cust_img'], 'is_customer_logged_in' => true);
	        $this->session->set_userdata($data);
		}


	$paytmChecksum = "";
	$paramList = array();
	$isValidChecksum = "FALSE";
	$paramList = $_POST;
	$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
	//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
	$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string
	
	//echo '<pre>'; print_r($_POST); die();
	if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";

	if ($_POST["STATUS"] == "TXN_SUCCESS") {
			$cust_id = $this->uri->segment(2);
			$data['profile'] = $this->checkout_model->get_reuser_with_direct_info($cust_id);
			$user = $data['profile'][0];
			$this->payment_distribution($user);
			$merchant_order_id = $this->input->post('ORDERID');
			$this->session->set_userdata('last_order_id',$merchant_order_id);
			$data_profile_array = array('status'=>'Approved','how_to_pay'=>'paytm');
			$this->checkout_model->update_distribution_status($merchant_order_id);
			redirect(base_url().'thankyou');
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
		redirect(base_url().'payment');
	}
}
else {
	echo "<b>Checksum mismatched.</b>";
	redirect(base_url().'payment');
	//Process transaction as suspicious.
}  
      
      
      
      
    }


    private function get_curl_handle($payment_id, $amount)  {
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = RAZOR_KEY_ID;
        $key_secret = RAZOR_KEY_SECRET;
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }

    // callback method

    public function callback() {        
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_amount');
            $success = false;
            $error = '';
            try {                
                $ch = $this->get_curl_handle($razorpay_payment_id, $this->input->post('merchant_total'));
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    echo $error = 'Curl error: '.curl_error($ch);
                } else {
                    	$response_array = json_decode($result, true);
                    	/*echo '<pre>'; print_r($this->input->post());
                    	echo '<pre>'; print_r($response_array); die();*/
                        //Check success response
                        if ($http_status === 200 && isset($response_array['error']) === false) {
                            $success = true;//echo 'success ';
        					$cust_id = $this->uri->segment(3);
							$data['profile'] = $this->checkout_model->get_reuser_with_direct_info($cust_id);
							$user = $data['profile'][0];
							$this->payment_distribution($user);
							$this->session->set_userdata('last_order_id',$merchant_order_id);
							$data_profile_array = array('status'=>'Approved','how_to_pay'=>'paytm');
							$this->checkout_model->update_distribution_status($merchant_order_id);
							redirect(base_url().'thankyou');

                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                            $this->session->set_flashdata('flash_message', 'not_updated');
    						redirect('payment'); 
                        }
                }

                //close connection 

                curl_close($ch);//die();

            } catch (Exception $e) {

                $success = false;

                $error = 'OPENCART_ERROR:Request to Razorpay Failed';

            }

            if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                }
				$this->session->set_flashdata('flash_message', 'updated');
                if (!$order_info['order_status_id']) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }
            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
		redirect(base_url('payment'));
    }
    
	
}