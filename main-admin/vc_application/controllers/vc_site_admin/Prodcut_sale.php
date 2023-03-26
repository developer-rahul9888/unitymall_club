<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Prodcut_sale extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('sale_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['products'] = $this->sale_model->get_all_prodcut_sale();

	//load the view
      $data['main_content'] = 'admin/product_sale';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('pname', 'prodcut name', 'required|trim|min_length[2]');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			$this->form_validation->set_rules('address', 'address', 'required');
			$this->form_validation->set_rules('dis_date', 'dispache date', 'required');
			$this->form_validation->set_rules('user_id', 'user_id', 'required');
			
		 
			$data['user'] = $this->sale_model->get_customer_info($this->input->post('user_id'));
            if(empty($data['user'])) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user is not exist'); 
            } 
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				
				$data_to_store = array(
                    'pname' => $this->input->post('pname'),
					'amount' => $this->input->post('amount'),
					'slip_no' => $this->input->post('slip_no'),
					'address' => $this->input->post('address'),
					'status' => $this->input->post('status'),
					'user_id' => $this->input->post('user_id'),
					'dis_date' => $this->input->post('dis_date')
				); 
                //if the insert has returned true then we show the flash message
				if($this->sale_model->store_product_sale($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/product_sale/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/prodcut_sale_add'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //tax id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
            $this->form_validation->set_rules('pname', 'prodcut name', 'required|trim|min_length[2]');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			$this->form_validation->set_rules('address', 'address', 'required');
			$this->form_validation->set_rules('dis_date', 'dispache date', 'required');
			$this->form_validation->set_rules('user_id', 'user_id', 'required');
			
			$data['user'] = $this->sale_model->get_customer_info($this->input->post('user_id'));
            if(empty($data['user'])) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user is not exist'); 
            } 
            
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		   
                $data_to_store = array(
                    'pname' => $this->input->post('pname'),
					'amount' => $this->input->post('amount'),
					'slip_no' => $this->input->post('slip_no'),
					'address' => $this->input->post('address'),
					'status' => $this->input->post('status'),
					'user_id' => $this->input->post('user_id'),
					'dis_date' => $this->input->post('dis_date')
				); 
             $return = $this->sale_model->update_table($id, $data_to_store,'product_sale');

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/product_sale/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['products'] = $this->sale_model->get_all_prodcut_sale($id); 
        //load the view
        $data['main_content'] = 'admin/product_sale_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->sale_model->delete_prodcut_sale($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/prodcut_sale');
 }  
}