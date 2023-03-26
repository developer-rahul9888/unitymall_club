 <link href="<?php echo base_url(); ?>assets/front/css/style1.css" rel="stylesheet">

<style type="text/css">
	 input[type="checkbox"], input[type="radio"] {
		width: auto !important;
	}
</style>
  <section class="page-title">
    	<div class="auto-container">
			<div class="content">
				<h1>Payment <span></span></h1>
				<ul class="page-breadcrumb">
					<li><a href="<?php echo base_url();?>">Home</a></li>
					
					<li>Payment</li>
				</ul>
			</div>
        </div>
    </section>

<section id="cart_items">	<div class="container">		<div class="breadcrumbs">		<ol class="breadcrumb">				<li><a href="/">Home</a></li>		<li class="active"><a href="/checkout">Check out</a></li>	<li class="active">Payment</li>	</ol>				</div><!--/breadcrums-->		
 <div class="stepwizard text-center">
    <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step text-left">
        <a href="<?php echo base_url();?>checkout" type="button" class="btn btn-primary btn-circle">Step 1</a>
        <p>Checkout</p>
      </div>
          <div class="stepwizard-step">
        <a href="javascript:;" type="button" class="btn btn-primary btn-circle" disabled="disabled">Step 2</a>
        <p>Payment</p>
      </div>
          <div class="stepwizard-step text-right">
        <a href="javascript:;" type="button" class="btn btn-default btn-circle" disabled="disabled">Step 3</a>
        <p>Thank you</p>
      </div>
        </div>
  </div>
<form id="bliss_perk_payment" method="post" action="">
<input type="hidden" name="bliss_perk_payment_input" value="true">
<input name="how_to_pay" value="blissperks" type="hidden">
</form>
<form id="cod_payment" method="post" action="">
<input type="hidden" name="cod_payment_input" value="true">
<input type="hidden" name="how_to_pay" value="cod">
<input name="veryfied" value="no" type="hidden">
<input name="phone" value="<?php echo $this->session->userdata('p_phone');?>" type="hidden">
</form>

<?php if($this->session->userdata('no_veryfied') != 'yes') { ?>
<div id="cod_payment_Modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Please click here to verify your number</h2>
      </div>
      <div class="modal-body row">
	  <div class="col-sm-12"> 
	  <?php if($veryfied_no_expire=='true') { ?>
	  <p>Your OTP is wrong please fill correct OTP or <a href="javascript:;" class="codradio">click here</a> for resend OTP</p>
	  <?php } ?>
        <form class="form" action="" method="post">
		
		OTP sent to ending number ******<?php echo substr($this->session->userdata('p_phone'),-4);?>
       <p><label>OTP</label> <input required="required" type="number" max="9999" min="999" name="otp" class="form-control input-empty"></p>
	  <input type="hidden" name="otp_num" value="<?php if($veryfied_msg_otp!='') { echo $veryfied_msg_otp; } else { echo $this->session->userdata('otp_number');} ?>"> 
	  <input type="hidden" name="verify_otp" value="true"> 
	  <input type="hidden" name="how_to_pay" value="cod">
       <p><label>&nbsp;</label> <input type="submit" name="submit" value="Verify" class="btn btn-primary"></p>
     </form>
	 </div>
	 
      </div>
      
    </div> 
  </div>
</div>
<?php } ?>


 <div class="shopper-informations">	
 <div class="row1">

<div class="col-sm-8"><?php echo validation_errors(); ?></div>
<div class="clearfix"></div>
      <form role="form" action="<?php echo base_url();?>payment" method="post">
	  <input type="hidden" name="order_coupon" value="<?php echo $this->session->userdata('coupon_code');?>">
	  <input type="hidden" name="coupon_val" value="<?php echo $this->session->userdata('coupon_val');?>">
	  <input type="hidden" name="p_name" value="<?php echo $this->session->userdata('p_name');?>">
	  <input type="hidden" name="p_email" value="<?php echo $this->session->userdata('p_email');?>">
	  <input type="hidden" name="p_phone" value="<?php echo $this->session->userdata('p_phone');?>">
	  <input type="hidden" name="p_address" value="<?php echo $this->session->userdata('p_address');?>">
	  <input type="hidden" name="p_address2" value="<?php echo $this->session->userdata('p_address2');?>">
	  <input type="hidden" name="p_city" value="<?php echo $this->session->userdata('p_city');?>">
	  <input type="hidden" name="p_state" value="<?php echo $this->session->userdata('p_state');?>">
	  <input type="hidden" name="p_zip" value="<?php echo $this->session->userdata('p_zip');?>">
	  <input type="hidden" name="message" value="<?php echo $this->session->userdata('spl_note');?>">
	  <input type="hidden" name="bliss_perk_error">
	  
	<div class="setup-content" id="step-2">
	 <div class="col-xs-4 to-0-1">
	<!-- <?php if($this->session->userdata('no_veryfied') == 'no') { ?>
	 <p>Please <a href="javascript:;" data-toggle="modal" data-target="#cod_payment_Modal">click here</a> for verify you number or <a href="javascript:;" class="codradio">click here</a> for recend OTP</p>
	 <?php } ?> -->
	 
	<h4 class="cft">How do you want to pay ?</h4>
          
        <ul>
		<li><label><input type="radio" <?php if($this->input->post('how_to_pay') == 'paytm' || $this->input->post('how_to_pay') != 'wallet') { echo 'checked="checked"'; } ?> checked="checked" name="how_to_pay" value="paytm"> Pay online</label></li> 
		
		
		
		<!--  <li class=""><label><input type="radio" <?php if($this->input->post('how_to_pay') == 'cod') { echo 'checked="checked"'; } ?> name="how_to_pay" value="cod"> Cash On Delivery</label></li>  -->
		
		<?php 
		$cust_id = $this->session->userdata('cust_id');
		if($cust_id!='') { 
          if(isset($profile) && $profile[0]['bliss_amount'] >= $this->session->userdata('order_total')) {
			  echo '<li><label class="blissperkradio"><input type="radio" ';
			  if($this->input->post('how_to_pay') == 'wallet') { echo 'checked="checked"'; }
			  echo ' name="how_to_pay" value="wallet">Wallet</label></li> ';
		  }
		}
		?>
		
		
		
		</ul>
      </div>
        </div>
	
			
		
		
<div class="col-xs-1">	</div>	
		 <div class="col-xs-12 to-0-1">
		  <h4 class="cft">Please confirm your address</h4>
        <div class="col-md-12 addrs">
		<div class="you-pay">
		  <?php if($coupon_error=='true') { ?>
		  <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please check your PIN.</strong></div>
		  <?php } ?>
		<ul>
		<li><strong><?php echo $this->session->userdata('p_name');?></strong></li>
		<li> Mob.: <?php echo $this->session->userdata('p_phone');?></li>
		<li> Email: <?php echo $this->session->userdata('p_email');?></li>
		<li> <?php echo $this->session->userdata('p_address').' '.$this->session->userdata('p_address2').' '.$this->session->userdata('p_zip').' '.$this->session->userdata('p_city').' '.$this->session->userdata('p_state');?></li>
		</ul>     
		<button class="btn btn-primary add-asrd" >Submit</button>
		</div>
		</div>
		
		
        </div>
    
  </form>
  </div>  
  </div>
  <div class="clearfix"></div>
 <div class="checkout-order-area">
				<div class="order-title pb-10 mb-20 text-uppercase">
					<h3>Your order</h3>
				</div>					
	<?php $this->load->view('cart_sidebar'); ?>												
	
	</div>
    </div>	</section>
<script>
/*jQuery(document).ready(function(){
	<?php if($cust_id!='') { 
          if(isset($profile) && $profile[0]['bliss_amount'] >= $this->session->userdata('order_total') && $this->session->userdata('coupon_val') > 0) { ?>
 jQuery('.blissperkradio').click(function(){
	jQuery('#bliss_perk_payment').submit();
 });
	<?php } } ?>
	<?php if($this->session->userdata('no_veryfied') != 'yes') { ?>
 jQuery('.codradio').click(function(){
	jQuery('#cod_payment').submit();
 });
	<?php }  
	if($veryfied_msg=='true') { 
	?>
	jQuery('#cod_payment_Modal').modal('show');
<?php } ?>
	
 jQuery('.show-emi').click(function() {
	 jQuery('tr.emi-payment').show();
 });
 jQuery('.hideemi').click(function() {
	 jQuery('tr.emi-payment').hide();
 });
});*/
</script>