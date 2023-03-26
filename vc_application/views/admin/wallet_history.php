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



        <h2>Wallet History </h2> 

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

	  <?php // echo "<pre>"; print_r($customer); echo "</pre>"; ?>

	  <div class="table-responsive">

<table id="example" class="table table-bordered table-hover customer-table"> 

	<thead> <tr><th>ID</th> <th>Name</th><th>Credit Amount</th><th>Debit Amount</th><th>Send By/Send To</th><th>Cause</th><th>Date</th></tr> </thead> 

<tbody> 

<?php 

$i = 1;
$credit_amt = 0;
$debit_amt = 0;
foreach($wallet_history as $con){ 

	$credit_amt = $credit_amt + $con['credit_amt'];
	$debit_amt = $debit_amt + $con['debit_amt'];
	echo '<tr><td>'.$i.'</td><td>'.$con['user_id'].'</td><td>'.$con['credit_amt'].'</td><td>'.$con['debit_amt'].'</td><td>'.$con['sender_id'].'</td><td>'.$con['Cause'].'</td><td>'.date('d F Y',strtotime($con['receive_date'])).'</td>';



?>





		<?php echo '</tr>';

$i++;


}

?>
<tfoot> <tr><th colspan="2">Total</th> <th><?php echo $credit_amt; ?></th><th><?php echo $debit_amt; ?></th><th>Send By/Send To</th><th>Cause</th><th>Date</th></tr> </tfoot>
</tbody> 

</table>

</div>

</form>

 <?php echo form_close(); ?>