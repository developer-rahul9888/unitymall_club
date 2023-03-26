<?php if (!empty($get_popup)) { ?>

	 <div id="myModal" class="modal md_home" style="display: inline;">

    
    <div class="modal-content">
	 <div style="float: right;"><input class="btn-group closu popup-admin-btn " value="&times;" type="button"></div>
	<img src="<?php echo base_url(); ?>main-admin/images/popup/<?php echo $get_popup[0]['image']; ?>" class="img-responsive">

    </div>

</div> 

	<script>
		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the button that opens the modal

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("closu")[0];

		// When the user clicks the button, open the modal

		modal.style.display = "inline";
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>

<?php } ?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php
		if (!empty($slider)) {
			$i = 0;
			foreach ($slider as $slide) {
				if ($i == 1) {
					$class = 'active';
				} else {
					$class = '';
				}
				echo '<div class="item ' . $class . '">
		<img src="' . base_url() . 'main-admin/images/product/' . $slide['image'] . '" class="girl img-responsive" alt="" /></div>';
				$i++;
			}
		}

		?>

	</div>

	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<i class="fa fa-angle-left"></i><span class="sr-only">Previous</span> </a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<i class="fa fa-angle-right"></i> <span class="sr-only">Next</span> </a>
</div>


<!------- rechage tabs------>

<!-- 	<div class="rechage_list">
	<div class="container">
		<ul>
		<li  class="active">
			<a href="<?php echo base_url(); ?>recharge"><i class="fa fa-mobile"></i>Prepaid</a>
		</li>
		<li  class="operator-radio">
			<a href="<?php echo base_url(); ?>recharge"><i class="fa fa-mobile"></i>Postpaid</a>
		</li>
		
		<li class="operator-radio">
			<a href="<?php echo base_url(); ?>recharge"><i class="fa fa-television"></i>DTH</a>
		</li>
		<li class="operator-radio">
			 <a href="<?php echo base_url(); ?>recharge"><i class="fa fa-lightbulb-o"></i>Electricity</a>
		</li>
			<li class="operator-radio">
			 <a href="<?php echo base_url(); ?>recharge"><i class="fa fa-file"></i>Insurance</a>
		</li>
		<li class="operator-radio">
			 <a href="<?php echo base_url(); ?>recharge"><i class="fa fa-tint"></i>Water</a>
		</li>
		<li  class="operator-radio">
			 <a href="<?php echo base_url(); ?>recharge"><i class="fa fa-inr"></i>Pay Loan</a>
		</li>
		
		<li  class="operator-radio">
			 <a href="<?php echo base_url(); ?>recharge"><i class="fa fa-bus"></i>Bus Travale</a>
		</li>
		
	</ul>
	</div>
	</div> -->

<!------- end rechage tabs------>

<!-----Deal section Start----->
<!-- <div class="best-sale-area pt-130 pb-100 Voucher catt">
	 <div class="container"> 
	<div class="section-title mb-75">
		<h2>Select <span>Categories</span>
		</h2>
	</div>

	<div class="brand-carousel section-padding owl-carousel">
		<div class="single-logo">
			<h1>Home & Kitchen</h1>
			<img src="<?php echo base_url(); ?>/assets/images/kitchen.png" alt="">
		</div>
		<div class="single-logo">
			<h1>Covid Essentials</h1>
			<img src="<?php echo base_url(); ?>/assets/images/covid.png" alt="">
		</div>
		<div class="single-logo">
			<h1>Men's Wear</h1>
			<img src="<?php echo base_url(); ?>/assets/images/mansweare.png" alt="">
		</div>
		<div class="single-logo">
			<h1>Dry Fruits</h1>
			<img src="<?php echo base_url(); ?>/assets/images/dry.png" alt="">
		</div>
		<div class="single-logo">
			<h1>Smart Gadgets</h1>
			<img src="<?php echo base_url(); ?>/assets/images/gadgets.png" alt="">
		</div>
		<div class="single-logo">
			<h1>Health & Fitness</h1>
			<img src="<?php echo base_url(); ?>/assets/images/fitnes.png" alt="">
		</div>
		<div class="single-logo">
			<h1>Women's Wear</h1>
			<img src="<?php echo base_url(); ?>/assets/images/womans.png" alt="">
		</div>
		<div class="single-logo">
			<h1>E-vouchers</h1>
			<img src="<?php echo base_url(); ?>/assets/images/voucher.png" alt="">
		</div>


	</div>


	 </div>
</div> -->


<!-----Deal section ends----->



<!-- product -->
<section class="visitors1" id="products">
	<div class="container">
		<div class="row">
			<div class="cateeh">
				<!-- 	<h1><span> Best of </span>Everyday Items </h1> -->
			</div>
			<div class="catee">

				<ul id="flexiselDemo2">
					<?php
					if (!empty($products)) {
						$i = 0;
						foreach ($products as $prod) {

							if ($prod['cost'] == $prod['p_d_price']) {
								$discount = "";
							} else {
								$disc = $prod['p_d_price'] - $prod['p_d_price'];
								$discount = "<p class='disc'>" . round($disc / $prod['p_d_price'] * 100) . "% OFF </p>";
							}

							if ($prod['cost'] == $prod['p_d_price']) {
								$procost = "<span> Rs.  " . $prod['p_d_price'] . "</span>";
							} else {
								$procost = "<span> Rs.  " . $prod['p_d_price'] . "</span>";
							}


							echo '<li>
							<div class="sliderfig-grid">
							<a href="' . base_url() . 'divino-product/' . $prod['p_id'] . '">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
									
										
									 <img class="img-responsive" src="' . base_url() . 'main-admin/images/product/' . $prod['image'] . '" class="img-responsive">
									 
										<p class="uptooooo">Upto 18% <br>Cashback</p>
									 
									 <p class="product-para">' . $prod['pname'] . '</p>
													 <p class="mrp">' . $procost . '</p>
												<!--<p>Pro ID: ' . $prod['sku'] . '</p>	-->
												<a href="' . base_url() . 'divino-product/' . $prod['p_id'] . '" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									 </div></div></div></a>
									 </div></li>
									 ';
						}
					} ?>

				</ul>
			</div>
		</div>
	</div>
</section>
<!-- product -->






<!-- product -->

<div class="best-sale-area pt-130 pb-0 hide">
	<div class="container">
		<div class="section-title mb-75">
			<h2>Deals of the Day</h2>
			<p><a href="<?php echo base_url(); ?>products">View All </a></p>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div id="news-slider-top" class="slic-carousel">

					<?php
					if (!empty($trending_services)) {
						foreach ($trending_services as $trending) {

							if ($trending['cost'] == $trending['p_d_price']) {

								$procost = $trending['p_d_price'];
							} else {

								$procost = $trending['cost'];
							}
							echo '
			
						<div class="product-wrap mb-30">
							<div class="product-img" padding: 16px 9px; border-bottom: none;">
								<a href="' . base_url() . 'product/' . $trending['p_id'] . '">';;
							if ($trending['image'] == '') {
								echo '<img src="' . base_url() . 'assets/front/images/products1.jpg" class="img-togg">';
							} else {
								echo '<img src="' . base_url() . 'main-admin/images/product/' . $trending['image'] . '" class="img-responsive center-block">';
							}
							echo '	</a>
									<div class="product-action">
										<ul>
											<li style="width: 50%;">
												<a title="Add To Cart" href="' . base_url() . 'product/' . $trending['p_id'] . '">
													<i class="fa fa-shopping-cart" ></i>
												</a>
											</li>
											<li style="width: 50%;">
												<a title="Quick View" href="' . base_url() . 'product/' . $trending['p_id'] . '">
													<i class="fa fa-eye"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="product-content" style="padding: 16px 9px; border-top: none;">
									<div class="pro-title-rating-wrap">
										<div class="product-title">
											<h3 style="font-size: 100%;">
											<a href="' . base_url() . 'product/' . $trending['p_id'] . '">
' . $trending['pname'] . '
</a>
											</h3>
											<h6>MRP. ' . $procost . '</h6>
									<h6>Coins. ' . $trending['comm_dis'] . '</h6>
									<h6>Reward Points. ' . $trending['reward'] . '</h6>
									<h4><a href="' . base_url() . 'product/' . $trending['p_id'] . '"><i class="fa fa-shopping-cart" ></i>Add To Cart</a></h4>
			
										</div>  
									</div>
									
									</div>
								</div>
						
							
							';
						}
					} ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!----mobile image---->
<!-- <section class="bg-primary">
	<div class="container pt-2 pt-sm-0">
		<div class="row align-items-center">
			<div class="col-sm-6 col-lg-5 mt-md-n5 text-center text-sm-start mobiles">
				<h2 class="text-light mb-3">One in All - All in One</h2>
				<p class="text-light opacity-70 mb-0 d-block d-sm-none d-md-block">One Platform - Multiple Ideas - Multiple Incomes</p>
				<div class="mt-4 pt-2 appps">
					<<a href="#"><img class="d-block mx-auto mx-sm-0" src="<?php echo base_url(); ?>main-admin/images/product/iphone.png" alt="moble"></a>
					<a href="#"><img class="d-block mx-auto mx-sm-0" src="<?php echo base_url(); ?>main-admin/images/product/playstor.png" alt="moble" width="331"></a>
				</div>
			</div>
			<div class="col-sm-6 pt-5 pt-sm-3 imgs"><a href="#"><img class="d-block mx-auto mx-sm-0" src="<?php echo base_url(); ?>main-admin/images/product/moble-2.png" alt="moble"></a></div>
		</div>
	</div>
</section> -->




<!----mobile image---->


<!-- product -->

<div class="best-sale-area top_product pt-130 pb-0 hide">
	<div class="container">
		<div class="section-title mb-75">
			<h2>Top Product</h2>
			<p><a href="<?php echo base_url(); ?>products">View All </a></p>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div id="news-slider-top" class="owlcarousel">

					<?php
					if (!empty($trending_services)) {
						foreach ($trending_services as $trending) {

							if ($trending['cost'] == $trending['p_d_price']) {

								$procost = $trending['p_d_price'];
							} else {

								$procost = $trending['cost'];
							}
							echo '
			
						<div class="product-wrap mb-30">
							<div class="product-img" style="padding: 16px 9px; border-bottom: none;">
								<a href="' . base_url() . 'product/' . $trending['p_id'] . '">';;
							if ($trending['image'] == '') {
								echo '<img src="' . base_url() . 'assets/front/images/products1.jpg" class="img-togg">';
							} else {
								echo '<img src="' . base_url() . 'main-admin/images/product/' . $trending['image'] . '" class="img-responsive center-block">';
							}
							echo '	</a>
									<div class="product-action">
										<ul>
											<li style="width: 50%;">
												<a title="Add To Cart" href="' . base_url() . 'product/' . $trending['p_id'] . '">
													<i class="fa fa-shopping-cart" ></i>
												</a>
											</li>
											<li style="width: 50%;">
												<a title="Quick View" href="' . base_url() . 'product/' . $trending['p_id'] . '">
													<i class="fa fa-eye"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="product-content" style="padding: 16px 9px;">
									<div class="pro-title-rating-wrap">
										<div class="product-title">
											<h3 style="font-size: 100%;">
											<a href="' . base_url() . 'product/' . $trending['p_id'] . '">
' . $trending['pname'] . '
</a>
											</h3>
											<h6>MRP. ' . $procost . '</h6>
									<h6>Coins. ' . $trending['comm_dis'] . '</h6>
									<h6>Reward Points. ' . $trending['reward'] . '</h6>
									<h4><a href="' . base_url() . 'product/' . $trending['p_id'] . '"><i class="fa fa-shopping-cart" ></i>Add To Cart</a></h4>
			
										</div>  
									</div>
									
									</div>
								</div>
						
							
							';
						}
					} ?>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="Store pb-100">
	<div class="container">
		<div class="section-title mb-75">
			<h2>Online Store</h2>
			<p><a href="<?php echo base_url(); ?>online_stores">View All </a></p>
		</div>
		<div class="webstore-container">

			<div class="product-left">

				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="chain-grid chain-grid2">
						<a href="<?php echo base_url(); ?>online-store/Big Bazaar/11"><img class="img-responsive center-block online-images" src="<?php echo base_url(); ?>main-admin/images/webstores/big-bazaar-offers.png" alt=" "></a>

						<div class="grid-chain-bottom">
							<center>
								<h5 class="text-center txt"><a href="<?php echo base_url(); ?>online-store/Big Bazaar/11">Big Bazaar</a></h5><a href="<?php echo base_url(); ?>online-store/Big Bazaar/11">
								</a>
								<h6 class="text-center"><a href="<?php echo base_url(); ?>online-store/Big Bazaar/11"></a><a href="<?php echo base_url(); ?>online-store/Big Bazaar/11">Cashback 5.25%</a></h6><a href="<?php echo base_url(); ?>online-store/Big Bazaar/11">
								</a><a href="<?php echo base_url(); ?>online-store/Big Bazaar/11" style="color:#fff;"><button type="button" class="btn btn-warning grab-btn">Go To Store</button></a>
							</center>
						</div>

					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="chain-grid chain-grid2">
						<a href="<?php echo base_url(); ?>online-store/Paytm Mall/15"><img class="img-responsive center-block online-images" src="<?php echo base_url(); ?>main-admin/images/webstores/paymall.png" alt=" "></a>

						<div class="grid-chain-bottom">
							<center>
								<h5 class="text-center txt"><a href="<?php echo base_url(); ?>online-store/Paytm Mall/15">Paytm Mall</a></h5><a href="<?php echo base_url(); ?>online-store/Paytm Mall/15">
								</a>
								<h6 class="text-center"><a href="<?php echo base_url(); ?>online-store/Paytm Mall/15"></a><a href="<?php echo base_url(); ?>online-store/Paytm Mall/15">Cashback Upto 14.96%</a></h6><a href="<?php echo base_url(); ?>online-store/Paytm Mall/15">
								</a><a href="<?php echo base_url(); ?>online-store/Paytm Mall/15" style="color:#fff;"><button type="button" class="btn btn-warning grab-btn">Go To Store</button></a>
							</center>
						</div>

					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 grid-top-chain">
					<div class="chain-grid chain-grid2">
						<a href="<?php echo base_url(); ?>online-store/Wazirx/17"><img class="img-responsive center-block online-images" src="<?php echo base_url(); ?>main-admin/images/webstores/images_(48).png" alt=" "></a>

						<div class="grid-chain-bottom">
							<center>
								<h5 class="text-center txt"><a href="<?php echo base_url(); ?>online-store/Wazirx/17">Wazirx</a></h5><a href="<?php echo base_url(); ?>online-store/Wazirx/17">
								</a>
								<h6 class="text-center"><a href="<?php echo base_url(); ?>online-store/Wazirx/17"></a><a href="<?php echo base_url(); ?>online-store/Wazirx/17">Cashback Upto 100Rs/Sale</a></h6><a href="<?php echo base_url(); ?>online-store/Wazirx/17">
								</a><a href="<?php echo base_url(); ?>online-store/Wazirx/17" style="color:#fff;"><button type="button" class="btn btn-warning grab-btn">Go To Store</button></a>
							</center>
						</div>

					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 ">
					<div class="chain-grid chain-grid2">
						<a href="<?php echo base_url(); ?>online-store/.LG./204"><img class="img-responsive center-block online-images" src="<?php echo base_url(); ?>main-admin/images/webstores/New_Project_-_2021-03-18T135202_565_(1)_(1).png" alt=" "></a>

						<div class="grid-chain-bottom">
							<center>
								<h5 class="text-center txt"><a href="<?php echo base_url(); ?>online-store/.LG./204">.LG.</a></h5><a href="<?php echo base_url(); ?>online-store/.LG./204">
								</a>
								<h6 class="text-center"><a href="<?php echo base_url(); ?>online-store/.LG./204"></a><a href="<?php echo base_url(); ?>online-store/.LG./204">Cashback upto 2.62%/sale</a></h6><a href="<?php echo base_url(); ?>online-store/.LG./204">
								</a><a href="<?php echo base_url(); ?>online-store/.LG./204" style="color:#fff;"><button type="button" class="btn btn-warning grab-btn">Go To Store</button></a>
							</center>
						</div>

					</div>
				</div>

				<div class="clearfix"> </div>
			</div>

		</div>
	</div>
</div>




<!-- parallex -->


<!-----offline store----->
<!-- <div class="local-store-card">
      <div class="container">
         <div class="row">
		 <div class="section-title mb-75 offlines">
				<h2>In Store</h2>
			</div>	 
            <div class="col-md-3">
               <div class="store-box">
                 <div class="store-inner">
                     <img src="<?php echo base_url(); ?>main-admin/images/product/ofline-1.png" class="img-responcive store-img">
                  <h3 class="text-dark text-center">M. G. Supermarket</h3>
                  <small class="text-dark text-center">Sector 9-D, Chandigarh</small>
                 </div>
                  <div class="view-store-btn"><a href="#">View Store Page</a></div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="store-box">
                <div class="store-inner">
                     <img src="<?php echo base_url(); ?>main-admin/images/product/ofline-2.png" class="img-responcive store-img">
                  <h3 class="text-dark text-center">New Super Electronics</h3>
                  <small class="text-dark text-center">Sector 35-C, Chandigarh</small>
                </div>
                  <div class="view-store-btn"><a href="#">View Store Page</a></div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="store-box">
                 <div class="store-inner">
                     <img src="<?php echo base_url(); ?>main-admin/images/product/ofline-3.png" class="img-responcive store-img">
                  <h3 class="text-dark text-center">Studio Strands</h3>
                  <small class="text-dark text-center">Sector 17-C, Chandigarh</small>
                 </div>
                  <div class="view-store-btn"><a href="#">View Store Page</a></div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="store-box">
                 <div class="store-inner">
                     <img src="<?php echo base_url(); ?>main-admin/images/product/ofline-4.png" class="img-responcive store-img">
                  <h3 class="text-dark text-center">Dew Drops Florists</h3>
                  <small class="text-dark text-center">Sector 35-A, Chandigarh</small>
                 </div>
                  <div class="view-store-btn" mt-4=""><a href="#">View Store Page</a></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-3">
               <div class="store-box">
                 <div class="store-inner">
                    <img src="<?php echo base_url(); ?>main-admin/images/product/ofline-5.png" class="img-responcive store-img">
                  <h3 class="text-dark text-center">The Furniture Mart</h3>
                  <small class="text-dark text-center">Sector 9-D, Chandigarh</small>
                 </div>
                  <div class="view-store-btn"><a href="#">View Store Page</a></div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="store-box">
                 <div class="store-inner">
                     <img src="<?php echo base_url(); ?>main-admin/images/product/ofline-6.png" class="img-responcive store-img">
                  <h3 class="text-dark text-center">S. J. Mobile Store</h3>
                  <small class="text-dark text-center">Sector 35-C, Chandigarh</small>
                 </div>
                  <div class="view-store-btn"><a href="#">View Store Page</a></div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="store-box">
                 <div class="store-inner">
                    <img src="<?php echo base_url(); ?>main-admin/images/product/ofline-7.png" class="img-responcive store-img">
                  <h3 class="text-dark text-center">Goel Auto Lines</h3>
                  <small class="text-dark text-center">Sector 17-C, Chandigarh</small>
                 </div>
                  <div class="view-store-btn"><a href="#">View Store Page</a></div>
               </div>
            </div>
            <div class="col-md-3">
               <div class="store-box">
             <div class="store-inner">
                     <img src="<?php echo base_url(); ?>main-admin/images/product/ofline-8.png" class="img-responcive store-img">
                  <h3 class="text-dark text-center">S. P. Tyre House</h3>
                  <small class="text-dark text-center">Sector 35-A, Chandigarh</small>
             </div>
                  <div class="view-store-btn" mt-4=""><a href="#">View Store Page</a></div>
               </div>
            </div>
            <!--<div class="ciew-all-store"><a href="#">+ View All</a></div>-->
</div>
</div>
</div> 


<!-----offline store----->


<!----E_voucher ------->
<div class="best-sale-area pt-130 pb-100 Voucher">
	<div class="container">
		<div class="section-title mb-75">
			<h2>Gift <span>Voucher</span>
			</h2>
		</div>

		<div class="brand-carousel section-padding owl-carousel">
			 <?php 
		if(!empty($voucher)){
			foreach($voucher as $row){ 	?>
			<div class="single-logo">
				<img src="<?php echo 'https://www.unitymall.in/main-admin/assets/images/'.$row['image'] ;?>" alt="">
			</div>
		<?php } } ?>
		</div>


	</div>
</div>




<script>
	$('.brand-carousel').owlCarousel({
		loop: true,
		margin: 10,
		autoplay: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 3
			},
			1000: {
				items: 5
			}
		}
	})
</script>




<!-- parallex -->
<!--	
	<div class="support section">
	<div class="container">
	<div class="row">
	<div class="support-inner">

	<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="row-normal clearfix">
	<div class="support-info">
	<div class="info-title">
	<i class="fa fa-plane" aria-hidden="true"></i>

	Free Shipping All India
	</div>
	</div>
	</div>
	</div>

	<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="row-normal clearfix">
	<div class="support-info">
	<div class="info-title">
	<i class="fa fa-headphones"></i>
	24/7 Customer Service
	</div>
	</div>
	</div>
	</div>

	<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="row-normal clearfix">
	<div class="support-info">
	<div class="info-title">
	<i class="fa fa-heart"></i>
	Easy Return Policy
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<div class="container">
		<div class="row">
	<div class="support-inner retrn">

	<div class="col-md-2 col-sm-2 col-xs-12">
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="row-normal clearfix">
	<div class="support-info">
	<div class="info-title">
	<i class="fa fa-money" aria-hidden="true"></i>

	Cash On Delivery
	</div>
	</div>
	</div>
	</div>

	<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="row-normal clearfix">
	<div class="support-info">
	<div class="info-title">
	<i class="fa fa-lock" aria-hidden="true"></i>

	Online And Secure Payments
	</div>
	</div>
	</div>
	</div>

	</div>
	</div>
	</div>
	</div>   --->






<!-- marque -->
<!--	 <div class="events-cnt">
	 <div class="container">
	<div class="row">       
	<div class="newss" id="about">
	
	 <h3 class="title"></h3>
	 <div class="col-md-4 ab-text">
		 <div class="news-wrapper">
				  <div class="news-back">
                          <h3>News & Events</h3>
                   </div> 
				
			
				<div class=" acheiverss con-w3l" style="height:auto; overflow:hidden; text-align:justify;">
				    
					<marquee class="ind-home" direction="up"  scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();">
					    	<?php foreach ($fech_news as $discription) { ?>
					    	<div class="">
					<?php echo $discription['discription']; ?>
					</div>
					 <?php } ?></marquee> 
				</div>
					
					 

			</div>

	</div>
			 <div class="col-md-4 ab-text">
					 <div class="news-wrapper">
						<div class="news-back">
                          <h3>Top Achievers</h3>
						</div> 
							
							
							<div class=" con-w3l" style="height:auto; overflow:hidden; text-align:justify;">
							 
							<marquee class="ind-home" direction="up"  scrollamount="3"  height="200" onmouseover="this.stop();" onmouseout="this.start();">
							
							<?php foreach ($achiever as $achiver) { ?>
				 <div class="acheiver-cnt">
							 <img src="<?php echo base_url(); ?>/assets/images/<?php echo $achiver['image']; ?>">
							 <h2><b><?php echo $achiver['title']; ?></b></h2>
							<span>ID: <b><?php echo $achiver['discription']; ?></b></span>
							</div>
					 <?php } ?>
										
							</marquee> 
							
							 </div>
	<script>
							/*Call plugin*/
$('.marquee').marquee({
    //Set the direction of marquee
    'direction':'up',

    //delay the start of marquee
    'delayStart':'0',

    //Set the duration of marquee in millisecond
    'duration':'8000'
});
							</script>
			</div>

			</div> 
 <div class="col-md-4 ab-text">
					 <div class="news-wrapper  tye">
						<div class="news-back">
                          <h3>Images</h3>
						</div>  
							
							
							<div class=" con-w3l" style="height:auto; overflow:hidden; text-align:justify;">
							 
							<marquee class="ind-home" direction="up"  scrollamount="2"  height="200" onmouseover="this.stop();" onmouseout="this.start();">
							 
							
								<?php foreach ($franchise as $franch) { ?>
				 <div class="acheiver-cnt acheiver-cnt1 ">
							 <h2><b>Name : &nbsp;<?php echo $franch['f_name']; ?></b></h2>
							<span> Address : &nbsp;<?php echo $franch['address']; ?></span>
							<span> City : &nbsp;<?php echo $franch['city']; ?></span>
							<span> State : &nbsp;<?php echo $franch['state']; ?></span>
							</div>
					 <?php } ?>
									
							</marquee> 
							 </div>
		
			</div>

			</div>

</div>
</div>
</div>
</div>
	   -->


<!-- marque -->


<!--choose---
	<section class="feature-section">
		<div class="auto-container">
		
			
			<div class="sec-title-three">
				<div class="clearfix">
					<div class="pull-left">
						<div class="title">Our best features</div>
						<h2>Why choose us</h2>
					</div>
					<div class="pull-right">
						<div class="text">First Net Deal's goal is to always find the best solution for our customers to maximize their profit. Hence, our services are based on honesty, transparency, security and professionalism.</div>
					</div>
				</div>
			</div>
			
			
            <div class="feature-tabs tabs-box">
                <div class="row clearfix">
                	
                    <div class="col-lg-5 col-md-12 col-sm-12">
                      
                        <ul class="tab-btns tab-buttons clearfix">
                            <li class="tab-btn active-btn">
Professionalism <span>First Deal Net  only employs the best in the business. We view customer service as paramount to our success. </span></li>
                            <li class="tab-btn">Trading Platforms<span>Our trading platforms are easy to use and accessible to traders of all levels regardless of their experience.</span></li>
                            <li class="tab-btn ">Secure<span>First Net Deal uses the latest in encryption technology to ensure your online safety</span></li>
                        </ul>
                    </div>
                  
                    <div class="col-lg-7 col-md-12 col-sm-12">
                    
                        <div class="tabs-content">
                        
                          
                            <div class="tab" style="display: none;">
                            	<div class="content">
									<div class="image">
									
										 <img src="<?php echo base_url(); ?>assets/front/images/feature.jpg" alt="" class="img-responsive" >
									</div>
								</div>
							</div>
							
						
                            <div class="tab"  style="display: none;">
                            	<div class="content">
									<div class="image">
										
										 <img src="<?php echo base_url(); ?>assets/front/images/feature-1.jpg" alt="" class="img-responsive" >
									</div>
								</div>
							</div>
							
							
                            <div class="tab active-tab"  style="display: block;">
                            	<div class="content">
									<div class="image">
										
										 <img src="<?php echo base_url(); ?>assets/front/images/feature-2.jpg" alt="" class="img-responsive" >
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			
		</div>
	</section>
	<!--choose--->


<!--banner-gallery--->
<div id="myCarousel1" class="carousel slide downnn" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel1" data-slide-to="1"></li>
		<li data-target="#myCarousel1" data-slide-to="2"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<div class="item active">
			<img src="<?php echo base_url(); ?>assets/front/images/gal1.jpg" alt="" style="width:100%;" class="img-responsive">
		</div>

		<div class="item">
			<img src="<?php echo base_url(); ?>assets/front/images/gal2.jpg" alt="" style="width:100%;" class="img-responsive">
		</div>

		<div class="item">
			<img src="<?php echo base_url(); ?>assets/front/images/gal3.jpg" alt="" style="width:100%;" class="img-responsive">
		</div>
	</div>

	<!-- Left and right controls -->
	<a class="left carousel-control" href="#myCarousel1" data-slide="prev">
		<span class="fa fa-angle-left"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel1" data-slide="next">
		<span class="fa fa-angle-right"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<!--banner-gallery--->


<!----How works---->
<div class="how-zoogolworks">
	<div class="container">
		<h2 class="text-center text-dark">How Unitymall Works !</h2>
		<p class="text-center">Get Cashback + Earn Moneyback on all your Spending online. Same Products, Same Prices, But Extra Cashback. <br> Follow the simple steps given below to enjoy Extra Cashback everytime you shop online.</p>
		<div class="row">
			<div class="col-sm-3">
				<div class="how-work-zoogol-box">
					<div class="white-box"><img src="<?php echo base_url(); ?>main-admin/images/product/online-shop.png" class="online-store"></div>
					<strong class="text-center">1. Shop</strong>
					<p class="text-center mt-3">Click out via Unity Mall and buy</p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="how-work-zoogol-box">
					<div class="white-box"><img src="<?php echo base_url(); ?>main-admin/images/product/money.png" class="online-store"></div>
					<strong class="text-center">2. Get Cashback</strong>
					<p class="text-center mt-3">On all your purchases via Unity Mall</p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="how-work-zoogol-box">
					<div class="white-box"><img src="<?php echo base_url(); ?>main-admin/images/product/22-mobile.png" class="online-store"></div>
					<strong class="text-center">3. Share</strong>
					<p class="text-center mt-3">With easy sharing systems</p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="how-work-zoogol-box">
					<div class="white-box"><img src="<?php echo base_url(); ?>main-admin/images/product/online-shop.png" class="online-store"></div>
					<strong class="text-center">4. Earn Moneyback</strong>
					<p class="text-center mt-3">Earn moneyback again and again</p>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="cta_part">
	<div class="container">
		<div class="row justify-content-center">

			<div class="cta_iner">
				<h1>Are You Ready For Move? </h1>
				<p>Unity Mall is the trusted funding partner of choice</p>

				<a relj="main" class="reg_free cta_btn" title="Register" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">Sign Up</a>

			</div>

		</div>
	</div>
	<div></div>
</div>







<!----How works---->

<!--quote--->
<section class="call-to-action-two">
	<div class="container">
		<div class="clearfix">

			<div class="pull-left">
				<h2>Its time to change your life. Start your business today. <span></span></h2>
			</div>
			<div class="pull-right">

				<a relj="main" class="reg_free theme-btn btn-style-five" title="Register" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">Join Now <span class="icon fa fa-arrow-right"></span></a>

			</div>

		</div>
	</div>
</section>
<!--quote--->
<script>
	$('#news-slider-top').slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: true,
		autoplay: true,
		autoplaySpeed: 2000,
		responsive: [{
				breakpoint: 1200,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 1008,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 800,
				settings: "unslick"
			}

		]
	});
</script>