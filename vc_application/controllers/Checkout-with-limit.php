<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->helper('form');
	$this->load->library('form_validation');
		$this->load->library('cart');
        $this->load->model('customer_model');	
        $this->load->model('checkout_model');	
		$cart = $this->cart->contents();
        if(empty($cart)) { redirect(base_url().'cart'); }
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'checkout';
                $data['page_title'] = 'Checkout';  
				
						        $cust_id = $this->session->userdata('cust_id');
 /* $cust_id = $this->session->userdata('cust_id');
$limit_amount = $this->get_user_limit($cust_id);
		print_r($limit_amount);*/
		/*
		$bliss_code =  $this->session->userdata('bliss_id');
		        $cust_id = $this->session->userdata('cust_id'); 
				$parent_bliss = $this->checkout_model->parent_bliss($cust_id);
				$distribute_level = 0;$distribution_amount = 555;
				$distribute_user_id_array = array();
				if(!empty($parent_bliss) && $parent_bliss[0]['parent_customer_id']!='' && $distribution_amount > 1) {
				   $distribute_level = $distribute_level + 1;
				   $distribute_user_id_array[] = $parent_bliss[0]['pid'];
					echo $distribute_level.' '.$parent_bliss[0]['pid'].' '.$parent_bliss[0]['parent_customer_id'].'<br>';
				   $parent_bliss_2 = $this->checkout_model->parent_bliss_result($parent_bliss[0]['parent_customer_id']);
				   if(!empty($parent_bliss_2) && $parent_bliss_2[0]['parent_customer_id']!='') {
					 $distribute_level = $distribute_level + 1;
				     $distribute_user_id_array[] = $parent_bliss_2[0]['pid'];
					 echo $distribute_level.' '.$parent_bliss_2[0]['pid'].' '.$parent_bliss_2[0]['parent_customer_id'].'<br>';
					 $parent_bliss_3 = $this->checkout_model->parent_bliss_result($parent_bliss_2[0]['parent_customer_id']);
				     if(!empty($parent_bliss_3) && $parent_bliss_3[0]['parent_customer_id']!='') {
				        $distribute_level = $distribute_level + 1;
				        $distribute_user_id_array[] = $parent_bliss_3[0]['pid'];
					    echo $distribute_level.' '.$parent_bliss_3[0]['pid'].' '.$parent_bliss_3[0]['parent_customer_id'].'<br>';
						$parent_bliss_4 = $this->checkout_model->parent_bliss_result($parent_bliss_3[0]['parent_customer_id']);
						if(!empty($parent_bliss_4) && $parent_bliss_4[0]['parent_customer_id']!='') {
				          $distribute_level = $distribute_level + 1;
						  $distribute_user_id_array[] = $parent_bliss_4[0]['pid'];
					      echo $distribute_level.' '.$parent_bliss_4[0]['pid'].' '.$parent_bliss_4[0]['parent_customer_id'].'<br>';
						  $parent_bliss_5 = $this->checkout_model->parent_bliss_result($parent_bliss_4[0]['parent_customer_id']);
						  if(!empty($parent_bliss_5) && $parent_bliss_5[0]['parent_customer_id']!='') {
				          $distribute_level = $distribute_level + 1;
						  $distribute_user_id_array[] = $parent_bliss_5[0]['pid'];
					      echo $distribute_level.' '.$parent_bliss_5[0]['pid'].' '.$parent_bliss_5[0]['parent_customer_id'].'<br>';
						  }
						 }
					   }
				   }
				}
				print_r($distribute_user_id_array);echo $distribute_level;*/
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('address', 'address', 'required|trim'); 
            $this->form_validation->set_rules('city', 'city', 'required|trim');
            $this->form_validation->set_rules('state', 'state', 'required|trim');
            $this->form_validation->set_rules('zip', 'zip', 'required|trim|numeric');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$this->session->set_userdata('p_name',$this->input->post('name'));
				$this->session->set_userdata('p_email',$this->input->post('email'));
				$this->session->set_userdata('p_phone',$this->input->post('phone'));
				$this->session->set_userdata('p_address',$this->input->post('address'));
				$this->session->set_userdata('p_address2',$this->input->post('address2'));
				$this->session->set_userdata('p_city',$this->input->post('city'));
				$this->session->set_userdata('p_state',$this->input->post('state'));
				$this->session->set_userdata('p_zip',$this->input->post('zip'));
				redirect(base_url().'payment');
			}
			
		}
		    $data['category_list'] = $this->customer_model->get_category_list();
		    $data['customer_add'] = $this->customer_model->get_customer_address($cust_id);
	        $data['main_content'] = 'checkout';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function payment()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'payment';
                $data['page_title'] = 'Payment';  
        
		$cust_id = $this->session->userdata('cust_id');
		if($cust_id=='') { redirect(base_url().'checkout'); }
		$ccavenue = 'false';
		 
				
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('p_name', 'name', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('p_email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('p_phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('p_address', 'address', 'required|trim'); 
            $this->form_validation->set_rules('p_city', 'city', 'required|trim');
            $this->form_validation->set_rules('p_state', 'state', 'required|trim');
            $this->form_validation->set_rules('p_zip', 'zip', 'required|trim|numeric');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  
				$cart = $this->cart->contents();
                $items = json_encode($cart);
				$coupon = $this->session->userdata('order_coupon');
				$coupon_val = $this->session->userdata('coupon_val');
				$distribution_amount = $this->session->userdata('comm_dis') + 0;
		        $data_to_store = array(
					'user_id' => $cust_id,
                     'p_name' => $this->input->post('p_name'),
					 'p_email' => $this->input->post('p_email'), 
					 'p_phone' => $this->input->post('p_phone'),
					 'p_address' => $this->input->post('p_address'),
					 'p_address2' => $this->input->post('p_address2'),
					 'p_city' => $this->input->post('p_city'),
					 'p_state' => $this->input->post('p_state'),
					 'p_zip' => $this->input->post('p_zip'),
					 'how_to_pay' => $this->input->post('how_to_pay'),
                     'shipping' => $this->session->userdata('order_shipping'),
                     'tax' => $this->session->userdata('order_tax'),
                     'total_amount' => $this->session->userdata('order_total'),
					 'comm_dis' => $distribution_amount,
					 'items' => $items,
					 'coupon_val' => $coupon_val,
					 'coupon' => $coupon
					 ); 
			  $order_id = $this->checkout_model->add_order($data_to_store);
				$ccavenue = 'true';
				/**************** payment distribution *******************/
				
				$bliss_code =  $this->session->userdata('bliss_id');
		        $cust_id = $this->session->userdata('cust_id');
              if($bliss_code != '' && $cust_id != '') { 
				$parent_bliss = $this->checkout_model->parent_bliss($cust_id);
				$distribute_level = 0;
				$distribute_user_id_array = array();
				if(!empty($parent_bliss) && $parent_bliss[0]['parent_customer_id']!='' && $distribution_amount > 1) {
				   $distribute_level = $distribute_level + 1;
				   $distribute_user_id_array[] = $parent_bliss[0]['pid'];
					//echo $distribute_level.' '.$parent_bliss[0]['id'].' '.$parent_bliss[0]['parent_customer_id'].'<br>';
				   $parent_bliss_2 = $this->checkout_model->parent_bliss_result($parent_bliss[0]['parent_customer_id']);
				   if(!empty($parent_bliss_2) && $parent_bliss_2[0]['parent_customer_id']!='') {
					 $distribute_level = $distribute_level + 1;
				     $distribute_user_id_array[] = $parent_bliss_2[0]['pid'];
					 //echo $distribute_level.' '.$parent_bliss_2[0]['id'].' '.$parent_bliss_2[0]['parent_customer_id'].'<br>';
					 $parent_bliss_3 = $this->checkout_model->parent_bliss_result($parent_bliss_2[0]['parent_customer_id']);
				     if(!empty($parent_bliss_3) && $parent_bliss_3[0]['parent_customer_id']!='') {
				        $distribute_level = $distribute_level + 1;
				        $distribute_user_id_array[] = $parent_bliss_3[0]['pid'];
					    //echo $distribute_level.' '.$parent_bliss_3[0]['id'].' '.$parent_bliss_3[0]['parent_customer_id'].'<br>';
						$parent_bliss_4 = $this->checkout_model->parent_bliss_result($parent_bliss_3[0]['parent_customer_id']);
						if(!empty($parent_bliss_4) && $parent_bliss_4[0]['parent_customer_id']!='') {
				          $distribute_level = $distribute_level + 1;
						  $distribute_user_id_array[] = $parent_bliss_4[0]['pid'];
					      //echo $distribute_level.' '.$parent_bliss_4[0]['id'].' '.$parent_bliss_4[0]['parent_customer_id'].'<br>';
						  $parent_bliss_5 = $this->checkout_model->parent_bliss_result($parent_bliss_4[0]['parent_customer_id']);
						  if(!empty($parent_bliss_5) && $parent_bliss_5[0]['parent_customer_id']!='') {
				          $distribute_level = $distribute_level + 1;
						  $distribute_user_id_array[] = $parent_bliss_5[0]['pid'];
					     // echo $distribute_level.' '.$parent_bliss_5[0]['id'].' '.$parent_bliss_5[0]['parent_customer_id'].'<br>';
						  }
						 }
					   }
				   }
				}
				
				if($distribute_level == 1) { 
				    $dis_level_0 = (67 / 100) * $distribution_amount;
					$dis_level_0 = round($dis_level_0,2);
					$this->checkout_model->add_distribution_amount($dis_level_0,$distribute_user_id_array[0],1,$order_id);
				}
				if($distribute_level == 2) { 
				    $dis_level_1 = (67 / 100) * $distribution_amount;
					$dis_level_1 = round($dis_level_1,2);
					$dis_level_2 = $distribution_amount - $dis_level_1;
					$this->checkout_model->add_distribution_amount($dis_level_1,$distribute_user_id_array[0],1,$order_id);
					
					$dis_level_ifelse_2 = $this->get_user_limit($distribute_user_id_array[1]);
					if(($dis_level_ifelse_2['amount'] + $dis_level_2) < $dis_level_ifelse_2['limit']) {
					   $this->checkout_model->add_distribution_amount($dis_level_2,$distribute_user_id_array[1],2,$order_id);
					}
					
				}
				if($distribute_level == 3) { 
				    $dis_level_1 = (67 / 100) * $distribution_amount;
					$dis_level_1 = round($dis_level_1,2);
				    $dis_level_2 = (16.5 / 100) * $distribution_amount;
					$dis_level_2 = round($dis_level_2,2);
					$dis_level_3 = $distribution_amount - ($dis_level_1 + $dis_level_2);
					$dis_level_3 = $dis_level_2; //round($dis_level_3,2);
					$this->checkout_model->add_distribution_amount($dis_level_1,$distribute_user_id_array[0],1,$order_id); 
					
					$dis_level_ifelse_2 = $this->get_user_limit($distribute_user_id_array[1]);
					if(($dis_level_ifelse_2['amount'] + $dis_level_2) < $dis_level_ifelse_2['limit']) {
					  $this->checkout_model->add_distribution_amount($dis_level_2,$distribute_user_id_array[1],2,$order_id); 
					}
					$dis_level_ifelse_3 = $this->get_user_limit($distribute_user_id_array[2]);
					if(($dis_level_ifelse_3['amount'] + $dis_level_3) < $dis_level_ifelse_3['limit']) {
					 $this->checkout_model->add_distribution_amount($dis_level_3,$distribute_user_id_array[2],3,$order_id); 
					}
				}
				if($distribute_level == 4) { 
				    $dis_level_1 = (67 / 100) * $distribution_amount;
					$dis_level_1 = round($dis_level_1,2);
				    $dis_level_2 = (16.5 / 100) * $distribution_amount;
					$dis_level_2 = round($dis_level_2,2);
				    $dis_level_3 = (8 / 100) * $distribution_amount;
					$dis_level_3 = round($dis_level_3,2);
					$dis_level_4 = $distribution_amount - ($dis_level_1 + $dis_level_2 + $dis_level_3);
					$dis_level_4 = $dis_level_3; //round($dis_level_4,2);
					$this->checkout_model->add_distribution_amount($dis_level_1,$distribute_user_id_array[0],1,$order_id);
					
					$dis_level_ifelse_2 = $this->get_user_limit($distribute_user_id_array[1]);
					if(($dis_level_ifelse_2['amount'] + $dis_level_2) < $dis_level_ifelse_2['limit']) {
					  $this->checkout_model->add_distribution_amount($dis_level_2,$distribute_user_id_array[1],2,$order_id); 
					}
					
					$dis_level_ifelse_3 = $this->get_user_limit($distribute_user_id_array[2]);
					if(($dis_level_ifelse_3['amount'] + $dis_level_3) < $dis_level_ifelse_3['limit']) {
					  $this->checkout_model->add_distribution_amount($dis_level_3,$distribute_user_id_array[2],3,$order_id);  
					}
					
					$dis_level_ifelse_4 = $this->get_user_limit($distribute_user_id_array[3]);
					if(($dis_level_ifelse_4['amount'] + $dis_level_4) < $dis_level_ifelse_4['limit']) {
					 $this->checkout_model->add_distribution_amount($dis_level_4,$distribute_user_id_array[3],4,$order_id);
					}
				}
				if($distribute_level == 5) { 
				    $dis_level_1 = (67 / 100) * $distribution_amount;
					$dis_level_1 = round($dis_level_1,2);
				    $dis_level_2 = (8 / 100) * $distribution_amount;
					$dis_level_2 = round($dis_level_2,2);
				    $dis_level_3 = (8 / 100) * $distribution_amount;
					$dis_level_3 = round($dis_level_3,2);
				    $dis_level_4 = (8 / 100) * $distribution_amount;
					$dis_level_4 = round($dis_level_4,2);
					$dis_level_5 = $distribution_amount - ($dis_level_1 + $dis_level_2 + $dis_level_3 + $dis_level_4);
					$dis_level_5 = $dis_level_4; //round($dis_level_5,2);
					$this->checkout_model->add_distribution_amount($dis_level_1,$distribute_user_id_array[0],1,$order_id);
					  
					$dis_level_ifelse_2 = $this->get_user_limit($distribute_user_id_array[1]);
					if(($dis_level_ifelse_2['amount'] + $dis_level_2) < $dis_level_ifelse_2['limit']) {
					  $this->checkout_model->add_distribution_amount($dis_level_2,$distribute_user_id_array[1],2,$order_id); 
					}
					
					$dis_level_ifelse_3 = $this->get_user_limit($distribute_user_id_array[2]);
					if(($dis_level_ifelse_3['amount'] + $dis_level_3) < $dis_level_ifelse_3['limit']) {
					  $this->checkout_model->add_distribution_amount($dis_level_3,$distribute_user_id_array[2],3,$order_id);  
					}
					
					$dis_level_ifelse_4 = $this->get_user_limit($distribute_user_id_array[3]);
					if(($dis_level_ifelse_4['amount'] + $dis_level_4) < $dis_level_ifelse_4['limit']) {
					 $this->checkout_model->add_distribution_amount($dis_level_4,$distribute_user_id_array[3],4,$order_id);
					}
					
					$dis_level_ifelse_5 = $this->get_user_limit($distribute_user_id_array[4]);
					if(($dis_level_ifelse_5['amount'] + $dis_level_5) < $dis_level_ifelse_5['limit']) {
					 $this->checkout_model->add_distribution_amount($dis_level_5,$distribute_user_id_array[4],5,$order_id);
					}
				}
				
			  }
			  /**************** end payment distribution *******************/
				
				if($ccavenue == 'false') { redirect(base_url().'thankyou'); }
			}
			
		}
		
		$data['category_list'] = $this->customer_model->get_category_list();
		
		if($ccavenue == 'true') {   
		 $production_url = 'tid='.date('Ymdhis').'&merchant_id=128103&order_id='.$order_id.'&amount='.$this->session->userdata('order_total').'&currency=INR&redirect_url='.base_url().'thankyou&cancel_url='.base_url().'thankyou&language=EN&billing_name='.$this->input->post('p_name').'&billing_address='.$this->input->post('p_address').'&billing_city='.$this->input->post('p_city').'&billing_state='.$this->input->post('p_state').'&billing_zip='.$this->input->post('p_zip').'&billing_country=India&billing_tel='.$this->input->post('p_phone').'&billing_email='.$this->input->post('p_email').'&delivery_name='.$this->input->post('p_name').'&delivery_address='.$this->input->post('p_address').'&delivery_city='.$this->input->post('p_city').'&delivery_state='.$this->input->post('p_state').'&delivery_zip='.$this->input->post('p_zip').'&delivery_country=India&delivery_tel='.$this->input->post('p_phone').'&merchant_param1=&promo_code=&customer_identifier=&integration_type=iframe_normal&';
		 
		$working_key = 'F534EEE73E7A9AC7ED35376A2AFDD378';//Shared by CCAVENUES
		$access_code='AVLD69EC82BU66DLUB';//Shared by CCAVENUES
		
		$encrypted_data = $this->encrypt($production_url,$working_key); // Method for encrypting the data.
		 
		$data['production_url'] = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
		
		$data['main_content'] = 'ccavenue'; 
		}
		else { $data['main_content'] = 'payment'; }
            $this->load->view('includes/front/front_template', $data); 

	}
	public function thankyou()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'thankyou';
                $data['page_title'] = 'Thank you';  
				
				$data['message'] = 'Thank you for shopping with us. We will be shipping your order to you soon.';
				
         if(isset($_POST['encResp']) && $_POST['encResp']!='') {
			 $working_key = 'F534EEE73E7A9AC7ED35376A2AFDD378';//Shared by CCAVENUES
			$encResponse = $_POST["encResp"];	//This is the response sent by the CCAvenue Server
			$rcvdString = $this->decrypt($encResponse,$working_key);//Crypto Decryption used as per the specified working key.
			$order_status = $order_id = "";
			$decryptValues = explode('&', $rcvdString);
			$dataSize = sizeof($decryptValues);
			for($i = 0; $i < $dataSize; $i++) {
				$information = explode('=',$decryptValues[$i]);
				if($i==0) {	$order_id = $information[1]; }
				if($i==3) {	$order_status=$information[1]; }
			}

			if($order_status==="Success") {
				$data['message'] = "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
				$this->checkout_model->update_distribution_status($order_id);
			}
			else if($order_status==="Aborted") {
				$data['message'] = "Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
			}
			else if($order_status==="Failure") {
				$data['message'] = "Thank you for shopping with us.However,the transaction has been declined.";
			}
			else {
				$data['message'] = "Security Error. Illegal access detected"; 
			} 
		 }
	
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'thankyou';
            $this->load->view('includes/front/front_template', $data); 
	}
	 

	public function get_user_limit($userid) {
		$bliss_code =  $this->session->userdata('bliss_id');
		$cust_id = $this->session->userdata('cust_id');
		$distributor_amount = $this->checkout_model->get_distributer_amount_by_userid($userid);
		$dist_amount = 0;
		if(!empty($distributor_amount)) {
			foreach($distributor_amount as $val) {
				if($val['status']!='Pending') { $dist_amount = $dist_amount + $val['amount']; }
			}
		}
		
		$orderId = '';
		$child_id_array = array();
		$ciruserlimit = 0;
		$child_ids = $this->checkout_model->get_child_id($bliss_code);
		foreach($child_ids as $childid) {
			$child_id_array[] = $childid['id']; 
		}
		if(!empty($child_id_array)){
        $circle_order = $this->checkout_model->my_first_circle_order($child_id_array);
		$cirorder = array(); 
		if(!empty($circle_order)) {
			foreach($circle_order as $cir_oder) {
			  if($cir_oder['status']!='Pending') {
				if(in_array($cir_oder['user_id'],$cirorder)){ $ciruserlimit = $ciruserlimit + 2000; } 
				else {	$cirorder[] = $cir_oder['user_id'];
				$ciruserlimit = $ciruserlimit + 4000; } 
				$orderId .= $cir_oder['id'].'('.$cir_oder['user_id'].') '; 
			  }
			}
		} 
		}
		
		return array('limit'=>$ciruserlimit,'amount'=>$dist_amount,'order'=>$orderId);
	}
	

	function hextobin($hexString) 
   	 { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) 
        	{       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 
        	    if ($count==0) { $binString = $packedString; } 
        	    else { $binString .= $packedString; }  
		    $count+=2; 
        	} 
  	        return $binString; 
    	  } 
	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}
	function decrypt($encryptedText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=$this->hextobin($encryptedText);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
	 	mcrypt_generic_deinit($openMode);
		return $decryptedText;
		
	}
	function encrypt($plainText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = $this->pkcs5_pad($plainText, $blockSize);
	  	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
		      $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	      mcrypt_generic_deinit($openMode);
		      			
		} 
		return bin2hex($encryptedText);
	}
}