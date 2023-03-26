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

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */

    public function get_voucher()
    {
		$this->db->select('*');
		$this->db->from('voucher');
		//$this->db->where('p_id',$ids);
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array();  
    }
       function update_user_wallet($id,$package){
        $sql = "update `customer` set bliss_amount = bliss_amount + $package  where id='$id'";
        $this->db->query($sql); 
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
    function update_order_status($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('transaction_summery', $data_to_store);	
            return TRUE;
       }
	public function get_slider()
    {
		$this->db->select('*');
		$this->db->from('gallery'); 
		$this->db->where('type','slider');
		$this->db->where('status','active');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    	public function fech_franchise()
    {
		$this->db->select('f_name,l_name,address,city,state');
		$this->db->from('customer'); 
		$this->db->where('franchise','1');
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
	 function all_cus(){
	  
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id >',0);
		$this->db->where('id <=',100); 
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	function my_bliss_amount_by_pos($uid,$type){
	  
		$this->db->select('SUM(amount) as amount');
		$this->db->from('distribution_amount'); 
		$this->db->where('user_id',$uid);
		$this->db->where('type',$type);
		$this->db->order_by('order_id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	} 
	
	public function update_batch($table,$data,$col){
	  $this->db->update_batch($table,$data,$col);
	  return TRUE;
	}
	public function insert_batch($table,$data){
	  $this->db->insert_batch($table,$data);
	  return TRUE;
	}
	 public function get_all_pin_by_table($table)
    {
		$this->db->select('t.id,d.id as pin_no');
		$this->db->from($table.' as t ');
		$this->db->join('pins as d','d.pinid=t.pin_no','left');
	//	$this->db->join('customer as f','f.customer_id=t.payby','left');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
    public function get_all_product($uid)
    {
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('mid',$uid);
		$query = $this->db->get();
		return $query->result_array(); 
    }

     public function get_category_list()
    {
       
		$this->db->select('id,c_name,icon,image,p_id');
		$this->db->from('categorys'); 
		$this->db->where('status','active');
		//$this->db->where('position','');
		$this->db->where('p_id','0');
		$query = $this->db->get();
		return $query->result_array(); 
    } 		
	
	 public function b_c_Offers($category)
    {
		$this->db->select('*');
		$this->db->from('webstores');
		if(!empty($category)) {
			$this->db->where('category',$category);
		}
		$this->db->where('web_status','active');
		//$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	
	
	public function b_c_Offerss()
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('web_status','active');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	
	public function hot_deal(){
         
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('product_type','1');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array(); 
   }
	
	public function store($id)
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('web_status','active');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }  
	
	
	
	public function get_store_product($pid)
    {
		$this->db->select('*');
		$this->db->from('web_product');
		$this->db->where('status','active');
		$this->db->where('web_id',$pid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	function insert_WorkWith($data)
    {
		$insert = $this->db->insert('WorkWith', $data);
		return $insert;
	}
	
	
	
	
	
   public function get_gallery()
	   {
	     $this->db->select('*');
	   	$this->db->from('gallery');
	   	$this->db->where('type','gallery');
		$this->db->where('status','active');
		$query = $this->db->get();
	return $query->result_array();
	  }
	
	public function get_category($name)
    {
       
		$this->db->select('*');
		$this->db->from('categorys');
		$this->db->where('c_name',$name);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	public function get_coupon($coupon) {
	 	
		$this->db->select('*');
		$this->db->from('site_coupon');
		$this->db->where('code',$coupon);
		$query = $this->db->get();
		return $query->result_array(); 
	}
public function get_order_coupon_by_customer($uid,$coupon_code) {
	 	
		$this->db->select('count(id) as total');
		$this->db->from('orders');
		$this->db->where('user_id',$uid);
		$this->db->where('coupon',$coupon_code);
		$query = $this->db->get();
		return $query->result_array(); 
	}

  public function get_product_by_url($pid)
    {
		
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('status','active');
		$this->db->where('p_id',$pid);
		$query = $this->db->get();
		return $query->result_array(); 
    }  			 
     public function get_category_product($categoryid)    {		
               	
     	       $this->db->select('*');	
	       $this->db->from('product');	
		$this->db->where('status','active');
	       $this->db->where('category',$categoryid);
           $this->db->order_by("product_type", "asc");		   
	       $query = $this->db->get();	
	       return $query->result_array();  
   }		

	
	public function bliss_product(){
         
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('category','48');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function gold_product(){
         
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('category','48');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(4); 
		$query = $this->db->get();
		return $query->result_array(); 
   }  
   
   
 public function get_food_products()
    {
		$this->db->select('*');
		$this->db->from('product');
                $this->db->where('status','active'); 
				$this->db->order_by('id','DESC');
		        $this->db->limit(12);
		        $query = $this->db->get();
		return $query->result_array(); 
    } 


   
 function upload_user_product_design($data)
    {
		$insert = $this->db->insert('custom_product_req', $data);
		return $insert;
	}
   
   
   public function bliss_web_stores(){
         
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('web_status','active');
		//$this->db->where('c_name',$name);
		$query = $this->db->get();
		return $query->result_array(); 
   }        
   public function get_category_id($name)    {  
   
   $this->db->select('id');	
   $this->db->from('categorys');
   $this->db->where('c_name',$name);
   $query = $this->db->get();	
   return $query->result_array();     }         

   function get_customer_address($cust_id){
	   $this->db->select('*');
		$this->db->from('customer'); 
		$this->db->where('id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}  
	 public function get_WorkWith_last_id()
    {
		$this->db->select('id_no');
		$this->db->from('WorkWith');
		$this->db->order_by('id_no','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	 public function fech_news(){
         
		$this->db->select('*');
		$this->db->from('gnd_news');
		$this->db->where('type','news');
		$this->db->where('status','active');
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
		  public function slider(){
         
		$this->db->select('*');
		$this->db->from('offer');
		$this->db->where('product_type','5');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->limit(6); 
		$query = $this->db->get();
		return $query->result_array(); 
   }  
   public function get_store_product_by_id($pid)
    {
		$this->db->select('id,url,s_name,web_id');
		$this->db->from('admin_product');
		$this->db->where('status','active');
		$this->db->where('id',$pid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
   
    	function get_popup(){
		$this->db->select('*');
		$this->db->from('popup');
		$this->db->where('status', 'active');
		$this->db->where('type', 'homepage');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		
		$query = $this->db->get();
		return $query->result_array(); 
	}
   public function new_achiever(){
         
		$this->db->select('*');
		$this->db->from('gnd_news');
		$this->db->where('type','achiever');
		$query = $this->db->get();
		return $query->result_array();
	}
	

   
   }
?>