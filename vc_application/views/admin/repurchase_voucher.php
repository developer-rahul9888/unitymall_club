 <style>
body {
  font-family: Arial;
}

.coupon {
  border: 5px dotted #bbb;
  border-radius: 15px;
  margin: 0 auto;
  max-width: 600px;
}
.coupon > .coupon-desc {
  padding: 0 15px;
}
.coupon > .coupon-desc  span {
  font-size: 14px;
}
.container {
  padding: 2px 16px;
  background-color: #f1f1f1;
}

.promo {
  background: #ccc;
  padding: 3px;
}

.expire {
  color: red;
}
</style>
 <?php //$this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
 <style type="text/css">
 	.table {
      background-color: #a0a0cc;
}
 </style>

 <div class="col-sm-12">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin');?>">Back</a>
        <h2>Repurchase Voucher</h2> 
      </div>
      <br>
      <br>
      <br>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> order updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	 // print_r($daily_weakly_in);
      ?>
  <div class="clearfix"></div>
  <div class="row weekkk">
<!-- <div class="col-md-3">
<div class="coupon">
  
  <img src="https://www.unitymall.in/main-admin/assets/images/prestige-logo-500x500.png" alt="Avatar" style="width:100%;">
  
  <div class="coupon-desc">

  	<h3><b>20% OFF YOUR PURCHASE</b></h3> 
    <p>Use Promo Code: <span class="promo">BOH232</span></p>
    <p>Brand: BOH232</p>
    <p><span>Status: Process</span> <span style="float: right;">Quantity: 1 </span></p>
    <p class="expire">Expires: Jan 03, 2021</p>
  </div>
</div>
</div> -->



  
  <?php 
		//echo '<pre>'; print_r($vouchers_data); echo '</pre>';
		if(!empty($vouchers_data)){
						foreach($vouchers_data as $row){ 
							$json_decode = json_decode($row['products'],true);
					?> 
		<!-- <div class="col-sm-3">
			<div class="voucherrr">
				<div class="voucherrr_img">
					<img src="<?php echo base_url().'main-admin/assets/images/'.$row['image'] ;?>" >
					
				</div>
				<div class="titleee text-center">
					<h4><?php echo $row['pname']; ?></h4>
				</div>	


<div class="titleee text-center">
					<h4>Rs<?php echo $row['price']; ?></h4>
				</div>	





				
			</div>
		</div>  -->

		<div class="col-md-3">
<div class="coupon">
  
  <img src="https://www.unitymall.in/main-admin/assets/images/<?php echo $row['image'] ;?>" alt="Avatar" style="width:100%;">
  
  <div class="coupon-desc">
  	<h4><b><?php echo $row['pname']; ?></b></h4> 
   <!--  <p>Use Promo Code: <span class="promo">BOH232</span></p> -->
    <!-- <p>Brand: BOH232</p> -->
    <p><span>Status: Process</span> <span style="float: right;">Quantity: 1 </span></p>
    <?php if(!empty($json_decode)) {
    			foreach ($json_decode as $value) {
    				echo '<p><span>Value: '.$value['cost'].'</span> <span style="float: right;">Coin: '.$value['price'].' </span></p>';
    			}
    } ?>

    
    <!-- <p class="expire">Expires: Jan 03, 2021</p> -->
  </div>
</div>
</div>


		<?php
						}
						}
						?>
		
		
		
		
		
		
		
			
			
			 
			
			
	 

</div>
 
