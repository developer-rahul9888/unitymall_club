<?php 
class Search_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }
    public function user_query($data) {
     $this->db->insert('merchant_query', $data); 
     return true;
}

	    public function get_record_by_id($id,$table)
    {
		$this->db->select('*');
		$this->db->from($table);
        $this->db->where('waoic',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

	    public function get_search_form_order($sdate,$ldate)
    {
		$this->db->select('*');
		$this->db->from('order');
        $this->db->where_in('user_level',array('3','5'));
        //$this->db->where('user_level','5');
		$this->db->where('odate >=',$sdate);
		$this->db->where('odate <=',$ldate);
        $this->db->order_by('odate','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }

}
?>