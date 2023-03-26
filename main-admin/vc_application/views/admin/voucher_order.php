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
<!--<a class="btn btn-primary flr" href="<?php echo base_url().'admin/f_product/add'; ?>">Add New</a>-->
        <h2>Voucher Order</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product updated with success.';
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
      
      echo form_open('admin/f_product/', $attributes);
      ?>
    <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>SKU</th> <th>Customer ID</th> <th>Name</th> <th>Email</th> <th>Voucher Name</th><th>Voucher Value</th><th>Status</th><th>Date</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($voucher_order as $con){  
  echo '<tr><td>'.$i.'</td><td>'.$con['customer_id'].'</td><td>'.$con['f_name'].' '.$con['l_name'].'</td><td>'.$con['email'].'</td><td><a href="'.base_url().'admin/voucher_order/edit/'.$con['id'].'">'.$con['pname'].'</a></td><td>'.$con['price'].'</td><td>'.$con['status'].'</td><td>'.date('Y-m-d H:i:s',strtotime($con['date'])).'</td>';
?>
<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>