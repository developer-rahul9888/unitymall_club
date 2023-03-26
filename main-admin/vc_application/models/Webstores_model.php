<?php 
class Webstores_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    public function get_all_voucher_codes()
    {
      $this->db->select('*');
      $this->db->from('voucher_codes');
      $query = $this->db->get();
      return $query->result_array(); 
    }

    public function get_all_voucher_history()
    {
      $this->db->select('voucher_history.*,customer.customer_id');
      $this->db->from('voucher_history');
      $this->db->join('customer', 'customer.id = voucher_history.user_id', 'left');
      $this->db->order_by('voucher_history.id','desc');
      $query = $this->db->get();
      return $query->result_array(); 
    }

    public function get_last_voucher_history()
    {
      return $this->db->select("*")
      ->limit(1)
      ->order_by('id',"DESC")
      ->get("voucher_history")
      ->row();
    }

    public function get_all_voucher_code_by_id($id)
    {
      $this->db->select('*');
      $this->db->from('voucher_codes');
      $this->db->where('id',$id);
      $query = $this->db->get();
      return $query->result_array(); 
    }
    function store_voucher_history($data)
    {
      $insert = $this->db->insert('voucher_history', $data);
      $insert_id = $this->db->insert_id();
      return $insert;
	  }

    function store_response($data)
    {
      $insert = $this->db->insert('response', $data);
      $insert_id = $this->db->insert_id();
      return $insert;
	  }
    /**
    * Get webstores by his is
    * @param int $webstores_id 
    * @return array
    */
    public function get_all_webstores()
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_webstores1($id)
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_webstores_id($id)
    {
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_webstores($data)
    {
		$insert = $this->db->insert('webstores', $data);
	    return $insert;
	}

    /**
    * Update webstores
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_webstores($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('webstores', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete webstores
    * @param int $id - webstores id
    * @return boolean
    */
	
	
	function delete_webstores($id){
		$this->db->where('id', $id);
		$this->db->delete('webstores'); 
	}
}
?>