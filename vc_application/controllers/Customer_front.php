<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_front extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
		$this->load->library('cart');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('search_model');	
        $this->load->model('customer_model');
    }
	
	public function index()
	{
            $data['page_keywords'] = '';
            $data['page_description'] = '';
            $data['page_slug'] = 'home';
            $data['page_title'] = 'RTI';
            $data['get_popup'] = $this->customer_model->get_popup();
		    $data['fech_news'] = $this->customer_model->fech_news();			
		    $data['franchise'] = $this->customer_model->fech_franchise();
			$data['achiever'] = $this->customer_model->new_achiever();
			$data['slider']= $this->customer_model->get_slider();
		    $data['category_list'] = $this->customer_model->get_category_list();
            $data['trending_services'] = $this->customer_model->get_food_products();
            $data['voucher'] = $this->customer_model->get_voucher();
	        $data['main_content'] = 'home_page';
            $this->load->view('includes/front/front_template', $data); 
			

	}

}
