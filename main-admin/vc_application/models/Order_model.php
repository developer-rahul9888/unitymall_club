<?php 
class Order_model extends CI_Model {
 
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
    public function get_all_order($sdate,$edate)
    {
		$this->db->select('o.*,c.customer_id');
		$this->db->from('orders as o');
        $this->db->join('customer as c', 'c.id = o.user_id', 'left'); 
		$this->db->order_by('o.id','desc');
		$this->db->where('o.o_date >=',$sdate);
		$this->db->where('o.o_date <=',$edate);
		$query = $this->db->get();
		return $query->result_array();
    } 

	public function get_all_order_item($orderId)
    {
		$this->db->select('*');
		$this->db->from('order_items');
		$this->db->where('order_id',$orderId);
		$query = $this->db->get();
		return $query->result_array();
    }
     public function get_all_store_voucher($sdate,$edate)
    {
		$this->db->select('o.*,c.customer_id,c.f_name,c.phone');
		$this->db->from('store_voucher as o');
        $this->db->join('customer as c', 'c.id = o.user_id', 'left'); 
		$this->db->where('o.date >=',$sdate);
		$this->db->where('o.date <=',$edate);
		$this->db->order_by('o.id','desc'); 
		$query = $this->db->get();
		return $query->result_array();
    } 
  public function get_all_order_id($id)
    {
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

	function store_voucher_codes($data)
    {
		$insert = $this->db->insert('voucher_codes',$data);
	    return $insert;
	}
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_order($data)
    {
		//$insert = $this->db->insert('orders', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_order($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('orders', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

	 function update_store_voucher($id, $data)
    {
		$this->db->where_in('id', $id);
		$this->db->update('store_voucher', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_order($id){
		$this->db->where('id', $id);
		$this->db->delete('orders'); 
	}

public function get_customer_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
public function parent_bliss($id){

	   $this->db->select('c.id,c.parent_customer_id,cj.id as pid,cj.user_level as p_user_level');
		$this->db->from('customer as c');
                $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
public function parent_bliss_result($parent_customer_id){

	   $this->db->select('c.id,c.parent_customer_id,cj.id as pid,cj.user_level as p_user_level');
		$this->db->from('customer as c');
                $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.customer_id',$parent_customer_id);
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
				'status' => 'Pending'					
			); 
		$this->db->insert('distribution_amount', $insert_data); 
	}
public function update_distribution_status($order_id){
         
		$data = array('status'=>'Active');
		$this->db->where('order_id', $order_id);
		$this->db->update('distribution_amount', $data);
		  
		$this->db->select('user_id,amount');
		$this->db->from('distribution_amount');
		$this->db->where('order_id', $order_id);
		$query = $this->db->get();
            if(count($query->result_array()) > 0) {  
			foreach ($query->result() as $row) {
				if($row->user_id != '' && $row->user_id != 0 && $row->amount != '' && $row->amount != 0) {
					$this->add_bliss_amount_in_customer($row->user_id,$row->amount);
					 /***************** SMS Registration ******************/ 
			 /*    $this->db->select('id,phone');
				$this->db->from('customer');
				$this->db->where('id', $row->user_id); 
				$smsquery = $this->db->get();
                if(count($smsquery->result_array())==1) {  
					foreach ($smsquery->result() as $smsrow) { 
				    $sms_msg = urlencode("Congratulations!
Your BSA Account has a credit by update of ".$row->amount." Bliss Perks on ".date('d F Y').". You may Log In & Redeem your perks.\n
Thank you
Team Blisszon");
					$smstext = "http://sms.digimiles.in/bulksms/bulksms?username=di78-blisszon&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$smsrow->phone."&source=BLISSZ&message=".$sms_msg;
					file_get_contents($smstext);
					} 
                } */
				/***************** SMS ******************/
				}
			 }
			}
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

	public function get_order_distribution($id)
    {
		$this->db->select('*');
		$this->db->from('distribution_amount');
		$this->db->where('order_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

	public function get_all_setting(){
    	$this->db->select('*');
		$this->db->from('site_setting');
		//$this->db->where('order_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function update_setting($id,$data){
    $this->db->where('id', $id);
	$this->db->update('site_setting', $data);
	}
}
?>