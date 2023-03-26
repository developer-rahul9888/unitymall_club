<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Activate extends CI_Controller {
	
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

	$data['order'] = $this->order_model->get_all_order();
	
	//load the view
      $data['main_content'] = 'admin/activation_pin';
      $this->load->view('includes/admin/template', $data);   
  }


  
  
}