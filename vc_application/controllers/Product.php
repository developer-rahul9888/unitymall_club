<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $this->load->model('product_model');	
        $this->load->model('customer_model');	
         $this->load->library('cart');
    }
	
	public function index()
	{
        redirect(base_url());
	}
	public function bliss_product_list(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'bliss_products';
                $data['page_title'] = 'Bliss products'; 
		$data['products'] = $this->product_model->get_bliss_product_list();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'products';
        $this->load->view('includes/front/front_template', $data); 
	}

	public function stores(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'stores';
                $data['page_title'] = 'Stores'; 
		$data['products'] = $this->product_model->get_stores_product();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'stores';
        $this->load->view('includes/front/front_template', $data); 
	}
	
	public function deals_king(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'deals_king';
                $data['page_title'] = 'Deals King'; 
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'deals_king';
        $this->load->view('includes/front/front_template', $data); 
	}
	
	public function new_arrivals(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'new-arrivals';
                $data['page_title'] = 'New Aarrivals'; 
		$data['products'] = $this->product_model->get_new_arrivals_product();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'new_arrivals';
        $this->load->view('includes/front/front_template', $data); 
	}
	public function search(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'search';
                $data['page_title'] = 'Search'; 
		$category = $this->uri->segment(2);	
       
       if ($this->input->server('REQUEST_METHOD') === 'POST'){ $keyword = $this->input->post('key'); $cat = $this->input->post('cat'); }else { $keyword = '';$cat = '';}
		$data['keyword'] = $this->input->post('search');
		//echo $keyword; echo '<br>'; echo $cat;
		$category_data = $this->product_model->get_categorys_by_id($cat);

		$types = explode(',', $category_data[0]['type']);
		$data['products'] = $this->product_model->get_new_arrivals_product($keyword,$types);
		//echo '<pre>'; print_r($data['products']); die();
		$data['merchants'] = $this->product_model->get_merchants($keyword);
		//echo '<pre>'; print_r($data['merchants']); die();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'search';
        $this->load->view('includes/front/front_template', $data); 
	}
	public function real_product()
	{
	    
	    
		$productURL = $this->uri->segment(2);
		$data['products'] = '';
        $product = $this->product_model->get_product_by_url($productURL);
		$data['store'] = json_decode($product[0]['images']);
		
        if(!empty($product)) {  
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = $product[0]['p_id'];
                $data['page_title'] = $product[0]['pname']; 
                $data['products'] = $product;
         } else { 
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'not-found';
                $data['page_title'] = 'Not Found'; 
		 }		
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('id', 'id', 'required|trim');
            $this->form_validation->set_rules('qty', 'qty', 'required|trim|numeric');
            $this->form_validation->set_rules('name', 'name', 'required|trim');
		//$this->form_validation->set_rules('price', 'price', 'required|trim|numeric');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {    
			
			$comm_dis = $product[0]['comm_dis'];
			$image = $this->input->post('image');
			$desc = $product[0]['s_discription'];
			$product_name = str_replace('/','',substr($this->input->post('name'),0,10));
            $product_dis = $product[0]['cost'];
            $price = $this->input->post('qty') * $product_dis;

            $insert_data = array(
                'id' => $this->input->post('id'),
                'tax' => $product[0]['t_class'],
                'name' => $product_name,
                'p_name' => $this->input->post('name'),
                'price' => $product[0]['cost'],
                'cost' => $product_dis,
                'qty' => $this->input->post('qty'),
                'reward' => $product[0]['reward'],
				'comm_dis' => $comm_dis,
				'p_d_price' => $product_dis,
                'i_total' => $price, 
				'options' => array('image' => $image, 'desc' => $desc)
             );
			  // This function add items into cart.
              $this->cart->insert($insert_data);
               redirect(base_url().'cart');
			  
			}  
		 }
 		 		 		 
	// $store	= $this->cart->contents();
	 //echo '<pre>';  print_r($store); die();
				
		   $id=explode("-",$product[0]['p_id']);
		   //echo '<pre>'; print_r($id); 
		  
            $data['review'] = $this->product_model->get_product_review(end($id));
		    $data['category_list'] = $this->customer_model->get_category_list();		
			$data['fech_achiver'] = $this->customer_model->fech_achievers();
	        $data['main_content'] = 'product';
            $this->load->view('includes/front/front_template', $data); 

	}
}
