 
 <?php //$this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
 
 
 <div class="col-sm-12">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin/income');?>">Back</a> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin/income/franchisee-income');?>" style="margin-right:10px;">All Franchisee Income</a>
        <h2><?php echo $page_title;?></h2>
      </div>
	 

<?php 
$i = 1;
$all_tr = '';
$pin_income = $pin_diff_income = $pin_refferal = 0;
$url = $this->uri->segment(3);
$url_type = $this->uri->segment(4);
if(!empty($income)) {
	$tamount=0;
	foreach($income as $val){ //print_r($val);
	  $show = 'true';
	  if($url_type=='pin' && $val['type']!='Franchies Income') { $show = 'false'; }
	  elseif($url_type=='difference' && $val['type']!='Franchies PIN Difference Income') { $show = 'false'; }
	  elseif($url_type=='referral' && $val['type']!='Franchies Referral') { $show = 'false'; }
	  if($show=='true'){
		$amount = $val['amount']; 
		$tamount = $tamount + $val['amount']; 
		$date = date('d F Y',strtotime($val['rdate']));
		$pincode = $pinamt = $pin_usedby = $userfrom = '';
		if(strstr($val['description'],'---')) {
			$disid = explode('---',$val['description']);
			$pincode = $disid[0];
			$pinamt = $disid[1];
			$userfrom = $disid[2];
			$pin_usedby = $disid[3]. ' ('.$disid[4].')';
		}
	 
		if($amount > 0) {
			$all_tr .= '<tr><td>'.$i.'</td><td>'.$pincode.'</td><td>'.$pinamt.'</td><td>Rs. '.$amount.'</td><td>'.$pin_usedby.'</td><td>'.$date.'</td><td>';
			if($val['type']=='Franchies Income') { $all_tr .= 'PIN Income'; } else { $all_tr .= $val['type']; }
		    $all_tr .= 	'</td></tr>';
			$i++;
		}
		
	  }
		if($val['type']=='Franchies Income') { $pin_income = $pin_income + $val['amount']; }
		if($val['type']=='Franchies PIN Difference Income') { $pin_diff_income = $pin_diff_income + $val['amount']; }
		if($val['type']=='Franchies Referral') { $pin_refferal = $pin_refferal + $val['amount']; }
	}
}
else { $all_tr .= '<tr><td colspan="7">No records found.</td></tr>'; }
?>
	 
<div class="col-sm-4"><a href="<?php echo base_url('admin/income/franchisee-income/pin');?>">
<div class="bz"><h2>PIN income</h2>
<p><img src="<?php echo base_url();?>assets/images/franchisee.png"/><span>Rs.<?php echo $pin_income;?></span></p>
</div></a>
</div>
<div class="col-sm-4"><a href="<?php echo base_url('admin/income/franchisee-income/difference');?>">
<div class="bz"><h2>PIN Difference income</h2>
<p><img src="<?php echo base_url();?>assets/images/franchisee.png"/><span>Rs.<?php echo $pin_diff_income;?></span></p>
</div></a>
</div>
<div class="col-sm-4"><a href="<?php echo base_url('admin/income/franchisee-income/referral');?>">
<div class="bz"><h2>Franchise Referral</h2>
<p><img src="<?php echo base_url();?>assets/images/franchisee.png"/><span>Rs.<?php echo $pin_refferal;?></span></p>
</div></a>
</div>
  
	 
	  
	&nbsp;  
	  
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table text-center"> 
<thead> <tr> <th class="text-center">Sr.</th><th class="text-center">PIN</th><th class="text-center">PIN Amount</th><th class="text-center">PIN Income</th><th class="text-center">Used By</th><th class="text-center">Date</th><th class="text-center">Income Type</th>
</tr> </thead> 
<tbody> 
<?php echo $all_tr; ?>
</tbody> 
<!--tr><td></td><td></td><td></td></tr-->
 <tfoot>
 
    <tr> 
    <td class="text-center"></td><td class="text-center"></td>
	 <td class="text-center"><b>TOTAL INCOME</b></td>
      <td class="text-center"><b>Rs. <?php if(!empty($income)) { echo $tamount; } else { echo "0";}?></b></td>
	  <td></td> <td></td> <td></td>
    </tr>
  </tfoot>
</table>
</div>
</div>
 