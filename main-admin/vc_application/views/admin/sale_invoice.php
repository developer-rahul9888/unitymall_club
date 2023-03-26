	<?php //$this->load->view('admin/partials/admin_header.php'); ?>
	<!-- page content -->
	<style>
.right_col{font-size:15px;}
hr{border:1px solid #bbb}
	</style>
	<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url('assets/css/print.css');?>">
	<div class="right_col right1212" role="main">
		<div class="">
			<div class="page-title no-print">
				<div class="title_left"> <h2>Invoice</h2>
				</div>
			</div>
			<div class="clearfix"></div>
			
			<div class="col-sm-4 mobile-hide"></div>
			<div class="col-sm-4 mobile-hide text-center no-print"></div>
			<div class="col-sm-4 mobile-hide text-right no-print"><button class="btn btn-success" onclick="window.print();">Print</button> &nbsp;<a href="<?php echo base_url('admin/sale');?>" class="btn btn-primary b">Back</a></div>
			<div class="clearfix"></div>
			<hr class="mobile-hide no-print">
			<div class="clearfix"></div>
			
			 <?php 
			 if(empty($invoice) && empty($customer_info)) { echo 'Please check your incoice number'; }
			 else {  
			 $info = $invoice[0]; 
			 $cust = $customer_info[0];
			 ?>
			  
			<div class="clearfix"></div>
			
			 
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel"> 
						<div class="x_content">
							<div class="row"> 
							
			<div class="col-sm-2 text-center immg"><img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-responsive center-block"></div>
			<div class="col-sm-8 text-center">
			    <h3>FDN Marketting Pvt. Ltd.</h3><p><strong>Address:</strong> Plot no 80, Street no. 2, Vikas colony, Behind Heritage Garden, <br>Karnal Haryana, 132001<br><strong>Phone No:</strong> +91 9050346088<br><strong>Email :</strong> info@fdnmarketting.com
			 <?php // echo $cust['address'].' '.$cust['city'].'<br>'.$cust['pincode'].' '.$cust['state']; ?>
			 </p>
			 </div>
			 
			<div class="col-sm-2 text-center"></div>
							</div>
							
			<div class="clearfix"></div>
	 
			<hr> 
							<form method="post">
								<fieldset> 
								 <div class="row"> 
			<div class="col-sm-12 text-center"><h3>RETAIL INVOICE</h3></div>
							</div>
							<br>
								<div class="row">
									<div class="col-md-2 col-xs-2"><label>Invoice: </label></div>
									<div class="col-md-3 col-xs-3"> #<?php echo $info['id']; ?></div>  
									<div class="col-md-2 col-xs-1"></div>   
									<div class="col-md-2 col-xs-2"><label>Invoice Date: </label></div>
									<div class="col-md-3 col-xs-4"> <?php echo date('d F Y',strtotime($info['tdate'])); ?></div>  
								</div>		

								<div class="row">
									<div class="col-md-2 col-xs-3"><label>Distributor: </label></div>
									 <div class=" col-md-3 col-xs-2"> <?php echo $cust['f_name'].' '.$cust['l_name']; ?> (<?php echo $cust['customer_id']; ?>) </div>  
									<div class="col-md-2 col-xs-1"></div>   
									<div class="col-md-2 col-xs-2"><label>Print Date: </label></div>
									<div class="col-md-3 col-xs-4"> <?php echo date('d F Y'); ?></div>  
								</div>		
								<div class="row">
									<div class="col-md-2 col-xs-2"><label>Sponser: </label></div>
									<div class="col-md-3 col-xs-3"> <?php echo $cust['direct_customer_id']; ?></div>  
									<div class="col-md-2 col-xs-1"></div>   
									<div class="col-md-2 col-xs-2"><label>Email: </label></div>
									<div class="col-md-3 col-xs-4"> <?php echo $cust['email']; ?></div>  
								</div>		
<div class="row">
									 
									  
									<div class="col-xs-2"><label>Mobile: </label></div>
									<div class="col-xs-3"> <?php echo $cust['phone']; ?></div>  
								</div>	
								<div class="clearfix"></div>
								<hr> 
									<div class="row">
									    <div class="col-md-1 col-xs-1 text-center"><label>#</label></div> 
										<div class="col-md-5 col-xs-3 text-center"><label>Product</label></div> 
										<div class="col-md-1 col-xs-2 text-center"><label>Code</label></div> 
										<div class="col-md-1 col-xs-1 text-center"><label>Qty.</label></div>  
										 <div class="col-md-2 col-xs-2 text-center"><label>Price</label></div> 
										 <div class="col-md-1 col-xs-2 text-center hide"><label>Manual</label></div> 
										 <div class="col-md-2 col-xs-3 text-center"><label>Total Price</label></div>  
									</div>
									<hr>
									<?php 
									$products = array();
									if(!empty($info['products'])) {
										$products = json_decode($info['products'],true);
									}
									if(!empty($products)) {
										$i=1;
										
							   foreach($products as $product) { 
                                $prod = explode('~~',$product);	
                                 ?>
									<div class="row"> 
									    <div class=" col-md-1 col-xs-1 text-center"><?php echo $i;?></div>
										<div class="col-md-5 col-xs-3 text-center"><?php echo $prod[1];?></div>
										<div class="col-md-1 col-xs-2 text-center"><?php echo $prod[2];?></div>
                                        <div class="col-md-1 col-xs-1 text-center"><?php echo $prod[3];?></div> 	 
										 <div class="col-md-1 col-xs-2 text-center"><?php echo $prod[5];?></div>  
										<div class="col-md-1 col-xs-2 text-center hide">(<?php echo $prod[8];?>%) <?php echo $prod[6];?></div> 
										 <div class="col-md-2 col-xs-3 text-center"><?php echo $prod[7];?></div>  
									</div>
									<br>
									<?php 
									$i++;
								}
							   }
									
							   ?>
								 
									<hr> 
									
								<div class="row">
								    <div class="col-xs-6"></div>
								    <div class="col-xs-3 text-right"><label>Sub Total</label></div>
									<div class="col-xs-3 text-right">Rs. <?php echo $info['before_tax_amount']; ?></div>
								</div>	
								<div class="row">
								    <div class="col-xs-6"></div>
								    <div class="col-xs-3 text-right"><label>Payment Type</label></div>
									<div class="col-xs-3 text-right"><?php echo $info['payment_type']; ?></div>
								</div>	
								<div class="row">
								    <div class="col-xs-6"></div>
								    <div class="col-xs-3 text-right"><label>Discount</label></div>
									<div class="col-xs-3 text-right">Rs. <?php echo $info['discount']; ?></div>
								</div>	
								<div class="row hide">
								    <div class="col-xs-6"></div>
								    <div class="col-xs-3 text-right"><label>Manual Charge</label></div>
									<div class="col-xs-3 text-right">Rs. <?php echo $info['total_gst']; ?></div>
								</div>	
								<div class="row">
								    <div class="col-xs-6"></div>
								    <div class="col-xs-3 text-right"><label>Grand Total</label></div>
									<div class="col-xs-3 text-right">Rs.<label><?php echo $info['before_tax_amount']-$info['discount']; ?></label></div>
								</div>	
								
								</fieldset>
							</form>
						
							<hr>
							<br/>							
							<div class="row">
							<div class="col-sm-10 col-xs-8"><p>Declaration<br>
We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p></div>
<div class="col-sm-2 col-xs-4 text-right"> 
<p>E. &amp; O. E.</p>
<p>XXXX</p>
<p>Authorised Signatory</p></div>
							</div>
								
				<div class="row hide">
				    <div class="col-sm-12">
				        <strong>Address:</strong> New Mahavir colony, Bhamiyan kalan, <br>Ludhiana Punjab.<br><strong>Phone No:</strong> +91 9854944445<br><strong>Email :</strong> oscindia3@gmail.com
				        <?php echo $cust['address'].' '.$cust['city'].'<br>'.$cust['pincode'].' '.$cust['state']; ?>
				    </div>
				</div>	
						</div> <!-- /content --> 
					</div><!-- /x-panel --> 
				</div> <!-- /col --> 
			</div> <!-- /row --> 
			 <?php } ?>
		</div>
	</div> <!-- /.col-right --> 
	<!-- /page content -->

	<?php //$this->load->view('admin/partials/admin_footer'); ?>
	<script>
	jQuery('document').ready(function(){
		jQuery('.delete-product').click(function(){
			var cls = jQuery(this).attr('data-cls');
			jQuery(cls).html('');
		});
	});
	</script> 
