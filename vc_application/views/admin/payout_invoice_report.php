 
 <?php //$this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
 
 
 <div class="col-sm-12">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin');?>">Back</a>
        <h2><?php echo $page_title;?></h2>
      </div>
	  
	  <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/payout-invoice-report');
      ?>
	  
	  <div class="col-sm-12">
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
	  </div>
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		  </div>
		  
	
		  <div class="form-group col-sm-3">
		  <label>&nbsp;<br></label>
		  <input type="submit" name="submit" class="btn btn-primary" value="Search" style="display:block;"> 
		  </div>
</div> 
&nbsp;

 <?php echo form_close(); ?>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> order updated with success.';
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
  <div class="clearfix"></div>
  <p class="text-center">FDN Marketing Pvt. Ltd.  Payout Invoice Report of <strong><?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate').'</strong> to <strong>'.$this->input->post('edate'); } else { echo date('m/d/Y'); }  ?></strong></p>
  <div class="clearfix"></div>
	 
	  <div class="table-responsive">
   <table class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>S. No.</th><th>Amount</th><th>TDS 5%</th><th>Admin 5%</th><th>Payable</th><th>Date</th><th>Status</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;

/* echo "<pre>";
print_r($payouts);
echo "</pre>"; */
foreach($payout_invoice_report as $con){ 
    $date = date('d M Y',strtotime($con['rdate']));
	$tds = (5 / 100) * $con['amount'];
	$payable = $con['amount'] - $tds - $tds;
	$payable = round($payable,2);
	$checked = $class = '';
	if($payable > 99 && $con['bank_name']!='' && $con['account_no']!='' && $con['ifsc']!='' && $con['pancard']!='') { $checked = 'checked="checked"';  }
 
	
	echo '<tr '.$class.'><td>'.$i.'</td>
	<td>Rs. '.$con['amount'].'</td><td>Rs. '.$tds.'</td><td>Rs. '.$tds.'</td><td>Rs. '.$payable.'</td><td>'.$date.'</td><td>'.$con['status'].'</td>';

?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</div>
 
