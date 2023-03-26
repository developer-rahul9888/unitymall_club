<?php 
class User extends CI_Controller {
private $left_user = array();
private $right_user = array();
private $last_user_id = '';
private $user_position = '';
    public function __construct()
    {
        parent::__construct();
       	$this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Kolkata');
    }

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
		if($this->session->userdata('is_customer_logged_in')){
			redirect(base_url().'admin/welcome');
        }else{
        	$this->load->view('admin/login');	
        }
	}
	
		function super_admin_login() {	 
		$this->load->model('Users_model');
//print_r($_POST);
		$user_name = $this->input->post('bcono');
		$auth = $this->input->post('auth');
       $pass = md5('@#96pp~~'.date('YmdH').md5('Awr@sw@Y'));
		//echo ' '.$auth;
		/*if($auth != $pass) { 
			echo '<div style="color:#ff0000;font-weight:bold;">Your auth key has been expired. Please try again.</div>';
			return; 
		}*/
		 
		$is_valid = $this->Users_model->super_admin_validate($user_name);
		
		if($is_valid['login']=='true')
		{
			$data = array('full_name'=>$is_valid['full_name'], 'email'=>$is_valid['email'], 'bliss_id'=>$is_valid['bliss_id'],  'cust_id'=>$is_valid['cust_id'], 'cust_img'=>$is_valid['cust_img'], 'is_customer_logged_in' => true);
            $this->session->set_userdata($data);
			  //echo ';;;kkkk';
			redirect(base_url().'admin');
		}
		else // incorrect username or password
		{
			echo '<div style="color:#ff0000;font-weight:bold;">User not exist please check your BCO No.</div>';	
		}
		
	}	
	
	
	function get_bliss_code_by_phone(){
		$this->load->model('Users_model');
		$phone = $this->input->post('phone');
		if($phone=='') {
			echo 'Please enter proper Sponser ID.';
		} else {
	   $customerid = $this->Users_model->get_bliss_code_by_phone($phone);
	   if(empty($customerid)) { echo 'No record found.'; }
	   else {  
	     foreach($customerid as $val){
		    echo $val['f_name'].' '.$val['l_name'] ;	 
		 }
	   }
	 }   
	}  
  
	function profile()
	{
		$this->load->model('Users_model');
		 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'profile';
                $data['page_title'] = 'Profile';  
 
		if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
			redirect(base_url().'admin');
         
	}
    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{	

		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Users_model->validate($user_name, $password);
		$setting = $this->Users_model->get_setting();
		if($setting[0]['maintenance']=='Yes'){
		    echo '<div class="alert alert-danger">Right now site is under maintenance please try after some time.</div>';
		}
		elseif($is_valid['login']=='true' && $is_valid['status']=='deactive')
		{ 
			echo '<div class="alert alert-danger">Your account suspended please contact to administrator.</div>';	
			//$this->load->view('admin/login', $data);	
                }
		elseif($is_valid['login']=='true')
		{
			$data = array('full_name'=>$is_valid['full_name'], 'email'=>$is_valid['email'], 'bliss_id'=>$is_valid['bliss_id'],  'cust_id'=>$is_valid['cust_id'], 'cust_img'=>$is_valid['cust_img'], 'is_customer_logged_in' => true);
                        $this->session->set_userdata($data);
			echo '<div class="alert alert-success"></div>';
			//redirect(base_url().'admin');
		}
		else // incorrect username or password
		{
			echo '<div class="alert alert-danger">Username or password is wrong.</div>';	
		}
		
	}	

	 function admin_welcome(){ 
        if(!$this->session->userdata('is_customer_logged_in')){ redirect(base_url().'admin');  }
		$data['main_content'] = 'profile'; 
        $this->load->view('includes/admin/template', $data); 
	 }
    /**
    * The method just loads the signup view
    * @return void
    */
	function signup(){
		
		$this->load->model('Users_model');
		$id = $this->session->userdata('cust_id');
		$customer_id = $this->session->userdata('bliss_id');
		$data = array();
		if($this->input->post('email')){
		$this->load->library('form_validation');
		// field name, error message, validation rules
		$this->form_validation->set_rules('f_name', 'first name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('aadhar', 'aadhar', 'required|is_unique[customer.aadhar]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('cpassword', 'confirm password', 'trim|required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric|min_length[10]|max_length[10]');
			
		$setting = $this->Users_model->get_setting();
		if($setting[0]['maintenance']=='Yes'){
		    $this->form_validation->set_rules('maintenance', 'maintenance', 'required');
		    $this->form_validation->set_message('required', 'Right now site is under maintenance please try after some time'); 
		}
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('register',$data);
		}
		
		else
		{	
	
		 	$query = $this->Users_model->create_member();
			if($query == 'false bliss_code')
			{  
				$this->session->set_flashdata('register', 'bliss_code'); 
				//$this->load->view('register',$data);			
			}
			elseif($query == 'false place_code')
			{  
				$this->session->set_flashdata('register', 'place_code'); 
				//$this->load->view('register');			
			}
			elseif($query == 'false al_phone')
			{  
				$this->session->set_flashdata('register', 'al_phone'); 
				//$this->load->view('register');			
			}
			elseif($query == 'false addhar')
			{  
				$this->session->set_flashdata('register', 'addhar'); 
				//$this->load->view('register');			
			}
			elseif($query == 'false rtl_code')
			{  
				$this->session->set_flashdata('register', 'rtl_code'); 
				//$this->load->view('register',$data);			
			}
			elseif($query != 'false' && $query != '')
			{

				if($this->input->post('bliss_code') !='' && $this->input->post('place_code') =='') {
					//start the transaction
        			$this->db->trans_begin();
				 	$bliss_code = $this->input->post('bliss_code');
				 	$place_code = $this->input->post('place_code');
				 	$position = $this->input->post('position');
				  $direct_users = $this->Users_model->user_child_info($bliss_code); 
					if(empty($direct_users)){
					    $final_user_customer_id = $bliss_code;
					} elseif(count($direct_users)==1 && (($direct_users[0]['position']=='left' && $position=='right') || ($direct_users[0]['position']=='right' && $position=='left'))) {
					    $final_user_customer_id = $bliss_code;
					} else {
					    $this->goDownALevel($bliss_code,$position);
					    $final_user_customer_id = $this->last_user_id;
					    //$position = $this->user_position;
					}
					if($final_user_customer_id!='') {
						$data_to_store = array('parent_customer_id'=>$final_user_customer_id,'position'=>$position,'direct_customer_id'=>$bliss_code,'status'=>'active');
						$this->Users_model->update_profile_by_customer_id($query, $data_to_store);
						
					}
					
						
				}
				elseif($this->input->post('bliss_code') !='' && $this->input->post('place_code') !='') {
					$bliss_code = $this->input->post('bliss_code');
				 	$place_code = $this->input->post('place_code');
				 	$position = $this->input->post('position');
				  	$direct_users = $this->Users_model->user_child_info($place_code); 
					if(empty($direct_users)){
					    $final_user_customer_id = $place_code;
					} elseif(count($direct_users)==1 && (($direct_users[0]['position']=='left' && $position=='right') || ($direct_users[0]['position']=='right' && $position=='left'))) {
					    $final_user_customer_id = $place_code;
					} else {
					    $this->goDownALevel($place_code,$position);
					    $final_user_customer_id = $this->last_user_id;
					    //$position = $this->user_position;
					}
					if($final_user_customer_id!='') {
						$data_to_store = array('parent_customer_id'=>$final_user_customer_id,'position'=>$position,'direct_customer_id'=>$bliss_code,'status'=>'active');
						$this->Users_model->update_profile_by_customer_id($query, $data_to_store);
						
					}
				}

				$p = 0;
					$parent_customer_id = $final_user_customer_id;
					while($p < 1) {  
						$parent_user = $this->Users_model->profile_by_customer_id($parent_customer_id); 
						if(!empty($parent_user)) {
							
						
						if($position == 'left') { 
							 $count_bv[] = array('id'=>$parent_user[0]['id'],'left_count'=>$parent_user[0]['left_count']+1,'right_count'=>$parent_user[0]['right_count']);
						  }
						 else {
							 $count_bv[] = array('id'=>$parent_user[0]['id'],'left_count'=>$parent_user[0]['left_count'],'right_count'=>$parent_user[0]['right_count']+1); 
						 }
						  $parent_customer_id = $parent_user[0]['parent_customer_id'];
						  $position = $parent_user[0]['position'];
						} else { $p++; }
						
					}
					if(!empty($count_bv)) {
					  $this->Users_model->update_batch('customer',$count_bv,'id');
					 
				  }	
				//make transaction complete
        			$this->db->trans_complete();
        			//check if transaction status TRUE or FALSE
			        if ($this->db->trans_status() === FALSE) {
			            //if something went wrong, rollback everything
			            $this->db->trans_rollback();
			        } else {
			            //if everything went right, commit the data to the database
			            $this->db->trans_commit();
			            $return = TRUE;
			        }		
				$data['userregisterid'] = $query;
				$this->session->set_flashdata('register', 'true'); 
				//$this->load->view('admin/register',$data);
			//	redirect('admin/signup');
			}
			else
			{  
				$this->session->set_flashdata('register', 'already'); 
				//$this->load->view('admin/register',$data);			
			}
		}
		}
		
       $data['profile'] = $this->Users_model->profile($id);
      $data['main_content'] = 'admin/register';
      $this->load->view('includes/admin/template', $data);
		//$this->load->view('admin/register');	

		
	}



	function validate_upl_credentials()
	{	
print_r($_POST); die();
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('fname', 'name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric|min_length[10]|max_length[10]');
			
					
					// file upload start here
			$config['upload_path'] ='images/customproduct/';
	        //$config['allowed_types'] = 'dwg|dxf';
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
					
		
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		$data = array(
				'name' => $this->input->post('fname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'doc' => $image,
				'status' => 'pending',						
				'frm_req' => $this->input->post('frm_req')						
			);
		
		
		   $this->load->model('Users_model');
			$query = $this->Users_model->validate_upl_credentials($data);
		
	}	
	

	
	function validate_review()
	{	

		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('comment', 'comment', 'trim');
			
				
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'comment' => $this->input->post('comment'),
				'pro_id' => $this->input->post('pro_id'),
				'rating' => $this->input->post('rating'),
				'status' => 'pending'					
			);
		
		
		   $this->load->model('Users_model');
			$query = $this->Users_model->validate_review($data);
		
	}	
	
	
	
	
	
    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->model('Users_model');
		   ///index.php/vc_site_admin/user/create_member
		
		//$this->goDownALevel('SU243210','left');
		//echo $this->last_user_id; die(' ');
		
		$this->load->library('form_validation');
		$data['userregisterid'] = '';
		// field name, error message, validation rules
		$this->form_validation->set_rules('f_name', 'first name', 'trim|required|min_length[3]');
		//$this->form_validation->set_rules('l_name', 'last name', 'trim|required');
		//$this->form_validation->set_rules('aadhar', 'aadhar', 'required');
	//	$this->form_validation->set_rules('bliss_code', 'referral code', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('cpassword', 'confirm password', 'trim|required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric|min_length[10]|max_length[10]');
		//$this->form_validation->set_rules('city', 'city', 'trim|required');
	//	$this->form_validation->set_rules('state', 'state', 'trim|required');
	//	$this->form_validation->set_rules('pincode', 'pincode', 'trim|required');
		
		
		$setting = $this->Users_model->get_setting();
		if($setting[0]['maintenance']=='Yes'){
		    $this->form_validation->set_rules('maintenance', 'maintenance', 'required');
		    $this->form_validation->set_message('required', 'Right now site is under maintenance please try after some time'); 
		}
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('register',$data);
		}
		
		else
		{			
			
		 	$query = $this->Users_model->create_member();

			if($query == 'false bliss_code')
			{  
				$this->session->set_flashdata('register', 'bliss_code'); 
				$this->load->view('register',$data);			
			}
			
		  elseif($query == 'false place_code')
			{  
				$this->session->set_flashdata('register', 'place_code'); 
				$this->load->view('register');			
			}
				elseif($query == 'false email')
			{  
				$this->session->set_flashdata('register', 'email'); 
				$this->load->view('register');			
			}
			elseif($query == 'false phone')
			{  
				$this->session->set_flashdata('register', 'phone'); 
				$this->load->view('register');			
			}
			elseif($query == 'false rtl_code')
			{  
				$this->session->set_flashdata('register', 'rtl_code'); 
				$this->load->view('register',$data);			
			}
			 elseif($query == 'send_otp')
			{
				$this->session->set_flashdata('register', 'sendotp'); 
				$this->load->view('register');
			}
			elseif($query == 'wrong_otp')
			{
				$this->session->set_flashdata('register', 'wrong_otp'); 
				$this->load->view('register');
			}
			elseif($query != 'false' && $query != '')
			{

				if($this->input->post('bliss_code') !='' && $this->input->post('place_code') =='') {
				 	$bliss_code = $this->input->post('bliss_code');
					$data_to_store = array('parent_customer_id'=>$bliss_code,'direct_customer_id'=>$bliss_code,'status'=>'active');
					$this->Users_model->update_profile_by_customer_id($query['customer_id'], $data_to_store);
					$this->Users_model->load_wallet_by_customer_id($bliss_code, 1000,'reward_wallet');
					
					$blisss_code = $this->input->post('bliss_code');
					$data_to_store = array('user_id'=>$query['id'],'send_to'=>$query['id'],'amount'=>1000,'wallet_type'=>'Reward Point','status'=>'Credit');
					$this->Users_model->add_transactions($data_to_store);
					
					
					//$this->Users_model->load_wallet_by_customer_id($bliss_code, 1000,'reward_wallet');
				}					
				$data['userregisterid'] = $query['customer_id'];
				$this->session->set_flashdata('register', 'true'); 
				$this->load->view('register',$data);
			}
			else
			{  
				$this->session->set_flashdata('register', 'already'); 
				$this->load->view('register',$data);			
			}
		}
		
	}
	
function goDownALevel($customerid,$position){
		//$this->load->model('Users_model');
		 $return = array();
		 $children = $this->Users_model->my_extreem_friends($customerid,$position); //underlying SQL function
		 if(!empty($children)){ 
			$this->goDownALevel($children[0]['customer_id'],$position); 
		 } 
		 else {  
				$this->last_user_id = $customerid; 
				/*if(empty($children)) { $this->user_position = 'left'; }
				else {  
				    if($children[0]['position']=='left') { $this->user_position = 'right'; }
				    else { $this->user_position = 'left'; }
				} */
		 }
		 return $return;
	}
	
	function goDownRightLevelDirect($customerid){ 
	if(empty($customerid)) { return false; }
	 $return = array();
	 $children = $this->Users_model->my_child($customerid); //underlying SQL function 
	 if(!empty($children)){  
	  foreach($children as $child){ 
	    $this->right_user[] = $child['customer_id'];  
	    $this->goDownRightLevelDirect($child['customer_id']);
	  } 
	 } 
		 return $return;
	}
	
public function forgotPassword()
   {
	   $this->load->model('Users_model');
         $email = $this->input->post('user_name');      
         $findemail = $this->Users_model->forgotPassword($email);  
         if($findemail){
          $return = $this->Users_model->sendpassword($findemail);     
          if($return=='true') { echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please check your email '.$email;
          echo '</div>';   
           } else { 
             echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Email not send.';
          echo '</div>';  
             }   
           }else{ 
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Email not exist please check your email.';
          echo '</div>';  
          }
   }
   
   
	function forgot_password(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('user_email', 'email', 'required|trim|valid_email');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$data_to_store = array(
                    'pname' => $this->input->post('p_name'),
					'description' => $this->input->post('p_discription'),
					'image' => $image,
					'price' => $this->input->post('p_price')
				); 
                //if the insert has returned true then we show the flash message
				/*if($this->product_model->store_product($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/product/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }*/
				 
            }//validation run

        }
		$this->load->view('admin/forgot_password');
	}
	
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}