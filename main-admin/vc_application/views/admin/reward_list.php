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
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/customer/add'; ?>">Add New</a--> 
        <h2>Distributor List</h2> 
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> customer updated with success.';
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
      
      //echo form_open('admin/customer/', $attributes);
      ?>
	  <div class="col-sm-12">
	  <form class="form form-inline" method="post" action="">
     
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('s_name')!='') { echo $this->input->post('s_name'); }?>" name="sdate">
	  </div>
	  
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('e_name')!='') { echo $this->input->post('e_name'); }?>" name="edate"> 
		  </div>
		  
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>

  </form>
	</div>   
	  <p>&nbsp;</p>
	  
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover customer-table"> 
	<thead> <tr><th>ID</th> <th>Name</th><th>Email</th><th>Distributor ID</th><th>Sponsor ID</th><th>Phone</th><th>Earnings</th><th>DOJ</th><th>Status</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($customer as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/customer/edit/'.$con['id'].'">'.$con['f_name'].'</a></td><td><a href="'.base_url().'admin/customer/edit/'.$con['id'].'">'.$con['email'].'</a></td><td>'.$con['customer_id'].'</td><td>'.$con['direct_customer_id'].'</td><td>'.$con['phone'].'</td><td>'.$con['bliss_amount'].'</td><td>'.date('d F Y',strtotime($con['rdate'])).'</td><td>'.$con['status'].'</td>';
/* if($con['user_level']=='5') { echo 'Supper Admin'; }
elseif($con['user_level']=='2') { echo 'Nucleus Staff / Coordinator'; }
elseif($con['user_level']=='3') { echo 'Fabulous Staff'; }
else { echo ''; } */
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/customer/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>