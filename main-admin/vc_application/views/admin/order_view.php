<?php $order_data = $order[0]; ?>
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	.itm-lst li span{float:right;}
		 .itm-lst li{clear:both;}
		 .table td{border: 1px solid #ddd;}
		 .print-div{margin: auto;max-width: 800px;display:none;}
		 hr{border-top: 1px solid #ddd;margin:0;padding:13px 0;}
	 </style>
	 <link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url('assets/css/print.css');?>">
	 
      <div class="page-heading no-print">
	  <a class="btn btn-primary flr" href="<?php echo base_url().'admin/order'; ?>">Back</a>
	  <a class="btn btn-primary flr" href="javascript:;" onclick="window.print();" style="margin-right:15px;">Print</a>
        <h2>Order #<?php echo $order_data['id'];?></h2>
      </div>
	  
 
      <?php
      //flash messages
     /* if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> category updated successfully.';
          echo '</div>';       
        } else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }*/
	  //print_r($restaurants);
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form form-inline no-print', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/order/'.$this->uri->segment(3).'', $attributes);
	  
      ?>
	  
	  <div class="row"> 
							
			<div class="col-sm-2 text-center immg"><img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-responsive center-block"></div>
			<div class="col-sm-8 text-center">
			    <h3>Unitymall INC</h3><strong>Phone No:</strong> +91 9050346088<br><strong>Email :</strong> info@unitymall.in
				<br><strong>GST No.:</strong> 29AAYPU6483H1ZI
			 <?php // echo $cust['address'].' '.$cust['city'].'<br>'.$cust['pincode'].' '.$cust['state']; ?>
			 </p>
			 </div>
			 
			<div class="col-sm-2 text-center"></div>
							</div>
							
        <fieldset>
		<input type="hidden" value="<?php echo $order_data['id']; ?>" name="cid">
		
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Contact Info</h4></div>
            <div class="panel-body dessc">
				<div class="col-sm-8">
			  <h4><b>Name : </b><?php echo $order_data['p_name']; ?></h4>
			<b> Email :</b>  <?php echo $order_data['p_email']; ?><br>
			<b>Phone Nunber : </b>  <?php echo $order_data['p_phone']; ?><br>
			<b> Address :</b>  <?php echo $order_data['p_address'].' '.$order_data['p_address2'].' '.$order_data['p_city'].' '.$order_data['p_zip'].' '.$order_data['p_state']; ?><br><br>
			</div>
			
				<div class="col-sm-4">
					<h4>Status <span style="color:#ff0000;"><?php if($order_data['emi']=='no' || $order_data['emi']=='yes') {} else { echo 'EMI Payment'; }?></span> </h4>
					<select name="status" class="form-control">
					<option value="">Status</option>
					<option <?php if($order_data['status']=='Accepted') { echo 'selected="selected"'; } ?> value="Accepted">Accepted</option>
					<option <?php if($order_data['status']=='Pending') { echo 'selected="selected"'; } ?> value="Pending">Pending</option>
					<option <?php if($order_data['status']=='Cancel') { echo 'selected="selected"'; } ?> value="Cancel">Cancel</option>
					<option <?php if($order_data['status']=='Delivered') { echo 'selected="selected"'; } ?> value="Delivered">Delivered</option>
					</select>
					<input type="submit" name="submit" class="btn btn-primary" value="Submit">
<br><br>
<?php if(empty($distribution) && 1==2) {
  echo '<a class="btn btn-success btn-sm" href="'.base_url().'admin/order/distribute/'.$this->uri->segment(3).'">Distribute Amount</a>';
} ?><br><br>
				</div>
			</div>
        </div>
		
		<?php 
$sub_total = 0;
$shipping = 0;
$tax = 0;
$cart = $order_item;
?>

		<div class="panel panel-default order-panel">
			<div class="panel-heading"><h4>Items</h4></div>
            <div class="panel-body">
			  <div class="col-sm-12 top-tem">
				<div class="col-sm-4 col-xs-3 dt01"><h4>Your Items</h4></div>
				<div class="col-sm-2 col-xs-2 dt01"><h4>HSN Code</h4></div>
				<div class="col-sm-2 col-xs-2 dt01"><h4>Item Price</h4></div>
				<div class="col-sm-2 col-xs-2 dt01"><h4>Quantity</h4></div>
				<div class="col-sm-2 col-xs-3 dt01"><h4>Total Price</h4></div>
<div class="clearfix"></div>
			  <?php $icount = 1; 
			  foreach($cart as $items) { //echo '<pre>'; print_r($items); echo '</pre>' ?>
<div class=" row-item-<?php echo $icount;?>">

<div class="col-sm-4 col-xs-3 dt01"> 
<div class="col-sm-4  item-img">
<img src="<?php echo $items['product_image'];?>" style="max-width: 85px;margin-bottom: 5px;">
</div>
<div class="col-sm-8  item-info">
<h4><?php echo $items['product_title']; ?></h4>
</div>

</div>

<div class="col-sm-2 col-xs-2 dt01"> 
<div class="dat0">#<?php echo $items['id']; ?></div>
</div>
<div class="col-sm-2 col-xs-2 dt01"> 
<div class="dat0">Rs<?php echo $items['price']; ?></div>
</div>
<div class="col-sm-2 col-xs-2 dt01">
<div class="dat0"><?php echo $items['quantity'];?></div>
</div>
<div class="col-sm-2 col-xs-3 dt01">
<div class="dat0">Rs<?php echo $i_total = $items['quantity'] * $items['price']; ?> </div> 
</div>

<div class="clearfix"></div>
</div>

<?php $icount = $icount + 1;

$stotal=$items['quantity'] * $items['price'];						
$sub_total = $sub_total + $stotal;
//$sub_total = $sub_total + $i_total;
$tax =$items['quantity']*$items['tax'];
//$tax = 0;
 } ?>
 <!--div class="col-sm-12 text-center"><button class="btn btn-primary btn-sm addnewitem">Add New Item</button><br><br></div-->
 <div class="add-new-item-div">

 </div>
 
			</div>
			
			<div class="col-sm-12 notee">
<div class="col-sm-5">

<b>Special Note :-</b><br/>
<?php echo $order_data['spl_note']; ?>


</div>
<div class="col-sm-7 itm-lst">
<ul>
<?php  $total_order = $sub_total + $tax + $shipping; ?>
<li> Sub total <span>Rs<?php echo $sub_total; ?></span></li>
<li> Tax <span>Rs<?php echo $order_data['tax']; ?></span></li>
<li> Shiipping <span>Rs<?php echo $order_data['shipping']; ?></span></li>
<li> Grand total <span>Rs<?php echo $order_data['total_amount']; ?></span></li>
</ul>




</div>
</div>
<!-- <div class="col-sm-12 text-center"><br><input type="submit" name="submit" class="btn btn-success" value="Submit"><br><br></div> -->
        </div>
		
 </div>
		   
		  	 

          <!--div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php //echo base_url().'admin/order'; ?>">Cancel </a>
          </div-->
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <div class="print-div row">
	  <div class="table-responsive">
	  <table class="table border" border="1" cellspacing="0" cellpadding="5">
	 
	  <tr class="center"><td colspan="5"><img src="<?php echo base_url(); ?>images/logo.png" width="100"></td></tr>
	  <tr class="center"><td colspan="5">www.unitymall.com</td></tr>
	  <tr><td colspan="2"><?php echo $order_data['p_name']; ?></td><td colspan="3"><?php echo $order_data['p_address'].' '.$order_data['p_address2'].' '.$order_data['p_city'].' '.$order_data['p_zip'].' '.$order_data['p_state']; ?></td></tr>
	  <tr><td colspan="2"><?php echo $order_data['o_date']; ?></td><td colspan="3">Order ID: <?php echo $order_data['id']; ?></td></tr>
	  <tr><td>S. No.</td><td>Item</td><td>Qty</td><td>Rate</td><td>Amount</td></tr>
	  <?php 
	  $sub_total = 0; $i = 1; 
	  foreach($cart as $items) { ?>
	  <tr><td><?php echo $i;?></td>
	  <td><?php echo $items['p_name']; ?></td>
	  <td><?php echo $items['qty']; ?></td><td>Rs<?php echo $items['price']; ?></td>
	  <td>Rs<?php echo $i_total = $items['qty'] * $items['price']; 
	  $sub_total = $sub_total + $i_total;?></td></tr>
	  <?php $i++; } ?>
	  <tr class="center"><td colspan="4">Sub Total</td><td>Rs <?php echo $sub_total;?></td></tr>
	  <tr class="center"><td colspan="4">Tax</td><td>Rs <?php echo $order_data['tax'];?></td></tr>
	  <tr class="center"><td colspan="4">Total</td><td>Rs <?php echo $order_data['total_amount'];?></td></tr>
	  <tr class="center"><td colspan="5">Above amount is including of SGST & CGST</td></tr>
	  <tr class="center"><td colspan="5">Payment Mode: <?php if($order_data['how_to_pay']=='cod') { echo 'Cash on Delivery'; } else { echo $order_data['how_to_pay']; } ?></td></tr>
	  </table>
	  </div>
	  <br><br>
	  <div class="col-sm-12">
	  <span>Please share your feedback</span>
	  <br><br><br><hr>
	  <br><hr>
	  <br><hr>
	  <br><br><br>
	  </div>
	  
	  <div class="col-sm-6">Delivered By</div>
	  <div class="col-sm-6 text-right">Reciever's Signature</div>
	  
	  </div>
	
<script>
jQuery(document).ready(function() {
	jQuery(document).on('click','.removeItem',function() {
		var cls = jQuery(this).attr('data-cls');
		jQuery(cls).html('');
		jQuery(cls).remove();
	});
	var i = 9999999;
	jQuery('.addnewitem').click(function(){
		var item = ' <div class="row row-item-'+i+'"><input type="hidden" value="http://www.blisszon.com/images/product.jpg" name="img[]"><input type="hidden" value="" name="desc[]"><input type="hidden" value="" name="iid[]"><input type="hidden" value="" name="pname[]"><input type="hidden" value="0" name="comm_dis[]"><input type="hidden" value="0" name="i_total[]"><input type="hidden" value="new" name="rowid[]"><input type="hidden" value="0" name="subtotal[]"><div class="col-sm-6 dt0"><input type="text" class="form-control" style="width:100%" required value="" name="iname[]"></div><div class="col-sm-2 dt0"> <div class="dat0">₹<input min="1" type="number" required style="width: 90px;" value="10" name="price[]"></div></div><div class="col-sm-2 dt0"><div class="dat0"><input type="number" required min="1" value="1" name="qty[]" style="width: 69px;"></div></div><div class="col-sm-2 dt0"><div class="dat0"><a style="color:#ff0000;font-weight:bold;float:right;font-size: 20px;" class="removeItem" data-cls=".row-item-'+i+'" href="javascript:;">X</a></div> </div><div class="clearfix"></div><br></div>';
		jQuery('.add-new-item-div').append(item);
		i++;
	});
});
</script>	