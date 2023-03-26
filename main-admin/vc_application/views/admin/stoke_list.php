<script type="text/javascript"> function deleteConfirm(url){	if(confirm('Do you want to Delete this record ?')){  window.location.href=url;}}</script>
<div class="page-heading">
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/product/add'; ?>">Add New</a>
        <h2>Manage Products</h2>
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
      
      echo form_open('');
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>Title</th><th>Body</th><th>Product_type</th><th>SKU</th><th>Weight</th><th>Qty</th><th>variant_price</th><th>variant_compare_price</th><th>price</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($product as $con){ 
	
	echo '<tr><td>'.$con['Title'].'</td><td>'.$con['Body'].'</td><td>'.$con['Product_type'].'</td><td>'.$con['SKU'].'</td><td>'.$con['Weight'].'</td><td>'.$con['Qty'].'</td><td>'.$con['variant_price'].'</td><td>'.$con['variant_compare_price'].'</td><td>'.$con['price'].'</td>';
?>	
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
<div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
      </div>
 <?php echo form_close(); ?>