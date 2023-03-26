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
public function user_query($data) {
   $this->db->insert('merchant_query', $data); 
   return true;
}

public function merchant_data($merchant_id) {
               $this->db->select('merchant_meta.*, merchants.d_name,merchants.phone');
		$this->db->from('merchant_meta');
		$this->db->join('merchants', 'merchants.id = merchant_meta.merchant_id','left');
                $this->db->where('merchant_meta.merchant_id',$merchant_id); 
		$query = $this->db->get();
		return $query->result_array(); 
}


public function get_similar_merchant($merchant_id) {
               $this->db->select('merchant_meta.*, merchants.d_name,merchants.phone');
		$this->db->from('merchant_meta');
		$this->db->join('merchants', 'merchants.id = merchant_meta.merchant_id','left');
                $this->db->like('merchant_meta.business_type',$merchant_id); 
				$this->db->where('merchants.status','active');
				$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array(); 
}

public function get_products($merchant_id) { 
                $this->db->select('p.*,mta.attribute as mattry');
		        $this->db->from('product as p'); 
				$this->db->join('merchant_meta as mta','mta.merchant_id=p.mid','left');
				//$this->db->join('categorys as c','c.id=p.category','left');
                $this->db->where('p.mid',$merchant_id); 
                $this->db->where('status','active'); 
		        $query = $this->db->get();
		       return $query->result_array(); 
}

public function get_all_category_list()
    {
       
		$this->db->select('id,c_name,icon,image');
		$this->db->from('categorys'); 
		//$this->db->where('status','active');
		//$this->db->where('position','');
		//$this->db->where('p_id','0');
		$query = $this->db->get();
		return $query->result_array(); 
    } 	
    
            public function get_products_cat($merchant_id) {
                $this->db->select('p.category,c.c_name');
		        $this->db->from('product as p'); 
				$this->db->join('categorys as c', 'c.id = p.category','left');
                $this->db->where('p.mid',$merchant_id); 
                $this->db->where('p.status','active');
                $this->db->group_by('p.category'); 				
		        $query = $this->db->get();
		        return $query->result_array(); 
                }

	function get_merchant_review($cust_id){
	   $this->db->select('*');
		$this->db->from('reviews');
		$where = "mer_id='$cust_id' AND status='approved'";
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array(); 
	}


}
?>