<?php 
class Checkout_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }
		public function add_data_in_table($data,$table){
	   $insert = $this->db->insert($table, $data);
   }
   public function add_transactions($data){ 
		$this->db->insert('transaction_wallet', $data); 
	}
	public function add_childress($data){ 
		$this->db->insert('children', $data); 
	}
     public function get_autopool_by_id($id)
    {
		$this->db->select('a.*,c.user_level,c.sbv,l.level_1,l.level_2,l.level_3,l.level_4,l.level_5,l.level_6');
		$this->db->from('matrix as a');
		$this->db->join('customer as c','c.id = a.user_id','left');
		$this->db->join('children as l','l.user_id = a.user_id','left');
		$this->db->where('a.id',$id);
		$query = $this->db->get();
		return $query->result_array();  
    }

    public function get_all_active_user()
    {
		$this->db->select('*');
		$this->db->from('matrix_o');
		$this->db->where('id >',1);
		$this->db->order_by('id','asc');
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
     public function autopool_team($placement_id)
    {
		$this->db->select('m.*,c.sbv');
		$this->db->from('matrix as m');
		$this->db->join('customer as c','c.id = m.user_id','left');
		$this->db->where_in('m.parent_id',$placement_id);
		$this->db->order_by("m.id", "asc");
		$query = $this->db->get();
		return $query->result_array();  
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
    function insert_autopool_data($data_to){
		$this->db->insert('matrix',$data_to);
		$insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	function update_autopool_child_num($placement_id){
	$sql="UPDATE matrix SET children=children+1 WHERE id=".$placement_id."";    
    $query = $this->db->query($sql);
		
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
    function update_stock($id,$amount,$type){
        $sql = "update `product` set $type = $type - $amount where id='$id'";
        $this->db->query($sql); 
    }
		 public function get_reuser_with_direct_info($directid){
       $this->db->select('c.*,d.id as did,d.customer_id as dcustomer_id,d.bsacode as dbsacode,d.direct as ddirect,d.booster as dbooster,d.package_used as dpackage_used,d.sbv as dsbv');
		$this->db->from('customer as c');
		$this->db->join('customer as d', 'c.direct_customer_id = d.customer_id', 'left'); 
		//$this->db->join('team_bussiness as b', 'b.user_id = c.id', 'left'); 
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
	  public function get_pv_by_rank($id,$rank=''){ 
		$this->db->select('count(id) as count,sale_type,type');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id);
		$this->db->where('status','Active');
		$this->db->where('type',$rank);
		$this->db->where('sale_type >',0);
		$this->db->group_by('sale_type');
		$this->db->having('count >=',2);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	   public function get_pv_team($id){ 
		$this->db->select('SUM(amount) as amount,user_id');
		$this->db->from('team_bussiness');
		$this->db->where('user_id',$id);
		$this->db->group_by('user_id');
		$query = $this->db->get();
		return $query->result_array(); 
   }
	public function update_batch($table,$data,$col){
	  $this->db->update_batch($table,$data,$col);
	  return TRUE;
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
   public function get_bonanza(){ 
		$this->db->select('*');
		$this->db->from('bonanza');
		$this->db->where('status','Active');
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
   public function update_gbv_status_by_ids($ids){
		$data = array('status'=>'Redeem','pay_date'=>date('Y-m-d H:i:s'));
		$this->db->where_in('id',$ids);
		$this->db->update('distribution_amount', $data);
	}
	function load_wallet($id,$amount,$column){
        $sql = "update `customer` set $column = $column + $amount where id='$id'";
        $this->db->query($sql); 
    }

    function load_children($id,$amount,$column){
        $sql = "update `children` set $column = $column + $amount where user_id='$id'";
        $this->db->query($sql); 
    }

	function load_wallet_by_repurchase($id,$amount,$column){
        $sql = "update `repurchase_bv` set $column = $column + $amount where user_id='$id'";
        $this->db->query($sql); 
    }
	 /*function profile_by_customer_id($id) {
		$this->db->select('c.id,c.f_name,c.l_name,c.parent_customer_id,c.customer_id,c.rank,c.direct_customer_id,c.bsacode,c.position,c.consume,c.user_level,c.status,c.package_used,c.rdate,c.reward,c.package,bv.id as bid,bv.lbv,bv.rbv,bv.plcount,bv.prcount,bv.sbv,c.left_direct,c.right_direct');
		$this->db->from('customer as c');
		$this->db->join('repurchase_bv as bv', 'c.id = bv.user_id', 'left'); 
		$this->db->where('c.customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}*/

	function profile_by_customer_id($id){
		$this->db->select('id,f_name,l_name,parent_customer_id,customer_id,direct_customer_id,bsacode,position,user_level,capping,status,package_used,rdate,reward,package,sbv,direct,left_direct,right_direct,consume,rank');
		$this->db->from('customer');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
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
	function get_left_right_sb_for_bonanza($id,$sdate,$edate){
		$this->db->select('SUM(amount) as amount,type');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$id);
		$this->db->where('sale_type',2);
		$this->db->where('user_id_send_by >',0);
		$this->db->where('pay_date >=',$sdate);
		$this->db->where('pay_date <=',$edate);
		$this->db->like('type','BV');
		$this->db->group_by('type');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public function insert_batch($table,$data){
	  $this->db->insert_batch($table,$data);
	  return TRUE;
	}
	public function insert_table_data($table,$data){
	  $this->db->insert($table,$data);
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
   public function add_order($data){
	   
	   $insert = $this->db->insert('orders', $data);
	   $insert_id = $this->db->insert_id();
	    return $insert_id;
   }
   public function get_all_diamond_bdm(){
	   $this->db->select('id');
		$this->db->from('customer');
		$this->db->where('bsacode','Diamond BDM');
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
     public function get_all_reward($id,$rdate){
	   $this->db->select('*');
		$this->db->from('reward');
		$this->db->where('user_id',$id);
		$this->db->where('pay_date >=',$rdate);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function get_parent_child_bdm($customer_id){
	   $this->db->select('id');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$customer_id);
		$this->db->where('bsacode','BDM');
		$query = $this->db->get();
		return $query->result_array(); 
   }

    public function check_pincodes($pincode){
	   $this->db->select('id');
		$this->db->from('pincodes');
		$this->db->where('pincode',$pincode);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
   public function bliss_web_stores(){
         
		$this->db->select('*');
		$this->db->from('webstores');
		//$this->db->where('c_name',$name);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function parent_bliss($id){
	   $this->db->select('c.id,c.user_level,c.parent_customer_id,cj.id as pid,cj.bsacode as rank');
		$this->db->from('customer as c');
        $this->db->join('customer as cj', 'c.direct_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
	public function parent_bliss_result($parent_customer_id){
	   $this->db->select('c.id,c.parent_customer_id,cj.id as pid');
		$this->db->from('customer as c');
                $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.customer_id',$parent_customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	
	public function update_distribution_status($order_id){
         
		/*$data = array('status'=>'Active');
		$this->db->where('order_id', $order_id);
		$this->db->update('distribution_amount', $data);*/
		
		$data_order = array('status'=>'Accepted');
		$this->db->where('id', $order_id);
		$this->db->update('orders', $data_order);
		
		/*$this->db->select('user_id,amount');
		$this->db->from('distribution_amount');
		$this->db->where('order_id', $order_id);
		$query = $this->db->get();*/
            
	} 

	public function update_emi_status($order_id){
          
		
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id', $order_id);
		$query = $this->db->get();
            if(count($query->result_array()) > 0) {  
			foreach ($query->result() as $row) {
				if($row->emi!='no') {
					$emi_info = json_decode($row->emi_info,true);
					$emi_info['last_date'] = date('Y-m-d h:i:s');
					$emi_info['total_payment'] = $row->total_amount .'-'. $row->emi;
					$emiinfoarray = json_encode($emi_info);
					$data_to_store_order = array('total_amount'=>$emi_info['total_amount'],'status'=>'Accepted','emi' => 'yes','emi_info'=>$emiinfoarray); 
					$this->db->where('id', $order_id);
					$this->db->update('orders', $data_to_store_order);
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
	
	function add_distribution($data)
    {
		$insert = $this->db->insert('distribution_amount', $data);
		return $insert;
	}
	   	public function add_income($data){ 
		$this->db->insert('incomes', $data); 
	}
	public function add_distribution_amount($amount,$userid,$level,$order_id){
         
		$cust_id = $this->session->userdata('cust_id');
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
	
       public function get_distributer_amount_by_userid($userid){
         
		$this->db->select('*');
		$this->db->from('distribution_amount');
		$this->db->where('user_id',$userid);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	function get_child_id($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
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

	function get_order_by_id($oid){ 
	
		$this->db->select('*');
		$this->db->from('orders'); 
		$this->db->where('id',$oid);
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
	function parent_profile($id){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
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

}
?>