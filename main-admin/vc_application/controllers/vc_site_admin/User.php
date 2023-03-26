<?php 
class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
       $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
    }

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('admin/welcome');
        }else{
        	$this->load->view('admin/login');	
        }
	}
public function distributor_login() {
   if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
	//load the view
      $data['main_content'] = 'admin/distributor_login';
      $this->load->view('includes/admin/template', $data);   
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
		
		if($is_valid['login']=='true')
		{
			$data = array('user_name' => $user_name, 'permission' =>$is_valid['permission'] , 'full_name'=>$is_valid['full_name'], 'email'=>$is_valid['email'], 'role'=>$is_valid['user_level'], 'user_id'=>$is_valid['user_id'], 'is_logged_in' => true, 'current_rest_session_id'=>'0');
			$this->session->set_userdata($data);
			redirect('admin/agent');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('admin/login', $data);	
		}
	}	

	 function admin_welcome(){ 
		$data['main_content'] = 'admin/admin_welcome.php'; 
        $this->load->view('includes/admin/template', $data); 
	 }
    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('admin/signup_form');	
	}
	

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/signup_form');
		}
		
		else
		{			
			$this->load->model('Users_model');
			
			if($query = $this->Users_model->create_member())
			{
				$this->load->view('admin/signup_successful');			
			}
			else
			{
				$this->load->view('admin/signup_form');			
			}
		}
		
	}
	
	
	
		     public function forgot_admin_Password()
   {
	   $this->load->model('Users_model');
         $email = $this->input->post('user_name');      
         $findemail = $this->Users_model->forgotPassword($email);  
         if($findemail){
          $return = $this->Users_model->sendpassword($findemail);     
          if($return=='true') { echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please check your email.';
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
		redirect('admin');
	}

}