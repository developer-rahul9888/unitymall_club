 <div class="col-sm-2 side-bar">
 <ul>
 <?php if($this->session->userdata('role')!='5'){?>
  <li class="dropdown"><a href="<?php echo base_url();?>admin/customer">Distributor</a></li>
  <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/pin">Pins</a></li>
  <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/pin/edit">Transfer Pins</a></li>
  <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/product">Product</a></li>
  <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/sale">Sale</a></li>
 <?php } ?>
 
 <?php if($this->session->userdata('role')=='5'){ ?>
 
			<li class="dropdown"><a href="<?php echo base_url();?>admin/customer">Distributor</a></li>
			<li class="dropdown"> <a class="" href="<?php echo base_url();?>admin/distributor_login">Distributor Login</a></li>
			
			<li class="dropdown "> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"> Wallet &nbsp;<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="dropdown-menu">
					<li>  <a class="" href="<?php echo base_url();?>admin/wallet/add">Update Wallet</a></li>
					<li>  <a class="" href="<?php echo base_url();?>admin/wallet/history">Wallet History</a></li>
					<li>  <a class="" href="<?php echo base_url();?>admin/wallet_request_list">Wallet Request</a></li>
                </ul>
			</li>
			<li> <a href="<?php echo base_url();?>admin/redeam">Redeem Request</a></li>
			
			<!-- <li class="dropdown "> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"> Closing Income  &nbsp;<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="dropdown-menu">
					 
				   <li>  <a class="" href="<?php echo base_url();?>admin/monthly-closing">Monthly Closing</a></li>
				   <li>  <a class="" href="<?php echo base_url();?>admin/payouts">Payout</a></li>
				   <li>  <a class="" href="<?php echo base_url();?>admin/bank-process">Bank Process</a></li>
				   <li>  <a class="" href="<?php echo base_url();?>admin/bank-statement">Bank Statement</a></li>
				   <li>  <a class="" href="<?php echo base_url();?>admin/daily-weekly-income">Daily Income</a></li>
					
                </ul>
			</li> -->
			 
			<!--<li class="dropdown "> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"> Franchise  &nbsp;<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="dropdown-menu">
					<!--<li>  <a class="" href="<?php echo base_url();?>admin/franchise_list">Franchise List</a></li-->
					<!--<li>  <a class="" href="<?php echo base_url();?>admin/sale/franchise_stock">Transfer Stock</a></li>
					<li>  <a class="" href="<?php echo base_url();?>admin/sale/send_stock_qty">Franchise Stock List</a></li>
                </ul>
			</li>-->
			
			
		
			
			<li class="dropdown "> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"> Products  &nbsp;<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="dropdown-menu">
					 <!-- <li>  <a class="" href="<?php echo base_url();?>admin/e_product">E-commerce</a></li> -->
					<li>  <a href="<?php echo base_url();?>admin/f_product">E-Voucher</a></li>
					<!-- <li>  <a href="<?php echo base_url();?>admin/voucher-codes">E-Voucher Codes</a></li> -->
                </ul>
			</li>

			<li class="dropdown "> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"> Voucher  &nbsp;<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="dropdown-menu">
					<li>  <a href="<?php echo base_url();?>admin/f_product">E-Voucher</a></li>
					<li>  <a href="<?php echo base_url();?>admin/voucher-brands">E-Voucher Generate</a></li>
					<li>  <a href="<?php echo base_url();?>admin/voucher/history">Generated History</a></li>
                </ul>
			</li>
			 <li>  <a class="" href="<?php echo base_url();?>admin/activity_log">Activity Log</a></li>
			<li class="dropdown "> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"> KYC  &nbsp;<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="dropdown-menu">
					 <li>  <a class="" href="<?php echo base_url();?>admin/docverification">KYC Verification</a></li> 
					<li>  <a class="" href="<?php echo base_url();?>admin/doc_list">Kyc Approvaled List</a></li> 
                </ul>
			</li>
			
			<li class="dropdown "> 
                <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"> Order  &nbsp;<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="dropdown-menu">
					 <li>  <a class="" href="<?php echo base_url();?>admin/order">E-commerce </a></li> 
					<li>  <a class="" href="<?php echo base_url();?>admin/voucher_order">Voucher</a></li> 
                </ul>
			</li>
			
			
			
			
			
			
			
			
			
			
			
			<!-- <li>  <a class="" href="<?php echo base_url();?>admin/product"> Admin Product </a></li> -->
			  
			   <li>  <a class="" href="<?php echo base_url();?>admin/webstores">Webstores</a></li>
			   <li>  <a class="" href="<?php echo base_url();?>admin/w_product">Webstores Product</a></li>
			   <li>  <a class="" href="<?php echo base_url();?>admin/merchant">Merchant List</a></li>
			   
			   <li>  <a class="" href="<?php echo base_url();?>admin/m_product">Merchant Product</a></li>
			     
			   <!-- <li>  <a class="" href="<?php echo base_url();?>admin/purchased_voucher">Purchased Voucher</a></li> -->
			  <li>  <a class="" href="<?php echo base_url();?>admin/tds_report">TDS Report</a></li>
   <li>  <a class="" href="<?php echo base_url();?>admin/gst_report">GST Report</a></li>
			<!--<li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/company_turnover_distribution">Turnover Distribution</a></li>
    <li class="dropdown"> <a class="" href="<?php echo base_url();?>admin/bonanza_list">Bonanza</a></li>
 <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/reward">Reward</a></li>-->
 
 
 
 <!-- <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/achiever">Achievers</a></li> -->
 <!--  
 <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/sale">Product Invoice</a></li>-->
  
 
 <!--<li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/package">Generate Package</a></li>

  <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/pin">Pins</a></li>
  <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/pin/edit">Transfer Pins</a></li>
  <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/sale">Manage Sale</a></li>
  <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/popup">Popup Image</a></li> 
  <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/product">Product</a></li>-->
  
 
  
   <!--<li class="dropdown"><a class="" href="<?php echo base_url();?>admin/sale/send_stock_qty">Franchise List</a></li> -->   
  
   <!-- <li class="dropdown hide"> 
                     <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"> Turnover &nbsp;<i class="fa fa-angle-down"></i></a>
                    <ul role="menu" class="dropdown-menu">
					<li><a href="<?php echo base_url();?>admin/company_turnover_distribution">Turnover Distribution</a></li>
                       
                        <li><a href="<?php echo base_url();?>admin/field_expense_distribution">Field Expense Distribution</a></li>
                    </ul>
                </li> 
				 <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/reward">Reward</a></li>
 <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/setting">Setting</a></li>
 <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/admin_report">Admin Report</a></li>
 <li class="dropdown">  <a class="" href="<?php echo base_url();?>admin/pin_sale">Pin Sale</a></li>
 -->
  

 
   
   
  

 <?php } ?> 
 </ul>
 </div>
 <!--side bar close -->