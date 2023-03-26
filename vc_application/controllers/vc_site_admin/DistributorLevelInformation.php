<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class DistributorLevelInformation extends CI_Controller {		 


public function __construct()    {        
	parent::__construct();                
	$this->load->library('session');        
	$this->load->helper('url');        
	$this->load->helper('form');        
	$this->load->library('form_validation');        
	$this->load->model('order_model');	         
	$this->load->model('Users_model');        

	if(!$this->session->userdata('is_customer_logged_in')){ redirect(base_url()); }     }	  
	public function index() {


    			$id = $this->session->userdata('cust_id');


	        $customer_id = $this->session->userdata('bliss_id');


		$data['profile'] = $this->Users_model->profile($id);


		$data['parent_profile'] = $this->Users_model->parent_profile($data['profile'][0]['parent_customer_id']);





	//$data['friends'] = $this->order_model->get_first_cercle($customer_id);





	 $data['myfriends'] = array();


	$data['show_inner'] = 'false';


	$data['current_user'] = $customer_id;


	$inner_users = $this->uri->segment(3);
	$level = 1;


	if($this->input->post('level')!='') { $level = $this->input->post('level'); }


	$cus_array = array();
	$user_list = array();	
	$cus_array[] = $customer_id;	
	$myfriendid = array($id);	
	$p=0;	
	while($p<$level) {		
		$myfriends = $this->Users_model->my_friends_in($cus_array);	
			if(!empty($myfriends)) {		
				$user_list = $myfriends;		
				$cus_array = array_column($myfriends,'customer_id');		
		} else { $user_list = array(); } $p++; 	}	
			$data['myfriends']=$user_list;	


	//load the view

	//echo '<pre>'; print_r($data['myfriends']); die();
      $data['main_content'] = 'admin/DistributorLevelInformation';


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
	 	$data['main_content'] = 'admin/DistributorLevelInformation';         
	 	$this->load->view('includes/admin/template', $data);   }  }