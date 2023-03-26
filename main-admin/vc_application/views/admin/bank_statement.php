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
 
        <h2>Bank Statement</h2>
      </div>
 <div class="container1">
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/bank-statement',$attributes);
      ?>
	   	<div class="col-sm-12">
		<div class="form-group col-sm-4">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
	  </div>
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		  </div>
		  
	
		  <div class="form-group col-sm-3"><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></label>
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>
</div> 
 <?php echo form_close(); ?>

<p>&nbsp;</p>
<?php echo $error_msg; ?>
 </div>
  
<form method="post" action="" class="form form-inline">	  
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>S. No.</th><th>Transaction ID</th><th>Name</th><th>Amount</th><th>Admin</th><th>TDS</th><th>Bank Name</th><th>Bank A/c No</th><th>IFSC</th><th>Pan No</th><th>Date</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
$r=0;
$admin=0;
$total=0;

/* echo "<pre>";
print_r($payouts);
echo "</pre>"; */
foreach($payouts as $con){ 
    $date = date('d M Y',strtotime($con['udate']));
	$payable = $con['net_income'];
	$r = $r+$payable;
	$checked = $class = '';
	if($con['amount'] > 99 && $con['bank_name']!='' && $con['account_no']!='' && $con['ifsc']!='' && $con['pancard']!='') { $checked = 'checked="checked"';  }
 
	
	echo '<tr '.$class.'><td>'.$i.'</td><td>'.$con['bank_tran'].'</td><td>'.$con['f_name'].' '.$con['l_name'].' ('.$con['customer_id'].')</td><td>Rs. '.$con['net_income'].'</td><td>'.$con['admin'].'</td><td>'.$con['tds'].'</td><td>'.$con['bank_name'].'</td>
	<td>'.$con['account_no'].'</td><td>'.$con['ifsc'].'</td><td>'.$con['pancard'].'</td><td>'.$date.'</td>';

?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
<tfooter><tr style="height:40px;background-color:#0098da;"> 	<td colspan="3">Total</td>	<td>Rs <?php echo $r; ?></td>	<td></td><td></td><td></td><td></td><td></td><td></td><td></td>	</tr></tfooter>
</table>
</div>
  
</form>

 <?php //echo form_close(); ?>