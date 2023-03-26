<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

	

	 public function __construct()

    {

        parent::__construct();

        

        $this->load->library('session');

        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->load->model('customer_model');	



        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 

    }
 public function activity_log() {
    	
	$data['activity_log'] = $this->customer_model->activity_log();
	
	//load the view
      $data['main_content'] = 'admin/activity_log';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  public function activity_log_by_id() { 
    $url = $this->uri->segment(3);
	$data['activity_log'] = $this->customer_model->activity_log_by_id($url);
	

	//load the view
      $data['main_content'] = 'admin/activity_log';
      $this->load->view('includes/admin/template', $data);   
  }
	
  public function generatecsv(){

     

	$sdate = $edate = '';

	   if ($this->input->post('sdate') != '' && $this->input->post('edate') != '') {

			 $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

			 $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 

	  } else {

		  $sdate = date('Y-m-01 00:00:01');

		  $edate = date('Y-m-t 23:59:59'); 

	  }

	  

   $filename = 'users_'.date('YmdHis').'.csv'; 

 header("Content-Description: File Transfer"); 

 header("Content-Disposition: attachment; filename=$filename"); 

 header("Content-Type: application/csv; ");

 

 // file creation 

 $file = fopen('php://output', 'w');



 $header = array("S. No.User","Name","Customer ID","Sponsor ID","Direct Sponsor","Phone","City","State","DOJ","Activation Date","Royality","Repurchase","Status"); 

 fputcsv($file, $header);

	  $customer = $this->customer_model->get_customer_by_date($sdate,$edate);

  

	 if(!empty($customer)) { 

	  $i = 1;

	 foreach ($customer as $key=>$line){ 

	  if($line['user_level']>0) { $status = 'green'; } else { $status = 'red';  }

  if($line['direct']>=11) { $royality = 'yes'; } else { $royality = '--';  } 

  if($line['package_used']=='0') { $activate_date = ''; } else { $activate_date = date('d F Y',strtotime($line['package_used']));  }

  

  if($line['tid'] != '') { $repurchase = 'yes'; } else { $repurchase = '--'; }

	 

	 

	   $csv_val = array($i,$line['f_name'].' '.$line['l_name'].'',$line['customer_id'],$line['parent_customer_id'],$line['direct_customer_id'],$line['phone'],$line['city'],$line['state'],date('d F Y',strtotime($line['rdate'])),$activate_date,$royality,$repurchase,$status);

	   fputcsv($file,$csv_val); 

	   $i++;

	 }

	 fclose($file); 

	 exit; 

	 }

  

} 

  	

	

	public function company_turnover_distribution() {

		

		   $customer = $this->customer_model->get_all_club_achiver_date();	

	$data['customer'] = $customer;

	

	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('amount') !=''){

		

	$royalti1 = $royalti2 = $royalti3 = $royalti4 = 0 ;

		  foreach($customer as $vid){

    if($vid['royality']>='1'){$royalti1 = $royalti1+1 ; }

    if($vid['royality']>='2'){$royalti2 = $royalti2+1 ; }

    if($vid['royality']>='3'){$royalti3 = $royalti3+1 ; }

    if($vid['royality']>='4'){$royalti4 = $royalti4+1 ; }

}

			$turnover = $this->input->post('amount');

		if(!empty($customer)) {

				 $cror_amount1 = ($turnover*3)/(100*$royalti1);

				 $cror_amount2 = ($turnover*3)/(100*$royalti2);

				 $cror_amount3 = ($turnover*4)/(100*$royalti3);

				 $cror_amount4 = ($turnover*5)/(100*$royalti4);

				$income=array();

					foreach($customer as $cus) {

			if($cus['royality']>='1'){$income[]= array('user_id'=>$cus['id'],'amount'=>$cror_amount1*0.6,'type'=>'Travel'); }

			if($cus['royality']>='2'){$income[]= array('user_id'=>$cus['id'],'amount'=>$cror_amount2*0.6,'type'=>'Car'); }

			if($cus['royality']>='3'){$income[]= array('user_id'=>$cus['id'],'amount'=>$cror_amount3*0.6,'type'=>'House'); }

			if($cus['royality']>='4'){$income[]= array('user_id'=>$cus['id'],'amount'=>$cror_amount4*0.6,'type'=>'crown embaster royalti'); }

				

				

					}
					$this->customer_model->insert_batch('turnover_income',$income);
				}

			

			

			$this->session->set_flashdata('flash_message', 'updated');

			redirect('admin/company_turnover_distribution');

    	} 

	

//print_r($order_amount); die();


    	$closing = $this->customer_model->transaction_log();
    	if(!empty($closing)) {
    		$sdate = $closing[0]['c_date'];
    	} else {
    		$sdate = date('Y-m-d',strtotime('first day of previous month'));
    	}

	
    	
    	$edate = date('Y-m-d',strtotime('last day of this month'));
    	$monthly_business = $this->customer_model->get_monthly_business($sdate,$edate);	

    	//echo '<pre>'; print_r($monthly_business); die();

    	if(!empty($monthly_business)) {
    		$data['monthly_business'] = $monthly_business[0]['total_business']+0;
    	} else { $data['monthly_business'] = 0;  }
	//load the view

      $data['main_content'] = 'admin/company_turnover_distribution';

      $this->load->view('includes/admin/template', $data);   

  }

	

	public function field_expense_distribution() {

	  

	  if ($this->input->server('REQUEST_METHOD') === 'POST'){

    	    

		

			$income = array();

		

			

			$previous_date = date('Y-m-d 0000:00:00',strtotime('-30 days'));

			

			$insentive = $this->customer_model->get_payout_by_date_table('binary_income',$previous_date);

		

			if(!empty($insentive)) {

				foreach($insentive as $inc) {

					/*if($inc['amt'] < 10000) { $amt = 1000; }

					elseif($inc['amt'] < 25000) { $amt = 2000; }

					elseif($inc['amt'] < 50000) { $amt = 2500; }

					elseif($inc['amt'] < 102000) { $amt = 5000; }

					else { $amt = 10000; }*/

					if ($inc['amt'] >= 40000) {

						$income[] = array('user_id'=>$inc['cid'],'amount'=>(3/100)*$amt,'type'=>'Car Bonus');

					}

					if ($inc['amt'] >= 100000) {

						$income[] = array('user_id'=>$inc['cid'],'amount'=>(3/100)*$amt,'type'=>'House Bonus');

					}

					//$amt = (4/100)*$inc['amt'];

					$income[] = array('user_id'=>$inc['cid'],'amount'=>(4/100)*$inc['amt'],'type'=>'Field Expense');

				}

			}

			

		/*

			if($distribution == TRUE ) {

				      

					  

				      if(!empty($royality_income)) {

				        

				          foreach ($royality_income as $matching) {

				        $p_amount = $matching['matching_amt'];

				        $parent_id = $matching['cid']; 

						$dis_level = 1;

						$p = 0;

						$dis_amount = 0;

						while($p < 5) {

						$parent_user = $this->customer_model->parent_bliss($parent_id);

						if(!empty($parent_user)) { 

						if($parent_user[0]['package'] == '1') { $dis_amount = (3/100)*$p_amount; }

						elseif($parent_user[0]['package'] == '5') { $dis_amount = $p_amount/20; }

						elseif($parent_user[0]['package'] == '10') { $dis_amount = $p_amount/10; }

						else { $dis_amount = 0; }

						if($dis_amount > 0 && $parent_user[0]['pid'] != '') {

						

						

						$income[] = array('amount'=>$dis_amount,'user_id'=>$parent_user[0]['pid'],'type'=>'Royality');

						}

						  $parent_id = $parent_user[0]['pid'];

						  $dis_level = $dis_level + 1;

						  $p++;

						} else { $p = 50; }

					}

				              

				          }

				      }

				

					}

			 */	

			if(!empty($income)) {

			$this->customer_model->insert_batch('turnover_income',$income); }

			$this->session->set_flashdata('flash_message', 'updated');

			redirect('admin/field_expense_distribution');

    	} 

//	$data['customer'] = $this->customer_model->get_customer_by_date($sdate,$edate);

	

    	

	//$data['customer'] = $this->customer_model->get_all_customer();

	

	//load the view

      $data['main_content'] = 'admin/field_expense_distribution.php';

      $this->load->view('includes/admin/template', $data);   

  }

	

	public function index() {

	  

	  if ($this->input->server('REQUEST_METHOD') === 'POST'){

    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));

    	} else {

    	    $sdate = date('Y-m-1 00:00:01');

		     $edate = date('Y-m-t 23:59:59');

    	}

	$data['customer'] = $this->customer_model->get_customer_by_date($sdate,$edate);

	

    	

	//$data['customer'] = $this->customer_model->get_all_customer();

	

	//load the view

      $data['main_content'] = 'admin/customer_list';

      $this->load->view('includes/admin/template', $data);   

  }

  

   public function franchise_list() {

	  

	 

	$data['customer'] = $this->customer_model-> get_all_franchise();

	

    	

	//$data['customer'] = $this->customer_model->get_all_customer();

	

	//load the view

      $data['main_content'] = 'admin/franchise_list';

      $this->load->view('includes/admin/template', $data);   

  }

  

  

  



  	public function customer_all() {

	  

	 

	$data['customer'] = $this->customer_model->get_customer_all();

	

    	

	//$data['customer'] = $this->customer_model->get_all_customer();

	

	//load the view

      $data['main_content'] = 'admin/customer_list';

      $this->load->view('includes/admin/template', $data);   

  }

/*   public function add(){



	  $data['image_error'] = 'false';

	  

	  $cimage = '';

	  if ($this->input->server('REQUEST_METHOD') === 'POST')

        {

            //form validation

            $this->form_validation->set_rules('c_name', 'titlt', 'required|trim|min_length[4]');

			$this->form_validation->set_rules('c_discription', 'discription', 'required');

			

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation

            if ($this->form_validation->run())

            { 

				// file upload start here

			$config['upload_path'] ='images/customer/';

	        $config['allowed_types'] = 'gif|jpg|png|jpeg';

            //$config['max_width']  = '1600';

            //$config['max_height']  = '1600';

   		    $this->load->library('upload', $config);

		   if ($this->upload->do_upload('image'))

                    { 

                         $image_data = $this->upload->data();

					    $image = $image_data['file_name'];

					}

            else

                    {

                         $errors = $this->upload->display_errors();

						$image = '';

			        }

			        //----- end file upload -----------

			

				$data_to_store = array(

                    'c_name' => $this->input->post('c_name'),

					'c_description' => $this->input->post('c_discription'),

					'image' => $image,

				); 

                //if the insert has returned true then we show the flash message

				if($this->customer_model->store_customer($data_to_store) == TRUE){

                    $this->session->set_flashdata('flash_message', 'updated');

					redirect('admin/customer/add');

                }else{

                    $this->session->set_flashdata('flash_message', 'not_updated');

                }

				

                



            }//validation run



        }

       



        //if we are updating, and the data did not pass trough the validation

        //the code below wel reload the current data

 

        //load the view



        $data['main_content'] = 'admin/customer_addnew'; 

        $this->load->view('includes/admin/template', $data); 

	  

  }

  */ 

  

	public function wallet_request_list() {

	  

	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('submit') == 'Search'){

    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));

    	} else {

    	    $sdate = date('Y-m-1 00:00:01');

		     $edate = date('Y-m-t 23:59:59');

    	}

		$customer = $this->customer_model->get_pin_request_by_date($sdate,$edate);

		$data['customer'] = $customer;

		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('update_req') == 'Update') {

				$user_ids = $this->input->post('userid');

				if(empty($user_ids) ){

					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please select at least one user.</strong></div>';

				} else {

					

					//foreach($user_ids as $uid) {

					foreach($customer as $userinfo) {

					  if(in_array($userinfo['id'],$user_ids)) { 

					$request = $this->customer_model->get_all_pin_request_id($userinfo['id']);

					

					$data_to_store = array(

					'status' => $this->input->post('status')

					); 

             $return = $this->customer_model->update_pin_request($userinfo['id'], $data_to_store);

					

					if($this->input->post('status') == 'accepted'){ 

					

					$this->customer_model->substract_wallet_by_bliss($request[0]['customer_id'],$request[0]['amount'],'bliss_amount'); 

					}

					  }

					}

					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Payout Successfully.</strong></div>';

					//$payouts = $this->coupon_model->get_all_payout('Weekly Closing');

				}

			}

			

	$data['customer'] = $this->customer_model->get_pin_request_by_date($sdate,$edate);

	

	

	//load the view

      $data['main_content'] = 'admin/pin_request_list';

      $this->load->view('includes/admin/template', $data);   

  }

    

    public function pin_request_update(){

	  	

	 

	  //category id 

        $id = $this->uri->segment(4);

  

        /*if save button was clicked, get the data sent via post*/

        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))

        {

            /*form validation*/

             // $this->form_validation->set_rules('c_name', 'name', 'required|trim|min_length[4]');

			$this->form_validation->set_rules('comment', 'comment', 'required|trim');

			 $chkid = $this->customer_model->checkuserid($this->input->post('customer_id'));

			 

			 

			 

			   if(count($chkid)==0) {

              $this->form_validation->set_rules('hghff', 'User Id', 'required|trim');

              $this->form_validation->set_message('required', 'User Id not valid ');

               }

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation

            if ($this->form_validation->run())

            { 

			

			        //----- end file upload -----------

                $data_to_store = array(

                   

					'comment' => $this->input->post('comment'), 

					'reply' => $this->input->post('reply'), 

					

					'status' => $this->input->post('status'),

					); 

             $return = $this->customer_model->update_pin_request($id, $data_to_store);

			

			$phone = $this->input->post('phone');

			$status = $this->input->post('status');

			$reply = $this->input->post('reply');

			

             if($return == TRUE){

				 if($status != 'active') {

					if($status == 'rejected'){ $message = 'Rejected'; } elseif($status == 'accepted'){ 

					

					

					$message = 'Accepted';

					$this->customer_model->substract_wallet($chkid[0]['id'],$this->input->post('amount'),'bliss_amount'); 



					} else { $message = 'Activated'; }

						

						

							/***************** SMS ******************/

		$sms_msg = urlencode("Thank you for Requesting ! Your Request is ".$message.":

User ID: ".$this->input->post('customer_id')."

Tr. Pin: ".$this->input->post('tr_pin')."\n

".$reply."

Thank you 

Team Shiromani");

$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-shiromani&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=SHIROM&message=".$sms_msg;

//file_get_contents($smstext);

/***************** SMS ******************/

						

				 }

                    $this->session->set_flashdata('flash_message', 'updated');

					redirect('admin/pin_request/edit/'.$id.'');

                }else{

                    $this->session->set_flashdata('flash_message', 'not_updated');

                }

                



            }/*validation run*/



        }

       



        //if we are updating, and the data did not pass trough the validation

        //the code below wel reload the current data



       

        $data['category'] = $this->customer_model->get_all_pin_request_id($id);  

        //load the view

        $data['main_content'] = 'admin/pin_request_update'; 

        $this->load->view('includes/admin/template', $data); 

  }

  

	public function update(){

	  	

	 

	  //customer id 

        $id = $this->uri->segment(4);

  

        /*if save button was clicked, get the data sent via post*/

      if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid')){

            /*form validation*/

           $this->form_validation->set_rules('f_name', 'first name', 'required|trim|min_length[2]');

           $this->form_validation->set_rules('status', 'status', 'required|trim');

        //   $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');

        //   $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');

           $this->form_validation->set_rules('declare', 'terms & condition', 'required');

		   

		   $var_status = 'no';

		   

		    if(!empty($this->input->post('newpassword'))){$password=md5($this->input->post('newpassword'));}

		  else{$password=$this->input->post('oldpassword');}

		  

		  if(!empty($this->input->post('newtrpin'))){$trpin=md5($this->input->post('newtrpin'));}

		  else{$trpin=$this->input->post('oldtrpin');}

		   

		   /* $applied_pan = $this->input->post('applied_pan');

		    if($applied_pan!='yes') {

             //$this->form_validation->set_rules('pancard', 'pan card', 'required|trim|min_length[6]');

			}

			$applied_aadhar = $this->input->post('applied_aadhar');

		    if($applied_aadhar!='yes') {

             $this->form_validation->set_rules('aadhar', 'aadhar card', 'required|trim|min_length[6]');

			} */

			

			

			//$this->form_validation->set_rules('bank_name', 'bank name', 'required|trim');

           //$this->form_validation->set_rules('branch', 'branch', 'required|trim');

           //$this->form_validation->set_rules('account_name', 'account name', 'required');

           //$this->form_validation->set_rules('account_type', 'account type', 'required|trim');

           //$this->form_validation->set_rules('account_no', 'account no', 'required|trim');

           //$this->form_validation->set_rules('ifsc', 'ifsc', 'required'); 

			 

			

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

			

            //if the form has passed through the validation

            if ($this->form_validation->run())

            { 

		  // file upload start here

            	$image = '';

			$config['upload_path'] ='images/user/';

	        $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $config['max_width']  = '1024';

            $config['max_height']  = '1024';

   		    $this->load->library('upload', $config);

		   if ($this->upload->do_upload('image')) { 

                    if($this->input->post('image_old')!='') unlink('images/user/'.$this->input->post('image_old'));

                         $image_data = $this->upload->data();

					    $image = $image_data['file_name'];

						$var_status = $this->input->post('var_status');

					}

            else { $image = $this->input->post('image_old'); }

			

			 $panimage = '';

			$config['upload_path'] ='images/user/';

	        $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $config['max_width']  = '1024';

            $config['max_height']  = '1024';

   		    $this->load->library('upload', $config);

		   if ($this->upload->do_upload('panimage')) { 

                    if($this->input->post('panimage_old')!='') unlink('images/user/'.$this->input->post('panimage_old'));

                         $image_data = $this->upload->data();

					    $panimage = $image_data['file_name'];

					}

            else { $panimage = $this->input->post('panimage_old'); }

				  

			$aadharimage = '';

			$config['upload_path'] ='images/user/';

	        $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $config['max_width']  = '1024';

            $config['max_height']  = '1024';

   		    $this->load->library('upload', $config);

		   if ($this->upload->do_upload('aadharimage')) { 

                    if($this->input->post('aadharimage_old')!='') unlink('images/user/'.$this->input->post('aadharimage_old'));

                         $image_data = $this->upload->data();

					    $aadharimage = $image_data['file_name'];

					}

            else { $aadharimage = $this->input->post('aadharimage_old'); } 

			

                $data_to_store = array(

                    'f_name' => $this->input->post('f_name'),

                    'l_name' => $this->input->post('l_name'),

                    'email' => $this->input->post('email'),

                    'image' => $image,  

					'pass_word' => $password,

					'tr_pin' => $trpin,

                    'phone' => $this->input->post('phone'), 

                    'address' => $this->input->post('address'),

					'gender' => $this->input->post('gender'),

                    'city' => $this->input->post('city'),
					
                    'franchise' => $this->input->post('franchise'),


                    'state' => $this->input->post('state'), 

                    'pincode' => $this->input->post('pincode'),

					'nominee' => $this->input->post('nominee'),

                    'nominee_rel' => $this->input->post('nominee_rel'),

                    'nominee_dob' => $this->input->post('nominee_dob'),

                    'pancard' => $this->input->post('pancard'),  

                    'panimage' => $panimage, 

                    'aadhar' => $this->input->post('aadhar'),

                    'aadharimage' => $aadharimage, 

		            'bank_name' => $this->input->post('bank_name'),  

                    'branch' => $this->input->post('branch'), 

                    'account_name' => $this->input->post('account_name'),

                    'account_type' => $this->input->post('account_type'),  

                    'account_no' => $this->input->post('account_no'),

                    'bank_state' => $this->input->post('bank_state'), 

                    'ifsc' => $this->input->post('ifsc'),   

                    'status' => $this->input->post('status'),

                    'bliss_amount' => $this->input->post('add_amt')+$this->input->post('bliss_amount'),

                    'var_status' => $var_status 

				); 

				

				//print_r($data_to_store);

             $return = $this->customer_model->update_customer($id, $data_to_store);



             if($return == TRUE){

                    $this->session->set_flashdata('flash_message', 'updated');

					redirect(base_url().'admin/customer/edit/'.$id.'');

                }else{

                    $this->session->set_flashdata('flash_message', 'not_updated');

                }

                



            }/*validation run*/



        }



        //if we are updating, and the data did not pass trough the validation

        //the code below wel reload the current data



       

        $data['customer'] = $this->customer_model->get_all_customer_id($id); 

		$data['parentid'] = $this->customer_model->parent_profile($data['customer'][0]['parent_customer_id']);

        //load the view

        $data['main_content'] = 'admin/customer_update'; 

        $this->load->view('includes/admin/template', $data); 

  }

  

    public function wallet(){

	  	if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 

        /*if save button was clicked, get the data sent via post*/

      if ($this->input->server('REQUEST_METHOD') === 'POST'){

            /*form validation*/

			

			

			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');

			 

		     $chkid = $this->customer_model->checkuserid($this->input->post('bsacode'));

			 

			 

			 

			   if(count($chkid)==0) {

              $this->form_validation->set_rules('hghff', 'User Id', 'required|trim');

              $this->form_validation->set_message('required', 'User Id not valid ');

               }

			   

               

		   

		   

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

			

            //if the form has passed through the validation

            if ($this->form_validation->run()) { 

				$type = $this->input->post('type');

                $data_to_store = array(

                    $type => $chkid[0][$type]+$this->input->post('amount')

				); 

				

		$twallet_log = array(

		'user_id' => $chkid[0]['id'],

		'send_to' => $chkid[0]['id'],

		'send_by' => 'Admin',

		'type' => 'Transfered',

		'wallet_type' => 'Main Wallet',

		'amount' => $this->input->post('amount'),

		'status' => 'Credit' 

		);

		$this->customer_model->add_transactional_wallet($twallet_log);

				

				//$twallet_log = array('user_id'=>$chkid[0]['id'],'cr'=>$this->input->post('amount'),'how_to_pay'=>'Dream Gold','dis'=>'Wallet updated by admin','status'=>'Approved');

						//$this->customer_model->add_wallet_log($twallet_log);

				

				

				//print_r($data_to_store);

             $return = $this->customer_model->wallet_update_customer($this->input->post('bsacode'), $data_to_store);



             if($return == TRUE){

				

                    $this->session->set_flashdata('flash_message', 'updated');

					redirect(base_url().'admin/wallet/add');

                }else{

                    $this->session->set_flashdata('flash_message', 'not_updated');

                }

                



            }/*validation run*/



        }



        $data['main_content'] = 'admin/gvc_update'; 

        $this->load->view('includes/admin/template', $data); 

  }

  

	public function del(){

  

  $id = $this->uri->segment(4); 

		 $return = $this->customer_model->delete_customer($id); 

          $this->session->set_flashdata('delete', 'true'); 

	  redirect(base_url().'admin/customer');

 }  

  public function wallet_history() {

	  

	  if ($this->input->server('REQUEST_METHOD') === 'POST'){

    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));

    	} else {

    	    $sdate = date('Y-m-1 00:00:01');

		     $edate = date('Y-m-t 23:59:59');

    	}

	$data['transaction_wallet'] = $this->customer_model->transaction_wallet($sdate,$edate);

	

    	

	

	

	//load the view

      $data['main_content'] = 'admin/wallet_history';

      $this->load->view('includes/admin/template', $data);   

  }

 

 

 

	public function reward() {

	  $data['error_msg'] = '';

	  

	  

	  

		

		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('update_req') == 'Update') {

				

				if($this->input->post('sdate') != '') {

				$sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));

				} else {

					$sdate = date('Y-m-1 00:00:01');

		     $edate = date('Y-m-t 23:59:59');

				}

				

				$reward = $this->customer_model->get_reward_by_date();

				$user_ids = $this->input->post('userid');

				

				if(empty($user_ids) ){

					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please select at least one user.</strong></div>';

				} else {

					

					//foreach($user_ids as $uid) {

					foreach($reward as $userinfo) {

					  if(in_array($userinfo['id'],$user_ids)) { 

					 // die();

					

					

					$data_to_store = array(

					'status' => $this->input->post('status')

					); 

             $return = $this->customer_model->update_reward($userinfo['id'], $data_to_store);

					

					

					  }

					}

					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong> Successfully.</strong></div>';

					

				}

			} elseif ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('sdate') != ''){

    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));

    	} else {

			$sdate = date('Y-m-1 00:00:01');

		     $edate = date('Y-m-t 23:59:59');

		}

		

		

	$data['reward'] = $this->customer_model->get_reward_by_date($sdate,$edate);

		

	

    	

	//$data['customer'] = $this->customer_model->get_all_customer();

	

	//load the view

      $data['main_content'] = 'admin/reward';

      $this->load->view('includes/admin/template', $data);   

  }
  
   public function bonanza_list() {

	  

	 

	$data['bonanza'] = $this->customer_model->get_all_bonanza();

	
	//load the view

      $data['main_content'] = 'admin/bonanza_list';

      $this->load->view('includes/admin/template', $data);   

  }

  

  
  public function bonanza_update(){

	  	

	 

	  //customer id 

        $id = $this->uri->segment(4);

  

        /*if save button was clicked, get the data sent via post*/

      if ($this->input->server('REQUEST_METHOD') === 'POST'){

            /*form validation*/

           $this->form_validation->set_rules('lbv', 'lbv', 'required');

           $this->form_validation->set_rules('rbv', 'rbv', 'required');

        //   $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');

        //   $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');

          


            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

			

            //if the form has passed through the validation

            if ($this->form_validation->run())

            { 

		  

				  

			

                $data_to_store = array(

                    'lbv' => $this->input->post('lbv'),

                    'rbv' => $this->input->post('rbv'),

                    'reward' => $this->input->post('reward'),
                    'rank' => $this->input->post('rank'),
					'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
					'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
                    'status' => $this->input->post('status'), 

                 //   'date' => $this->input->post('date')

					

				); 

				

				//print_r($data_to_store);

             $return = $this->customer_model->update_bonanza($id, $data_to_store);



             if($return == TRUE){

                    $this->session->set_flashdata('flash_message', 'updated');

					redirect(base_url().'admin/bonanza/edit/'.$id.'');

                }else{

                    $this->session->set_flashdata('flash_message', 'not_updated');

                }

                



            }/*validation run*/



        }



        //if we are updating, and the data did not pass trough the validation

        //the code below wel reload the current data



       

        $data['bonanza_data'] = $this->customer_model->get_all_bonanza_id($id); 

		

        //load the view

        $data['main_content'] = 'admin/bonanza_update'; 

        $this->load->view('includes/admin/template', $data); 

  }

  
  
  
  
  
  
  
    public function bonanza_add(){


  

        /*if save button was clicked, get the data sent via post*/

      if ($this->input->server('REQUEST_METHOD') === 'POST'){

            /*form validation*/
           
           $this->form_validation->set_rules('lbv', 'lbv', 'required');

           $this->form_validation->set_rules('rbv', 'rbv', 'required');

        //   $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');

        //   $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');

          


            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

			

            //if the form has passed through the validation

            if ($this->form_validation->run())

            { 

		

                $data_to_store = array(

                    'lbv' => $this->input->post('lbv'),

                    'rbv' => $this->input->post('rbv'),

                    'reward' => $this->input->post('reward'),
                    'rank' => $this->input->post('rank'),
					'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
					'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
                    'status' => $this->input->post('status'), 

					

				); 

				

				//print_r($data_to_store);

            
            $return =  $this->customer_model->add_bonanza($data_to_store);
             if($return == TRUE){

                    $this->session->set_flashdata('flash_message', 'updated');

					redirect(current_url());

                }else{

                    $this->session->set_flashdata('flash_message', 'not_updated');

                }

                



            }/*validation run*/



        }



        //if we are updating, and the data did not pass trough the validation

        //the code below wel reload the current data



       

		

        //load the view

        $data['main_content'] = 'admin/bonanza_add'; 

        $this->load->view('includes/admin/template', $data); 

  }
  
  
  
  
  
  
  
  
  
  

}