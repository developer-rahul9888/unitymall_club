<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
		 $this->load->model('product_model');
        $this->load->model('merchant_model');
		$this->load->model('customer_model');
        $this->load->library('cart');		
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'merchant_page';
                $data['page_title'] = 'demands and delivery Merchant';
				
				
		$merchant_id = $this->uri->segment(2);
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['all_category_list'] = $this->merchant_model->get_all_category_list();
		$data['review'] = $this->merchant_model->get_merchant_review($merchant_id);
		$data['merchant'] = $this->merchant_model->merchant_data($merchant_id);
		$data['products'] = $this->merchant_model->get_products($merchant_id);
		$data['p_cat'] = $this->merchant_model->get_products_cat($merchant_id);
		$data['similar'] = $this->merchant_model->get_similar_merchant($data['merchant'][0]['business_type']);
	    $data['main_content'] = 'merchant_page'; 
        $this->load->view('includes/front/front_template', $data); 
	}

}
