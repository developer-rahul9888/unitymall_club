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
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/product/add'; ?>">Add New</a-->
        <h2>Manage Products 
		<div style="float:right;">
		   <?php echo form_open('vc_site_admin/product/generatecsv'); ?>
		   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
		    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		    
		    	<label>&nbsp;</label>
		   <input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">
		   
		   <?php echo form_close(); ?>
		  </div> </h2>
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
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>SKU</th><th>Merchant</th> <th>product name</th><th>Actual Price</th><th>Discount Price</th><th>delivery charge</th><th>QTY</th><th>Description</th><th>product Type</th><th>Status</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($product as $con){ 
	
	echo '<tr><td><a href="'.base_url().'admin/m_product/edit/'.$con['id'].'">'.$con['sku'].'</a></td><td>'.$con['d_name'].'</td><td><a href="'.base_url().'admin/m_product/edit/'.$con['id'].'">'.$con['pname'].'</a></td><td>'.$con['price'].'</td><td>'.$con['p_d_price'].'</td><td>'.$con['delivery_charge'].'</td><td>'.$con['p_qty'].'</td><td>'.$con['s_discription'].'</td><td>'.$con['product_type'].'</td><td>'.$con['status'].'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/product/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</form>
 <?php echo form_close(); ?>