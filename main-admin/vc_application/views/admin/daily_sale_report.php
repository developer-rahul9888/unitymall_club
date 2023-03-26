
<div class="page-heading">
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/customer/add'; ?>">Add New</a--> 
        <h2>Daily Sale Report</h2> 
      </div>
	   <div class="form-group col-sm-3"> 
		   <?php echo form_open(base_url().'index.php/vc_site_admin/sale/generatecsvfile'); ?> 
		   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
		    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		    
		    	<label>&nbsp;</label>
		   <input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">
		   
		   <?php echo form_close(); ?>
		  </div>
	  <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/daily-sale-report');
      ?>
	  
	  
	   <div class="col-sm-12">
	  
      
  
 
  
	  
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
	<label>PIN :</label>
		    <select name="pin" class="form-control">
		        <option value="all">All</option>
		        <option value="pin" <?php if($this->input->post('pin')=='pin') { echo 'selected="selected"'; }?>>PIN</option>
		        <option value="repin" <?php if($this->input->post('pin')=='repin') { echo 'selected="selected"'; }?>>Repurchase PIN</option>
		        <option value="franchise" <?php if($this->input->post('pin')=='franchise') { echo 'selected="selected"'; }?>>Franchise PIN</option>
		    </select> 
		  </div>
		  
	
		  <div class="form-group col-sm-3">
		  <label>&nbsp;<br></label>
		  <input type="submit" style="display:block" name="submit" class="btn btn-primary" value="Search"> 
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
  <p class="text-center"> Daily/Weekly Income Report of <strong><?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate').'</strong> to <strong>'.$this->input->post('edate'); } else { echo date('m/d/Y'); }  ?></strong></p>
  <div class="clearfix"></div>
	 
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table text-center"> 
<thead> <tr> <th class="text-center">Sr.</th><th class="text-center">Used By</th><th class="text-center">Date</th><th class="text-center">PIN</th><th class="text-center">Amount</th><th class="text-center">Bv</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
	$tamount=0;
	$total_bv=0;
if(!empty($daily_weakly_pin)) {
	/*if($this->input->post('sdate')!='') { 
		$userWise = array();
		foreach($daily_weakly_pin as $val){
			$amount = $val['amount']; 
			$tamount = $tamount + $val['amount']; 
			$userid = $val['user_id'];
			if (array_key_exists($userid,$userWise)) {
				$userWise[$userid]['amount'] = $userWise[$userid]['amount'] + $amount;
			} else {
				$dates = date('d F Y',strtotime($val['rdate']));
				$userWise[$userid] = array('date'=>$dates,'name'=>$val['f_name'].' '.$val['l_name'].' ('.$val['customer_id'].')','amount'=>$amount);
			}
		}
		if(!empty($userWise)) {
			foreach($userWise as $val) {
				echo '<tr><td>'.$i.'</td><td>'.$val['name'].'</td><td>'.$val['date'].'</td><td>'.$val['amount'].'</td></tr>';
				$i++;
			}
		}
	}*/
	//else {
	  foreach($daily_weakly_pin as $val){
		$amount = $val['p_amount']; 
		$bv = $val['b_volume']; 
			
		$tamount = $tamount + $val['p_amount']; 
		$total_bv = $total_bv + $bv;
	 
		$date = date('d F Y',strtotime($val['used_on']));
		if($amount > 0) {
			echo '<tr><td>'.$i.'</td><td>'.$val['f_name'].' '.$val['l_name'].' ('.$val['customer_id'].')</td><td>'.$date.'</td><td>'.$val['pinid'].'</td><td>Rs. '.$amount.'</td><td>'.$bv.'</td></tr>';
			$i++;
		}
	  }
	//}
}
else { echo '<tr><td colspan="5">No records found.</td></tr>'; }
?>
</tbody> 
<!--tr><td></td><td></td><td></td></tr-->
 <tfoot>
    <tr> 
	  <td></td><td></td><td></td><td class="text-center"><b>Total</b></td>
      <td class="text-center"><b>Rs. <?php echo $tamount;?></b></td>
      <td class="text-center"><b><?php echo $total_bv;?></b></td>
     
    </tr>
    <!--tr> 
	  <td></td><td></td><td class="text-center"><b>TDS 5%</b></td>
      <td class="text-center"><b>Rs. <?php /*
	  $tds = (5 / 100) * $tamount;
	  $tds = round($tds,2);
	  echo $tds;*/ ?></b></td>
    </tr>
    <tr> 
	  <td></td><td></td><td class="text-center"><b>Admin Charge 5%</b></td>
      <td class="text-center"><b>Rs. <?php /*
	  $admin_charge = (5 / 100) * $tamount;
	  $admin_charge = round($admin_charge,2);
	  echo $admin_charge;*/ ?></b></td>
    </tr>
    <tr> 
	  <td></td><td></td><td class="text-center"><b>Payable Income</b></td>
      <td class="text-center"><b>Rs. <?php /*
	  $payable = $tamount - $tds - $admin_charge;
	  $payable = round($payable,2);
	  echo $payable;*/ ?></b></td>
    </tr-->
  </tfoot>
</table>
</div>

 
