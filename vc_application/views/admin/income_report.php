 
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
        <h2><?php echo $page_title;?></h2>
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
		<div class="col-sm-3">
			<div class="main_div">
			
				<div class="iconnn">
					<img src="<?php echo base_url(); ?>/assets/front/images/weeklyyyyy.png" class="img-responsive">
				</div>
				<div class="bz wee">
					<h2>Weekly</h2>
					<h2>Rs <?php echo round($weekly+0,2); ?></h2>
				</div>
			
			</div>
			</div>
			
			 <div class="col-sm-3">
			 <div class="main_div">
				
					<div class="iconnn">
						<img src="<?php echo base_url(); ?>/assets/front/images/monthlyyy.png" class="img-responsive">
					</div>
					<div class="bz mon">
						<h2>Monthly</h2>
						<h2>Rs <?php echo round($total_income+0,2); ?></h2>
						</div>
					
			</div>
			</div>
			
			
			 <div class="col-sm-3">
			 <div class="main_div">
			
			<div class="iconnn">
						<img src="<?php echo base_url(); ?>/assets/front/images/Payout.png" class="img-responsive">
					</div>
				<div class="bz payyy">
					<h2>Payout</h2>
					<h2>Rs <?php echo round($payout[0]['amount']+0,2); ?></h2>
					</div>
				
			</div> 
			</div>
			
			 <div class="col-sm-3">
			 <div class="main_div">
			
			<div class="iconnn">
						<img src="<?php echo base_url(); ?>/assets/front/images/bankkkk.png" class="img-responsive">
					</div>
				<div class="bz bankkk">
					<h2> Bank Process</h2>
					<h2>Rs <?php echo round($bank_process[0]['amount']+0,2); ?></h2>
					</div>
				
			</div>
			</div>
			
			
	 

</div>
 
