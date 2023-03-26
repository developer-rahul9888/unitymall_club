<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order extends CI_Controller {
	
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
    if ($this->input->server('REQUEST_METHOD') === 'POST'){    	   
      $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));		  
           $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));   
      } else {    
              	  

          $sdate = date('Y-m-1 00:00:01');		 
              $edate = date('Y-m-t 23:59:59');    	}
    	
	$data['order'] = $this->order_model->get_all_order($sdate,$edate );
	
	//load the view
      $data['main_content'] = 'admin/order_list';
      $this->load->view('includes/admin/template', $data);   
  }

  public function voucher_import() {

    //if ($this->input->server('REQUEST_METHOD') === 'POST'){
      $header = $vouchers = [];
      if (($handle = fopen("assets/voucher.csv", "r")) !== FALSE) {
          while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
              if(empty($header)) {
                  $header = $row;
              } else {
                $vouchers[] = array_combine($header,$row);
              }
          }
          fclose($handle);
      }

      // if(!empty($vouchers)) {
      //   foreach($vouchers as $voucher) {
      //     $data_to_store = [
      //       'brand' => $voucher['Brand'],
      //       'about' => $voucher['About the brand'],
      //       'terms' => $voucher['Terms & Conditions'],
      //       'steps' => $voucher['Steps to avail'],
      //       'guid' => $voucher['Product GUID'],
      //       'value' => $voucher['Value'],
      //       'service_name' => $voucher['Product Service Name'],
      //       'code' => $voucher['Product Code'],
      //     ];
      //     $this->order_model->store_voucher_codes($data_to_store);
      //   }
      // }
      
      
      // $brands = array_values(array_unique(array_column($data,'Brand')));
       echo '<pre>'; print_r($vouchers); 
       die;
    //}
	  $data['order'] = $this->order_model->get_all_order($sdate,$edate );
	    //load the view
    $data['main_content'] = 'admin/order_list';
    $this->load->view('includes/admin/template', $data);   
  }
  
  public function purchased_voucher() {   
    if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit')!='submit'){        
      $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));     
           $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));   
      } else {    
          $sdate = date('Y-m-1 00:00:01');     
          $edate = date('Y-m-t 23:59:59');     

    }
      
    if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit')=='submit'){
          $ids = $this->input->post('checkbox');
          //print_r($ids); die();
          $this->order_model->update_store_voucher($ids,array('status'=>$this->input->post('status')));
          $this->session->set_flashdata('flash_message', 'updated');
      }


    $data['order'] = $this->order_model->get_all_store_voucher($sdate,$edate );
  
  //load the view
      $data['main_content'] = 'admin/store_voucher_list';
      $this->load->view('includes/admin/template', $data);   
  }

   public function order_distribute(){ 
    $id = $this->uri->segment(4);
	$data['blissid'] = $return = '';
	
	if ($this->input->server('REQUEST_METHOD') == 'POST')
        { 
            /*form validation*/
              $this->form_validation->set_rules('oid', 'order id', 'required|trim|numeric'); 
              $this->form_validation->set_rules('uid', 'user id', 'required|trim|numeric'); 
              $this->form_validation->set_rules('bid', 'bliss id', 'required|trim'); 
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  	 
		
		/**************** payment distribution *******************/				
		$distribution_amount = $this->input->post('damount');				
		$order_id = $this->input->post('oid');				
		$bliss_code =  $this->input->post('bid');		        
		$cust_id = $this->input->post('uid');  
		//echo $bliss_code. ' - '.$cust_id .' - ' .$this->input->post('how_to_pay');
        if($bliss_code != '' && $cust_id != '' && $this->input->post('how_to_pay')=='cod') { 
				$parent_bliss = $this->order_model->parent_bliss($cust_id);
				$distribute_level = 0;
				$distribute_user_id_array = $distribute_user_level_array = array();
				if(!empty($parent_bliss) && $parent_bliss[0]['parent_customer_id']!='' && $distribution_amount >= 10) {
				   $distribute_level = $distribute_level + 1;
				   $distribute_user_id_array[] = $parent_bliss[0]['pid']; 
				   $distribute_user_level_array[] = $parent_bliss[0]['p_user_level']; 
				   $parent_bliss_2 = $this->order_model->parent_bliss_result($parent_bliss[0]['parent_customer_id']);
				   $parent_customer_id = $parent_bliss[0]['parent_customer_id'];
				    $p = 0;
				   while($p < 1) {
					    $parent_bliss_2 = $this->order_model->parent_bliss_result($parent_customer_id);
						if(!empty($parent_bliss_2) && $parent_bliss_2[0]['parent_customer_id']!='' && $distribute_level < 15) {
							$distribute_level = $distribute_level + 1;
							$distribute_user_id_array[] = $parent_bliss_2[0]['pid']; 
							$distribute_user_level_array[] = $parent_bliss_2[0]['p_user_level']; 
							$parent_customer_id = $parent_bliss_2[0]['parent_customer_id'];
							$p = 0;
						} else { $p++; }
				   }
					//echo $distribute_level.' ';
					//echo '<pre>'; print_r($distribute_user_id_array); echo '</pre>';
					$dis_amount_12 = (12 / 100) * $distribution_amount;
					$dis_amount_2 = (2 / 100) * $distribution_amount;
					$dis_amount_1 = (1 / 100) * $distribution_amount;
					$dis_amount_75 = (0.75 / 100) * $distribution_amount;
					for($d=0;$d<$distribute_level;$d++){
						if($d == 0 && $distribute_user_level_array[$d] == '1') { $dis_level_amount = $dis_amount_12; }
						elseif($d <= 8) { $dis_level_amount = $dis_amount_2; }
						elseif($d <= 13) { $dis_level_amount = $dis_amount_1; }
						else { $dis_level_amount = $dis_amount_75; }
						$dis_level_amount = round($dis_level_amount,2);
						$d_level = $d + 1;
						$this->order_model->add_distribution_amount($dis_level_amount,$distribute_user_id_array[$d],$d_level,$order_id,$cust_id); 
					}
				}
				
				$this->order_model->update_distribution_status($order_id);
				$return = 'TRUE';
			  }
			  		
					  /**************** end payment distribution *******************/			  
            

             if($return == 'TRUE'){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/order/distribute/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                } 
            }/*validation run*/

        } 

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['order'] = $this->order_model->get_all_order_id($id); 
        $data['distribution'] = $this->order_model->get_order_distribution($id); 
        if(!empty($data['order'])) {
        $customerid = $this->order_model->get_customer_id($data['order'][0]['user_id']);
		if(!empty($customerid)) {
			$data['blissid'] = $customerid[0]['customer_id'];
		}
        }
        //load the view
        $data['main_content'] = 'admin/order_distribute'; 
        $this->load->view('includes/admin/template', $data); 
}

public function order_view(){ 
	 
    //order id 
      $id = $this->uri->segment(3);

      /*if save button was clicked, get the data sent via post*/
      if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
      {
          /*form validation*/
            $this->form_validation->set_rules('status', 'status', 'required|trim'); 
              $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
          //if the form has passed through the validation
          if ($this->form_validation->run())
          {  				  
              $data_to_store = array( 'status' => $this->input->post('status') ); 
  
             $return = $this->order_model->update_order($id, $data_to_store);

           if($return == TRUE){
                  $this->session->set_flashdata('flash_message', 'updated');
                  redirect('admin/order/'.$id.'');
              }else{
                  $this->session->set_flashdata('flash_message', 'not_updated');
              } 
          }/*validation run*/

      } 

      //if we are updating, and the data did not pass trough the validation
      //the code below wel reload the current data

      
      $data['order'] = $this->order_model->get_all_order_id($id); 
      $data['order_item'] = $this->order_model->get_all_order_item($id); 
      $data['distribution'] = $this->order_model->get_order_distribution($id); 
      //load the view
      $data['main_content'] = 'admin/order_view'; 
      $this->load->view('includes/admin/template', $data); 
}
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->order_model->delete_order($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/order');
 }  
}