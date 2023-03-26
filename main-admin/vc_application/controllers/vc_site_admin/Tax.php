<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tax extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('tax_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['tax'] = $this->tax_model->get_all_tax();
	
	//load the view
      $data['main_content'] = 'admin/tax_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[2]');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			$this->form_validation->set_rules('type', 'type', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				
				$data_to_store = array(
                    'title' => $this->input->post('title'),
					'amount' => $this->input->post('amount'),
					'type' => $this->input->post('type')
				); 
                //if the insert has returned true then we show the flash message
				if($this->tax_model->store_tax($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/tax/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/tax_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //tax id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
              $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('amount', 'amount', 'required|trim');
			$this->form_validation->set_rules('type', 'type', 'required|trim');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		   
                $data_to_store = array(
                    'title' => $this->input->post('title'),
					'amount' => $this->input->post('amount'),
					'type' => $this->input->post('type')
				); 
             $return = $this->tax_model->update_tax($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/tax/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['tax'] = $this->tax_model->get_all_tax_id($id); 
        //load the view
        $data['main_content'] = 'admin/tax_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->tax_model->delete_tax($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/tax');
 }  
}