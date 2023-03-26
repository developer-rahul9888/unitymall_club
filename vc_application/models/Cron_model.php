<?php 
class Cron_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

	function get_salary_user_last($date)
	{
        $this->db->select('*');
        $this->db->from('salary');
        $this->db->where('roi_count >', 0);
        $this->db->where('pay_date <', $date);
		$this->db->where('status','Active');
		$this->db->order_by('pay_date','asc');
		$this->db->limit(1);
        $query=$this->db->get();
        return $query->result_array();
	}

	function get_salary($date)
	{
        $this->db->select('*');
        $this->db->from('salary');
        $this->db->where('roi_count >', 0);
        $this->db->like('pay_date', $date);
		$this->db->where('status','Active');
        $query=$this->db->get();
        return $query->result_array();
	}
	function update_salary_by_id($id,$data_to_store){
        $this->db->where('id', $id);
	    $this->db->update('salary',$data_to_store);
        return TRUE;
    }
	function add_daily_salary($data){
	    $this->db->insert('daily_salary',$data);
        return TRUE;
	}
	public function add_income($data){
		$this->db->insert('incomes', $data);
	}

	function substract_wallet($id,$amount,$column){
        $sql = "update `customer` set $column = $column + $amount where id='$id'";
        $this->db->query($sql);
    }
	function insert_batch($table,$data)
    {
		$insert = $this->db->insert_batch($table, $data);
		return $insert;
	}
}
?>