 
 <?php //$this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
 
 <?php
$achived = $redeemed = $left_PV = $right_PV = $t_left_PV = $t_right_PV = $matching = 0;
$left_rPV = $right_rPV = $t_left_rPV = $t_right_rPV = $rmatching = 0;
if(!empty($bliss_amount)) {
	foreach($bliss_amount as $val) {
	  if($val['sale_type']=='1') {
		if($val['type']=='Matching') { $matching = $matching + $val['amount']; }
		if($val['status']=='Redeem') { $redeemed = $redeemed + $val['amount']; }
		if($val['status']=='Active' && $val['type']=='PV right') { $right_PV = $right_PV + $val['amount']; }
		if($val['status']=='Active' && $val['type']=='PV left') { $left_PV = $left_PV + $val['amount']; }
		if($val['type']=='PV right' && $val['user_id_send_by']!='0') { $t_right_PV = $t_right_PV + $val['amount']; }
		if($val['type']=='PV left' && $val['user_id_send_by']!='0') { $t_left_PV = $t_left_PV + $val['amount']; }
	  } else {
		if($val['type']=='Matching') { $rmatching = $rmatching + $val['amount']; } 
		if($val['status']=='Active' && $val['type']=='PV right') { $right_rPV = $right_rPV + $val['amount']; }
		if($val['status']=='Active' && $val['type']=='PV left') { $left_rPV = $left_rPV + $val['amount']; }  
		if($val['type']=='PV right' && $val['user_id_send_by']!='0') { $t_right_rPV = $t_right_rPV + $val['amount']; }
		if($val['type']=='PV left' && $val['user_id_send_by']!='0') { $t_left_rPV = $t_left_rPV + $val['amount']; }  
	  }
	}
} 


$matching_income = $leader_income = $recognise_income = $repurchase_income =$Direct_income = $franch_income = 0;
if(!empty($total_incomes)) {
	foreach($total_incomes as $val) {
		if($val['type']=='Purchase') { $matching_income = $matching_income + $val['tamount']; } 
		if($val['type']=='Direct') { $Direct_income = $Direct_income + $val['tamount']; }  
		if($val['type']=='Repurchase') { $repurchase_income = $repurchase_income + $val['tamount']; } 
		if($val['type']=='Recognise Income') { $recognise_income = $recognise_income + $val['tamount']; } 
		if($val['type']=='Franchies Income' || $val['type']=='Franchies Referral' || $val['type']=='Franchies PIN Difference Income' ) {
			$franch_income = $franch_income + $val['tamount']; } 
	}
} 
?>

 <div class="col-sm-12">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin');?>">Back</a>
        <h2>Income page</h2>
      </div>
<p>&nbsp;</p>
<div class="clearfix"></div>

<div class="right-bar" style="height:auto; overflow:hidden;">
<h2 class="text-center top-bdr" ><span>Incomes</span></h2>

<div class="col-sm-4">
<a href="<?php echo base_url();?>admin/income/direct-income">
<div class="bz">
<h2>Direct Income</h2>
<p><img src="<?php echo base_url();?>assets/images/franchisee.png"/>
<span>Rs.<?php echo $Direct_income; ?></span>
</p>
</div>
</a>
</div>

<div class="col-sm-4">
<a href="<?php echo base_url();?>admin/income/matching-income">
<div class="bz">
<h2>Matching Bonus</h2>
<p>
<img src="<?php echo base_url();?>assets/images/match.png"/>
<span>Rs.<?php echo $matching_income;?></span></p>
</div>
</a>
</div>


<div class="col-sm-4">
<a href="<?php echo base_url();?>admin/daily-weekly-income">
<div class="bz">
<h2>Cashback</h2>
<p><img src="<?php echo base_url();?>assets/images/vprofile4.png"/>
<span>Rs.0</span>
</p>
</div>
</a>
</div>

<div class="col-sm-4">
<a href="">
<div class="bz">
<h2>Car Fund</h2>
<a href="#"><p class="wall-cnt">
<img src="<?php echo base_url();?>assets/images/car.png"/>
<p class="jj">0</p>
</p></a>
</div>
</a>
</div>

<div class="col-sm-4">
<a href="">
<div class="bz">
<h2>House Fund</h2>
<a href="#"><p class="wall-cnt">
<img src="<?php echo base_url();?>assets/images/house.png"/>
<p class="jj">0</p>
</p></a>
</div>
</a>
</div>



<div class="col-sm-4"><a href="<?php echo base_url();?>admin/daily-weekly-income"><div class="bz"><h2>Re-Purchase Matching</h2><p><img src="<?php echo base_url();?>assets/images/repurchase.png"/><span>Rs.0</span></p></div></a></div><div class="col-sm-4"><a href="<?php echo base_url();?>admin/daily-weekly-income"><div class="bz"><h2>Royality Income</h2><p><img src="<?php echo base_url();?>assets/images/royality.png"/><span>Rs.0</span></p></div></a></div><div class="col-sm-4"><a href="<?php echo base_url();?>admin/daily-weekly-income"><div class="bz"><h2>Leadership Bonus</h2><p><img src="<?php echo base_url();?>assets/images/bonus.png"/><span>Rs.0</span></p></div></a></div><div class="col-sm-4"><a href="<?php echo base_url();?>admin/daily-weekly-income"><div class="bz"><h2>Franchise Commision</h2><p><img src="<?php echo base_url();?>assets/images/fr.png"/><span>Rs.0</span></p></div></a></div>
<div class="clearfix"></div>

<h2 class="text-center top-bdr" ><span>Total Income: <?php $total_income = $matching_income + $leader_income + $recognise_income + $repurchase_income + $franch_income;
echo round($total_income,2); ?></span></h2>
<div class="clearfix"></div>
<p>&nbsp;</p>

<h2 class="text-center top-bdr" ><span>PV</span></h2>
<div class="col-sm-4"><div class="bz"><h2>Matching PV: <?php echo $matching;?></h2></div></div>
<div class="col-sm-4"><div class="bz"><h2>Carry Forward Left PV: <?php echo $left_PV;?></h2></div></div>
<div class="col-sm-4"><div class="bz"><h2>Carry Forward Right PV: <?php echo $right_PV;?></h2></div></div>
<div class="clearfix"></div>
<div class="col-sm-4"><div class="bz"><h2>Total</h2></div></div>
<div class="col-sm-4"><div class="bz"><h2>Total Left PV: <?php echo $t_left_PV;?></h2></div></div>
<div class="col-sm-4"><div class="bz"><h2>Total Right PV: <?php echo $t_right_PV;?></h2></div></div>

<div class="clearfix"></div>

<?php 
	  $t_ac_left_user = $t_de_left_user = $t_ac_right_user = $t_de_right_user = 0;
 
if(!empty($myfriends)) { //echo '<pre>'; print_r($myfriends); echo '</pre>';
	$i = 1; 
	foreach($myfriends as $friend) {
	    if($friend['dposition']=='left'){
	        if($friend['user_level'] > 0){ $t_ac_left_user = $t_ac_left_user + 1; }
	        else { $t_de_left_user = $t_de_left_user + 1; }
	    }
	    elseif($friend['dposition']=='right'){
	        if($friend['user_level'] > 0){ $t_ac_right_user = $t_ac_right_user + 1; }
	        else { $t_de_right_user = $t_de_right_user + 1; }
	    }
	}
} ?>
<div class="col-sm-3"><div class="bz"><h2>Active Left: <?php echo $t_ac_left_user;?></h2></div></div>
<div class="col-sm-3"><div class="bz"><h2>Deactive Left: <?php echo $t_de_left_user;?></h2></div></div>
<div class="col-sm-3"><div class="bz"><h2>Active Right: <?php echo $t_ac_right_user;?></h2></div></div>
<div class="col-sm-3"><div class="bz"><h2>Deactive Right: <?php echo $t_de_right_user;?></h2></div></div>


<p>&nbsp;</p>
<div class="clearfix"></div>


 

</div>
</div>
 
