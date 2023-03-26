<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('order_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	 
 if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('sdate') != '')
        {
        $sdate = $this->input->post('sdate').' 00:00:00';
        $ldate = $this->input->post('ldate').' 23:59:59';
        $data['order'] = $this->order_model->get_search_form_order($sdate,$ldate);
      }  elseif ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('filter') != '')
        {
         $filter = $this->input->post('filter');
        $date = explode(',',$filter);
        $data['order'] = $this->order_model->get_search_form_order($date[0],$date[1]);

      } elseif ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('next_prev') != '')
        {
         $next_prev = $this->input->post('next_prev');
        $date = explode(',',$next_prev);
        $data['order'] = $this->order_model->get_search_form_order($date[0],$date[1]);
} else {
        
        $sdate = date('Y-m').'-01 00:00:00';
        $ldate = date('Y-m-t').' 23:59:59';
	$data['order'] = $this->order_model->get_search_form_order($sdate,$ldate);
      }
	$data['all_members'] = $this->order_model->get_all_member();
	//load the view
      $data['main_content'] = 'admin/search';
      $this->load->view('includes/admin/template', $data);   
  }
  
 public function setting() {
    	 
 if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('maintenance') != '')
        {
        $maintenance = $this->input->post('maintenance');
        $datas = array('maintenance'=>$maintenance);
        $this->order_model->update_setting('1',$datas);
      }  
     
      
	$data['all_setting'] = $this->order_model->get_all_setting();
	//load the view
      $data['main_content'] = 'admin/setting';
      $this->load->view('includes/admin/template', $data);   
  }
}
?>