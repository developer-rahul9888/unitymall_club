<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Users_model');

        if(!$this->session->userdata('is_customer_logged_in')){ redirect(base_url()); } 
    }
	
  public function index() {
    	
	$data['order'] = $this->order_model->get_all_order();
	
	//load the view
      $data['main_content'] = 'admin/order_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
   public function profile(){ 
	 
	     $id = $this->session->userdata('cust_id');
        $data['myfriends'] = $this->Users_model->my_friends($id);
        //load the view
        $data['main_content'] = 'admin/profile'; 
        $this->load->view('includes/admin/template', $data); 
  }  
}