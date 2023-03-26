<?php 
class Review_model extends CI_Model {
 
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
    public function get_all_review()
    {
		
		$this->db->select('*');
		$this->db->from('reviews'); 
		//$this->db->where('user_id',$uid);
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	  public function get_all_review_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('reviews'); 
		$this->db->where('id',$id);
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_review($data)
    {
		$insert = $this->db->insert('reviews', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_review($id, $data)
    {
		
		$this->db->where('id', $id);
		$this->db->update('reviews', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_review($id){
		
		$this->db->where('id', $id);
		$this->db->delete('reviews'); 
	}
	
	  function store_news($data)
    {
		$insert = $this->db->insert('news', $data);
	    return $insert;
	}
}
?>