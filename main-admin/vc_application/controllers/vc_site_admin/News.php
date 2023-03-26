<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('news_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['news'] = $this->news_model->get_all_news();
	
	//load the view
      $data['main_content'] = 'admin/news_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[4]');
			//$this->form_validation->set_rules('discription', 'discription', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
			$image = '';
			$config['upload_path'] ='../assets/images/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
          //  $config['max_width']  = '524';
          //  $config['max_height']  = '524';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image')) { 
                    if($this->input->post('image_old')!='') unlink('../assets/images/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
						$var_status = $this->input->post('var_status');
					}
           
			
				$data_to_store = array(
                    'title' => $this->input->post('title'),
					'discription' => $this->input->post('discription'),				
					'status' => $this->input->post('status'),
                    'visibility' => 'club',
					'image' => $image,					
					'type' => $this->input->post('type')
				); 
                //if the insert has returned true then we show the flash message
				if($this->news_model->store_news($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/news/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }

        }
       

        $data['main_content'] = 'admin/news_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }

  public function update(){
	  	
	 
	  //news id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('rid'))
        {
            /*form validation*/
        $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[4]');
		//	$this->form_validation->set_rules('discription', 'discription', 'required');
			    
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
			$image = '';
			$config['upload_path'] ='../assets/images/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
          //  $config['max_width']  = '524';
          //  $config['max_height']  = '524';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image')) { 
                    if($this->input->post('image_old')!='') unlink('../assets/images/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
						$var_status = $this->input->post('var_status');
					}
            else { $image = $this->input->post('image_old'); }
			
		  $data_to_store = array( 
		             'title' => $this->input->post('title'),
					 'discription' => $this->input->post('discription'),				
					 'type' => $this->input->post('type'),			
					 'image' => $image,			
					 'status' => $this->input->post('status')				   
					); 
					
					 $return = $this->news_model->update_news($id, $data_to_store);
					
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/news/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['newsupdate'] = $this->news_model->get_all_news_id($id); 
        //load the view
        $data['main_content'] = 'admin/news_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->news_model->delete_news($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/news');
 }  
}