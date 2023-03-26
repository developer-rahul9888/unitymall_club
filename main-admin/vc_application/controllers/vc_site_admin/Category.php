<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('category_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['category'] = $this->category_model->get_all_category();
	
	//load the view
      $data['main_content'] = 'admin/category_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

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
			$config['upload_path'] ='images/category/';
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
				if($this->category_model->store_category($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/category/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/category_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //category id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
              $this->form_validation->set_rules('c_name', 'name', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('c_description', 'description', 'required|trim');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  // file upload start here
            	$image = 'noimg.jpg';
			$config['upload_path'] ='images/category/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                    if($this->input->post('avtar_exist')!='') unlink('images/category/'.$this->input->post('avtar_exist'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else {
                         $errors = $this->upload->display_errors();
						$image = $this->input->post('avtar_exist');
			        }
			        //----- end file upload -----------
                $data_to_store = array(
                    'c_name' => $this->input->post('c_name'),
					'c_description' => $this->input->post('c_description'), 
					'image' => $image,
					'status' => $this->input->post('status'),
					); 
             $return = $this->category_model->update_category($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/category/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['category'] = $this->category_model->get_all_category_id($id); 
        //load the view
        $data['main_content'] = 'admin/category_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->category_model->delete_category($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/category');
 }  
}