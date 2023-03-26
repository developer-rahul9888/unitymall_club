<div class="container inner"><div class="row">    			    		<div class="col-sm-12">    			   								<h2 class="title text-center">Deals</h2>														</div>			 					</div> 
<?php 
if(!empty($deals)) { 
	foreach($deals as $deal) {
	  echo '<div class="col-sm-3 ">
	  <div class="pro">
                <div class="col-img-2"><a href="'.base_url().'deals/'.$deal['merchant_id'].'">';
              if($deal['brand_proof']==''){ echo '<img src="'.base_url().'assets/front/images/products1.jpg" class="img-togg img-responsive">'; }
		      else { echo '<img src="'.base_url().'merchants/images/profile/business_details/'.$deal['brand_proof'].'" class="img-responsive">'; }
       echo   '</a>
                </div>
               <h4>'.$deal['d_name'].'</h4>
               </div></div>';	
	}
} ?>
</div>