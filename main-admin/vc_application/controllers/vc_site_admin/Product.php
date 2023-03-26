<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('product_model');
        $this->load->helper('string');		

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }


    public function stoke() {
    	
	$data['product'] = $this->product_model->get_all_stoke();
	//echo '<pre>'; print_r($data['product']); echo '</pre>';

	if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        	if(!empty($data['product'])) {
        		foreach ($data['product'] as $value) {
        			$data_to_store = array(
                    'pname' => $value['Title'],
                    'status' => 'Active',
					'description' => $value['Body'],
					'category' => $value['Product_type'],
					'weight' => $value['Weight'].' '.$value['WeightUnit'],
					'image' => $value['image'],
					'price' => $value['variant_compare_price'],
					'cost' => $value['variant_compare_price'],
					'brand' => $value['Brand'],
					'actual_price' => $value['variant_compare_price'],
					'p_d_price' => $value['variant_compare_price'],
					'p_qty' => $value['Qty']
				); 

        		$this->product_model->store_new_stoke($data_to_store);
                //if the insert has returned true then we show the flash message
                
				
        		}
        		$this->session->set_flashdata('flash_message', 'updated');
				redirect(current_url());
        	}
        	
        }
	
	//load the view
      $data['main_content'] = 'admin/stoke_list';
      $this->load->view('includes/admin/template', $data);   
  }





  public function index() {
    	
	$data['product'] = $this->product_model->get_all_product();
	
	//load the view
      $data['main_content'] = 'admin/product_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function web_add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('p_name', 'titlt', 'required|trim|min_length[4]');
			//$this->form_validation->set_rules('sku', 'sku', 'required|trim|is_unique[admin_product.sku]');
			//$this->form_validation->set_rules('weight', 'weight', 'required|trim');
			//$this->form_validation->set_rules('t_class', 't_class', 'required|trim');
			$this->form_validation->set_rules('model', 'model', 'trim');
			//$this->form_validation->set_rules('cost', 'cost', 'required|trim');
			$this->form_validation->set_rules('category', 'category', 'required|trim');
			
			$this->form_validation->set_rules('p_description', 'description', 'required');
			//$this->form_validation->set_rules('p_price', 'Price', 'required'); 
		//	$this->form_validation->set_rules('p_qty', 'Qty', 'required'); 
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		
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
					
				$imagesArray = array();  
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
					
		
			        //----- end file upload -----------
				
			
				$data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                    's_name' => $this->input->post('s_name'),
					'e_date' => $this->input->post('e_date'),
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
                //if the insert has returned true then we show the flash message
				if($this->product_model->store_web_product($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/w_product/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['category'] = $this->product_model->get_all_category();
        $data['web'] = $this->product_model->get_all_webstores();
		//echo '<pre>'; print_r($data['tax']);die();
        $data['main_content'] = 'admin/web_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function web_update(){
	  	
	 
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
			//$this->form_validation->set_rules('sku', 'sku', 'required|trim'.$is_unique_sku);
			//$this->form_validation->set_rules('weight', 'weight', 'required|trim');
			//$this->form_validation->set_rules('t_class', 't_class', 'required|trim'); 
			$this->form_validation->set_rules('cost', 'cost', 'required|trim');
			//$this->form_validation->set_rules('category', 'category', 'required|trim');
			
			//$this->form_validation->set_rules('p_discription', 'discription', 'required');
			//$this->form_validation->set_rules('p_qty', 'Qty', 'required'); 
			
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
					
					$string = str_replace(' ', '-', $this->input->post('p_name'));
					$productURL = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
					$productURL = strtolower($productURL.'-'.$id);
		
                $data_to_store = array(
					'p_id' => $productURL,
                    'pname' => $this->input->post('p_name'),
                    's_name' => $this->input->post('s_name'),
					'e_date' => $this->input->post('e_date'),
                    'status' => $this->input->post('status'),
					'visibility' => $this->input->post('visibility'),
					'description' => $this->input->post('p_discription'),
					's_discription' => $this->input->post('s_discription'),
					'product_type' => $this->input->post('product_type'),
					'image' => $image, 
					'attribute' => $attributeValue,
					'category' => $this->input->post('category'),
					'p_id' => $this->input->post('p_name'), 
					'url' => $this->input->post('url'), 
					'web_id' => $this->input->post('web_name'), 
				); 
             $return = $this->product_model->update_web_product($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/w_product/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       $data['category'] = $this->product_model->get_all_category();
        $data['web'] = $this->product_model->get_all_webstores();
        $data['product'] = $this->product_model->get_all_web_product_id($id); 
        //load the view
        $data['main_content'] = 'admin/web_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
    public function remove_img (){
	  $img = $_POST['img'];
	  if($img !=''){
		  unlink('images/product/'.$img);
	  }		
  }
  public function del(){
  
  $id = $this->uri->segment(4);   $img = $this->uri->segment(5);   
		 $return = $this->product_model->delete_product($id); 		 		 if($img !=''){		  unlink('images/product/'.$img);	  }
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/product');
 }  

	
  public function ecommerce() { 
    	
	$data['product'] = $this->product_model->get_all_product_ecommerce();
	
	//load the view
      $data['main_content'] = 'admin/ecommerce_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function e_add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  $data['productt'] = $this->product_model->get_all_freeproduct();
	 //echo '<pre>'; print_r($data['productt']);die();
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('p_name', 'titlt', 'required|trim');
			//$this->form_validation->set_rules('sku', 'sku', 'required|trim|is_unique[admin_product.sku]');
			$this->form_validation->set_rules('weight', 'weight', 'required|trim');
			$this->form_validation->set_rules('t_class', 't_class', 'required|trim');
			$this->form_validation->set_rules('model', 'model', 'trim');
			$this->form_validation->set_rules('cost', 'cost', 'required|trim');
			$this->form_validation->set_rules('category', 'category', 'required|trim');
			
			$this->form_validation->set_rules('description', 'description', 'required');
			//$this->form_validation->set_rules('p_price', 'Price', 'required'); 
			$this->form_validation->set_rules('p_qty', 'Qty', 'required'); 
			
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
				$imagesArray = array();

				if(!empty($_FILES['p_image']['name'])){
            $filesCount = count($_FILES['p_image']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['p_image']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['p_image']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['p_image']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['p_image']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['p_image']['size'][$i];
				
			$config['upload_path'] ='/home/dndmarke/demandsanddelivery.com/merchants/images/product/';
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
				$actual_price = $this->input->post('p_d_price')/((100+$this->input->post('t_class'))/100);

				
				/*$data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                    'status' => $this->input->post('status'),
                    'hsn' => $this->input->post('hsn'),
					'description' => $this->input->post('p_description'),
					's_discription' => $this->input->post('s_discription'),
					'weight' => $this->input->post('weight'),
					't_class' => $this->input->post('t_class'),
					'image' => $image,
					'price' => $this->input->post('price'),
					//'free_product' => $this->input->post('free_product'),
					'p_d_price' => $this->input->post('p_d_price'),
					'actual_price' => round($actual_price,2),
					'cost' => $this->input->post('cost'),
					'comm_dis' => $this->input->post('comm_dis'),
					'p_qty' => $this->input->post('p_qty'),
					'category' => $this->input->post('category')
				); */

				$data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                  //  's_name' => $this->input->post('s_name'),
                    'status' => $this->input->post('status'),
					'description' => $this->input->post('description'),
					's_discription' => $this->input->post('s_discription'), 
					'weight' => $this->input->post('weight'),
					'sku' => $this->input->post('sku'),
					't_class' => $this->input->post('t_class'),
					'color' => $this->input->post('color'),
					'model' => $this->input->post('model'),
					's_p_n_f_date' => $this->input->post('s_p_n_f_date'),	
					's_p_n_to_date' => $this->input->post('s_p_n_to_date'),
					'delivery_charge' => $this->input->post('delivery_charge'),
					'image' => $image,
					'images' => $imagesValue,
					'attribute' => $attributeValue,
					'price' => $this->input->post('p_price'),
					'cost' => $this->input->post('cost'),
					'comm_dis' => $this->input->post('comm_dis'),
					'brand' => $this->input->post('brand'),
					'actual_price' => round($actual_price,2),
					'p_d_price' => $this->input->post('p_d_price'),
					'comm_dis' => $this->input->post('comm_dis'),
					'reward' => $this->input->post('reward'),
					'p_qty' => $this->input->post('p_qty'),
					'spfdate' => $this->input->post('spfdate'),
					'category' => $this->input->post('category'),
					'sptdate' => $this->input->post('sptdate')
				); 


                //if the insert has returned true then we show the flash message
				if($this->product_model->store_product_ecommerce($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/e_product/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['category'] = $this->product_model->get_all_category();
        $data['tax'] = $this->product_model->get_all_tax();
        $data['main_content'] = 'admin/ecommerce_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function e_update(){
	   $data['producttt'] = $this->product_model->get_all_freeproduct(); 
	  // print_r($data['producttt']);die();
	  	
	 
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
			//$this->form_validation->set_rules('sku', 'sku', 'required|trim'.$is_unique_sku);
			$this->form_validation->set_rules('weight', 'weight', 'required|trim');
			$this->form_validation->set_rules('t_class', 't_class', 'required|trim'); 
			$this->form_validation->set_rules('cost', 'cost', 'required|trim');
			$this->form_validation->set_rules('category', 'category', 'required|trim');
			
			$this->form_validation->set_rules('description', 'discription', 'required');
			$this->form_validation->set_rules('p_qty', 'Qty', 'required'); 
			
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
				
			$config['upload_path'] ='/home/dndmarke/demandsanddelivery.com/merchants/images/product/';
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
				

				$actual_price = $this->input->post('p_d_price')/((100+$this->input->post('t_class'))/100);
                $data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                  //  's_name' => $this->input->post('s_name'),
                    'status' => $this->input->post('status'),
					'description' => $this->input->post('description'),
					's_discription' => $this->input->post('s_discription'), 
					'weight' => $this->input->post('weight'),
					'sku' => $this->input->post('sku'),
					't_class' => $this->input->post('t_class'),
					'visibility' => $this->input->post('product_type'),
					'product_type' => $this->input->post('product_type'),
					'm_name' => $this->input->post('m_name'),
					'b_code' => $this->input->post('b_code'),
					'brand' => $this->input->post('brand'),
					'color' => $this->input->post('color'),
					'model' => $this->input->post('model'),
					's_p_n_f_date' => $this->input->post('s_p_n_f_date'),	
					's_p_n_to_date' => $this->input->post('s_p_n_to_date'),
					'delivery_charge' => $this->input->post('delivery_charge'),
					'image' => $image,
					'images' => $imagesValue,
					'attribute' => $attributeValue,
					'price' => $this->input->post('p_price'),
					'cost' => $this->input->post('cost'),
					'comm_dis' => $this->input->post('comm_dis'),
					'actual_price' => round($actual_price,2),
					'p_d_price' => $this->input->post('p_d_price'),
					'comm_dis' => $this->input->post('comm_dis'),
					'reward' => $this->input->post('reward'),
					'p_qty' => $this->input->post('p_qty'),
					'spfdate' => $this->input->post('spfdate'),
					'category' => $this->input->post('category'),
					'sub_category' => $this->input->post('sub_category'),
					'sptdate' => $this->input->post('sptdate'),
					'p_id' => $productURL
				); 
             $return = $this->product_model->update_product_ecommerce($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/e_product/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       $data['category'] = $this->product_model->get_all_category();
        $data['tax'] = $this->product_model->get_all_tax();
        $data['product'] = $this->product_model->get_all_product_id_ecommerce($id); 
        //load the view
        $data['main_content'] = 'admin/ecommerce_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
    public function e_remove_img (){
	  $img = $_POST['img'];
	  if($img !=''){
		  unlink('images/product/'.$img);
	  }
  }
  public function e_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->product_model->delete_product_ecommerce($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/e_product');
 }  
public function f_add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('p_name', 'titlt', 'required|trim|min_length[4]');
			//$this->form_validation->set_rules('sku', 'sku', 'required|trim|is_unique[admin_product.sku]');
			//$this->form_validation->set_rules('weight', 'weight', 'required|trim');
			//$this->form_validation->set_rules('t_class', 't_class', 'required|trim');
			$this->form_validation->set_rules('model', 'model', 'trim');
			//$this->form_validation->set_rules('price', 'price', 'required|trim');
			$this->form_validation->set_rules('category', 'category', 'required|trim');
			
			$this->form_validation->set_rules('p_description', 'description', 'required');
			//$this->form_validation->set_rules('p_price', 'Price', 'required'); 
			//$this->form_validation->set_rules('p_qty', 'Qty', 'required'); 
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		
				// file upload start here
			$config['upload_path'] ='assets/images/';
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
				$attributeT = $this->input->post('a_title');
				$attributeV = $this->input->post('a_value');
				$attributeArray = array();
				if(!empty($attributeT)) {
					for($i=0;$i<count($attributeT);$i++){
						$attributeArray[] = array($attributeT[$i],$attributeV[$i]);
					}
				}
				$attributeValue = json_encode($attributeArray);
				
			
				$data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                    'status' => $this->input->post('status'),
					'description' => $this->input->post('p_description'),
					's_discription' => $this->input->post('s_discription'),
					//'points' => $this->input->post('points'),
					//'weight' => $this->input->post('weight'),
				//	'price' => $this->input->post('price'),
					'attribute' => $attributeValue,
					'image' => $image,
					//'price' => $this->input->post('price'),
					//'p_d_price' => $this->input->post('p_d_price'),
					//'cost' => $this->input->post('cost'),
					//'comm_dis' => $this->input->post('comm_dis'),
					//'p_qty' => $this->input->post('p_qty'),
					'category' => $this->input->post('category')
				); 
                //if the insert has returned true then we show the flash message
				if($this->product_model->store_freeproduct_ecommerce($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/f_product/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['category'] = $this->product_model->get_all_category();
        $data['tax'] = $this->product_model->get_all_tax();
        $data['main_content'] = 'admin/free_productadd'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  

 public function freeproduct() {
    	
	$data['freeproduct'] = $this->product_model->get_all_freeproduct();
	//echo '<pre>'; print_r($data['freeproduct']); die();
	
	//load the view
      $data['main_content'] = 'admin/freeproduct_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  
  public function voucher_order() {
    	
	$data['voucher_order'] = $this->product_model->get_voucher_order();
	//echo '<pre>'; print_r($data['freeproduct']); die();
	
	//load the view
      $data['main_content'] = 'admin/voucher_order';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  
  
  
  
  
  
  
  
  



public function f_update(){
	  	
	 
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
			//$this->form_validation->set_rules('sku', 'sku', 'required|trim'.$is_unique_sku);
			//$this->form_validation->set_rules('weight', 'weight', 'required|trim');
			//$this->form_validation->set_rules('t_class', 't_class', 'required|trim'); 
			//$this->form_validation->set_rules('cost', 'cost', 'required|trim');
			$this->form_validation->set_rules('category', 'category', 'required|trim');
		//	$this->form_validation->set_rules('price', 'price', 'required|trim');
			
			$this->form_validation->set_rules('p_discription', 'discription', 'required');
			//$this->form_validation->set_rules('p_qty', 'Qty', 'required'); 
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		  // file upload start here
            	$image = 'noimg.jpg';
			$config['upload_path'] ='assets/images/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                    if($this->input->post('image_old')!='') unlink('assets/images/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else {
                        $errors = $this->upload->display_errors();
						$image = $this->input->post('image_old');
			        }
					
				$attributeT = $this->input->post('a_title');
				$attributeV = $this->input->post('a_value');
				$attributeArray = array();
				if(!empty($attributeT)) {
					for($i=0;$i<count($attributeT);$i++){
						$attributeArray[] = array($attributeT[$i],$attributeV[$i]);
					}
				}
				$attributeValue = json_encode($attributeArray);
			     
			        //----- end file upload -----------
					
					$string = str_replace(' ', '-', $this->input->post('p_name'));
					$productURL = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
					$productURL = strtolower($productURL.'-'.$id);
		
                $data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                    'status' => $this->input->post('status'),
					'description' => $this->input->post('p_discription'),
					//'points' => $this->input->post('points'),
					's_discription' => $this->input->post('s_discription'), 
					//'weight' => $this->input->post('weight'),
					'sku' => $this->input->post('sku'),
					//'t_class' => $this->input->post('t_class'),
					//'b_code' => $this->input->post('b_code'),
					'image' => $image,
					//'price' => $this->input->post('price'),
					'attribute' => $attributeValue,
					//'p_d_price' => $this->input->post('p_d_price'),
					//'cost' => $this->input->post('cost'),
					//'comm_dis' => $this->input->post('comm_dis'),
					//'p_qty' => $this->input->post('p_qty'),
					'category' => $this->input->post('category'),
					'p_id' => $productURL
				); 
             $return = $this->product_model->update_freeproduct_ecommerce($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/f_product/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       $data['category'] = $this->product_model->get_all_category();
        $data['tax'] = $this->product_model->get_all_tax();
        $data['f_products'] = $this->product_model->get_all_fproduct_id_ecommerce($id); 
        //load the view
        $data['main_content'] = 'admin/freeproduct_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
   

 public function f_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->product_model->delete_fproduct_ecommerce($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/f_product');
 }  


 public function web_product_list() {
    	
	$data['product'] = $this->product_model->get_all_web_product();
	
	//load the view
      $data['main_content'] = 'admin/web_product_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
 public function web_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->product_model->delete_web_product($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/w_product');
 }  
 public function m_list() {
    	
	$data['product'] = $this->product_model->get_all_m_product();

	//load the view
      $data['main_content'] = 'admin/m_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function m_update(){
	  
	
	  	
	 
	  //product id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            /*form validation*/
           $this->form_validation->set_rules('p_name', 'title', 'required|trim|min_length[4]');
		   if($this->input->post('sku') != $this->input->post('sku_old')) {
				$is_unique_sku =  '|is_unique[admin_product.sku]';
			} else { $is_unique_sku =  '';	}
			//$this->form_validation->set_rules('sku', 'sku', 'required|trim'.$is_unique_sku);
			$this->form_validation->set_rules('weight', 'weight', 'required|trim');
			$this->form_validation->set_rules('t_class', 't_class', 'required|trim'); 
			$this->form_validation->set_rules('model', 'model', 'trim');
			$this->form_validation->set_rules('cost', 'cost', 'required|trim');
			$this->form_validation->set_rules('category', 'category', 'required|trim');
			
			$this->form_validation->set_rules('p_discription', 'discription', 'required');
			$this->form_validation->set_rules('p_price', 'Price', 'required');
			$this->form_validation->set_rules('p_qty', 'Qty', 'required'); 
			
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
				
			$config['upload_path'] ='/home/dndmarke/demandsanddelivery.com/merchants/images/product/';
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
					
					if($this->input->post('p_d_price')=="" || $this->input->post('p_d_price')==0){$p_d_price=$this->input->post('cost');}else{$p_d_price=$this->input->post('p_d_price');}
		
                $data_to_store = array(
                    'pname' => $this->input->post('p_name'),
                    's_name' => $this->input->post('s_name'),
                    'status' => $this->input->post('status'),
					'description' => $this->input->post('p_discription'),
					's_discription' => $this->input->post('s_discription'), 
					'weight' => $this->input->post('weight'),
					'sku' => $this->input->post('sku'),
					't_class' => $this->input->post('t_class'),
					'visibility' => $this->input->post('product_type'),
					'product_type' => $this->input->post('product_type'),
					'm_name' => $this->input->post('m_name'),
					'b_code' => $this->input->post('b_code'),
					'color' => $this->input->post('color'),
					'model' => $this->input->post('model'),
					's_p_n_f_date' => $this->input->post('s_p_n_f_date'),	
					's_p_n_to_date' => $this->input->post('s_p_n_to_date'),
					'delivery_charge' => $this->input->post('delivery_charge'),
					'image' => $image,
					'images' => $imagesValue,
					'attribute' => $attributeValue,
					'price' => $this->input->post('p_price'),
					'cost' => $this->input->post('cost'),
					'comm_dis' => $this->input->post('comm_dis'),
					'p_d_price' => $p_d_price,
					'comm_dis' => $this->input->post('comm_dis'),
					'p_qty' => $this->input->post('p_qty'),
					'spfdate' => $this->input->post('spfdate'),
					'category' => $this->input->post('category'),
					'sub_category' => $this->input->post('sub_category'),
					'sptdate' => $this->input->post('sptdate'),
					'p_id' => $productURL
				); 
             $return = $this->product_model->update_m_products($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/m_product/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        $data['category'] = $this->product_model->get_all_category();
        $data['tax'] = $this->product_model->get_all_tax(); 
        $data['product'] = $this->product_model->get_all_merchant_product_id($id); 
        //load the view
        $data['main_content'] = 'admin/m_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
 public function voucher_order_update(){
	  	
	// $this->load->library('email');

	// $config = array();
	// $config['protocol'] = 'smtp';
	// //$config['mailpath']     = "/usr/bin/sendmail";
	// $config['smtp_host'] = 'mail.unitymall.in';
	// $config['smtp_user'] = 'info@unitymall.in';
	// $config['smtp_pass'] = 'v54L!F162p=c';
	// $config['smtp_port'] = 465;
	// $config['smtp_crypto '] = 'ssl';
	// $config['charset'] = 'utf-8';
	// $this->email->initialize($config);
	// $this->email->set_newline("\r\n");

	// $this->email->from('support@unitymall.club', 'Unitymall');
	// $this->email->to('goldroger9888@gmail.com');
	// $this->email->subject('Send Email Codeigniter');
	// $this->email->message('The email send using codeigniter library');
	// if($this->email->send()) {
	// 	die;
	// 	$this->session->set_flashdata("error","Congragulation Email Send Successfully.");
	// }     
	// else {
	// 	echo $this->email->print_debugger();
	// 	die;
	// 	$this->session->set_flashdata("error","You have encountered an error");
	// }


	/***************** Registration email ******************/
  
	$to = 'developer.rahul9888@gmail.com';
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
	$headers .= 'From: unittymall Pvt Ltd. <Info@unitymall.in>' . "\r\n"; 
	$subject = 'Thank you for joining the unittymall .';
	$message = '<table align="center" cellpadding="0" cellspacing="0" border="0" style="width:750px;margin:auto">
	<tbody><tr>
		<td align="center" style="border:2px solid #7f7f80">
			<table align="center" cellpadding="0" cellspacing="0" border="0" style="width:100%" width="100%">
				<tbody><tr>
					<td style="padding:24px">
						<table align="center" cellpadding="0" cellspacing="0" border="0" style="background:#f0f0f0;width:100%" width="100%" bgcolor="#f0f0f0">
							<tbody><tr>
								<td valign="bottom" style="font-size:0;padding:4px 0 0 14px" width="70px">
									<img src="https://ci5.googleusercontent.com/proxy/-XcAZCu803qGdR-gYRdHVtbukils5D6-XlXpkcPfPZ7yPlYd804luuDbyACqJ7Z1nOFz8XKGZpyxyFwaIkwcDjrtaexFnK-cIAvMJw=s0-d-e1-ft#https://cdn.gyftr.com/vouchermailers/gyftr-gv/gift_ic.png" alt="" class="CToWUd" data-bit="iit">
								</td>
								<td valign="middle" style="font-family:verdana,sans-serif;font-size:16px;color:#262626;font-weight:bold;padding:0px 0 0 14px">Happiness Delivered. Instantly.</td>
								<td align="right" valign="middle" style="padding:4px 14px 4px 0"><img src="https://mail.google.com/mail/u/2?ui=2&amp;ik=621df3f0bb&amp;attid=0.3&amp;permmsgid=msg-f:1748227978939006460&amp;th=1842f415970efdfc&amp;view=fimg&amp;fur=ip&amp;sz=s0-l75-ft&amp;attbid=ANGjdJ_gTvzHAG_dymEzpv8MJX2LC0e0pGhrCM2PkBJL-h3hBP3tq4M27GEKFJbqZ7HJo2Ten99wX0EfePqEphiPw2YnYD3FBasN0Tnf6f7-1WldPZ2xGW7RmEWiM-c&amp;disp=emb&amp;realattid=ii_l9jgfwt32" alt="Unity mall logo croped.jpg" width="202" height="81" style="margin-right:0px" data-image-whitelisted="" class="CToWUd" data-bit="iit"><br></td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td align="center" style="background:#f0f0f0;border-radius:22px;padding:26px" bgcolor="#f0f0f0">
						<table align="center" cellpadding="0" cellspacing="0" border="0" style="width:100%" width="100%">
							<tbody><tr>
								<td style="padding:26px;background:#fff;border-radius:10px">
									<table align="center" cellpadding="0" cellspacing="0" border="0" style="width:100%" bgcolor="#fff" width="100%">
										<tbody><tr>
											<td style="font-family:verdana,sans-serif;font-size:14px;color:#262626">Hi K Geetha Rani<strong>,</strong></td>
										</tr>
										<tr>
											<td style="font-family:verdana,sans-serif;font-size:14px;color:#262626;padding:26px 0">We thank you for Shopping at Unitymall for Pizza Hut Gift Voucher.</td>
										</tr>
										<tr>
											<td style="font-family:verdana,sans-serif;font-size:14px;color:#262626;font-weight:bold">
												Pls find below the Voucher details:
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
							<tr>
								<td align="center" style="padding:20px 0">
									<img src="https://ci5.googleusercontent.com/proxy/zjczOhiujJvrBWvDp10xQzfAbxp9YV6pMrgy2bL50hSadfwh7jwpwIvld13jJ9yONY4GV_ElPhwOGtSupnRDatSIdVXDBVwD-Tmo0_kLL6u356Rh3lQr3qAINaEB2Y1D4W-rTchcGYEC8u3bUG1WRY_kWUJ68T0nuRnHIFLxcBGFkWGnklC91UQ=s0-d-e1-ft#https://s3.ap-south-1.amazonaws.com/assets.gyftr.com/comm_engine/prod/images/brands/1593577589894_1yeeckzpkc2uy9vq.png" alt="Pizza Hut" style="width:150px" width="150" class="CToWUd" data-bit="iit">
								</td>
							</tr>
							<tr>
								<td align="center"> 
									<table align="center" cellpadding="0" cellspacing="0" border="0" style="width:100%" width="100%">
										<tbody><tr>
<td align="center" style="padding-bottom:15px">
  <table align="center" cellpadding="0" cellspacing="0" border="0" style="width:100%" width="100%">
	 <tbody><tr>
		<td style="border-radius:10px;padding:20px;border-bottom:4px solid #343539;background:#fff" bgcolor="fff">
		   <table align="center" cellpadding="0" cellspacing="0" border="0" style="width:100%;background:#fff" width="100%" bgcolor="#fff">
			  <tbody><tr>
				 <td align="center" valign="middle" style="background:#f0f0f0;padding:10px;border-radius:10px;font-size:0" bgcolor="#f0f0f0" width="140px">
					<img src="https://mail.google.com/mail/u/2?ui=2&amp;ik=621df3f0bb&amp;attid=0.1&amp;permmsgid=msg-f:1748227978939006460&amp;th=1842f415970efdfc&amp;view=fimg&amp;fur=ip&amp;sz=s0-l75-ft&amp;attbid=ANGjdJ9CuKQDupdiu_W2lqls4dwa2PAstYMqdBhqoYkoQ3g9uhUUNilX_U6XmZtRw1rZmrF9I5qK7fDkud9IjYJnv27E5w-uyJjxr4E-vbbzzriPP_d2VmZKbT1qQeY&amp;disp=emb&amp;realattid=183fe0c519d3e3fa6df1" width="120" height="120" alt="8080601319732847" data-image-whitelisted="" class="CToWUd" data-bit="iit">
				 </td>
				 <td style="padding-left:18px">
					<table align="center" cellpadding="0" cellspacing="16" border="0" style="width:100%" width="100%">
					   <tbody><tr>
						  <td style="font-family:verdana,sans-serif;font-size:14px;color:#262626">Voucher Code:</td>
						  <td align="right" style="font-family:verdana,sans-serif;font-size:14px;color:#262626;font-weight:bold">
							 <strong>8080601319732847</strong>
						  </td>
					   </tr>
					   <tr>
						  <td style="font-family:verdana,sans-serif;font-size:14px;color:#262626">Face Value</td>
						  <td align="right" style="font-family:verdana,sans-serif;font-size:14px;color:#262626;font-weight:bold">
							 <strong>250.00</strong>
						  </td>
					   </tr>
					   <tr>
						  <td style="font-family:verdana,sans-serif;font-size:14px;color:#262626">Expiry Date</td>
						  <td align="right" style="font-family:verdana,sans-serif;font-size:14px;color:#262626;font-weight:bold">
							 <strong>31 Oct 2023</strong>
						  </td>
					   </tr>
					</tbody></table>
				 </td>
			  </tr>
		   </tbody></table>
		</td>
	 </tr>
  </tbody></table>
</td>
</tr><tr>
<td align="center" style="padding-bottom:15px">
  <table align="center" cellpadding="0" cellspacing="0" border="0" style="width:100%" width="100%">
	 <tbody><tr>
		<td style="border-radius:10px;padding:20px;border-bottom:4px solid #343539;background:#fff" bgcolor="fff">
		   <table align="center" cellpadding="0" cellspacing="0" border="0" style="width:100%;background:#fff" width="100%" bgcolor="#fff">
			  <tbody><tr>
				 <td align="center" valign="middle" style="background:#f0f0f0;padding:10px;border-radius:10px;font-size:0" bgcolor="#f0f0f0" width="140px">
					<img src="https://mail.google.com/mail/u/2?ui=2&amp;ik=621df3f0bb&amp;attid=0.2&amp;permmsgid=msg-f:1748227978939006460&amp;th=1842f415970efdfc&amp;view=fimg&amp;fur=ip&amp;sz=s0-l75-ft&amp;attbid=ANGjdJ971pUn-llM_xd_ESMkNeh-BN02jyXVI6VbiMbn74WE4ZkqnCCV2plSnn1BVbxLKE9DcbhvErhJfhblB_W1LLDnuBhONDD2VuSNlqVMzUxg9xXWZD7E6UejChI&amp;disp=emb&amp;realattid=183fe0c519e3e3fa6e02" width="120" height="120" alt="8080601319732939" data-image-whitelisted="" class="CToWUd" data-bit="iit">
				 </td>
				 <td style="padding-left:18px">
					<table align="center" cellpadding="0" cellspacing="16" border="0" style="width:100%" width="100%">
					   <tbody><tr>
						  <td style="font-family:verdana,sans-serif;font-size:14px;color:#262626">Voucher Code:</td>
						  <td align="right" style="font-family:verdana,sans-serif;font-size:14px;color:#262626;font-weight:bold">
							 <strong>8080601319732939</strong>
						  </td>
					   </tr>
					   <tr>
						  <td style="font-family:verdana,sans-serif;font-size:14px;color:#262626">Face Value</td>
						  <td align="right" style="font-family:verdana,sans-serif;font-size:14px;color:#262626;font-weight:bold">
							 <strong>250.00</strong>
						  </td>
					   </tr>
					   <tr>
						  <td style="font-family:verdana,sans-serif;font-size:14px;color:#262626">Expiry Date</td>
						  <td align="right" style="font-family:verdana,sans-serif;font-size:14px;color:#262626;font-weight:bold">
							 <strong>31 Oct 2023</strong>
						  </td>
					   </tr>
					</tbody></table>
				 </td>
			  </tr>
		   </tbody></table>
		</td>
	 </tr>
  </tbody></table>
</td>
</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr> 
				<tr>
					<td align="center" style="text-align:start;padding:40px 20px"><b>How to Redeem?</b></td>
				</tr>
				<tr>
					<td style="background:#f0f0f0;padding:24px" bgcolor="#f0f0f0">
						<table cellpadding="0" cellspacing="0" border="0" style="width:100%" width="100%">
							<tbody><tr>
								<td style="font-family:verdana,sans-serif;font-size:16px;color:#262626;font-weight:bold;padding-bottom:10px">
									Important Instructions
								</td>
							</tr>
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" border="0" style="width:100%" width="100%">
										<tbody><tr>
											<td valign="top" style="font-family:verdana,sans-serif;font-size:14px;color:#262626;font-weight:bold">
													<ul> <li>Multiple Gift Vouchers <span>CAN</span> be used in one bill. </li><li>One Gift Voucher <span>CANNOT</span> be used multiple times. </li><li>Gift Vouchers <span>ACCEPTED</span> at all Listed Outlets. </li><li>Gift Vouchers <span>CANNOT</span> be used Online. </li></ul>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td style="padding:24px">
						<table cellpadding="0" cellspacing="0" border="0" style="width:100%" width="100%">
							<tbody><tr>
								<td style="font-family:verdana,sans-serif;font-size:16px;color:#262626;font-weight:bold;padding-bottom:10px">
									Terms &amp; Conditions
								</td>
							</tr>
							<tr>
								<td style="padding:0 10px">
									<table cellpadding="0" cellspacing="0" border="0" style="width:100%" width="100%">
										<tbody><tr>
											<td valign="top" style="font-family:verdana,sans-serif;font-size:14px">1.This is a Yum! Restaurants Insta Gift Voucher (GV) / Gift Card (GC) and would be accepted at listed outlets. <br>2.The person who has the Yum! Restaurants GV / GC Code is deemed to be the beneficiary. <br>3.Do inform the cashier that you plan to use the GV / GC for making payments before billing. <br>4.Only the listed Yum! Restaurants outlets at its sole discretion accept the GV / GC. Yum! Restaurants may add or remove an outlet without giving any prior notice. <br>5.More than one GV / GC can be used in one bill. <br>6.This is a ONE time use GV / GC. <br>7.No Credit note / Refund for the unused amount of the GV / GC will be given. <br>8.Yum! Restaurants GV / GC CANNOT be revalidated once expired. <br>10.Yum! Restaurants GV / GC cannot be redeemed on specific block out dates. Yum! Restaurants may add or delete any date on its sole discretion. <br>11.Any dispute related to the GV / GC should be referred to the issuing company and the decision of the issuing company shall be final. <br>12.Yum! Restaurants make full efforts to accept Insta Gift Vouchers (GV) / Gift Card (GC), but on account of any technical / administrative reasons an outlet may refuse to accept the same. <br>13.If an Insta Gift Voucher (GV) /Gift Card (GC) gets blocked on account of technical issue, it would get enabled in 72 hours. <br>14.Please contact Shop manager for any acceptance issues.</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td align="center" style="background:#f7941d" bgcolor="#f7941d"></td></tr><tr><td align="center" style="font-family:verdana,sans-serif;font-size:14px;color:#fff;padding:10px 8px;background:#343539" bgcolor="#343539">Visit <a href="http://www.unitymall.in" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.unitymall.in&amp;source=gmail&amp;ust=1668407339291000&amp;usg=AOvVaw2NswBhWue4FzEDgKYb4sTq" mcafee_aps="true">www.unitymall.in</a> &amp; chat with us for any help</td>
				</tr>
			</tbody></table>
		</td>
	</tr> 
</tbody></table>';
	//mail($to,$subject,$message,$headers);
	  //product id 
        $id = $this->uri->segment(4);
		$data['voucher_order'] = $this->product_model->get_all_voucher_order($id); 
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
          	$this->form_validation->set_rules('status', 'status', 'required');
			$voucher_code = $this->input->post('voucher_code');

			if($voucher_code) {
				$codeData = $this->product_model->check_voucher_history_by_code($voucher_code); 
				if(empty($codeData)){
					$this->form_validation->set_rules('error', 'error', 'required');
					$this->form_validation->set_message('required', 'Invalid Voucher Code');
				}
				elseif($codeData[0]['user_id'] > 0 && $codeData[0]['user_id'] != $data['voucher_order'][0]['user_id']){
					$this->form_validation->set_rules('error', 'error', 'required');
					$this->form_validation->set_message('required', 'Voucher Code Already Used');
				}
			}

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
			$phone = $data['voucher_order'][0]['phone'];  
			$name = $data['voucher_order'][0]['name'];
			$user_id = $data['voucher_order'][0]['user_id'];
			$price = $data['voucher_order'][0]['price'];
			
			if($this->input->post('status')=='Accepted') {

				
			if($voucher_code) {
				$data_to_store = [
					'user_id' => $user_id
				];
				$this->product_model->update_voucher_history($codeData[0]['VoucherGCcode'],$data_to_store); 
			}
			
			$sms_msg = urlencode('Dear '.$name.' your '.$data['voucher_order'][0]['pname'].' Voucher has been generated successfully, Please check your registered e-mail ID. Do Not Share It With Anyone. Regards, Unitymall Inc.');

			$smstext ="http://trans.businesskarma.in/api/v4/?api_key=A489d867d76419ff045781f5fc877e40a&method=sms&message=".$sms_msg."&to=".$phone."&sender=UNTYML";
			file_get_contents($smstext);
			}

			if($this->input->post('status')=='Rejected' && $data['voucher_order'][0]['status'] != 'Rejected') {
				$this->product_model->load_wallet($user_id,$price,'points');
				$data_to_store = [
					'user_id' => $user_id,
					'send_to' => $user_id,
					'type' => 'Refund',
					'wallet_type' => 'Point',
					'description' => 'Voucher request rejected.',
					'amount' => $price,
					'status' => 'Credit'
				];
				$this->product_model->add_transactions($data_to_store);
			}


			$data_to_store = array(
			'status' => $this->input->post('status'),
			'note' => $this->input->post('note'),
			'voucher_code' => $voucher_code
			); 
			$return = $this->product_model->update_voucher_order($id, $data_to_store);


             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/voucher_order/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       $data['category'] = $this->product_model->get_all_category();
        $data['tax'] = $this->product_model->get_all_tax();
        
        //load the view
        $data['main_content'] = 'admin/voucher_order_update'; 
        $this->load->view('includes/admin/template', $data); 
  }


  public function receipt_list() {
    	
	$data['receipt'] = $this->product_model->get_all_receipt();
	
	//load the view
      $data['main_content'] = 'admin/receipt_list';
      $this->load->view('includes/admin/template', $data);   
  }


	public function receipt_update(){	
	 
	//product id 
	$id = $this->uri->segment(4);

	  /*if save button was clicked, get the data sent via post*/
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
	  {
		  /*form validation*/
		$this->form_validation->set_rules('status', 'status', 'required');  
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		  //if the form has passed through the validation
		if ($this->form_validation->run())
		{ 


			$data_to_store = array(
				'status' => $this->input->post('status')
			); 
		   	$return = $this->product_model->update_receipt($id, $data_to_store);

		   	if($return == TRUE){
				  $this->session->set_flashdata('flash_message', 'updated');
				  redirect('admin/receipt/edit/'.$id.'');
			}else{
				$this->session->set_flashdata('flash_message', 'not_updated');
			}
		  }/*validation run*/

	  }

	  //if we are updating, and the data did not pass trough the validation
	  //the code below wel reload the current data
	  $data['receipt'] = $this->product_model->get_receipt_by_id($id); 
	  //load the view
	  $data['main_content'] = 'admin/receipt_update'; 
	  $this->load->view('includes/admin/template', $data); 
}
 

}