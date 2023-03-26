<?php 
class Upgrade_model extends CI_Model {
 
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
    public function get_all_upgrade()
    {
		
		$this->db->select('upgrade_acc.*,customer.*');
		$this->db->from('upgrade_acc');
       $this->db->join('customer', 'upgrade_acc.up_user_id = customer.id', 'left');		
		$this->db->where('up_status','pending');
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	  public function get_all_upgrade_id($id)
    {
		
		$this->db->select('upgrade_acc.*,customer.*');
		$this->db->from('upgrade_acc');
       $this->db->join('customer', 'upgrade_acc.up_user_id = customer.id', 'left');		
		$this->db->where('up_id', $id);
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_upgrade($data)
    {
		$insert = $this->db->insert('upgrade_acc', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_upgrade($id, $data)
    {
		
		$this->db->where('up_id', $id);
		$this->db->update('upgrade_acc', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	 function update_customer_upgrade($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('customer', $data);		
        $error = $this->db->error();
        if(empty($error['message'])) { return true; }
         else { return false; }
	}

	function update_parent_id($id, $data)
    {
		$this->db->where('parent_customer_id', $id);
		$this->db->update('customer', $data);		
        $error = $this->db->error();
        if(empty($error['message'])) { return true; }
         else { return false; }
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_upgrade($id){
		
		$this->db->where('id', $id);
		$this->db->delete('upgrade_acc'); 
	}
}
?>