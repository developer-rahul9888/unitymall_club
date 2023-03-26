<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upgrade extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('upgrade_model');	
		$this->load->model('customer_model');

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['upgrade'] = $this->upgrade_model->get_all_upgrade();
	
	//load the view
      $data['main_content'] = 'admin/Upgrade_list';
      $this->load->view('includes/admin/template', $data);   
  }

  public function update(){
	  	
	  
	  //upgrade id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            /*form validation*/
        
		 $this->form_validation->set_rules('status', 'status', 'required|trim');
			    
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		   $profile = $this->customer_model->get_all_customer_id($this->input->post('customer_id')); 
		   
		        $f_name = $profile[0]['f_name'];
				$phone = $profile[0]['phone'];
				$insert_id = $profile[0]['id'];
				$customer_n = substr($f_name,0,2).'D'.substr($phone,-4).''.$insert_id;
			    $customer_id = strtoupper($customer_n);
				
				$old_cust_id = $profile[0]['customer_id'];
					 
					$data_to_store = array( 
					       'up_status' => $this->input->post('status'),
						   'req_apr_date' => date('Y-m-d')
					);
					
					$data_to_store1 = array( 
					       'customer_id'=>$customer_id					   
					);
					
					$data_to_store2 = array( 
					       'parent_customer_id'=>$customer_id					   
					);
					
					$cust_id=$this->input->post('customer_id');
					 $return = $this->upgrade_model->update_upgrade($id, $data_to_store);
					 $return = $this->upgrade_model->update_customer_upgrade($cust_id, $data_to_store1);
					 $return = $this->upgrade_model->update_parent_id($old_cust_id, $data_to_store2);
					
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/upgrade/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['upgradeupdate'] = $this->upgrade_model->get_all_upgrade_id($id); 
        //load the view
        $data['main_content'] = 'admin/upgrade_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->upgrade_model->delete_upgrade($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/upgrade');
 }  
}