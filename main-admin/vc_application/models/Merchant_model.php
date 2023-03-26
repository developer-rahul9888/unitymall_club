<?php 
class Merchant_model extends CI_Model {
 
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
    public function get_all_merchant()
    {
		$this->db->select('*');
		$this->db->from('merchants');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_merchant1($id)
    {
		$this->db->select('*');
		$this->db->from('merchants');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_merchant_id($id)
    {
		$this->db->select('*');
		$this->db->from('merchants');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_merchant($data)
    {
		$insert = $this->db->insert('merchants', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_merchant($id, $data)
    {
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
	
	
	function delete_merchant($id){
		$this->db->where('id', $id);
		$this->db->delete('merchants'); 
	}
}
?>