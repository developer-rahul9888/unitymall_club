<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_job extends CI_Controller {

	 public function __construct(){

        parent::__construct();

        //$this->load->library('session');
        $this->load->helper('url');
        //$this->load->helper('form');
        //$this->load->library('form_validation');
         $this->load->model('Cron_model');	
    }
	
	

	
		public function shortcut_loop() {
		$tree = 'tree_500';
		$tree_data = $this->Cron_model->get_empty_shell();
		$tree_data_id = $tree_data[0]['id'];
		$complete_level = $tree_data[0]['complete_level'];
		$pending_level = $tree_data[0]['pending_level'];

			/*** Check Level Complete OR Not ***/
		$last_level_consume_list = $this->Cron_model->count_last_level_customer($complete_level,'1');
		
		$customer_count =  pow(6,$complete_level);
		if($last_level_consume_list == $customer_count) {	
			$data = array('complete_level' => $complete_level + 1,
						'pending_level' => $pending_level + 1
				);
			$this->Cron_model->update_auto_pool($tree_data_id,$data);
		$complete_level = $complete_level + 1;
		$pending_level =	$pending_level + 1;
		}
		
		/*** Check Level Complete OR Not END ***/
		
		$max = $this->Cron_model->get_select_max();
		$p =0;
		while($p < 1) {	
		$last_level = $this->Cron_model->get_last_level_customer($complete_level,'0');
		if(!empty($last_level)) {
		
		$p = 1;
		} elseif($complete_level <= $max[0]['level'] ) { $complete_level = $complete_level+ 1; $p = 0; } else { $p = 1; }
	}
		
	if(!empty($last_level)) { 

		return array('parent_id' => $last_level[0]['user_id'],'level' => $last_level[0]['level'],'child' => $last_level[0]['child']);
		} else { return FALSE; }
		
	
	}
	
	public function upgrade_pool() {
		
		
	$upgrade_customer = $this->Cron_model->customer_having_amount();
	echo '<pre>'; print_r($upgrade_customer);
	//die();
	if(!empty($upgrade_customer)) {
		foreach ($upgrade_customer as $cus) {
				if($cus['user_id'] > 0 && $cus['parent_id'] > 0  ) { 
					
					
					$return_value = $this->shortcut_loop(); // autofilling
					if(!empty($return_value)) { 
						$get_result = TRUE;  }
							
					if($get_result === TRUE) {
						
					
	
						 if($return_value['child'] == '5') {
					$data = array('level_consume' => 1);
					$this->Cron_model->update_customer_array_data($return_value['parent_id'],$data);
					
							} 
						
					$data_to_array = array('parent_id' => $return_value['parent_id'],'original_id' =>$cus['user_id'],'level'=>$return_value['level']+1,'status'=> 'Active');
					$insert_id = $this->Cron_model->insert_level_data('tree_500',$data_to_array);
					$this->Cron_model->update_customer_tree($insert_id,array('user_id'=>$insert_id));
					
					$p = 0;
					$dis_level = 1;
					$parent = $return_value['parent_id'];
					while($p < 6) {
						
					$parent_user = $this->Cron_model->parent_profile_auto_pool($parent);
					if(!empty($parent_user)) {
					    
					if($parent_user[0]['original_id'] > 0) { $parent_o_id = $parent_user[0]['original_id']; } 
					else { $parent_o_id = $parent_user[0]['user_id'] ; }
					$inc_amt = $reward = 0;
					if($dis_level == '1') { $inc_amt = 7.5; $reward = 135;} 
					elseif($dis_level == '2') {$inc_amt = 7.5; $reward = 540; } 
					elseif($dis_level == '3') { $inc_amt = 9; $reward = 2592;} 
					elseif($dis_level == '4') {$inc_amt = 10.5; $reward = 13608; } 
					elseif($dis_level == '5') { $inc_amt = 10.5; $reward = 93312; } 
					elseif($dis_level == '6') { $inc_amt = 10.5; $reward = 839808; } 
					else { $inc_amt = 0; $reward = 0; }
				
					$add_income = array('amount'=>round($inc_amt,2),'user_id'=>$parent_o_id,'user_send_by'=>$cus['user_id'],'pay_level'=>$dis_level,'type'=>'Level','status'=>'Active');  
					$this->Cron_model->add_income($add_income);
					$tree_level =  pow(6,$dis_level);
					$check_tree = $tree_level - 1;
					if($parent_user[0]['child'] >= $check_tree && $parent_user[0]['upgrade_level'] < $dis_level ) {	
						$package = array('upgrade_level'=>$dis_level);
						$this->Cron_model->update_customer_tree($parent_user[0]['id'],$package);
						$directs = $this->Cron_model->get_all_directs($parent_o_id);	
						if(count($directs) > 5) {
							$add_income = array('amount'=>round($reward,2),'user_id'=>$parent_user[0]['user_id'],'user_send_by'=>$cus['user_id'],'pay_level'=>$dis_level,'type'=>'Reward','status'=>'Active');  
							$this->Cron_model->add_income($add_income);	
						}
					}
					
					
						$this->Cron_model->substract_wallet_tree($parent_user[0]['id'],'1','child');
						$parent = $parent_user[0]['parent_id'];
						} else { $p = 50; }
						$dis_level = $dis_level + 1;
						$p++;
					
						} 
					
						$return = TRUE;
						$this->Cron_model->update_wallet($cus['user_id'],500,'bliss_amount'); 
					} else {  $this->session->set_flashdata('flash_message', 'full'); }						
					
			}
	
		}
	}
		
	}
 

	
  public function index() {
 
	  ///index.php/vc_site_admin/cron_job

	  // curl -s "http://domain.com/index.php/vc_site_admin/cron_job/index"

	//$date = date('Y-m-',strtotime("-1 month",strtotime(date('Y-m-d'))));

//	echo   $date = date('Y-m-d H:i:s');

	 //$nextdate = date('Y-m-d H:i:s',strtotime("+ 1 month",strtotime(date('Y-m-d'))));
	
	$user_id_array = array();
	
	 $currentdate = date('Y-m-d H:i:s');
	 $get_all_users = $this->Cron_model->get_all_users();
	// echo '<pre>'; print_r($get_all_users); echo '</pre>';
	 if(!empty($get_all_users)) {
		 foreach($get_all_users as $user) {
			 $user_id_array[] = $user['id'];
			 
			 
			$delete_customer =  $this->Cron_model->get_all_users_by_id($user['id']);
			 $this->Cron_model->add_delete_customer($delete_customer[0]);
		 }
		 
		  $this->Cron_model->delete_customer($user_id_array);
	 }
	 
	// echo '<pre>'; print_r($user_id_array); echo '</pre>';
	

  }
 
}
?>