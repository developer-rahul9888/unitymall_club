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


        <h2>My Transfer PINS </h2>
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
      
      echo form_open('admin/pin/my-pin-transfer');
      ?>
	  
	  	<div class="col-sm-12">
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
	  </div>
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		  </div>
	<div class="form-group col-sm-3">
	<label>Transfer To :</label>
		    <input type="text" class="form-control" value="<?php if($this->input->post('transferto')!='') { echo $this->input->post('transferto'); }?>" name="transferto"> 
		  </div>
		  
		 
		  <div class="form-group col-sm-3">
		      	<label>&nbsp;</label>
		  <input style="display:block" type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>
</div> 
 <?php echo form_close(); ?>
<p>&nbsp;</p>
 
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>Sr. No.</th><th>PIN </th><th>Price</th><th>Transfer To</th><th>Name</th><th>Date</th><th>Status</th> </tr> </thead> <tbody> 
<?php 
$i = 1;
foreach($pin as $con){ 
	echo '<tr><td>'.$i.'</td><td>'.$con['pinno'].'</td><td>'.$con['pinam'].'</td><td>'.$con['assign_to'].'</td><td>'.$con['cname'].'</td>
	<td>'.date('d F Y',strtotime($con['rdate'])).'</td><td>'.$con['statuss'].'</td>';

?>
	
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>
