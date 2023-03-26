<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('cart');		
        $this->load->helper('form');
		$this->load->model('customer_model');
        $this->load->model('front_restaurant_model');	
        $this->load->model('cart_model');	
        $this->load->library('form_validation');
		
    }
  public function index()
	{
              
         $data['message'] = '';
		$data['page_slug'] = 'changepassword';
		$data['page_title'] = 'Change password';
		$data['page_keywords'] = '';
		$data['page_description'] = '';
        $urll = $this->uri->segment(2);
       $url = explode('-',str_replace('.html','',$urll));
	   
	  
	   $user_email = $this->session->userdata('email');
	   //$data['restaurant'] = $this->front_restaurant_model->get_restaurants_by_id($this->session->userdata('res_id'));
	   $data['menus'] = $this->front_restaurant_model->get_record_by_table('menu', $this->session->userdata('res_id'));
	$data['categories'] = $this->front_restaurant_model->get_record_by_table('category', $this->session->userdata('res_id'));
	$data['items'] = $this->front_restaurant_model->get_record_by_table('items', $this->session->userdata('res_id'));
    $data['modifier']= $this->front_restaurant_model->get_record_by_table('modifier', $this->session->userdata('res_id'));
	   $data['customer'] = $this->customer_model->get_customer_by_email($user_email);
	    $data['state'] = $this->customer_model->get_state();
	   
	   $data['message'] = 'false';
	  
	  $cimage = '';
	  
	  $id=$this->input->post('uid');
	      if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('uid'))
        { 
            //form validation
		   $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]|matches[cpassword]|md5');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim');
           $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
			
			
				$data_to_store = array(
                    'password' => $this->input->post('password')				
                ); 
                //if the insert has returned true then we show the flash message
				
				  $return = $this->customer_model->update_customer($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					//redirect('dashboard');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
				
				
                

            }//validation run

        }
       

        
 
        //load the view
	
       $data['main_content'] = 'password'; 
        $this->load->view('includes/front/front_template', $data);
	   
	   
	   
	   }
	   
	   
	
          
}
?>