<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title><?php if($page_title==''){ echo 'Data Scraper'; }
 else { echo $page_title.' | Data Scraper'; } ?></title>
<?php 
if($page_keywords != ''){ echo '<meta name="description" content="'.$page_keywords.'">'; }
if($page_description !=''){ echo '<meta name="keywords" content="'.$page_description.'">'; }
?>
<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/front/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet" type="text/css">



<script src="<?php echo base_url(); ?>assets/front/js/jquery-1.12.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/moment-with-locales.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.leanModal.min.js"></script>
</head>
<body <?php if($page_slug != ''){ echo 'class="'.$page_slug.'"'; }?>> 
<div class="container text-center"> <a href="<?php echo base_url();?>"><img class="logo" src="<?php echo base_url(); ?>assets/images/logo.png"></a> </div>