<?php 
class Sale_model extends CI_Model {
 
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
    * Get sale by his is
    * @param int $sale_id 
    * @return array
    */
  public function get_all_free_product($id)
    {
		$this->db->select('*');
		$this->db->from('product_free');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
     public function update_free_product_qty($id,$qty) {
       $this->db->query("update product_free set p_qty = p_qty - ".$qty." where id='".$id."'");
  }
    public function get_reuser_with_direct_info($directid){
       $this->db->select('c.*,d.id as did,d.customer_id as dcustomer_id,d.bsacode as dbsacode,d.direct as ddirect,SUM(b.amount) as amount,user_id');
		$this->db->from('customer as c');
		$this->db->join('customer as d', 'c.direct_customer_id = d.customer_id', 'left'); 
		$this->db->join('team_bussiness as b', 'b.user_id = c.id', 'left'); 
		$this->db->where('c.customer_id',$directid);
		$this->db->group_by('c.id');
		$query = $this->db->get();
		return $query->result_array(); 
   }

   public function get_reuser_with_direct_info_by_id($directid){
       $this->db->select('c.*,d.id as did,d.customer_id as dcustomer_id,d.bsacode as dbsacode,d.direct as ddirect,SUM(b.amount) as amount,user_id');
		$this->db->from('customer as c');
		$this->db->join('customer as d', 'c.direct_customer_id = d.customer_id', 'left'); 
		$this->db->join('team_bussiness as b', 'b.user_id = c.id', 'left'); 
		$this->db->where('c.id',$directid);
		$this->db->group_by('c.id');
		$query = $this->db->get();
		return $query->result_array(); 
   }
     public function parent_bliss($id){
	   $this->db->select('c.id,c.parent_customer_id,c.rank,cj.id as pid');
		$this->db->from('customer as c');
        $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   	public function get_all_stock_detail_sale($id)
    {
		$this->db->select('s.*,p.pname,p.p_d_price,p.comm_dis');
		$this->db->from('stock_detail as s');
		$this->db->join('product as p', 's.p_id = p.id');
		$this->db->where('s.user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
     public function insert_table_data($table,$data){
	  $this->db->insert($table,$data);
	  return TRUE;
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
    public function get_matching_pv_by_date($id,$this_week_sd,$sale_type=''){ 
		$this->db->select('SUM(amount) as redeem_pv');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id);
		if($sale_type!='') { $this->db->where('sale_type',$sale_type); }
		$this->db->where('type','Matching');	
		if($this_week_sd!='') { $this->db->like('pay_date',$this_week_sd); }
		$query = $this->db->get();
		return $query->result_array(); 
   }
    public function get_matching_pv($id,$sale_type=''){ 
		$this->db->select('SUM(amount) as total_pv');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id);
		$this->db->where('type','Matching');
		if($sale_type!='') { $this->db->where('sale_type',$sale_type); }
		$query = $this->db->get();
		return $query->result_array(); 
   }
   function add_distribution($data)
    {
		$insert = $this->db->insert('distribution_amount', $data);
		return $insert;
	}
     public function update_gbv_status_by_ids($ids){
		$data = array('status'=>'Redeem','pay_date'=>date('Y-m-d H:i:s'));
		$this->db->where_in('id',$ids);
		$this->db->update('distribution_amount', $data);
	}
		
    public function get_reuser_with_direct_info_direct($directid){
       $this->db->select('c.*,d.id as did,d.customer_id as dcustomer_id,d.bsacode as dbsacode,d.direct as ddirect,SUM(b.amount) as amount,user_id');
		$this->db->from('customer as c');
		$this->db->join('customer as d', 'c.direct_customer_id = d.customer_id', 'left'); 
		$this->db->join('team_bussiness as b', 'b.user_id = c.id', 'left'); 
		$this->db->where('c.direct_customer_id',$directid);
		$this->db->group_by('c.id'); 
		$this->db->order_by('amount','desc');
		$query = $this->db->get();
		return $query->result_array(); 
   }
      public function get_bonanza(){ 
		$this->db->select('*');
		$this->db->from('bonanza');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   function get_left_right_sb_for_bonanza($id,$sdate,$edate){
		$this->db->select('SUM(amount) as amount,type');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id);
		$this->db->where('sale_type',2);
		$this->db->where('status','Active');
		$this->db->where('pay_date >=',$sdate);
		$this->db->where('pay_date <=',$edate);
		$this->db->like('type','BV');
		$this->db->group_by('type');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	 public function get_all_reward($id,$rdate){
	   $this->db->select('id');
		$this->db->from('reward');
		$this->db->where('user_id',$id);
		$this->db->where('pay_date >=',$rdate);
		$query = $this->db->get();
		return $query->result_array(); 
   }
    public function get_user_bonanza($id,$bonanza_id){
	   $this->db->select('id');
		$this->db->from('reward');
		$this->db->where('user_id',$id);
		$this->db->where('bonanza_id',$bonanza_id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	 function get_customer_by_id($id)
    {
		$this->db->select('c.*, d.id as did,d.customer_id as dcustomer_id, d.f_name as df_name, d.l_name as dl_name,d.user_level as duser_level,d.up_req as dup_req,d.direct as ddirect');
		$this->db->from('customer as c');
		$this->db->join('customer as d','c.direct_customer_id=d.customer_id','left');
		$this->db->where('c.customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    function load_wallet($id,$amount,$column){
        $sql = "update `customer` set $column = $column + $amount where id='$id'";
        $this->db->query($sql); 
    }
    function update_profile($id, $data_to_store){    
 	$this->db->where('id', $id);	 
    $this->db->update('customer', $data_to_store);	  
	return TRUE;     	}	

		function get_left_right_sb($id){
		$this->db->select('SUM(amount) as amount,type');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id);
		$this->db->where('sale_type',2);
		$this->db->where('status','Active');
		$this->db->like('type','BV');
		$this->db->group_by('type');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function profile_by_customer_id($id){
		$this->db->select('id,f_name,l_name,parent_customer_id,customer_id,direct_customer_id,bsacode,position,user_level,capping,status,package_used,rdate,reward,package,lbv,rbv,left_count,right_count,plcount,prcount,direct,left_direct,right_direct,left_sale,right_sale,consume,sbv,rank,capping');
		$this->db->from('customer');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function insert_batch($table,$data){
	  $this->db->insert_batch($table,$data);
	  return TRUE;
	}
	public function add_data_in_table($data,$table){
	   $insert = $this->db->insert($table, $data);
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
	public function update_batch($table,$data,$col){	
	$this->db->update_batch($table,$data,$col);	 
	return TRUE;	
	}	
	public function get_all_pin_sale($id)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('customer',$id);
		$this->db->where('pin_bill',1);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_all_sale_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('customer',$id);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    	public function get_all_wallet_history($id,$sdate,$edate)
    {
		$this->db->select('*');
		$this->db->from('credit_debit');
		$this->db->where('user_id',$id);
	    $this->db->where('receive_date >=',$sdate);
		$this->db->where('receive_date <=',$edate);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    	public function get_all_repurchase_wallet_history($id,$sdate,$edate)
    {
		$this->db->select('*');
		$this->db->from('repurchase_wallet');
		$this->db->where('user_id',$id);
	    $this->db->where('receive_date >=',$sdate);
		$this->db->where('receive_date <=',$edate);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
    public function add_income($data){ 
		$this->db->insert('incomes', $data); 
	}
	
	function profile($id){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	

	
		function profile_by_id($id){
		$this->db->select('c.*,m.id as did');
		$this->db->from('customer as c');
		$this->db->join('customer as m', 'c.direct_customer_id = m.customer_id');
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
    public function get_all_sale($id)
    {
		$this->db->select('t.*,m.city');
		$this->db->from('total_sale as t');
		$this->db->join('customer as m', 'm.id = t.center_id');				$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function get_all_merchant_sale($id)
    {
		$this->db->select('t.*,m.city');
		$this->db->from('total_sale as t');
		$this->db->join('customer as m', 'm.id = t.center_id');
		$this->db->where('t.center_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    
    
    
    
	    public function get_center_detail($id)
    {
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 

	public function get_all_sale1($id)
    {
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_sale_id($id)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		//$this->db->where('center_id',$uid);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	 
public function get_customer_info($id)
    {
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_all_product($id)
    {
		$this->db->select('s.*,p.*');
		$this->db->from('stock_detail as s');
		$this->db->join('product as p','p.id=s.p_id','left');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_sale($data)
    {
		$insert = $this->db->insert('total_sale', $data);
	    return $insert;
	}

    /**
    * Update sale
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_sale($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('orders', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete sale
    * @param int $id - sale id
    * @return boolean
    */
	
	
	function delete_sale($id){
		$this->db->where('id', $id);
		$this->db->delete('orders'); 
	}
	
	public function get_all_tax()
    {
		$this->db->select('id,amount,title,type');
		$this->db->from('tax');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	   public function update_product_qty($id,$qty) {
       $this->db->query("update product set qty = qty - ".$qty." where id='".$id."'");
	   
	   }
	    public function update_stock_qty($id,$p_id,$qty) {
       $this->db->query("update stock_detail set qty = qty - ".$qty." where p_id='".$p_id."' AND user_id='".$id."'");
  }

}
?>