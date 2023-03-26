<?php 
class Seo_model extends CI_Model {
 
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
    public function get_all_seo()
    {
		$this->db->select('*');
		$this->db->from('sco_links');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_seo1($id)
    {
		$this->db->select('*');
		$this->db->from('sco_links');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_seo_id($id)
    {
		$this->db->select('*');
		$this->db->from('sco_links');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_seo($data)
    {
		$insert = $this->db->insert('sco_links', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_seo($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('sco_links', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_seo($id){
		$this->db->where('id', $id);
		$this->db->delete('sco_links'); 
	}
}
?>