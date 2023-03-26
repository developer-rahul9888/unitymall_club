	<?php //$this->load->view('admin/partials/admin_header.php'); ?>
	<!-- page content -->
	<style>
.right_col{font-size:14px;}
hr{border:1px solid #bbb}

.right_col hr {margin:0 auto}

	</style>
	<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url('assets/css/print.css');?>">
	<div class="right_col" role="main">
		<div class="">
		<div class="page-heading"> 
			<div class="flr mobile-hide text-right"><a href="<?php echo base_url('admin/sale');?>" class="btn btn-primary b">Back</a></div>
			<div class="flr mobile-hide text-right"><button class="btn btn-primary" onclick="window.print();">Print</button></div> 
			
        <h2>Invoice</h2>
      </div>
		
		
			
			
			
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
			<div class="col-sm-12 text-center">
			
			 <h3>FDN Marketting Pvt. Ltd.</h3><p><br>
			 <strong>Address:</strong> Plot no.181 HSIDC industrial area<br> Jhinwerheri, Karnal 132114 <br>
<strong>Phone No:</strong>+91 9050346088<br>
<strong>Email :</strong> info@firstnetdeal.com <br>
			 </p>
			
			
			</div>
							</div>
							
			<div class="clearfix"></div>
	 
			<hr> 
							<form method="post">
								<fieldset> 
								 <div class="row"> 
			<div class="col-sm-12 text-center"><h3>TAX INVOICE</h3></div>
							</div>
							<div class="row">
									<div class="col-xs-2"><label>Invoice: </label></div>
									<div class="col-xs-3">Bestarget 2019 #<?php echo $info['id']; ?></div>  
									<div class="col-xs-1"></div>   
									<div class="col-xs-2"><label>Invoice Date: </label></div>
									<div class="col-xs-4"> <?php echo date('d F Y',strtotime($info['tdate'])); ?></div>  
								</div>		

								<div class="row">
									<div class="col-xs-2"><label>Dist: </label></div>
									 <div class="col-xs-3"> <?php echo $cust['customer_id']; ?>, <?php echo $cust['f_name'].' '.$cust['l_name']; ?></div>  
									<div class="col-xs-1"></div>   
									<div class="col-xs-2"><label>Print Date: </label></div>
									<div class="col-xs-4"> <?php echo date('d F Y'); ?></div>  
								</div>		
								<div class="row">
									<div class="col-xs-2"><label>Sponser: </label></div>
									<div class="col-xs-3"> <?php echo $cust['parent_customer_id']; if(!empty($sponser_name)) { echo ' '.$sponser_name[0]['f_name'].' '.$sponser_name[0]['l_name']; } ?></div>  
									<div class="col-xs-1"></div>   
									<div class="col-xs-2"><label>Email: </label></div>
									<div class="col-xs-4"> <?php echo $cust['email']; ?></div>  
								</div>		
<div class="row">
									<div class="col-xs-2"><label>Remark: </label></div>
									<div class="col-xs-3"><?php echo $cust['rank']; ?> With <?php echo $info['payment_type']; ?> ( <?php echo $info['slip_no']; ?> )</div>  
									<div class="col-xs-1"></div>   
									<div class="col-xs-2"><label>Mobile: </label></div>
									<div class="col-xs-4"> <?php echo $cust['phone']; ?></div>  
								</div>									
								<hr> 
									<div class="row">
									    <div class="col-xs-1 text-center"><label>#</label></div> 
										<div class="col-xs-2 text-center"><label>Product</label></div> 
										<div class="col-xs-2 text-center"><label>Code</label></div> 
										<div class="col-xs-1 text-center"><label>Qty.</label></div> 
										<div class="col-xs-1 text-center"><label>Size</label></div> 
										 <div class="col-xs-1 text-center"><label>Price</label></div> 
										 <div class="col-xs-2 text-center"><label>GST</label></div> 
										 <div class="col-xs-2 text-center"><label>Total Price</label></div>  
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
									    <div class="col-xs-1 text-center"><?php echo $i;?></div>
										<div class="col-xs-2 text-center"><?php echo $prod[1];?></div>
										<div class="col-xs-2 text-center"><?php echo $prod[2];?></div>
                                        <div class="col-xs-1 text-center"><?php echo $prod[3];?></div> 	
										<div class="col-xs-1 text-center"><?php echo $prod[4];?></div> 
										 <div class="col-xs-1 text-center"><?php echo $prod[5];?></div>  
										<div class="col-xs-2 text-center">(<?php echo $prod[8];?>%) <?php echo $prod[6];?></div> 
										 <div class="col-xs-2 text-center"><?php echo $prod[7];?></div>  
									</div>
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
								    <div class="col-xs-3 text-right"><label>CGST</label></div>
									<div class="col-xs-3 text-right">Rs. <?php echo $info['total_gst']/2; ?></div>
								</div>
                           <div class="row">
								    <div class="col-xs-6"></div>
								    <div class="col-xs-3 text-right"><label>SGST</label></div>
									<div class="col-xs-3 text-right">Rs. <?php echo $info['total_gst']/2; ?></div>
								</div>								
								<!--div class="row">
								    <div class="col-xs-6"></div>
								    <div class="col-xs-3 text-right"><label>Payment Type</label></div>
									<div class="col-xs-3 text-right"><?php echo $info['payment_type']; ?></div>
								</div>	
								<div class="row">
								    <div class="col-xs-6"></div>
								    <div class="col-xs-3 text-right"><label>Discount</label></div>
									<div class="col-xs-3 text-right">Rs. <?php echo $info['discount']; ?></div>
								</div-->	
								<div class="row">
								    <div class="col-xs-6"></div>
								    <div class="col-xs-3 text-right"><label>Grand Total</label></div>
									<div class="col-xs-3 text-right">Rs.<label><?php echo $info['gtotal']; ?></label></div>
								</div>	
								
								</fieldset>
							</form>
						
							
							<hr>
							<br/>	

<div class="row">
							<div class="col-sm-7 col-xs-7"><p>Prepared By :FDN Marketting Pvt. Ltd.</p></div>
<div class="col-sm-5 col-xs-5 text-right"> 
<p>Customer : <?php echo $cust['f_name'].' '.$cust['l_name']; ?></p>
<p></p></div>
							</div>							
							<!--div class="row">
							<div class="col-sm-10 col-xs-10"><p>Declaration<br>
We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.</p></div>
<div class="col-sm-2 col-xs-2 text-right"> 
<p>E. &amp; O. E.</p>
<p>I Mish</p>
<p>Authorised Signatory</p></div>
							</div-->
									
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
