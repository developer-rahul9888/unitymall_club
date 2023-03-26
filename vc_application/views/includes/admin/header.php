<!DOCTYPE html>
<html lang="en">

<head>
  <title>Unitymall | Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/front/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/global-admin.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/css/admin-style.css" rel="stylesheet" type="text/css">
</head>

<body>


  <div class="full-container">
    <header>


      <div class="col-sm-12 nv-0-9">

        <!-- Brand and toggle get grouped for better mobile display center-block-->
		<div class="branddd">
        <a href="<?php echo base_url(); ?>admin"><img class="img-responsive " src="<?php echo base_url(); ?>main-admin/images/logo.png" height="80" /></a>
		</div>
       <div class="topp">
		<!-- <div class="fndbtnn">
        <a href="<?php echo base_url();?>admin/payment">
        <button class="fund_btn">Add Fund</button></a>
      </div> -->
	  
        <div class="imggg">
		  <img src="<?php echo base_url(); ?>assets/images/wllt.png">
          <p>Rs <?php echo $profile[0]['bliss_amount'];  ?></p>
		 </div>
		 <div class="imggg img2">
          <img src="<?php echo base_url(); ?>assets/images/coinss.png">
          <p><?php echo $profile[0]['points'];  ?></p>
        </div>

        <div class="fndbtnn">
          <form method="post" action="https://www.unitymall.in/member-login" target="_blank">
                        <input type="hidden" value="<?php echo $profile[0]['customer_id']; ?>" name="bcono"> 
                        <input type="hidden" name="auth" value="818a715577f917f18cc4357a95b31153">
                        <input type="hidden" name="type" value="shop">
                        <button type="submit" class="btn btn-rounded btn-block login-shop"><i class="icon-wallet"></i> Visit Unitymall Shop</button>
          </form>
        </div>

      </div> 
      
        <!-- Collection of nav links, forms, and other content for toggling -->


      </div>
    </header>
    <!-- header close -->