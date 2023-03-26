<?php 
class Users_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password)
	{  
                $this->db->select('*');
		$this->db->from('customer');
		$this->db->where('email', $user_name);
		$this->db->where('pass_word', $password);
		$query = $this->db->get();
                if(count($query->result_array())==1) { 
                 $return['login'] = 'true';
			foreach ($query->result() as $row)
			 {
    			$return['cust_id'] = $row->id;
    			$return['full_name'] = $row->f_name.' '.$row->l_name;
    			$return['email'] = $row->email;
    			$return['bliss_id'] = $row->customer_id;
    			$return['status'] = $row->status;
                       if($row->image==''){ $return['cust_img'] = base_url().'assets/images/man-person.png'; }
                       else { $return['cust_img'] = base_url().'images/user/'.$row->image; }
			 }
			return $return;
                }
                else { return false ; }
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	/*function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); 
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}*/
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	
	function create_member()
	{

		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('customer');

        //if($query->num_rows > 0){
         if(count($query->result_array()) > 0) { 
        	return 'false';
		} else { 
			$new_member_insert_data = array(
				'f_name' => $this->input->post('f_name'),
				'l_name' => $this->input->post('l_name'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'status' => 'active',
				'pass_word' => md5($this->input->post('password'))						
			);
			/*if($this->input->post('bliss_code')!='') { $new_member_insert_data['parent_customer_id'] = $this->input->post('bliss_code'); }*/
if($this->input->post('bliss_code')!='') { 
			   $new_member_insert_data['parent_customer_id'] = $this->input->post('bliss_code'); 
			   /***************** SMS Registration ******************/
			   $sms_bliss_code = $this->input->post('bliss_code');
			    $this->db->select('id,f_name,l_name,phone');
				$this->db->from('customer');
				$this->db->where('customer_id', $sms_bliss_code); 
				$smsquery = $this->db->get();
                if(count($smsquery->result_array())==1) {  
					foreach ($smsquery->result() as $row) { 
				    $sms_msg = urlencode("Congratulations!
You have new independent BSA ".$this->input->post('f_name')." ".$this->input->post('l_name')."\n
Thank you
Team Blisszon");
					$smstext = "http://sms.digimiles.in/bulksms/bulksms?username=di78-blisszon&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$row->phone."&source=BLISSZ&message=".$sms_msg;
					file_get_contents($smstext);
					} 
                }
				/***************** coupon email ******************/
				$to = $this->input->post('email');
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: Blisszon <info@blisszon.com>' . "\r\n"; 
				$subject = 'Thank you for joining the Blisszon';
				$message = '<h3>Thank you for joining the Blisszon</h3>
				<p>Use <strong>BSA25%OFF</strong> coupon code and get 25% OFF at your first order.</p>
				Thank you <br>Team Blisszon'; 
				mail($to,$subject,$message,$headers);
			}

			
			  $this->db->insert('customer', $new_member_insert_data); 
              $insert_id = $this->db->insert_id();
			  $f_name = $this->input->post('f_name');
				$phone = $this->input->post('phone');
				$customer_n = substr($f_name,0,2).''.substr($phone,-4).''.$insert_id;
                $customer_id = strtoupper($customer_n);
       
        $this->db->where('id', $insert_id);
		$this->db->update('customer', array('customer_id'=>$customer_id));	
		/***************** SMS ******************/
		$sms_msg = urlencode("Thank you for joining us today! Below is your login information:
Username: ".$this->input->post('email')."
Password: ".$this->input->post('password')."
BSA Code: ".$customer_id."
Invite friends and Keep track of your earned bliss perks & more.\n
Thank you 
Team Blisszon");
$smstext = "http://sms.digimiles.in/bulksms/bulksms?username=di78-blisszon&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$this->input->post('phone')."&source=BLISSZ&message=".$sms_msg;
file_get_contents($smstext);
/***************** SMS ******************/

		    return $insert_id;
		}
	      
	}//create_member
	
	function get_bliss_code_by_phone($phone){
	   $this->db->select('customer_id');
		$this->db->from('customer');
		$this->db->where('phone',$phone);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function bliss_perk_history($id){
	   $this->db->select('*');
		$this->db->from('redeem_bliss');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	
	function profile($id){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function select_member(){
		$this->db->select('*');
		$this->db->from('customer');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function my_friends($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function my_orders($uid){
	  
		$admin_db->select('*');
		$admin_db->from('orders'); 
		$admin_db->where('user_id',$uid);
		$admin_db->order_by('id','desc');
		$query = $admin_db->get();
		return $query->result_array();   
	}
	
	
	
	function my_first_circle_order($myfriendid){
		
	
		$admin_db->select('id,user_id,status');
		$admin_db->from('orders'); 
		$admin_db->where_in('user_id',$myfriendid);
		$query = $admin_db->get();
		return $query->result_array();  
	}
	
	

function my_bliss_amount($uid){
	  
		$admin_db->select('*');
		$admin_db->from('distribution_amount'); 
		$admin_db->where('user_id',$uid);
		$admin_db->order_by('order_id','desc');
		$query = $admin_db->get();
		return $query->result_array();   
	}
	
	
	function update_profile($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }
	   
	  function validate_upl_credentials($data)
    {
		$insert = $this->db->insert('custom_product_req', $data);
		return $insert;
	}

	function validate_review($data)
    {
		$insert = $this->db->insert('reviews', $data);
		return $insert;
	}  
	   
	  function redeem_bliss_request($data)
    {
		$insert = $this->db->insert('redeem_bliss', $data);
		return $insert;
	} 


//funtion to get email of user to send password
 function forgotPassword($email)
 {
        $this->db->select('email');
        $this->db->from('customer'); 
        $this->db->where('email', $email); 
        $query=$this->db->get();
        return $query->row_array();
 }
 
 
 public function sendpassword($data)
{
        $email = $data['email'];
        $query1=$this->db->query("SELECT * from customer where email = '".$email."' ");
        $row=$query1->result_array();
        if ($query1->num_rows()>0)
      
{
        $passwordplain = "";
        $passwordplain  = rand(999999999,9999999999);
        $newpass = md5($passwordplain);
        /*$this->db->where('email', $email);
        $this->db->update('customer', $newpass); */
        $this->db->query("update customer set pass_word='".$newpass."' where email = '".$email."' ");       
         
        $to = $email;
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: Blisszon <info@blisszon.com>' . "\r\n"; 
				$subject = 'Forgot password at Blisszon';
				
				$message='Dear '.$row[0]['f_name'].','. "\r\n";
        $message.='<br><br>Thanks for contacting regarding to forgot password,<br> Your temp password is <b>'.$passwordplain.'</b>'."\r\n";
        $message.='<br>Please update your password.';
        $message.='<br><br>Thanks & Regards';
        $message.='<br>Blisszon'; 
				$mail= mail($to,$subject,$message,$headers);
if (!$mail) {
     $this->session->set_flashdata('msg','Failed to send password, please try again!');
} else {
   $this->session->set_flashdata('msg','Password sent to your email!');
}
  redirect(base_url());        
}
else
{  
 $this->session->set_flashdata('msg','Email not found try again!');
 redirect(base_url().'user/Login','refresh');
}
} 
 
 
	
	

	
	
	
	
}

