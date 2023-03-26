<link rel="stylesheet" href="<?php echo base_url(); ?>../assets/front/css/lsb.css"> 
 <script src="<?php echo base_url(); ?>../assets/front/js/lsb.min.js"></script>
<?php // error_reporting(0); ?>
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
.table > tbody > tr.act {
    background: #5cb85c;
}

.table > tbody > tr.rej {
    background: red;
}

 </style>
 
<div class="page-heading">
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/customer/add'; ?>">Add New</a--> 
        <h2>Wallet Request List</h2>
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
		 <!--  <input type="hidden" name="datepicker" value="datepicker"> -->
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>
		  </form>
			  <div class="form-group col-sm-3">
		  
		  </div>

  
  </div>
  &nbsp;
	   <form class="form form-inline" method="post" action="">
	  
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover customer-table"> 
	<thead> <tr><th>ID</th> <th>Customer ID</th><th>UTR No.</th><th>Amount</th><th>Bank Name</th><th>Bank Branch</th><th>Date</th><th>status</th><th></th><th>Image</th><!--th>Delete</th--> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($customer as $con){ 
if($con['status'] == 'accepted') { $input = '';  } else { $input =  '<input type="checkbox" name="userid[]" value="'.$con['id'].'" >'; }
	if($con['status'] == 'accepted') { $st='act'; } elseif($con['status'] == 'rejected') {  $st='rej'; } else { $st=''; }
	echo '<tr class='.$st.'><td>'.$i.'</td><td>'.$con['customer_id'].'</td><td>'.$con['neft'].'</td><td>'.$con['amount'].'</td><td>'.$con['bank_name'].'</td><td>'.$con['bank_branch'].'</td><td>'.date('d F Y',strtotime($con['date'])).'</td><td>'.$con['status'].'</td><td>'.$input.'</td>';
	?>
	<td><a href="<?php echo base_url(); ?>../images/user/<?php echo $con['image']; ?>" class="lsb-preview wthree_p_grid" data-lsb-group="header"><img src="<?php echo base_url().'../images/user/'.$con['image']; ?>"  height="40px" ></a></td>
	
	<?php
/* if($con['user_level']=='5') { echo 'Supper Admin'; }
elseif($con['user_level']=='2') { echo 'Nucleus Staff / Coordinator'; }
elseif($con['user_level']=='3') { echo 'Fabulous Staff'; }
else { echo ''; } */
?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/customer/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>

<div class="form-group col-sm-6">         
		  <label>Status <small style="color:red">*</small></label>    
		  <select name="status" class="form-control custom-select">			
		  <option value="active">Active</option>		
		  <option value="rejected">Rejected</option>		
		  <option value="accepted">Accepted</option>		
		  </select>      
		  </div> 

<p class="text-center"><input type="submit" class="btn btn-primary" name="update_req" value="Update"> </p>
</form>
 
<script>
	jQuery(window).load(function() {
		  jQuery.fn.lightspeedBox();
		});
	</script> 
	
