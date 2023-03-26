<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('gallery_model');
        $this->load->helper('string');		

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['product'] = $this->gallery_model->get_all_product();
	
	//load the view
      $data['main_content'] = 'admin/gallery_list';
      $this->load->view('includes/admin/template', $data);   
  }

   public function achiever() {
      
  $data['product'] = $this->gallery_model->get_all_achiever();
  
  //load the view
      $data['main_content'] = 'admin/achiever_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  public function yt_gallery() {
    	
	$data['product'] = $this->gallery_model->get_all_ytb_gallery();
	
	//load the view
      $data['main_content'] = 'admin/ytb_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function add(){
	  
	  
            //form validation
            $this->form_validation->set_rules('title', 'titlt', 'required|trim|min_length[4]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='images/product/';
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

				$data_to_store = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'status' => $this->input->post('status'),
					'type' => $this->input->post('slider_image'),
                    'visibility' => 'club',
					'image' => $image
				); 
                //if the insert has returned true then we show the flash message
				$true = $this->gallery_model->store_gallery($data_to_store);
				if($true == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					//redirect('admin/gallery/add');
					

                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }//validation run
        $data['main_content'] = 'admin/gallery_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  
  
    
  public function ytb_add(){
	  
	  
            //form validation
            $this->form_validation->set_rules('title', 'titlt', 'required|trim|min_length[4]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
					
		
			        //----- end file upload -----------
				
			
				$data_to_store = array(
                    'title' => $this->input->post('title'),
                    'url' => $this->input->post('url'),
                    'description' => $this->input->post('description'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status')
					
				); 
                //if the insert has returned true then we show the flash message
				
				$true = $this->gallery_model->store_yt($data_to_store);
				
				if($true == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/ytb/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }//validation run
        $data['main_content'] = 'admin/ytb_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  
  
  
  public function update(){
	  	
	 
	  //product id 
       $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[4]');

			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		  // file upload start here
            	$image = 'noimg.jpg';
			$config['upload_path'] ='images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                    if($this->input->post('image_old')!='') unlink('images/product/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else {
                        $errors = $this->upload->display_errors();
						$image = $this->input->post('image_old');
			        }
					
				
			     
			        //----- end file upload -----------
					
					
		
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'status' => $this->input->post('status'),
					 'type' => $this->input->post('slider_image'),
					'image' => $image
				); 
             $return = $this->gallery_model->update_product($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/gallery/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

      
       
        $data['product'] = $this->gallery_model->get_all_product_id($id); 
        //load the view
        $data['main_content'] = 'admin/gallery_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  
  
    public function ytb_update(){
	  	
	 
	  //product id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[4]');

			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
					
				
			     
			        //----- end file upload -----------
					
					
		
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'url' => $this->input->post('url'),
                    'description' => $this->input->post('description'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status')
				); 
             $return = $this->gallery_model->update_ytb($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/ytb/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

      
       
        $data['product'] = $this->gallery_model->get_all_ytb_id($id); 
        //load the view
        $data['main_content'] = 'admin/ytb_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  
    public function remove_img (){
	  $img = $_POST['img'];
	  if($img !=''){
		  unlink('images/product/'.$img);
	  }
  }
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->gallery_model->delete_product($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/gallery');
 }  
 
 public function ytb_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->gallery_model->delete_ytb($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/ytb');
 }  
 	
  public function popup() {
    	
	$data['product'] = $this->gallery_model->get_all_popup();
	
	//load the view
      $data['main_content'] = 'admin/popup_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
    public function popup_add(){
	  
	  
            //form validation
            $this->form_validation->set_rules('title', 'titlt', 'required|trim|min_length[4]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='images/popup/';
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
                    'title' => $this->input->post('title'),
                    'status' => $this->input->post('status'),
                    'type' => $this->input->post('type'),
					'image' => $image
				); 
                //if the insert has returned true then we show the flash message
				
				$true = $this->gallery_model->store_popup($data_to_store);
				
				if($true == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/gallery/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }//validation run
        $data['main_content'] = 'admin/popup_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
   public function popup_update(){
	  	
	 
	  //product id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[4]');

			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		  // file upload start here
            	$image = 'noimg.jpg';
			$config['upload_path'] ='images/popup/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                    if($this->input->post('image_old')!='') unlink('images/popup/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else {
                        $errors = $this->upload->display_errors();
						$image = $this->input->post('image_old');
			        }
					
				
			     
			        //----- end file upload -----------
					
					
		
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'status' => $this->input->post('status'),
                    'type' => $this->input->post('type'),
					           'image' => $image
				); 
             $return = $this->gallery_model->update_popup($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/popup/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

      
       
        $data['product'] = $this->gallery_model->get_all_popup_id($id); 
        //load the view
        $data['main_content'] = 'admin/popup_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
    public function popup_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->gallery_model->delete_popup($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/popup');
 } 
 
}