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
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/f_product/add'; ?>">Add New</a>
        <h2>Manage E-Voucher</h2>
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
<thead> <tr><th>SKU</th> <th>Title</th><th>Price</th><th>Points</th><th>Description</th><th>Status</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($freeproduct as $con){  
	
	echo '<tr><td><a href="'.base_url().'admin/f_product/edit/'.$con['id'].'">'.$con['sku'].'</a></td><td><a href="'.base_url().'admin/f_product/edit/'.$con['id'].'">'.$con['pname'].'</a></td><td>'.$con['price'].'</td><td>'.$con['points'].'</td><td>'.$con['s_discription'].'</td><td>'.$con['status'].'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/f_product/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>