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
        <h2>Sale Stock</h2>
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
<thead> <tr><th>S.NO.</th> <th>Product</th><th>Quantity</th><th>Amount</th><th>BV</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;

foreach($sale as $con){ 
	
	echo '<tr><td><center>'.$i.'</center></td><td><center>'.$con['pname'].'</center></td><td><center>'.$con['qty'].'</center></td><td><center>'.$con['p_d_price'].'</center></td><td><center>'.$con['comm_dis'].'</center></td>';
?>
	
<!-- <td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/sale/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td> -->
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>
</form>
 <?php echo form_close(); ?>