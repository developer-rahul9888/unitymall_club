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

   

    public function get_agent_search_form($name='',$waoic='',$npn='',$dba='',$city='',$insu_type='')
    {
              $array = array('name'=>$name, 'dba'=>$dba, 'address2'=>$city, 'insur_type'=>$insu_type);
		$this->db->select('id,name,waoic,dba,npn,address2,status');
		$this->db->from('agent');
                if($npn!='') { $this->db->where('npn',$npn); }
                if($waoic!='') { $this->db->where('waoic',$waoic); }
                $this->db->like($array);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	 public function get_agency_search_form($name='',$waoic='',$insu_type='',$dba='',$city='')
    {
              $array = array('name'=>$name, 'insur_type'=>$insu_type, 'dba'=>$dba, 'address2'=>$city);
		$this->db->select('id,name,waoic,dba,insur_type,address2,status');
		$this->db->from('agency');
                if($waoic!='') { $this->db->where('waoic',$waoic); }
                $this->db->like($array);
		$query = $this->db->get();
		return $query->result_array(); 
    }

	 public function get_company_search_form($name='',$waoic='',$naic='',$organiz_type='')
    {
              $array = array('name'=>$name);
		$this->db->select('id,name,waoic,status');
		$this->db->from('company');
                if($organiz_type!='') { $this->db->where('organization_type',$organiz_type); }
                if($naic!='') { $this->db->where('naic',$naic); }
                if($waoic!='') { $this->db->where('waoic',$waoic); }
                $this->db->like($array);
		$query = $this->db->get();
		return $query->result_array(); 
    }

   public function get_search_form_default(){
               $this->db->select('id,name,waoic,dba,npn,address2');
		$this->db->from('agent');
                $this->db->limit(0,2000);
		$query = $this->db->get();
		return $query->result_array(); 
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