<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Redirecting</title>

    <!-- Bootstrap -->

<link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/front/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>

<style>
.img-responsive.online_site {
	position: absolute;
	top: -36px;
	left: 37px;
}
.col-sm-12.add_top {
    margin-top: 120px;
}
@media (min-width:320px) and (max-width:600px){
	.add-img.add_tv img {
	margin-top: -65px;
}
.col-sm-6.add-img2 {
	display: none;
}
.add-img1.col-sm-3 {
	display: none;
}
.gg h2{
	font-size:25px;
}
.gg h1{
	font-size:25px;
}
}
</style>


<body style="background:#fff">
<div class="container containerred text-center">
	
		<div class="col-sm-12 add_top">
			<div class=" add-img1 col-sm-3 ">
				<a href="index.php"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="img-responsive">
				</a>
			</div>
			<div class="col-sm-6 add-img2"> 
				<img src="<?php echo base_url(); ?>assets/front/images/run.png" >
			</div>
			<div class=" add-img add_tv col-sm-3"><a href="#"><img src="<?php echo base_url(); ?>main-admin/images/webstores/<?php echo $webstore[0]['web_img']; ?>" class="img-responsive online_site" />
			</a>
			</div>
		</div>
	
</div>
<div class="container containerred text-center gg">
	<h2>One second, we are just opening <?php echo $webstore[0]['web_name']; ?> site for you.</h2>
	<h1>Just shop as normal and we will take care of the rest.</h1>
	<p>Should this page be showing after few seconds, then please <a href="#">continue to <?php echo $webstore[0]['web_name']; ?></a> here.</p>
	<img src="<?php echo base_url(); ?>assets/front/images/loader-ct-merchant.gif" width="90" height="90" />
</div>
<script type="text/javascript">window.onload = function (){top.setTimeout(function (){top.location.href = "<?php echo $url; ?>";}, 2000)}
</script>

<script type="text/javascript">
    var cId =  "162830";

    (function(d, t) {
      var s = document.createElement("script");
      s.type = "text/javascript";
      s.async = true;
      s.src = (document.location.protocol == "https:" ? "https://cdn0.cuelinks.com/js/" : "http://cdn0.cuelinks.com/js/")  + "cuelinksv2.js";
      document.getElementsByTagName("body")[0].appendChild(s);
    }());
</script>
</body>
</html>

