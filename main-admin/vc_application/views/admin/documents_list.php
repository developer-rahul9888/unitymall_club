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
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/docverification/add'; ?>">Add New</a--> 
        <h2>Document Verification List</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> docverification updated with success.';
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
//	 print_r($docverification);
      
      echo form_open('admin/docverification/', $attributes);
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover docverification-table"> 
	<thead> <tr><th>ID</th><th>Name</th><th>Customer ID</th><th>Email</th><th>Phone</th><th>Status</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;

foreach($docverification as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/docverification/edit/'.$con['id'].'">'.$con['f_name'].' &nbsp'.$con['l_name'].'</a></td><td><a href="'.base_url().'admin/docverification/edit/'.$con['id'].'">'.$con['customer_id'].'</a></td><td><a href="'.base_url().'admin/docverification/edit/'.$con['id'].'">'.$con['email'].'</a></td><td>'.$con['phone'].'</td><td>'.$con['status'].'</td>';
?>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>
</form>
 <?php echo form_close(); ?>