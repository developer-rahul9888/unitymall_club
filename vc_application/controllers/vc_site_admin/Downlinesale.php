<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Downlinesale extends CI_Controller {
	
        private $sale_array = array();
        private $sale_level = 0;
		
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
       
		$return_result = $this->goDownALevel($customer_id);
	if ($this->input->server('REQUEST_METHOD')=='POST' && $this->input->post('sdate')!='') {
             $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
             $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
        } else {
             $sdate = date('Y-m-01 00:00:01');
             $edate = date('Y-m-t 23:59:59');
        }
		$data['sales'] = $this->Users_model->get_all_child_sale($this->sale_array,$sdate,$edate);
		//echo $this->sale_level; //print_r(implode(',',$this->sale_array));print_r($data['sales']);
	//load the view
      $data['main_content'] = 'admin/downlinesale';
      $this->load->view('includes/admin/template', $data);   
  }
  function goDownALevel($customerid){
	 $return = array();
     $children = $this->Users_model->my_friends($customerid); //underlying SQL function
     if(!empty($children) && $this->sale_level < 15){
		 $this->sale_level = $this->sale_level + 1;
          foreach($children as $child){
                $this->sale_array[] = $child['id']; 
                $this->goDownALevel($child['customer_id']);
          }
     }
	 return $return;
  }
		
				   
  public function order_view(){ 
	 $id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);

	  //order id 
        $id = $this->uri->segment(3);
     
        $data['order'] = $this->order_model->get_all_order_id($id); 
        //load the view
        $data['main_content'] = 'admin/downlinesale'; 
        $this->load->view('includes/admin/template', $data); 
  }  
}