 
 <?php //$this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
 
 
 <div class="col-sm-12">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('distributor');?>">Back</a>
        <h2>Products Delivered Date</h2>
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
<thead> <tr> <th class="text-center">Date</th><th class="text-center">Product</th><th class="text-center">Slip No.</th><th class="text-center">Address</th>
<th class="text-center">Status</th><th class="text-center">Accept Delivery</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
	$showtr = 'true'; 
if(!empty($prodcuts)) { 
	  foreach($prodcuts as $val){   
			echo '<tr><td>'.$val['dis_date'].'</td><td>'.$val['pname'].'</td><td>'.$val['slip_no'].'</td><td>'.$val['address'].'</td><td>'.$val['status'].'</td><td>';
			if(strstr($val['deliverd_date'],'0000-00-00')) {
			    echo '<form method="post" action="" class="form form-inline">
			    <input type="hidden" value="'.$val['id'].'" name="psid"> 
			    <input type="submit" name="acceptdel" value="Accept Delivery" class="btn btn-success btn-sm"> 
			    </form>';
			} else { echo date('d F Y',strtotime($val['deliverd_date'])); }
			echo '</td></tr>';
	  } 
}
else { echo '<tr><td colspan="3">No product found.</td></tr>'; }
?>
</tbody> 

</table>
</div>
</div>
 
