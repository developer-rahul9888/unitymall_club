	<?php //$this->load->view('admin/partials/admin_header.php'); ?>
	<!-- page content -->
	<style>
.right_col{font-size:15px;}
hr{border:1px solid #bbb}
	p {margin:0}
	</style>
	<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url('assets/css/print.css');?>">
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title no-print">
				<div class="title_left"> <h2>Invoice</h2>
				</div>
			</div>
			<div class="clearfix"></div>
			
			<div class="col-sm-4 mobile-hide"></div>
			<div class="col-sm-4 mobile-hide text-center no-print"><button class="btn btn-success" onclick="window.print();">Print</button></div>
			<div class="col-sm-4 mobile-hide text-right no-print"><a href="<?php echo base_url('admin/pin_sale');?>" class="btn btn-primary b">Back</a></div>
			<div class="clearfix"></div>
			<hr class="mobile-hide no-print">
			<div class="clearfix"></div>
			
			 <?php 
			 if(empty($order) && empty($customer_info)) { echo 'Please check your incoice number'; }
			 else {  
			 $order_data = $order[0]; 
			 $profile = $profile[0];
			 ?>
			  
			<div class="clearfix"></div>
			
			<!--   New Order Bill format Start    -->
			 <fieldset>
	
	<table class="table border" border="1" cellspacing="0" cellpadding="5">
	  <tr>
	  <td colspan="4"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="img-responsive" width="100px"></td>
	  <td colspan="3"><h3>INVOICE</h3></td>
			</tr>
			
			
	  <tr>
	  
	  <td colspan="3">
	  <b>Unitymall Inc</b>
            <p><b> Address: </b> Gadag 582 101 Karnataka. </p>
			<p>Email :    info@unitymall.in</p>		
			<p>Website : www.unitymall.in</p>
	</td>
	  <td> <b>Invoice No.</b> <p>#<?php echo $order_data['id'];?></p> <b>HSN code.</b><p></p></td>
	  <td> <b>Dated </b> <?php echo $order_data['o_date'];?><br> <b>GST No.</b> 29AAYPU6483H1ZI </td>
	 </tr>
	 
	  <tr>
	  <td colspan="4">
	  <b>Customer Name & Address</b>
	  <p><?php echo $profile['f_name'].' '.$profile['l_name']; ?></p>
	<?php //echo $order_data['p_address'].' '.$order_data['p_address2'].' '.$order_data['p_city'].' '.$order_data['p_zip']; ?>
	<?php echo $profile['address'].' '.$profile['city'].' ';
		if($profile['pincode'] > 0) { echo $profile['pincode']; } ?><br>
	<p><?php echo $profile['state']; ?></p>
			</td>
			<td colspan="3"><b>User Id</b> :-<b><?php echo $profile['customer_id'];?></b>
			<br>
			<b>Sponser: </b><?php echo $profile['direct_customer_id']; ?>
			
			</td>
			</tr>
	 
	 
	 	<?php 
$cart = json_decode($order_data['items'],true);
?>
	 
	 <tr><td><b>S.No.</b></td><td><b>Description</b></td><td><b>Quantity</b></td><td><b>Amount</b></td><td><b>Total</b></td></tr>
	 <?php foreach($cart as $items) { ?>
	  <tr>
	  <td>1</td>
	  <td><?php echo $items['name']; ?></td>
	  <td><?php echo $items['qty']; ?></td>
	  <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $items['cost']; ?></td>
	  <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $items['cost']; ?></td>
	  </tr>
	  <?php } ?>
 <tr><td colspan="5"></td></tr>
 <tr><td colspan="3" rowspan="5"></td></tr>
	  <tr><td colspan="1">Sub total</td><td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $order_data['total_amount']; ?></td></tr>
	  <tr><td colspan="1">GST</td><td><span><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $order_data['tax']; ?></span></td></tr>
	  <tr><td colspan="1"><strong>Grand total</strong></td><td><span><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $order_data['total_amount']; ?></span></td></tr>
	  </table>
	  
	  
	  <div class="row">
	
<div class="col-sm-12 text-right"> E. & O.E.</div>

<div class="col-sm-12 text-right" style="margin-top:15px">Unity Mall</div>

<div class="col-sm-12 col-xs-12 " style="margin-top:15px;"><b>Declaration:</b> We declare that this Invoice shows the actual  price of the goods described and that all particulars are true and correct.</div>

<div class="col-sm-12 col-xs-12 text-center" style="margin-top:15px">This is system genrated invoice no signature required</div>


							</div>	
		
        </fieldset>
		
			<!--   New Order Bill format End    -->
			
			<div class="clearfix"></div>
			
			 
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
