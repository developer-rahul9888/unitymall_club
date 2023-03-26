<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proedit extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('order_model');	

        if(!$this->session->userdata('is_customer_logged_in')){ redirect(base_url()); } 
    }
	
  public function index() {
    	
	$data['order'] = $this->order_model->get_all_order();
	
	//load the view
      $data['main_content'] = 'admin/order_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function order_view(){ 
	 
	  //order id 
        $id = $this->uri->segment(3);
     
        $data['order'] = $this->order_model->get_all_order_id($id); 
        //load the view
        $data['main_content'] = 'admin/order_view'; 
        $this->load->view('includes/admin/template', $data); 
  }  
}