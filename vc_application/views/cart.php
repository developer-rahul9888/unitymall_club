<link href="<?php echo base_url(); ?>assets/front/css/style1.css" rel="stylesheet">
<div class="container">
<?php 
$cart = $this->cart->contents();
//echo '<pre>'; print_r($cart); die();
if(!empty($cart)) { 


if(empty($profile) ){$reward_wallet=0;} 
else { $reward_wallet = $profile[0]['reward_wallet']; }

$sub_total = $total = $comm_dis = $reward_point = 0;
$shipping = 0;
$tax=0;
$discount=0;
?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">My Cart (<?php echo $this->cart->total_items(); ?>)</li>
	</ol>
</div>
<form class="hide" method="post" action="/cart" id="updatecartform">
<input type="hidden" name="rowid" value="" class="rowid-val">
<input type="hidden" name="qty" value="" class="qty-val">
<input type="hidden" name="type" value="" class="type-val">
</form>	
	<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Your Items</td>
							<td class="description"></td>
							<td class="price">Item Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total Price</td>
							<td></td>
						</tr>
					</thead>
					
					<tbody>
					
					<?php  foreach ($cart as $items){ ?>
						<tr>
							<td class="cart_product">
								<img src="<?php echo $items['options']['image'];?>">
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $items['p_name']; ?></a></h4>
								<p>Pro. ID: #<?php echo $items['id']; ?></p>
							</td>
							<td class="cart_price">
								<p>₹<?php echo $items['price']; ?></p>
							</td>
							<td class="cart_quantity">
							<div class="cart_quantity_button">
									<a class="cart_quantity_up submit-cart" href="javascript:;" data-rowid="<?php echo $items['rowid']; ?>" data-qty="<?php echo $items['qty']; ?>" data-type="plus"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $items['qty']; ?>" autocomplete="off" size="2">
									<a class="cart_quantity_down submit-cart" href="javascript:;" data-rowid="<?php echo $items['rowid']; ?>" data-qty="<?php echo $items['qty']; ?>" data-type="minus"> - </a>
								</div>
							
							 
								<!--div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div-->
							</td>
							
							
							<td class="cart_total">
								<p class="cart_total_price">₹<?php echo $i_total = $items['qty'] * $items['price']; ?></p>
							</td>
							<td class="cart_delete">
								<?php if(!array_key_exists('pid', $items)) {?>
								<a class="cart_quantity_delete" href="<?php echo base_url().'cart/remove/'.$items['rowid'];?>"><i class="fa fa-times"></i></a> <?php } ?>
							</td>
						</tr>
						
						
						
<?php						
$stotal = $items['qty'] * $items['price'];					
$sub_total = $sub_total + $stotal;
$product_reward = $items['qty'] * $items['reward'];

if($reward_wallet > $product_reward) {
		$reward_wallet = $reward_wallet - $product_reward;
		$total = $total + ($stotal - $product_reward);
} elseif($reward_wallet > 0) {
		$total = $total + ($stotal-$reward_wallet);
} else {
		$total = $total + $stotal;
}

$tax = $total*$items['tax']/100;
$reward_point = $reward_point + ($items['qty'] * $items['reward']);
$comm_dis = $comm_dis + ($items['qty'] * $items['comm_dis']);

} 
	/******************* session define *****************/
$sub_total_for_coupon = $sub_total + $tax;
$this->session->set_userdata('order_sub_total',$sub_total);
$this->session->set_userdata('order_shipping',$shipping);
$this->session->set_userdata('order_tax',$tax);
$this->session->set_userdata('comm_dis',$comm_dis);
$this->session->set_userdata('reward_point',$reward_point);
?>

				</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->


<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
				
				</div>
				<div class="col-sm-6">
					<div class="total_area">
					
					<?php
				if(empty($profile) ){$discount=0;} else {
					if($profile[0]['reward_wallet'] >= $reward_point) { $discount=$reward_point; }
					else { $discount=$reward_point-$profile[0]['reward_wallet']; }
				}
				
//$total_order = (($sub_total + $tax + $shipping)-$discount);
$total_order = ($total + $shipping);
$this->session->set_userdata('order_total',$total_order);
$this->session->set_userdata('coupon_val',$discount);
?>
<ul>
							<li>Cart Sub Total <span>₹ <?php echo $sub_total; ?></span></li>
							<!-- <li> Reward Points <span> <?php echo $reward_point; ?></span></li> -->
							<li>Discount<span>₹ <?php echo $discount; ?></span></li>
							<li> Cart Total <span>₹ <?php echo $total; ?></span></li>
							<li> GST <span>₹ <?php echo round($tax,2); ?></span></li> 
							<!--<li>PIN<span>₹<?php echo $coupon_amount; ?></span></li>-->
							<!-- <li>Discount<span>₹<?php echo $discount; ?></span></li>
							<li>Shipping Charges<span>₹<?php echo $discount; ?></span></li> -->

							
							
							<li> Grand Total <span>₹ <?php echo round($total_order,2); ?></span></li>
              <li> Coins <span> <?php echo $comm_dis; ?></span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="<?php echo base_url();?>checkout">Check Out</a>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->



<!--div class="col-sm-12 like-may">
 <h2>You may also like</h2> 
 </div-->
 
<?php } else { ?>			
			<p class="text-center"><img src="<?php echo base_url();?>/assets/front/images/cart.png" ></p>
<h2 class="text-center">Your Cart is currently empty.</h2>
  <p class="text-center"><a class="btn btn-primary btn-lg crtbtn" href="<?php echo base_url();?>" role="button">Return to shop</a></p>
<p>&nbsp; </p>
<?php } ?>


</div>
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.min.js"></script>
<script>
jQuery(document).ready(function(){
	jQuery('.submit-cart').click(function(){
		jQuery('.qty-val').val(jQuery(this).attr('data-qty'));
		jQuery('.rowid-val').val(jQuery(this).attr('data-rowid'));
		jQuery('.type-val').val(jQuery(this).attr('data-type'));
		jQuery('#updatecartform').submit();
	});
});
</script>