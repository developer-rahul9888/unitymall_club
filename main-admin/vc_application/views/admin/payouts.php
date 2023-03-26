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
 
        <h2>Payouts</h2>
      </div>
 <div class="container1">
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/payouts');
      ?>


      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Sucessfully.</strong></div>';    
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  //print_r($restaurants);
      ?>
	  
	  	<div class="col-sm-12">
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
		   
</div>
 <?php echo form_close(); ?> 
<div class="col-sm-12">
<div class="form-group col-sm-3">
		   <?php echo form_open('vc_site_admin/pin/generatecsv_payout'); ?>
		   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
		    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		    
		    	<label>&nbsp;</label>
		   <input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">
		   
		   <?php echo form_close(); ?>
		  </div>
</div>

 <h3 class="text-center hide"><?php echo $last_friday = date('D d M Y',strtotime("last thursday")); 
 echo ' <span>To</span> '.$week_end = date('D d M Y',strtotime("+ 6 days",strtotime($last_friday)));?></h3>
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
<thead> <tr> <th>S. No.</th><th>User ID</th><th>Name</th><th>Amount</th><th>Admin</th><th>TDS</th><th>Payable</th><th>Bank Name</th><th>Bank A/c No</th><th>IFSC</th><th>Pan No</th><!-- <th>Date</th> --><th><input type="checkbox"  id="checkAll"></th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
$total_amount=$total_tds=$total_admin=$total_payable=0;
/* echo "<pre>";
print_r($payouts);
echo "</pre>"; */
foreach($payouts as $con){ 
	$tds = (5 / 100) * $con['amount'];
$payable = $con['amount'] - 3*$tds ; 
	$payable = round($payable,2);
	$checked = $class = '';
	$total_amount=$total_amount+$con['amount'];
	$total_tds=$total_tds+$tds;
	$total_admin=$total_admin+$tds+$tds;
	$total_payable=$total_payable+$payable;
	if($payable > 99 && $con['bank_name']!='' && $con['account_no']!='' && $con['ifsc']!='' && $con['pancard']!='') { $checked = 'checked="checked"';  }
	else { $class = 'style="background:red"'; }
	
	echo '<tr '.$class.'><td>'.$i.'</td><td>'.$con['customer_id'].'</td><td>'.$con['f_name'].' '.$con['l_name'].'</td>
	<td>'.$con['amount'].'</td><td>'.$con['admin'].'</td><td>'.$con['tds'].'</td><td>'.$con['net_income'].'</td><td>'.$con['bank_name'].'</td>
	<td>'.$con['account_no'].'</td><td>'.$con['ifsc'].'</td><td>'.$con['pancard'].'</td>
	<td><input type="checkbox" name="userid[]" value="'.$con['userid'].'" '.$checked.'></td>';

?>
	

		<?php echo '</tr>';
$i++;
}
?>
<tr><td colspan="3"><b><center>Total</b></center></td><td><?php echo $total_amount; ?></td><td><?php echo $total_tds; ?></td><td><?php echo $total_admin; ?></td><td><?php echo $total_payable; ?></td><td colspan="7"></td></tr>
</tbody> 
</table>
</div>
 
<p class="text-center"><input type="submit" class="btn btn-primary" name="closeweek" value="Payout"> </p>
</form>

 <?php //echo form_close(); ?>
 
  <script>
 $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
 
 </script>