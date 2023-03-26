<?php 

defined('BASEPATH') OR exit('No direct script access allowed');



class Cart extends CI_Controller {



	public function __construct()

    {

        parent::__construct();

        

        $this->load->library('session');

        $this->load->helper('url'); 

        $this->load->helper('form');

        $this->load->library('form_validation');

		$this->load->library('cart');

        $this->load->model('customer_model');	

        $this->load->model('checkout_model');	

    }

	

	public function index()

	{

                $data['page_keywords'] = '';

                $data['page_description'] = '';

                $data['page_slug'] = 'cart';

                $data['page_title'] = 'Cart';  

		        $data['coupon_form'] = '';

        $data['coupon_count_order'] = '';

		

		$data['profile']=array();

		$cust_id = $this->session->userdata('cust_id');

		if($cust_id!='') { 

			$data['profile'] = $this->checkout_model->profile($cust_id);
			//echo '<pre>'; print_r($data['profile']); die();

			//redirect(base_url().'checkout'); 

		}
		
		$cart = $this->cart->contents();
		
		$mid=false;
  
		
		
		
		
		
		
		
		
		
if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('rowid')!='' && $mid==false){
			if($this->input->post('type')=='plus') { $qty = $this->input->post('qty') + 1; }
			elseif($this->input->post('type')=='minus') { $qty = $this->input->post('qty') - 1; }
			else { $qty = 0; }
			$data_cart = array(
                     'rowid' => $this->input->post('rowid'),
                     'qty' => $qty
                  );
         $this->cart->update($data_cart);
		}

		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('coupon')!=''){

			$coupon = $this->input->post('coupon');

			$data['coupon_result'] = $this->customer_model->get_coupon($coupon);

			if(count($data['coupon_result']) == 1) { 

			   $data['coupon_form'] = 'true'; 

			   if($data['coupon_result'][0]['per_user'] > 0) {

				   $cust_id =  $this->session->userdata('cust_id');

			      $data['coupon_count_order'] = $this->customer_model->get_order_coupon_by_customer($cust_id,$data['coupon_result'][0]['code']);

			   }

			}

			else { $data['coupon_form'] = 'false'; }

		} elseif ($this->input->server('REQUEST_METHOD') === 'POST')

        {

            //form validation

            $this->form_validation->set_rules('id', 'id', 'required|trim');

            $this->form_validation->set_rules('qty', 'qty', 'required|trim|numeric');

            $this->form_validation->set_rules('name', 'name', 'required|trim');

			$this->form_validation->set_rules('price', 'price', 'required|trim|numeric');

			

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation

            if ($this->form_validation->run())

            {    

			$price = $this->input->post('qty') * $this->input->post('price');

			$image = $this->input->post('image');

			$desc = $this->input->post('desc');

            $insert_data = array(

               'id' => $this->input->post('id'),

               'name' => substr($this->input->post('name'),10),

               'p_name' => $this->input->post('name'),

               'price' => $this->input->post('price'),

               'qty' => $this->input->post('qty'), 

	       'comm_dis' => $this->input->post('comm_dis'),

               'i_total' => $price, 

	       'options' => array('image' => $image, 'desc' => $desc)

             );

			  // This function add items into cart.

              $this->cart->insert($insert_data);

			}  

		 }

		    $data['category_list'] = $this->customer_model->get_category_list();

	        $data['main_content'] = 'cart';

            $this->load->view('includes/front/front_template', $data); 



	}

	function remove($rowid) {

      // Check rowid value.

      if ($rowid==="all"){

       // Destroy data which store in session.

        $this->cart->destroy();

      } else {

     // Destroy selected rowid in session.

        $cart = $this->cart->contents();
        if(!empty($cart)) {
          foreach($cart as $car) {
            if(array_key_exists('pid', $car)) {
              if($car['pid']==$cart[$rowid]['id']) {
                   $data = array(

                     'rowid' => $car['rowid'],

                     'qty' => 0

                  );
                   $this->cart->update($data);
              }
            }
          }
        }

         $data = array(

                     'rowid' => $rowid,

                     'qty' => 0

                  );

        // Update cart data, after cancel.

      $this->cart->update($data);

	  } 

	  $this->session->set_userdata('coupon_val','');

				$this->session->set_userdata('coupon_code','');

		redirect(base_url().'cart');

    }

	

}