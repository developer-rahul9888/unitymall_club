
<div class="page-heading">
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/customer/add'; ?>">Add New</a--> 
        <h2>Daily/Weekly Cut Off Report</h2> 
      </div>
	  
	  <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/cut-off-report');
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
	  //print_r($restaurants);
      ?>
  <div class="clearfix"></div>
  <p class="text-center">Plaza Jewellers Daily/Weekly Cut Off Report of <strong><?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate').'</strong> to <strong>'.$this->input->post('edate'); } else { echo date('m/d/Y'); }  ?></strong></p>
  <div class="clearfix"></div>
	 
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table text-center"> 
<thead> <tr> <th class="text-center">Sr.</th><th class="text-center">Distributor</th><th class="text-center">Date</th><th class="text-center">Cut Off PV</th><th class="text-center">Cut Off RPV</th></tr> </thead> 
<tbody> 
<?php 
$i = 1;
	$total_pv = $total_rpv = 0;
if(!empty($cut_off_report)) { 
		$userWise = array();
		foreach($cut_off_report as $val){
		  if($val['type']!='First cut off') {
			$sub_pv = $sub_rpv = 0;
			if($val['sale_type']=='1') { $total_pv = $total_pv + $val['amount']; $sub_pv = $val['amount']; }
			if($val['sale_type']=='2') { $total_rpv = $total_rpv + $val['amount']; $sub_rpv = $val['amount']; }
			
			$datekey = date('Ymd',strtotime($val['pay_date']));
			$useridkey = $val['user_id'].$datekey;
			if (array_key_exists($useridkey,$userWise)) {
				$userWise[$useridkey]['pv'] = $userWise[$useridkey]['pv'] + $sub_pv;
				$userWise[$useridkey]['rpv'] = $userWise[$useridkey]['rpv'] + $sub_rpv;
			} else {
				$dates = date('d F Y',strtotime($val['pay_date']));
				$userWise[$useridkey] = array('date'=>$dates,'name'=>$val['f_name'].' '.$val['l_name'].' ('.$val['customer_id'].')','pv'=>$sub_pv,'rpv'=>$sub_rpv);
			}
		  }
		}
		if(!empty($userWise)) {
			foreach($userWise as $val) {
				echo '<tr><td>'.$i.'</td><td>'.$val['name'].'</td><td>'.$val['date'].'</td><td>'.$val['pv'].'</td><td>'.$val['rpv'].'</td></tr>';
				$i++;
			}
		} else { echo '<tr><td colspan="5">No records found.</td></tr>'; }
	 
}
else { echo '<tr><td colspan="5">No records found.</td></tr>'; }
?>
</tbody> 
<!--tr><td></td><td></td><td></td></tr-->
 <tfoot>
 
    <tr> 
	  <td></td><td></td><td class="text-center"><b>Total</b></td>
      <td class="text-center"><b><?php echo $total_pv;?></b></td>  
      <td class="text-center"><b><?php echo $total_rpv;?></b></td>  
    </tr>
   
  </tfoot>
</table>
</div>

 
