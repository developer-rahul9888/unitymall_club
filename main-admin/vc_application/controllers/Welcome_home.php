<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->library('session');
        redirect('/admin/welcome');	
    }
	
	public function index()
	{
				if($this->session->userdata('is_logged_in')){
			redirect('admin/welcome');
        }else{
        	$this->load->view('admin/login');	
        }

	}
}
