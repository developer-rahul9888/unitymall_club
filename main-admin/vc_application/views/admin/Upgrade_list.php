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
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/upgrade/add'; ?>">Add New</a--> 
        <h2>Account Upgrade Request</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Account Upgrade Request success.';
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
      
      echo form_open('admin/upgrade/', $attributes);
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover redeam-table"> 
	<thead> <tr><th>ID</th><th>Name</th><th>Email</th><th>Status</th><th>Req. for</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;

foreach($upgrade as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/upgrade/edit/'.$con['up_id'].'">'.$con['f_name'].'</a></td><td><a href="'.base_url().'admin/upgrade/edit/'.$con['up_id'].'">'.$con['email'].'</a></td><td>'.$con['up_status'].'</td><td>'.$con['req_for'].'</td>';
echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>