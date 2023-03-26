<?php 
class Customer_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
    $this->load->database();
    $this->load->helper('url');
    }	
	function get_payout_by_date_table($table,$date) {	 	 
	$this->db->select('r.*,SUM(r.amount) as amt,c.id as cid,c.l_name,c.f_name,c.l_name,c.customer_id,c.email,c.phone,c.bank_name,c.account_no,c.ifsc,c.pancard');
	$this->db->from($table.' as r');  
	$this->db->join('customer as c', 'c.id = r.user_id','left');   	
	$this->db->having('amt >=',10000); 	
	//$this->db->where('r.status','0'); 	
	$this->db->where('r.c_date >=',$date); 	
	$this->db->group_by('c.id'); 		
	$query = $this->db->get();	
	return $query->result_array(); 	}

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
	
	function insert_batch($table,$data)
    { 
	$insert = $this->db->insert_batch($table,$data);
	return $insert;
	}
	public function activity_log()
    {
		
		$this->db->select('*');
		$this->db->from('WorkWith '); 
		//$this->db->where('id_no',$id);
		//$this->db->join('customer','customer.customer_id = w.zkey','left');
		//$this->db->group_by('zkey');
		$this->db->order_by('id_no','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	public function activity_log_by_id($id)
    {
		
		$this->db->select('w.*,customer.f_name,customer.l_name');
		$this->db->from('WorkWith as w'); 
		//$this->db->where('id_no',$id);
		$this->db->join('customer','customer.customer_id = w.zkey','left');
		$this->db->where('w.zkey',$id);
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	
	
	
	
	
	
	
	
	function update_wallet($id,$amount,$type){
    $sql = "update `customer` set $type = $type - $amount where id='$id'";
    $this->db->query($sql); 
    }
	function substract_wallet($id,$amount,$type){
    $sql = "update `customer` set $type = $type + $amount where id='$id'";  
    $this->db->query($sql); 
    }
	
	function substract_wallet_by_bliss($id,$amount,$type){
    $sql = "update `customer` set $type = $type + $amount where customer_id='$id'";  
    $this->db->query($sql); 
    }
	 public function get_all_pin_request_id($id)
    {
		
	$this->db->select('*');
	$this->db->from('pin_request');
	$this->db->where('id',$id);
	$query = $this->db->get();
	return $query->result_array(); 
    }
	public function get_all_franchise() 
    {
		
	$this->db->select('*');
	$this->db->from('customer'); 
	$this->db->where('franchise >',0);
	$query = $this->db->get();
	return $query->result_array();  
    }
	public function get_all_bonanza() 
    {
		
	$this->db->select('*');
	$this->db->from('bonanza'); 
	
	$query = $this->db->get();
	return $query->result_array();  
    }
	
	function update_pin_request($id, $data)
    {
	$this->db->where('id', $id);
	$this->db->update('pin_request', $data);		
    $error = $this->db->error();
    if(empty($error['message'])) { return true; }
    else { return false; }
	}
	
	function get_pin_request_by_date($sdate,$edate) {
	 	 $this->db->select('*');
		//$this->db->select('*');
		$this->db->from('pin_request');
	//	$this->db->join('pins','pins.used_by = c.customer_id','left');
		$this->db->where('date >=',$sdate);
		$this->db->where('date <=',$edate); 
		$this->db->order_by('id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
    public function get_all_customer()
    {
		
		$this->db->select('*');
		$this->db->from('customer'); 
		//$this->db->where('user_id',$uid);
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }


        public function get_monthly_business($sdate,$edate)
    {
		
		$this->db->select('SUM(amount) as total_business');
		$this->db->from('team_bussiness'); 
		$this->db->where('pay_date >=',$sdate);
		$this->db->where('pay_date <=',$edate);
		$this->db->where('pay_level',0);
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	public function get_all_amount($date)
    {
		
		$this->db->select('sum(b_volume)as total');
		$this->db->from('pins'); 
		$this->db->where('status','used');
		
		$this->db->where('used_on>=',$date);

		$query = $this->db->get();
		return $query->result_array();  
    }

    public function get_all_order_amount($date)
    {
		
		$this->db->select('sum(comm_dis)as total');
		$this->db->from('orders'); 
		//$this->db->where('status','Delivered');
		
		$this->db->where('o_date>=',$date);

		$query = $this->db->get();
		return $query->result_array();  
    }

     public function get_all_sale_amount($date)
    {
		
		$this->db->select('sum(bv)as total');
		$this->db->from('total_sale'); 
		
		$this->db->where('tdate>=',$date);

		$query = $this->db->get();
		return $query->result_array();  
    }
	 public function get_all_customer_by_rank($rank)
    {
		$this->db->select('*');
		$this->db->from('customer'); 
		$this->db->where('rank',$rank);
		$query = $this->db->get();
		return $query->result_array();  
    }
     public function get_all_club_achiver_old($count)
    {
		$this->db->select('*');
		$this->db->from('customer'); 
		$this->db->where('matching_count >=',$count);
		$query = $this->db->get();
		return $query->result_array();  
    }

     public function get_all_club_achiver($lbv,$rbv)
    {
		$this->db->select('c.id,c.package_used,c.f_name,customer_id,c.parent_customer_id,c.direct_customer_id,c.position,c.phone,SUM(c.lbv+r.lbv) as lbv,,SUM(c.rbv+r.rbv) as rbv,t.id as tid,o.id as oid');
		$this->db->from('customer as c'); 
		$this->db->join('repurchase_bv as r', 'r.user_id = c.id', 'left'); 
		$this->db->having("((lbv >='$lbv' AND rbv>='$rbv') OR (rbv >='$lbv' AND lbv>='$rbv'))", NULL, FALSE);
		$this->db->join('total_sale as t', 't.customer = c.customer_id AND t.tdate > "'.date('Y-m-d',strtotime('first day of last month')).'" AND t.payment_type != "pin"', 'left');
		$this->db->join('orders as o', 'o.user_id = c.id AND o.o_date > "'.date('Y-m-d',strtotime('first day of last month')).'"', 'left');
		//$this->db->where("((lbv >='$lbv' AND rbv>='$rbv') OR (rbv >='$lbv' AND lbv>='$rbv'))", NULL, FALSE);
		$this->db->group_by('c.id');
		$query = $this->db->get();
		return $query->result_array();  
    }

    public function get_all_club_achiver_date() 
    {
		$this->db->select('id,f_name,customer_id,parent_customer_id,direct_customer_id,phone,royality');
		$this->db->from('customer');
		$this->db->where('royality>',0);
		$query = $this->db->get();
		return $query->result_array();  
    }

    public function matching_count_weekly($id,$sdate,$edate)
    {
		$this->db->select('*');
		$this->db->from('binary_income');
		$this->db->where('user_id',$id);
		$this->db->where('c_date >=',$sdate);
		$this->db->where('c_date <',$edate);
		$query = $this->db->get();
		return $query->result_array();  
    }
	 public function get_all_customer_by_up_req($up_req)
    {
		$this->db->select('c.*,t.id as tid,SUM(t.gtotal) as amt');
		$this->db->from('customer as c'); 
		$this->db->join('total_sale as t', 't.customer = c.customer_id', 'left'); 
		$this->db->where('c.up_req',$up_req);
		$this->db->having('amt >',299);
		$this->db->where('t.payment_type !=','pin');
		$this->db->where('t.tdate >=',date('Y-m-d 00:00:00',strtotime('first day of last month')));
		$this->db->group_by('customer');
		$query = $this->db->get();
		return $query->result_array();
    }
	 public function parent_bliss($id){
	   $this->db->select('c.id,c.parent_customer_id,c.user_level,c.package,cj.id as pid,cj.bsacode as rank, cj.user_level as level');
		$this->db->from('customer as c');
        $this->db->join('customer as cj', 'c.direct_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	 public function get_all_customer_g_by_up_req() 
    {
		
		$this->db->select('*');
		$this->db->from('customer'); 
		$this->db->where('up_req >',0);
		$query = $this->db->get();
		return $query->result_array();  
    }
	
    function get_customer_by_date($sdate,$edate) {
	$this->db->select('c.*,t.id as tid,o.id as oid');
	$this->db->from('customer as c');
	$this->db->join('total_sale as t', 't.customer = c.customer_id AND t.tdate > "'.date('Y-m-d',strtotime('first day of last month')).'" AND t.payment_type != "pin"', 'left');
	$this->db->join('orders as o', 'o.user_id = c.id AND o.o_date > "'.date('Y-m-d',strtotime('first day of last month')).'"', 'left'); 
	$this->db->where('c.rdate >=',$sdate);
	$this->db->where('c.rdate <=',$edate); 
	$this->db->group_by('c.id'); 
	$this->db->order_by('id','desc'); 
	$query = $this->db->get();
	return $query->result_array(); 
	}
	function get_customer_all() {
	  $this->db->select('c.*,t.id as tid');
	$this->db->from('customer as c');
	$this->db->join('total_sale as t', 't.customer = c.customer_id AND t.tdate > "'.date('Y-m-d',strtotime('first day of last month')).'" AND t.payment_type != "pin"', 'left'); 
	$this->db->order_by('id','desc'); 
	$query = $this->db->get();
	return $query->result_array(); 
	}
	
	function get_reward_by_date() {
	  $this->db->select('r.*,c.customer_id,c.f_name,c.l_name,c.phone,c.email,c.direct_customer_id,c.rdate');
	  $this->db->from('reward as r');
	  $this->db->join('customer as c', 'c.id = r.user_id', 'left'); 
	//  $this->db->where('r.c_date >=',$sdate);
	 /// $this->db->where('r.c_date <=',$edate); 
	  $this->db->order_by('r.id','desc'); 
	  $query = $this->db->get();
	  return $query->result_array(); 
	}
	
	function wallet_update_customer($id, $data)
    {
		$this->db->where('customer_id', $id);
		$this->db->update('customer', $data);		
        $error = $this->db->error();
        if(empty($error['message'])) { return true; }
        else { return false; }
	}
	public function get_all_wallet_transaction()
    {
		$this->db->select('w.*,c.f_name,c.customer_id');
		$this->db->from('wallet_summery as w');
		$this->db->join('customer as c', 'c.id = w.user_id', 'left'); 
		$this->db->where('w.status','Approved');
	    $this->db->order_by('w.id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	function transaction_wallet($sdate,$edate){		
	$this->db->select('w.*,c.f_name,c.customer_id');		
	$this->db->from('transaction_wallet as w');
	$this->db->join('customer as c','c.id = w.send_to','left');	
	$this->db->where('w.send_by','Admin');		
	$this->db->where('w.rdate >=',$sdate);		
	$this->db->where('w.rdate <=',$edate); 		
	$this->db->order_by('w.id','desc'); 		
	$query = $this->db->get();		
	return $query->result_array();  
	}
	
	function add_transactional_wallet($data)    {		
	$insert = $this->db->insert('transaction_wallet', $data);	    
	$insert_id = $this->db->insert_id();	    
	return $insert_id;	
	}
	
	function add_bonanza($data)    {		
	$insert = $this->db->insert('bonanza', $data);	    
	$insert_id = $this->db->insert_id();	    
	return TRUE;	
	}

	public function add_wallet_log($data){	    
	$this->db->insert('wallet_summery', $data);  	
	    
	}
	
	
	function update_reward($id, $data)
    {
	$this->db->where('id', $id);
	$this->db->update('reward', $data);		
                
	}
	
	function checkuserid($data)
    {
		$this->db->select('customer_id,bliss_amount,id');
		$this->db->from('customer');
		$this->db->where('customer_id', $data);
		$query = $this->db->get();
        return $query->result_array(); 
	
	}
	
	
	
	public function get_all_customer1($id)
    {
		$this->db->select('*');
		$this->db->from(customer);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_customer_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	 public function get_all_bonanza_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('bonanza');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_customer($data)
    {
		$insert = $this->db->insert('customer', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_customer($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('customer', $data);		
        $error = $this->db->error();
        if(empty($error['message'])) { return true; }
        else { return false; }
	}
	
	 function update_bonanza($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('bonanza', $data);		
        $error = $this->db->error();
        if(empty($error['message'])) { return true; }
        else { return false; }
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	function parent_profile($blissid){
	$this->db->select('*');
	$this->db->from('customer');
	$this->db->where('customer_id',$blissid);
	$query = $this->db->get();
	return $query->result_array(); 
	}
	
	function transaction_log(){
	$this->db->select('*');
	$this->db->from('turnover_income');
	$this->db->order_by('id','desc');
	$this->db->limit(1);

	$query = $this->db->get();
	return $query->result_array(); 
	}

	function delete_customer($id){
	$this->db->where('id', $id);
	$this->db->delete('customer'); 
	}
}
?>