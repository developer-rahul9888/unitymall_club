 
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
      
      echo form_open(base_url('admin/bank-statement'),$attributes);
      ?>
	  
	  <div class="col-sm-12">
		<div class="form-group col-sm-4">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
	  </div>
	<div class="form-group col-sm-4">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		  </div>
		  
	
		  <div class="form-group col-sm-4">
		
		  <input type="submit" name="submit" class="btn btn-primary" value="Search" style="display:block"> 
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
  <p class="text-center"> Bank statement Report of <strong><?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate').'</strong> to <strong>'.$this->input->post('edate'); } else { echo date('m/01/Y').' to '.date('m/t/Y'); }  ?></strong></p>
  <div class="clearfix"></div>
	 
	  <div class="table-responsive">
	      <table class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>S. No.</th><th>Total Amount </th><th>Admin</th><th>TDS </th><th>Payout Amount </th><th>Transaction ID</th><th>Date</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
$total_amt = $total_tds = $total_admin = $total_payble=0;
/* echo "<pre>";
print_r($payouts);
echo "</pre>"; */
foreach($bank_statement as $con){ 
    $date = date('d M Y',strtotime($con['rdate']));
	$tds =$con['tds'];
	$payable = $con['net_income'];
	$payable = round($payable,2);
	$checked = $class = '';
	if($payable > 99 && $con['bank_name']!='' && $con['account_no']!='' && $con['ifsc']!='' && $con['pancard']!='') { $checked = 'checked="checked"';  }
 
	
	echo '<tr '.$class.'><td>'.$i.'</td><td>'.$con['amount'].'</td><td>'.$con['admin'].'</td><td>'.$con['tds'].'</td><td>'.$con['net_income'].'</td><td>'.$con['bank_tran'].'</td><td>'.$date.'</td>';

?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
		<?php echo '</tr>';
		$total_amt = $total_amt + $con['amount'];
		$total_tds = $total_tds + $tds;
		$total_admin = $total_admin + $con['admin'];
		$total_payble = $total_payble + $payable;
$i++;
}


?>
<tr> <th>Total</th><th><?php echo $total_amt; ?> </th><th><?php echo $total_admin; ?> </th><th><?php echo $total_tds; ?> </th><th><?php echo $total_payble; ?> </th><th>Transaction ID</th><th>Date</th></tr>
</tbody> 
</table>
</div>
</div>
 
