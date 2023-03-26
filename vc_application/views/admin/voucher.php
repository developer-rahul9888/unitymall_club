 
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
        <h2>E-Voucher</h2> 
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
            echo '<strong>Well done!</strong> Voucher purchased successfully.';
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
  <?php 
		//print_r($gallery);
		if(!empty($voucher)){
						foreach($voucher as $row){ 
							
					?> 
		<div class="col-sm-3">
			<a href="<?php echo base_url().'admin/voucher/'.$row['p_id'];?>"><div class="voucherrr">
				<div class="voucherrr_img">
					<img src="<?php echo 'https://www.unitymall.in/main-admin/assets/images/'.$row['image'] ;?>" >
					
				</div>
				<div class="titleee text-center">
					<h5><?php echo $row['pname']; ?></h5>
					<h5> <?php //echo $row['price']; ?></h5>
				</div> 	

			</div> </a> 
		</div>   
		<?php
						}
						}
						?> 

</div>
 
