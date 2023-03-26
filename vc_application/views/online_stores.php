	
	
	<div class="container-fluid" style="padding:0px;">
		<div class="shoes-grid">
			<img src="<?php echo base_url() ?>assets/front/images/online."  class="img-responsive" alt=" " />

	    </div>
	  </div>
	  
	  
	  
	  <section class="webstore1">
		  <div class="container" >

			<?php //$this->load->view('includes/front/leftsidebar');?>

	
			<div class="col-sm-12">
			  <div class="webstore-container">
				  <div class="products" style="margin-bottom: 0;">
	
					<h5 class="latest-product">Online Store</h5>
				</div>
	   		     <div class="product-left">
				 
				 <?php
if(!empty($webstore)) { 
$i=0;
foreach($webstore as $bco) {
	
$url='<a href="'.base_url().'online-store/'.$bco['web_name'].'/'.$bco['id'].'">';
//$url='<a href="'.$bco['web_url'].'" target="_blank">';
	
	if($i==2) { $class='grid-top-chain'; }else{$class='';}
	
	echo '<div class="col-md-3 col-sm-3 col-xs-6 '.$class.'"><div class="chain-grid chain-grid2">
	<div class="chain-grid chain-grid3">
	   		     		'.$url.'<img class="img-responsive center-block online-images" src="'.base_url().'/main-admin/images/webstores/'.$bco['web_img'].'" alt=" " /></a>
	   		     	</div>
	   		     		<div class="grid-chain-bottom">
						<center>
						<h5 class="text-center txt">'.$url.''.$bco['web_name'].'</h5>
	   		     			<h6 class="text-center">'.$url.''.$bco['web_s_dis'].'</h6>
							<a href="'.base_url().'online-store/'.$bco['web_name'].'/'.$bco['id'].'" style="color:#fff;"><button type="button" class="btn btn-warning grab-btn" >Go To Store</button></a>
							</center>
	   		     		</div>
                        
							</div>
	   		     	</div>';
	
		
	$i++;
	}
}  ?>
				 
	   		     	
	   		     	 <div class="clearfix"> </div>
	   		     </div>
				
	   		   </div>
	   		   </div>
	   		   </div>
	   		   </section>
			   
			   
			   
                               
         <!--      <?php //$this->load->view('includes/front/leftsidebar');?> -->
				
	

	