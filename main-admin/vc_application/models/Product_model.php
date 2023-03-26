<?php 
class Product_model extends CI_Model {
 
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

    public function get_all_stoke()
    {
		$this->db->select('*');
		$this->db->from('newproduct');
		//$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array(); 
    }

	public function check_voucher_history_by_code($VoucherGCcode)
    {
		$this->db->select('*');
		$this->db->from('voucher_history');
		$this->db->where('VoucherGCcode',$VoucherGCcode);
		$query = $this->db->get();
		return $query->result_array(); 
    }

	function update_voucher_history($VoucherGCcode, $data)
    {
		$this->db->where('VoucherGCcode', $VoucherGCcode);
		$this->db->update('voucher_history',$data);		
		$error = $this->db->error();
		if(empty($error['message'])) { return true; }
		else { return false; }
	}
	function add_transactions($data){ 
		$this->db->insert('transaction_wallet', $data); 
	}

	function load_wallet($id,$amount,$column){        
    	$sql = "update `customer` set $column = $column + $amount where id='$id'";        
    	$this->db->query($sql);     
    }

	public function get_all_receipt()
    {
		$this->db->select('*');
		$this->db->from('upload_receipt');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_all_product()
    {
		$this->db->select('*');
		$this->db->from('admin_product');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_product1($id)
    {
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	 public function get_all_m_product()
    {
		$this->db->select('p.*,m.d_name');
		$this->db->from('product as p');
		$this->db->join('merchants as m','p.mid=m.id','left');
		$this->db->order_by('p.id','DESC');
		$this->db->where('p.mid >',0);
		$query=$this->db->get();
		return $query->result_array(); 
    }
	
	
	
	
		public function get_all_webstores()
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	
  public function get_all_product_id($id)
    {
		$this->db->select('*');
		$this->db->from('web_product');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function get_all_web_product_id($id)
    {
		$this->db->select('*');
		$this->db->from('web_product');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	 function update_merchant_product($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('product', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	public function get_all_tax1()
    {
		$this->db->select('id,amount,title,type');
		$this->db->from('tax');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
function delete_web_product($id){
		$this->db->where('id', $id);
		$this->db->delete('web_product'); 
	}
    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_product($data)
    {
		$insert = $this->db->insert('web_product', $data);
		$insert_id = $this->db->insert_id();
		if($insert == TRUE) {
		$string = str_replace(' ', '-', $data['pname']);
        $pid = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
                $sku = '#'.$insert_id;
		$pid = strtolower($pid.'-'.$insert_id);
		$this->db->where('id', $insert_id);
		$this->db->update('web_product', array('p_id'=>$pid,'sku'=>$sku));	
		}
	    return $insert;
	}
	
	 function store_web_product($data)
    {
		$insert = $this->db->insert('web_product', $data);
		$insert_id = $this->db->insert_id();
		if($insert == TRUE) {
		$string = str_replace(' ', '-', $data['pname']);
        $pid = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
                $sku = '#'.$insert_id;
		$pid = strtolower($pid.'-'.$insert_id);
		$this->db->where('id', $insert_id);
		$this->db->update('web_product', array('p_id'=>$pid,'sku'=>$sku));	
		}
	    return $insert;
	}

	 public function get_all_web_product()
    {
		$this->db->select('*');
		$this->db->from('web_product');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	
	 public function get_all_merchant_product_id($id)
    {
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
		public function get_all_tax()
    {
		$this->db->select('*');
		$this->db->from('tax');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
		public function get_all_category()
    {
		$this->db->select('id,c_name');
		$this->db->from('categorys');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_product($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('web_product', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	function update_receipt($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('upload_receipt', $data);		
		$error = $this->db->error();
		if(empty($error['message'])) { return true; }
		else { return false; }
	}
	
	function update_web_product($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('web_product', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	
	
	
	
	
	
	
	
 function update_m_products($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('product', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_product($id){
		$this->db->where('id', $id);
		$this->db->delete('admin_product'); 
	}
	
	    public function get_all_product_ecommerce()
    {
		$this->db->select('*');
		$this->db->from('product');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_product1_ecommerce($id)
    {
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_product_id_ecommerce($id) 
    {
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

	public function get_receipt_by_id($id) 
    {
		$this->db->select('*');
		$this->db->from('upload_receipt');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    function store_new_stoke($data)
    {
		$insert = $this->db->insert('product', $data);
		$insert_id = $this->db->insert_id();
		if($insert == TRUE) {
		$string = str_replace(' ', '-', $data['pname']);
        $pid = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
                $sku = '#'.$insert_id;
		$pid = strtolower($pid.'-'.$insert_id);
		$this->db->where('id', $insert_id);
		$this->db->update('product', array('p_id'=>$pid,'sku'=>$sku));	
		}
	    return $insert;
	}
	
    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_product_ecommerce($data)
    {
		$insert = $this->db->insert('product', $data);
		$insert_id = $this->db->insert_id();
		if($insert == TRUE) {
		$string = str_replace(' ', '-', $data['pname']);
        $pid = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
                $sku = '#'.$insert_id;
		$pid = strtolower($pid.'-'.$insert_id);
		$this->db->where('id', $insert_id);
		$this->db->update('product', array('p_id'=>$pid,'sku'=>$sku));	
		}
	    return $insert;
	}
	
	
	
	
	
	 function store_freeproduct_ecommerce($data)
    {
		$insert = $this->db->insert('voucher', $data);
		$insert_id = $this->db->insert_id();
		if($insert == TRUE) {
		$string = str_replace(' ', '-', $data['pname']);
        $pid = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
                $sku = '#'.$insert_id;
		$pid = strtolower($pid.'-'.$insert_id);
		$this->db->where('id', $insert_id);
		$this->db->update('voucher', array('p_id'=>$pid,'sku'=>$sku));	
		}
	    return $insert;
	}
	

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_product_ecommerce($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('product', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	 function update_freeproduct_ecommerce($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('voucher', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	
	
	
	 function update_voucher_order($id, $data)
    {
		$this->db->where('id', $id);
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
	
	
	function delete_product_ecommerce($id){
		$this->db->where('id', $id);
		$this->db->delete('product'); 
	}
	
	
	
	
	
	  public function get_all_freeproduct()
    {
		$this->db->select('*');
		$this->db->from('voucher');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	public function get_voucher_order()
    {
	$this->db->select('v.*,c.f_name,c.l_name,c.customer_id,c.email');
	$this->db->from('store_voucher as v');
	$this->db->join('customer as c','c.id=v.user_id','left');
	$this->db->order_by('v.id','DESC');
	$query = $this->db->get();
	return $query->result_array(); 
    }
	
	
	
	 public function get_all_fproduct_id_ecommerce($id)
    {
		$this->db->select('*');
		
		$this->db->from('voucher');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	
	public function get_all_voucher_order($id)
    {
		$this->db->select('v.*,CONCAT(c.f_name,c.l_name) as name,c.phone');
		$this->db->from('store_voucher as v');
		$this->db->join('customer as c','c.id=v.user_id','left');
		$this->db->where('v.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	function delete_fproduct_ecommerce($id){
		$this->db->where('id', $id);
		$this->db->delete('voucher'); 
	}
	
	
	
	
}
?>