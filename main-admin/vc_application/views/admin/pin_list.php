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
 <?php if($this->session->userdata('role')=='5'){ ?>
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/pin/add'; ?>">Add New</a>
 <?php } ?>


        <h2>PINS</h2>
      </div>	  	  
	  
 
	  
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> pin updated with success.';
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
      
      echo form_open('admin/pin');
      ?>
	  
	  	<div class="col-sm-12">
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
	  </div>
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		  </div>
		  
		  <div class="form-group col-md-3">
		<label>Status:</label><div>
		<label class="radio-inline"><div class="choice"><span class=""><input type="radio" name="st" value="" <?php if($this->input->post('st')=='') { echo "checked='checked'";};?> ></span></div>Any</label>
        <label class="radio-inline"><div class="choice"><span class=""><input type="radio" name="st" value="Deactive" value="" <?php if($this->input->post('st')=='Deactive') { echo "checked='checked'";};?>></span></div>
		Unused</label>
		<label class="radio-inline">
		<div class="choice"><span class="checked"><input type="radio" name="st" value="Used" <?php if($this->input->post('st')=='Used') { echo "checked='checked'";};?>></span></div>Used</label>
		<label class="radio-inline">
		<div class="choice"><span class="checked"><input type="radio" name="st" value="Active" <?php if($this->input->post('st')=='Active') { echo "checked='checked'";};?>></span></div>Active</label>
		</div>
									</div>
		  
		  
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>
</div> 
 <?php echo form_close(); ?>
<p>&nbsp;</p>
 
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>Sr. No.</th><th>PIN </th><th>Package</th><th>Price</th><th>Alloted to</th><th>Moved to</th><th>Used By </th><th>Used On</th><th>Status</th> </tr> </thead> <tbody> 
<?php 
$i = 1;
foreach($pin as $con){ 
	
	echo '<tr><td>'.$i.'</td><td>'.$con['pinid'].'</td><td>'.$con['package'].'</td><td>'.$con['p_amount'].'</td>';
	echo '<td>'.$con['assign_to'].'</td><td>'.$con['move_to'].'</td><td>'.$con['used_by'].'</td><td>'.$con['used_on'].'</td><td>'.$con['status'].'</td>';
/* if($con['user_level']=='5') { echo 'Supper Admin'; }
elseif($con['user_level']=='2') { echo 'Nucleus Staff / Coordinator'; }
elseif($con['user_level']=='3') { echo 'Fabulous Staff'; }
else { echo ''; } */
?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>
