<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Password extends CI_Controller {
	
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
  
		$id = $this->session->userdata('cust_id'); 
		$profile = $this->Users_model->profile($id);
              $data['profile'] = $profile;
	if ($this->input->server('REQUEST_METHOD') && $this->input->post('update')!='') {
            /*form validation*/
           $this->form_validation->set_rules('old_password', 'current password', 'required|trim');
           $this->form_validation->set_rules('newpassword','New Password','required|trim');
           $this->form_validation->set_rules('Retype_password','Confirm Password','required|trim|matches[newpassword]');
	   if(md5($this->input->post('old_password'))!=$profile[0]['pass_word']) { 
               $this->form_validation->set_rules('old_password_validate','New Password','required|trim');
              $this->form_validation->set_message('required', 'Your old password is wrong.');
           }	  

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
			 if ($this->form_validation->run()) {
				
                $data_to_store = array('pass_word' => md5($this->input->post('Retype_password'))); 
             $return = $this->Users_model->update_changePassword($data_to_store);

                if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'password');
		    redirect(base_url().'admin/password');
                } else {
                    $this->session->set_flashdata('flash_message', 'redeem_error');
                }
			}


        }
		
	
	
		
		if ($this->input->server('REQUEST_METHOD') && $this->input->post('updatepin')!='') {
            /*form validation*/
           $this->form_validation->set_rules('old_pin', 'current Pin', 'required|trim|numeric');
           $this->form_validation->set_rules('newpin','New pin','required|trim|min_length[4]|max_length[4]|numeric');
           $this->form_validation->set_rules('Retype_pin','Confirm pin','required|trim|matches[newpin]|min_length[4]|max_length[4]|numeric');
	          if(md5($this->input->post('old_pin'))!=$profile[0]['tr_pin']) { 
               $this->form_validation->set_rules('old_pin_validate','New pin','required|trim');
              $this->form_validation->set_message('required', 'Your old pin is wrong.');
           }	  

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
			 if ($this->form_validation->run()) {
				
                $data_to_store = array('tr_pin' => md5($this->input->post('Retype_pin'))); 
             $return = $this->Users_model->update_changePin($data_to_store);

                if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'pin');
		    redirect(base_url().'admin/password');
                } else {
                    $this->session->set_flashdata('flash_message', 'redeem_error');
                }
			}


        }
		
	
	
	
	
	//load the view
      $data['main_content'] = 'admin/password';
      $this->load->view('includes/admin/template', $data);   
  }
  
    
  
  
  
    
}