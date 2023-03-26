<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Webstores extends CI_Controller {
	
    private $data, $key, $cipher, $mode, $IV;

	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('webstores_model');		 
		$this->load->model('product_model');
        $this->load->helper('string');		

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 

        $this->key = '6d66fb7debfd15bf716bb14752b9603b';
        $this->cipher =OPENSSL_RAW_DATA;
        $this->mode = 'aes-256-cbc';
        $this->IV = '716bb14752b9603b';
    }
	
  public function voucher_codes() {
    	
	    $data['voucher_codes'] = $this->webstores_model->get_all_voucher_codes();
	
	    //load the view
        $data['main_content'] = 'admin/voucher_code_list';
        $this->load->view('includes/admin/template', $data);   
  }

  public function voucher_brands() {
    	
    $data['brands'] = $this->voucherApiCall('getbrands');
    //echo '<pre>'; print_r($data['brands']); die;
    //load the view
    $data['main_content'] = 'admin/voucher_brand_list';
    $this->load->view('includes/admin/template', $data);   
}

  public function voucher_history() {
    	
    $data['voucher_history'] = $this->webstores_model->get_all_voucher_history();

    //load the view
    $data['main_content'] = 'admin/voucher_history';
    $this->load->view('includes/admin/template', $data);   
}



    public function getToken(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://send.bulkgv.net/API/v1/gettoken',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'username: ZVBPNPCHVMBUAQTZYOWPLTXVWXWYERDS',
            'password: ]soLj$si!x6IL![KP~rkQ^sXG^hT3yJS',
            'Authorization: Basic WlZCUE5QQ0hWTUJVQVFUWllPV1BMVFhWV1hXWUVSRFM6XXNvTGokc2kheDZJTCFbS1B+cmtRXnNYR15oVDN5SlM='
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;

        $response = json_decode($response,true);
        return $response;
    }

public function encrypt()
{
    return trim(
        base64_encode(openssl_encrypt($this->data, $this->mode,$this->key, $this->cipher, $this->IV)));
}

public function decrypt()
{
    return trim(
        openssl_decrypt(base64_decode($this->data),$this->mode, $this->key,$this->cipher,  $this->IV));
}
public function voucherApiCall($path,$payload=[]){

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://send.bulkgv.net/API/v1/gettoken',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'username: ZVBPNPCHVMBUAQTZYOWPLTXVWXWYERDS',
        'password: ]soLj$si!x6IL![KP~rkQ^sXG^hT3yJS',
        'Authorization: Basic WlZCUE5QQ0hWTUJVQVFUWllPV1BMVFhWV1hXWUVSRFM6XXNvTGokc2kheDZJTCFbS1B+cmtRXnNYR15oVDN5SlM='
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;

    $response = json_decode($response,true);

    $this->data = $response['data'];

    $decrypted = str_replace('"','',$this->decrypt());

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://send.bulkgv.net/API/v1/'.$path,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
        'token: '.$decrypted,
        'Content-Type: application/json'
    ),
    ));
    if(!empty($payload)) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
    }
    $response = curl_exec($curl);

    curl_close($curl);

    $data_to_store = array(
        'data' => $response,
        'type' => 'Voucher'
    );	
    $this->webstores_model->store_response($data_to_store);
    //echo $response;
    $response = json_decode($response,true);

    $this->data = $response['data'];

    $decrypted = $this->decrypt();

    $data_to_store = array(
        'data' => $decrypted,
        'type' => 'Voucher'
    );	
    $this->webstores_model->store_response($data_to_store);

    $response = json_decode($decrypted,true);
    return $response;
}



  public function voucher_codes_generate() {

    $payload = [
        "BrandProductCode" => "Cromal06iVDqb5Yv79W20",
        "ExternalOrderId" => "testorder-1",
        "Quantity" => 1,
        "Denomination" => 100,
    ];
    $this->data = json_encode($payload);
    $encrypted = $this->encrypt();
    $payload = [
        "payload" => $encrypted
    ];
    //echo '<pre>'; print_r($payload); die();
    //$data = $this->voucherApiCall('getbrands',$payload);
    $result = $this->voucherApiCall('pullvoucher',$payload);

    if(!empty($result)) {
        if($result['ResultType']=='SUCCESS') {
            $vouchers = $result['PullVouchers'][0]['Vouchers'];
            if(!empty($vouchers)) {
                foreach ($vouchers as $value) {
                    $voucher_store = array(
                       // 'user_id' => $data['voucher_order'][0]['user_id'],
                       // 'voucher_id' => $data['voucher_order'][0]['id'],
                        'status' => 'accepted',
                        'EndDate' => $value['EndDate'],
                        'Value' => $value['Value'],
                        'VoucherGCcode' => $value['VoucherGCcode'],
                        'VoucherGuid' => $value['VoucherGuid'],
                        'VoucherNo' => $value['VoucherNo'],
                        'Voucherpin' => $value['Voucherpin'],
                        'response' => json_encode($result)
                    );
                    $this->webstores_model->store_voucher_history($voucher_store);
                }
            }
            $this->session->set_flashdata('flash_message', 'updated');
        } else {
            $this->session->set_flashdata('flash_message', 'not_updated');
        }
    }


    echo '<pre>'; print_r($result); die;
    $id = $this->uri->segment(3);
    $data['voucher_code'] = $this->webstores_model->get_all_voucher_code_by_id($id);

    if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('quantity', 'quantity', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
                $quantity = $this->input->post('quantity');
                $response = $this->api_call("https://catalog.vouchagram.net/EPService.svc/PullVoucher?Password=7757FE887C5&BuyerGuid=3627544B-ED62-4483-A6EE-8C7BBA987308&ProductGuid=".$data['voucher_code'][0]['guid']."&ExternalOrderID=".$id."&Quantity=".$quantity,"GET");
                $data_to_store = array(
                    'data' => $response,
                    'type' => 'Voucher'
                );	
                $this->webstores_model->store_response($data_to_store);
                $result = json_decode($response,true);
						//echo '<pre>'; print_r($result); die;
						if(!empty($result)) {
							if($result['vPullVouchersResult']['ResultType']=='SUCCESS') {
								$vouchers = $result['vPullVouchersResult']['PullVouchers'][0]['Vouchers'];
								if(!empty($vouchers)) {
									foreach ($vouchers as $value) {
										$voucher_store = array(
											'user_id' => $data['voucher_order'][0]['user_id'],
											'voucher_id' => $data['voucher_order'][0]['id'],
						                    'status' => 'accepted',
						                    'EndDate' => $value['EndDate'],
						                    'Value' => $value['Value'],
						                    'VoucherGCcode' => $value['VoucherGCcode'],
						                    'VoucherGuid' => $value['VoucherGuid'],
						                    'VoucherNo' => $value['VoucherNo'],
						                    'Voucherpin' => $value['Voucherpin'],
						                    'response' => $response
										);
										$this->webstores_model->store_voucher_history($voucher_store);
									}
								}
                                $this->session->set_flashdata('flash_message', 'updated');
							} else {
                                $this->session->set_flashdata('flash_message', 'not_updated');
							}
						}
                redirect(current_url());
				
            }//validation run

        }

    //load the view
    $data['main_content'] = 'admin/voucher_code_generate';
    $this->load->view('includes/admin/template', $data);   
}
public function voucher_brand_generate() {
    $id = $this->uri->segment(3);
    $data['brand'] = $this->voucherApiCall('getbrands',["BrandProductCode"=>$id]);

    if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('quantity', 'quantity', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
                $history = $this->webstores_model->get_last_voucher_history();
                if($history) { $count = $history->id + 1; } 
                else { $count = 1; }
                
                $quantity = $this->input->post('quantity');
                $domination = $this->input->post('domination');
                $ExternalOrderId = "unitymall-".$count;
                $payload = [
                    "BrandProductCode" => $id,
                    "ExternalOrderId" => $ExternalOrderId,
                    "Quantity" => $quantity,
                    "Denomination" => $domination,
                ];
                $this->data = json_encode($payload);
                $encrypted = $this->encrypt();
                $payload = [
                    "payload" => $encrypted
                ];

                $result = $this->voucherApiCall('pullvoucher',$payload);
            
                if(!empty($result)) {
                    //echo '<pre>'; print_r($result); die;
                    if($result['ResultType']=='SUCCESS') {
                        $vouchers = $result['PullVouchers'][0]['Vouchers'];
                        if(!empty($vouchers)) {
                            foreach ($vouchers as $value) {
                                $voucher_store = array(
                                   // 'user_id' => $data['brand'][0]['user_id'],
                                    'BrandProductCode' => $data['brand'][0]['BrandProductCode'],
                                    'ExternalOrderId' => $ExternalOrderId,
                                    'BrandName' => $data['brand'][0]['BrandName'],
                                    'status' => 'accepted',
                                    'EndDate' => $value['EndDate'],
                                    'Value' => $value['Value'],
                                    'VoucherGCcode' => $value['VoucherGCcode'],
                                    'VoucherGuid' => $value['VoucherGuid'],
                                    'VoucherNo' => $value['VoucherNo'],
                                    'Voucherpin' => $value['Voucherpin'],
                                    'response' => json_encode($result)
                                );
                                $this->webstores_model->store_voucher_history($voucher_store);
                            }
                        }
                        $this->session->set_flashdata('flash_message', 'updated');
                    } else {
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

                redirect(current_url());
				
            }//validation run

        }

    //load the view
    $data['main_content'] = 'admin/voucher_brand_generate';
    $this->load->view('includes/admin/template', $data);   
}
  public function index() {
    	
	    $data['webstores'] = $this->webstores_model->get_all_webstores();
	
	    //load the view
        $data['main_content'] = 'admin/webstores_list';
        $this->load->view('includes/admin/template', $data);   
  }

  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('web_name', 'titlt', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('web_dis', 'discription', 'required');
			$this->form_validation->set_rules('web_url', 'url', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='images/webstores/';
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
          'web_name' => $this->input->post('web_name'),
					'web_dis' => $this->input->post('web_dis'),
					'web_img' => $image,					'web_s_dis' => $this->input->post('web_s_dis'),					'category' => $this->input->post('category'),
					'web_url' => $this->input->post('web_url')
				
				); 
                //if the insert has returned true then we show the flash message
				if($this->webstores_model->store_webstores($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/webstores/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
 $data['category'] = $this->product_model->get_all_category();
        $data['main_content'] = 'admin/webstores_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //webstores id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
             $this->form_validation->set_rules('web_name', 'titlt', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('web_dis', 'discription', 'required');
			$this->form_validation->set_rules('web_url', 'url', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  // file upload start here
            	$image = 'noimg.jpg';
			$config['upload_path'] ='images/webstores/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                    if($this->input->post('avtar_exist')!='') unlink('images/webstores/'.$this->input->post('avtar_exist'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else {
                         $errors = $this->upload->display_errors();
						$image = $this->input->post('avtar_exist');
			        }
			        //----- end file upload -----------
                $data_to_store = array(
				    'web_name' => $this->input->post('web_name'),
					'web_dis' => $this->input->post('web_dis'),
					'web_img' => $image,
					'web_url' => $this->input->post('web_url'),					
					'web_s_dis' => $this->input->post('web_s_dis'),
					'web_status' => $this->input->post('status'),					
					'category' => $this->input->post('category')
					); 
             $return = $this->webstores_model->update_webstores($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/webstores/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       $data['category'] = $this->product_model->get_all_category();
        $data['webstores'] = $this->webstores_model->get_all_webstores_id($id); 
        //load the view
        $data['main_content'] = 'admin/webstores_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->webstores_model->delete_webstores($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/webstores');
 }  

 public function api_call($url,$type,$data=array()) {
    $curl = curl_init();
   curl_setopt_array($curl, array(
   CURLOPT_URL => $url,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => $type
   ));
   if($type=='POST' && !empty($data)) {
       curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
   }
   
   $response = curl_exec($curl);
   curl_close($curl);
   
   return $response;
}

    
}