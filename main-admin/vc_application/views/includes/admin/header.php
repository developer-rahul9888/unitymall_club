<!DOCTYPE html>
<html lang="en">
<head>
  <title>Unity Mall</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/css/global-admin.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/css/admin-style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  
  <link href="https://demos.codexworld.com/add-wysiwyg-html-editor-to-textarea-website/tinymce/skins/ui/oxide/skin.min.css">
  
</head>
<body>
 
  
<div class="full-container">
<header>
<div class="col-sm-12 nv-0-9">
 <nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> 
			<a href="<?php echo base_url();?>"><a  href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" class="img-responsive" /></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse pull-right">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url();?>admin/category">Categories</a></li>
                <li><a href="<?php echo base_url();?>admin/gallery">Manage Gallery</a></li>
                <li>  <a class="" href="<?php echo base_url();?>admin/popup">Popup Image</a></li>
                <!-- <li><a href="<?php echo base_url();?>admin/Banner">Banner</a></li> -->
                <li><a href="<?php echo base_url();?>admin/news">News</a></li>
                <li><a href="<?php echo base_url();?>admin/tax">GST</a></li>
                <!--li><a href="<?php echo base_url();?>admin/coupon">Coupon code</a></li>
				<li><a href="<?php echo base_url();?>admin/product">Products</a></li-->
              <li><a href="<?php echo base_url();?>admin/password">Password</a></li>
                <li><a href="<?php echo base_url();?>logout">Logout</a></li>
            </ul>
            
        </div>
    </nav>
</div>
</header>
<!-- header close -->