<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deals extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->model('product_model');	
        $this->load->model('customer_model');	
        //$this->load->library('cart');
    }
	
	public function index() {
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'deals';
                $data['page_title'] = 'Deals King'; 
		$data['deals'] = $this->product_model->get_deals_list();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'deals_king';
        $this->load->view('includes/front/front_template', $data); 
	}  
	 
	public function merchants_deal()
	{
		$dealURL = $this->uri->segment(2);
		$data['deals'] = $data['merchant'] = '';
        $merchant = $this->product_model->get_deal_by_url($dealURL);
        if(!empty($merchant)) {  
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = $merchant[0]['merchant_id'];
                $data['page_title'] = $merchant[0]['d_name']; 
                $data['merchant'] = $merchant;
			    $data['deals'] = $this->product_model->get_merchant_deal($merchant[0]['id']);
			$data['main_content'] = 'deals';
         } else { 
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'not-found';
                $data['page_title'] = 'Not Found'; 
			$data['main_content'] = 'not_found';
		 }		 

		    $data['category_list'] = $this->customer_model->get_category_list();
	        //$data['main_content'] = 'deals';
            $this->load->view('includes/front/front_template', $data); 

	}
}