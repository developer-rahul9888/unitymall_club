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
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/gallery/add'; ?>">Add New</a>
        <h2>Manage Webstore Receipt</h2>
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
      ?>
	 <div style="overflow-x:auto; width:100%;">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>S No.</th> <th>Website</th><th>Product</th><th>Image</th><th>Description</th><th>Amount</th><th>Customer_id</th><th>Status</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($receipt as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/receipt/edit/'.$con['id'].'">'.$con['website'].'</a></td><td>'.$con['product'].'</td><td>'.$con['image'].'</td><td>'.$con['description'].'</td><td>'.$con['amount'].'</td><td>'.$con['customer_id'].'</td><td>'.$con['status'].'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/receipt/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>