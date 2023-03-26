<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->model('customer_model');
$this->load->library('cart');		
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'category';
                $data['page_title'] = 'Category'; 
		
                $category = $this->uri->segment(2);
				
                $category = str_replace('-',' ',$category);
	       $data['category'] = '';
               $category = $this->customer_model->get_category($category);
              if(!empty($category)) { $data['category'] = $category; } 

		    $data['category_list'] = $this->customer_model->get_category_list();
			$data['category_product'] = $this->customer_model->get_category_product($category[0]['id']);			$data['fech_achiver'] = $this->customer_model->fech_achievers();

	        $data['main_content'] = 'category';
            $this->load->view('includes/front/front_template', $data); 

	}

}
