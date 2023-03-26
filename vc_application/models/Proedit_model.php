<?php 

class Proedit_model extends CI_Model {

 

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

    public function get_all_order()

    {

		$uid = $this->session->userdata('cust_id');

		

		$this->db->select('*');

		$this->db->from('orders'); 

		$this->db->where('user_id',$uid);

		$this->db->order_by('id','desc');

		$query = $this->db->get();

		return $query->result_array();  

    } 

  public function get_all_order_id($id)

    {

		$uid = $this->session->userdata('cust_id');

	  

		$this->db->select('*');

		$this->db->from('orders'); 

		$this->db->where('id',$id);

		$this->db->where('user_id',$uid);

		$query = $this->db->get();

		return $query->result_array();  

    }

}

?>