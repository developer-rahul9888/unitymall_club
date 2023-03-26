<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller {
	
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
	
  public function index() {
    			$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);    		
		$data['order'] = $this->order_model->get_all_order($id);
	
	//load the view
      $data['main_content'] = 'admin/order_list';
      $this->load->view('includes/admin/template', $data);   
  }
 

  public function reward_list() 
  {
    	$id = $this->session->userdata('cust_id');
	    $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
        $data['reward'] = $this->order_model->get_all_reward($id);
		//echo '<pre>';print_r($data['reward']);die();
	
	//load the view
       $data['main_content'] = 'admin/rewards';
      $this->load->view('includes/admin/template', $data);   
  }       
  
  
  public function bonanza_list() 
  {    	  
  $id = $this->session->userdata('cust_id');	   
  $customer_id = $this->session->userdata('bliss_id');		  
  $data['profile'] = $this->Users_model->profile($id); 
  $reward = $this->order_model->get_all_reward($id);
  $data['bonanza'] = $this->order_model->get_bonanza();
    $data['rewardd'] = $this->order_model->get_all_rewards($id);
  //print_r( $data['bonanza']);die();

  $data['ids'] = array_column($reward, 'bonanza_id');
// echo '<pre>'; print_r($data['ids']);die();
 
 
 
  //load the view      
  $data['main_content'] = 'admin/bonanza';     
  $this->load->view('includes/admin/template', $data);  
  }                                
  
	 public function achiever_list() 
	 {
    $id = $this->session->userdata('cust_id');
	$customer_id = $this->session->userdata('bliss_id');
    $data['profile'] = $this->Users_model->profile($id);

	$data['order'] = $this->order_model->get_all_order();
	
	//load the view
     $data['main_content'] = 'admin/achiever_list';
     $this->load->view('includes/admin/template', $data);   
  }
  
  public function order_view()
  { 
	 $id = $this->session->userdata('cust_id');
	 $customer_id = $this->session->userdata('bliss_id');
	 $data['profile'] = $this->Users_model->profile($id);

	  //order id 
      $id = $this->uri->segment(3);
     
      $data['order'] = $this->order_model->get_all_order_id($id); 
        //load the view
      $data['main_content'] = 'admin/order_view'; 
      $this->load->view('includes/admin/template', $data); 
  }   
  
  
  
  public function rewards_list() 
  {
    	$id = $this->session->userdata('cust_id');
	    $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
        $data['rewardd'] = $this->order_model->get_all_rewards($id);
		//echo '<pre>';print_r($data['rewardd']);die();
	
	//load the view
       $data['main_content'] = 'admin/reward';
      $this->load->view('includes/admin/template', $data);   
  }       
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
}