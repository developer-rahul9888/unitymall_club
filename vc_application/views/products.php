 <link href="<?php echo base_url(); ?>assets/front/css/style1.css" rel="stylesheet">

 <section class="page-title">
    	<div class="auto-container">
			<div class="content">
				<h1>Products <span></span></h1>
				<ul class="page-breadcrumb">
					<li><a href="<?php echo base_url();?>">Home</a></li>
					
					<li>Products</li>
				</ul>
			</div>
        </div>
    </section>




	<div class="container" >

	
	<div class="row">
		

<?php 
if(!empty($products)) { 
	foreach($products as $gold) {
	
		if($gold['cost'] == $gold['p_d_price']){ 
		
		$procost = $gold['p_d_price'];
		
		}else{
			
			$procost = $gold['cost'];
			
		}
                 echo '
					<div class="col-md-3 new-grid-w3l view view-eighth">
					<div class="pr-box">
                  
					<a href="/product/'.$gold['p_id'].'">';										
						echo '<img class="img-responsive center-block" src="'.base_url().'main-admin/images/product/'.$gold['image'].'" alt=" " class="img-responsive" />
						</a>
						
						<div class="btm">
                            <center><h4><span>'.$gold['pname'].'</span></h4>
							<h4><span>MRP '.$procost.'</span></h4>
							<h4><span>Coins '.$gold['comm_dis'].'</span></h4>
							<h4><span>Reward Points '.$gold['reward'].'</span></h4>
			
			
			</h4></center>
							 
								
								
							
							
                          </div>
					
			</div>
					</div> '; 
					}
             } ?>

			  
<div class="clearfix"></div>
	</div>
</div>
