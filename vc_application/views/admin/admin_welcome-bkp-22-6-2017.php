	
      
     <div class="col-sm-12">
<?php 
$user = $profile[0]; 
?>

<h2>Welcome <?php echo $this->session->userdata('user_name');?></h2>
</div>

<div class="col-sm-12 right-bar">

<!--div class="col-sm-12">
<h2 class="text-center top-bdr"><span>Bliss cash</span></h2>
<div class="col-sm-3">
<div class="tot-cash">
<div class="red sp col-sm-4"></div>
<div class=" col-sm-8 text-center">
<span>Total Bliss Cash</span>
<strong>123</strong>
</div>
</div>
</div><div class="col-sm-3">
<div class="tot-cash">
<div class="yellow sp col-sm-4"></div>
<div class=" col-sm-8 text-center">
<span>B-cash Bonus</span>
<strong>123</strong>
</div>
</div>
</div><div class="col-sm-3">
<div class="tot-cash">
<div class="blue sp col-sm-4"></div>
<div class=" col-sm-8 text-center">
<span>B-cash Redeemed</span>
<strong>123</strong>
</div>
</div>
</div><div class="col-sm-3">
<div class="tot-cash">
<div class="pink sp col-sm-4"></div>
<div class=" col-sm-8 text-center">
<span>B-cash To B-wallet</span>
<strong>123</strong>
</div>
</div>
</div>
</div>


<div class="col-sm-12 text-center">
<div class="col-sm-4  ">
<div class="bt0 rdb">Genrate Deals</div>
</div>
<div class="col-sm-4  ">
<div class="bt0 grb">Genrate Gift Cards</div>
</div>
<div class="col-sm-4  ">
<div class="bt0 brb">Genrate Coupon Code</div>
</div>
</div-->

<!---------- cash ---------------->
<div class="col-sm-12" id="bliss-wallet">
<h2 class="text-center top-bdr"><span>Bliss Wallet</span></h2>
<div class="col-sm-3">
<div class="tot-cash">
<!--div class="dp1 sp col-sm-4"></div-->
<div class=" col-sm-8 text-center">
<span>Total Amount</span>
<strong>₹<?php echo $user['bliss_amount'];?></strong>
</div>
</div>
</div>
<div class="col-sm-3">
<div class="tot-cash">
<!--div class="dp2 sp col-sm-4"></div-->
<div class=" col-sm-8 text-center">
<span>Balance Amount</span>
<strong>₹<?php echo $user['bliss_amount'];?></strong>
</div>
</div>
</div><div class="col-sm-3">
<div class="tot-cash">
<!--div class="dp3 sp col-sm-4"></div-->
<div class=" col-sm-8 text-center">
<span>Transfer Amount</span>
<strong>₹0</strong>
</div>
</div>
</div><div class="col-sm-3">
<div class="tot-cash">
<!--div class="dp4 sp col-sm-4"></div-->
<div class=" col-sm-8 text-center">
<span>Received Amount</span>
<strong>₹0</strong>
</div>
</div>
</div>
</div>

<!--div class="col-sm-12 text-center">
<div class="col-sm-4  ">
<div class="bt0 rdb1">Pay To Transfer Money</div>
</div>
<div class="col-sm-4  ">
<div class="bt0 grb2">Request Money</div>
</div>
<div class="col-sm-4  ">
<div class="bt0 brb3">Add money</div>
</div>
</div-->
<!---------- wallet ---------------->

<div class="col-sm-12" id="my-friends">
<h2 class="text-center top-bdr"><span>My Friends</span></h2>
<?php 
$total_friend = $total_inner_friend = $expert_friend = $beginner_friend = 0;
$total_inner_friend = 0;
$i = 0;
foreach($myfriends as $myfriend){ 
 if($i < 5) {
?> 
<div class="col-sm-2">
<div class="frnd-crl">
<div class="tot-cash1">  
<img src="<?php base_url();?>/assets/images/man-person.png">
<span><?php echo $myfriend['name'];?></span>
</div>
<strong><?php echo $myfriend['friends'];?> Friend</strong>
</div>
<!--div class="hlp-fr">Help your friend</div-->
</div>	
 <?php	}
 $i++;
 $total_friend = $total_friend + 1;
$total_inner_friend = $total_inner_friend + $myfriend['friends'];
if($myfriend['friends'] > 10) { 
  $expert_friend = $expert_friend + 1;
} else {
	$beginner_friend = $beginner_friend + 1;
}
}
?>

<div class="col-sm-2">
<div class="invite-frnd c-pointer" data-toggle="modal" data-target="#invite-friend-modal">
<strong>Invite Friend</strong>
</div> 
</div>

</div>

<!--- my friend --->
<div class="col-sm-12">
 
<div class="col-sm-3">
<div class="tot-cash">
<!--div class="red sp col-sm-4"></div-->
<div class=" col-sm-8 text-center">
<span>My Friends</span>
<strong><?php echo $total_friend;?></strong>
</div>
</div>
</div><div class="col-sm-3">
<div class="tot-cash">
<!--div class="yellow sp col-sm-4"></div-->
<div class=" col-sm-8 text-center">
<span>Total Friends</span>
<strong><?php echo ($total_friend + $total_inner_friend); ?></strong>
</div>
</div>
</div><div class="col-sm-3">
<div class="tot-cash">
<!--div class="blue sp col-sm-4"></div-->
<div class=" col-sm-8 text-center">
<span>Experts</span>
<strong><?php echo $expert_friend; ?></strong>
</div>
</div>
</div><div class="col-sm-3">
<div class="tot-cash">
<!--div class="pink sp col-sm-4"></div-->
<div class=" col-sm-8 text-center">
<span>Beginner</span>
<strong><?php echo $beginner_friend; ?></strong>
</div>
</div>
</div>
</div>


<div class="col-sm-12 text-center narg" id="my-transaction">
<h2 class="text-center top-bdr" ><span>My Transaction</span></h2>
<div class="col-sm-4  ">
<div class="bt0 rdb" data-toggle="modal" data-target="#all-transaction-modal">All Transactions</div>
</div>
<div class="col-sm-4  ">
<a href="<?php echo base_url();?>admin/order"><div class="bt0 grb">Purchases</div></a>
</div>
<div class="col-sm-4  ">
<div class="bt0 brb"  data-toggle="modal" data-target="#redemptions-modal">Redemptions</div>
</div>


</div>


<!--div class="col-sm-12 text-center">
<h2 class="text-center top-bdr"><span>Happy Hour</span></h2>
<div class="col-sm-4  ">
<div class="bt0 rdb1">Check Results</div>
 </div>
<div class="col-sm-4  ">
<div class="bt0 grb2">My Rewards</div>
 </div>
<div class="col-sm-4  ">
<div class="bt0 brb3">Claim your Rewards</div>
 </div>
</div-->


<!--- happy hour -->
</div>

 
<!-- Modal -->
<div id="all-transaction-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">My Transaction</h4>
      </div>
      <div class="modal-body">
        <p>No transaction yet.</p>
      </div> 
    </div> 
  </div>
</div>

<div id="redemptions-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Redemptions</h4>
      </div>
      <div class="modal-body">
        <p>No redemptions yet.</p>
      </div> 
    </div> 
  </div>
</div>

<div id="invite-friend-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">  
    <div class="modal-content" id="inviteModal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invite Friends</h4>
      </div>
      <div class="modal-body">
	  
	     <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab"><i class="fa fa-facebook"></i></a>

                        </li>
                        <li role="presentation"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab"><i class="fa fa-google-plus"></i></a>

                        </li>
						<li role="presentation"><a href="#whatsappTab" aria-controls="whatsappTab" role="tab" data-toggle="tab"><i class="fa fa-whatsapp"></i></a>

                        </li>
						<li role="presentation"><a href="#envelopeTab" aria-controls="envelopeTab" role="tab" data-toggle="tab"><i class="fa fa-envelope"></i></a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="uploadTab">
						<p>If you want to add your friends in your circle then give this URL to your friends.</p>
		              <p><strong><?php echo base_url().'reference/'.$user['customer_id'];?></strong></p>
					  </div>
						
                        <div role="tabpanel" class="tab-pane" id="browseTab">
						browseTab
						</div>
						<div role="tabpanel" class="tab-pane" id="whatsappTab">
						whatsappTab
						</div>
						
						<div role="tabpanel" class="tab-pane" id="envelopeTab">
						envelopeTab
						</div>
                    </div>
                </div>
            
	  
	  
	  
        
      </div> 
    </div> 
  </div>
</div>