<?php 
class Docverification_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }
	 public function all_docverification()    {				
	 $this->db->select('*');		
	 $this->db->from('customer'); 		
	 $this->db->where('var_status','yes');	
	 //$this->db->order_by('id','desc');	
	 $query = $this->db->get();		
	 return $query->result_array(); 
     }
   

   /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_all_docverification()
    {
		
		$this->db->select('*');
		$this->db->from('customer'); 
		$this->db->where('var_status','no');
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	  public function get_all_docverification_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('customer'); 
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
    function store_docverification($data)
    {
		$insert = $this->db->insert('redeem_bliss', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_docverification($id, $data)
    {
		
		$this->db->where('id', $id);
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
	
	
	function delete_docverification($id){
		
		$this->db->where('id', $id);
		$this->db->delete('redeem_bliss'); 
	}
}
?>