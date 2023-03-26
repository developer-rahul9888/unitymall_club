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
	public function fech_news(){
		$this->db->select('*');
		$this->db->from('gnd_news');
		$this->db->where('type','news');
		$this->db->where('status','active');
		$this->db->where('visibility','club');
		$query = $this->db->get();
		return $query->result_array();
	}
    public function get_voucher_order($id)
    {
	$this->db->select('v.*,c.image');
	$this->db->from('store_voucher as v');
	$this->db->join('voucher as c','c.id=v.voucher_id','left');
	$this->db->where('v.user_id',$id);
	$this->db->order_by('v.id','DESC');
	$query = $this->db->get();
	return $query->result_array(); 
    }
      public function check_autopool($user_id)
    {
		$this->db->select('m.*,c.sbv,c.direct');
		$this->db->from('matrix as m');
		$this->db->join('customer as c','c.id = m.user_id','left');
		$this->db->where('m.user_id',$user_id);
		$this->db->order_by("m.id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();  
    }
	 public function add_order($data_to_store){
		
	   $this->db->insert('transaction_summery', $data_to_store); 
	   $insert_id = $this->db->insert_id();
        return $insert_id;
    }
	function add_receipt($data){
		
	$this->db->insert('upload_receipt', $data);	
	
		return TRUE; 
	}
	function get_receipt_order ($id){
		$this->db->select('*');
		$this->db->from('upload_receipt');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	function get_transaction_summery($id){
		$this->db->select('*');
		$this->db->from('transaction_summery');
		$this->db->where('user_id',$id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function activity_log($id)
    {
		$this->db->select('*');
		$this->db->from('WorkWith'); 
		$this->db->where('zkey',$id);
		$this->db->order_by('id_no', 'DESC');

		//$this->db->join('customer','customer.customer_id = w.zkey','left');
		//$this->db->group_by('zkey');
		$query = $this->db->get();
		return $query->result_array();  
    }
     public function autopool_team($placement_id)
    {
		$this->db->select('*');
		$this->db->from('matrix');
		$this->db->where_in('parent_id',$placement_id);
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();  
    }
    	function insert_autopool_data($data_to){
		$this->db->insert('matrix',$data_to);
	}
	function update_autopool_child_num($placement_id){
	$sql="UPDATE matrix SET children=children+1 WHERE id=".$placement_id."";    
    $query = $this->db->query($sql);
		
	}
	public function get_autopool_placement()
    {
		$this->db->select('m.*,c.sbv');
		$this->db->from('matrix as m');
		$this->db->join('customer as c','c.id = m.user_id','left');
		$this->db->where('m.children <',2);
		$this->db->order_by("m.id", "asc");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();  
    }
      public function get_autopool_by_id($id)
    {
		$this->db->select('a.*,c.user_level,c.sbv');
		$this->db->from('matrix as a');
		$this->db->join('customer as c','c.id = a.user_id','left');
		$this->db->where('a.id',$id);
		$query = $this->db->get();
		return $query->result_array();  
    }
    public function get_user_info($id)
    {
		$this->db->select('*');
		$this->db->from('matrix');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    function get_popup(){
		$this->db->select('*');
		$this->db->from('popup');
		$this->db->where('status', 'active');
		$this->db->where('type', 'dashboard');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function store_pin($data)
    {
		$insert = $this->db->insert('pins', $data);
	    $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	
	function add_data($data)
    {
	  $this->db->insert('achiever', $data);
	    
	}

	function my_team_bussiness($uid){
	  
		$this->db->select('SUM(amount) as amount');
		$this->db->from('team_bussiness'); 
		$this->db->where('user_id',$uid); 
		$query = $this->db->get();
		return $query->result_array();   
	}
	
function select_customer(){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id >',2140);
		$this->db->where('id <=',2145);   
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function select_products(){
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('status', 'active');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
		    function store_sale_dta($data)
    {
		$insert = $this->db->insert('total_sale', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	
	function fetch_table_data_income($table,$id,$where=''){
		$this->db->select('t.*,c.customer_id');
		$this->db->from($table.' as t');
		$this->db->join('customer as c','c.id=t.user_send_by','left');
		$this->db->where('t.user_id',$id);
		if($where!='') { $this->db->where('t.type',$where); }
		$this->db->order_by('t.id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function fetch_table_data($table,$id,$where=''){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('user_id',$id);
		if($where!='') { $this->db->where('type',$where); }
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function my_bliss_amount_capping($table,$id,$where=''){
	  
		$this->db->select('*,pay_date as c_date');
		//$this->db->from('distribution_amount'); 
		$this->db->from($table);
		$this->db->where('user_id',$id);
		if($where!='') { $this->db->where('type',$where); }
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	
		function fetch_table_blisamount($table,$id){
		$this->db->select('bliss_amount as amount');
		$this->db->from($table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	} 
	
	
	function fetch_table_data_sum($table,$id,$where=''){
		$this->db->select('SUM(amount) as amount');
		$this->db->from($table);
		$this->db->where('user_id',$id);
		if($where!='') { 
		$this->db->where('type',$where); }
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function fetch_table_data_sum_report($table,$id){
		$this->db->select('SUM(amount) as amount');
		$this->db->from($table);
		$this->db->where('user_id',$id);
		$this->db->where('status',0);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function insert_pin_request($data){
	  $this->db->insert('pin_request',$data);
	  return TRUE;
	}
	
	public function insert_table_data($table,$data){
	  $this->db->insert($table,$data);
	  return TRUE;
	}
	
	public function insert_batch($table,$data){
	  $this->db->insert_batch($table,$data);
	  return TRUE;
	}
	
	 public function get_all_pin_by_status($customer_id,$status)
    {
		$this->db->select('*');
		$this->db->from('pins');
		$this->db->where('assign_to',$customer_id);
		$this->db->where('status',$status);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	 public function get_all_pin_by_create($customer_id)
    {
		$this->db->select('*');
		$this->db->from('pins');
		$this->db->where('created_by_user',$customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	public function update_batch($table,$data,$col){
	  $this->db->update_batch($table,$data,$col);
	  return TRUE;
	}
	
	public function update_distribution_amount($p,$ids,$sale_type,$data){
		
	$this->db->where_in('user_id',$p);
	$this->db->where('user_id_send_by',$ids);
	$this->db->like('type','BV');
	$this->db->like('pay_date',date('Y-m-d'));
	$this->db->like('sale_type',$sale_type);
	  $this->db->update('distribution_amount',$data);
	  return TRUE;
	}
	
   public function get_all_pin($customer_id,$franchisee='')
    {
		$this->db->select('*');
		$this->db->from('pins');
		$this->db->where('assign_to',$customer_id);
		if($franchisee!='') { $this->db->where('franchisee',$franchisee); }
		$query = $this->db->get();
		return $query->result_array(); 
    } 
    function get_prodcut_details($id){
         $this->db->select('*');
		$this->db->from('product_sale');
		$this->db->where('user_id',$id); 
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_my_pin($customer_id){
        $this->db->select('*');
		$this->db->from('pins');
		$this->db->where('used_by',$customer_id);
		$this->db->where('status','Used');
		//$this->db->or_where('package','1');
		//$this->db->or_where('package','2');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	function get_customer_by_id($id)
    {
		$this->db->select('c.*, d.id as did,d.customer_id as dcustomer_id, d.f_name as df_name, d.l_name as dl_name,d.user_level as duser_level,d.booster as dbooster,d.direct as ddirect');
		$this->db->from('customer as c');
		$this->db->join('customer as d','c.direct_customer_id=d.customer_id','left');
		$this->db->where('c.customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }	
	function get_direct_customer_info($id)
    {
		$this->db->select('c.*, d.id as did,d.customer_id as dcustomer_id, d.f_name as df_name, d.l_name as dl_name,SUM(b.amount) as amount');
		$this->db->from('customer as c');
		$this->db->join('customer as d','c.direct_customer_id=d.customer_id','left');
		$this->db->join('team_bussiness  as b','b.user_id=c.id AND b.status=0','left');
		$this->db->where('c.direct_customer_id',$id);
		$this->db->group_by('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	 function count_available_pins($id,$number_of_pins,$customer_id)
    {
		$this->db->select('*');
		$this->db->from('pins');
		$this->db->where('p_amount',$id);
		$this->db->where('status','Active');
		$this->db->where('assign_to',$customer_id);
		$this->db->limit($number_of_pins); 
		$query = $this->db->get();
		return $query->result_array();  
    }

     function get_all_package($status='') {
	 	 $this->db->select('*');
		$this->db->from('package');
		if($status!=''){
		$this->db->where('status',$status);
		}
		$this->db->where('franchisee',0);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function available_pin($customer_id)
    {
		$this->db->select('*');
		$this->db->from('pins');
		$this->db->where('status','Active');
		$this->db->where('assign_to',$customer_id);
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	function update_delivery_date($psid,$update_date){
	    $this->db->where('id', $psid);
		$this->db->update('product_sale', $update_date);
	}
	function update_trnsfr_pin($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('pins', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	} 
	
	function super_admin_validate($user_name){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id', $user_name); 
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

	function super_admin_validate_by_id($user_name){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id', $user_name); 
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
	
	function validate($user_name, $password)
	{  
        $this->db->select('*');
		$this->db->from('customer');
		//$this->db->where('phone', $user_name);
		$this->db->where('(customer_id = "'.$user_name.'" OR phone = "'.$user_name.'")');
		$this->db->where('pass_word', $password);
		$query = $this->db->get();
		$return['login'] = 'false';
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
                else { return $return; }
	}

	
	function create_member()
	{
		$otp=$this->input->post('otp');
    	$otp_exist=$this->session->userdata('otp_number');
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('customer'); 
		
		
		$this->db->where('phone', $this->input->post('phone'));
		$query5 = $this->db->get('customer');
		
		$this->db->where('customer_id', $this->input->post('bliss_code'));
		//$this->db->where('user_level >',0);
		 $bliss_code_query = $this->db->get('customer');

		 $this->db->where('customer_id', $this->input->post('place_code'));
		// $this->db->where('position', $this->input->post('position'));
		 $place_code_query = $this->db->get('customer');
		 
		//  $this->db->where('aadhar', $this->input->post('aadhar'));
		//$query1 = $this->db->get('customer'); */
		 
		   /*
		$this->db->where('pinid', $this->input->post('pin_code'));
		$this->db->where('assign_to', $this->input->post('bliss_code'));
		$this->db->where('status', 'Active');
		 $pin_query = $this->db->get('pins');
		   */
        //if($query->num_rows > 0){
          if(count($place_code_query->result_array()) == 0 && $this->input->post('place_code')!='') { 
          //	echo '<pre>'; print_r($place_code_query->result_array()); die();
        	return 'false place_code';
		} 
		/*else  if(count($query1->result_array()) > 0) { 
        	return 'false addhar';
		}*/
		
		else  if(count($query->result_array()) > 0) { 
        	return 'false email';
		}
		
		else  if(count($query5->result_array()) > 0) { 
        	return 'false phone';
		}
		
		
		else if($this->input->post('bliss_code')!='' && (count($bliss_code_query->result_array()) == 0)) { 
		   return 'false bliss_code';
		}/*  elseif(substr($this->input->post('bliss_code'),2,1)=='R' || substr($this->input->post('bliss_code'),2,1)=='r' ){ 
		   return 'false rtl_code';
		} */
		
		elseif ($otp=='') {
    			$phone = $this->input->post('phone');
    			$this->session->set_userdata('no_veryfied','no');
    			if($phone != '') {
    				$otp_crt = rand(1000,9999);
    				$data['veryfied_msg_otp'] = $otp_crt;
    				$this->session->set_userdata('otp_number',$otp_crt);
    				$sms_msg = urlencode("Dear ".$this->session->userdata('full_name')." Use this One Time Password ".$otp_crt." to complete your registration process. Regards, Unitymall Inc."); 

    				$smstext ="http://trans.businesskarma.in/api/v4/?api_key=A489d867d76419ff045781f5fc877e40a&method=sms&message=".$sms_msg."&to=".$phone."&sender=UNTYML";
					file_get_contents($smstext);
    				$to = $this->input->post('email');
    				$subject ="OTP form :- OTP for unitymall Registration";
    				$txt = "Your OTP for unitymall registration is ".$otp_crt.""; 
    				$headers = "From: unitymall.in"."\r\n";
    				$headers = "MIME-Version: 1.0" . "\r\n";     
    				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
    				$headers .= 'From: <unitymall.in>' . "\r\n"; 
    			mail($to,$subject,$txt,$headers);
    			}
    			$data['veryfied_msg']="true";
    			return 'send_otp';
    		} 
    		elseif ($otp!=$otp_exist) {

    			return 'wrong_otp';

    		}
		else { 
		$tr_pin = str_pad(mt_rand(1,99999),4,'0',STR_PAD_LEFT);
			$new_member_insert_data = array(
				'f_name' => $this->input->post('f_name'),
				'l_name' => $this->input->post('l_name'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'dob' => $this->input->post('dob'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'pincode' => $this->input->post('pincode'),
				'direct_customer_id' => $this->input->post('bliss_code'),
				'parent_customer_id' => $this->input->post('bliss_code'),
				'rank' => 'Associate',
				'status' => 'active',
				'reward_wallet' => 1000,
				'pass_word' => md5($this->input->post('password')),
                'tr_pin' => md5($tr_pin),
                'rdate' => date('Y-m-d H:i:s')		
			);
			if($this->input->post('bliss_code')=='') {
				$new_member_insert_data['direct_customer_id'] = '1258379672';
				$new_member_insert_data['parent_customer_id'] = '1258379672';
			}
			  $this->db->insert('customer', $new_member_insert_data);               
			  $insert_id = $this->db->insert_id();
			  $f_name = $this->input->post('f_name');
				$phone = $this->input->post('phone');
				$customer_n = ''.$insert_id.$tr_pin;
                $customer_id = strtoupper($customer_n);
        $this->db->where('id', $insert_id); 
		$this->db->update('customer', array('customer_id'=>$customer_id));	

		$name=$this->input->post('f_name').' '.$this->input->post('l_name') ;
		$password = $this->input->post('password');
		
			/***************** SMS ******************/

		$sms_msg = urlencode("Welcome to www.unitymall.in Your Login ID is ".$customer_id.",\nPassword ".$password."\nThank You."); 
		$smstext ="http://trans.businesskarma.in/api/v4/?api_key=A489d867d76419ff045781f5fc877e40a&method=sms&message=".$sms_msg."&to=".$phone."&sender=UNTYML";
		file_get_contents($smstext);
		
			/***************** SMS ******************/


/***************** Registration email ******************/
  
				 $to = $this->input->post('email');
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: unittymall Pvt Ltd. <Info@unitymall.in>' . "\r\n"; 
				$subject = 'Thank you for joining the unittymall .';
				$message = '
				Respected  <b style="color:orange">'.$name.'</b><br>
I would like to welcome you to the unitymall. It has been a pleasure to be able to talk to you about our products. It is a tremendous honor for us to be working with you. We are looking forward to do more business deals with you. Your registration details is as below.<br><br>
ID-NO:- <b style="color:orange">'.$customer_id.'</b><br>
Password:- <b style="color:orange">'.$password.'</b><br>
<br>
Thank you for joining the unitymall.<br>
Looking forward to a continuous and a faithful business partnership with you.
<br>
Regards,
<br>
unitymall Pvt Ltd.';
				mail($to,$subject,$message,$headers);

		
		    return array('customer_id'=>$customer_id,'id'=>$insert_id);
		} 
	}//create_member
	function user_request_data($blissid) {
		$this->db->select('upgrade_acc.up_user_id,upgrade_acc.up_status,upgrade_acc.req_apr_date');
				$this->db->from('customer');
				$this->db->join('upgrade_acc', 'upgrade_acc.up_user_id = customer.id');
				$this->db->where('customer.customer_id',$blissid);
				$req_query = $this->db->get();
				return $req_query->result_array();
	}
	function user_child_info($blissid) {
		 $this->db->select('id,customer_id,position');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$blissid);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function get_bliss_code_by_phone($cstid){
	   $this->db->select('f_name,l_name');
		$this->db->from('customer');
		$this->db->where('customer_id',$cstid);
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
		
	
	
	function rewardhis($id){
		$this->db->select('*');
		$this->db->from('reward');
		$this->db->where('userid',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function select_member(){
		$this->db->select('*');
		$this->db->from('customer');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function user_total_sale($id){
	   $this->db->select('SUM(total_amount) as tamount');
		$this->db->from('orders'); 
		$this->db->where('user_id',$id);
		$this->db->where('status','Delivered');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function profile_by_id_pool_tree_cus_id($cust_id){

	    $this->db->select('p.*,c.f_name,c.l_name,c.customer_id,c.consume');
		$this->db->from('customer as c');
		$this->db->join('matrix as p', 'c.id = p.user_id','left');
		$this->db->where('c.customer_id',$cust_id);
		$this->db->order_by('p.id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	function my_friends($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id,direct_customer_id,position,consume,bsacode,status,parent_customer_id,user_level,rdate');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function my_friends_in($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id,direct_customer_id,position,consume,city,state,pincode,bsacode,status,parent_customer_id,user_level,rdate');
		$this->db->from('customer');
		$this->db->where_in('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function my_friends_auto_pool($cust_id){

	    $this->db->select('d.customer_id as dcustomer_id,p.*,c.f_name,c.l_name,c.customer_id,c.status,c.consume');
		$this->db->from('matrix as p');
		$this->db->join('customer as c', 'c.id = p.user_id','left');
		$this->db->join('customer as d', 'd.id = p.parent_id','left');
		$this->db->where('p.parent_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	function my_extreem_friends($cust_id,$position){
	   $this->db->select('id,customer_id,position');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$this->db->where('position',$position);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	function my_directs_bv($cust_id){
	   $this->db->select('SUM(sbv) as dsbv');
		$this->db->from('customer');
		$this->db->where('direct_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function friends_by_position_in_array($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id,status,parent_customer_id,city,state,pincode,direct_customer_id,rdate,var_status,consume,position,user_level,package_used');
		$this->db->from('customer');
		$this->db->where_in('direct_customer_id',$cust_id);
		$this->db->order_by('package_used','asc');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function friends_by_position($cust_id,$position='') {
	   $this->db->select('id,f_name,l_name,customer_id,position,bsacode,status,direct_customer_id,parent_customer_id,user_level,rdate,package_used ');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		//$this->db->where('consume','0');
		if($position!='') { $this->db->where('position',$position); }
		$query = $this->db->get();
		return $query->result_array(); 
	} 
	
	
	function other_friends($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id,position,bsacode,status,parent_customer_id,rdate');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$this->db->where('consume','0');
		$this->db->where('position','other');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	
     function get_all_child_sale($ids,$sdate,$edate){ 

		$this->db->select('orders.*,customer.f_name,customer.l_name,customer.customer_id');
		$this->db->from('orders'); 
		$this->db->join('customer','customer.id=orders.user_id','left'); 
		$this->db->where_in('orders.user_id',$ids);
		$this->db->where('orders.status','Delivered');
		$this->db->where('orders.o_date >=',$sdate);
		$this->db->where('orders.o_date <=',$edate);
		$this->db->order_by('orders.o_date','asc');
		$query = $this->db->get();
        return $query->result_array();  
	}
	
	function my_orders($uid){
	  
		$this->db->select('*');
		$this->db->from('orders'); 
		$this->db->where('user_id',$uid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	function get_order_by_id($id){
	  
		$this->db->select('*');
		$this->db->from('orders'); 
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	
	
	function my_first_circle_order($myfriendid){
		
	
		$this->db->select('id,user_id,status');
		$this->db->from('orders'); 
		$this->db->where_in('user_id',$myfriendid);
		$query = $this->db->get();
		return $query->result_array();  
	}
	
	

function my_bliss_amount($uid){
	  
		$this->db->select('*');
		$this->db->from('distribution_amount'); 
		$this->db->where('user_id',$uid);
		$this->db->order_by('order_id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}

	public function get_pv_by_id($id){ 
		$this->db->select('SUM(amount) as amount,type,sale_type,status');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id);
		$this->db->where('user_id_send_by >',0);
		$this->db->group_by('type');
		$this->db->group_by('status');
		$this->db->group_by('sale_type');
		$this->db->like('type','BV');
		$query = $this->db->get();
		return $query->result_array(); 
   }
	
	function bliss_perk_redeem_amount($id){ 
		$this->db->select('SUM(redeem) as total');
		$this->db->from('redeem_bliss');
		$this->db->where('user_id',$id);
		$this->db->where('redeem_status','approved');
		$query=$this->db->get();
		return $query->row()->total;
		}
 //SELECT SUM(amount) as total, status, type FROM `distribution_amount` group by type
 function total_incomes($id){
	$this->db->select('SUM(amount) as tamount,type');
	$this->db->from('incomes');
	$this->db->where('user_id',$id);
	$this->db->where('status','Active');
	$this->db->group_by('type');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 

 function totalHoldIncomes($id){
	$this->db->select_sum('amount');
	$this->db->from('incomes');
	$this->db->where('user_id',$id);
	$this->db->where('status','Hold');
	return $this->db->get()->row();
	//return $query->result_array(); 
 }

 function getHoldIncomes($id){
		$this->db->select('a.*,c.customer_id,c.f_name, c.l_name');
		$this->db->from('incomes as a');
		$this->db->join('customer as c', 'c.id = a.user_send_by','left');
		$this->db->where('a.user_id',$id);
		$this->db->order_by('a.id','desc');
		$this->db->where('a.status','Hold');
		$query = $this->db->get(); 
		return $query->result_array(); 
 }
 
  function daily_weakly_in($sdate,$edate,$id){
	$this->db->select('*');
	$this->db->from('incomes');
	$this->db->where('rdate >=',$sdate);
	$this->db->where('rdate <=',$edate); 
	$this->db->where('user_id',$id);
	$this->db->where('status','Active');
	$this->db->order_by('id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 
 function daily_weakly_in_by_table($table,$sdate,$edate,$id){
	$this->db->select('SUM(amount) as amount,c_date');
	$this->db->from($table);
	if($sdate!='') { $this->db->where('c_date >=',$sdate); }
	if($sdate!='') { $this->db->where('c_date <=',$edate); }
	$this->db->where('user_id',$id);
	//$this->db->where('status','Active');
	$this->db->order_by('id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }

 function daily_weakly_in_by_table_group($table,$sdate,$edate,$id){
	$this->db->select('SUM(amount) as amount,c_date,type');
	$this->db->from($table);
	$this->db->where('c_date >=',$sdate);
	$this->db->where('c_date <=',$edate); 
	$this->db->where('user_id',$id);
	$this->db->group_by('type');
	$this->db->order_by('id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 
 
   function payout_invoice_report($sdate,$edate,$id){
	$this->db->select('*');
	$this->db->from('transaction_log');
	$this->db->where('rdate >=',$sdate);
	$this->db->where('rdate <=',$edate); 
	$this->db->where('userid',$id);
	//$this->db->where('status','Active');
	$this->db->order_by('id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 } 
 
   function get_payout_sum($id,$type=''){
	$this->db->select('SUM(amount) as amount');
	$this->db->from('transaction_log');
	$this->db->where('userid',$id);
	if($type!='') { $this->db->where('status',$type); }
	$query=$this->db->get();
	return $query->result_array(); 
 } 
 function bank_statement($sdate,$edate,$id){
	$this->db->select('*');
	$this->db->from('transaction_log');
	$this->db->where('rdate >=',$sdate);
	$this->db->where('rdate <=',$edate); 
	$this->db->where('userid',$id);
	$this->db->where('status','paid');
	$this->db->order_by('id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 

 
	
	function update_profile($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }
	   	function update_pin( $pin_code,$user,$date){  
	   	    $data_to_store = array('used_by'=>$user,'status'=>'Used','used_on'=>$date);
            // $this->db->where('assign_to', $bliss_code);
             $this->db->where('id', $pin_code);
            // $this->db->where('status', 'Active');
	     $this->db->update('pins', $data_to_store);	
            return TRUE;
       }
function update_order($id, $data_to_store){ 
             
		$this->db->where('id', $id);
		$this->db->update('orders', $data_to_store);	
            return TRUE;
       }

	  function validate_upl_credentials($data)
    {
		$insert = $this->db->insert('custom_product_req', $data);
		return $insert;
	}
	
	 function insert_repuchase_bv($data)
    {
		$insert = $this->db->insert('repurchase_bv', $data);
		return $insert;
	}

	function validate_review($data)
    { 
		$insert = $this->db->insert('reviews', $data);
		return $insert;
	}  
	function add_distribution($data) 
    {
		$insert = $this->db->insert('distribution_amount', $data);
		return $insert;
	}
	function add_salary($data)
    {
		$insert = $this->db->insert('salary', $data);
		return $insert;
	}   
	  function redeem_bliss_request($data)
    {
		$insert = $this->db->insert('redeem_bliss', $data);
		return $insert;
	}  


	function upgrade_accout_request($data,$id)
    {
		$insert = $this->db->insert('upgrade_acc', $data);
		$this->db->where('id', $id);
		 $this->db->update('customer', array('up_req' => '1')); 
		return $insert;
	} 
	
	function get_salary($date)
	{
        $this->db->select('s.*,c.package_used');
        $this->db->from('salary as s');
        $this->db->join('customer as c','c.id=s.user_id','left');
        $this->db->where('s.tmonth >', 0);
        $this->db->like('s.pay_date', $date);
        $query=$this->db->get();
        return $query->result_array();
	}
	function get_salary_by_id($id)
	{
        $this->db->select('*');
        $this->db->from('salary'); 
        $this->db->where('id', $id);
        //$this->db->like('s.pay_date', $date);
        $query=$this->db->get();
        return $query->result_array();
	}
	 function update_salary($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('salary', $data_to_store);	
            return TRUE;
       }

//funtion to get email of user to send password
 function forgotPassword($email)
 {
        $this->db->select('email,phone,customer_id');
        $this->db->from('customer'); 
        $this->db->where('email', $email); 
        $query=$this->db->get();
        return $query->row_array();
 }
 
 
 public function sendpassword($data)
{
        $email = $data['email'];
        $customer_id = $data['customer_id'];
        $phone = $data['phone'];
        $query1=$this->db->query("SELECT * from customer where customer_id = '".$customer_id."' ");
        $row=$query1->result_array();
        if ($query1->num_rows()>0)
      
{
        $passwordplain = "";
        $passwordplain  = rand(999999999,9999999999);
        $newpass = md5($passwordplain);

        $this->db->query("update customer set pass_word='".$newpass."' where customer_id = '".$customer_id."' ");       
        
        	/***************** SMS ******************/
		
 
        $to = $email;
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: unitymall <info@unitymall.in>' . "\r\n"; 
				$subject = 'Forgot password at unitymall'; 
				
					$message='Dear '.$row[0]['f_name'].','. "\r\n";
        $message.='<br><br>Thanks for contacting regarding to forgot password,<br> Your temp password is <b>'.$passwordplain.'</b>'."\r\n"; 
        $message.='<br>Please update your password.';
        $message.='<br><br>Thanks & Regards';
        $message.='<br>unitymall'; 
				$mail= mail($to,$subject,$message,$headers);
if ($mail) {
     return 'true';
} else { 
   return 'false'; 
}     
}
else {  return 'error'; }
}

public function changePassword($pass)
{
	$customer_id = $this->session->userdata('bliss_id');
        $query=$this->db->query("SELECT * from customer where customer_id = '".$customer_id."' and pass_word = '".md5($pass)."' ");
		
		$row=$query->result_array();
        if ($query->num_rows()>0){ 
            return "true";
        }else{
            return "false";
        }
    }
	
	public function update_changePassword($data_to_store)
{
	$customer_id = $this->session->userdata('bliss_id');
	 $this->db->where('customer_id', $customer_id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
    }
    public function update_gbv_status_by_ids($ids){
		$data = array('status'=>'Redeem','pay_date'=>date('Y-m-d'));
		$this->db->where_in('id', $ids);
		$this->db->update('distribution_amount', $data);
	}
	public function update_gbv_status($id){
		$data = array('status'=>'Redeem','pay_date'=>date('Y-m-d'));
		$this->db->where('id', $id);
		$this->db->update('distribution_amount', $data);
	}
public function add_bliss_amount_in_customer($userid,$amount){
		  $this->db->select('id,bliss_amount');
		$this->db->from('customer');
		$this->db->where('id', $userid);
		$query = $this->db->get();
        if(count($query->result_array()) > 0) {  
			foreach ($query->result() as $row)
			 {
				 $bliss_amount = $row->bliss_amount + $amount;
				 $this->db->where('id', $userid);
				 $this->db->update('customer', array('bliss_amount'=>$bliss_amount));	
			 }
		}
	}

    public function get_cutoff_pv($id,$date){ 
		$this->db->select('*');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id); 
		$this->db->where('sale_type','1'); 
		$this->db->like('type','Cut off');
		$this->db->like('pay_date',$date);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	public function get_pv($id,$sale_type=''){ 
		$this->db->select('*');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id);
		$this->db->where('status','Active'); 
		if($sale_type!='') { $this->db->where('sale_type',$sale_type); }
		$this->db->like('type','BV');
		$query = $this->db->get();
		return $query->result_array(); 
   }
	 
	 
   public function get_matching_pv($id){ 
		$this->db->select('SUM(amount) as total_pv');
		$this->db->from('binary_income');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   function get_total_pv_for_first_payout($ids){
	    	$this->db->select('SUM(amount) as total_pv');
		$this->db->from('distribution_amount');
		$this->db->where_in('user_id',$ids);
		$this->db->like('type','PV');
		$query = $this->db->get();
		return $query->result_array(); 
	}
   public function get_matching_pv_by_date($id,$date){ 
		$this->db->select('SUM(amount) as redeem_pv');
		$this->db->from('binary_income');
		$this->db->where('user_id',$id);
		//$this->db->where('status','Redeem');
		
		//$this->db->where('type','Matching');
		$this->db->like('c_date',$date);
		$query = $this->db->get();
		return $query->result_array(); 
   }
  /*   public function get_total_pv_by_date($id,$sale_type=''){ 
		$this->db->select('SUM(amount)');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id);
		
		if($sale_type!='') { $this->db->where('sale_type',$sale_type); }
		$this->db->like('type','PV');
		$this->db->group_by('type');
		$query = $this->db->get();
		return $query->result_array(); 
   } */		

	
	public function transaction_wallet($id)

    {

		$this->db->select('*');

		$this->db->from('transaction_wallet');

		$this->db->where('user_id',$id);

		$this->db->order_by('id','desc');

		$query = $this->db->get();

		return $query->result_array(); 

    }	
	
    function parent_profile($blissid){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$blissid);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
    function get_direct_user_ids($id){
		$this->db->select('id,position,user_level');
		$this->db->from('customer');
		$this->db->where('direct_customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}	
	function get_first_two_direct_user_ids($id){
		$this->db->select('id,position,user_level');
		$this->db->from('customer');
		$this->db->where('direct_customer_id',$id);
		$this->db->limit(2);
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result_array(); 
	}	
	function get_direct_user_id_by_eligible($id,$user_level){
		$this->db->select('id');
		$this->db->from('customer');
		$this->db->where('direct_customer_id',$id);
		$this->db->where('user_level',$user_level);
		$query = $this->db->get();
		return $query->result_array(); 
	}	
   
	function get_pin_by_user($pin,$user){
		$this->db->select('*');
		$this->db->from('pins');
		$this->db->where('id',$pin);
		//$this->db->where('assign_to',$user);
		//$this->db->where('status','Active');
		$query = $this->db->get();
		return $query->result_array(); 
	}
 function update_profile_by_customer_id($id, $data_to_store){ 
             $this->db->where('customer_id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }
	   function update_user_wallet($id,$package){
        $sql = "update `customer` set bliss_amount = bliss_amount + $package  where id='$id'";
        $this->db->query($sql); 
    }
		
function update_order_status($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('transaction_summery', $data_to_store);	
            return TRUE;
       }
       function profile_by_customer_id($id){
		$this->db->select('id,f_name,l_name,parent_customer_id,customer_id,direct_customer_id,bsacode,position,user_level,capping,status,package_used,rdate,reward,package,direct,left_direct,right_direct,consume');
		$this->db->from('customer');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	 public function get_all_diamond_bdm(){
	   $this->db->select('id');
		$this->db->from('customer');
		$this->db->where('bsacode','Diamond BDM');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function get_parent_child_bdm($customer_id){
	   $this->db->select('id,position,customer_id,consume,package');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$customer_id);
		$this->db->where('bsacode','BDM');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function get_parent_child_diamond_bdm($customer_id){
	   $this->db->select('id,position,customer_id,consume,package');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$customer_id);
		$this->db->where('bsacode','Diamond BDM');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
      public function get_parent_child_consume_bdm($customer_id){
	   $this->db->select('id,position,customer_id,consume');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$customer_id);
		$this->db->where('bsacode','Diamond BDM');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
   public function my_child($customer_id){
	   $this->db->select('id,position,customer_id,package,consume');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$customer_id);
		$this->db->where('consume','0');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   	public function add_distribution_amount($amount,$userid,$level,$order_id,$cust_id){
         
		$insert_data = array(
				'user_id' => $userid,
				'amount' => $amount,
				'user_id_send_by' => $cust_id,
				'pay_level' => $level,
				'order_id' => $order_id,
				'status' => 'Active'					
			); 
		$this->db->insert('distribution_amount', $insert_data); 
	}
	  public function my_fund($userid){
	   $this->db->select('*');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$userid);
		$this->db->where('pay_level','1');
		$query = $this->db->get();
		return $query->result_array(); 
   }

    public function sharing_bonus($userid){
	   $this->db->select('*');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$userid);
		$this->db->where('pay_level','0');
		$query = $this->db->get();
		return $query->result_array(); 
   }
  function get_active_incomes($id,$where,$type){ 
	   $this->db->select('a.*,c.customer_id,c.f_name, c.l_name');
		$this->db->from('incomes as a');
		$this->db->join('customer as c', 'c.id = a.user_send_by','left');
		$this->db->where('a.user_id',$id);
		$this->db->order_by('a.id','desc');
		$this->db->where($where);
		$this->db->where('type',$type);
		$this->db->where('a.status','Active');
		$query = $this->db->get(); 
		return $query->result_array(); 
	} 
	 public function parent_bliss($id){
	   $this->db->select('c.id,c.parent_customer_id,c.user_level,c.direct_customer_id,cj.id as pid,cj.left_direct as dleft_direct,cj.right_direct as dright_direct,cj.bsacode as rank, cj.user_level as level');
		$this->db->from('customer as c');
        $this->db->join('customer as cj', 'c.direct_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function direct_user_info_from_user_id($id){
	   $this->db->select('c.id,c.f_name,c.l_name,c.customer_id,cj.id as did,cj.bsacode as rank,cj.consume as franchise,cj.package_used');
		$this->db->from('customer as c');
        $this->db->join('customer as cj', 'c.direct_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
    function update_consume_user($id,$parent_id,$level){ 
        $data = array('consume'=>1);
             $this->db->where_in('customer_id', $id);
	     $this->db->update('customer', $data);	
       
       $data1 = array('user_level'=>$level);
             $this->db->where('id', $parent_id);
	     $this->db->update('customer', $data1);
	     
       }
       
    function update_consume_users($id){
        $sql = "UPDATE customer SET consume = IF(package = 0, 1, consume), package = IF(package > 0, package - 1, package) WHERE customer_id = '$id'";
         $this->db->query($sql); 
    }
    function update_user_package($id,$package){
        $sql = "update `customer` set package = package + $package, package_used = package_used + $package where id='$id'";
        $this->db->query($sql); 
    }
       	public function add_reward($parent_id,$order_id,$data,$level){
	    	$insert_data = array(
				'userid' => $parent_id,
				'pinid' => $order_id,
				'description' => $data,					
				'level' => $level,					
			); 
		$this->db->insert('reward', $insert_data); 
	}
	
   	public function add_income($data){ 
		$this->db->insert('incomes', $data); 
	}
	
	
		public function update_changePin($data_to_store)
{
	$customer_id = $this->session->userdata('bliss_id');
	 $this->db->where('customer_id', $customer_id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
    }
	
	
	function update_wallet($id,$amount,$type){
        $sql = "update `customer` set $type = $type - $amount where id='$id'";
        $this->db->query($sql); 
    }		
    function substract_wallet($id,$amount,$column){        
    	$sql = "update `customer` set $column = $column + $amount where id='$id'";        
    	$this->db->query($sql);     
    }
    function load_wallet_by_customer_id($id,$amount,$column){        
    	$sql = "update `customer` set $column = $column + $amount where customer_id='$id'";        
    	$this->db->query($sql);     
    }
	 function add_transactions($data){ 
		$this->db->insert('transaction_wallet', $data); 
	}
	function load_wallet($id,$amount,$column){
        $sql = "update `customer` set $column = $column + $amount where id='$id'";
        $this->db->query($sql); 
    }
	
		function pancard($id){
		$this->db->select('pancard');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}  
	function count_pancard($pancard){
		$this->db->select('pancard');
		$this->db->from('customer');
		$this->db->where('pancard',$pancard);
		$query = $this->db->get();
		return $query->result_array(); 
	}  

 	function aadhar($id){
		$this->db->select('aadhar');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function phone($phone){
		$this->db->select('phone');
		$this->db->from('customer');
		$this->db->where('phone',$phone);
		$query = $this->db->get();
		return $query->num_rows(); 
	}
	
	
	function get_wallet_history($customer_id,$type){
		$this->db->select('*');
		$this->db->from('transaction_wallet');
		$this->db->where('user_id',$customer_id);
		$this->db->where('wallet_type',$type);
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	function my_transfer_all_pin($sdate,$edate, $customer_id) {
	 	 $this->db->select('pt.*,p.pinid as pinno,p.p_amount as pinam,c.f_name as cname');
		$this->db->from('pins_transfer as pt');
		$this->db->join('pins as p', 'p.id = pt.pinid','left'); 
		$this->db->join('customer as c', 'pt.assign_to = c.customer_id','left'); 
		$this->db->where('pt.rdate >=',$sdate);
		$this->db->where('pt.rdate <=',$edate);
		$this->db->where('pt.assign_from',$customer_id);
		$this->db->order_by('pt.id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function get_clear_payout($sdate='',$edate='',$id){
	    $this->db->select('t.*,c.f_name,c.l_name,c.email,c.customer_id,c.phone,c.pancard,c.bank_name,c.account_no,c.ifsc');
		$this->db->from('transaction_log as t');
        $this->db->join('customer as c', 't.userid = c.id', 'left'); 
		$this->db->where('t.status','Clear'); 
		$this->db->where('t.userid',$id); 
		if($sdate!='') { $this->db->where('t.rdate >=',$sdate); }
		if($edate!='') { $this->db->where('t.rdate <=',$edate); }
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function get_all_payout($id,$sdate='',$edate='',$status=''){
	    //$status = array('Weekly Closing','Bank Process');
	    $this->db->select('t.*,c.f_name,c.l_name,c.email,c.customer_id,c.phone,c.pancard,c.bank_name,c.account_no,c.ifsc');
		$this->db->from('transaction_log as t');
        $this->db->join('customer as c', 't.userid = c.id', 'left'); 
		if($sdate!='') { $this->db->where('t.rdate >=',$sdate); }
		if($edate!='') { $this->db->where('t.rdate <=',$edate); }
		$this->db->where('t.userid',$id); 
		if($status!='All') { 
		 $this->db->where_in('t.status',array('Weekly Closing','Bank Process')); 
		 //$this->db->or_where('t.status',); 
		}
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	 function get_payout_by_date($sdate='',$edate='',$status='') {
	 	 $this->db->select('r.id,r.user_id,SUM(r.amount) as total_amount,c.id as cid,c.l_name,c.f_name,c.l_name,c.customer_id,c.email,c.phone,c.bank_name,c.account_no,c.ifsc,c.pancard');
		$this->db->from('incomes as r');
        $this->db->join('customer as c', 'c.id = r.user_id','left'); 
		if($sdate!='') { $this->db->where('r.rdate >=',$sdate); }
		if($edate!='') { $this->db->where('r.rdate <=',$edate); }
		if($status!='') { $this->db->where('r.status',$status); }
		$this->db->group_by('user_id','desc');
		$this->db->order_by('id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function add_transactional_log($data){
	    $this->db->insert('transaction_log', $data); 
	} 
	

	
	 function update_income_status_all_user($users){
           $data = array('status'=>'Process');
             $this->db->where('status', 'Active');
             $this->db->where_in('user_id', $users);
	     $this->db->update('incomes', $data);	
       }
       function get_setting(){
           $this->db->select('maintenance');
		$this->db->from('site_setting');
		$query = $this->db->get();
		return $query->result_array(); 
       }
	   
	   
	   
	   
	 function fetch_reward_sum($id){
		$this->db->select('SUM(reward) as amount');
		$this->db->from('reward');
		$this->db->where('user_id',$id);
		//$this->db->group_by('user_id','reward');
		$query = $this->db->get();
		return $query->result_array(); 
	}   
	   
	   
	   
	function fetch_fund($id){
		$this->db->select('SUM(amount) as amount,type');
		$this->db->from(' turnover_income');
		$this->db->where('user_id',$id);
		$this->db->group_by('type');
		//$this->db->group_by('user_id','reward');
		$query = $this->db->get();
		return $query->result_array(); 
	}   
	   
		function fetch_data($id,$type){
		$this->db->select('*');
		$this->db->from('turnover_income');
		$this->db->where('user_id',$id);
		$this->db->where('type',$type);
		$query = $this->db->get();
		return $query->result_array(); 
	}      
	   






function get_bv_left($id){
		$this->db->select('SUM(amount) as tamount,type');
		$this->db->from('distribution_amount');
		$this->db->where('type','BV left');
		$this->db->where('user_id',$id);
		$this->db->group_by('user_id');
		//$this->db->group_by('user_id','reward');
		$query = $this->db->get();
		return $query->result_array(); 
	}   

function get_bv_right($id){
		$this->db->select('SUM(amount) as tamount,type');
		$this->db->from('distribution_amount');
		$this->db->where('type','BV right');
		$this->db->where('user_id',$id);
		$this->db->group_by('user_id');
		//$this->db->group_by('user_id','reward');
		$query = $this->db->get();
		return $query->result_array(); 
	} 
	
	 public function get_voucher()
    {
		$this->db->select('*');
		$this->db->from('voucher');
		//$this->db->where('p_id',$ids);
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	 public function get_voucher_by_id($ids)
    {
		$this->db->select('*');
		$this->db->from('voucher');
		$this->db->where('p_id',$ids);
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
/*	public function get_vouchers($ids)
    {
		$this->db->select('*');
		$this->db->from('voucher');
		$this->db->where('user_id',$ids);
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array();  
    }*/
	
	
	
	
	
	
	
	
	
	
	

	function get_product_review($cust_id){
	   $this->db->select('*');
		$this->db->from('reviews');
		$where = "pro_id='$cust_id' AND status='approved'";
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
 public function get_product_by_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('voucher');
		$this->db->where('id',$id);
        $this->db->where('status', 'active');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
public function get_product_by_url($pid)
    {
		
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('p_id',$pid);
        $this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	
	
	
	
	public function get_repurchase_voucher($id)
    {
		
		$this->db->select('s.*,v.image');
		$this->db->from('store_voucher as s');
		$this->db->join('voucher as v', 'v.id = s.voucher_id','left'); 
		$this->db->where('s.user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 public function get_category_list()
    {
       
		$this->db->select('id,c_name,p_id');
		$this->db->from('categorys'); 
		$query = $this->db->get();
		return $query->result_array(); 
    } 	
	
	
	 public function fech_achievers(){ 
		     $this->db->select('*');
		     $this->db->from('gnd_news');
		     $this->db->where('type','achiever');	
		     $this->db->where('status','active');
		     $query = $this->db->get();
		     return $query->result_array();	}
	
	public function add_voucher($data){ 
		$this->db->insert('store_voucher', $data); 
		return TRUE;
	}
	
 public function get_all_voucherss($id){
		
	   $this->db->select('*');
		 $this->db->from('voucher');
   $this->db->where('p_id',$id);	
		 $query = $this->db->get();
		return $query->result_array(); 
   } 
	
	
	
	
}

