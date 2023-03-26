<section>	
<div class="container">


<div class="breadcrumbs">	
	<ol class="breadcrumb">		
	<li><a href="#">Home</a></li>
	<li class="active">Check out</li>
	<li class="active">Payment</li>	</ol>
	</div><!--/breadcrums-->		
 <div class="stepwizard text-center">
    <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step text-left">
        <a href="<?php echo base_url();?>checkout" type="button" class="btn btn-primary btn-circle">Step 1</a>
        <p>Shipping</p>
      </div>
          <div class="stepwizard-step">
        <a href="javascript:;" type="button" class="btn btn-primary btn-circle" disabled="disabled">Step 2</a>
        <p>Payment</p>
      </div>
          <div class="stepwizard-step text-right">
        <a href="javascript:;" type="button" class="btn btn-default btn-circle" disabled="disabled">Step 3</a>
        <p>Thank you</p>
      </div>
        </div>
  </div>
  
   
  
	 <div class="col-lg-3 ">  </div>
	 
<div class="col-lg-6">	 
	 
<iframe src="<?php echo $production_url?>" id="paymentFrame" style="max-width:600px;" width="100%" height="450" frameborder="0" scrolling="No" ></iframe>

</div>

<div class="col-lg-3">  </div>

<script type="text/javascript">
    	jQuery(document).ready(function(){
    		 window.addEventListener('message', function(e) {
		    	 jQuery("#paymentFrame").css("height",e.data['newHeight']+'px'); 	 
		 	 }, false);
	 	 	
		});
</script>
	
</div>
</section>