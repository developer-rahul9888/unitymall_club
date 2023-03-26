 <link href="<?php echo base_url(); ?>assets/front/css/style1.css" rel="stylesheet">

 <section class="page-title">
 	<div class="auto-container">
 		<div class="content">
 			<h1>Checkout <span></span></h1>
 			<ul class="page-breadcrumb">
 				<li><a href="<?php echo base_url(); ?>">Home</a></li>

 				<li>Checkout</li>
 			</ul>
 		</div>
 	</div>
 </section>


 <section id="cart_items">
 	<div class="container">
 		<div class="breadcrumbs">
 			<ol class="breadcrumb">
 				<li><a href="/">Home</a></li>
 				<li class="active">Checkout</li>
 			</ol>
 		</div>
 		<!--/breadcrums-->

 		<div class="stepwizard text-center">
 			<div class="stepwizard-row setup-panel">
 				<div class="stepwizard-step text-left">
 					<a href="javascript:;" type="button" class="btn btn-primary btn-circle">Step 1</a>
 					<p>Shipping</p>
 				</div>
 				<div class="stepwizard-step">
 					<a href="javascript:;" type="button" class="btn btn-default btn-circle " disabled="disabled">Step 2</a>
 					<p>Payment</p>
 				</div>
 				<div class="stepwizard-step text-right">
 					<a href="javascript:;" type="button" class="btn btn-default btn-circle " disabled="disabled">Step 3</a>
 					<p>Thank you</p>
 				</div>
 			</div>
 		</div>

 		<div class="container">
 			<?php
				//flash messages
				if ($this->session->flashdata('flash_message')) {
					if ($this->session->flashdata('flash_message') == 'need_login') {
						echo '<div class="alert alert-danger">';
						echo '<a class="close" data-dismiss="alert">×</a>';
						echo '<strong>Error!</strong> please login before payment.';
						echo '</div>';
					}
				}
				?>
 		</div>


 		<?php $cust_id = $this->session->userdata('cust_id');
			if ($cust_id == '') { ?>
 			<div class="checkout-options">
 				<h3>New User</h3>
 				<p>Checkout options</p>

 				<ul class="nav">
 					<li>
 						<label>

 							<!-- echo '<p><a href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">Click here</a> for login. For complete you order you need to login first.</p>'; -->

 							<input type="checkbox" class="ckh"> Register Account
 						</label>
 					</li>
 					<li>
 						<label><input class="ckh" type="checkbox"> Login</label>
 					</li>
 					<!--li>	
	<a href=""><i class="fa fa-times"></i>Cancel</a>
	</li-->

 				</ul>

 				<script>
 					jQuery('.ckh').on('change', function(e) {
 						if (e.target.checked) {
 							jQuery('#registerLoginModal').modal();
 						}
 					});
 				</script>
 			</div>
 			<!--/checkout-options-->
 			<div class="register-req">
 				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
 			</div>
 			<!--/register-req-->

 		<?php	} ?>

 		<div class="shopper-informations">
 			<div class="row">


 				<?php
					if (empty($customer_add)) {
						$customer = array('name' => '', 'email' => '', 'phone' => '', 'address' => '', 'city' => '', 'state' => '', 'pincode' => '');
					} else {
						$customer = array('name' => $customer_add[0]['f_name'] . ' ' . $customer_add[0]['l_name'], 'email' => $customer_add[0]['email'], 'phone' => $customer_add[0]['phone'], 'address' => $customer_add[0]['address'], 'city' => $customer_add[0]['city'], 'state' => $customer_add[0]['state'], 'pincode' => $customer_add[0]['pincode']);
					}
					?>

 				<div class="col-sm-9 clearfix">
 					<div class="bill-to">
 						<p>Bill To</p>

 						<form role="form" action="<?php echo base_url(); ?>checkout" method="post">

 							<div class="form-one">
 								<input value="<?php if ($this->session->userdata('p_name') != '') {
													echo $this->session->userdata('p_name');
												} else {
													echo $customer['name'];
												}  ?>" name="name" type="text" required="required" class="form-control" placeholder="Name *" />
 								<input value="<?php if ($this->session->userdata('p_email') != '') {
													echo $this->session->userdata('p_email');
												} else {
													echo $customer['email'];
												} ?>" name="email" type="email" required="required" class="form-control" placeholder="Email *" />
 								<input value="<?php if ($this->session->userdata('p_phone') != '') {
													echo $this->session->userdata('p_phone');
												} else {
													echo $customer['phone'];
												} ?>" name="phone" type="text" required="required" class="form-control" placeholder="Phone *" />
 								<input value="<?php if ($this->session->userdata('p_address') != '') {
													echo $this->session->userdata('p_address');
												} else {
													echo $customer['address'];
												} ?>" name="address" type="text" required="required" class="form-control" placeholder="Address 1 *" />
 								<input value="<?php echo $this->session->userdata('p_address2'); ?>" type="text" name="address2" class="form-control" placeholder="Address 2 *" />
 							</div>
 							<div class="form-two">
 								<input value="<?php if ($this->session->userdata('p_city') != '') {
													echo $this->session->userdata('p_city');
												} else {
													echo $customer['city'];
												} ?>" name="city" type="text" required="required" class="form-control" placeholder="City *" />

 								<input value="<?php if ($this->session->userdata('p_state') != '') {
													echo $this->session->userdata('p_state');
												} else {
													echo $customer['state'];
												} ?>" name="state" type="text" required="required" class="form-control" placeholder="State *" />

 								<input value="<?php if ($this->session->userdata('p_zip') != '') {
													echo $this->session->userdata('p_zip');
												} else {
													echo $customer['pincode'];
												} ?>" name="zip" type="text" required="required" class="form-control" placeholder="Zip *" />

 								<textarea name="message" placeholder="Notes about your order, Special Notes for Delivery" rows="5"></textarea>
 								<label class="hide"><input type="checkbox" name="shipping" value="Regular" checked="checked"> Free Shipping</label>


 								<div class="col-sm-12 text-right">
 									<p> <button class="btn btn-primary nextBtn" type="submit">Next</button></p>
 								</div>
 							</div>

 						</form>

 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="review-payment">
 			<h2>Review & Payment</h2>
 		</div>
 		<?php $this->load->view('cart_sidebar'); ?>
 	</div>
 </section>