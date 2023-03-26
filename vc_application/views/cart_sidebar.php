 <div class="table-responsive cart_info">
   <table class="table table-condensed">
     <thead>
       <tr class="cart_menu">
         <th class="image">Item</th>
         <th class="description">Description</th>
         <th class="price">Price</th>
         <th class="quantity">Quantity</th>
         <th class="total">Total</th>
         <th></th>
       </tr>
     </thead>
     <tbody>
       <?php $cart = $this->cart->contents();
        if (!empty($cart)) {
          foreach ($cart as $items) {
            $i_total = $items['qty'] * $items['price'];

            echo '<tr>
    <td class="cart_product">	
    <a href=""><img src="' . $items['options']['image'] . '"></a>
    </td>							
    <td class="cart_description">	
    <h4><a href="">' . $items['p_name'] . '</a></h4>
    <p>Web ID: #' . $items['id'] . '</p>	
    </td>							
    <td class="cart_price">	
    <p>Rs. ' . $items['price'] . '</p>
    </td>					
    <td class="cart_quantity">	
  ' . $items['qty'] . '								
    <!--div class="cart_quantity_button">									<a class="cart_quantity_up" href=""> + </a>									<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">									
    <a class="cart_quantity_down" href=""> - </a>								</div-->							
    </td>							
    <td class="cart_total">
    <p class="cart_total_price">Rs. ' . $i_total . '</p>
    </td>							
    <td class="cart_delete">
    <a class="cart_quantity_delete" href="' . base_url() . 'cart/remove/' . $items['rowid'] . '"><i class="fa fa-times"></i></a>
    </td>	
    </tr>';
          }
        }    ?>
       <tr>
         <td colspan="4">&nbsp;</td>
         <td colspan="2">
           <table class="table table-condensed total-result">
             <tr>
               <td>Cart Sub Total</td>
               <td>₹ <?php echo round($this->session->userdata('order_sub_total'), 2); ?></td>
             </tr>
             <!--  <tr class="shipping-cost">	
    <td>Shipping Cost</td>
    <td>Rs. <?php echo $this->session->userdata('order_shipping'); ?></td>
    </tr> -->
             <tr class="tax">
               <td>GST</td>
               <td>₹ <?php echo round($this->session->userdata('order_tax'), 2); ?></td>
             </tr>
             <tr class="tax">
               <td>Reward Points</td>
               <td>₹ <?php echo round($this->session->userdata('reward_point'), 2); ?></td>
             </tr>
             <tr class="discount">
               <td>Discount</td>
               <td>₹ <?php echo $this->session->userdata('coupon_val'); ?></td>
             </tr>
             <tr>
               <td>Total</td>
               <td>₹ <?php echo round($this->session->userdata('order_total'), 2); ?></td>
             </tr>
             <!-- <tr>
               <td>Distribution Amount</td>
               <td> <?php echo $this->session->userdata('comm_dis'); ?></td>
             </tr> -->
             <tr class="emi-payment" style="display:none;">
               <td>First EMI instalment</td>
               <td><span>Rs. <?php echo round(($this->session->userdata('order_total') / 2), 2); ?></span></td>
             </tr>
           </table>
         </td>
       </tr>
     </tbody>
   </table>
 </div>