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
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/merchant/add'; ?>">Add New</a--> 
        <h2>Merchant List</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> merchant updated with success.';
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
      
      echo form_open('admin/merchant/', $attributes);
      ?>
	  <div class="table-responsive">
<table class="table table-bordered table-hover merchant-table"> 
	<thead> <tr> <th>Name</th><th>Email</th><th>Merchant ID</th><th>Phone</th><th>status</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($merchant as $con){ 
	
	echo '<tr><td><a href="'.base_url().'admin/merchant/edit/'.$con['id'].'">'.$con['d_name'].'</a></td><td><a href="'.base_url().'admin/merchant/edit/'.$con['id'].'">'.$con['email'].'</a></td><td>'.$con['merchant_id'].'</td><td>'.$con['phone'].'</td><td>'.$con['status'].'</td>';
/* if($con['user_level']=='5') { echo 'Supper Admin'; }
elseif($con['user_level']=='2') { echo 'Nucleus Staff / Coordinator'; }
elseif($con['user_level']=='3') { echo 'Fabulous Staff'; }
else { echo ''; } */
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/merchant/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>
</form>
 <?php echo form_close(); ?>