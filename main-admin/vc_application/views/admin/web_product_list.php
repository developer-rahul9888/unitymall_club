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
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/w_product/add'; ?>">Add New</a>

        <h2>Manage Offer</h2>
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
      
      echo form_open('admin/product/', $attributes);
      ?>
    <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>ID</th><th>SKU</th> <th>Title</th><th>Description</th><th>Product Type</th><th>Status</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($product as $con){ 

if($con['product_type']==1){$pro_type='Hot Deals';}elseif($con['product_type']==2){$pro_type='Best Cashback Offers';}elseif($con['product_type']==3){$pro_type='Best Deals & Discounts';}elseif($con['product_type']==4){$pro_type='Best Discount Coupons';}elseif($con['product_type']==5){$pro_type='Home slider';}
  
  echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/w_product/edit/'.$con['id'].'">'.$con['sku'].'</a></td><td><a href="'.base_url().'admin/w_product/edit/'.$con['id'].'">'.$con['pname'].'</a></td><td>'.$con['s_discription'].'</td><td>'.$pro_type.'</td><td>'.$con['status'].'</td>';
?>
  
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/product/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
    <?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>