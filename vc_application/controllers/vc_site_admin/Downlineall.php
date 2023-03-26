<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Downlineall extends CI_Controller {
	private $user_list = array();
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('order_model');	
         $this->load->model('Users_model');

        if(!$this->session->userdata('is_customer_logged_in')){ redirect(base_url()); } 
    }
	
  
  
  public function index_old() {
    			$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);

	 $data['myfriends'] = array(); 
	$data['show_inner'] = 'false';
	$data['current_user'] = $customer_id;
	$inner_users = $this->uri->segment(3);

	$myfriends = $this->Users_model->friends_by_position($customer_id);
		$myfriendid = array($id);
		if(!empty($myfriends)) {
			foreach($myfriends as $friends) {
			    
			    if($inner_users=='') { $show = 'true'; }
			    elseif($inner_users=='left' &&  $friends['position']=='left') { $show = 'true'; }
			    elseif($inner_users=='right' &&  $friends['position']=='right') { $show = 'true'; }
			    else { $show = 'false'; }
			    
			    if($show=='true') {
			        $friends['dposition'] = $friends['position'];
				    $this->user_list[] = $friends;
				    $this->downallfriends($friends['customer_id'],$friends['position']);

			    } 
			}
        }

	$data['myfriends'] = $this->user_list;	
	
	//load the view
      $data['main_content'] = 'admin/downlineall';
      $this->load->view('includes/admin/template', $data);   
  }
    public function index() {
    			$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);

	 $data['myfriends'] = array(); 
	$data['show_inner'] = 'false';
	$data['current_user'] = $this->session->userdata('full_name');
	$inner_users = $this->uri->segment(3);

		$cus_array = array();
		$user_list = array();
		$cus_array[] = $customer_id;
		$myfriendid = array($id);
		$p=0;
		while($p<1) {
		$myfriends = $this->Users_model->friends_by_position_in_array($cus_array);
		if(!empty($myfriends)) {
			//$myfriends['level']=$p+1;
			$user_list = array_merge($myfriends,$user_list);
			$cus_array = array_column($myfriends,'customer_id');  
			
        } else { $p++; }
		}

		$sort['rdate'] = array_column($user_list, 'rdate');
 		array_multisort($sort['rdate'], SORT_DESC,$user_list);

 		$data['myfriends']=$user_list;
	
	//load the view
      $data['main_content'] = 'admin/downlineall';
      $this->load->view('includes/admin/template', $data);   
  }
  public function direct_distributor() {
    			$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);

	 $data['myfriends'] = array(); 
	$data['show_inner'] = 'false';
	$data['current_user'] = $this->session->userdata('full_name');
 
	$inner_friends_array = $this->Users_model->get_direct_customer_info($customer_id);
	if(!empty($inner_friends_array)) {
		$data['myfriends'] = $inner_friends_array;  
		//echo '<pre>'; print_r($data['myfriends']);die();
	}
  
	//load the view
      $data['main_content'] = 'admin/direct_distributor';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function order_view(){ 
	 $id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);

	  //order id 
        $id = $this->uri->segment(3);
     
        $data['order'] = $this->order_model->get_all_order_id($id); 
        //load the view
        $data['main_content'] = 'admin/downlineall'; 
        $this->load->view('includes/admin/template', $data); 
  }  
   public function right_users(){ 
	    			$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);

	 $data['myfriends'] = array(); 
	$data['show_inner'] = 'false';
	$data['current_user'] = $customer_id;
	$inner_users = $this->uri->segment(3);
	/*if($inner_users!='') {
				$inner_friends_array = $this->Users_model->power_friends($inner_users);
		$data['myfriends'][] = array('friends'=>$inner_friends_array,'level'=>0); 
		$data['show_inner'] = 'true';
		$data['current_user'] = $inner_users;
	} else {*/
	 $myfriends = $this->Users_model->friends_by_position($customer_id,'right');
		$myfriendid = array($id);
		if(!empty($myfriends)) {
			$this->user_list[] = $myfriends[0];
            $this->downallfriends($myfriends[0]['customer_id']);
        } 
	$data['myfriends'] = $this->user_list;
	//load the view
      $data['main_content'] = 'admin/right_users';
      $this->load->view('includes/admin/template', $data);   
  } 

	   public function left_users(){ 
    			$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
	
	$data['profile'] = $this->Users_model->profile($id);
	 $data['myfriends'] = array(); 
	$data['show_inner'] = 'false';
	$data['current_user'] = $customer_id;
	$inner_users = $this->uri->segment(3);
	$myfriends = $this->Users_model->friends_by_position($customer_id,'left');
		$myfriendid = array($id);
		if(!empty($myfriends)) {
			$this->user_list[] = $myfriends[0];
            $this->downallfriends($myfriends[0]['customer_id']);
        } 
	$data['myfriends'] = $this->user_list;
	//load the view
      $data['main_content'] = 'admin/left_users';
      $this->load->view('includes/admin/template',$data);   
  } 

   function downallfriends($customerid,$position=''){ 
		 $return = array();
		 $children = $this->Users_model->friends_by_position($customerid);
		//echo '<pre>'; print_r($children);die();
		 //underlying SQL function
		 if(!empty($children)){
				foreach($children as $child){
				    $child['dposition'] = $position;
					$this->user_list[] = $child;
					//echo '<pre>'; print_r($child);die();
					$this->downallfriends($child['customer_id'],$position);
				}
		 }  
		 return $return;
	}
	
    
	
	public function user_popup_info() {
	    if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('cid')!=''){
	        
	        $cust_id = $this->input->post('cid');
	       $user_info =  $this->Users_model->get_customer_by_id($cust_id);
	        if(!empty($user_info)) {
				
			/************ get total gpv in bridge and box *********/
			$left = $right = $left_leg = $right_leg = 0;
			$total_left_rbv = $total_right_rbv = 0;
            $total_lleft_rbv = $total_lright_rbv = 0;
			$bliss_amount = $this->Users_model->get_pv_by_id($user_info[0]['id']);		
		//	$repurchase_bv = $this->Users_model->fetch_table_data('repurchase_bv',$user_info[0]['id']);
			$left_pv = $right_pv = $matching = $left_rpv = $right_rpv = $rmatching = 0;	
/*if(!empty($repurchase_bv))		 {	

			$left_rpv = $repurchase_bv[0]['lbv'];		
			$right_rpv = $repurchase_bv[0]['rbv'];
			if($left_rpv >= $right_rpv) { $left_rpv= $left_rpv - $right_rpv; }
			elseif($left_rpv <= $right_rpv) { $right_rpv= $right_rpv - $left_rpv; }
}*/
			if(!empty($bliss_amount)) {
				foreach($bliss_amount as $val) {
				  if($val['sale_type']=='1') {
					if($val['type']=='BV left') { $left_pv = $left_pv + $val['amount']; }
		if($val['type']=='BV right') { $right_pv = $right_pv + $val['amount']; }
				  } else {
					if($val['type']=='BV left')  { $total_left_rbv = $total_left_rbv + $val['amount']; }   
		if($val['type']=='BV right')  { $total_right_rbv = $total_right_rbv + $val['amount']; }  
				  }
				}
			} 

			/************ data to show in popup *********/
	        echo '<h4 class="modal-title text-center"><a href="'.base_url().'admin/treeview/'.$user_info[0]['customer_id'].'">'.$user_info[0]['f_name'].' '.$user_info[0]['l_name'].' ('.$user_info[0]['customer_id'].')</a></h4>
      
      <div class="modal-body bbh-info">
        <table style="bottom: 30px;" class="table border">
					<tbody> 
					<tr><td></td><td>Status:</td><td>';
					if($user_info[0]['user_level'] > 0) { echo 'Activate'; } 
					else { echo 'Deactivate'; }
					echo '</td></tr>

					<tr><td>Direct Left:</td><td>'.$user_info[0]['left_direct'].'</td><td>Direct Right:</td><td>'.$user_info[0]['right_direct'].'</td></tr>
					<tr><td>Total Left:</td><td>'.$user_info[0]['left_count'].'</td><td>Total Right:</td><td>'.$user_info[0]['right_count'].'</td></tr>
					<tr><td>Sponsor Name:</td><td>'.$user_info[0]['df_name'].' '.$user_info[0]['dl_name'].'</td><td>Sponsor Code:</td><td>'.$user_info[0]['direct_customer_id'].'</td></tr>
					
					<tr><td>Left MB:</td><td>'.($left_pv/500).'</td><td>Right MB:</td><td>'.($right_pv/500).'</td></tr>
					<tr><td>Left SB:</td><td>'.round($total_left_rbv/500,2).'</td><td>Right SB:</td><td>'.round($total_right_rbv/500,2).'</td></tr>
					<tr><td>Date of Signup:</td><td colspan="3">'.date('d F Y',strtotime($user_info[0]['rdate'])).'</td><td>
					</tbody></table>
      </div> ';
	        }
	    }
	}
	  public function treeview(){ 
	 $cuid = $this->session->userdata('cust_id');
	
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($cuid);

	  //order id 
        $id = $this->uri->segment(3);
     
     	$data['notexist'] =  '';
	$data['total_group'] = 0;
	$data['user1'] = $data['user2'] = $data['user3'] = $data['user4'] = $data['user5'] = $data['user6'] = $data['user7'] = $data['user8'] = $data['user9'] = $data['user10'] = $data['user11'] = $data['user12'] = $data['user13'] = $data['user14'] = $data['user15'] = array();
	 $getid = $this->uri->segment(3);
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('s_name')!=''){
		  $customerid = $this->input->post('s_name');
	  } 
	  elseif ($getid!=''){ $customerid = $getid; } 
	  else { $customerid = $data['profile'][0]['customer_id']; }
	  
	  $user1 = $this->Users_model->profile_by_customer_id($customerid);
	
	  if(empty($user1)) { $data['notexist'] = 'true'; }
	  elseif($user1[0]['id'] < $cuid) { $data['notexist'] = 'true'; }
	  else { 
		  //$this->goDownLeftLevel($customerid); 
		  //$this->goDownRightLevel($customerid);
		  
		  $data['user1'] = array('rank'=>$user1[0]['bsacode'],'name'=>$user1[0]['f_name'].' '.$user1[0]['l_name'], 'customer_id'=>$customerid, 'rdate'=>$user1[0]['rdate'],'sponsor'=>$user1[0]['direct_customer_id'],'status'=>$user1[0]['status'],'user_level'=>$user1[0]['user_level'],'consume'=>$user1[0]['consume']);	
		  
		  //$data['total_group'] = $this->total_group;
		  $this->total_left_count = $this->total_right_count = $this->total_group = 0; $this->all_user_array = array();
		  
		  $user_3_cid = $user_6_cid = $user_8_cid = $user_10_cid = $user_12_cid = $user_14_cid = '';
		  $user2 = $this->Users_model->my_friends($customerid);
		  
		//  print_r($user2);
		  if(!empty($user2)) {  
			if($user2[0]['position']=='left') { $datauser2 = 'user2'; $user_3_cid =  $user2[0]['customer_id']; } 
			else { $datauser2 = 'user3'; $user_6_cid =  $user2[0]['customer_id']; } 
			$data[$datauser2] = array('rank'=>$user2[0]['bsacode'],'name'=>$user2[0]['f_name'].' '.$user2[0]['l_name'], 'customer_id'=>$user2[0]['customer_id'],'rdate'=>$user2[0]['rdate'],'sponsor'=>$user2[0]['direct_customer_id'],'status'=>$user2[0]['status'],'user_level'=>$user2[0]['user_level'],'consume'=>$user2[0]['consume']); 
			 
			if(count($user2) > 1) {   
				if($user2[1]['position']=='left') { $datauser3 = 'user2'; $user_3_cid =  $user2[1]['customer_id']; } 
				else { $datauser3 = 'user3'; $user_6_cid =  $user2[1]['customer_id']; } 
				$data[$datauser3] = array('rank'=>$user2[1]['bsacode'],'name'=>$user2[1]['f_name'].' '.$user2[1]['l_name'], 'customer_id'=>$user2[1]['customer_id'],'rdate'=>$user2[1]['rdate'],'sponsor'=>$user2[1]['direct_customer_id'],'status'=>$user2[1]['status'],'user_level'=>$user2[1]['user_level'],'consume'=>$user2[1]['consume']);
			}
		  }
		  if(!empty($user_3_cid)) {
			$user3 = $this->Users_model->my_friends($user_3_cid);
			if(!empty($user3)) {   
				if($user3[0]['position']=='left') { $datauser4 = 'user4'; $user_8_cid =  $user3[0]['customer_id']; } 
				else { $datauser4 = 'user5'; $user_10_cid =  $user3[0]['customer_id']; }
				$data[$datauser4] = array('rank'=>$user3[0]['bsacode'],'name'=>$user3[0]['f_name'].' '.$user3[0]['l_name'], 'customer_id'=>$user3[0]['customer_id'],'rdate'=>$user3[0]['rdate'],'sponsor'=>$user3[0]['direct_customer_id'],'status'=>$user3[0]['status'],'user_level'=>$user3[0]['user_level'],'consume'=>$user3[0]['consume']); 
				 
				if(count($user3) > 1) {  
					if($user3[1]['position']=='left') { $datauser5 = 'user4'; $user_8_cid =  $user3[1]['customer_id']; } 
					else { $datauser5 = 'user5'; $user_10_cid =  $user3[1]['customer_id']; }
					$data[$datauser5] = array('rank'=>$user3[1]['bsacode'],'name'=>$user3[1]['f_name'].' '.$user3[1]['l_name'], 'customer_id'=>$user3[1]['customer_id'],'rdate'=>$user3[1]['rdate'],'sponsor'=>$user3[1]['direct_customer_id'],'status'=>$user3[1]['status'],'user_level'=>$user3[1]['user_level'],'consume'=>$user3[1]['consume']); 
				}
			}
		  }
		  if(!empty($user_6_cid)) {
			$user6 = $this->Users_model->my_friends($user_6_cid);
			if(!empty($user6)) {  
				if($user6[0]['position']=='left') { $datauser6 = 'user6'; $user_12_cid =  $user6[0]['customer_id']; } 
				else { $datauser6 = 'user7'; $user_14_cid =  $user6[0]['customer_id']; }
				$data[$datauser6] = array('rank'=>$user6[0]['bsacode'],'name'=>$user6[0]['f_name'].' '.$user6[0]['l_name'], 'customer_id'=>$user6[0]['customer_id'],'rdate'=>$user6[0]['rdate'],'sponsor'=>$user6[0]['direct_customer_id'],'status'=>$user6[0]['status'],'user_level'=>$user6[0]['user_level'],'consume'=>$user6[0]['consume']); 
				 
				if(count($user6) > 1) {   
						if($user6[1]['position']=='left') { $datauser7 = 'user6'; $user_12_cid =  $user6[1]['customer_id']; } 
						else { $datauser7 = 'user7'; $user_14_cid =  $user6[1]['customer_id']; }
						$data[$datauser7] = array('rank'=>$user6[1]['bsacode'],'name'=>$user6[1]['f_name'].' '.$user6[1]['l_name'], 'customer_id'=>$user6[1]['customer_id'],'rdate'=>$user6[1]['rdate'],'sponsor'=>$user6[1]['direct_customer_id'],'status'=>$user6[1]['status'],'user_level'=>$user6[1]['user_level'],'consume'=>$user6[1]['consume']);
				}
			}					
		  }
		  if(!empty($user_8_cid)) {
			$user8 = $this->Users_model->my_friends($user_8_cid);
				if(!empty($user8)) {   
					if($user8[0]['position']=='left') { $datauser8 = 'user8'; } else { $datauser8 = 'user9'; }
					$data[$datauser8] = array('rank'=>$user8[0]['bsacode'],'name'=>$user8[0]['f_name'].' '.$user8[0]['l_name'], 'customer_id'=>$user8[0]['customer_id'],'rdate'=>$user8[0]['rdate'],'sponsor'=>$user8[0]['direct_customer_id'],'status'=>$user8[0]['status'],'user_level'=>$user8[0]['user_level'],'consume'=>$user8[0]['consume']); 
					
					if(count($user8) > 1) {   
						if($user8[1]['position']=='left') { $datauser9 = 'user8'; } else { $datauser9 = 'user9'; }
						$data[$datauser9] = array('rank'=>$user8[1]['bsacode'],'name'=>$user8[1]['f_name'].' '.$user8[1]['l_name'], 'customer_id'=>$user8[1]['customer_id'],'rdate'=>$user8[1]['rdate'],'sponsor'=>$user8[1]['direct_customer_id'],'status'=>$user8[1]['status'],'user_level'=>$user8[1]['user_level'],'consume'=>$user8[1]['consume']); 
					}
				}  
		  }
		  if(!empty($user_10_cid)) {
			$user10 = $this->Users_model->my_friends($user_10_cid);
					if(!empty($user10)) {   
						if($user10[0]['position']=='left') { $datauser10 = 'user10'; } else { $datauser10 = 'user11'; }
						$data[$datauser10] = array('rank'=>$user10[0]['bsacode'],'name'=>$user10[0]['f_name'].' '.$user10[0]['l_name'], 'customer_id'=>$user10[0]['customer_id'],'rdate'=>$user10[0]['rdate'],'sponsor'=>$user10[0]['direct_customer_id'],'status'=>$user10[0]['status'],'user_level'=>$user10[0]['user_level'],'consume'=>$user10[0]['consume']); 
						
						if(count($user10) > 1) {  
							if($user10[1]['position']=='left') { $datauser11 = 'user10'; } else { $datauser11 = 'user11'; }
							$data[$datauser11] = array('rank'=>$user10[1]['bsacode'],'name'=>$user10[1]['f_name'].' '.$user10[1]['l_name'], 'customer_id'=>$user10[1]['customer_id'],'rdate'=>$user10[1]['rdate'],'sponsor'=>$user10[1]['direct_customer_id'],'status'=>$user10[1]['status'],'user_level'=>$user10[1]['user_level'],'consume'=>$user10[1]['consume']); 
						}
					}  
		  }
		  if(!empty($user_12_cid)) {
			$user12 = $this->Users_model->my_friends($user_12_cid);
					if(!empty($user12)) {  
						if($user12[0]['position']=='left') { $datauser12 = 'user12'; } else { $datauser12 = 'user13'; }
						$data[$datauser12] = array('rank'=>$user12[0]['bsacode'],'name'=>$user12[0]['f_name'].' '.$user12[0]['l_name'], 'customer_id'=>$user12[0]['customer_id'],'rdate'=>$user12[0]['rdate'],'sponsor'=>$user12[0]['direct_customer_id'],'status'=>$user12[0]['status'],'user_level'=>$user12[0]['user_level'],'consume'=>$user12[0]['consume']); 
						
						if(count($user12) > 1) {   
							if($user12[1]['position']=='left') { $datauser13 = 'user12'; } else { $datauser13 = 'user13'; }
							$data[$datauser13] = array('rank'=>$user12[1]['bsacode'],'name'=>$user12[1]['f_name'].' '.$user12[1]['l_name'], 'customer_id'=>$user12[1]['customer_id'],'rdate'=>$user12[1]['rdate'],'sponsor'=>$user12[1]['direct_customer_id'],'status'=>$user12[1]['status'],'user_level'=>$user12[1]['user_level'],'consume'=>$user12[1]['consume']); 
						}
					}  
		  }
		  if(!empty($user_14_cid)) {
			$user14 = $this->Users_model->my_friends($user_14_cid);
						if(!empty($user14)) {  
							if($user14[0]['position']=='left') { $datauser14 = 'user14'; } else { $datauser14 = 'user15'; }
							$data[$datauser14] = array('rank'=>$user14[0]['bsacode'],'name'=>$user14[0]['f_name'].' '.$user14[0]['l_name'], 'customer_id'=>$user14[0]['customer_id'],'rdate'=>$user14[0]['rdate'],'sponsor'=>$user14[0]['direct_customer_id'],'status'=>$user14[0]['status'],'user_level'=>$user14[0]['user_level'],'consume'=>$user14[0]['consume']); 
							
							if(count($user14) > 1) {  
								if($user14[1]['position']=='left') { $datauser15 = 'user14'; } else { $datauser15 = 'user15'; }
								$data[$datauser15] = array('rank'=>$user14[1]['bsacode'],'name'=>$user14[1]['f_name'].' '.$user14[1]['l_name'], 'customer_id'=>$user14[1]['customer_id'], 'rdate'=>$user14[1]['rdate'],'sponsor'=>$user14[1]['direct_customer_id'],'status'=>$user14[1]['status'],'user_level'=>$user14[1]['user_level'],'consume'=>$user14[1]['consume']); 
							}
						}  
		  }
		  
		  
	  }
	  
	  
	
	  
	  
       // $data['order'] = $this->order_model->get_all_order_id($id); 
        //load the view
        $data['main_content'] = 'admin/treeview'; 
        $this->load->view('includes/admin/template', $data); 
  } 
	

  public function reverse(){ 
	 	$cuid = $this->session->userdata('cust_id');
	    $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($cuid);
		$data['notexist'] =  '';
		$data['total_group'] = 0;
		$data['user1'] = $data['user2'] = $data['user3'] = $data['user4'] = $data['user5'] = $data['user6'] = $data['user7'] = $data['user8'] = $data['user9'] = $data['user10'] = $data['user11'] = $data['user12'] = $data['user13'] = $data['user14'] = $data['user15'] = array();
	 $getid = $this->uri->segment(3);
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('s_name')!=''){
		  $customer_id = $this->input->post('s_name');
	  } 
	  elseif ($getid!=''){ $customer_id = $getid; } 
	  else { $customer_id = $data['profile'][0]['customer_id']; }
	  
	  $user1 = $this->Users_model->profile_by_id_pool_tree_cus_id($customer_id);
	  $data['user1'] = $user1[0];
	  $myfriends = $this->Users_model->my_friends_auto_pool($user1[0]['id']); 
		if(!empty($myfriends)) {
			$i=1;
            foreach($myfriends as $friend) {
				$inner_friends_array1 = $this->Users_model->my_friends_auto_pool($friend['id']);
				if($i==1){$data['user2'] = $friend;}
				if($i==2){$data['user3'] = $friend;}
				/**************  friend level 2 *******************/
				$c=1;
					foreach($inner_friends_array1 as $friend2) {
						$inner_friends_array2 = $this->Users_model->my_friends_auto_pool($friend2['id']);
						/**************  friend level 3 *******************/
						if($c==1 && $i==1){$data['user4'] = $friend2;}
						if($c==2  && $i==1){$data['user5'] = $friend2;}
						if($c==1  && $i==2){$data['user6'] = $friend2;}
						if($c==2  && $i==2){$data['user7'] = $friend2;}
						
						
						$d=1;
						foreach($inner_friends_array2 as $friend3) {
							
						if($i==1 && $c==1 && $d==1){$data['user8'] = $friend3;}
						if($i==1 && $c==1 && $d==2){$data['user9'] = $friend3;}
						if($i==1  && $c==2 && $d==1){$data['user10'] = $friend3;}
						if($i==1  && $c==2 && $d==2){$data['user11'] = $friend3;}
						
						if($i==2 && $c==1 && $d==1){$data['user12'] = $friend3;}
						if($i==2 && $c==1 && $d==2){$data['user13'] = $friend3;}
						if($i==2  && $c==2 && $d==1){$data['user14'] = $friend3;}
						if($i==2  && $c==2 && $d==2){$data['user15'] = $friend3;}
						
						
							
							$d++;
						}
						
						$c++;
					}
					$i++;
				}
	
			}
        //load the view
        $data['main_content'] = 'admin/reverse'; 
        $this->load->view('includes/admin/template', $data); 
  }
	
  
}