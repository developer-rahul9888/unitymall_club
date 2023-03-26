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

 

        <h2>Reward</h2>

      </div>

 <div class="container">

 <?php

      //form data

      $attributes = array('class' => 'form form-inline', 'id' => '');



      //form validation

      echo validation_errors();

	  //print_r($editor);

      

      echo form_open('admin/reward');

      ?>

	  

	  	<div class="col-sm-12 hide">

		<div class="form-group col-sm-3">

		<label>From :</label>

	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">

	  </div>

	<div class="form-group col-sm-3">

	<label>To :</label>

		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 

		  </div>

		  

	

		  <div class="form-group col-sm-3">

		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 

		  </div>

</div> 

 <?php echo form_close(); ?>

<p>&nbsp;</p>

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

      if($error_msg != '') { echo $error_msg; }

      echo form_open('admin/reward', $attributes);

      ?>

	   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">

	   

	    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate">

	  

	  <div class="table-responsive">

<table id="example" class="table table-bordered table-hover category-table"> 

<thead> <tr> <th>S. No.</th><th>Reward</th><th>User</th><th>User ID</th><th>Date</th><th>Status</th><th></th><!-- <th>Status</th> <th></th> --></tr> </thead> 

<tbody> 

<?php 

$i = 1;

foreach($reward as $con){ 

	

	if($con['status'] == '1') { $st='act'; $input = '';  }  else { $st=''; $input =  '<input type="checkbox" name="userid[]" value="'.$con['id'].'" >'; }

	

	if($con['status'] == '1') { $status = 'Redeem'; } else { $status = 'Pending'; }

	echo '<tr><td>'.$i.'</td><td>'.$con['reward'].'</td><td>'.$con['f_name'].' '.$con['l_name'].'</td><td>'.$con['customer_id'].'</td><td>'.$con['c_date'].'</td><td>'.$status.'</td><td>'.$input.'</td>';



?>

	

<!--<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->

		<?php echo '</tr>';

$i++;

}

?>

</tbody> 

</table></div>

<div class="form-group col-sm-6">         

		  <label>Status <small style="color:red">*</small></label>    

		  <select name="status" class="form-control custom-select">			

		 	

		  	

		  <option value="1">Accepted</option>		

		  </select>      

		  </div> 



<p class="text-center"><input type="submit" class="btn btn-primary" name="update_req" value="Update"> </p>



 <?php echo form_close(); ?>