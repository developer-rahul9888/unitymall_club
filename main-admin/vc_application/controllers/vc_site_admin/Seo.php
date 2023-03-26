<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Seo extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('seo_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['seo'] = $this->seo_model->get_all_seo();
	
	//load the view
      $data['main_content'] = 'admin/seo_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('url', 'URL', 'required|trim');
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('discription', 'discription', 'required|trim');
			$this->form_validation->set_rules('keyword', 'keyword', 'required|trim');
			
		  
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$data_to_store = array(
				     'url' => $this->input->post('url'),
                    'title' => $this->input->post('title'),
                    'discription' => $this->input->post('discription'),
					'keywords' => $this->input->post('keyword')
					
				); 
                //if the insert has returned true then we show the flash message
				if($this->seo_model->store_seo($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/seo/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/seo_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //seo id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
			$this->form_validation->set_rules('url', 'URL', 'required|trim');
			$this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('discription', 'discription', 'required|trim');
			$this->form_validation->set_rules('keyword', 'keyword', 'required|trim');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  
                $data_to_store = array(
                    'url' => $this->input->post('url'),
                    'title' => $this->input->post('title'),
                    'discription' => $this->input->post('discription'),
					'keywords' => $this->input->post('keyword')
					); 
             $return = $this->seo_model->update_seo($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/seo/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['seo'] = $this->seo_model->get_all_seo_id($id); 
        //load the view
        $data['main_content'] = 'admin/seo_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->seo_model->delete_seo($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/seo');
 }  
}