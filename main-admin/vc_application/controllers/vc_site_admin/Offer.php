<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Offer extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('offer_model');
        $this->load->helper('string');		

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['product'] = $this->offer_model->get_all_product();

	//load the view
      $data['main_content'] = 'admin/offer_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('p_name', 'title', 'required|trim|min_length[4]');
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
					
				
			        //----- end file upload -----------
			
				$data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                    'status' => $this->input->post('status'),
					'product_type' => $this->input->post('product_type'),
					'image' => $image,
					'category' => $this->input->post('category'),
					'p_id' => $this->input->post('p_name'), 
					'url' => $this->input->post('url'), 
				); 
                //if the insert has returned true then we show the flash message
				if($this->offer_model->store_product($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/offer/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['category'] = $this->offer_model->get_all_category();
        $data['main_content'] = 'admin/offer_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //product id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('p_name', 'title', 'required|trim|min_length[4]');
		   if($this->input->post('sku') != $this->input->post('sku_old')) {
				$is_unique_sku =  '|is_unique[admin_product.sku]';
			} else { $is_unique_sku =  '';	}
			$this->form_validation->set_rules('product_type', 'product type', 'required|trim');
			
			
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
				$imagesList = $this->input->post('images_old');
				if(empty($imagesList)) {    $imagesArray = array(); }
                else { $imagesArray = $this->input->post('images_old'); }
				
				 if(!empty($_FILES['p_image']['name'])){
            $filesCount = count($_FILES['p_image']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['p_image']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['p_image']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['p_image']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['p_image']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['p_image']['size'][$i];
				
			$config['upload_path'] ='images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
   		    $this->load->library('upload', $config);
				if ($this->upload->do_upload('userFile')) { 
                     $image_data = $this->upload->data();
					 $imagesArray[] = $image_data['file_name'];
				} else { $errors = $this->upload->display_errors();  }
			}
				 }
			        //----- end file upload -----------
				$attributeT = $this->input->post('a_title');
				$attributeV = $this->input->post('a_value');
				$attributeArray = array();
				if(!empty($attributeT)) {
					for($i=0;$i<count($attributeT);$i++){
						$attributeArray[] = array($attributeT[$i],$attributeV[$i]);
					}
				}
				$attributeValue = json_encode($attributeArray);
				$imagesValue = json_encode($imagesArray);
			        //----- end file upload -----------
					
					$string = str_replace(' ', '-', $this->input->post('p_name'));
					$productURL = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
					$productURL = strtolower($productURL.'-'.$id);
		
                $data_to_store = array(
					'p_id' => $productURL,
                    'pname' => $this->input->post('p_name'),
                    's_name' => $this->input->post('s_name'),
                    'status' => $this->input->post('status'),
					'description' => $this->input->post('p_description'),
					's_discription' => $this->input->post('s_discription'),
					'product_type' => $this->input->post('product_type'),
					'image' => $image,
					'attribute' => $attributeValue,
					'category' => $this->input->post('category'),
					'p_id' => $this->input->post('p_name'), 
					'url' => $this->input->post('url'), 
					'web_id' => $this->input->post('web_name'), 
				); 
             $return = $this->offer_model->update_product($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/product/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       $data['category'] = $this->offer_model->get_all_category();
       $data['web'] = $this->offer_model->get_all_tax();
        $data['product'] = $this->offer_model->get_all_product_id($id); 
        //load the view
        $data['main_content'] = 'admin/offer_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
     
		  public function banner(){
	  	
	 
	
		
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        
            	$image = '';
			$config['upload_path'] ='images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
 
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
						
                        $errors = $this->upload->display_errors();
						$image_data = $this->upload->data();
					    $image = $image_data['file_name'];
			        }
					
					
			
	
		
                $data_to_store = array(
                    
					'image' => $image,
					
					'type' => $this->input->post('type'),
					'url' => $this->input->post('url'),
					'status' => $this->input->post('status')
				); 
             $return = $this->offer_model->insert_banner($data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/banner_add/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        
       



       // $data['banner'] = $this->product_model->banner_list(); 
        //load the view
        $data['main_content'] = 'admin/banner_add'; 
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
		 $return = $this->offer_model->delete_product($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/offer');
 }  
}