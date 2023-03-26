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
 
        <h2>GST Report</h2>
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
	  	    <?php echo form_open('admin/gst_report'); ?>
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
		   <?php echo form_open('vc_site_admin/sale/generatecsv'); ?>
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
<thead> <tr> <th>S. No.</th><th>User</th><th>Amount</th><th>GST</th><th>Pan No.</th><th>Date</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;

 

$total_tds = 0;
$total_amt = 0;
foreach($sale as $con){  
	/*	$cashback = $con['amt'];
		$total_payount = $con['amt'] + $con['total_amount'];
         $tds = (5 / 100) * round($total_payount,2);
        $processing = (5 / 100) * round($total_payount,2);
		$payable= $total_payount - ($tds+$processing);
		*/ 
		
	$tax = ($con['total_amount']*12)/100;
	$tdss = $tax/2;
	$total_tds += $con['tax']+0;
	$total_amt += $con['total_amount'];
	echo '<tr><td>'.$i.'</td><td>'.$con['f_name'].' '.$con['l_name'].' ('.$con['customer_id'].')</td><td>'.round($con['total_amount'],2).'</td>
	<td>'.$con['tax'].'</td></td>
	<td>'.$con['pancard'].'</td><td>'.date('d F Y',strtotime($con['o_date'])).'</td>';

?>
	

		<?php echo '</tr>';
$i++;
}
?>

</tbody> 

<tr style="height:40px;background-color:#a72522;color:#fff;"> 
	<td colspan="2"><center><b>Total GST Amount</b></center> </td>
	<td><?php echo $total_amt; ?></td>
	<td colspan="4"><?php echo $total_tds; ?></td>
	
</tr>

</table>
</div>

</form>

 <?php echo form_close(); ?>