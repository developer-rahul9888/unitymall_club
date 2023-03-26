<?php 
class Category_model extends CI_Model {
 
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
    public function get_all_category()
    {
		$this->db->select('*');
		$this->db->from('categorys');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_category1($id)
    {
		$this->db->select('*');
		$this->db->from('categorys');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_category_id($id)
    {
		$this->db->select('*');
		$this->db->from('categorys');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_category($data)
    {
		$insert = $this->db->insert('categorys', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_category($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('categorys', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_category($id){
		$this->db->where('id', $id);
		$this->db->delete('categorys'); 
	}
}
?>