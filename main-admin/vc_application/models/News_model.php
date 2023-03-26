<?php 
class News_model extends CI_Model {
 
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
    public function get_all_news()
    {
		
		$this->db->select('*');
		$this->db->from('gnd_news'); 
		$this->db->where('visibility','club');
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	  public function get_all_news_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('gnd_news'); 
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
    function store_news($data)
    {
		$insert = $this->db->insert('gnd_news', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_news($id, $data)
    {
		
		$this->db->where('id', $id);
		$this->db->update('gnd_news', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_news($id){
		
		$this->db->where('id', $id);
		$this->db->delete('gnd_news'); 
	}
}
?>