<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="vkM6oEV0FkqDNWG7gw44kWFtSAtcZQ2_-jKx5cOIcWI" />
	<meta name="keywords" content="" />
	<title>Unitymall</title>
	<?php
	if ($page_keywords != '') {
		echo '<meta name="description" content="' . $page_keywords . '">';
	}
	if ($page_description != '') {
		echo '<meta name="keywords" content="' . $page_description . '">';
	}
	?>


	<meta property="og:title" content=" " />
	<meta property="og:image" content=" " />
	<meta property="og:site_name" content="" />
	<meta property="og:url" content="" />
	<meta property="og:description" content="" />


	<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/prettyPhoto.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/responsive.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/flexslider.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/main.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/recharge.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/animate.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/animation.css" rel="stylesheet" type="text/css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<!-- slick -->
	<link href="<?php echo base_url(); ?>assets/front/css/slick.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/front/css/slick-theme.css" rel="stylesheet" type="text/css">




	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


	<script src="<?php echo base_url(); ?>custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/front/js/slick.js"></script>
	<script src="<?php echo base_url(); ?>assets/front/js/slick.min.js"></script>
	<!-- slick slider -->

</head>
<!--/head-->

<style>


</style>




<body <?php if ($page_slug != '') {
			echo 'class="' . $page_slug . '"';
		} ?>>

	<?php /* if(isset($category_list) && (!empty($category_list))) { 
	  
	foreach($category_list as $category) {
		echo '<li><a href="'.base_url().'category/'.str_replace(' ','-',$category['c_name']).'">'.$category['c_name'].'</a></li>';
		}
	
} */ ?>



	<header class="main-header header-style-two">

		<!--Header-Upper-->
		<div class="header-upper hidden-xs">
			<div class="container">

				<div class="row">
					<div class="col-sm-9">
						<h1>Announcement:</h1>
						<marquee behavior="alternate" direction="left" onmouseover="stop()" onmouseout="start()">
							<p><a href="#" target="_blank">Comming Soon</a></p>
						</marquee> </span>


					</div>

					<div class="col-sm-3">
						<div class="social-box">
							<ul class="social-icon-one">
								<li class="facebook"><a href="https://www.facebook.com/Unity-mall-106321585335838/"><i class="fa fa-facebook"></i></a></li>
								<li class="gplus"><a href="https://www.instagram.com/unitymall_cashback/"><i class="fa fa-instagram"></i></a></li>
								<li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>

							</ul>
						</div>
					</div>


				</div>
			</div>
		</div>
		<!--End Header Upper-->

		<!-- Header Lower  -->

		<nav class="navbar navbar-default navbar-static-top" role="navigation" data-spy="affix" data-offset-top="205">
			<div class="container">
				<div class="row">

					<!--for phone search cart nd regiser login--->



					<!--for phone search cart nd regiser login--->

					<div class="col-sm-2 col-xs-12">
						<div class="navbar-header">

							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<i class="fa fa-bars"></i>
							</button>
							<a class="navbar-brand text-center" href="<?php echo base_url(); ?>">
								<img src="<?php echo base_url(); ?>assets/front/images/logo.png" alt="Unity Mall">
							</a>


						</div>
						<div class=" mob-shop hidden-lg hidden-md-hidden-sm">

							<a href="<?php echo base_url(); ?>cart" class="cart-icon cart-btn">
								<i class="icon-basket-loaded"></i>

							</a>

						</div>

						<div class=" mob-search hidden-lg hidden-md-hidden-sm" id="demo-2">

						</div>
					</div>



					<div class="col-sm-10 col-xs-12">
						<div class="navbar-collapse collapse " style="float: right;">
							<ul class="nav navbar-nav">
								<li>
									<a class="active" href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> </a>
								</li>


								<!-- <li class="dropdown">
										<a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">Category
											<span class="caret"></span>
										</a>
									
											
								  <!--ul role="menu" class="">
									<li class="dropdown-submenu"><a href="http://unitymall.in/category/Men-Ware">Men Ware</a></li><li class="dropdown-submenu"><a href="http://unitymall.in/category/Health-&-Fitness">Health & Fitness</a></li><li class="dropdown-submenu"><a href="http://unitymall.in/category/Smart-Gadgets">Smart Gadgets</a></li><li class="dropdown-submenu"><a href="http://unitymall.in/category/Covid-Essentials">Covid Essentials</a></li><li class="dropdown-submenu"><a href="http://unitymall.in/category/Copper-Ware">Copper Ware</a></li><li class="dropdown-submenu"><a href="http://unitymall.in/category/Home-&-Kitchen">Home & Kitchen</a></li><li class="dropdown-submenu"><a href="http://unitymall.in/category/Dry-Fruits">Dry Fruits</a></li>										
                                    </ul-->


								<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
									<li class="dropdown-submenu"><a tabindex="-1" href="<?php echo base_url(); ?>category/Health-&amp;-Fitness">Health &amp; Fitness </a></li>
									<li class="dropdown-submenu"><a tabindex="-1" href="<?php echo base_url(); ?>category/Smart-Gadgets">Smart Gadgets </a></li>
									<li class="dropdown-submenu"><a tabindex="-1" href="<?php echo base_url(); ?>category/Covid-Essentials">Covid Essentials </a></li>
									<li class="dropdown-submenu"><a tabindex="-1" href="<?php echo base_url(); ?>category/Copper-Ware">Copper Ware </a></li>
									<li class="dropdown-submenu"><a tabindex="-1" href="<?php echo base_url(); ?>category/Home-&amp;-Kitchen">Home &amp; Kitchen </a></li>
									<li class="dropdown-submenu"><a tabindex="-1" href="<?php echo base_url(); ?>category/Dry-Fruits">Dry Fruits </a></li>
								</ul>



								<li class="searchhbar hide">

									<div class="search-area hidden-xs">
										<form method="post" action="<?php echo base_url(); ?>search">
											<div class="control-group">
												<select class="form-control abc" required name="cat">
													<option selected disabled>Select Category</option>
													<?php if (isset($category_list) && (!empty($category_list))) {
														foreach ($category_list as $category) {
															if ($category['p_id'] == 0) {
																echo '<option value=' . $category['id'] . '>' . $category['c_name'] . '</option>';
															}
														}
													} ?>
												</select>
												<input name="key" class="search-field" placeholder="Search here...">

												<button class="btn search-button" type="submit"><i class="fa fa-search"></i></button>

											</div>
										</form>
									</div>

								</li>

								<!--<li>
								<a href="<?php echo base_url(); ?>products">Products </a>
							</li>-->
								
									

								<?php if ($this->session->userdata('is_customer_logged_in')) { ?>

									<li class=""><a relj="main" data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"><span> <i class="fa fa-user"></i> <?php echo ucfirst($this->session->userdata('full_name')); ?> <i class="fa fa-angle-down"></i> </span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a relj="main" href="<?php echo base_url(); ?>admin">Account</a></li>
											<li><a relj="main" href="<?php echo base_url(); ?>admin/personal_details">Profile</a></li>
											<!--	<li><a relj="main" href="<?php echo base_url(); ?>logout">Logout</a></li> -->
										</ul>

									</li>

								<?php } ?>


								<?php if ($this->session->userdata('is_customer_logged_in')) { ?>
									<li><a relj="main" href="<?php echo base_url(); ?>logout"><i class="fa fa-lock"></i> Logout</a></li>
								<?php } else { ?>
									<li><a relj="main" class="reg_free" title="Register" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal"><span><i class="fa fa-sign-in"></i> Join Free</span></a></li>
									<li><a relj="main" class="log_free" title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal"><span><i class="fa fa-lock"></i> Sign In</span></a></li>
								<?php } ?>
							</ul>


						</div>
						<div class="search-area hidden-lg hidden-md hide">
							<form method="post" action="<?php echo base_url(); ?>">
								<div class="control-group">
									<select class="form-control abc" required="" name="cat">
										<option selected="" disabled="">Select Category</option>
										<option value="Health-&amp;-Fitness&quot;">Health &amp; Fitness</option>
										<option value="Smart-Gadgets&quot;">Smart Gadgets</option>
										<option value="Covid-Essentials&quot;">Covid Essentials</option>
										<option value="Copper-Ware&quot;">Copper Ware</option>
										<option value="Home-&amp;-Kitchen&quot;">Home &amp; Kitchen</option>
										<option value="Dry-Fruits&quot;">Dry Fruits</option>
									</select>
									<input name="key" class="search-field" placeholder="Search here...">

									<button class="btn search-button" type="submit"><i class="fa fa-search"></i></button>

								</div>
							</form>
						</div>
					</div>




				</div>



				<!--      <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <div class="pull-left logo-box">
                    	<div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" alt="" title=""></a></div>
					
                    </div>
            </div>    --->

				<!---   <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
                   <li  class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
					<li><a href="<?php echo base_url(); ?>about">About Us</a></li>
                    <li class="dropdown">
                      <a href="<?php echo base_url(); ?>" class="">Products</a> 
                     <ul class="dropdown-menu"> 
		<?php if (isset($category_list) && (!empty($category_list))) {

			foreach ($category_list as $category) {
				if ($category['p_id'] == 0) {


					echo '<li><a href="' . base_url() . 'category/' . str_replace(' ', '-', $category['c_name']) . '" >' . $category['c_name'] . ' </a>';
					$submenu = '';
					foreach ($category_list as $cat) {
						if ($cat['p_id'] == $category['id']) {
							$submenu .= '<li><a href="' . base_url() . 'category/' . str_replace(' ', '-', $cat['c_name']) . '" >' . $cat['c_name'] . ' </a></li>';
						}
					}
					if ($submenu != '') {
						echo '<ul class="dropdown-menu">' . $submenu . '</ul>';
					}
					echo '</li>';
				}
			}
		} ?> 
<li><a href="<?php echo base_url(); ?>products">View All</a></li>                    
</ul>
					
                    </li>
						<!--<li><a href="#">Packages</a></li>-->
				<!--	  <li><a href="<?php echo base_url(); ?>legal">Legalities</a></li>   -->
				<!--			  <li><a href="<?php echo base_url(); ?>gallery">Our Gallery</a></li>
							<!--	  <li><a href="<?php echo base_url(); ?>business_plan">Opportunity</a></li>  -->

				<!--      <li><a href="<?php echo base_url(); ?>contact_us"> Contact Us</a></li>
						  
						  <?php if ($this->session->userdata('is_customer_logged_in')) { ?>
								
								<li class=""><a relj="main" data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"><span> <i class="fa fa-user"></i> <?php echo ucfirst($this->session->userdata('full_name')); ?> <i class="fa fa-angle-down"></i> </span></a>
								 <ul role="menu" class="dropdown-menu">
                                        <li><a relj="main" href="<?php echo base_url(); ?>admin">Account</a></li>
										<li><a relj="main" href="<?php echo base_url(); ?>admin/personal_details">Profile</a></li> 
										<li><a relj="main" href="<?php echo base_url(); ?>logout">Logout</a></li>
                                    </ul>
								
								</li>
									
								<?php } ?>
								
								
								<?php if ($this->session->userdata('is_customer_logged_in')) { ?>
								<li><a relj="main"  href="<?php echo base_url(); ?>logout"><i class="fa fa-lock"></i> Logout</a></li>
								<?php } else { ?>
								<li><a relj="main" class="reg_free" title="Register" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal"><span><i class="fa fa-sign-in"></i>  Register Free</span></a></li> 
								
								<li><a relj="main" class="log_free"  title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal"><span><i class="fa fa-lock"></i> Login</span></a></li>
								<?php } ?>
            
                </ul>
            </div>    --->
				<!-- /.navbar-collapse -->
			</div>

		</nav>


		<!--End Main Header -->