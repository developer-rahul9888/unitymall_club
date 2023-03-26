<?php 
class Profile_meta extends CI_Model {
 
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
		$this->db->from('product');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
  public function get_merchant_data($id)
    {
		$this->db->select('*');
		$this->db->from('merchants');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

  public function get_merchant_meta($id)
    {
		$this->db->select('*');
		$this->db->from('merchant_meta');
		$this->db->where('merchant_id',$id);
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
		//$insert = $this->db->insert('product', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_merchant_meta($id, $data)
    {
		$this->db->where('merchant_id', $id);
		$this->db->update('merchant_meta', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

function update_merchant ($id, $data) { 
		$this->db->where('id', $id);
		$this->db->update('merchants', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	/*
	function delete_merchant_id($id){
		$this->db->where('merchant_id', $id);
		$this->db->delete('product'); 
	}
	*/
}
?>