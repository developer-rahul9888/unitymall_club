 
 <?php //$this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
 
 
 <div class="col-sm-12">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('distributor');?>">Back</a>
        <h2>Products Purchased Date</h2>
      </div>
	  
	     
&nbsp;

 <?php //echo form_close(); ?>
 
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
	  //print_r($restaurants);
      ?>
  <div class="clearfix"></div>
	  
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table text-center"> 
<thead> <tr> <th class="text-center">Date</th><th class="text-center">Package</th><th class="text-center">PV</th></tr> </thead> 
<tbody> 
<?php 
$i = 1; print_r($pins);
	$showtr = 'true'; 
if(!empty($pins)) { 
	  foreach($pins as $val){ 
	     // if($val['package']=='1' || $val['package']=='2') {
		    $date = date('d F Y',strtotime($val['used_on'])); 
			echo '<tr><td>'.$date.'</td><td>'.$val['p_amount'].'</td><td>'.$val['b_volume'].'</td></tr>';
			$showtr = 'false'; 
	     // }
	  }
	  if($showtr == 'true') { echo '<tr><td colspan="3">You still not purchase any product.</td></tr>'; }
}
else { echo '<tr><td colspan="3">You still not purchase any product.</td></tr>'; }
?>
</tbody> 

</table>
</div>
</div>
 
