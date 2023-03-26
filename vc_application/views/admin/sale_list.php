<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>
<div class="page-heading">
  <?php  if($profile[0]['franchise'] > 0) { ?>
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/sale/add'; ?>">Add New</a>
<?php } ?>
        <h2>Franchise Order</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> sale updated with success.';
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
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/sale/', $attributes);
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>S.NO.</th> <th>User ID</th><th>TxnId</th><th>Total Paid</th><th>Date</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;

foreach($sale as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/sale/invoice/'.$con['id'].'">'.$con['customer'].'</a></td><td>'.$con['id'].'</td><td><a href="'.base_url().'admin/sale/invoice/'.$con['id'].'">'.$con['gtotal'].'</a></td><td>'.date('d F Y',strtotime($con['tdate'])).'</td>';
?>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>
</form>
 <?php echo form_close(); ?>