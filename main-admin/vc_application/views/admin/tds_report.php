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

 

        <h2>TDS Report</h2>

      </div>

 <div class="">

 <?php

      //form data

      $attributes = array('class' => 'form form-inline', 'id' => '');



      //form validation

      echo validation_errors();

	  //print_r($editor);

      

      

      ?>

	  

	  	<div class="col-sm-12">

	  	    <?php echo form_open('admin/tds_report'); ?>

		<div class="form-group col-sm-3">

		<label>From :</label>

	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">

	  </div>

	<div class="form-group col-sm-3">

	<label>To :</label>

		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 

		  </div>

		  

	

		  <div class="form-group col-sm-3">	<label>&nbsp;</label>

		  <input type="submit" name="submit" style="display:block" class="btn btn-primary" value="Search"> 

		  </div> 

		  

		  <?php echo form_close(); ?>

		  

		  <div class="form-group col-sm-3">

		   <?php echo form_open('vc_site_admin/pin/generatecsv_tds'); ?>

		   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">

		    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 

		    

		    	<label>&nbsp;</label>

		   <input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">

		   

		   <?php echo form_close(); ?>

		  </div>

</div> 



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

      

      //echo form_open('admin/category/', $attributes);

      ?>

	 <?php // echo "<pre>"; print_r($payouts); echo "</pre>"; ?>

	  

	  <div class="table-responsive">

<table id="example" class="table table-bordered table-hover category-table"> 

<thead> <tr> <th>S. No.</th><th>User</th><th>Amount</th><th>TDS(5%)</th><th>TDS</th><th>Pan No.</th><th>Date</th></tr> </thead> 

<tbody> 

<?php 

$i = 1;



 echo "<pre>";

//print_r($payouts);

//echo "</pre>"; 

$total_tds = '';
$total_amt='';

foreach($payouts as $con){  

	/*	$cashback = $con['amt'];

		$total_payount = $con['amt'] + $con['total_amount'];

         $tds = (5 / 100) * round($total_payount,2);

        $processing = (5 / 100) * round($total_payount,2);

		$payable= $total_payount - ($tds+$processing);

		*/ 

		

	$tax = ($con['amount']*5)/100;

	

	$payble = $con['amount'] - $tax;

	$total_tds += $tax;
	$total_amt += $con['amount'];

	

	echo '<tr><td>'.$i.'</td><td>'.$con['f_name'].' '.$con['l_name'].' ('.$con['customer_id'].')</td><td>'.round($con['amount'],2).'</td><td>5 %</td>

	<td>'.round($tax,2).'</td></td>

	<td>'.$con['pancard'].'</td><td>'.date('d F Y',strtotime($con['rdate'])).'</td>';



?>

	

<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->

		<?php echo '</tr>';

$i++;

}

?>



</tbody> 

<tr style="height:40px;background-color:#a72522;color:#fff;"> 

	<td colspan="2"><center><b>Total TDS Amount</b></center> </td>
<td><?php echo $total_amt; ?></td>
<td></td>
	<td><?php echo $total_tds; ?></td>
	<td colspan="2"></td>
	

	

	

</tr>

</table>

</div>



</form>



 <?php echo form_close(); ?>