<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_front extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('search_model');	
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'home';
                $data['page_title'] = '';

       $data['company_search'] = '';
       $data['agent_search'] = '';
       $data['agency_search'] = '';

       if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('agent_search')!='')
        {
          $name = $this->input->post('name');
          $waoic = $this->input->post('waoic');
          $insu_type = $this->input->post('insu_type');
          $npn = $this->input->post('npn');
          $dba = $this->input->post('dba');
          $city = $this->input->post('city'); 
          $data['agent_search'] = $this->search_model->get_agent_search_form($name,$waoic,$npn,$dba,$city,$insu_type); 
        } 
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('agency_search')!='')
        {
          $name = $this->input->post('name');
          $waoic = $this->input->post('waoic');
          $insu_type = $this->input->post('insu_type');
          $dba = $this->input->post('dba');
          $city = $this->input->post('city'); 
          $data['agency_search'] = $this->search_model->get_agency_search_form($name,$waoic,$insu_type,$dba,$city); 
        } 
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('company_search')!='')
        {
          $name = $this->input->post('name');
          $waoic = $this->input->post('waoic');
          $naic = $this->input->post('naic');
          $organiz_type = $this->input->post('organiz_type'); 
          $data['company_search'] = $this->search_model->get_company_search_form($name,$waoic,$naic,$organiz_type); 
        } 

	        $data['main_content'] = 'home_page';
            $this->load->view('includes/front/front_template', $data); 

	}

	public function agent()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'agent';
                $data['page_title'] = '';
                $id = $this->uri->segment(2);
                $data['agents'] = $this->search_model->get_record_by_id($id,'agent');

	        $data['main_content'] = 'agent';
                $this->load->view('includes/front/front_template', $data); 

	}
	public function agency()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'agency';
                $data['page_title'] = '';
                $id = $this->uri->segment(2);
                $data['agency'] = $this->search_model->get_record_by_id($id,'agency');

	        $data['main_content'] = 'agency';
                $this->load->view('includes/front/front_template', $data); 

	}
	public function company()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'company';
                $data['page_title'] = '';
                $id = $this->uri->segment(2);
                $data['companys'] = $this->search_model->get_record_by_id($id,'company');

	        $data['main_content'] = 'company';
                $this->load->view('includes/front/front_template', $data); 

	}
}
