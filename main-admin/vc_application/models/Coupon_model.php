<?php 
class Coupon_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    
    public function get_all_trans()
    {
		$this->db->select('t.*,c.customer_id');
		$this->db->from('transaction_log as t');
		$this->db->join('customer as c', 't.userid = c.id','left'); 
		$this->db->order_by('t.rdate','asc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    function insert_batch($table,$data)
    {
		$insert = $this->db->insert_batch($table,$data);
	    
	} 
	
	function load_wallet($id,$package,$bliss_amount){
        $sql = "update `customer` set wallet = wallet + $package,bliss_amount=bliss_amount+ $bliss_amount where id='$id'";
        $this->db->query($sql); 
    }
    public function get_all_coupon()
    {
		$this->db->select('*');
		$this->db->from('site_coupon');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function get_all_customer_idds($id)
    {
		$this->db->select('SUM(comm_dis) as comm_dis,id');
		$this->db->from('orders');
		$this->db->where('o_date >=',date('Y-m-d',strtotime('first day of last month')));
		$this->db->where('o_date <',date('Y-m-d',strtotime('last day of last month')));
		$this->db->having('comm_dis >=',50);
		$this->db->where_in('user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
	    public function get_all_coupon1($id)
    {
		$this->db->select('*');
		$this->db->from('site_coupon');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_coupon_id($id)
    {
		$this->db->select('*');
		$this->db->from('site_coupon');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	 
    function store_coupon($data)
    {
		$insert = $this->db->insert('site_coupon', $data);
	    return $insert;
	}
 
    function update_coupon($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('site_coupon', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	} 
	function delete_coupon($id){
		$this->db->where('id', $id);
		$this->db->delete('site_coupon'); 
	}
	
	 
	
	function get_all_pin($sdate,$edate,$status) {
	 	 $this->db->select('*');
		$this->db->from('pins');
		$this->db->where('rdate >=',$sdate);
		$this->db->where('rdate <=',$edate); 
		if($status!=''){
		$this->db->where('status',$status);
		}
		$this->db->order_by('id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
		
		
	}
	
	public function daily_weakly_pin($sdate,$edate,$pin=''){
      $this->db->select('i.*,c.f_name,c.l_name,c.customer_id');
	$this->db->from('pins as i');
	$this->db->join('customer as c','c.customer_id=i.used_by','left');
	$this->db->where('i.used_on >=',$sdate);
	$this->db->where('i.used_on <=',$edate);  
	$this->db->where('i.status','Used'); 
	//if($pin=='pin') { $this->db->where('i.p_amount <',29999); }
	if($pin=='pin') { $this->db->where_in('i.p_amount',array(1500,3000)); $this->db->where('i.re_purchase','0'); }
	if($pin=='repin') { $this->db->where_in('i.p_amount',array(750,1500,2250,3750,7500)); $this->db->where('i.re_purchase','1'); }
	if($pin=='franchise') { $this->db->where('i.p_amount >',29999); }
	
	//$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
      
  }
  
	
	function get_all_package($status='') {
	 	 $this->db->select('*');
		$this->db->from('package');
		if($status!=''){
		$this->db->where('status',$status);
		}
		//$this->db->order_by('id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	function my_transfer_all_pin($sdate,$edate,$userid) {
	 	 $this->db->select('pt.*,p.pinid as pinno,p.p_amount as pinam,c.f_name as cname,p.status as statuss');
		$this->db->from('pins_transfer as pt');
		$this->db->join('pins as p', 'p.id = pt.pinid','left'); 
		$this->db->join('customer as c', 'pt.assign_to = c.customer_id','left'); 
		if($sdate!='') { $this->db->where('pt.rdate >=',$sdate); }
		if($edate!='') { $this->db->where('pt.rdate <=',$edate); }
		if($userid!='') { $this->db->where('pt.assign_to',$userid); }
		$this->db->where('pt.assign_from','AW11111');
		$this->db->order_by('id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	 
	
  public function get_all_pin_id($id)
    {
		$this->db->select('*');
		$this->db->from('pins');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	 public function get_all_package_id($id)
    {
		$this->db->select('*');
		$this->db->from('package');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	 function get_customer_by_id($id)
    {
		$this->db->select('c.*,d.id as did');
		$this->db->from('customer as c');
        $this->db->join('customer as d', 'c.direct_customer_id = d.customer_id', 'left'); 
		$this->db->where('c.customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	 function count_available_pins($id,$number_of_pins,$pinid_type=0)
    {
		$this->db->select('*');
		$this->db->from('pins');
		$this->db->where('p_amount',$id);
		$this->db->where('status','Deactive');
		$this->db->where('assign_to',''); 
		$this->db->where('franchisee',$pinid_type); 
		$this->db->limit($number_of_pins); 
		$query = $this->db->get();
		return $query->result_array();  
    }
    
    function store_pin($data)
    {
		$insert = $this->db->insert('pins', $data);
	    $insert_id = $this->db->insert_id();
	    return $insert_id;
	} 
	function store_package($data)
    {
		$insert = $this->db->insert('package', $data);
	    $insert_id = $this->db->insert_id();
	    return $insert_id;
	} 
	function add_income($data){
	    	$insert = $this->db->insert('incomes', $data);
	    $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	function add_salary($data){
	    $insert = $this->db->insert('salary', $data);
	    $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	function add_franchise_pin($data)
    {
		$insert = $this->db->insert('franchise_pin', $data);
	    $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
 function update_income_status($id){
     $data = array('status'=>'Process');
     $this->db->where('user_id', $id);
		$this->db->update('incomes', $data);
 }
 function update_income_status_clear($id){
     $data = array('status'=>'Clear');
     $this->db->where('user_id', $id);
     $this->db->where('status', 'Process');
		$this->db->update('incomes', $data);
 }
  function update_income_status_all_user($table,$users){
           $data = array('status'=>1);
             $this->db->where('status',0);
             $this->db->where_in('user_id', $users);
	     $this->db->update($table, $data);	
       }

       function update_business_status_all_user($table){
           $data = array('status'=>1);
             $this->db->where('status',0);
             $this->db->where('pay_date <',date('Y-m-d H:i:s'));
	     $this->db->update($table, $data);	
       }
    function update_pin($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('pins', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	} 
	
	 function update_package($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('package', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	} 
	
	function delete_pin($id){
		$this->db->where('id', $id);
		$this->db->delete('pins'); 
	}
	function delete_package($id){
		$this->db->where('id', $id);
		$this->db->delete('package'); 
	}
	function update_profile($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }
	   function update_profile_by_customer_id($id, $data_to_store){ 
             $this->db->where('customer_id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }
      
    function update_consume_user($id,$parent_id,$level){ 
        $data = array('consume'=>1);
             $this->db->where_in('id', $id);
	     $this->db->update('customer', $data);	
       
       $data1 = array('user_level'=>$level);
             $this->db->where('id', $parent_id);
	     $this->db->update('customer', $data1);
	     
       }   
   public function get_all_reward(){
        $this->db->select('r.*,c.f_name,c.l_name,c.customer_id');
		$this->db->from('reward as r');
        $this->db->join('customer as c', 'c.id = r.userid', 'left'); 
		//$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
   function get_reward_by_date($sdate,$edate) {
	 	 $this->db->select('r.*,c.f_name,c.l_name,c.customer_id');
		$this->db->from('reward as r');
		
        $this->db->join('customer as c', 'c.id = r.userid','left'); 
		$this->db->where('r.rdate >=',$sdate);
		$this->db->where('r.rdate <=',$edate); 
		
		$this->db->order_by('id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function get_payout_by_date_table($table) {
	 	 $this->db->select('r.*,SUM(r.amount) as amt,c.id as cid,c.l_name,c.f_name,c.l_name,c.customer_id,c.email,c.phone,c.bank_name,c.account_no,c.ifsc,c.pancard,c.var_status');
		$this->db->from($table.' as r');
        $this->db->join('customer as c', 'c.id = r.user_id','left');
		$this->db->where('r.status','0'); 
		$this->db->group_by('c.id'); 
		
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	 function get_payout_by_date($sdate='',$edate='',$status='') {
	 	 $this->db->select('r.id as rid,b.id as bid,d.id as did,SUM(r.amount) as rtotal_amount,SUM(b.amount) as btotal_amount,SUM(d.amount) as dtotal_amount,c.id as cid,c.l_name,c.f_name,c.l_name,c.customer_id,c.email,c.phone,c.bank_name,c.account_no,c.ifsc,c.pancard');
		$this->db->from('customer as c');
        $this->db->join('binary_income as r', 'c.id = r.user_id AND r.status="0"','left'); 
        $this->db->join('binary_level_income as b', 'c.id = b.user_id AND b.status="0"','left'); 
        $this->db->join('direct_income as d', 'c.id = d.user_id AND d.status="0"','left'); 
	//	if($status!='') { $this->db->where('r.status',$status); }
		$this->db->where('c.id',5); 
		
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
   
   public function parent_bliss($id){
	   $this->db->select('c.id,c.parent_customer_id,cj.id as pid,cj.bsacode as rank, cj.user_level as level');
		$this->db->from('customer as c');
        $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
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
	public function add_reward($parent_id,$order_id,$data,$level){
	    	$insert_data = array(
				'userid' => $parent_id,
				'pinid' => $order_id,
				'description' => $data,					
				'level' => $level,					
			); 
		$this->db->insert('reward', $insert_data); 
	}
	public function get_all_payout_o($status='',$sdate='',$edate=''){
	    $this->db->select('t.*,c.f_name,c.l_name,c.email,c.customer_id,c.phone,c.pancard,c.bank_name,c.account_no,c.ifsc');
		$this->db->from('redeem_bliss as t');
        $this->db->join('customer as c', 't.user_id = c.id', 'left'); 
		if($status!='') { $this->db->where('t.status',$status); }
		if($sdate!='') { $this->db->where('t.rdate >=',$sdate); }
		if($edate!='') { $this->db->where('t.rdate <=',$edate); }
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function get_all_payout($status='',$sdate='',$edate=''){	   
	$this->db->select('t.*,c.f_name,c.l_name,c.email,c.customer_id,c.phone,c.pancard,c.bank_name,c.branch,c.account_no,c.ifsc');		$this->db->from('transaction_log as t');   
	$this->db->join('customer as c', 't.userid = c.id', 'left'); 	
	if($status!='') { $this->db->where('t.status',$status); }	
	if($sdate!='') { $this->db->where('t.rdate >=',$sdate); }	
	if($edate!='') { $this->db->where('t.rdate <=',$edate); }
	$this->db->order_by('t.id','desc');	
	$query = $this->db->get();	
	return $query->result_array(); 	}

	public function get_all_payout_merge($status='',$sdate='',$edate=''){	   
	$this->db->select('t.userid,SUM(t.amount) as amount,SUM(t.tds) as tds,SUM(t.admin) as admin,SUM(t.net_income) as net_income,c.f_name,c.l_name,c.email,c.customer_id,c.phone,c.pancard,c.bank_name,c.branch,c.account_no,c.ifsc');	
	$this->db->from('transaction_log as t');   
	$this->db->join('customer as c', 't.userid = c.id', 'left'); 	
	if($status!='') { $this->db->where('t.status',$status); }	
	if($sdate!='') { $this->db->where('t.rdate >=',$sdate); }	
	if($edate!='') { $this->db->where('t.rdate <=',$edate); }
	$this->db->group_by('t.userid');	
	$this->db->order_by('t.id','desc');	
	$query = $this->db->get();	
	return $query->result_array(); 	}
	
	public function get_all_clear_payout($user='',$sdate='',$edate=''){
	    $this->db->select('t.*,c.f_name,c.l_name,c.email,c.customer_id,c.phone,c.pancard,c.bank_name,c.account_no,c.ifsc');
		$this->db->from('redeem_bliss as t');
        $this->db->join('customer as c', 't.user_id = c.id', 'left'); 
        $this->db->where('t.status','Clear');
		if($user!='') { $this->db->where('t.userid',$user); }
		if($sdate!='') { $this->db->where('t.rdate >=',$sdate); }
		if($edate!='') { $this->db->where('t.rdate <=',$edate); }
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	 function get_payout_by_date_tds($sdate='',$edate='') {
	 	 $this->db->select('t.*,c.f_name,c.l_name,c.email,c.customer_id,c.bank_name,c.branch,c.account_no,c.ifsc,c.pancard');
		$this->db->from('transaction_log as t');
        $this->db->join('customer as c', 'c.id = t.userid','left'); 
		if($sdate!='') { $this->db->where('t.rdate >=',$sdate); }
		if($edate!='') { $this->db->where('t.rdate <=',$edate); }
		$this->db->where('t.status','Clear'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function get_payout_by_date_admin($sdate='',$edate='') {
	 	 $this->db->select('t.*,c.f_name,c.l_name,c.email,c.customer_id,c.bank_name,c.branch,c.account_no,c.ifsc,c.pancard');
		$this->db->from('transaction_log as t');
        $this->db->join('customer as c', 'c.id = t.userid','left'); 
		if($sdate!='') { $this->db->where('t.rdate >=',$sdate); }
		if($edate!='') { $this->db->where('t.rdate <=',$edate); }
		$this->db->where('t.status','Clear'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function add_transactional_log($data){
	    $this->db->insert('transaction_log', $data); 
	} 
	public function update_transactional_log_byid($id,$status,$data){
        $this->db->where('userid', $id);
        $this->db->where('status',$status);
	    $this->db->update('transaction_log', $data);
	}
	public function update_transactional_log($user,$data){
        $this->db->where('userid', $user);
	    $this->db->update('transaction_log', $data);
	}
	public function add_transfer_pin($data){
	    $this->db->insert('pins_transfer', $data); 
	}
}
?>