<!DOCTYPE html>
<html lang="en">
<head>
 <title><?php if($page_title==''){ echo 'Blisszon'; }
 else { echo $page_title.' | Blisszon'; } ?></title>
<?php 
if($page_keywords != ''){ echo '<meta name="description" content="'.$page_keywords.'">'; }
if($page_description !=''){ echo '<meta name="keywords" content="'.$page_description.'">'; }
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet" type="text/css">
 <!--script src="<?php echo base_url(); ?>assets/front/js/jquery-1.12.3.min.js"></script-->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.min.js"></script>
 <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body <?php if($page_slug != ''){ echo 'class="'.$page_slug.'"'; }?>> 
 
  
<div class="full-container">
<header>
<div class="col-sm-12 h-0-9">

<div class="col-sm-4 text-left">
<ul class="list-inline">
<li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
<!--li><a href="#"><img src="<?php echo base_url(); ?>assets/front/images/5.png"></a></li-->
<li><a title="Shipping" href="/shipping_policy"><img src="<?php echo base_url(); ?>assets/front/images/1.png"></a></li>
<li><a title="Contact Us" href="/contact_us"><img src="<?php echo base_url(); ?>assets/front/images/3.png"></a></li>
</ul>
</div>
<div class="col-sm-4 text-center">
<a href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>assets/front/images/logo.png"></a>
</div>
<div class="col-sm-4 text-right">
<ul class="list-inline">
<?php if($this->session->userdata('is_customer_logged_in')){ ?>
<li><a href="/admin/profile" title="Profile"><img src="<?php echo base_url(); ?>assets/front/images/2.png"></a></li>
<li><a href="/cart" title="Cart"><img src="<?php echo base_url(); ?>assets/front/images/6.png"></a></li>
<!--li><a href="/profile"><img src="<?php echo base_url(); ?>assets/front/images/4.png"></a></li-->
<li><a href="<?php echo base_url();?>logout"><span style="color:#fff;font-size:22px;" class="glyphicon glyphicon-log-out"></span></a></li>
<?php } else { ?>
<li><a title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal"><img src="<?php echo base_url(); ?>assets/front/images/2.png"></a></li>
<li><a title="Cart" href="<?php echo base_url();?>cart"><img src="<?php echo base_url(); ?>assets/front/images/6.png"></a></li>
<?php } ?>

</ul>
</div>
</div>



<div class="col-sm-12 nv-0-9">
 <nav role="navigation" class="navbar navbar-default"> 
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> 
        </div> 
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <!--li class="active">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Categories</a> 
						<?php if(isset($category_list) && (!empty($category_list))) { 
	   echo '<ul role="menu" class="dropdown-menu">';
	foreach($category_list as $category) {
		echo '<li><a href="'.base_url().'category/'.str_replace(' ','-',$category['c_name']).'">'.$category['c_name'].'</a></li>';
	}
	echo ' </ul>';
} ?>  
                </li-->
				
				<?PHP foreach($category_list as $category) {
		echo '<li><a href="'.base_url().'category/'.str_replace(' ','-',$category['c_name']).'">'.$category['c_name'].'</a></li>';
	} ?>
				
                <!--li><a href="<?php echo base_url();?>bliss-products">Bliss Products</a></li>
                <li><a href="<?php echo base_url();?>stores">Stores</a></li>
                <li><a href="<?php echo base_url();?>new-arrivals">New Arrivals</a></li>
                <li><a href="<?php echo base_url();?>deals-king">Deals King</a></li>
                <li class="lst-list"><a href="<?php echo base_url();?>ways-to-earn">Ways to Earn</a></li-->
                <!--li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Messages <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Inbox</a></li>
                        <li><a href="#">Drafts</a></li>
                        <li><a href="#">Sent Items</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Trash</a></li>
                    </ul>
                </li-->
            </ul>
            <form role="search" method="post" action="<?php echo base_url();?>search" class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" placeholder="Search" class="form-control" name="search">
                </div>
            </form>
            
        </div>
    </nav>
</div>
</header>
<!-- header close -->