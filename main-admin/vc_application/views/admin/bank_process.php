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
 
        <h2>Bank Process</h2>
      </div>
	   <div class="col-sm-12">
	  <div class="form-group col-sm-3">
		   <?php echo form_open('vc_site_admin/pin/generatecsv'); ?>
		   
		    
		    	<label>&nbsp;</label>
		   <input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">
		   
		   <?php echo form_close(); ?>
		  </div>
		  </div>
 <div class="container1">
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/bank-process');
      ?>
	   
 <?php echo form_close(); ?>

<p>&nbsp;</p>
<?php echo $error_msg; ?>
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
      
      //echo form_open('admin/category/', $attributes);
      ?>
	  
<form method="post" action="" class="form form-inline">	  
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>S. No.</th><th>Name</th><th>Amount</th><th>Bank Name</th><th>Bank A/c No</th><th>IFSC</th><th>Transaction No</th><th></th></tr> </thead> 
<tbody> 
<?php 
$i = 1;

/* echo "<pre>";
print_r($payouts);
echo "</pre>"; */
foreach($payouts as $con){ 
	$tds = (5 / 100) * $con['amount'];
	$payable = $con['amount'] - 3*$tds;
	$payable = round($payable,2);
	$checked = $class = '';
	if($payable > 99 && $con['bank_name']!='' && $con['account_no']!='' && $con['ifsc']!='' && $con['pancard']!='') { $checked = 'checked="checked"';  }
	else { $class = 'style="background:red"'; }
	
	echo '<tr '.$class.'><td>'.$i.'</td><td>'.$con['f_name'].' '.$con['l_name'].' ('.$con['customer_id'].')</td><td>Rs. '.$con['net_income'].'</td><td>'.$con['bank_name'].'</td>
	<td>'.$con['account_no'].'</td><td>'.$con['ifsc'].'</td>
	<td><input type="text" name="banktrid[]" value="" class="form-control"></td>
	<td><input type="checkbox" name="userid[]" value="'.$con['userid'].'" '.$checked.'></td>';

?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
 
<p class="text-center"><input type="submit" class="btn btn-primary" name="closeweek" value="Bank Process Verified"> </p>
</form>

 <?php //echo form_close(); ?>