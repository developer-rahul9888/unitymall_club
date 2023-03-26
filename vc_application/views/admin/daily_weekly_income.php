 
 <?php //$this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
 <style type="text/css">
 	.table {
      background-color: #a0a0cc;
}
 </style>

 <div class="col-sm-12">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin/income');?>">Back</a>
        <h2><?php echo $page_title;?></h2>
      </div>
	  
	  <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/daily-weekly-income');
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
		  
	
		  <div class="form-group col-sm-3 butn">
		  <label>&nbsp;<br><br></label>
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
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
	 // print_r($daily_weakly_in);
      ?>
  <div class="clearfix"></div>
  <div class="col-sm-12">
		

			<div class="clearfix"></div>
  <div class="clearfix"></div>
	 
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table text-center"> 
<thead> <tr> <th class="text-center">Sr.</th><th class="text-center">Income Type</th><!-- <th class="text-center">Date</th> --><th class="text-center">Amount</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
	$tamount=0;
if(!empty($daily_weakly_in)) {
	if($this->input->post('sdate')!='') { 
		$dateWise = array();
		  foreach($daily_weakly_in as $val){
		$amount = round($val['amount'],2); 
		$tamount = $tamount + $val['amount']; 
		$date = date('d F Y',strtotime($val['c_date']));
		if($amount > 0) {
			echo '<tr><td>'.$i.'</td><td>';
			if($val['type']=='Purchase') { echo 'Matching'; }
			else { echo $val['type']; } 
			echo '</td><td>Rs. '.$amount.'</td></tr>';
			$i++;
		}
	  }
		if(!empty($dateWise)) {
			foreach($dateWise as $val) {
				echo '<tr><td>'.$i.'</td><td>Date Wise</td><td>'.$val['date'].'</td><td>'.$val['amount'].'</td></tr>';
				$i++;
			}
		}
	}
	else {
	  foreach($daily_weakly_in as $val){
		$amount = round($val['amount'],2); 
		$tamount = $tamount + $val['amount']; 
		$date = date('d F Y',strtotime($val['c_date']));
		if($amount > 0) {
			echo '<tr><td>'.$i.'</td><td>';
			if($val['type']=='Purchase') { echo 'Matching'; }
			else { echo $val['type']; } 
			echo '</td><td>Rs. '.$amount.'</td></tr>';
			$i++;
		}
	  }
	}
}
else { echo '<tr><td colspan="3">No records found.</td></tr>'; }
?>
</tbody> 
<!--tr><td></td><td></td><td></td></tr-->
 <tfoot>
 
    <tr> 
	  <td colspan="2" class="text-center"><b>Total</b></td>
      <td class="text-center"><b>Rs. <?php echo round($tamount,2);?></b></td>
    </tr>

  </tfoot>
</table>
</div>
</div>
 
