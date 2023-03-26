<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller {
	 
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
         $this->load->model('Users_model');

       if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
       
    }
	
  public function index() {
		 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'prodcut_purchse_date';
                $data['page_title'] = 'Products Purchased Date'; 
				
    
		$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
		 $data['pins'] = array();
		 
		if($data['profile'][0]['user_level'] > 0) {
		    $data['pins'] = $this->Users_model->get_my_pin($customer_id); 
		}

		
		
		if ($this->input->server('REQUEST_METHOD') && $this->input->post('redeem_bliss')!='') {
            /*form validation*/
			
			$profile = $this->Users_model->profile($id);
			
           $this->form_validation->set_rules('balance', 'balance', 'required|trim');
           $this->form_validation->set_rules('redeem', 'redeem', 'required|trim');
           

           if($data['profile'][0]['bliss_amount'] < $this->input->post('redeem')) {
              $this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
              $this->form_validation->set_message('required', 'Your redeem maximum Amount is '.$data['profile'][0]['bliss_amount']);
           }
		   
		   

			$data['redeem_error'] = 'show';
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {    
                $data_to_store = array(
                    'balance' => $this->input->post('balance'),
                    'redeem' => $this->input->post('redeem'),
                    'after_tds' => $this->input->post('final_redeem'),
					'my_bliss_req' => 'amount',
                    'user_id' => $id
				); 
             $return = $this->Users_model->redeem_bliss_request($data_to_store);

                if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'redeem');
		    redirect(base_url().'admin');
                } else {
                    $this->session->set_flashdata('flash_message', 'redeem_error');
                } 
            }  

        }

		$data['main_content'] = 'admin/prodcut_purchse_date';
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function prodcut_dispached_date() {
      $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'prodcut_dispached_date';
                $data['page_title'] = 'Products Dispached Date'; 
				
    
		$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
		 $data['prodcuts'] = array();
		  
		    $data['prodcuts'] = $this->Users_model->get_prodcut_details($customer_id); 

 
		$data['main_content'] = 'admin/prodcut_dispached_date';
        $this->load->view('includes/admin/template', $data); 
      
  }
  
  public function prodcut_delivered_date() {
      
      $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'prodcut_delivered_date';
                $data['page_title'] = 'Products Delivered Date'; 
				
    
		$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
		 $data['prodcuts'] = array();
		  
		  if ($this->input->server('REQUEST_METHOD') === 'POST' && ''!=$this->input->post('psid'))
        {
            $psid = $this->input->post('psid');
            $date = date('Y-m-d H:i:s');
            $update_date = array('deliverd_date'=>$date,'status'=>'Delivered');
            $this->Users_model->update_delivery_date($psid,$update_date); 
        }
		    $data['prodcuts'] = $this->Users_model->get_prodcut_details($customer_id); 

 
		$data['main_content'] = 'admin/prodcut_delivered_date';
        $this->load->view('includes/admin/template', $data); 
  }
}