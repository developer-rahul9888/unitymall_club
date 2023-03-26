<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Redeam extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('redeam_model');	
		$this->load->model('customer_model');

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['redeam'] = $this->redeam_model->get_all_redeam();
	$data['redeam_apr'] = $this->redeam_model->get_all_redeam_apr();
	
	//load the view
      $data['main_content'] = 'admin/redeam_list';
      $this->load->view('includes/admin/template', $data);   
  }
/*   public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('c_name', 'titlt', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('c_discription', 'discription', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='images/redeam/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else
                    {
                         $errors = $this->upload->display_errors();
						$image = '';
			        }
			        //----- end file upload -----------
			
				$data_to_store = array(
                    'c_name' => $this->input->post('c_name'),
					'c_description' => $this->input->post('c_discription'),
					'image' => $image,
				); 
                //if the insert has returned true then we show the flash message
				if($this->customer_model->store_customer($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/redeam/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/customer_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  */ 
  public function update(){
	  	
	 
	  //redeam id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            /*form validation*/
         $this->form_validation->set_rules('name', 'name', 'required|trim');
         $this->form_validation->set_rules('redeem', 'redeem', 'required|trim');
		 $this->form_validation->set_rules('status', 'status', 'required|trim');
			    
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		   $profile = $this->customer_model->get_all_customer_id($this->input->post('customer_id')); 
		   $balance= $profile[0]['bliss_amount']+$this->input->post('redeem');
					
					$data_to_store = array( 
					       'redeem_status' => $this->input->post('status')						   
					);
					$data_to_store1 = array( 
					       'bliss_amount' => $balance						   
					);
					$cust_id=$this->input->post('customer_id');
					
					 $return = $this->redeam_model->update_redeam($id, $data_to_store);
					 if($this->input->post('status') == 'disapproved') {
						  $return = $this->redeam_model->update_customer_redeam($cust_id, $data_to_store1);
					 }
					
					
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/redeam/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['redeamupdate'] = $this->redeam_model->get_all_redeam_id($id); 
        //load the view
        $data['main_content'] = 'admin/redeam_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->redeam_model->delete_redeam($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/redeam');
 }  
}