<?php 
class Product_model extends CI_Model {
 
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
    public function get_product_by_url($pid)
    {
		
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('p_id',$pid);
        $this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	  public function get_product_by_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('voucher');
		$this->db->where('id',$id);
        $this->db->where('status', 'active');
		$query = $this->db->get();
		return $query->result_array(); 
    }

      public function get_categorys_by_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('categorys');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }  
	 public function get_bliss_product_list()
    {
		
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	 public function get_new_arrivals_product($keyword,$cat)
    {
		$this->db->select('p.*,m.id,m.d_name,p.id as proid,mta.attribute as mattry');
		$this->db->from('product as p'); 
		$this->db->join('merchants as m','m.id=p.mid','left');
		$this->db->join('merchant_meta as mta','mta.merchant_id=m.id','left');
		$this->db->where('p.status', 'active');
       if($keyword!='') { $this->db->like('p.pname', $keyword, 'both'); }
       if($cat!='') { $this->db->where_in('p.category', $cat); }
		$this->db->order_by('p.visibility','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	public function get_merchants($keyword)
    {
		
		$this->db->select('*');
		$this->db->from('merchants'); 
		$this->db->join('merchant_meta','merchants.id=merchant_meta.merchant_id','inner');
		$this->db->where('status', 'active');
		if($keyword!='') { $this->db->like('d_name', $keyword); }
		$this->db->order_by('merchants.merchant_type','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_stores_product()
    {
		
		$this->db->select('*');
		$this->db->from('product');
        $this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	  public function get_deal_by_url($mid)
    {
		
		$this->db->select('*');
		$this->db->from('merchants');
		$this->db->where('merchant_id',$mid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	  
	 public function get_deals_list()
    {
		
		$this->db->select('merchants.*, merchant_meta.brand_proof');
		$this->db->from('merchants'); 
		$this->db->join('merchant_meta', 'merchant_meta.merchant_id = merchants.id', 'left'); 
		$this->db->where('merchants.status','active');
		$this->db->order_by('merchants.id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
		 public function get_merchant_deal($mid)
    {
		
		$this->db->select('*');
		$this->db->from('deals');
		$this->db->where('mid',$mid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 	
	
	function get_product_review($cust_id){
	   $this->db->select('*');
		$this->db->from('reviews');
		$where = "pro_id='$cust_id' AND status='approved'";
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
}
?>