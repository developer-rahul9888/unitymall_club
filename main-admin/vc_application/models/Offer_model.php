<?php 
class Offer_model extends CI_Model {
 
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
    public function get_all_product()
    {
		$this->db->select('*');
		$this->db->from('offer');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_product1($id)
    {
		$this->db->select('*');
		$this->db->from('offer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_product_id($id)
    {
		$this->db->select('*');
		$this->db->from('offer');
		$this->db->where('id',$id);
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
	
	public function get_all_tax()
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_product($data)
    {
		$insert = $this->db->insert('offer', $data);
		$insert_id = $this->db->insert_id();
		if($insert == TRUE) {
		$string = str_replace(' ', '-', $data['pname']);
        $pid = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
                $sku = '#'.$insert_id;
		$pid = strtolower($pid.'-'.$insert_id);
		$this->db->where('id', $insert_id);
		$this->db->update('offer', array('p_id'=>$pid,'sku'=>$sku));	
		}
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_product($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('offer', $data);		
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
		$this->db->delete('offer'); 
	}
}
?>