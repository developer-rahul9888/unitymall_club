


<div class="page-heading">

  <h2>Wallet History </h2> 

</div>

 <?php

//flash messag
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


 <?php // echo "<pre>"; print_r($customer); echo "</pre>"; ?>

<div class="table-responsive">

<table id="example" class="table table-bordered table-hover customer-table"> 

<thead> <tr><th>ID</th> <th>Amount</th><th>Date</th></tr> </thead> 

<tbody> 

<?php 

$i = 1;
$credit_amt = 0;


foreach($wallet_history as $con){ 

$credit_amt  = $credit_amt + $con['amount'];
	echo '<tr><td>'.$i.'</td><td>'.$con['amount'].'</td><td>'.date('d F Y',strtotime($con['rdate'])).'</td>';

?>
<?php echo '</tr>';

$i++;
}

?>

<tfoot> <tr><th colspan="2">Total</th> <th><?php echo $credit_amt; ?></th></tr> </tfoot>

</tbody> 

</table>

</div>

</form>

<?php echo form_close(); ?>