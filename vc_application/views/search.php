<style>


.main-body {
    padding: 0px 0px;
}
.row {
    margin-right: 0;
    margin-left: 0;
}
.post_ad {
    -khtml-border-radius: 6px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    margin-top: 20px;
    border: 1px solid #c2c2c2;
    box-sizing: border-box;
    padding: 15px 0;
    padding-right: 0px;
    padding-left: 0px;
    -webkit-box-shadow: 0 0 5px rgb(0 0 0 / 30%);
    -moz-box-shadow: 0 0 5px rgba(0, 0, 0, .3);
    box-shadow: 0 0 5px rgb(0 0 0 / 30%);
    position: relative;
    margin-right: 10px;
    background: #fff;
}
.ribbon-wrapper-green {
    width: 85px;
    height: 88px;
    overflow: hidden;
    position: absolute;
    top: -2px;
    right: -2px;
}
.ribbon-green {
    background-image: -webkit-gradient(linear, left top, left bottom, from(#3b5998), to(#3b5998));
    background-image: -webkit-linear-gradient(top, #3b5998, #3b5998);
    background-image: -moz-linear-gradient(top, #3b5998, #3b5998);
    background-image: -ms-linear-gradient(top, #3b5998, #3b5998);
    background-image: -o-linear-gradient(top, #3b5998, #3b5998);
}
.classi, .emart, .profile, .promo, .sale, .stock {
    color: #fff;
    padding-left: 20px;
    border-top-right-radius: 6px;
}
.viewit {
    margin: 0 5px 3px 0 !important;
}
.post_ad .viewit p {
    font-size: 18px;
}
.post_ad p {
    text-align: left !important;
}
.col-item .info .rating, a {
    color: #142c75;
}
a {
    cursor: pointer;
}
.col-md-2.col-sm-2.pic_dt.cl_both {
    margin-bottom: 0;
}
.pic_dt {
    height: 100px !important;
    text-align: center;
}
.cl_both {
    clear: both !important;
}
.post_ad .col-md-6.col-sm-4.pull-right {
    padding-right: 0 !important;
}
p .btn {
    text-transform: capitalize;
    padding: 3px 10px !important;
    background: #222d8d;
    border: 1px solid #222d8d;
}
.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.product-image-wrapper {
    border: 1px solid #cccccc;
    overflow: hidden;
    margin-bottom: 20px;
    margin-top: 20px;
    height: 390px;
    background: #fff;
}
.productinfo .disc {
    background: #EB3903 none repeat scroll 0 0;
    color: #fff;
    font-size: 17px;
    font-weight: 700;
    height: 26px;
    margin-bottom: 0;
    width: 73px;
    position: absolute;
}

.productinfo p {
    font-size: 14px;
    font-weight: 400;
    color: #696763;
    margin-bottom: 0;
    padding-bottom: 10px;
}
.productinfo img {
    width: 100%;
    height: 180px;
}
.productinfo h2 {
    color: #EB3903;
    font-size: 24px;
    font-weight: 700;
    margin: 0px;
    padding: 10px;
    border-top: 1px solid #cccccc;
}
.productinfo h2 span {
    color: #878787;
    display: inline-block;
    font-size: 14px;
    margin-left: 15px;
    text-decoration: line-through;
}
.productinfo p {
    font-size: 14px;
    font-weight: 400;
    color: #696763;
    margin-bottom: 0;
    padding-bottom: 10px;
}
.btn.btn-fefault.cart {
    min-height: 45px;
}
.pro_qty {
    width: 30% !important;
    margin: 10px 7px;
}
</style>

<div class="container">
 
<section style="background:#fff; border-radius:4px;">		
<div class="container">			
<div class="row">				
				
<div class="col-sm-12 padding-right"> 



	
	
<?php if(empty($products)) { ?>
<h2 class="title text-center">No Product Found</h2>
<?php } else { ?>
             
<h2 class="title text-center">Products</h2>								
	<?php if(!empty($products)) { 
	
	$current_date1 = date('Y-m-d H:i:s', strtotime('-5 hours',strtotime(date('Y-m-d H:i:s'))));
    $current_date = date('Y-m-d H:i:s', strtotime('-30 minutes',strtotime($current_date1)));
    $current_day = date('D');//, strtotime($current_date));
    $current_hour = date('H');//, strtotime($current_date));

	
			  foreach($products as $product) {
				  
				  $ststus= "Closed";
		          $oprntime ='';
				  
				  if(!empty($product['mattry'])) {
			//print_r($merchant['attribute']);
			 $attributeArray = json_decode($product['mattry'],true);
				
				foreach($attributeArray as $attributVal) {
					
					$startdate =date("H", strtotime($attributVal[1]));
					$enddate =date("H", strtotime($attributVal[2]));
					
					 if($attributVal[0]==$current_day && $startdate<=$current_hour && $enddate>=date("H") && $attributVal[1]!='0' && $attributVal[1]!='' && $attributVal[3]!='closed')
					{
					$ststus= "OPEN";
					}
					if($attributVal[0]==$current_day && $startdate<=$current_hour  && $attributVal[1]!='0' && $attributVal[1]!='' && $attributVal[3]!='closed'){
					$oprntime =date("h:i A", strtotime($attributVal[1]));	
					} 
					
				}
			
	}
				  
				  
				   if($product['image']==''){ $pimage = base_url().'assets/front/images/products1.jpg'; }
		else { $pimage =  '/main-admin/images/product/'.$product['image'].''; }
				  
				  
						echo '<a href="/product/'.$product['p_id'].'">
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">';
										if($product['cost'] < $product['cost']) {
											$discount = ($product['cost'] * 100) / $product['cost'];
											$discount = 100 - round($discount,1);
										//echo '<p class="disc">'.round($discount).'% OFF </p>';
										}
										echo '<img src="/main-admin/images/product/'.$product['image'].'" class="img-responsive">									
                                        <h2>';
										if($product['cost']==$product['cost'] || $product['cost']=='') {
											echo 'MRP '.$product['cost'];
										} else {
											echo 'MRP'.$product['cost'].' <span>'.$product['cost'].'</span>';
										}
										
										?></h2>
											<p><?php echo $product['pname']; ?></p> 
											<p><a href="../merchant/<?php echo $product['mid']; ?>"><?php echo $product['d_name']; ?></a></p>
											
											
											<?php 
											
											if($ststus!='OPEN' && $product['mattry']!=''){echo "<button class='btn btn-fefault cart' style='margin: 0 0 20px 0;'>Merchant Closed</button>";}
else{
$tax_class=$product['cost']*$product['t_class']/100;
echo '<form action="'.base_url().'product/'.$product['p_id'].'" id="addtocartform-'.$product['proid'].'" class="form form-inline addtocartform" method="post" data-pid="'.$product['p_id'].'" data-cls="#addtocartform-'.$product['proid'].'">
<input type="hidden" name="image" value="'.$pimage.'">
<input type="hidden" name="id" value="'.$product['proid'].'">
<input type="hidden" name="name" value="'.$product['pname'].'">
<input type="hidden" name="tax" value="'.$tax_class.'">
<label>Qty:</label>
<input type="number" class="form-control pro_qty" name="qty" required min="1" value="1">
<input type="submit" name="submitbtn" class="btn btn-fefault cart"  value="Add to cart" data-pid="'.$product['p_id'].'" data-cls="#addtocartform-'.$product['proid'].'">
</form>';
}
 ?> 
											
											<!--form method="post" action="" class="form form-inline sell-btn">	
											<div class="hide">	
								<input type="hidden" name="name" value="<?php echo $product['pname'];?>">	
								<input type="hidden" name="id" value="<?php echo $product['p_id'];?>">	
								<input type="hidden" name="image" value="/merchants/images/product/<?php echo $product['image'];?>">	
	                            <input type="hidden" name="tax" value="<?php echo $product['p_d_price']*$product['t_class']/100;?>">
								<input type="hidden" name="qty"  value="1" >
								<input type="hidden" name="keyword"  value="<?php echo $keyword; ?>" >
								</div>
								
								<button type="submit" class="btn btn-fefault cart">	
								<i class="fa fa-shopping-cart"></i>Add to cart					
								</button>
								<button type="submit" name="buynow" value="buynow" class="btn btn-fefault cart">	
								<i class="fa fa-shopping-cart"></i>BUY NOW					
								</button>
								</form-->
											
											<!-- <p><a href="merchant/<?php echo $product['mid']; ?>"><?php echo $product['d_name']; ?></a></p>  --> 
										</div> 
								</div> 
							</div>
						</div></a>
						<?php 
			  }
			}
		?>
		
		<?php } /**************** endif category not found ******************/ ?>
						  
      </div>			
									</div>		
									</div>	
									</section>						
									</div>