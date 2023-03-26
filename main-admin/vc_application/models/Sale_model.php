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
	
	//function get_customer_by_date($sdate,$edate) {
	 	 //$this->db->select('c.*,t.id as tid');
		//$this->db->from('total_sale as c');
		//$this->db->join('total_sale as t', 't.customer = c.customer_id AND t.tdate > "'.date('Y-m-d',strtotime('first day //of last month')).'" AND t.payment_type != "pin"', 'left'); 
		///$this->db->where('c.rdate >=',$sdate);
		//$this->db->where('c.rdate <=',$edate); 
		//$this->db->order_by('id','desc'); 
		//$query = $this->db->get();
		//return $query->result_array(); 
	//}
    public function update_distribution_amount($p,$ids,$sale_type,$data){
		
	$this->db->where_in('user_id',$p);
	$this->db->where('user_id_send_by',$ids);
	$this->db->like('type','BV');
	$this->db->like('pay_date',date('Y-m-d'));
	$this->db->like('sale_type',$sale_type);
	  $this->db->update('distribution_amount',$data);
	  return TRUE;
	}
 public function load_wallet($id,$amount,$column){
        $sql = "update `customer` set $column = $column + $amount where id='$id'";
        $this->db->query($sql); 
    }
	public function get_matching_pv_by_date($id,$this_week_sd,$this_week_ed,$sale_type=''){ 
	$this->db->select('SUM(amount) as redeem_pv');
	$this->db->from('distribution_amount');	
	$this->db->where('user_id',$id);
	if($sale_type!='') { $this->db->where('sale_type',$sale_type); }	
	$this->db->where('type','Matching');
	if($this_week_sd!='') { $this->db->where('pay_date >=',$this_week_sd); }	
	if($this_week_ed!='') { $this->db->where('pay_date <=',$this_week_ed); } 	
	$query = $this->db->get();		return $query->result_array();  
	}  
	 public function get_send_franchise_stock_id()
    {
		$this->db->select('c.customer_id,c.f_name,c.l_name,p.pname,s.id,s.stock_send_qty,s.qty,s.date'); 
		$this->db->from('stock_detail as s');
		$this->db->join('customer as c','c.id=s.user_id','left');
		$this->db->join('product as p','s.p_id=p.id','left'); 
	/* 	$this->db->where('user_id',$id);
		$this->db->where('p_id',$p_id); */ 
		$query = $this->db->get();
		 return $query->result_array();  
    }  
	 
	public function get_customer_from_pin() {
	 	 $this->db->select('*');
		$this->db->from('pins');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	  public function get_matching_pv_by_date111($id,$date){ 
		$this->db->select('SUM(amount) as redeem_pv');
		$this->db->from('repurchase_income');
		$this->db->where('user_id',$id);
		//$this->db->where('status','Redeem');
		
		//$this->db->where('type','Matching');
		$this->db->like('c_date',$date);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	
	
	
	
	public function update_profile($id, $data_to_store){    
 	$this->db->where('id', $id);	 
    $this->db->update('customer', $data_to_store);	  
	return TRUE;     	}	
	
	
	public function add_data_in_table($data,$table){
	   $insert = $this->db->insert($table, $data);
   }
   	
	
	 public function profile_by_customer_id($id) {
		$this->db->select('c.id,c.f_name,c.l_name,c.parent_customer_id,c.customer_id,c.rank,c.direct_customer_id,c.bsacode,c.position,c.consume,c.user_level,c.status,c.package_used,c.rdate,c.reward,c.package,bv.id as bid,bv.lbv,bv.rbv,bv.plcount,bv.prcount,bv.sbv,c.left_direct,c.right_direct');
		$this->db->from('customer as c');
		$this->db->join('repurchase_bv as bv', 'c.id = bv.user_id', 'left'); 
		$this->db->where('c.customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
		public function get_left_right_sb($id){
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
         public function insert_batch($table,$data){
	  $this->db->insert_batch($table,$data);
	  return TRUE;
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
  public function get_left_right_sb_for_bonanza($id,$sdate,$edate){
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
	public function update_batch($table,$data,$col){	
	$this->db->update_batch($table,$data,$col);	 
	return TRUE;	
	}	
	
	public function load_wallet_by_repurchase($id,$amount,$column){  
	$sql = "update `repurchase_bv` set $column = $column + $amount where user_id='$id'";     
	$this->db->query($sql); 
 	}
    /**
    * Get sale by his is
    * @param int $sale_id 
    * @return array
    */
     
    public function get_all_sale($sdate,$edate)
    {
		$this->db->select('t.*,c.customer_id');
		$this->db->from('total_sale as t');
		$this->db->join('customer as c', 'c.id = t.center_id', 'left'); 	
		$this->db->where('tdate >=',$sdate);
		$this->db->where('tdate <=',$edate); 
		$this->db->where('pin_bill',0);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }

	public function get_all_pin_sale($sdate,$edate)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('pin_bill',1);
		$this->db->where('tdate >=',$sdate);
		$this->db->where('tdate <=',$edate); 
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_all_total_sale($sdate,$edate)
    {
		$this->db->select('s.*,c.customer_id,c.f_name,c.l_name,c.pancard,c.bank_name,c.branch,c.account_no,c.ifsc');
		$this->db->from('orders as s');
		 $this->db->join('customer as c', 's.user_id = c.id', 'left'); 
		 $this->db->where('s.o_date >=',$sdate);
		$this->db->where('s.o_date <=',$edate); 
		$this->db->where('s.status !=','Process'); 
		$this->db->order_by('s.id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }

	public function get_all_total_order_items($sdate,$edate)
    {
		$this->db->select('i.*,o.id as invoice,o.p_address,o.p_state,p.hsn,c.customer_id,c.f_name,c.l_name,c.pancard,c.bank_name,c.branch,c.account_no,c.ifsc');
		$this->db->from('order_items as i');
		$this->db->join('orders as o', 'o.id = i.order_id', 'left');
		$this->db->join('customer as c', 'o.user_id = c.id', 'left');
		$this->db->join('product as p', 'i.product_id = p.id', 'left');
		$this->db->where('i.rdate >=',$sdate);
		$this->db->where('i.rdate <=',$edate); 
		$this->db->where('o.status !=','Process'); 
		$this->db->order_by('i.id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_prodcut_sale($id='')
    {
		$this->db->select('*');
		$this->db->from('product_sale');
		if($id!='') { $this->db->where('id',$id); }
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_sale_id($id)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	 public function get_all_franchise_stock_id($id,$p_id)
    {
		$this->db->select('*');
		$this->db->from('stock_detail');
		$this->db->where('user_id',$id);
		$this->db->where('p_id',$p_id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function get_customer_by_id($id)
    {
		$this->db->select('c.*, d.id as did,d.customer_id as dcustomer_id, d.f_name as df_name, d.l_name as dl_name,d.user_level as duser_level,d.up_req as dup_req,d.direct as ddirect');
		$this->db->from('customer as c');
		$this->db->join('customer as d','c.direct_customer_id=d.customer_id','left');
		$this->db->where('c.customer_id',$id);
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

    public function get_all_product()
    {
		$this->db->select('*');
		$this->db->from('product');
		$query = $this->db->get();
		return $query->result_array(); 
    }
      public function get_all_free_product($id)
    {
		$this->db->select('*');
		$this->db->from('product_free');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
     public function store_product_sale($data)
    {
		$insert = $this->db->insert('product_sale', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	
	  public function store_franchise_stock($data)
    {
		$insert = $this->db->insert('stock_detail', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
    public function store_sale($data)
    {
		$insert = $this->db->insert('total_sale', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
    public function store_distribution_amount($data)
    {
		$insert = $this->db->insert('distribution_amount', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
   public function update_customer_distribution_amount($amount,$customer){
    $this->db->query("update customer set bliss_amount = bliss_amount + ".$amount." where customer_id='".$customer."'");
   }

    /**
    * Update sale
    * @param array $data - associative array with data to store
    * @return boolean
    */
    public function update_table($id, $data,$table)
    {
		$this->db->where('id', $id);
		$this->db->update($table, $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	
    public function update_sale($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('orders', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	public function update_prodcut_qty($id,$qty){
	$sql = "UPDATE `product` SET `p_qty`= p_qty - $qty WHERE id ='$id'";
	 //$this->db->where('id', $id);
	     $this->db->query($sql);	
            return TRUE;
    }

    /**
    * Delete sale
    * @param int $id - sale id
    * @return boolean
    */
	
	
	public function delete_sale($id){
		$this->db->where('id', $id);
		$this->db->delete('total_sale'); 
	}
	public function delete_stock_detail($id){
		$this->db->where('id', $id);
		$this->db->delete('stock_detail'); 
	}
	public function delete_prodcut_sale($id){
		$this->db->where('id', $id);
		$this->db->delete('product_sale'); 
	}
	
	public function get_all_tax()
    {
		$this->db->select('id,amount,title,type');
		$this->db->from('tax');
		$query = $this->db->get();
		return $query->result_array(); 
    }
  
 
	
	public function update_product_qty($id,$qty) {
    $this->db->query("update product set p_qty = p_qty - ".$qty." where id='".$id."'");
  }
  
  public function update_free_product_qty($id,$qty) {
       $this->db->query("update product_free set p_qty = p_qty - ".$qty." where id='".$id."'");
  }
  
  public function update_franchise_stock_qty($id,$qty) { 
       $this->db->query("update stock_detail set qty = qty + ".$qty." where id='".$id."'");
  }

  public function add_distribution($data)
    {
		$insert = $this->db->insert('distribution_amount', $data);
		return $insert;
	}
	public function add_distribution_amount($amount,$userid,$level,$order_id){
         $admin_db = $this->load->database('ADMINDB', TRUE);
		$cust_id = $this->session->userdata('cust_id');
		$insert_data = array(
				'user_id' => $userid,
				'amount' => $amount,
				'user_id_send_by' => $cust_id,
				'pay_level' => $level,
				'order_id' => $order_id,
				'status' => 'Pending'
			); 
		$admin_db->insert('distribution_amount', $insert_data); 
	}

   public function parent_bliss($id){
	   $this->db->select('c.id,c.parent_customer_id,c.rank,cj.id as pid');
		$this->db->from('customer as c');
        $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
	public function parent_bliss_result($parent_customer_id){
	   $this->db->select('c.id,c.parent_customer_id,c.rank,cj.id as pid');
		$this->db->from('customer as c');
                $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.customer_id',$parent_customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
   }

	public function my_friends($cust_id){
	   $this->db->select('c1.id,c1.f_name,c1.l_name,c1.customer_id,c1.rank, c2.rank as p_rank, c2.id as p_id,c2.customer_id as p_customer_id');
		$this->db->from('customer c1');
                $this->db->join('customer c2', 'c1.parent_customer_id = c2.customer_id','left');
		$this->db->where('c1.parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function my_parent($cust_id){
	   $this->db->select('c1.id,c1.f_name,c1.l_name,c1.customer_id,c1.rank, c2.rank as p_rank, c2.id as p_id,c2.customer_id as p_customer_id');
		$this->db->from('customer c1');
                $this->db->join('customer c2', 'c1.parent_customer_id = c2.customer_id','left');
		$this->db->where('c1.customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function get_customer_package($cust_id){
	   $this->db->select('id,parent_customer_id,customer_id,package');
		$this->db->from('customer'); 
		$this->db->where('customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function distribution_by_rank($cust_id,$rank){
	   $this->db->select('*');
		$this->db->from('distribution_amount'); 
		$this->db->where('user_id',$cust_id);
		$this->db->where('rank',$rank);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	public function all_daily_weakly_in($sdate,$edate){
	$this->db->select('i.*,c.f_name,c.l_name,c.customer_id,c1.f_name as df_name,c1.l_name as dl_name,c1.customer_id as dcustomer_id');
	$this->db->from('incomes as i');
	$this->db->join('customer as c','c.id=i.user_id','left');
	$this->db->join('customer as c1','c1.customer_id=c.direct_customer_id','left');
	$this->db->where('i.rdate >=',$sdate);
	$this->db->where('i.rdate <=',$edate);  
	//$this->db->where('i.status','Active');
	$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 
 public function daily_weakly_in_by_table($table,$sdate,$edate){
	$this->db->select('i.*,c.f_name,c.l_name,c.customer_id,c1.f_name as df_name,c1.l_name as dl_name,c1.customer_id as dcustomer_id');
	$this->db->from($table.' as i');
	$this->db->join('customer as c','c.id=i.user_id','left');
	$this->db->join('customer as c1','c1.customer_id=c.direct_customer_id','left');
	$this->db->where('i.c_date >=',$sdate);
	$this->db->where('i.c_date <=',$edate);  
	//$this->db->where('i.status','Active');
	$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 
	public function daily_weakly_in($sdate,$edate){
	$this->db->select('i.*,c.f_name,c.l_name,c.customer_id,c1.f_name as df_name,c1.l_name as dl_name,c1.customer_id as dcustomer_id');
	$this->db->from('incomes as i');
	$this->db->join('customer as c','c.id=i.user_id','left');
	$this->db->join('customer as c1','c1.customer_id=c.direct_customer_id','left');
	$this->db->where('i.rdate >=',$sdate);
	$this->db->where('i.rdate <=',$edate);  
	$this->db->where('i.status','Active');
	$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 
  public function cut_off_report($sdate,$edate){ 
   $this->db->select('i.*,c.f_name,c.l_name,c.customer_id');
   $this->db->from('distribution_amount as i');
   $this->db->join('customer as c','c.id=i.user_id','left');
   $this->db->where('i.pay_date >=',$sdate);
  $this->db->where('i.pay_date <=',$edate);  
	$this->db->where('i.status','Cutoff');
	//$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
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
  
  
    public function insert_table_data($table,$data){
    $this->db->insert($table,$data);
	return TRUE;
	}
	
	public function update_gbv_status_by_ids($ids){
	$data = array('status'=>'Redeem','pay_date'=>date('Y-m-d'));
	$this->db->where_in('id', $ids);
	$this->db->update('distribution_amount', $data);
	}
	
   public function get_matching_pv($id){ 
	$this->db->select('SUM(amount) as total_pv');
	$this->db->from('repurchase_income');
	$this->db->where('user_id',$id);
	//$this->db->where('type','Matching');
	//if($sale_type!='') { $this->db->where('sale_type',$sale_type); }
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
	
	
}
?>