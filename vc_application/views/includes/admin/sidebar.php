<?php $user = $profile[0]; ?>
<!--h2>Welcome <?php echo $user['f_name'].' '.$user['l_name'];?></h2-->
</div>
<div class="col-sm-2 left-bar">
<div class="col-sm-12  col-xs-3 pro-pic text-center ">
<?php 
if($user['gender']=='Female') { $img = base_url().'images/user/female.png'; }
else { $img = base_url().'images/user/31.png'; }
if($user['image'] !='') { echo '<img src="'.base_url().'images/user/'.$user['image'].'" width="100">'; }
else{echo '<img src="'.$img.'" width="100">';} ?>
</div>

<div class="col-sm-12 col-xs-6 protext text-center">
<strong><?php echo $this->session->userdata('full_name');?></strong>
</br>
<span><?php echo $this->session->userdata('bliss_id');?></span>
</br>
<?php 
if($user['user_level']==2) { $rank = 'Active Associate'; }
                 elseif($user['user_level']==3) { $rank = 'Bronze'; }
                 elseif($user['user_level']==4) { $rank = 'Silver'; }
                 elseif($user['user_level']==5) { $rank = 'Gold'; }
                 else { $rank = 'Associate'; }

?>
<span><?php echo $rank;?></span>
</div>

<div class="list-right col-xs-3">
<nav role="navigation" class="navbar navbar-default">
<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="<?php echo base_url();?>distributor"><i class="fa fa-dashboard"></i>   Dashboard</a></li>
<li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i>   Home</a></li>
<li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"><i class="fa fa-user"></i>  Profile<!--<b class="caret"></b>--></a>
                    <ul role="menu" class="dropdown-menu">
                    <li><a href="<?php echo base_url();?>admin/personal_details">My Profile</a></li>
                       
                        <li><a href="<?php echo base_url();?>admin/password">Update Password</a></li>
                    </ul>
                </li>
                 <?php if($user['consume']==0 && 1==2)  {
                  echo '<li><a href="'.base_url().'admin/upgrade_account"><i class="fa fa-key"></i>  Become Active Member</a></li>';
                } ?> 
 

				 <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"><i class="fa fa-user"></i> My Network</a>
                    <ul role="menu" class="dropdown-menu">
                    <li><a href="<?php echo base_url();?>admin/direct_distributor"><i class="fa fa-users"></i>   My Direct Team</a></li>
                    <li><a href="<?php echo base_url();?>admin/downlineall"><i class="fa fa-users"></i>   Referral Network</a></li>
                    <li><a href="<?php echo base_url();?>admin/DistributorLevelInformation"><i class="fa fa-users"></i> Level Information</a></li>
                    </ul>
                </li> 
<!-- <li><a href="<?php echo base_url();?>admin/upgrade_account"><i class="fa fa-users"></i>Activate Account</a></li> -->

<li><a href="<?php echo base_url();?>admin/income"><i class="fa fa-users"></i>My Earnings</a></li> 
<!-- <li><a href="<?php echo base_url();?>admin/payment"><i class="fa fa-file-text-o"></i>Add Fund </a></li> -->
				
				

<!-- <li><a href="<?php echo base_url();?>admin/treeview"><i class="fa fa-users"></i>   Genealogy</a></li> -->




<!-- <li><a href="<?php echo base_url();?>admin/income_report"><i class="fa fa-users"></i>Income Report</a></li> -->
<!-- <li><a href="<?php echo base_url();?>admin/request-wallet"><i class="fa fa-file-text-o"></i>Wallet Request    </a></li>  -->


<li><a href="<?php echo base_url();?>admin/uploadreceipts"><i class="fa fa-file-text-o"></i>Upload Bill   </a></li> 
<li><a href="<?php echo base_url();?>admin/activity_log"><i class="fa fa-file-text-o"></i>My Recent Clicks </a></li> 

 <!-- <li class="dropdown">         
           <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"><i class="fa fa fa-money"></i>  Repurchase Wallet</a>  
           <ul role="menu" class="dropdown-menu">               
           <li><a href="<?php echo base_url();?>admin/transfer_fund"><i class="fa fa-angle-right"></i>  Transfer Amount</a></li>    
           <li><a href="<?php echo base_url();?>admin/transfer_history"><i class="fa fa-angle-right"></i>  Transfer History</a></li>        
           </ul>    
           </li>  -->
            
                
                <!-- <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);" aria-expanded="true"><i class="fa fa-money"></i> Payout </a>
                    <ul role="menu" class="dropdown-menu">
                     <li><a href="<?php echo base_url();?>admin/Payment_request"><i class="glyphicon glyphicon-user"></i> Payment Request</a></li>
                     <li><a href="<?php echo base_url();?>admin/bank-statement"><i class="glyphicon glyphicon-home"></i>  Payment Request Details</a></li>   
                   
                    </ul>
                </li> -->
                
  <!-- <li><a href="<?php echo base_url();?>admin/order"><i class="glyphicon glyphicon-home"></i>  Orders </a></li> 
 <li><a href="<?php echo base_url();?>admin/pin_sale"><i class="glyphicon glyphicon-home"></i> Package Orders </a></li> -->             

                
                
                

<!-- <li><a href="<?php echo base_url();?>admin/pin/edit"><i class="fa fa-key"></i>   E-Wallet</a></li> -->
 
<!-- <li><a href="<?php echo base_url();?>admin/request-wallet"><i class="fa fa-th"></i>   Wallet Request</a></li> -->
<!--li><a href="<?php echo base_url();?>admin/pin/edit"><i class="fa fa-key"></i>   Transfer PIN</a></li-->
<!-- <li><a href="<?php echo base_url();?>admin/bank-statement"><i class="fa fa-home"></i>Bank Statement</a></li> -->
<!-- <li><a  data-toggle="modal" data-target="#idModal" href="#"><i class="fa fa-sign-out"></i>Get registred Card </a></li> -->
<!--<li><a href="/Aurasway-Marketing-Plan.pdf" target="_blank"><i class="fa fa-square"></i>   Opportunity</a></li>-->
<!-- <li><a href="<?php echo base_url();?>admin/payout-invoice-report"><i class="fa fa-file-text-o"></i>   Payout Invoice Report</a></li> -->

<!-- <li><a href="<?php echo base_url();?>admin/welcomeletter"><i class="fa fa-file-text-o"></i>Welcome Letter </a></li> -->
<?php if($user['franchise'] > 0) { ?>
 <li><a href="<?php echo base_url();?>admin/sale"><i class="fa fa-file-text-o"></i>Franchise Sale    </a></li>  
 <li><a href="<?php echo base_url();?>admin/stock_detail"><i class="fa fa-file-text-o"></i>Stock  </a></li>  
<?php }  ?>
<!-- <li><a href="<?php echo base_url();?>admin/sale"><i class="fa fa-user"></i>   Franchise Order</a></li>  -->

 <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="" aria-expanded="true"><i class="fa fa-user"></i> Voucher</a>
                    <ul role="menu" class="dropdown-menu">
                   <li><a href="<?php echo base_url();?>admin/voucher"><i class="fa fa-user"></i>  Buy Voucher</a></li> 
                    <li><a href="<?php echo base_url();?>admin/voucher_order"><i class="fa fa-user"></i>  Purchased Voucher</a></li>
                    </ul>
                </li>
 
<li><a href="<?php echo base_url();?>admin/order"><i class="fa fa-shopping-cart"></i>My Orders</a></li>
<!-- <li><a href="<?php echo base_url();?>admin/pin_sale"><i class="fa fa-shopping-cart"></i>Package Order</a></li> -->
<li><a data-toggle="modal" data-target="#invite-friend-modal" href="#"><i class="fa fa-shopping-cart"></i> Invite Friends </a></li>
<!--<li><a href="<?php echo base_url();?>admin/treeview"><i class="fa fa-dashboard"></i>   Tree View</a></li>-->
<!--<li><a href="<?php echo base_url();?>admin/downlineall"><i class="fa fa-toggle-down"></i> Downline All</a></li>-->
<!--li><a href="<?php echo base_url();?>admin/downlinesale"><i class="fa fa-toggle-down"></i>   Downline Sale</a></li-->


<li><a href="<?php echo base_url();?>admin/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
</ul>
</div>
 </nav>
</div>
</div>
<!--side bar close -->