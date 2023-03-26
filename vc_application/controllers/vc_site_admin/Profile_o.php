<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller {
	private $left_user = array();
private $right_user = array();
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
         $this->load->model('Users_model');

       if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
       
    }

	
	
  public function index() {
		 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'profile';
                $data['page_title'] = 'Profile'; 
	
	$url = $this->uri->segment(1);	
	if($url=='admin') { redirect(base_url('distributor'));  }
   
         $data['myfriends'] = array();
		$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
		$data['rhistory'] = array(); //$this->Users_model->rewardhis($id);
		
		/************ friend level 1 ******************/
        $myfriends = $this->Users_model->my_friends($customer_id);
		$data['left_user'] = $data['right_user'] = 0;
		$myfriendid = array($id);
		if(!empty($myfriends)) {
            foreach($myfriends as $friend) {
				if($friend['position']=='power') { $data['left_user'] = $data['left_user'] + 1; }
				if($friend['position']=='other') { $data['right_user'] = $data['right_user'] + 1; } 
			}
        } 
		
		$ciruserlimit = 0;
		 
		$data['ciruserlimit'] = $ciruserlimit;
		
		$data['products'] = $this->Users_model->my_orders($id);
		$data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
		$data['total_incomes'] = $this->Users_model->total_incomes($id);
		$data['redeem_amount'] = $this->Users_model->bliss_perk_redeem_amount($id);
		$data['bliss_perk_history'] = ''; //$this->Users_model->bliss_perk_history($id);
		//$pv_info = $this->Users_model->get_pv($cid);

		$data['redeem_error'] = '';
		
	
		$data['invite_email'] = '';
		if ($this->input->server('REQUEST_METHOD') && $this->input->post('submit4')=='Share via Email') {
			$to = $this->input->post('email');
            $subject = "invitation from blisszone.com";
            $txt = $this->input->post('textmsg');
            $headers = "From: blisszone.com" . "\r\n";
			
			$headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: Blisszon <info@blisszon.com>' . "\r\n";

            mail($to,$subject,$txt,$headers);
			$data['invite_email'] = 'mail sent successfully';
		}
		
	
		$sharing = $this->Users_model->sharing_bonus($id);
						$total_sharing = 0;
					if(!empty($sharing)) {
							foreach($sharing as $bdm) {
									$total_sharing = $total_sharing + $bdm['amount'];
							}
						}
		
		$data['total_sharing'] = $total_sharing;
		$fund = $this->Users_model->my_fund($id);
						$total_fund = 0;
					if(!empty($fund)) {
							foreach($fund as $bdm) {
									$total_fund = $total_fund + $bdm['amount'];
							}
						}
		$data['total_fund'] = $total_fund;
		$data['main_content'] = 'admin/admin_welcome';
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function get_friend_by_id($customer_id){
	  $return = array('name'=>'','friends'=>'','return'=>'false');
	  $myfriends = $this->Users_model->my_friends($customer_id);
		if(!empty($myfriends)) { 
            foreach($myfriends as $friend) {
				$inner_friends_array = $this->Users_model->my_friends($friend['customer_id']);
				$inner_friends = count($inner_friends_array);
				$return = array('name'=>$friend['f_name'].' '.$friend['l_name'],'friends'=>$inner_friends,'return'=>'true');
			}
                }
				return $return; 
  }
  
   public function profile(){ 
	 $id = $this->session->userdata('cust_id');
	     $customer_id = $this->session->userdata('bliss_id');

			if ($this->input->server('REQUEST_METHOD')) {
            /*form validation*/
           $this->form_validation->set_rules('f_name', 'first name', 'required|trim|min_length[2]');
           $this->form_validation->set_rules('l_name', 'last name', 'required|trim|min_length[2]');
           $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');
           $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');

			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  // file upload start here
            	$image = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image')) { 
                    if($this->input->post('image_old')!='') unlink('images/user/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
						$var_status = $this->input->post('var_status');
					}
            else { $image = $this->input->post('image_old'); }
			
			
			
                $data_to_store = array(
                    'f_name' => $this->input->post('f_name'),
                    'l_name' => $this->input->post('l_name'),
                    'image' => $image,  
                    'gender' => $this->input->post('gender'), 
                    'dob' => $this->input->post('dob'),
                    'phone' => $this->input->post('phone'),  
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'), 
                    'pincode' => $this->input->post('pincode'),                   
					'nominee' => $this->input->post('nominee'),   
					'nominee_rel' => $this->input->post('nominee_rel'),      
					'nominee_dob' => $this->input->post('nominee_dob'),
					
				); 
             $return = $this->Users_model->update_profile($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect(base_url().'admin/profile');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }

       $data['profile'] = $this->Users_model->profile($id);
        //load the view
        $data['main_content'] = 'admin/profile'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
   public function pins(){ 
	 $id = $this->session->userdata('cust_id');
	  $customer_id = $this->session->userdata('bliss_id');
	  $user = $this->Users_model->profile($id);
	  $data['profile'] = $user;
	   $data['pin_error'] = '';
	     
	 if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('profile_tr_pin')!='') { 
	     
            $profile_tr_pin = $this->input->post('profile_tr_pin');
            $trpin = md5($profile_tr_pin);
	     if($user[0]['tr_pin']==$trpin){
            $this->session->set_userdata('profile_tr_pin','profile_tr_pin');
	     }
	     else { $data['pin_error'] = '<div class="alert alert-danger"><strong>Error!</strong> Your PIN is wrong. Please try again.</div>'; }
        }
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('logout_tr_pin')=='yes') {  
            $this->session->set_userdata('profile_tr_pin','');
        }
        
		  $pin_code = $this->uri->segment(3);
		if($pin_code !='') { 	redirect(base_url('admin/pin_activate/'.$pin_code));  	}	  
			  
	     $data['pin'] = $this->Users_model->get_all_pin($customer_id);
	     
	     
        //load the view
        $data['main_content'] = 'admin/pins'; 
        $this->load->view('includes/admin/template', $data); 
   }
   
   public function repurchase_pins(){ 
	 $id = $this->session->userdata('cust_id');
	  $customer_id = $this->session->userdata('bliss_id');
	  $user = $this->Users_model->profile($id);
	  $data['profile'] = $user;
	   $data['pin_error'] = '';
	     
	 if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('profile_tr_pin')!='') { 
	     
        $profile_tr_pin = $this->input->post('profile_tr_pin');
        $trpin = md5($profile_tr_pin);
	    if($user[0]['tr_pin']==$trpin){
           $this->session->set_userdata('profile_tr_pin','profile_tr_pin');
	    }
	    else { $data['pin_error'] = '<div class="alert alert-danger"><strong>Error!</strong> Your PIN is wrong. Please try again.</div>'; }
      }
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('logout_tr_pin')=='yes') {  
            $this->session->set_userdata('profile_tr_pin','');
        }
         
	    $data['pin'] = $this->Users_model->get_all_pin($customer_id,'1');
	     
	      
        $data['main_content'] = 'admin/repurchase_pins'; 
        $this->load->view('includes/admin/template', $data); 
   }
   
	public function add_pv_income($cid,$user_level,$reward,$position,$distribution_amount,$cust_id,$order_id,$repurchase,$customer_id,$package) { 
		if($cid=='0' || $cid == '' || $user_level=='0') { return ''; }
		if($repurchase=='yes') { $sale_type = '2';  $caping = $user_level*10000;
		} 
		else { 
		$sale_type = '1'; 
		$caping = $user_level*525;
		
		}
		
		$pv_info = $this->Users_model->get_pv($cid,$sale_type);
		$left = $right =  $matching = 0;
		
		if(!empty($pv_info)) {
			$total_final_pv = 0;
			$date = date('Y-m-d');
			$friday = strtotime("last friday");
			$thursday = strtotime(date("Y-m-d",$friday)." +6 days");
			$this_week_sd = date("Y-m-d 00:00:01",$friday);
			$this_week_ed = date("Y-m-d 23:59:59",$thursday);
			$redeem_pv = $this->Users_model->get_matching_pv_by_date($cid,$date,$sale_type);
			if(!empty($redeem_pv)) {
				$matching = $redeem_pv[0]['redeem_pv'];
			}
			if($matching=='') { $matching = 0; }
			$matching_pv = $this->Users_model->get_matching_pv($cid,$sale_type);
			if(!empty($matching_pv)) {
				$total_final_pv = $matching_pv[0]['total_pv'];
			}
			if($total_final_pv=='') { $total_final_pv = 0; }
			$update_ids = array();
			$d_left = $d_right = 0;
			if($position == 'left') { $left = $distribution_amount; $d_left = $d_left + 1;  } else { $right = $distribution_amount; $d_right = $d_right +1;  }
			foreach($pv_info as $val) { 
				if(strstr($val['type'],'right') && $val['status']=='Active') { 
					$right = $right + $val['amount']; 
					$update_ids[] = $val['id']; 
					$d_right = $d_right +1; 
				}
				if(strstr($val['type'],'left') && $val['status']=='Active') { 
					$left = $left + $val['amount']; 
					$update_ids[] = $val['id']; 
					$d_left = $d_left + 1; 
				}
			}
			$total = $left + $right;	
			$add_income = 'true';
			if($sale_type == '1') {
				if($total_final_pv < 50) {
					if(($d_left >= 1 && $d_right >= 2) || ($d_right >= 1 && $d_left >= 2)) {}
					else { $add_income = 'false'; }
				}
				elseif($left >= 1 && $right >= 1) {}
				else { $add_income = 'false'; }
			}

			if($add_income == 'true') {
				if($left > $right) { $final_total = $right; }
				else { $final_total = $left; }
				/************  add matching ********/
				$income_pv = $final_total*105;
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
				  //$this->matching_amount[] = array('cid'=>$cid,'matching_amt'=>$income_pv);
				}
				//die();
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
					
					if($package == '1') { $dis_amount_1 = $final_income/10; $tu_amt = (90/100)*$final_income; }
				elseif($package == '5') { $dis_amount_1 = $final_income/4; $tu_amt = (75/100)*$final_income; }
				elseif($package == '10') { $dis_amount_1 = $final_income/2; $tu_amt = (50/100)*$final_income; }
				else { $dis_amount_1 = 0; $tu_amt = 0; }
					
					$this->income[] = array('user_id'=>$cid,'amount'=>$tu_amt,'tds'=>$tu_amt/20,'admin'=>$tu_amt/20,'net_income'=>(9/10)*$tu_amt);
					$this->matching_amount[] = array('cid'=>$cid,'matching_amt'=>$final_income);
					
				}
				/**************** add carry forward *************/
				$position = '';
				if($left > $right) { $carry_forward = $left - $right; $position = 'left'; }
				elseif($left < $right) { $carry_forward = $right - $left; $position = 'right'; }
				else { $carry_forward = 0; }
				

				if($carry_forward > 0) {
					$this->add_pv[] = array('order_id'=>'0','amount'=>$carry_forward,'user_id_send_by'=>'0','pay_level'=>'0','user_id'=>$cid,'sale_type'=>$sale_type,'type'=>'PV '.$position,'status'=>'Active');
				}
				/****************** update pv status to redeem **************/
				if(!empty($update_ids)) {
				  $this->Users_model->update_gbv_status_by_ids($update_ids); 
				}  
			}
			
					$m_reward = 0; 
					if($total_final_pv >= 35*105 && $reward == '0' ) { 
					$package = array('reward'=>'1');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 4900;
					}
					
					if($total_final_pv >= 105*105 && $reward == '1'  ) {  
					$package = array('reward'=>'2');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 9800; }
					
					if($total_final_pv >= 245*105 && $reward == '2' ) {
                    $package = array('reward'=>'3');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 19600; }
					
					if($total_final_pv >= 525*105 && $reward == '3' ) { 
                    $package = array('reward'=>'4');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 39200; }
					
					if($total_final_pv >= 1125*105 && $reward == '4' ) { 
                    $package = array('reward'=>'5');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 8400; }
					
					if($total_final_pv >= 2375*105 && $reward == '5' ) { 
                    $package = array('reward'=>'6');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 175000;}
					
					if($total_final_pv >= 5375*105 && $reward == '6' ) { 
                    $package = array('reward'=>'7');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 420000;}
					
					if($total_final_pv >= 10875*105 && $reward == '7' ) { 
                    $package = array('reward'=>'8');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 770000; }
					
					if($total_final_pv >= 38375*105 && $reward == '8' ) { 
					$package = array('reward'=>'9');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 3850000; }
					
					if($total_final_pv >= 93375*105 && $reward == '9' ) { 
					$package = array('reward'=>'10');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 7700000; }
					
					if($total_final_pv >= 643375*105 && $reward == '10' ) { 
					$package = array('reward'=>'11');
					$this->Users_model->update_profile($cid,$package);
					$m_reward = 77000000; }
					
					if($m_reward > 0) {
					   // $this->income[] = array('amount'=>$m_reward,'user_id'=>$cid,'type'=>'Reward','status'=>'Active'); 
					}
		}
	}
	  
   
	function goDownLeftLevelDirect($customerid){ 
	if(empty($customerid)) { return false; }
	 $return = array();
	 $children = $this->Users_model->my_child($customerid); //underlying SQL function 
	 if(!empty($children)){  
	  foreach($children as $child){ 
	    $this->left_user[] = $child['customer_id']; 
		for($i=0;$i<$child['package'];$i++) { $this->left_user[] = $child['customer_id']; }
		$this->goDownLeftLevelDirect($child['customer_id']);
	  }  
	 } 
		 return $return;
	}
	
	function goDownRightLevelDirect($customerid){ 
	if(empty($customerid)) { return false; }
	 $return = array();
	 $children = $this->Users_model->my_child($customerid); //underlying SQL function 
	 if(!empty($children)){  
	  foreach($children as $child){ 
	    $this->right_user[] = $child['customer_id'];  
		for($i=0;$i<$child['package'];$i++) { $this->right_user[] = $child['customer_id']; }
	    $this->goDownRightLevelDirect($child['customer_id']);
	  } 
	 } 
		 return $return;
	}
	
	
	    public function upgrade_package(){ 
	  // $direct_user_level = $this->Users_model->direct_user_info_from_user_id(15);
	  //print_r($direct_user_level);
	   $trpin = $this->session->userdata('profile_tr_pin');
	  // if($trpin=='') { redirect(base_url('admin/pins')); }
	   
	 $id = $this->session->userdata('cust_id');
	 $customer_id = $this->session->userdata('bliss_id');
	$data['profile'] = $this->Users_model->profile($id);
	    $data['user'] = $data['pin'] = array(); 
		$pin_code = $this->uri->segment(3);
		 $user = $this->Users_model->get_customer_by_id($customer_id);
		 
		 $data['user'] = $user;
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            /*form validation*/
			$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
			//$this->form_validation->set_rules('pins', 'No. of E-Pin', 'required|trim|numeric');
			
			//$customer_id = $this->input->post('assign_to');
			
            
            if(empty($user)) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user is not exist'); 
            }
			 
			
			$new=explode('~~',$this->input->post('product'));
			$product = $this->Users_model->select_products_by_id($new[0]);
			$package_amount = $new[1];
			$package_amount = round($package_amount);
			if($package_amount > $data['profile'][0]['bliss_amount']) {
			   $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
			   $this->form_validation->set_message('required', 'Your Wallet have less Amount'); 
			  
		   }
		    if($user[0]['user_level'] < 1) {
			   $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
			   $this->form_validation->set_message('required', 'Please Activate your Id first.'); 
		   } 
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  
				$this->income = array();
				$this->add_pv = array();
				$distribution = FALSE;
			 	$return = FALSE;
		        $cust_id = $user[0]['id'];  
		        $customer_id = $user[0]['customer_id']; 
				$direct_customer_id = $user[0]['dcustomer_id']; 
		        $order_id = $new[0];
				$product_amt = $new[1]; 
				$distribution_amount = $new[2]; 
				$this->binary_level_income = array();
			//	$this->update_wallet = array();
				  if($customer_id != '' && $cust_id != '' && $distribution_amount > 1) { 
				  
				     /******************* update pin ***********/
					 $date = date('Y-m-d');
				   $add_salary = array();
					$user_level =  $user[0]['user_level'];
					if($user[0]['user_level'] > 0) {
						$package = array('consume'=>'1','package_used'=>$date);
						$this->Users_model->update_profile($cust_id,$package);
						$this->Users_model->update_wallet($id,$product_amt,'bliss_amount');
			
					$image = base_url().'main-admin/images/product/'.$product[0]['image'];
					$desc = $product[0]['s_discription'];
					 
					$cart = array(
					   'id' => $product[0]['id'],
					   'tax' => $product[0]['tax'],
					   'name' => $product[0]['pname'],
					   'p_name' => $product[0]['pname'],
					   'price' => $product[0]['p_d_price'],
					   'cost' => $product[0]['cost'],
					   'qty' => '1', 
				   'comm_dis' => $product[0]['bv'],
				   'p_d_price' => $product[0]['p_d_price'],
					   'i_total' => $product[0]['p_d_price'], 
				   'options' => array('image' => $image, 'desc' => $desc)
					 );
					
					 $items = json_encode($cart);
					
					$data_to_store = array(
					'user_id' => $cust_id,
                     'p_name' => $user[0]['f_name'],
					 'p_email' => $user[0]['email'], 
					 'p_phone' => $user[0]['phone'],
					 'p_address' => $user[0]['address'],
					 'p_city' => $user[0]['city'],
					 'p_state' => $user[0]['state'],
					 'p_zip' => $user[0]['pincode'],
					 'how_to_pay' => 'bliss_perk',
                     'total_amount' => $product[0]['p_d_price'],
					 'comm_dis' => $distribution_amount,
					 'items' => $items
					 ); 
			  $order_id = $this->Users_model->store_order($data_to_store);
			  
					
					//$distribution = TRUE;
					$return = TRUE;
					} 

				}
				
				if($distribution == TRUE ) {
						$parent_customer_id = $direct_customer_id; 
						$dis_level = 1;
						$p = 0;
						
						while($p < 8) {
						
						$parent_user = $this->Users_model->profile_by_customer_id($parent_customer_id);
						
						if(!empty($parent_user)) { 
						
						if($dis_level == 1) { $dis_amount = (10/100)*$distribution_amount; }
						elseif($dis_level == 2) { $dis_amount = (8/100)*$distribution_amount; }
						elseif($dis_level == 3) { $dis_amount = (5/100)*$distribution_amount; }
						elseif($dis_level == 4) { $dis_amount = (3/100)*$distribution_amount; }
						elseif($dis_level == 5) { $dis_amount = (2/100)*$distribution_amount; }
						elseif($dis_level == 6) { $dis_amount = (1/100)*$distribution_amount; }
						elseif($dis_level == 7) { $dis_amount = $distribution_amount/200; }
						elseif($dis_level == 8) { $dis_amount = $distribution_amount/200; }

						$this->add_pv[] = array('user_id'=>$parent_user[0]['id'],'amount'=> $dis_amount,'user_id_send_by'=>$cust_id,'pay_level'=>$dis_level,'type'=>'Leadership Income','status'=>'Active');  
						
						$this->binary_level_income[] = array('user_id'=>$parent_user[0]['id'],'payby'=>$cust_id,'binary_level_income'=>$dis_amount,'tds'=>($dis_amount/20),'admin'=>($dis_amount/20),'net_income'=>(9/10)*$dis_amount);
						
						
						
						  $parent_customer_id = $parent_user[0]['direct_customer_id'];
						  $dis_level = $dis_level + 1;
						  $p++;
						} else { $p = 50; }
					}
					  if(!empty($this->add_pv)) {
					  $this->Users_model->insert_batch('distribution_amount',$this->add_pv);
				  }
					 if(!empty($this->income)) {
					  $this->Users_model->insert_batch('binary_income',$this->income);
				  }
				  if(!empty($this->binary_level_income)) {
					  $this->Users_model->insert_batch('binary_level_income',$this->binary_level_income);
				  }
					}
				
				
			  /**************** end payment distribution *******************/
			 
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'activated');
					redirect('admin/upgrade_package');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       
		 $data['product'] = $this->Users_model->select_products();
	     
        //load the view
        $data['main_content'] = 'admin/upgrade_package'; 
        $this->load->view('includes/admin/template', $data); 
   }
   
   
	
     public function transfer_pin(){ 
	  // $direct_user_level = $this->Users_model->direct_user_info_from_user_id(15);
	  //print_r($direct_user_level);
	   $trpin = $this->session->userdata('profile_tr_pin');
	  // if($trpin=='') { redirect(base_url('admin/pins')); }
	   
	 $id = $this->session->userdata('cust_id');
	$data['profile'] = $this->Users_model->profile($id);
	    $data['user'] = $data['pin'] = array(); 
		$pin_code = $this->uri->segment(3);
	    if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('find_customer')!='')
        { 
			$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim'); 
			 
             $data['user'] = $this->Users_model->get_customer_by_id($this->input->post('assign_to'));
            if(empty($data['user'])) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user is not exist'); 
            } 
			
			$pin = $this->Users_model->get_pin_by_user($pin_code,$data['profile'][0]['customer_id']);
			$data['pin'] = $pin;
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
			}
			
		}
        elseif ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            /*form validation*/
			$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
			//$this->form_validation->set_rules('pins', 'No. of E-Pin', 'required|trim|numeric');
			$pin = $this->Users_model->get_pin_by_user($pin_code,$data['profile'][0]['customer_id']);
			if($pin[0]['package'] < 4) {
			$new=explode('~~',$this->input->post('product'));
			if($new[1]!=$this->input->post('pin_amt')){
				$this->form_validation->set_rules('amt', '', 'required'); 
				$this->form_validation->set_message('required', 'Your product not match with pin amount'); 
				}
			}
			$customer_id = $this->input->post('assign_to');
			
             $user = $this->Users_model->get_customer_by_id($customer_id);
            if(empty($user)) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user is not exist'); 
            } else {
				$data['user'] = $user;
			}
			 
			
			$user_level = $pin[0]['b_volume'];
			$user_level = round($user_level,2);
			if(empty($pin)) { 
				$this->form_validation->set_rules('start_date', '', 'required'); 
				$this->form_validation->set_message('required', 'Please check your PIN.'); 
			}
			elseif($pin[0]['status']!='Active') { 
				$this->form_validation->set_rules('start_date', '', 'required'); 
				$this->form_validation->set_message('required', 'This PIN is deactivate or already used.');   
			}
			elseif(($pin[0]['assign_to']!=$data['profile'][0]['customer_id']) && ($pin[0]['move_to']!=$data['profile'][0]['customer_id'])) { 
				$this->form_validation->set_rules('start_date', '', 'required'); 
				$this->form_validation->set_message('required', 'You can not use this PIN.');   
			} 
			/* elseif($user[0]['user_level']=='0' && $pin[0]['p_amount'] < 1499) {  
				$this->form_validation->set_rules('start_date', '', 'required'); 
				$this->form_validation->set_message('required', 'First PIN must be at least 1500.');   
			} */
			elseif($user[0]['user_level'] > 0 && $user_level <= $user[0]['user_level']) {  
				$this->form_validation->set_rules('start_', '', 'required'); 
				$this->form_validation->set_message('required', 'You can not use small package than current Package.');   
			}
			elseif($user[0]['user_level'] == '0' && $pin[0]['package'] > 3) {  
				$this->form_validation->set_rules('start_', '', 'required'); 
				$this->form_validation->set_message('required', 'Please Activate your ID first.');   
			}
			/*elseif($pin[0]['p_amount'] > 4000) {  
				$this->form_validation->set_rules('start_date', '', 'required'); 
				$this->form_validation->set_message('required', 'Please check your PIN amount.');   
			}*/
			elseif($user[0]['user_level'] > 0 && ($pin[0]['package'] =='1' || $pin[0]['package'] =='2') ) { 
			    $errormsg = 'You can not use package PIN again.';
				$this->form_validation->set_rules('start_date', '', 'required'); 
				$this->form_validation->set_message('required', $errormsg);   
			}
			$data['pin'] = $pin;
			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  
                $distribution = FALSE;
			 	$return = FALSE;
		        $cust_id = $user[0]['id'];  
		        $customer_id = $user[0]['customer_id'];  
		        $order_id = $pin[0]['id'];
				$distribution_amount = $pin[0]['b_volume'];
				$this->matching_id = array();
				$this->matching_amount = array();
				$this->add_pv = array();
				$this->income = array();
				$this->binary_level_income = array();
				$repurchase = '';
				
				  if($customer_id != '' && $cust_id != '' && $distribution_amount > 0 && $pin[0]['franchisee'] == '0'  ) { 

					if($user[0]['user_level']=='0') {
						/******************* update pin ***********/
						$date = date('Y-m-d');
				    $this->Users_model->update_pin($pin_code,$customer_id,$date); 
						$package = array('user_level'=>$user_level,'package'=>$user_level,'package_used'=>$date);
						$this->Users_model->update_profile($cust_id,$package); 
						/*************** direct sponcer ****************/
					
						//$add_income = array('amount'=>$pin[0]['p_amount']*(7/100),'user_id'=>$user[0]['did'],'type'=>'Direct','payby'=>$user[0]['id'],'status'=>'Active');  
					   // $this->Users_model->insert_table_data('direct_income',$add_income);
						
						$add_income = array('user_id'=>$user[0]['did'],'payby'=>$cust_id,'amount'=>$pin[0]['p_amount']*(7/100),'net_income'=>$pin[0]['p_amount']*(7/100));
						$this->Users_model->insert_table_data('direct_income',$add_income);
						
						$directs = $this->Users_model->get_direct_user_id_by_eligible($user[0]['dcustomer_id'],$user[0]['duser_level']); 
						
						if($user[0]['duser_level'] <= 1 && $user[0]['dup_req'] == '0') {
							if(count($directs) >= 2 ) {
							$arr = array('up_req'=>1);
							$this->Users_model->update_profile($user[0]['did'],$arr);
							}
						} 
						elseif($user[0]['duser_level'] <= 10 && $user[0]['dup_req'] == '0')
						{
							if(count($directs) >= 10) {
							$arr = array('up_req'=>2); 
							$this->Users_model->update_profile($user[0]['did'],$arr);
							}
						}
							
						/*************** direct sponcer end ****************/
						
						
					//$add_pv = array('order_id'=>$order_id,'amount'=>$distribution_amount,'user_id'=>$user[0]['did'],'type'=>'Direct '.$user[0]['position'],'user_id_send_by'=>$cust_id,'status'=>'Active');
					//$update_ids[]=$this->Users_model->add_distribution($add_pv);
					$repurchase = 'no';
					$sale_type = '1';
					$distribution = TRUE;
					
				} elseif($user_level > $user[0]['user_level']) {
					//$repurchase = 'no'; $sale_type = '1';
			
					/******************* update pin ***********/
					$date = date('Y-m-d');
					$this->Users_model->update_pin($pin_code,$customer_id,$date); 
					$package = array('user_level'=>$user_level,'package_used'=>$date);
					$this->Users_model->update_profile($cust_id,$package);
				}
				$count_bv = array();
				$position = $user[0]['position']; 
				$pos = substr($position,0,1).'bv';
					$parent_customer_id = $user[0]['parent_customer_id']; 
					$dis_level = 1;
					$p = 0;
					$compare_date = date('Y-m');
					if($parent_customer_id != '' && $repurchase != '') {
					while($p < 1) {
						$parent_user = $this->Users_model->profile_by_customer_id($parent_customer_id); 
						if(!empty($parent_user)) { 
						  $this->add_pv[] = array('order_id'=>$order_id,'amount'=>$distribution_amount,'user_id'=>$parent_user[0]['id'],'type'=>'PV '.$position,'user_id_send_by'=>$cust_id,'sale_type'=>$sale_type,'status'=>'Active','pay_level'=>$dis_level);
						 
						    $this->add_pv_income($parent_user[0]['id'],$parent_user[0]['user_level'],$parent_user[0]['reward'],$position,$distribution_amount,$cust_id,$order_id,$repurchase,$parent_user[0]['customer_id'],$parent_user[0]['package']); 
						  
						  if($position == 'left') { 
							 $count_bv[] = array('id'=>$parent_user[0]['id'],'lbv'=>$parent_user[0]['lbv']+$distribution_amount,'rbv'=>$parent_user[0]['rbv'],'plcount'=>$parent_user[0]['plcount']+1,'prcount'=>$parent_user[0]['prcount']);
						  }
						 else {
							 $count_bv[] = array('id'=>$parent_user[0]['id'],'lbv'=>$parent_user[0]['lbv'],'rbv'=>$parent_user[0]['rbv']+$distribution_amount,'plcount'=>$parent_user[0]['plcount'],'prcount'=>$parent_user[0]['prcount']);
						 }
						  $parent_customer_id = $parent_user[0]['parent_customer_id'];
						  $position = $parent_user[0]['position'];
						  $pos = substr($position,0,1).'bv';
						  $dis_level = $dis_level + 1;
						  $p = 0;
						} else { $p++; }
					}
				  }
				  
				 
				  
				  
					$return = TRUE;
				
				
				  } elseif($customer_id != '' && $cust_id != ''  && $pin[0]['franchisee'] == '1'  ) {
					  
					$date = date('Y-m-d');
					$this->Users_model->update_pin($pin_code,$customer_id,$date); 
				    
				    $arr = array('franchise'=>$distribution_amount); 
					$this->Users_model->update_profile($user[0]['did'],$arr);
					$return = TRUE;
					  
				  }
				  
				  if($distribution == TRUE ) {
				      
				      
				      if(!empty($this->matching_amount)) {
				        
				          foreach ($this->matching_amount as $matching) {
				        $p_amount = $matching['matching_amt'];
				        $parent_id = $matching['cid']; 
						$dis_level = 1;
						$p = 0;
						$dis_amount = 0;
						while($p < 5) {
						$parent_user = $this->Users_model->parent_bliss($parent_id);
						if(!empty($parent_user)) { 
						if($parent_user[0]['user_level'] <= 1) { $dis_amount = $p_amount/50; }
						elseif($parent_user[0]['user_level'] <= 5) { $dis_amount = $p_amount/20; }
						elseif($parent_user[0]['user_level'] <= 10) { $dis_amount = $p_amount/10; }
						else { $dis_amount = 0; }
						if($dis_amount > 0 && $parent_user[0]['pid'] != '') {
						$this->add_pv[] = array('order_id'=>'0','user_id'=>$parent_user[0]['pid'],'amount'=> $dis_amount,'user_id_send_by'=>$cust_id,'sale_type'=>'0','pay_level'=>$dis_level,'type'=>'Level','status'=>'Active');  
						
						$this->binary_level_income[] = array('user_id'=>$parent_user[0]['pid'],'payby'=>$cust_id,'amount'=>$dis_amount,'tds'=>$dis_amount/20,'admin'=>$dis_amount/20,'net_income'=>(9/10)*$dis_amount);
						}
						  $parent_id = $parent_user[0]['pid'];
						  $dis_level = $dis_level + 1;
						  $p++;
						} else { $p = 50; }
					}
				              
				          }
				      }
				
					}
				
				  
				   if(!empty($this->add_pv)) {
					  $this->Users_model->insert_batch('distribution_amount',$this->add_pv);
				  }
				  if(!empty($this->income)) {
					  $this->Users_model->insert_batch('binary_income',$this->income);
				  }
				  
				  
				  if(!empty($this->matching_id)) {
					  $this->Users_model->update_distribution_amount($this->matching_id,$cust_id,$sale_type,array('status' => 'Redeem'));
					  $distribution = TRUE;
				  }
				  
				  if(!empty($this->binary_level_income)) {
					  $this->Users_model->insert_batch('binary_level_income',$this->binary_level_income);
				  }
				  
				  if(!empty($count_bv)) {
					  $this->Users_model->update_batch('customer',$count_bv,'id');
					 
				  }
				
			  /**************** end payment distribution *******************/
			 
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'activated');
					redirect('admin/pin_activate/'.$pin_code);
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       
        $data['product'] = $this->Users_model->select_products();
	     
        //load the view
        $data['main_content'] = 'admin/transfer_pin'; 
        $this->load->view('includes/admin/template', $data); 
   }
   
   
	public function welcomeletter(){  
  $id = $this->session->userdata('cust_id'); 
  $data['page_keywords'] = ''; 
  $data['page_description'] = '';
  $data['page_slug'] = 'welcomeletter'; 
  $data['page_title'] = 'welcomeletter';
  $data['profile'] = $this->Users_model->profile($id); 
  $data['main_content'] = 'admin/welcomeletter';
  $this->load->view('includes/admin/template', $data);   } 
  
   public function personal_details(){  
  $id = $this->session->userdata('cust_id'); 
  $data['page_keywords'] = ''; 
  $data['page_description'] = '';
  $data['page_slug'] = 'personal_details'; 
  $data['page_title'] = 'personal_details';
  $data['profile'] = $this->Users_model->profile($id); 
  $data['main_content'] = 'admin/personal_details';
  $this->load->view('includes/admin/template', $data);   }

  public function transfer_e_pin(){  
  $id = $this->session->userdata('cust_id'); 
  $customer_id = $this->session->userdata('bliss_id');
  $user = $this->Users_model->profile($id);
  
  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('profile_tr_pin')!='') { 
	     
            $profile_tr_pin = $this->input->post('profile_tr_pin');
            $trpin = md5($profile_tr_pin);
	     if($user[0]['tr_pin']==$trpin){
            $this->session->set_userdata('profile_tr_pin','profile_tr_pin');
	     }
	     else { $data['pin_error'] = '<div class="alert alert-danger"><strong>Error!</strong> Your PIN is wrong. Please try again.</div>'; }
        }
  
   if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit')=='Transfer E-Pins')
        {
            /*form validation*/
			$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
			
             $user = $this->Users_model->get_customer_by_id($this->input->post('assign_to'));
            if(empty($user)) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user is not exist'); 
            } 
			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
			 $data_to_store = array(
                    'move_to' => $this->input->post('assign_to'),
                    'status' => 'Active',
					);
			 $return = $this->Users_model->update_trnsfr_pin($this->input->post('pinid'), $data_to_store);
           
		

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/pins/transfer');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                
            }/*validation run*/

        }
  
  $data['profile'] = $this->Users_model->profile($id); 
  $data['available_pin'] = $this->Users_model->available_pin($customer_id); 
  $data['main_content'] = 'admin/transfer_e_pin';
  $this->load->view('includes/admin/template', $data);   } 
  
   public function kyc(){ 
	 $id = $this->session->userdata('cust_id');
	 $customer_id = $this->session->userdata('bliss_id');

if ($this->input->server('REQUEST_METHOD')) {
           
		   $var_status = 'no';
		   
		   $this->form_validation->set_rules('pancard', 'Pancard No.', 'required|trim');
           $this->form_validation->set_rules('aadhar', 'Aadhar NO.', 'required|trim');
		   
		   $pancard = $this->Users_model->pancard($id);
			if($pancard[0]['pancard'] != '') {
              $this->form_validation->set_rules('pancard_limit', 'redeem', 'required|trim');
              $this->form_validation->set_message('required', 'You can not update pancard twice');
           }
		   
		   $aadhar = $this->Users_model->aadhar($id);
			if($aadhar[0]['aadhar'] != '') {
              $this->form_validation->set_rules('aadhar_limit', 'redeemaa', 'required|trim');
              $this->form_validation->set_message('required', 'You can not update aadhar twice');
           }
			 
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  // file upload start here
          
			
			 $panimage = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1024';
           // $config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('panimage')) { 
                    if($this->input->post('panimage_old')!='') unlink('images/user/'.$this->input->post('panimage_old'));
                         $image_data = $this->upload->data();
					    $panimage = $image_data['file_name'];
					}
            else { $panimage = $this->input->post('panimage_old'); }
				  
			$aadharimage = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('aadharimage')) { 
                    if($this->input->post('aadharimage_old')!='') unlink('images/user/'.$this->input->post('aadharimage_old'));
                         $image_data = $this->upload->data();
					    $aadharimage = $image_data['file_name'];
					}
            else { $aadharimage = $this->input->post('aadharimage_old'); } 
			
			$back_aadharimage = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('back_aadharimage')) { 
                    if($this->input->post('back_aadharimage_old')!='') unlink('images/user/'.$this->input->post('back_aadharimage_old'));
                         $image_data = $this->upload->data();
					    $back_aadharimage = $image_data['file_name']; 
					}
            else { $back_aadharimage = $this->input->post('back_aadharimage_old'); } 
			
                $data_to_store = array(
                    'pancard' => $this->input->post('pancard'),
                    'panimage' => $panimage, 
                    'aadhar' => $this->input->post('aadhar'),
                    'aadharimage' => $aadharimage, 
                    'back_adhar_img' => $back_aadharimage, 
                    'var_status' => $var_status 
				); 
             $return = $this->Users_model->update_profile($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect(base_url().'admin/kyc_details');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                
            }/*validation run*/

        }

       $data['profile'] = $this->Users_model->profile($id);
       $data['parentid'] = $this->Users_model->parent_profile($data['profile'][0]['parent_customer_id']);
	  
        //load the view
        $data['main_content'] = 'admin/kyc_details'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
   public function bank_details(){ 
	 $id = $this->session->userdata('cust_id');
	     $customer_id = $this->session->userdata('bliss_id');

if ($this->input->server('REQUEST_METHOD')) {
            /*form validation*/
    
		   $this->form_validation->set_rules('bank_name', 'bank name', 'required|trim');
           $this->form_validation->set_rules('branch', 'branch', 'required|trim');
           $this->form_validation->set_rules('bank_state', 'bank state', 'required');
           $this->form_validation->set_rules('account_type', 'account type', 'required|trim');
           $this->form_validation->set_rules('account_no', 'account no', 'required|trim');
           $this->form_validation->set_rules('ifsc', 'ifsc', 'required'); 
			 
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		 $bank_img = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('bank_img')) { 
                    if($this->input->post('cancel_chq_old')!='') unlink('images/user/'.$this->input->post('bank_img_old'));
                         $image_data = $this->upload->data();
					    $bank_img = $image_data['file_name'];
					}
            else { $bank_img = $this->input->post('bank_img_old'); }
		
		
		
		
                $data_to_store = array(
					'bank_name' => $this->input->post('bank_name'),  
                    'branch' => $this->input->post('branch'), 
                    'account_name' => $this->input->post('account_name'),
                    'account_type' => $this->input->post('account_type'),  
                    'account_no' => $this->input->post('account_no'),
                    'bank_city' => $this->input->post('bank_city'),
                    'bank_state' => $this->input->post('bank_state'), 
                    'bank_img' => $bank_img, 
                    'ifsc' => $this->input->post('ifsc')
				); 
             $return = $this->Users_model->update_profile($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect(base_url().'admin/bank_details');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }

       $data['profile'] = $this->Users_model->profile($id);
       $data['parentid'] = $this->Users_model->parent_profile($data['profile'][0]['parent_customer_id']);
	  
        //load the view
        $data['main_content'] = 'admin/bank_details'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
   public function my_pin_transfer() {
		    $id = $this->session->userdata('cust_id');
		  $customer_id = $this->session->userdata('bliss_id');
			
			 if ($this->input->server('REQUEST_METHOD') === 'POST') {
			 
				   $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
				   $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
			}else{
				
				 $sdate = date('Y-m-1 00:00:01');
				 $edate = date('Y-m-t 23:59:59');
				 $status = ''; 			 
				
			}
			
			$data['pin'] = $this->Users_model->my_transfer_all_pin($sdate, $edate, $customer_id);
		
		//load the view
		$data['profile'] = $this->Users_model->profile($id);
		  $data['main_content'] = 'admin/my_pins_transfer';
		  $this->load->view('includes/admin/template', $data);   
	  }
	  
	   public function pin_request() {
		    $id = $this->session->userdata('cust_id');
		  $customer_id = $this->session->userdata('bliss_id');
			
			 
			
		  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('c_name', 'titlt', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('c_discription', 'discription', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='images/category/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else
                    {
                         $errors = $this->upload->display_errors();
						$image = '';
			        }
			        //----- end file upload -----------
			
				$data_to_store = array(
                    'c_name' => $this->input->post('c_name'),
					'c_description' => $this->input->post('c_discription'),
					'image' => $image,
				); 
               
			   
			   
				if($this->category_model->store_category($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/category/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
		 $data['profile'] = $this->Users_model->profile($id);
		  $data['main_content'] = 'admin/request_for_pin';
		  $this->load->view('includes/admin/template', $data);   
	  }

}