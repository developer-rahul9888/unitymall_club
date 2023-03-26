<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>

<style>
 .table-striped > tbody > tr.Delivered {background:#5cb85c}
 .table-striped > tbody > tr.Accepted {background:#ec971f}
 .table-striped > tbody > tr.Pending {background:#31b0d5}
 .table-striped > tbody > tr.Cancel {background:#c9302c}
</style>

<div class="page-heading"> 
        <h2>Purchased Voucher</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> updated with success.';
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
      
      echo form_open('', $attributes);
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
<form action="" method="POST">
	  <p>&nbsp;</p>
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover category-table table-striped"> 
<thead> <tr> <th>OrderID.</th><th>Name</th><th>Customer id</th><th>Phone</th><th>Amount</th><th>Quantity</th><th>Status</th><th>Date</th><th></th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
$total_amount=0;
	$comm_dis=0;
foreach($order as $con){ 
	
	echo '<tr><td>'.$i.'</td>
	<td>'.$con['pname'].'</a></td>
	<td>'.$con['customer_id'].'</td>
	<td>'.$con['phone'].'</a></td>
	<td>'.$con['price'].'</td>
	<td>'.$con['quantity'].'</td>
	<td>'.$con['status'].'</td>';
	echo '</td><td>'.$con['date'].'</td><td><input type="checkbox" value="'.$con['id'].'" name="checkbox[]"></td>';
?>
		<?php echo '</tr>';
$i++;
}
?>
</tbody>

</table></div>

<div class="row">
 <div class="col-md-4">
 	<div class="form-group">
 		<select class="form-control" name="status">
 			<option value="Accepted">Accepted</option>
 			<option value="Pending">Pending</option>
 		</select>
 	</div>
 	
 </div>
 <div class="col-md-4">
 	<input  name="submit" value="submit" class="btn btn-primary" type="submit"></input>
 </div>
 </div>
 <?php echo form_close(); ?>