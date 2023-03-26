<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
		$this->load->library('cart');
        $this->load->model('customer_model');	
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'not-found';
                $data['page_title'] = 'Not Found';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'not_found';
            $this->load->view('includes/front/front_template', $data); 

	}

	public function shipping_policy()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'shipping_policy';
                $data['page_title'] = 'Shipping Policy';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'shipping_policy';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function about()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'about';
                $data['page_title'] = 'About'; 
                
    


		
			$data['fech_achiver'] = $this->customer_model->fech_achievers();
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'about';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function recharge()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'recharge';
                $data['page_title'] = 'recharge'; 
		
			$data['fech_achiver'] = $this->customer_model->fech_achievers();
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'recharge';
            $this->load->view('includes/front/front_template', $data); 
 
	}
	
	public function rechargecheck()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'recharge';
                $data['page_title'] = 'recharge'; 
		
			$data['fech_achiver'] = $this->customer_model->fech_achievers();
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'rechargecheck';
            $this->load->view('includes/front/front_template', $data); 
 
	}
	public function gallery()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'gallery';
                $data['page_title'] = 'Gallery'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
			$data['gallery'] = $this->customer_model->get_gallery();
	        $data['main_content'] = 'gallery';
            $this->load->view('includes/front/front_template', $data); 

	}
	
		public function terms_of_use()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'terms_of_use';
                $data['page_title'] = 'terms_of_use'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'terms_of_use';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function banker()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'banker';
                $data['page_title'] = 'Banker'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'banker';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	
	
	
	
	
	
	public function disclaimer()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'disclaimer';
                $data['page_title'] = 'disclaimer'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'disclaimer';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function affiliate()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'affiliate';
                $data['page_title'] = 'affiliate'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'affiliate';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function cell()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'cell';
                $data['page_title'] = 'cell'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'cell';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function refund_policy()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'refund_policy';
                $data['page_title'] = 'refund_policy'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'refund_policy';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function ship()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'ship';
                $data['page_title'] = 'ship'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'ship';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function reward()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'reward';
                $data['page_title'] = 'reward'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'reward';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function news()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'news';
                $data['page_title'] = 'news'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'news';
            $this->load->view('includes/front/front_template', $data); 

	}
		
		public function legal()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'legal';
                $data['page_title'] = 'legal'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'legal';
            $this->load->view('includes/front/front_template', $data); 

	}
		public function vision()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'vision';
                $data['page_title'] = 'vision'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'vision';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function mission()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'mission';
                $data['page_title'] = 'mission'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'mission';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function genuine()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'genuine';
                $data['page_title'] = 'genuine'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'genuine';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function excellence()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'excellence';
                $data['page_title'] = 'excellence'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'excellence';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function customer_delight()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'customer_delight';
                $data['page_title'] = 'customer_delight'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'customer_delight';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function social_responsibility()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'social_responsibility';
                $data['page_title'] = 'social_responsibility'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'social_responsibility';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function team_work()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'team_work';
                $data['page_title'] = 'team_work'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'team_work';
            $this->load->view('includes/front/front_template', $data); 

	}
	
public function help()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'help';
                $data['page_title'] = 'Help';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'help';
            $this->load->view('includes/front/front_template', $data);  
	}
	
	public function contact_us()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'contact_us';
                $data['page_title'] = 'Contact Us';  
			$data['fech_achiver'] = $this->customer_model->fech_achievers();
		    $data['category_list'] = $this->customer_model->get_category_list();
			$data['contact_form'] = '';	
			if ($this->input->server('REQUEST_METHOD') && $this->input->post('contact')=='Submit') {
				$to = "rti@gmail.com";
				$subject ="contact_form :- ".$this->input->post('subject');
				$txt = "name :- ".$this->input->post('name')."<br/>email :- ".$this->input->post('email')."<br/>phone :- ".$this->input->post('phone')."<br/>message :- ".$this->input->post('message');        
				$headers = "From: http://rti.33demo.com/" . "\r\n";
				$headers = "MIME-Version: 1.0" . "\r\n";     
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
				$headers .= 'From: <http://rti.33demo.com/>' . "\r\n"; 
				mail($to,$subject,$txt,$headers);
				$data['contact_form'] = 'mail sent successfully';		}												
	        $data['main_content'] = 'contact_us';
            $this->load->view('includes/front/front_template', $data); 
	}

	public function feedback()	{  
	$data['page_keywords'] = '';    
	$data['page_description'] = ''; 
	$data['page_slug'] = 'feedback'; 
	$data['page_title'] = 'feedback'; 
	$data['category_list'] = $this->customer_model->get_category_list();
	$data['feedback'] = '';	
	if ($this->input->server('REQUEST_METHOD') && $this->input->post('contact')=='Submit') {
		$to = "rti@gmail.com";
		$subject =$this->input->post('subject'); 
		$txt = "email :- ".$this->input->post('email')."<br/>site speed :- ".$this->input->post('speed')."<br/>feedback :- ".$this->input->post('message'); 
		$headers = "From: http://rti.33demo.com/" . "\r\n";	
		$headers = "MIME-Version: 1.0" . "\r\n"; 
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
		$headers .= 'From: <http://rti.33demo.com/>' . "\r\n";   
		mail($to,$subject,$txt,$headers);	
		$data['feedback'] = 'mail sent successfully';		}
		$data['main_content'] = 'feedback'; 
		$this->load->view('includes/front/front_template', $data); 	}
		
		public function complaint()	{  
		$data['page_keywords'] = '';    
		$data['page_description'] = '';  
		$data['page_slug'] = 'complaint'; 
		$data['page_title'] = 'complaint';  
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['complaint'] = '';
		
		if ($this->input->server('REQUEST_METHOD') && $this->input->post('contact')=='Submit') {
			$to = "rti@gmail.com";   
			$subject ="complaint :- ".$this->input->post('subject');  
			$txt = "name :- ".$this->input->post('name')."<br/>email :- ".$this->input->post('email')."<br/>phone :- ".$this->input->post('phone')."<br/>complaint :- ".$this->input->post('message'); 
			$headers = "From: http://rti.33demo.com/" . "\r\n";	
			$headers = "MIME-Version: 1.0" . "\r\n";    
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
			$headers .= 'From: <http://rti.33demo.com/>' . "\r\n";    
			mail($to,$subject,$txt,$headers);	
			$data['complaint'] = 'mail sent successfully';	}													  
			$data['main_content'] = 'complaint';    
			$this->load->view('includes/front/front_template', $data); 	}	

			
	public function faq()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'faq';
                $data['page_title'] = 'FAQ';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'faq';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function privacy()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'privacy';
                $data['page_title'] = 'Privacy';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'privacy';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function payment_privacy()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'payment_privacy';
                $data['page_title'] = 'payment_Privacy';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'payment_privacy';
            $this->load->view('includes/front/front_template', $data); 
	}

	public function qna()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'qna';
                $data['page_title'] = 'qna';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'qna';
            $this->load->view('includes/front/front_template', $data); 
	}

		public function business_plan()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'business_plan';
                $data['page_title'] = 'Business Plan'; 
		
			$data['fech_achiver'] = $this->customer_model->fech_achievers();
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'business_plan';
            $this->load->view('includes/front/front_template', $data); 

	}
		
	public function term_condition()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'term_condition';
                $data['page_title'] = 'term condition'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'term_condition';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	public function online_stores()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'online_stores';
                $data['page_title'] = 'online_stores'; 
		if(!empty($this->uri->segment(3))) { 
		$category = $this->uri->segment(3);
		$data['webstore'] = $this->customer_model->b_c_Offers($category); 
		} 
		else
			{
			$data['webstore'] = $this->customer_model->b_c_Offerss(); 
			}
		    $data['category_list'] = $this->customer_model->get_category_list();
			$data['hot_deal'] = $this->customer_model->hot_deal();
           // $data['webstore'] = $this->customer_model->b_c_Offers($category[0]['id']); 
	        $data['main_content'] = 'online_stores';
            $this->load->view('includes/front/front_template', $data); 

	}

	 public function offers()
	{
            $data['page_keywords'] = '';
            $data['page_description'] = '';
            $data['page_slug'] = 'offers';
            $data['page_title'] = 'offers'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'offers';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function o_stores()
	{
		
		$store = $this->uri->segment(2);
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'online_stores';
                $data['page_title'] = $store; 
		
            $data['store'] = $this->customer_model->store($this->uri->segment(3));
			//echo '<pre>'; print_r($data['store']); die();
            $data['store_product'] = $this->customer_model->get_store_product($this->uri->segment(3));
	        $data['main_content'] = 'stores';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	
	public function genratelink()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'genratelink';
                $data['page_title'] = 'genratelink'; 
                $data['link'] ='';
                
                $cust_id  = $this->session->userdata('cust_id');
                $bliss_id  = $this->session->userdata('bliss_id');
                	if ($this->input->server('REQUEST_METHOD') && $this->input->post('submit')=='submit') {
                	    
                	    $weblink = 'https://linksredirect.com/?cid=93289&source=linkkit&url='.$this->input->post('link').'&subid='.$bliss_id;
                	    
                	    
                	    
                	    
        $cust_info = $this->customer_model->get_customer_address($cust_id);
		$last_id = $this->customer_model->get_WorkWith_last_id();
		$visitor_id = $last_id[0]['id_no'] + 2;
		$data_to_insert = array(
				'Sitename' => $this->input->post('web_name'),
				'link' => $weblink,
				'zkey' => $bliss_id,
				'username' => $this->session->userdata('full_name'),
				'phno' => $cust_info[0]['phone'],
				'visitor_no' => $visitor_id
			);
	 $this->customer_model->insert_WorkWith($data_to_insert);
    $data['link'] = '<div class="alert alert-danger alert_lnk"> Your link generated successfully ! Click on the link below to get cashback...</div> <a class="btn btn-default genreate_link1 genratelinkbutton" target="_blank" href="'.$weblink.'">Buy Now</a>';  
                	}
                
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'genratelink';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function redirecting() {
		
		$cust_id  = $this->session->userdata('cust_id');
		$bliss_id  = $this->session->userdata('bliss_id');
		

		
		if($this->uri->segment(3)){
		$data['webstore'] = $this->customer_model->store($this->uri->segment(2));
		
		$weblink=$data['webstore'][0]['web_url'];
		//flipkart
	$pos5 = strpos($weblink, "affid=wishzon75");
    if ($pos5 === false) {} else {
       $data['url'] = $weblink.'&affExtParam1='.$bliss_id;
    }
	//amazon
	$pos25 = strpos($weblink, "?&tag=752145-21");
    if ($pos25 === false) {} else {
       $data['url'] = $weblink.'&ascsubtag='.$bliss_id;
    }
    //cuelinks
	$pos26 = strpos($weblink, "?cid=93289");
    if ($pos26 === false) {} else {
       $data['url'] = $weblink.'&subid='.$bliss_id;
    }
    
     //cuelinks
	$pos27 = strpos($weblink, "?cid=30178");
    if ($pos27 === false) {} else {
       $data['url'] = $weblink.'&subid='.$bliss_id;
    }
    
    
    if($data['url']==''){  $data['url'] = $weblink; }
		
	//	$data['url'] = $data['webstore'][0]['web_url'].'&subid='.$bliss_id;
		}else{
		$pid = $this->uri->segment(2);
		$offer = $this->customer_model->get_store_product_by_id($pid);
		$data['webstore'] = $this->customer_model->store($offer[0]['web_id']);
		
			$weblink=$offer[0]['url'];
		//flipkart
	$pos5 = strpos($weblink, "affid=wishzon75");
    if ($pos5 === false) {} else {
       $data['url'] = $weblink.'&affExtParam1='.$bliss_id;
    }
	//amazon
	$pos25 = strpos($weblink, "?&tag=752145-21");
    if ($pos25 === false) {} else {
       $data['url'] = $weblink.'&ascsubtag='.$bliss_id;
    }
    //cuelinks
	$pos26 = strpos($weblink, "?cid=93289");
    if ($pos26 === false) {} else {
       $data['url'] = $weblink.'&subid='.$bliss_id;
    }
    
     //cuelinks
	$pos27 = strpos($weblink, "?cid=30178");
    if ($pos27 === false) {} else {
       $data['url'] = $weblink.'&subid='.$bliss_id;
    }
    
    
    if($data['url']==''){  $data['url'] = $weblink; }
		
		
	//	$data['url'] = $offer[0]['url'].'&subid='.$bliss_id;
		}
		
		
		if($data['webstore'] != '' && $cust_id !='') {
		$cust_info = $this->customer_model->get_customer_address($cust_id);
		$last_id = $this->customer_model->get_WorkWith_last_id();
		$visitor_id = $last_id[0]['id_no'] + 2;
		$data_to_insert = array(
				'Sitename' => $data['webstore'][0]['web_name'],
				'link' => $data['url'],
				'zkey' => $bliss_id,
				'username' => $this->session->userdata('full_name'),
				'phno' => $cust_info[0]['phone'],
				'visitor_no' => $visitor_id
			);
		$return = $this->customer_model->insert_WorkWith($data_to_insert);
		$this->load->view('redirecting',$data);
		
		} else { redirect(base_url());

		}
		
		

		
		
	}
	
	
	
	
	
	public function paytmpaymentresponce() {   
    
	require_once("./././paytmkit/lib/config_paytm.php");
	require_once("./././paytmkit/lib/encdec_paytm.php");
	//echo '<pre>'; print_r($this->session->userdata()); die();
	$paytmChecksum = "";
	$paramList = array();
	$isValidChecksum = "FALSE";
	$paramList = $_POST;
	$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
	//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
	$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string




	$cust_id = $this->uri->segment(2);
	$is_valid = $this->customer_model->super_admin_validate_by_id($cust_id);
	if($is_valid['login']=='true')
		{
			$data = array('full_name'=>$is_valid['full_name'], 'email'=>$is_valid['email'], 'bliss_id'=>$is_valid['bliss_id'],  'cust_id'=>$is_valid['cust_id'], 'cust_img'=>$is_valid['cust_img'], 'is_customer_logged_in' => true);
	        $this->session->set_userdata($data);
		}

	if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";

	if ($_POST["STATUS"] == "TXN_SUCCESS") {

		$merchant_order_id = $this->input->post('ORDERID');
		$this->session->set_userdata('last_order_id',$merchant_order_id);
		$data_profile_array = array('status'=>'Approved','how_to_pay'=>'paytm');
		$this->customer_model->update_order_status($merchant_order_id,$data_profile_array);
		$success = true;//echo 'success ';
		$this->session->set_userdata('last_order_id',$merchant_order_id);
		$data_profile_array = array('status'=>'Approved','how_to_pay'=>'paytm');
		$this->customer_model->update_order_status($merchant_order_id,$data_profile_array);
							
	    $this->customer_model->update_user_wallet($cust_id,$this->input->post('TXNAMOUNT'));
		echo "<b>Transaction status is success</b>" . "<br/>";

		$this->session->set_flashdata('flash_message', 'updated');
        redirect('admin/payment'); 
            
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
		$this->session->set_flashdata('flash_message', 'not_updated');
    	redirect('admin/payment'); 
	}

	
}
else {
	echo "<b>Checksum mismatched.</b>";
	$this->session->set_flashdata('flash_message', 'not_updated');
    redirect('admin/payment'); 
	//Process transaction as suspicious.
}  
      
      
      
      
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
}