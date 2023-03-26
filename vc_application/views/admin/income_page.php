 <?php //$this->load->view('includes/admin/sidebar'); 
	?>
 <!-- /.mainbar -->

<style>
.redirect {
	position: absolute;
    bottom: 25px;
    right: 15px;
    background-color: red !important;
    padding: 5px 10px;
    color: white;
    border-radius: 0px 14px 0px;
}
</style>

 <?php
	$travel_fund = $car_fund = $house_fund = $crown = 0;

	if (!empty($fund)) {
		foreach ($fund as $val) {
			if ($val['type'] == 'Travel') {
				$travel_fund = $travel_fund + $val['amount'];
			}
			if ($val['type'] == 'Car') {
				$car_fund = $car_fund + $val['amount'];
			}
			if ($val['type'] == 'House') {
				$house_fund = $house_fund + $val['amount'];
			}
			if ($val['type'] == 'crown embaster royalti') {
				$crown = $crown + $val['amount'];
			}
		}
	}
	$level_income = $voucher = $direct_income = $upgrade_income =  $depth_income = $cashback =  0;
	//echo '<pre>'; print_r($total_incomes); die();
	if (!empty($total_incomes)) {
		foreach ($total_incomes as $val) {
			if ($val['type'] == 'Level Income') {
				$level_income = $level_income + $val['tamount'];
			}
			if ($val['type'] == 'Direct Income') {
				$direct_income = $direct_income + $val['tamount'];
			}
			if ($val['type'] == 'Upgrade Income') {
				$upgrade_income = $upgrade_income + $val['tamount'];
			}
			if ($val['type'] == 'Depth Income') {
				$depth_income = $depth_income + $val['tamount'];
			}
			if ($val['type'] == 'Voucher') {
				$voucher = $voucher + $val['tamount'];
			}
			if ($val['type'] == 'Cashback') {
				$cashback = $cashback + $val['tamount'];
			}
		}
	}

	$total_income = $level_income;
	//print_r($total_incomes);

	?>



 <div class="col-sm-12">
 	<div class="page-heading">

 		<h2>My Earnings</h2>
 	</div>



 	<div class="clearfix"></div>

 	<div class="right-bar" style="height:auto; overflow:hidden;">
 		<h2 class="text-center top-bdr"><span>Income</span></h2>


 		<div class="col-sm-4">
			<a href="<?php echo base_url(); ?>admin/history/reward_point">
 			<div class="bz fdnn">
 				<h2>Shopping Reward Points</h2>
 				<p><img src="<?php echo base_url(); ?>assets/images/franchisee.png" />
 					<span>Rs <?php echo $profile[0]['reward_wallet'] + 0;  ?></span>
 				</p>
 			</div>
 		</a>
 		</div>


 		<div class="col-sm-4">
 			
 			<div class="bz fdnn">
			 <a href="<?php echo base_url(); ?>admin/income/cashback">
 				<h2>Cashback</h2>

 				<p><img src="<?php echo base_url(); ?>assets/images/repurwallet.png" />
 					<span>Rs <?php echo $cashback + 0;  ?></span>
 				</p>
			</a>
 			</div>
 		
 		</div>

 		<div class="col-sm-4">
 			
 			<div class="bz fdnn">
			 	<a href="<?php echo base_url(); ?>admin/history/point">
 				<h2>Coins </h2>
 				<p class="wall-cnt">
 					<img src="<?php echo base_url(); ?>assets/images/franchisee.png" />
 					<span> <?php echo $profile[0]['points'];  ?></span>
					 
 				</p>
				 </a>
				<a href="<?php echo base_url(); ?>admin/convert-coin">
				 	<p class="redirect">Convert Now</p>
				</a>
 			</div>
 			
 		</div>

 		<div class="col-sm-4">
 			<div class="bz fdnn">
 				<a href="<?php echo base_url(); ?>admin/income/level-income">
 					<h2>Active Shoppers Club</h2>
 					<a href="<?php echo base_url(); ?>admin/income/level-income">
 						<p class="wall-cnt">
 							<p>
 								<img src="<?php echo base_url(); ?>assets/images/repurchase1.png" />
 								<span>Rs <?php echo $level_income + 0; ?></span>
 							</p>
 					</a>
 			</div>
 		</div>

 		<div class="col-sm-4">
 			<div class="bz fdnn">
 				<a href="<?php echo base_url(); ?>admin/income/upgrade-income">
 					<h2>Gift Your Voucher Club</h2>
 					<a href="<?php echo base_url(); ?>admin/income/upgrade-income">
 						<p class="wall-cnt">
 							<p>
 								<img src="<?php echo base_url(); ?>assets/images/franchisee.png" />
 								<span>Coins <?php echo $upgrade_income; ?></span>
 							</p>
 					</a>
 			</div>
 		</div>












 		<!--<div class="col-sm-4">
	<div class="bz fdnn">
		<a href="<?php echo base_url(); ?>admin/income/team-performance-income">
			<h2>Team Performance Bonus</h2>
			<p class="wall-cnt">
				<img src="<?php echo base_url(); ?>assets/images/repurchase12.png"/>
				<span>Rs. <?php echo round($team_bonus[0]['amount'], 2) + 0;  ?></span>
			</p>
		</a>   
	</div>
</div>-->


 		<!-- <div class="col-sm-4">
<a href="<?php echo base_url(); ?>admin/income/direct-income">
<div class="bz fdnn">
<h2>Direct Income</h2>
<a href="<?php echo base_url(); ?>admin/income/direct-income"><p class="wall-cnt">
<p><img src="<?php echo base_url(); ?>assets/images/franchisee.png"/>
<span>Rs. <?php echo $direct_income;  ?></span> 
</p>
</div>
</a>
</div>

<div class="col-sm-4">
<a href="<?php echo base_url(); ?>admin/income/depth-income">
<div class="bz fdnn">
<h2>Depth Income</h2>
<a href="<?php echo base_url(); ?>admin/income/depth-income"><p class="wall-cnt">
<p><img src="<?php echo base_url(); ?>assets/images/franchisee.png"/>
<span>Rs. <?php echo $depth_income;  ?></span> 
</p>
</div>
</a>
</div> -->







 		<div class="col-sm-4">

 			<div class="bz fdnn">
 				<h2>My Total Earnings</h2>
 				<p>
 					<img src="<?php echo base_url(); ?>assets/images/wallet.png" />
 					<span>Rs <?php echo  $total_income;  ?></span>
 				</p>
 			</div>
 			</a>
 		</div>



 		<div class="col-sm-4">
 			<div class="bz fdnn">
 				<!-- <a href="<?php echo base_url(); ?>admin/history/main_wallet"> -->
 				<h2> Main Wallet </h2>
 				<p class="wall-cnt">
 					<img src="<?php echo base_url(); ?>assets/images/repurwallet.png" />
 					<span>Rs <?php echo $profile[0]['bliss_amount'];  ?></span>
 				</p>
 			<!-- </a> -->
 			</div>

 		</div>

 		<div class="col-sm-4">
 			<div class="bz fdnn">
			 <a href="<?php echo base_url(); ?>admin/Payment_request">
 				<h2> Redeem Request </h2>
 				<p class="wall-cnt">
 					<img src="<?php echo base_url(); ?>assets/images/tt.png" />
 					<span> Redeem Request </span>
 				</p>
			 </a>
 			</div>

 		</div>

		
		 <div class="col-sm-4">
 			<div class="bz fdnn">
 				<a href="<?php echo base_url(); ?>admin/hold/income">
					<h2> Hold Gift Your Voucher Club </h2>
					<p class="wall-cnt">
						<img src="<?php echo base_url(); ?>assets/images/repurwallet.png" />
						<span>Coins <?php echo $totalHoldIncome->amount + 0;  ?></span>
					</p>
 				</a>
 			</div>

 		</div>



 		<div class="col-sm-4 hide">
 			<a href="#">
 			</a>
 			<div class="bz fdnn"><a href="#">
 					<h2>Travel Bonus</h2>
 				</a><a href="#">
 					<p class="wall-cnt">
 						<img src="<?php echo base_url(); ?>assets/images/travel.png">
 					</p>
 					<p class="jj">Rs. 0</p>
 					<p></p>
 				</a>
 			</div>
 		</div>

 		<div class="clearfix"></div>
 	</div>
 </div>