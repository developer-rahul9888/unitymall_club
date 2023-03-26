<?php
if ( !defined( 'BASEPATH' ) )exit( 'No direct script access allowed' );
class Profile extends CI_Controller {
	private $left_user = array();
	private $right_user = array();
	public function __construct() {
		parent::__construct();

		$this->load->library( 'session' );
		$this->load->helper( 'url' );
		$this->load->helper( 'form' );
		$this->load->library( 'form_validation' );
		$this->load->model( 'Users_model' );
		

		if ( !$this->session->userdata( 'is_customer_logged_in' ) ) {
			redirect( base_url() . '' );
		}

	}

	public function pin_transfer() {


		$data[ 'page_keywords' ] = '';
		$data[ 'page_description' ] = '';
		$data[ 'page_slug' ] = 'profile';
		$data[ 'page_title' ] = 'Profile';


		$data[ 'myfriends' ] = array();
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );
		$data[ 'profile' ] = $this->Users_model->profile( $id );

		/*if save button was clicked, get the data sent via post*/
		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' ) {
			/*form validation*/
			$this->form_validation->set_rules( 'assign_to', 'assign to', 'required|trim' );
			$this->form_validation->set_rules( 'pins', 'No. of E-Pin', 'required|trim|numeric' );



			$user = $this->Users_model->get_customer_by_id( $this->input->post( 'assign_to' ) );
			if ( empty( $user ) ) {
				$this->form_validation->set_rules( 'start_date', '', 'required' );
				$this->form_validation->set_message( 'required', 'This user is not exist' );
			}
			if ( !empty( $user ) && $user[ 0 ][ 'consume' ] == '1' && $this->input->post( 'pinid' ) == '0' ) {
				$this->form_validation->set_rules( 'start_date', '', 'required' );
				$this->form_validation->set_message( 'required', 'This user is already active' );
			}
			if ( !empty( $user ) && $this->input->post( 'pins' ) > 1 && $this->input->post( 'pinid' ) == '0' ) {
				$this->form_validation->set_rules( 'start_date', '', 'required' );
				$this->form_validation->set_message( 'required', 'You can not send 0 pin more then 1' );
			}

			$pinid = $this->input->post( 'pinid' );
			$number_of_pins = $this->input->post( 'pins' );
			$countpin = $this->Users_model->count_available_pins( $pinid, $number_of_pins, $customer_id );

			//print_r($countpin);
			if ( count( $countpin ) < $number_of_pins ) {
				$this->form_validation->set_rules( 'epins', '', 'required' );
				$this->form_validation->set_message( 'required', 'Pins not available' );
			}



			$this->form_validation->set_error_delimiters( '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>' );
			//if the form has passed through the validation
			if ( $this->form_validation->run() ) {


				$pin_history = array();
				if ( !empty( $countpin ) ) {
					foreach ( $countpin as $value ) {

						$data_to_store = array(
							'assign_to' => $user[ 0 ][ 'customer_id' ]
						);
						$return = $this->Users_model->update_trnsfr_pin( $value[ 'id' ], $data_to_store );

						$pin_history[] = array( 'pinid' => $value[ 'id' ], 'status' => 'Active', 'amount' => $value[ 'p_amount' ], 'assign_to' => $user[ 0 ][ 'customer_id' ], 'assign_from' => $customer_id );

					}

					$this->Users_model->insert_batch( 'pins_transfer', $pin_history );
				}

				if ( $return == TRUE ) {
					$this->session->set_flashdata( 'flash_message', 'updated' );
					redirect( 'admin/pin_transfer' );
				} else {
					$this->session->set_flashdata( 'flash_message', 'not_updated' );
				}


			} /*validation run*/

		}


		//if we are updating, and the data did not pass trough the validation
		//the code below wel reload the current data

		$data[ 'package' ] = $this->Users_model->get_all_package( 'active' );
		// print_r( $data['package']); die();
		//$data['pin'] = $this->coupon_model->get_all_pin_id($); 
		//load the view
		$data[ 'main_content' ] = 'admin/pin_update';
		$this->load->view( 'includes/admin/template', $data );
	}
public function uploadreceipts() {
			 $data['page_keywords'] = '';
			$data['page_description'] = '';
			$data['page_slug'] = 'Receipt list';
			$data['page_title'] = 'Receipt list'; 
			$id = $this->session->userdata('cust_id');
			$data['profile'] = $this->Users_model->profile($id);
			
			$customer_id = $this->session->userdata('bliss_id');
			
			
		$data['all_receipt'] = 	$this->Users_model->get_receipt_order($customer_id);
		$data['main_content'] = 'admin/receipts_list';
		$this->load->view('includes/admin/template', $data);
	
	}

		public function addreceipts() {
		
				$data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'Add Receipt';
                $data['page_title'] = 'Add Receipt'; 
				$id = $this->session->userdata('cust_id');
				$data['profile'] = $this->Users_model->profile($id);
				$customer_id = $this->session->userdata('bliss_id');
		 		

			if ($this->input->server('REQUEST_METHOD')) {	 
				 
				$this->form_validation->set_rules('websites', 'Website Name', 'trim|required');
				$this->form_validation->set_rules('p_name', 'Product Name', 'trim|required');
				$this->form_validation->set_rules('amount', 'Amount', 'required');
				$this->form_validation->set_rules('p_discription', 'Description', 'required');
			
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
			
				$image = '';
				$config['upload_path'] ='images/receipt/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				
			   if ($this->upload->do_upload('image')) { 
					  
						 $image_data = $this->upload->data();
						$image = $image_data['file_name'];
					}
						
					if($this->form_validation->run() == FALSE){
													
					}else{
						$data_to_store = array(
						'website' => $this->input->post('websites'),
						'product' => $this->input->post('p_name'),
						'amount' => $this->input->post('amount'),
						'description' => $this->input->post('p_discription'),
						'customer_id' => $customer_id,
						'image' => $image,
						
						); 
						$this->load->model('Users_model');
						
						if($this->Users_model->add_receipt($data_to_store) == TRUE){
							
							$this->session->set_flashdata('flash_message', 'updated');
							
						return 	redirect('admin/uploadreceipts/add');
							
						}else{
							
							$this->session->set_flashdata('flash_message', 'not_updated');
						}
					}
				
			}
			
			$data['main_content'] = 'admin/add_receiptst'; 
			$this->load->view('includes/admin/template', $data); 
	
	
		}
		
public function activity_log() {
				$id = $this->session->userdata('cust_id');
				$data['profile'] = $this->Users_model->profile($id);
				$customer_id = $this->session->userdata('bliss_id');			
    	
	$data['activity_log'] = $this->Users_model->activity_log($customer_id);
	
	//load the view
      $data['main_content'] = 'admin/activity_log';
      $this->load->view('includes/admin/template', $data);   
  }	 
	public function index() {
		$data[ 'page_keywords' ] = '';
		$data[ 'page_description' ] = '';
		$data[ 'page_slug' ] = 'profile';
		$data[ 'page_title' ] = 'Profile';

		$url = $this->uri->segment( 1 );
		if ( $url == 'admin' ) {
			redirect( base_url( 'distributor' ) );
		}

		$data[ 'myfriends' ] = array();
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );
		//print_r($customer_id);die();
		$data['profile'] = $this->Users_model->profile( $id );
		$data['sponser'] = $this->Users_model->parent_profile($data['profile'][0]['direct_customer_id']);
		//echo '<pre>'; print_r($data['sponser']); die();


		$data[ 'rhistory' ] = array(); //$this->Users_model->rewardhis($id);

		/************ friend level 1 ******************/
		$myfriends = $this->Users_model->my_friends( $customer_id );
		$data[ 'left_user' ] = $data[ 'right_user' ] = 0;
		$myfriendid = array( $id );
		if ( !empty( $myfriends ) ) {
			foreach ( $myfriends as $friend ) {
				if ( $friend[ 'position' ] == 'power' ) {
					$data[ 'left_user' ] = $data[ 'left_user' ] + 1;
				}
				if ( $friend[ 'position' ] == 'other' ) { 
					$data[ 'right_user' ] = $data[ 'right_user' ] + 1;
				}
			}
		}

		$ciruserlimit = 0;

		$data[ 'ciruserlimit' ] = $ciruserlimit;

		$data[ 'products' ] = $this->Users_model->my_orders( $id );
		$data[ 'bliss_amount' ] = $this->Users_model->get_pv_by_id( $id );
		$data[ 'total_incomes' ] = $this->Users_model->total_incomes( $id );
		$data[ 'left_bv' ] = $this->Users_model->get_bv_left( $id );
		//print_r($data[ 'left_bv' ]);die();
		$data[ 'right_bv' ] = $this->Users_model->get_bv_right( $id );
		$data[ 'redeem_amount' ] = $this->Users_model->bliss_perk_redeem_amount( $id );
		$data['team_bussiness'] = $this->Users_model->my_team_bussiness($id);
		$data[ 'directs' ] = $this->Users_model->get_direct_user_ids( $customer_id );
		$data[ 'bliss_perk_history' ] = ''; 

		$data[ 'redeem_error' ] = '';
		$data['get_popup'] = $this->Users_model->get_popup();
		$data['fech_news'] = $this->Users_model->fech_news();



		$my_first_level = $this->Users_model->my_friends($customer_id);
		$left_ids = $right_ids = array();
		$active_left = $active_right = 0;
		if(!empty($my_first_level)) {
			foreach($my_first_level as $level) {
					$left_ids[] = $level;
					$ids = array($level['customer_id']);
					$p=0;
					while($p<1) {
						$myfriends = $this->Users_model->my_friends_in($ids);
						if(!empty($myfriends)) {
						$left_ids = array_merge($left_ids,$myfriends);

						$ids = array_column($myfriends, 'customer_id');
						} else { $p++; }
					}

				

				
			}
		}

		//echo '<pre>'; print_r($left_ids); die();
		$left_count = array_column($left_ids, 'consume');
		//echo '<pre>'; print_r($left_count); die();
		$left_consume = array_count_values($left_count);


		$data['left_consume'] = $left_consume;


		$data[ 'main_content' ] = 'admin/admin_welcome';
		$this->load->view( 'includes/admin/template', $data );
	}

	public function get_friend_by_id( $customer_id ) {
		$return = array( 'name' => '', 'friends' => '', 'return' => 'false' );
		$myfriends = $this->Users_model->my_friends( $customer_id );
		if ( !empty( $myfriends ) ) {
			foreach ( $myfriends as $friend ) {
				$inner_friends_array = $this->Users_model->my_friends( $friend[ 'customer_id' ] );
				$inner_friends = count( $inner_friends_array );
				$return = array( 'name' => $friend[ 'f_name' ] . ' ' . $friend[ 'l_name' ], 'friends' => $inner_friends, 'return' => 'true' );
			}
		}
		return $return;
	} 

     public function profile() {
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );

		if ( $this->input->server( 'REQUEST_METHOD' ) ) {
			/*form validation*/
			$this->form_validation->set_rules( 'f_name', 'first name', 'required|trim|min_length[2]' );
			//   $this->form_validation->set_rules('l_name', 'last name', 'required|trim|min_length[2]');
			//   $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');
			//   $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');


			$this->form_validation->set_error_delimiters( '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>' );

			//if the form has passed through the validation
			if ( $this->form_validation->run() ) {
				// file upload start here
				$image = '';
				$config[ 'upload_path' ] = 'images/user/';
				$config[ 'allowed_types' ] = 'gif|jpg|png|jpeg';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				$this->load->library( 'upload', $config );
				if ( $this->upload->do_upload( 'image' ) ) {
					if ( $this->input->post( 'image_old' ) != '' )unlink( 'images/user/' . $this->input->post( 'image_old' ) );
					$image_data = $this->upload->data();
					$image = $image_data[ 'file_name' ];
					$var_status = $this->input->post( 'var_status' );
				} else {
					$image = $this->input->post( 'image_old' );
				}



				$data_to_store = array(
					'f_name' => $this->input->post( 'f_name' ),
					'l_name' => $this->input->post( 'l_name' ),
					'image' => $image,
					'gender' => $this->input->post( 'gender' ),
					'dob' => $this->input->post( 'dob' ),
					'phone' => $this->input->post( 'phone' ),
					'address' => $this->input->post( 'address' ),
					'city' => $this->input->post( 'city' ),
					'state' => $this->input->post( 'state' ),
					'pincode' => $this->input->post( 'pincode' ),
					'nominee' => $this->input->post( 'nominee' ),
					'nominee_rel' => $this->input->post( 'nominee_rel' ),
					'nominee_dob' => $this->input->post( 'nominee_dob' ),

				);
				$return = $this->Users_model->update_profile( $id, $data_to_store );

				if ( $return == TRUE ) {
					$this->session->set_flashdata( 'flash_message', 'updated' );
					redirect( base_url() . 'admin/profile' );
				} else {
					$this->session->set_flashdata( 'flash_message', 'not_updated' );
				}


			} /*validation run*/

		}

		$data[ 'profile' ] = $this->Users_model->profile( $id );
		//load the view
		$data[ 'main_content' ] = 'admin/profile';
		$this->load->view( 'includes/admin/template', $data );
	} 
 
	public function pins() {
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );
		$user = $this->Users_model->profile( $id );
		$data[ 'profile' ] = $user;
		$data[ 'pin_error' ] = '';

		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' && $this->input->post( 'profile_tr_pin' ) != '' ) {

			$profile_tr_pin = $this->input->post( 'profile_tr_pin' );
			$trpin = md5( $profile_tr_pin );
			if ( $user[ 0 ][ 'tr_pin' ] == $trpin ) {
				$this->session->set_userdata( 'profile_tr_pin', 'profile_tr_pin' );
			} else {
				$data[ 'pin_error' ] = '<div class="alert alert-danger"><strong>Error!</strong> Your PIN is wrong. Please try again.</div>';
			}
		}
		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' && $this->input->post( 'logout_tr_pin' ) == 'yes' ) {
			$this->session->set_userdata( 'profile_tr_pin', '' );
		}

		$pin_code = $this->uri->segment( 3 );
		if ( $pin_code != '' ) {
			redirect( base_url( 'admin/pin_activate/' . $pin_code ) );
		}

		$data[ 'pin' ] = $this->Users_model->get_all_pin( $customer_id );


		//load the view
		$data[ 'main_content' ] = 'admin/pins';
		$this->load->view( 'includes/admin/template', $data );
	}

	public function repurchase_pins() {
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );
		$user = $this->Users_model->profile( $id );
		$data[ 'profile' ] = $user;
		$data[ 'pin_error' ] = '';

		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' && $this->input->post( 'profile_tr_pin' ) != '' ) {

			$profile_tr_pin = $this->input->post( 'profile_tr_pin' );
			$trpin = md5( $profile_tr_pin );
			if ( $user[ 0 ][ 'tr_pin' ] == $trpin ) {
				$this->session->set_userdata( 'profile_tr_pin', 'profile_tr_pin' );
			} else {
				$data[ 'pin_error' ] = '<div class="alert alert-danger"><strong>Error!</strong> Your PIN is wrong. Please try again.</div>';
			}
		}
		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' && $this->input->post( 'logout_tr_pin' ) == 'yes' ) {
			$this->session->set_userdata( 'profile_tr_pin', '' );
		}

		$data[ 'pin' ] = $this->Users_model->get_all_pin( $customer_id, '1' );


		$data[ 'main_content' ] = 'admin/repurchase_pins';
		$this->load->view( 'includes/admin/template', $data );
	}

	public function add_pv_income( $cid, $caping, $user_level, $reward, $position, $distribution_amount, $cust_id, $order_id, $repurchase, $lbv, $rbv, $count_left, $count_right, $left_child, $right_child ) {

		if ( $cid == '0' || $user_level == '0' || $cid == '' || $left_child == '0' || $right_child == '0' ) {
			return '';
		}
		if ( $repurchase == 'yes' ) {
			$sale_type = '2';
		} else {
			$sale_type = '1';
		}
		$pv_info = $this->Users_model->get_pv( $cid, $sale_type );
		$left = $right = $matching = 0;
		if ( !empty( $pv_info ) ) {

			$total_final_pv = 0;
			$date = date( 'Y-m-d' );
			$redeem_pv = $this->Users_model->get_matching_pv_by_date( $cid, $date );
			$total_final_pv = $this->Users_model->get_matching_pv( $cid );
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
			if ( $sale_type == '1' ) {
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
				$income_pv = ( $user_level / 100 ) * $final_total;
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
						$this->Users_model->add_distribution( $add_pv );
						/**************** matching pv ****************/
						$final_income_pv_dm = $caping - $matching;
						$add_pv = array( 'order_id' => $order_id, 'amount' => $final_income_pv_dm, 'user_id' => $cid, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'pay_level' => '0', 'type' => 'Matching', 'status' => 'Active' );
						$this->Users_model->add_distribution( $add_pv );
						$this->matching_id[] = $cid;

					}
				}
				if ( $income_pv > 0 && $add_matching_pv == 'true' ) {
					$add_pv = array( 'order_id' => $order_id, 'amount' => $income_pv, 'user_id' => $cid, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'pay_level' => '0', 'type' => $matching_type, 'status' => 'Active' );
					$this->Users_model->add_distribution( $add_pv );
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

					$this->income[] = array( 'user_id' => $cid, 'amount' => $final_income, 'tds' => $final_income / 20, 'admin' => $final_income / 20, 'net_income' => ( 9 / 10 ) * $final_income, 'user_send_by' => $cust_id );
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
					$this->Users_model->add_distribution( $add_pv );
				}
				/****************** update pv status to redeem **************/
				if ( !empty( $update_ids ) ) {
					$this->Users_model->update_gbv_status_by_ids( $update_ids );
				}

				/*$m_reward = '';
				if ( $position == 'left' ) {
					$lbv = $lbv + $distribution_amount;
				} else {
					$rbv = $rbv + $distribution_amount;
				}

				if ( ( $lbv >= 1600 && $rbv >= 800 ) || ( $rbv >= 1600 && $lbv >= 800 ) ) {

					$data_to_store = array(
						'user_id' => $cid,
						'desciption' => 1,
						'status' => 'Active'
					);
					$this->Users_model->add_data( $data_to_store );


				}

				if ( ( $lbv >= 5600 && $rbv >= 4800 ) || ( $rbv >= 5600 && $lbv >= 4800 ) ) {

					$data_to_store = array(
						'user_id' => $cid,
						'desciption' => 2,
						'status' => 'Active'
					);
					$this->Users_model->add_data( $data_to_store );

				}

				if ( ( $lbv >= 25600 && $rbv >= 24800 ) || ( $rbv >= 25600 && $lbv >= 24800 ) ) {

					$data_to_store = array(
						'user_id' => $cid,
						'desciption' => 3,
						'status' => 'Active'
					);
					$this->Users_model->add_data( $data_to_store );

				}
				if ( ( $lbv >= 125600 && $rbv >= 124800 ) || ( $rbv >= 125600 && $lbv >= 124800 ) ) {

					$data_to_store = array(
						'user_id' => $cid,
						'desciption' => 4,
						'status' => 'Active'
					);
					$this->Users_model->add_data( $data_to_store );

				}
				if ( ( $lbv >= 625600 && $rbv >= 624800 ) || ( $rbv >= 625600 && $lbv >= 624800 ) ) {

					$data_to_store = array(

						'user_id' => $cid,
						'desciption' => 5,
						'status' => 'Active'
					);
					$this->Users_model->add_data( $data_to_store );

				}

				$m_reward = '';
				if ( $lbv >= 10000 && $rbv >= 10000 && $reward == '0' ) {
					$package = array( 'reward' => '1' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = 'Wrist Watch';
				}

				if ( $lbv >= 35000 && $rbv >= 35000 && $reward == '1' ) {
					$package = array( 'reward' => '2' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = '2600/- Cash';
				}

				if ( $lbv >= 85000 && $rbv >= 85000 && $reward == '2' ) {
					$package = array( 'reward' => '3' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = '5100/- Cash';
				}

				if ( $lbv >= 185000 && $rbv >= 185000 && $reward == '3' ) {
					$package = array( 'reward' => '4' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = '11000/- Mobile';
				}

				if ( $lbv >= 435000 && $rbv >= 435000 && $reward == '4' ) {
					$package = array( 'reward' => '5' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = '36000/- Laptop';
				}

				if ( $lbv >= 935000 && $rbv >= 935000 && $reward == '5' ) {
					$package = array( 'reward' => '6' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = '51000/- IPhone';
				}

				if ( $lbv >= 1685000 && $rbv >= 1685000 && $reward == '6' ) {
					$package = array( 'reward' => '7' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = 'Bike / 70K';
				}

				if ( $lbv >= 2685000 && $rbv >= 2685000 && $reward == '7' ) {
					$package = array( 'reward' => '8' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = 'Pulser / 1.25 Lacs';
				}

				if ( $lbv >= 4185000 && $rbv >= 4185000 && $reward == '8' ) {
					$package = array( 'reward' => '9' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = 'Bullet/ 1.75 Lacs';
				}

				if ( $lbv >= 6685000 && $rbv >= 6685000 && $reward == '9' ) {
					$package = array( 'reward' => '10' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = 'Alto Car / 3 Lacs';
				}

				if ( $lbv >= 10185000 && $rbv >= 10185000 && $reward == '10' ) {
					$package = array( 'reward' => '11' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = 'Tiago / 4.5 Lacs';
				}

				if ( $lbv >= 16185000 && $rbv >= 16185000 && $reward == '11' ) {
					$package = array( 'reward' => '12' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = 'Xcent / 7.5 Lacs';
				}

				if ( $lbv >= 24185000 && $rbv >= 24185000 && $reward == '12' ) {
					$package = array( 'reward' => '13' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = 'Breeza / 9 Lacs';
				}

				if ( $lbv >= 34185000 && $rbv >= 34185000 && $reward == '13' ) {
					$package = array( 'reward' => '14' );
					$this->Users_model->update_profile( $cid, $package );
					$m_reward = 'Scorpio / 12 Lacs';
				}

				if ( $m_reward != '' ) {
					if ( $lbv > $rbv ) {
						$pair_bv = $rbv;
					} else {
						$pair_bv = $lbv;
					}
					$add_income = array( 'reward' => $m_reward, 'user_id' => $cid, 'pair_bv' => $pair_bv );
					$this->Users_model->insert_table_data( 'reward', $add_income );
				}*/

			}



		}

	}



	function goDownLeftLevelDirect( $customerid ) {
		if ( empty( $customerid ) ) {
			return false;
		}
		$return = array();
		$children = $this->Users_model->my_child( $customerid ); //underlying SQL function 
		if ( !empty( $children ) ) {
			foreach ( $children as $child ) {
				$this->left_user[] = $child[ 'customer_id' ];
				for ( $i = 0; $i < $child[ 'package' ]; $i++ ) {
					$this->left_user[] = $child[ 'customer_id' ];
				}
				$this->goDownLeftLevelDirect( $child[ 'customer_id' ] );
			}
		}
		return $return;
	}

	function goDownRightLevelDirect( $customerid ) {
		if ( empty( $customerid ) ) {
			return false;
		}
		$return = array();
		$children = $this->Users_model->my_child( $customerid ); //underlying SQL function 
		if ( !empty( $children ) ) {
			foreach ( $children as $child ) {
				$this->right_user[] = $child[ 'customer_id' ];
				for ( $i = 0; $i < $child[ 'package' ]; $i++ ) {
					$this->right_user[] = $child[ 'customer_id' ];
				}
				$this->goDownRightLevelDirect( $child[ 'customer_id' ] );
			}
		}
		return $return;
	}



	public function transfer_pin() {
		// $direct_user_level = $this->Users_model->direct_user_info_from_user_id(15);
		//print_r($direct_user_level);
		$trpin = $this->session->userdata( 'profile_tr_pin' );
		// if($trpin=='') { redirect(base_url('admin/pins')); }

		$id = $this->session->userdata( 'cust_id' );
		$data[ 'profile' ] = $this->Users_model->profile( $id );
		$data[ 'user' ] = $data[ 'pin' ] = array();
		$pin_code = $this->uri->segment( 3 );
		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' && $this->input->post( 'find_customer' ) != '' ) {
			$this->form_validation->set_rules( 'assign_to', 'assign to', 'required|trim' );

			$data[ 'user' ] = $this->Users_model->get_customer_by_id( $this->input->post( 'assign_to' ) );
			if ( empty( $data[ 'user' ] ) ) {
				$this->form_validation->set_rules( 'start_date', '', 'required' );
				$this->form_validation->set_message( 'required', 'This user is not exist' );
			}

			$pin = $this->Users_model->get_pin_by_user( $pin_code, $data[ 'profile' ][ 0 ][ 'customer_id' ] );
			$data[ 'pin' ] = $pin;
			$this->form_validation->set_error_delimiters( '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>' );
			//if the form has passed through the validation
			if ( $this->form_validation->run() ) {

			}

		} elseif ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' ) {
			/*form validation*/
			$this->form_validation->set_rules( 'assign_to', 'assign to', 'required|trim' );
			//$this->form_validation->set_rules('pins', 'No. of E-Pin', 'required|trim|numeric');
			$pin = $this->Users_model->get_pin_by_user( $pin_code, $data[ 'profile' ][ 0 ][ 'customer_id' ] );
			// if($pin[0]['package'] < 4) {
			$new = explode( '~~', $this->input->post( 'product' ) );
			if ( $new[ 1 ] != $this->input->post( 'pin_amt' ) && $pin[ 0 ][ 'franchisee' ] == 0 ) {
				$this->form_validation->set_rules( 'amt', '', 'required' );
				$this->form_validation->set_message( 'required', 'Your product not match with pin amount' );
			}
			//} 
			$customer_id = $this->input->post( 'assign_to' );

			$user = $this->Users_model->get_customer_by_id( $customer_id );
			if ( empty( $user ) ) {
				$this->form_validation->set_rules( 'start_date', '', 'required' );
				$this->form_validation->set_message( 'required', 'This user is not exist' );
			} else {
				$data[ 'user' ] = $user;
			}


			$user_level = $pin[ 0 ][ 'b_volume' ];
			$user_level = round( $user_level, 2 );
			if ( empty( $pin ) ) {
				$this->form_validation->set_rules( 'start_date', '', 'required' );
				$this->form_validation->set_message( 'required', 'Please check your PIN.' );
			} elseif ( $pin[ 0 ][ 'status' ] != 'Active' ) {
				$this->form_validation->set_rules( 'start_date', '', 'required' );
				$this->form_validation->set_message( 'required', 'This PIN is deactivate or already used.' );
			}
			elseif ( ( $pin[ 0 ][ 'assign_to' ] != $data[ 'profile' ][ 0 ][ 'customer_id' ] ) && ( $pin[ 0 ][ 'move_to' ] != $data[ 'profile' ][ 0 ][ 'customer_id' ] ) ) {
					$this->form_validation->set_rules( 'start_date', '', 'required' );
					$this->form_validation->set_message( 'required', 'You can not use this PIN.' );
				}
				/* elseif($user[0]['user_level']=='0' && $pin[0]['p_amount'] < 1499) {  
					$this->form_validation->set_rules('start_date', '', 'required'); 
					$this->form_validation->set_message('required', 'First PIN must be at least 1500.');   
				} */
			elseif ( $user[ 0 ][ 'user_level' ] > 0 && $user_level <= $user[ 0 ][ 'user_level' ] && $pin[ 0 ][ 'franchisee' ] == 0 ) {
					$this->form_validation->set_rules( 'start_', '', 'required' );
					$this->form_validation->set_message( 'required', 'You can not use small package than current Package.' );
				}
				/* elseif($user[0]['user_level'] == '0' && $pin[0]['package'] > 3) {  
					$this->form_validation->set_rules('start_', '', 'required'); 
					$this->form_validation->set_message('required', 'Please Activate your ID first.');   
				} */
				/*elseif($pin[0]['p_amount'] > 4000) {  
					$this->form_validation->set_rules('start_date', '', 'required'); 
					$this->form_validation->set_message('required', 'Please check your PIN amount.');   
				}*/
				/*elseif($user[0]['user_level'] >= $user_level && $pin[0]['franchisee'] == 0 ) { 
				    $errormsg = 'You can not use package Lower than your current Package.';
					$this->form_validation->set_rules('start_date', '', 'required'); 
					$this->form_validation->set_message('required', $errormsg);   
				}*/
			elseif ( $user[ 0 ][ 'franchise' ] > 0 && $pin[ 0 ][ 'franchisee' ] == 1 ) {
				$errormsg = 'You can not use Franchisee PIN again.';
				$this->form_validation->set_rules( 'start_date', '', 'required' );
				$this->form_validation->set_message( 'required', $errormsg );
			}
			$data[ 'pin' ] = $pin;


			$this->form_validation->set_error_delimiters( '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>' );
			//if the form has passed through the validation
			if ( $this->form_validation->run() ) {
				$distribution = FALSE;
				$return = FALSE;
				$cust_id = $user[ 0 ][ 'id' ];
				$team_bussiness = array();
				$customer_id = $user[ 0 ][ 'customer_id' ];
				$order_id = $pin[ 0 ][ 'id' ];
				$distribution_amount = $pin[ 0 ][ 'b_volume' ];
				$p_amount = $pin[ 0 ][ 'p_amount' ];
				$this->matching_id = array();
				$this->matching_amount = array();
				$this->add_pv = array();
				$this->income = array();
				$this->binary_level_income = array();
				$repurchase = '';

				if ( $customer_id != '' && $cust_id != '' && $pin[ 0 ][ 'franchisee' ] == '0' ) {

					if ( $user[ 0 ][ 'user_level' ] == '0' ) {
						/******************* update pin ***********/
						$date = date( 'Y-m-d' );
						$this->Users_model->update_pin( $pin_code, $customer_id, $date );
						$package = array( 'user_level' => $pin[ 0 ][ 'percentage' ], 'package' => $user_level, 'capping' => $pin[ 0 ][ 'capping' ], 'package_used' => $date, 'consume' => 1, 'plan_name' => $pin[ 0 ][ 'p_amount' ], 'sbv' => $distribution_amount );
						$this->Users_model->update_profile( $cust_id, $package );


						$this->Users_model->load_wallet( $user[ 0 ][ 'did' ], '1', 'direct' );
						$this->Users_model->load_wallet( $user[ 0 ][ 'did' ], $p_amount, 'direct_sale' );
						if ( $user[ 0 ][ 'position' ] == 'left' ) {
							$this->Users_model->load_wallet( $user[ 0 ][ 'did' ], '1', 'left_direct' );
						} else {
							$this->Users_model->load_wallet( $user[ 0 ][ 'did' ], '1', 'right_direct' );
						}


						$this->Users_model->insert_repuchase_bv( array( 'user_id' => $cust_id ) );
						/*************** direct sponcer ****************/
						$add_income = array( 'user_id' => $user[ 0 ][ 'did' ], 'payby' => $cust_id, 'amount' => $pin[ 0 ][ 'b_volume' ] * ( 10 / 100 ), 'net_income' => $pin[ 0 ][ 'b_volume' ] * ( 5 / 100 ) );
						$this->Users_model->insert_table_data( 'direct_income', $add_income );

						//$directs = $this->Users_model->get_direct_user_id_by_eligible($user[0]['dcustomer_id'],0); 

						if ( $user[ 0 ][ 'ddirect' ] >= 10 && $user[ 0 ][ 'duser_level' ] > 0 && $user[ 0 ][ 'dup_req' ] == '0' ) {

							$arr = array( 'up_req' => 1 );
							$this->Users_model->update_profile( $user[ 0 ][ 'did' ], $arr );

						}

						/*************** direct sponcer end ****************/


						//$add_pv = array('order_id'=>$order_id,'amount'=>$distribution_amount,'user_id'=>$user[0]['did'],'type'=>'Direct '.$user[0]['position'],'user_id_send_by'=>$cust_id,'status'=>'Active');
						//$update_ids[]=$this->Users_model->add_distribution($add_pv);
						$repurchase = 'no';
						$sale_type = '1';
						$distribution = TRUE;

						//add data in order  

						$prddis = explode( '~~', $this->input->post( 'product' ) );
						$gstvalue = $prddis[ 4 ] / 100 + 1;
						$gst = $prddis[ 1 ] / $gstvalue;
						$totalgst = $prddis[ 1 ] - $gst;
						$products_array = array();
						$products_array[] = $prddis[ 0 ] . '~~' . $prddis[ 3 ] . '~~' . $prddis[ 0 ] . '~~1~~0~~' . $prddis[ 1 ] . '~~' . $gst . '~~' . $prddis[ 1 ] . '~~' . $prddis[ 4 ] . '';
						$products = json_encode( $products_array );
						$idate = date( 'Y-m-d H:i:s' );
						$data_store = array(
							'gtotal' => $prddis[ 1 ],
							'bv' => $distribution_amount,
							'products' => $products,
							'before_tax_amount' => $gst,
							'discount' => 0,
							'payment_type' => 'pin',
							'customer' => $this->input->post( 'assign_to' ),
							'total_gst' => $totalgst,
							'user_id' => $cust_id,
							'tdate' => $idate,
							'pin_bill' => 1,
						);
						$this->Users_model->store_sale_dta( $data_store );

					} elseif ( $user_level > $user[ 0 ][ 'user_level' ] ) {
						$repurchase = 'no';
						$sale_type = '1';
						/******************* update pin ***********/
						$date = date( 'Y-m-d' );
						$this->Users_model->update_pin( $pin_code, $customer_id, $date );
						$package = array( 'user_level' => $user[ 0 ][ 'user_level' ] + $user_level, 'capping' => $pin[ 0 ][ 'capping' ], 'package_used' => $pin[ 0 ][ 'p_amount' ] );
						$this->Users_model->update_profile( $cust_id, $package );
						//add data in order  

						$prddis = explode( '~~', $this->input->post( 'product' ) );
						$gstvalue = $prddis[ 4 ] / 100 + 1;
						$gst = $prddis[ 1 ] / $gstvalue;
						$totalgst = $prddis[ 1 ] - $gst;
						$products_array = array();
						$products_array[] = $prddis[ 0 ] . '~~' . $prddis[ 3 ] . '~~' . $prddis[ 0 ] . '~~1~~0~~' . $prddis[ 1 ] . '~~' . $gst . '~~' . $prddis[ 1 ] . '~~' . $prddis[ 4 ] . '';
						$products = json_encode( $products_array );
						$idate = date( 'Y-m-d H:i:s' );
						$data_store = array(
							'gtotal' => $prddis[ 1 ],
							'products' => $products,
							'before_tax_amount' => $gst,
							'discount' => 0,
							'payment_type' => 'pin',
							'customer' => $this->input->post( 'assign_to' ),
							'total_gst' => $totalgst,
							'center_id' => $cust_id,
							'tdate' => $idate,
							'pin_bill' => 1,
						);
						$this->Users_model->store_sale_dta( $data_store );
					}
					$count_bv = array();
					$position = $user[ 0 ][ 'position' ];

					$parent_customer_id = $user[ 0 ][ 'parent_customer_id' ];
					$dis_level = 1;
					$p = 0;
					$compare_date = date( 'Y-m' );
					if ( $parent_customer_id != '' && $repurchase != '' && $distribution_amount > 0 ) {
						while ( $p < 1 ) {
							$parent_user = $this->Users_model->profile_by_customer_id( $parent_customer_id );
							if ( !empty( $parent_user ) ) {
								$add_pv = array( 'order_id' => $order_id, 'amount' => $distribution_amount, 'user_id' => $parent_user[ 0 ][ 'id' ], 'type' => 'BV ' . $position, 'user_id_send_by' => $cust_id, 'sale_type' => $sale_type, 'status' => 'Active', 'pay_level' => $dis_level );
								
								$this->Users_model->add_distribution( $add_pv );
								
								$team_bussiness[] = array( 'order_id' => $order_id, 'amount' => $distribution_amount, 'user_id' => $parent_user[ 0 ][ 'id' ], 'user_id_send_by' => $cust_id, 'status' => 'Active', 'pay_level' => $dis_level );

								$this->add_pv_income( $parent_user[ 0 ][ 'id' ], $parent_user[ 0 ][ 'capping' ], $parent_user[ 0 ][ 'user_level' ], $parent_user[ 0 ][ 'reward' ], $position, $distribution_amount, $cust_id, $order_id, $repurchase, $parent_user[ 0 ][ 'lbv' ], $parent_user[ 0 ][ 'rbv' ], $parent_user[ 0 ][ 'plcount' ], $parent_user[ 0 ][ 'prcount' ], $parent_user[ 0 ][ 'left_direct' ], $parent_user[ 0 ][ 'right_direct' ] );

								$parent_customer_id = $parent_user[ 0 ][ 'parent_customer_id' ];
								$position = $parent_user[ 0 ][ 'position' ];

								$dis_level = $dis_level + 1;
								$p = 0;
							} else {
								$p++;
							}
						}
					}

					$return = TRUE;


				} elseif ( $customer_id != '' && $cust_id != '' && $pin[ 0 ][ 'franchisee' ] == '1' ) {

					$date = date( 'Y-m-d' );
					$this->Users_model->update_pin( $pin_code, $customer_id, $date );


					$arr = array( 'franchise' => $distribution_amount );
					$this->Users_model->update_profile( $cust_id, $arr );
					$return = TRUE;

				}
				
				if ( !empty( $this->income ) ) {
					$this->Users_model->insert_batch( 'binary_income', $this->income );
				}
				if ( !empty( $team_bussiness ) ) {
					$this->Users_model->insert_batch( 'team_bussiness', $team_bussiness );
				}
				/*if(!empty($this->binary_level_income)) {
					  $this->Users_model->insert_batch('binary_level_income',$this->binary_level_income);
				  }*/

				die();
				 
				/**************** end payment distribution *******************/

				if ( $return == TRUE ) {
					$this->session->set_flashdata( 'flash_message', 'activated' );
					redirect( 'admin/pin_activate/' . $pin_code );
				} else {
					$this->session->set_flashdata( 'flash_message', 'not_updated' );
				}


			} /*validation run*/

		}

		$data[ 'product' ] = $this->Users_model->select_products();

		//load the view
		$data[ 'main_content' ] = 'admin/transfer_pin';
		$this->load->view( 'includes/admin/template', $data );
	}


	public
	function welcomeletter() {
		$id = $this->session->userdata( 'cust_id' );
		$data[ 'page_keywords' ] = '';
		$data[ 'page_description' ] = '';
		$data[ 'page_slug' ] = 'welcomeletter';
		$data[ 'page_title' ] = 'welcomeletter';
		$data[ 'profile' ] = $this->Users_model->profile( $id );
		$data[ 'main_content' ] = 'admin/welcomeletter';
		$this->load->view( 'includes/admin/template', $data );
	}

	public
	function personal_details() {
		$id = $this->session->userdata( 'cust_id' );
		$data[ 'page_keywords' ] = '';
		$data[ 'page_description' ] = '';
		$data[ 'page_slug' ] = 'personal_details';
		$data[ 'page_title' ] = 'personal_details';
		$data[ 'profile' ] = $this->Users_model->profile( $id );
		$data[ 'main_content' ] = 'admin/personal_details';
		$this->load->view( 'includes/admin/template', $data );
	}

	public
	function transfer_e_pin() {
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );
		$user = $this->Users_model->profile( $id );

		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' && $this->input->post( 'profile_tr_pin' ) != '' ) {

			$profile_tr_pin = $this->input->post( 'profile_tr_pin' );
			$trpin = md5( $profile_tr_pin );
			if ( $user[ 0 ][ 'tr_pin' ] == $trpin ) {
				$this->session->set_userdata( 'profile_tr_pin', 'profile_tr_pin' );
			} else {
				$data[ 'pin_error' ] = '<div class="alert alert-danger"><strong>Error!</strong> Your PIN is wrong. Please try again.</div>';
			}
		}

		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' && $this->input->post( 'submit' ) == 'Transfer E-Pins' ) {
			/*form validation*/
			$this->form_validation->set_rules( 'assign_to', 'assign to', 'required|trim' );

			$user = $this->Users_model->get_customer_by_id( $this->input->post( 'assign_to' ) );
			if ( empty( $user ) ) {
				$this->form_validation->set_rules( 'start_date', '', 'required' );
				$this->form_validation->set_message( 'required', 'This user is not exist' );
			}


			$this->form_validation->set_error_delimiters( '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>' );
			//if the form has passed through the validation
			if ( $this->form_validation->run() ) {

				$data_to_store = array(
					'move_to' => $this->input->post( 'assign_to' ),
					'status' => 'Active',
				);
				$return = $this->Users_model->update_trnsfr_pin( $this->input->post( 'pinid' ), $data_to_store );



				if ( $return == TRUE ) {
					$this->session->set_flashdata( 'flash_message', 'updated' );
					redirect( 'admin/pins/transfer' );
				} else {
					$this->session->set_flashdata( 'flash_message', 'not_updated' );
				}

			} /*validation run*/

		}

		$data[ 'profile' ] = $this->Users_model->profile( $id );
		$data[ 'available_pin' ] = $this->Users_model->available_pin( $customer_id );
		$data[ 'main_content' ] = 'admin/transfer_e_pin';
		$this->load->view( 'includes/admin/template', $data );
	}

	public
	function kyc() {
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );

		if ( $this->input->server( 'REQUEST_METHOD' ) ) {

			$var_status = 'no';

			$this->form_validation->set_rules( 'pancard', 'Pancard No.', 'required|trim' );
			$this->form_validation->set_rules( 'aadhar', 'Aadhar NO.', 'required|trim' );

			/*  $pancard = $this->Users_model->pancard($id);
			if($pancard[0]['pancard'] != '') {
              $this->form_validation->set_rules('pancard_limit', 'redeem', 'required|trim');
              $this->form_validation->set_message('required', 'You can not update pancard twice');
           }
		   
		   $aadhar = $this->Users_model->aadhar($id);
			if($aadhar[0]['aadhar'] != '') {
              $this->form_validation->set_rules('aadhar_limit', 'redeemaa', 'required|trim');
              $this->form_validation->set_message('required', 'You can not update aadhar twice');
           } */

			$pancard = $this->Users_model->count_pancard( $this->input->post( 'pancard' ) );
			if ( count( $pancard ) >= 3 ) {
				$this->form_validation->set_rules( 'pancard_limit', 'redeem', 'required|trim' );
				$this->form_validation->set_message( 'required', 'You can not use same pancard no. more than thrice.' );
			}
			$this->form_validation->set_error_delimiters( '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>' );

			//if the form has passed through the validation
			if ( $this->form_validation->run() ) {
				// file upload start here


				$panimage = '';
				$config[ 'upload_path' ] = 'images/user/';
				$config[ 'allowed_types' ] = 'gif|jpg|png|jpeg';
				//$config['max_width']  = '1024';
				// $config['max_height']  = '1024';
				$this->load->library( 'upload', $config );
				if ( $this->upload->do_upload( 'panimage' ) ) {
					if ( $this->input->post( 'panimage_old' ) != '' )unlink( 'images/user/' . $this->input->post( 'panimage_old' ) );
					$image_data = $this->upload->data();
					$panimage = $image_data[ 'file_name' ];
				} else {
					$panimage = $this->input->post( 'panimage_old' );
				}

				$aadharimage = '';
				$config[ 'upload_path' ] = 'images/user/';
				$config[ 'allowed_types' ] = 'gif|jpg|png|jpeg';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				$this->load->library( 'upload', $config );
				if ( $this->upload->do_upload( 'aadharimage' ) ) {
					if ( $this->input->post( 'aadharimage_old' ) != '' )unlink( 'images/user/' . $this->input->post( 'aadharimage_old' ) );
					$image_data = $this->upload->data();
					$aadharimage = $image_data[ 'file_name' ];
				} else {
					$aadharimage = $this->input->post( 'aadharimage_old' );
				}

				$back_aadharimage = '';
				$config[ 'upload_path' ] = 'images/user/';
				$config[ 'allowed_types' ] = 'gif|jpg|png|jpeg';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				$this->load->library( 'upload', $config );
				if ( $this->upload->do_upload( 'back_aadharimage' ) ) {
					if ( $this->input->post( 'back_aadharimage_old' ) != '' )unlink( 'images/user/' . $this->input->post( 'back_aadharimage_old' ) );
					$image_data = $this->upload->data();
					$back_aadharimage = $image_data[ 'file_name' ];
				} else {
					$back_aadharimage = $this->input->post( 'back_aadharimage_old' );
				}

				$bank_img = '';
				$config[ 'upload_path' ] = 'images/user/';
				$config[ 'allowed_types' ] = 'gif|jpg|png|jpeg';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				$this->load->library( 'upload', $config );
				if ( $this->upload->do_upload( 'bank_img' ) ) {
					if ( $this->input->post( 'bank_img_old' ) != '' )unlink( 'images/user/' . $this->input->post( 'bank_img_old' ) );
					$image_data = $this->upload->data();
					$bank_img = $image_data[ 'file_name' ];
				} else {
					$bank_img = $this->input->post( 'bank_img_old' );
				}

				$data_to_store = array(
					'pancard' => $this->input->post( 'pancard' ),
					'panimage' => $panimage,
					'aadhar' => $this->input->post( 'aadhar' ),
					'aadharimage' => $aadharimage,
					'aadharimage' => $aadharimage,
					'back_adhar_img' => $back_aadharimage,
					'bank_img' => $bank_img,
					'var_status' => $var_status
				);
				$return = $this->Users_model->update_profile( $id, $data_to_store );

				if ( $return == TRUE ) {
					$this->session->set_flashdata( 'flash_message', 'updated' );
					redirect( base_url() . 'admin/kyc_details' );
				} else {
					$this->session->set_flashdata( 'flash_message', 'not_updated' );
				}

			} /*validation run*/

		}

		$data[ 'profile' ] = $this->Users_model->profile( $id );
		$data[ 'parentid' ] = $this->Users_model->parent_profile( $data[ 'profile' ][ 0 ][ 'parent_customer_id' ] );

		//load the view
		$data[ 'main_content' ] = 'admin/kyc_details';
		$this->load->view( 'includes/admin/template', $data );
	}

	public
	function bank_details() {
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );

		if ( $this->input->server( 'REQUEST_METHOD' ) ) {
			/*form validation*/

			$this->form_validation->set_rules( 'bank_name', 'bank name', 'required|trim' );
			$this->form_validation->set_rules( 'branch', 'branch', 'required|trim' );
			$this->form_validation->set_rules( 'bank_state', 'bank state', 'required' );
			$this->form_validation->set_rules( 'account_type', 'account type', 'required|trim' );
			$this->form_validation->set_rules( 'account_no', 'account no', 'required|trim' );
			$this->form_validation->set_rules( 'ifsc', 'ifsc', 'required' );


			$this->form_validation->set_error_delimiters( '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>' );

			//if the form has passed through the validation
			if ( $this->form_validation->run() ) {

				$bank_img = '';
				$config[ 'upload_path' ] = 'images/user/';
				$config[ 'allowed_types' ] = 'gif|jpg|png|jpeg';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				$this->load->library( 'upload', $config );
				if ( $this->upload->do_upload( 'bank_img' ) ) {
					if ( $this->input->post( 'cancel_chq_old' ) != '' )unlink( 'images/user/' . $this->input->post( 'bank_img_old' ) );
					$image_data = $this->upload->data();
					$bank_img = $image_data[ 'file_name' ];
				} else {
					$bank_img = $this->input->post( 'bank_img_old' );
				}




				$data_to_store = array(
					'bank_name' => $this->input->post( 'bank_name' ),
					'branch' => $this->input->post( 'branch' ),
					'account_name' => $this->input->post( 'account_name' ),
					'account_type' => $this->input->post( 'account_type' ),
					'account_no' => $this->input->post( 'account_no' ),
					'bank_city' => $this->input->post( 'bank_city' ),
					'bank_state' => $this->input->post( 'bank_state' ),
					'bank_img' => $bank_img,
					'ifsc' => $this->input->post( 'ifsc' )
				);
				$return = $this->Users_model->update_profile( $id, $data_to_store );

				if ( $return == TRUE ) {
					$this->session->set_flashdata( 'flash_message', 'updated' );
					redirect( base_url() . 'admin/bank_details' );
				} else {
					$this->session->set_flashdata( 'flash_message', 'not_updated' );
				}


			} /*validation run*/

		}

		$data[ 'profile' ] = $this->Users_model->profile( $id );
		$data[ 'parentid' ] = $this->Users_model->parent_profile( $data[ 'profile' ][ 0 ][ 'parent_customer_id' ] );

		//load the view
		$data[ 'main_content' ] = 'admin/bank_details';
		$this->load->view( 'includes/admin/template', $data );
	}

	public
	function my_pin_transfer() {
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );

		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' ) {

			$sdate = date( 'Y-m-d 00:00:01', strtotime( $this->input->post( 'sdate' ) ) );
			$edate = date( 'Y-m-d 23:59:59', strtotime( $this->input->post( 'edate' ) ) );
		} else {

			$sdate = date( 'Y-m-1 00:00:01' );
			$edate = date( 'Y-m-t 23:59:59' );
			$status = '';

		}

		$data[ 'pin' ] = $this->Users_model->my_transfer_all_pin( $sdate, $edate, $customer_id );

		//load the view
		$data[ 'profile' ] = $this->Users_model->profile( $id );
		$data[ 'main_content' ] = 'admin/my_pins_transfer';
		$this->load->view( 'includes/admin/template', $data );
	}

	public
	function pin_request() {
		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );



		$data[ 'image_error' ] = 'false';

		$cimage = '';
		if ( $this->input->server( 'REQUEST_METHOD' ) === 'POST' ) {
			//form validation
			$this->form_validation->set_rules( 'amount', 'Amount', 'required|trim|min_length[4]' );
			$this->form_validation->set_rules( 'phone', 'discription', 'required' );

			$this->form_validation->set_error_delimiters( '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>' );
			//if the form has passed through the validation
			if ( $this->form_validation->run() ) {
				// file upload start here
				$config[ 'upload_path' ] = 'images/user/';
				$config[ 'allowed_types' ] = 'gif|jpg|png|jpeg';

				$this->load->library( 'upload', $config );
				if ( $this->upload->do_upload( 'image' ) ) {
					$image_data = $this->upload->data();
					$image = $image_data[ 'file_name' ];
				} else {
					$errors = $this->upload->display_errors();
					$image = '';
				}
				//----- end file upload -----------

				$data_to_store = array(
					'customer_id' => $customer_id,
					'phone' => $this->input->post( 'phone' ),
					'amount' => $this->input->post( 'amount' ),
					'neft' => $this->input->post( 'neft' ),
					'bank_name' => $this->input->post( 'bank_name' ),
					'bank_branch' => $this->input->post( 'bank_branch' ),
					'account_no' => $this->input->post( 'account_no' ),
					'ifsc_code' => $this->input->post( 'ifsc' ),
					'comment' => $this->input->post( 'description' ),
					'image' => $image,
				);



				if ( $this->Users_model->insert_pin_request( $data_to_store ) == TRUE ) {
					$this->session->set_flashdata( 'flash_message', 'updated' );
					redirect( 'admin/request-wallet' );
				} else {
					$this->session->set_flashdata( 'flash_message', 'not_updated' );
				}



			} //validation run

		}
		$data[ 'profile' ] = $this->Users_model->profile( $id );
		$data[ 'main_content' ] = 'admin/request_for_pin';
		$this->load->view( 'includes/admin/template', $data );
	}

	public
	function pins_status() {

		$id = $this->session->userdata( 'cust_id' );
		$customer_id = $this->session->userdata( 'bliss_id' );
		$user = $this->Users_model->profile( $id );
		$data[ 'profile' ] = $user;
		$data[ 'pin_error' ] = '';

		$url = $this->uri->segment( 3 );

		$url = $this->uri->segment( 3 );
		if ( $url == 'used' ) {
			$data[ 'pin' ] = $this->Users_model->get_all_pin_by_status( $customer_id, 'Used' );
		} elseif ( $url == 'active' ) {

			$data[ 'pin' ] = $this->Users_model->get_all_pin_by_status( $customer_id, 'Active' );
		}

		elseif ( $url == 'f_active' ) {

			$data[ 'pin' ] = $this->Users_model->get_all_pin_by_status( $customer_id, 'Active', array( '53', '105' ) );
		} else {

			$data[ 'pin' ] = $this->Users_model->get_all_pin( $customer_id );
		}



		//load the view
		$data[ 'main_content' ] = 'admin/pins';
		$this->load->view( 'includes/admin/template', $data );
	}

	public function upgrade_account(){ 
	    $id = $this->session->userdata('cust_id');
	    $customer_id = $this->session->userdata('bliss_id');
	    $data['profile'] = $this->Users_model->profile($id);
	    $data['user'] = $data['pin'] = array(); 
		$amount=$this->input->post('amount');
		$data['user'] = $this->Users_model->get_customer_by_id($customer_id);
		$user  = $data['user'];
	    if ($this->input->server('REQUEST_METHOD') === 'POST')
        { 
            /*form validation*/
			$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
			//$this->form_validation->set_rules('product', 'Package', 'required');
			$customer_id = $this->input->post('assign_to');
            $user = $this->Users_model->get_customer_by_id($customer_id);
            if(empty($user)) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user is not exist'); 
            } else {
				$data['user'] = $user;
			}

				$p_amount = 1298;
				if($p_amount > $data['profile'][0]['bliss_amount']) {
				   $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
				   $this->form_validation->set_message('required', 'Wallet Amount must be greater than Package Amount');
			   	}
			   	elseif($user[0]['consume'] > 0) {
				   $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
				   $this->form_validation->set_message('required', 'Your ID is already activated.');
			   	}
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  
			 	$return = FALSE;
				$this->income = array();
				$this->matching_amount = array();
		        $cust_id = $user[0]['id'];  
		        $direct_id = $user[0]['did'];  
		        $customer_id = $user[0]['customer_id'];  
		        $order_id = 0;
				$distribution_amount = $p_amount;
				//start the transaction
        		$this->db->trans_begin();
				
				if ( $customer_id != '' && $cust_id != '' ) {
					$this->Users_model->update_wallet($id,$p_amount,'bliss_amount');
					if ( $user[ 0 ][ 'consume' ] == '0' ) {
						$date = date( 'Y-m-d' );
						$package = array(  'package' => $p_amount, 'package_used' => $date, 'consume' => 1, 'user_level' => 2);
						$this->Users_model->update_profile( $cust_id, $package );
						$twallet_log = array(
						'user_id' => $this->session->userdata('cust_id'),
						'send_to' => $this->session->userdata('cust_id'),
						'type' => 'Activate Account',
						'wallet_type' => 'Main Wallet',
						'amount' => $p_amount,
						'status' => 'Debit' 
						);
						$this->Users_model->add_transactions($twallet_log);
						$this->Users_model->load_wallet( $direct_id, '1', 'direct' );
						//$this->autopool($cust_id,$direct_id,$package_level,$p_amount);

						if($user[0]['ddirect'] >= 10 && $user[0]['dbooster']==0) {
							$this->Users_model->update_profile($direct_id,array('booster'=>1));
						}
						elseif($user[0]['ddirect'] >= 15 && $user[0]['dbooster']==1) {
							$this->Users_model->update_profile($direct_id,array('booster'=>2));
						}


						$package_level = 1; $p_amount = 1000;
						$this->autopool($cust_id,$direct_id,$package_level,$p_amount,$user[0]['ddirect']+1);
						$this->first_level_income($user['direct_customer_id'],$cust_id);

						} else {
							$this->reverse_matrix_income($cust_id,$direct_id,$package_level,$p_amount);
							$package = array( 'user_level' => $package_level, 'package' => $p_amount, 'package_used' => date('Y-m-d'));
							$this->Users_model->update_profile( $cust_id, $package );
						}
						$products_array = array();
						$products_array[] = '1~~0~~1~~1~~0~~1~~0~~' . $p_amount . '~~0';
						$products = json_encode( $products_array );
						$idate = date( 'Y-m-d H:i:s' );
						$data_store = array(
							'gtotal' => $p_amount,
							'bv' => $distribution_amount,
							'products' => $products,
							'before_tax_amount' => 0,
							'discount' => 0,
							'payment_type' => 'pin',
							'customer' => $this->input->post( 'assign_to' ),
							'total_gst' => 0,
							'user_id' => $cust_id,
							'tdate' => $idate,
							'pin_bill' => 1,
						);
						$this->Users_model->store_sale_dta( $data_store );
					
					/*$add_income = array( 'user_id' => $user[ 0 ][ 'did' ], 'payby' => $cust_id, 'amount' => 200, 'net_income' => 10 );
					$this->Users_model->insert_table_data( 'direct_income', $add_income );*/
					/*if($user[0]['ddirect'] == 0) {
					$position = 'X';
					$direct_income = (10/100)*$distribution_amount;
					$package_array = array('position'=>'X');
					$this->Users_model->update_profile($cust_id,$package_array);
					}
					elseif($user[0]['ddirect'] == 1) {
					$position = 'Y';
					$direct_income = (10/100)*$distribution_amount;
					$package_array = array('position'=>'Y');
					$this->Users_model->update_profile($cust_id,$package_array);
					}
					else {
					$position = 'Z';
					$direct_income = (45/100)*$distribution_amount;
					$package_array = array('position'=>'Z');
					$this->Users_model->update_profile($cust_id,$package_array);
					}

					$direct_customer_id = $user[0]['direct_customer_id'];
				$p=0;
				$dis_level=1;
				$depth_level=1;
				$depth_inc = TRUE;
				if($position!='Z') {
				while($p<1) {
					
					$direct_parent = $this->Users_model->parent_profile($direct_customer_id);
					if(!empty($direct_parent)) {
						$get_rank = '';
						if($position=='Z' && $dis_level > 1 && $depth_inc==TRUE) {

							$dis_amount = (10/100)*$distribution_amount;
							$add_income = array('amount'=>$dis_amount,'user_id'=>$direct_parent[0]['id'],'type'=>'Depth income','user_send_by'=>$cust_id,'pay_level'=>$dis_level,'status'=>'Active');
							$this->Users_model->add_income($add_income);
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
					$return = TRUE;
					//die();

				} 
			  /**************** end payment distribution *******************/
			
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'activated');
					redirect('admin/upgrade_account');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                


            }/*validation run*/

        }
       
        $data[ 'product' ] = $this->Users_model->select_products();
	     
        //load the view
		
        $data['main_content'] = 'admin/upgrade_account'; 
        $this->load->view('includes/admin/template', $data); 
   }

   function first_level_income($direct_customer_id,$cust_id) {
					$p = 0;
					$dis_level = 1;
					$dis_income = array(5,4,2,2,1,1,1);
					while($p<6) {
						$direct_user = $this->Users_model->parent_profile($direct_customer_id);
						if(!empty($direct_user)) {
									$data_to_store = array(
									'user_id' => $direct_user[0]['id'],
									'type' => 'Level Income',
									'pay_level' => $dis_level,
									'amount' => $dis_income[$p],
									'status ' => 'Active',
									'user_send_by ' => $cust_id
									);
									$this->Users_model->add_income($data_to_store);
								
							$p++;
							$dis_level++;
							$direct_customer_id = $direct_user[0]['direct_customer_id'];
						} else { $p = 40; }
					}
	}

   /*function reverse_matrix_income($user_id,$direct_id,$package_level,$package_name) {
		
				$income_carry = 'no';
				$placement_id = array();
				$user_info = $this->Users_model->get_user_info($user_id);
				//echo '<pre>'; print_r($user_info);
				$income_level = 1;
				$p = 0;
				$sponsor = $user_info[0]['parent_id'];
				//if($package_level > 1) {
				while($p<6) {
				$sponsor_data = $this->Users_model->get_autopool_by_id($sponsor);
				if(!empty($sponsor_data)) {
				if($package_level==1 && $income_level == 2) { $level_inome = 1000; }
				elseif($package_level == 2 && $income_level == 3) { $level_inome = 2000; }
				elseif($package_level == 3 && $income_level == 4) { $level_inome = 8000; }
				elseif($package_level == 4 && $income_level == 5) { $level_inome = 64000; }
				elseif($package_level == 5 && $income_level == 6) { $level_inome = 1024000; }
				else { $level_inome = 0; }

				if($level_inome > 0) {
					if($sponsor_data[0]['user_level']>=$package_level) { 
						$data = array(
						'user_id' => $sponsor_data[0]['user_id'],
						'type' => 'Voucher',
						'pay_level' => $income_level,
						'amount' => $level_inome,
						'status ' => 'Active',
						'user_send_by ' => $user_id,
						'description ' =>$package_level
						);
					
						$insert_id = $this->Users_model->add_income($data);
					} else { $income_carry = 'yes'; $p=50; }
					
				}
				$sponsor = $sponsor_data[0]['parent_id'];
				} else { $p=50; }

				$p++;
				$income_level++;
			}
			//}

			if($income_carry == 'yes') {
				$p = 0; 
				while($p<1) {
				$sponsor_data = $this->Users_model->get_autopool_by_id($sponsor);
				if(!empty($sponsor_data)) {
					if($sponsor_data[0]['user_level']>=$package_level) {
						$data = array(
						'user_id' => $sponsor_data[0]['user_id'],
						'type' => 'Level Income',
						'pay_level' => $income_level,
						'amount' => $level_inome,
						'status ' => 'Active',
						'user_send_by ' => $user_id,
						'description ' =>$package_level
						);
						$insert_id = $this->Users_model->add_income($data);
						$p=50;
					} 
				$sponsor = $sponsor_data[0]['parent_id'];
				} else { $p=50; }

				
				$income_level++;
			}
			}
			//die();
		
	}*/

	function reverse_matrix_income($user_id,$direct_id,$package_level,$package_name) {

				$user_info = $this->Users_model->get_user_info($user_id);
				$dis_level = 1;
				$p = 0;
				$sponsor = $user_info[0]['parent_id'];
				while($p<6) {
				$sponsor_data = $this->Users_model->get_autopool_by_id($sponsor);
				if(!empty($sponsor_data)) {
				if($package_level==3 && $dis_level == 2) { $level_inome = 1000; }
				elseif($package_level == 4 && $dis_level == 3) { $level_inome = 2000; }
				elseif($package_level == 5 && $dis_level == 4) { $level_inome = 8000; }
				elseif($package_level == 6 && $dis_level == 5) { $level_inome = 64000; }
				elseif($package_level == 7 && $dis_level == 6) { $level_inome = 1024000; }
				else { $level_inome = 0; }

				if($level_inome > 0) {
						$total_sbv = $sponsor_data[0]['sbv'] + $package_name;
						
						$data_to_store = array(
							'type' => 'Upgrade Income',
							'pay_level' => $dis_level,
							'amount' => $level_inome/10,
							'status ' => 'Active',
							'user_send_by ' => $user_id,
							'description ' =>$package_level
						);
						if($sponsor_data[0]['user_level']>=$package_level) { 
							$data_to_store['user_id'] = $sponsor_data[0]['user_id'];
						} else { 
							$data_to_store['user_id'] = 1061;
						}
						$this->Users_model->load_wallet($data_to_store['user_id'], $package_name, 'sbv' );
						$this->Users_model->load_wallet($data_to_store['user_id'], $level_inome/10, 'points' );
						$this->Users_model->add_income($data_to_store);
						
						
						$data_to_store = array(
							'user_id' => $user_id,
							'send_to' => $user_id,
							'status' => 'Credit',
							'wallet_type ' => 'Point',
							'amount ' => $level_inome
							
						);
						$this->Users_model->add_transactions($data_to_store);
					
						$p=50;
						}
						$sponsor = $sponsor_data[0]['parent_id'];
						} else { $p=50; }

						$p++;
						$dis_level++;
					}
					if(!empty($sponsor_data)) {
						$cust_id = $sponsor_data[0]['user_id'];
						if($total_sbv >= 2000 && $sponsor_data[0][ 'user_level' ]==3) {
							$package_level = 3; $p_amount = 1000;
							$this->reverse_matrix_income($cust_id,$direct_id,$package_level,$p_amount);
							$this->Users_model->update_profile($cust_id,array('user_level'=>4));
						}
						if($total_sbv >= 4000 && $sponsor_data[0][ 'user_level' ]==4) {
							$package_level = 4; $p_amount = 2000;
							$this->reverse_matrix_income($cust_id,$direct_id,$package_level,$p_amount);
							$this->Users_model->update_profile($cust_id,array('user_level'=>5));
						}
						if($total_sbv >= 12000 && $sponsor_data[0][ 'user_level' ]==5) {
							$package_level = 5; $p_amount = 8000;
							$this->reverse_matrix_income($cust_id,$direct_id,$package_level,$p_amount);
							$this->Users_model->update_profile($cust_id,array('user_level'=>6));
						}
						if($total_sbv >= 76000 && $sponsor_data[0][ 'user_level' ]==6) {
							$package_level = 6; $p_amount = 64000;
							$this->reverse_matrix_income($cust_id,$direct_id,$package_level,$p_amount);
							$this->Users_model->update_profile($cust_id,array('user_level'=>7));
						}
						if($total_sbv >= 1100000 && $sponsor_data[0][ 'user_level' ]==7) {
							$package_level = 7; $p_amount = 1024000;
							$this->reverse_matrix_income($cust_id,$direct_id,$package_level,$p_amount);
							$this->Users_model->update_profile($cust_id,array('user_level'=>8));
						}
					}
						
	}

	function autopool($user_id,$direct_id,$package_level,$package_name,$directs) {
				/* start **/
				$placement_id = array();
				$user_info = $this->Users_model->get_user_info($user_id);
				$check = $this->Users_model->check_autopool($direct_id);
				if(!empty($check)) {	
					$placement_id = $check;
				} else {  $placement_id = $this->Users_model->get_autopool_placement(); }
						$data_to = array(
						'user_id' => $user_id,
						'parent_id' => $placement_id[0]['id'],
						'direct_id' => $direct_id
						); 
						$this->Users_model->insert_autopool_data($data_to);
						$this->Users_model->update_autopool_child_num($placement_id[0]['id']);

						if($placement_id[0]['children']==0) {
							$sponsor_data = $this->Users_model->get_autopool_by_id($placement_id[0]['parent_id']);
							if(!empty($sponsor_data)) {
								$data_to_store = array(
								'user_id' => $sponsor_data[0]['user_id'],
								'amount' => 100,
								'user_send_by ' => $user_id,
								'type' => 'Upgrade Income',
								'pay_level' => 2,
								'status ' => 'Active'
								);
								$this->Users_model->add_income($data_to_store);
								$this->Users_model->load_wallet($sponsor_data[0]['user_id'], 100, 'points' );

								$data_to_store = array(
									'user_id' => $sponsor_data[0]['user_id'],
									'send_to' => $sponsor_data[0]['user_id'],
									'amount' => 100,
									'status ' => 'Credit',
									'wallet_type' => 'Point',
									);
								$this->Users_model->add_transactions($data_to_store);


							}
						} else {
							$data_to_store = array(
								'user_id' => $direct_id,
								'amount' => 100,
								'user_send_by ' => $user_id,
								'type' => 'Upgrade Income',
								'pay_level' => 1,
								'status ' => 'Active'
								);
								$this->Users_model->add_income($data_to_store);
								$this->Users_model->load_wallet($direct_id, 100, 'points' );

								$data_to_store = array(
									'user_id' => $direct_id,
									'send_to' => $direct_id,
									'amount' => 100,
									'status ' => 'Credit',
									'wallet_type' => 'Point',
									);
								$this->Users_model->add_transactions($data_to_store);

						}
						if($placement_id[0]['children']<2) {
						$this->Users_model->load_wallet($placement_id[0]['user_id'], $package_name, 'sbv' );
						}
						$sbv = $placement_id[0]['sbv'] + $package_name;
						/*if($sbv >= 2000) {
							$package_level = 3; $p_amount = 1000;
							$this->checkout_model->update_profile($placement_id[0]['user_id'],array('user_level'=>3));
							$this->reverse_matrix_income($placement_id[0]['user_id'],$placement_id[0]['direct_id'],$package_level,$p_amount);

						}*/

						if($placement_id[0]['children']==1) {
							$package_level = 3; $p_amount = 1000;
							$this->Users_model->update_profile($placement_id[0]['user_id'],array('user_level'=>3));
							$this->reverse_matrix_income($placement_id[0]['user_id'],$placement_id[0]['direct_id'],$package_level,$p_amount);

						}
			
	}

	/*function autopool($user_id,$direct_id,$package_level,$package_name) {
		
				$placement_id = array();
				$user_info = $this->Users_model->get_user_info($user_id);
				$check = $this->Users_model->check_autopool($direct_id);
				if(!empty($check)) {
					$p = 0;
					$array_ids = array($check[0]['id']);
					while($p < 1) {
						$my_team = $this->Users_model->autopool_team($array_ids);
						if(!empty($my_team) && count($my_team) >= 2) {
							foreach($my_team as $team) {
								if($team['children'] < 2) {
									$placement_id[0] = $team; $p++;
									break;
								}
							}
							if(empty($placement_id)) {
								$array_ids = array_column($my_team,'id');
							}
							
						} else {
							$placement_id = $check; $p++;
						}

					}	

				} else {  $placement_id = $this->Users_model->get_autopool_placement(); }
			$data_to = array(
			'user_id' => $user_id,
			'parent_id' => $placement_id[0]['id'],
			'direct_id' => $direct_id
			); 
			$this->Users_model->insert_autopool_data($data_to);
			$this->Users_model->update_autopool_child_num($placement_id[0]['id']);

			$data = array(
						'user_id' => $placement_id[0]['user_id'],
						'type' => 'Level Income',
						'pay_level' => 1,
						'amount' => 1000,
						'status ' => 'Active',
						'user_send_by ' => $user_id
						);
						$insert_id = $this->Users_model->add_income($data);

			
				
			
	}*/
	
	
	public function voucher() {
       if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');    }
     	$data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Income Report';
        $data['page_title'] = 'Income Report';  
        $id = $this->session->userdata('cust_id');
        $customer_id = $this->session->userdata('bliss_id');
    	$data['profile'] = $this->Users_model->profile($id);
     	$data['voucher'] = $this->Users_model->get_voucher($id);
    	$data['main_content'] = 'admin/voucher';
        $this->load->view('includes/admin/template', $data); 
  } 
  
  public function voucher_product() {

  	$ids = $this->uri->segment(3);
    $data['page_keywords'] = '';            
    $id = $this->session->userdata('cust_id');
    $customer_id = $this->session->userdata('bliss_id');
    $data['profile'] = $this->Users_model->profile($id);
    $data['voucher_data'] = $this->Users_model->get_voucher_by_id($ids);
	$data['all_voucherss'] = $this->Users_model->get_all_voucherss($ids);
	$data['st_voucher']=$data['all_voucherss'][0]['attribute'];
	$data['st_vouchers'] = json_decode ($data['st_voucher'],TRUE);
	if ($this->input->server('REQUEST_METHOD') === 'POST')
	{ 
			$_POST = json_decode(file_get_contents('php://input'), true);
            //form validation
            $this->form_validation->set_rules('type', 'type', 'required|trim');
            $otp=$this->input->post('otp');
    		$otp_exist=$this->session->userdata('otp_number');


			if(!empty($this->input->post('data'))) {
				$total_amount = 0;
				foreach($this->input->post('data') as $order) {
					$total_amount = $total_amount + ($order['price']*$order['qty']);
				}
			}
			

			if(empty($this->input->post('data'))) {
				$this->form_validation->set_rules('prghice', 'price', 'required');
				$this->form_validation->set_message('required', 'Choose any.');
			}
			elseif($data['profile'][0]['points'] < $total_amount){
				 $this->form_validation->set_rules('prghice', 'price', 'required');
				 $this->form_validation->set_message('required', 'Your wallet have less amount');
			}
			else if($data['profile'][0]['consume']==0){
				 $this->form_validation->set_rules('prghice', 'price', 'required');
				 $this->form_validation->set_message('required', 'Please Active your ID first.');
			}
           	if($otp_exist!='') {
				//$this->form_validation->set_rules('otp', 'OTP', 'required');
				if($otp_exist!=$otp && $otp!='') {
					$this->form_validation->set_rules('error', 'term and condition', 'required');
					$this->form_validation->set_message('required', 'Incorrect OTP.');
				}
			}
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {    

            	if ($otp=='' || $this->input->post('type')=='OTP') {
				$phone =  $data['profile'][0]['phone'];
				$email =  $data['profile'][0]['email'];
				$otp_crt = rand(100000,999999);	
		    	$data['veryfied_msg_otp'] = $otp_crt;
		    	$this->session->set_userdata('otp_number',$otp_crt);
				if($phone != '') {
					$phone = $data['profile'][0]['phone'];
					$sms_msg = urlencode("Dear ".$this->session->userdata('full_name')." Use this One Time Password ".$otp_crt." to complete your registration process. Regards, Unitymall Inc."); 
					$smstext ="http://trans.businesskarma.in/api/v4/?api_key=A489d867d76419ff045781f5fc877e40a&method=sms&message=".$sms_msg."&to=".$phone."&sender=UNTYML";
					file_get_contents($smstext);
		    	}
		    	if($email != '') {
			    	$to = $email;
			    	$subject ="OTP form :- OTP for unitymall";
			    	$txt = "Your OTP for unitymall is ".$otp_crt.""; 
			    	$headers = "From: unitymall.club"."\r\n";
			    	$headers = "MIME-Version: 1.0" . "\r\n";     
			    	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
			    	$headers .= 'From: <unitymall.club>' . "\r\n"; 
			    	mail($to,$subject,$txt,$headers);
		    	}

		    	$this->session->set_flashdata('flash_message', 'otp');
				//redirect('admin/voucher');
				echo json_encode(array('message'=>'<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>OTP Sent to your phone or email.</strong></div>'));
				} else {
				$this->Users_model->update_wallet($id,$total_amount,'points');
				$twallet_log = array(
					'user_id'=>$id,
					'amount' => $total_amount,
					'status' => 'Debit',
					'type' => 'Purchased',
					'wallet_type' => 'Point' 
					);
				$this->Users_model->add_transactions($twallet_log);
				
				$data_to_store = array(
                		'user_id' => $id,
				        'voucher_id'=>$data['voucher_data'][0]['id'],
                		'price' => $total_amount,
				        'pname' => $data['voucher_data'][0]['pname'],
				        'products' => json_encode($this->input->post('data')),
             		);
             
              if($this->Users_model->add_voucher($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                    /***************** SMS ******************/
                    $phone = $data['profile'][0]['phone'];
					$sms_msg = urlencode("Dear ".$this->session->userdata('full_name')." your ".$data['voucher_data'][0]['s_name']." Voucher request has been accepted and we process and send the Voucher details to your Registered Mobile ".$phone." and Email ID within 48 working hours. Team Unitymall Inc."); 
					$smstext ="http://trans.businesskarma.in/api/v4/?api_key=A489d867d76419ff045781f5fc877e40a&method=sms&message=".$sms_msg."&to=".$phone."&sender=UNTYML";
					file_get_contents($smstext);
		
			/***************** SMS ******************/
					$this->session->unset_userdata('otp_number');
					$this->session->set_flashdata('flash_message', 'updated');
					echo json_encode(array('success'=>'<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Congrats</strong></div>'));
					
                }else{ 
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
	 }
	} else { echo json_encode(array('errors'=>validation_errors()));  } 
	die();
	}
  
           
		$data['main_content'] = 'admin/product';
        $this->load->view('includes/admin/template', $data); 
   
	}
	public function payment(){ 
       
	 $id = $this->session->userdata('cust_id');
	  $customer_id = $this->session->userdata('bliss_id');
	  $user = $this->Users_model->profile($id);
	  $data['profile'] = $user;
	   $data['pin_error'] = '';
	   $razorpay = 'false'; 
	   
	 	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
		 	$this->form_validation->set_rules('TXN_AMOUNT', 'amount', 'required');
          	$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
             
          if ($this->form_validation->run())
          { 
          	if($this->input->post('how_to_pay')=='paytm') { $status= 'Process'; }
				else{ $status = 'Pending'; }
				$data_to_store = array(
					 'user_id' => $id,
					 'dis' => 'Load Wallet',
					 'cr' => $this->input->post('TXN_AMOUNT'),
					// 'qty' => $this->input->post('qty'),
					 'how_to_pay' => $this->input->post('how_to_pay'),
					 'status' => $status,
					 ); 
			  $order_id = $this->Users_model->add_order($data_to_store);
			
			
	  // $this->session->set_userdata('video_id', $this->input->post('video_id'));
	  // $this->session->set_userdata('web_type', $this->input->post('web_type'));
			
			$razorpay = 'true'; 
		}
	   
	
		}	  
		  if($razorpay == 'true') {
			
		$data['order_id'] = $order_id;
		$data['user_id'] = $id;
		$amount=$this->input->post('TXN_AMOUNT');
		$data['order_amt'] = $amount;
		$data['oname'] = $data['profile'][0]['f_name'];
		$data['phone'] = $data['profile'][0]['phone'];
		$data['email'] = $data['profile'][0]['email']; 
		$data['callback'] = base_url()."paymentresponcewallet/".$id ;
		$data['main_content'] = 'admin/paytmredirect'; 
		}
		else {
		$data['main_content'] = 'admin/payment'; 
			}	  
	     
        $data['history'] = $this->Users_model->get_transaction_summery($id);
        $this->load->view('includes/admin/template', $data); 
   }

	
	
	
}
	
	
	
