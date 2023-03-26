<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Coupon extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('coupon_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['coupon'] = $this->coupon_model->get_all_coupon();
	
	//load the view
      $data['main_content'] = 'admin/coupon_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('code', 'code', 'required|trim');
			$this->form_validation->set_rules('amount', 'amount', 'required|trim');
			$this->form_validation->set_rules('type', 'Type', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'start date', 'trim');
		  $this->form_validation->set_rules('end_date', 'end date', 'trim');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$data_to_store = array(
				     'title' => $this->input->post('title'),
                    'code' => $this->input->post('code'),
                    'per_user' => $this->input->post('per_user'),
					'amount' => $this->input->post('amount'),
					'type' => $this->input->post('type'),
					'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('end_date'),
					'status' => $this->input->post('status')
					
				); 
                //if the insert has returned true then we show the flash message
				if($this->coupon_model->store_coupon($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/coupon/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/coupon_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //coupon id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
              $this->form_validation->set_rules('code', 'code', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('type', 'Type', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'start date', 'trim');
		  $this->form_validation->set_rules('end_date', 'end date', 'trim');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'code' => $this->input->post('code'),
                    'per_user' => $this->input->post('per_user'),
					'amount' => $this->input->post('amount'),
					'type' => $this->input->post('type'),
					'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('end_date'),
					'status' => $this->input->post('status')
					); 
             $return = $this->coupon_model->update_coupon($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/coupon/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['coupon'] = $this->coupon_model->get_all_coupon_id($id); 
        //load the view
        $data['main_content'] = 'admin/coupon_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->coupon_model->delete_coupon($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/coupon');
 }  
}