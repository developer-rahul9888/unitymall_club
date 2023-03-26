<?php if(!empty($get_popup)) { ?>
<style type="text/css">
    .md_home {
    position: fixed;
    padding-top: 35px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}
.md_home .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 38%;
}


</style>


<div id="myModal" class="modal md_home" style="display: inline;">

    <div class="modal-content">
     <div style="float: right;"><input class="btn-group closu popup-admin-btn " value="&times;" type="button"></div>
    <img src="<?php echo base_url(); ?>main-admin/images/popup/<?php echo $get_popup[0]['image']; ?>" class="img-responsive">

    </div>

</div>

<script>
    // Get the modal
    var modal = document.getElementById('myModal');  

    // Get the button that opens the modal

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closu")[0];

    // When the user clicks the button, open the modal

    modal.style.display = "inline";
    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script> 

<?php } ?>


<div class="col-sm-12 wel">
<?php 
$user = $profile[0]; 
 $rewards=array();
if(!empty($rhistory)){ 
foreach ($rhistory as $rew) {
	$rewards[]=$rew['level'];
}
} 


if($user['user_level']==2) { $rank = 'Active Associate'; }
elseif($user['user_level']==3) { $rank = 'Bronze'; }
elseif($user['user_level']==4) { $rank = 'Silver'; }
elseif($user['user_level']==5) { $rank = 'Gold'; }
else { $rank = 'Associate'; }
?>
<style>
 .table-striped > tbody > tr.reward {background:#5cb85c}
 .reward {background:#5cb85c}
 .qlink .col-sm-4 {margin-bottom:15px}
</style>

<h2 class="wella">Welcome <?php echo $profile[0]['f_name'].' '.$profile[0]['l_name'];?>
&nbsp; &nbsp;&nbsp;

</h2>
<?php   
	  
      //flash messages
        if(!empty($invite_email))
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Invitation sent successfully';
          echo '</div>';       
        } 

        if($profile[0]['var_status']!='yes') { 
            echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please update your profile';
            echo '</div>';
        } elseif($profile[0]['var_status']=='fno') { 
            echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your profile is under review please wait 2 working days';
            echo '</div>';
        }
           
        $comparedate = date('Y-m');
        if($profile[0]['user_level']=='0')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please activate your ID.';
          echo '</div>';       
        } 
	 echo validation_errors();
?>





</div>
<?php if(!empty($fech_news)) { ?>
    <div class="col-sm-12">
			<div class="news-text1">
				<div class=" con-w3l" >
					<marquee class="ind-home" direction="left" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();">
							<i class="fa fa-trophy"></i> <?php echo $fech_news[0]['discription']; ?>
					</marquee>
				</div>
			</div>
	</div>
<?php } ?>


<div class="mobilee">
	<div class="col-sm-6">
 			<div class="wal">
 				<p><img src="<?php echo base_url(); ?>assets/images/wllt.png">
 					<span>Rs <?php echo $profile[0]['bliss_amount'];  ?></span>
 				</p>
 			</div>
 		</div>
		<div class="col-sm-6">
 			<div class="wal">
 				<p><img src="<?php echo base_url(); ?>assets/images/coinss.png">
 					<span><?php echo $profile[0]['points'];  ?></span>
 				</p>
 			</div>

 		</div>
         <div class="col-sm-12">
             <form method="post" action="https://www.unitymall.in/member-login" target="_blank">
                        <input type="hidden" value="<?php echo $user['customer_id']; ?>" name="bcono"> 
                        <input type="hidden" name="auth" value="818a715577f917f18cc4357a95b31153">
                        <input type="hidden" name="type" value="shop">
                        <button type="submit" class="btn btn-rounded btn-block login-shop"><i class="icon-wallet"></i> Visit Unitymall Shop</button>
          </form>
 		</div>
 		</div> 
		
<div class="clearfix"></div>

 <div class="col-sm-12 mobileeee">
 
 
 
    </div>




<!---------- cash ---------------->
<?php
$achived = $redeemed = $left_pv = $right_pv = $matching = 0;
$left_rpv = $right_rpv = $rmatching = 0;
$total_left_bv = $total_right_bv = 0;
$total_left_rbv = $total_right_rbv = 0;
$total_lleft_rbv = $total_lright_rbv = 0;
if(!empty($bliss_amount)) {
	foreach($bliss_amount as $val) {
	  if($val['sale_type']==1) {
		if($val['type']=='BV left') { $total_left_bv = $total_left_bv + $val['amount']; }
		if($val['type']=='BV right') { $total_right_bv = $total_right_bv + $val['amount']; }
	  }
	  else {
		if($val['type']=='BV left' && $val['status']=='Lapse' ) { $total_lleft_rbv = $total_lleft_rbv + $val['amount']; }
        elseif($val['type']=='BV left')  { $total_left_rbv = $total_left_rbv + $val['amount']; }   
		if($val['type']=='BV right' && $val['status']=='Lapse') { $total_lright_rbv = $total_lright_rbv + $val['amount']; }
        elseif($val['type']=='BV right')  { $total_right_rbv = $total_right_rbv + $val['amount']; }   
	  }
        
	  
	}
} 


$matching_income = $leader_income = $recognise_income = $repurchase_income = $franch_income=$Direct_income = 0;
if(!empty($total_incomes)) {
	foreach($total_incomes as $val) {
		if($val['type']=='Matching') { $matching_income = $matching_income + $val['tamount']; } 
		if($val['type']=='Direct') { $Direct_income = $Direct_income + $val['tamount']; } 
		if($val['type']=='Repurchase') { $repurchase_income = $repurchase_income + $val['tamount']; } 
		if($val['type']=='Salary') { $recognise_income = $recognise_income + $val['tamount']; } 
		if($val['type']=='Franchies Income') { $franch_income = $franch_income + $val['tamount']; } 
        if($val['type']=='Depth income') { $depth_income = $depth_income + $val['tamount']; } 
	}
} 
?>

<div class="col-sm-12" id="bliss-wallet">
<?php 
$independent = $total_friend = $stage = $achivers = 0;
$referrals = '';
if(!empty($myfriends)) {
	$total_friend = count($myfriends); 
	foreach($myfriends as $friend){
		if($friend['level']=='1') { 
			$independent = $independent + 1; 
			$referrals .= '<tr><td>'.$friend['name'].'</td><td>'.$friend['friends'].'</td></tr>';
		}
		if($friend['level'] > $stage) { $stage = $friend['level']; }
		
	}
}


?>


   
   <div class="clearfix"></div>
	
	
<!----------->
<div class="adminpannel">
<div class="row">
 
<div class="BusinessDetails">
        <div class="col-md-6">
            <div class="panel panel-new-box busines-detail-cls ">
                <div class="panel-heading bg-e5f9ee">Business Details  </div>
                <div class="panel-body pd-15">

                    <table class="table tbl-business-cls">
                        <tbody><tr>
                            <th style="width: 260px;">Heads</th>
                            <th>Count</th>
                        </tr>
                        <tr>
                            <td><span class="btn-tbl btn-active">Active</span></td>
                            <td id="ActiveLeftM"><?php  if(array_key_exists(1, $left_consume)) { echo $active_left = $left_consume[1]; } else { echo 0; } ?></td>
                            
                        </tr>
                        <tr>
                            <td><span class="btn-tbl btn-INactive">InActive</span></td>
                            <td id="InActiveLeftM"><?php  if(array_key_exists(0, $left_consume)) { echo $active_left = $left_consume[0]; } else { echo 0; } ?></td>
                            
                        </tr>
                        <tr>
                            <td><span class="btn-tbl btn-ttl-member">Total Members</span></td>
                            <td id="TotalLeftM"><?php echo $left_count = array_sum($left_consume); ?></td>
                        </tr>
                        <tr>
                            <td><span class="btn-tbl btn-dire-member">Direct Members</span></td>
                            <td id="LeftDirectMe"><?php echo $user['direct']; ?></td>
                        </tr>
                        <!-- <tr>
                            <td><span class="btn-tbl btn-ttl-business">Total Business</span></td>
                            <td id="TotalLeftBusines">0</td>
                            <td id="TotalRightBusines">161.95</td>
                        </tr>
                        <tr>
                            <td><span class="btn-tbl btn-carr-forword">Carry Forward</span></td>
                            <td id="LeftCarryForword">0</td>
                            <td id="RightCarryFrorword">161.95</td>
                        </tr>
                        <tr>
                            <td><span class="btn-tbl btn-unset-business">Unsettled BV</span></td>
                            <td id="LeftUsetB"></td>
                            <td id="RightUsetB"></td>
                        </tr> -->
                    </tbody></table>
                </div>
            </div>
            </div>
        
            <div class="col-lg-6 col-md-6">
                <div class="panel panel-new-box busines-detail-cls">
                <div class="panel-body pd-0-10">
                        <div class="col-sm-4 ">
                            <div class="profile-lft-cls bg-geen-cls border-radius-6">
                                    <figure>
									<?php if($profile [0]['image'] !='') { 
                                        echo '<img src="'.base_url().'images/user/'.$user['image'].'" width="100">'; }
   else { echo '<img src="'.base_url().'images/user/31.png" width="100">'; } ?>
                                       
                                    </figure>
                                <h2><span><?php echo $profile[0]['customer_id'];?></span> </h2>
                                <a href="<?php echo base_url(); ?>admin/personal_details"><i class="fa fa-edit"></i></a>
                            </div>

                        </div>
                        <div class="col-sm-8">
                            <div class="profile-rht-cls">
                                <h3>Profile Details</h3>
                                <ul class="list-inline">
                                    <li>
                                        <h4>Name</h4>
                                        <p><?php echo $profile[0]['f_name'];?></p>
                                    </li>
                                    <li>
                                        <h4>Register Date</h4>
                                        <p><?php echo date('Y-m-d',strtotime($profile[0]['rdate']));;?></p>
                                    </li>
                                </ul>

                                <ul class="list-inline">

                                    <li>
                                        <h4>Email ID</h4>
                                        <p><?php echo $profile[0]['email'];?></p>
                                    </li>
                                    <li>
                                        <h4>Mobile No</h4>
                                        <p><?php echo $profile[0]['phone'];?></p>
                                    </li>
                                </ul>


                         <!-------       <h3 class="mt-20">Sponsor Details</h3>

                                    <ul class="list-inline">

                                        <li>
                                            <h4>Name</h4>
                                            <p><?php if(!empty($sponser)) { echo $sponser[0]['f_name']; } else { echo '------'; } ?> </p>
                                        </li>
                                        <li>
                                            <h4>User Name</h4>
                                            <p><?php if(!empty($sponser)) {  echo $sponser[0]['customer_id']; } else { echo '------'; } ?></p>
                                        </li>
                                    </ul>
                                    <ul class="list-inline">

                                        <li>
                                            <h4>Email ID </h4>
                                            <p><?php if(!empty($sponser)) {  echo $sponser[0]['email']; } else { echo '------'; } ?></p>
                                        </li>
                                        <li>
                                            <h4>Mobile No</h4>
                                            <p><?php if(!empty($sponser)) {  echo $sponser[0]['phone']; } else { echo '------'; } ?></p>
                                        </li>
                                    </ul>   -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>


        
    </div> 	
    


 

<div class="clearfix"></div>	


<div class="row">
   <div class="col-sm-8">
        <div class="card qlink">
            <div class="card-body">
                <h6 class="card-title">Quick Links</h6>
                <div class="row button-group">
				
                   <div class="col-sm-4">
                        <a href="<?php echo base_url(); ?>admin/income">
                            <button type="button" class="btn btn-rounded btn-block btn-outline-info"> <i class="icon-user-follow"></i> My Earnings</button></a>
                    </div>
                    <div class="col-sm-4 hide">
                         <a href="<?php echo base_url(); ?>admin/reverse">
                            <button type="button" class="btn btn-rounded btn-block btn-outline-success"><i class="icon-people"></i>  Tree View</button></a>
                    </div>  
                    <!-- <div class="col-sm-4">
                         <a href="<?php echo base_url(); ?>admin/bank-statement">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-primary"><i class="ti ti-money"></i>Payout</button></a>
                    </div> -->
                    <div class="col-sm-4">
                         <a href="<?php echo base_url(); ?>admin/direct_distributor">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-danger"><i class="icon-user-follow"></i>  My Network</button></a>
                    </div> 
                    <div class="col-sm-4">
                         <a href="<?php echo base_url(); ?>admin/personal_details">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-secondary"><i class="ti-user"></i>  My Profile</button></a>
                    </div> 

                    <div class="col-sm-4">
                    <form method="post" action="https://www.unitymall.in/member-login" target="_blank">
                        <input type="hidden" value="<?php echo $user['customer_id']; ?>" name="bcono"> 
                        <input type="hidden" name="auth" value="818a715577f917f18cc4357a95b31153">
                        <input type="hidden" name="type" value="shop">
                        <button type="submit" class="btn btn-rounded btn-block btn-outline-primary"><i class="icon-wallet"></i> Visit Unitymall Shop</button>
                    </form>
                    </div>
                    <!-- <div class="col-sm-4">
                         <a href="<?php echo base_url(); ?>admin/payment">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-warning"><i class="icon-wallet"></i>Add Fund</button></a>
                    </div> -->
					
					<div class="col-sm-4">
                      <a  data-toggle="modal" data-target="#idModal" href="#">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-primary"><i class="icon-wallet"></i> ID Card</button></a>
                    </div>
					
					<div class="col-sm-4">
					
                        <a  data-toggle="modal" data-target="#invite-friend-modal" href="#">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-info"><i class="icon-wallet"></i> Invite Friends</button></a>
                    </div>
					
					<!--<div class="col-sm-4">
					
                        <a  data-toggle="modal" data-target="#myModal" href="#">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-success"><i class="icon-wallet"></i> Bonanza Claim Form</button></a>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
	
	
	
	    <div class="col-sm-4 desktop hide">
        <div class="card1 ">
            <div class="customer-card m-b-0 m-t-0">
                <img src="<?php echo base_url();?>assets/images/card.png" alt="" class="card_img">---
                <div class="card-content white-text">
						<!-- <div class="textttttt">
								<h6><b>Direct Sponsor : </b><?php echo $user['direct_customer_id']; ?></h6>
								<h6><b>Email : </b><?php echo $user['email']; ?> </h6>
								<h6><b>Phone :  </b><?php echo $user['phone']; ?> </h6>
								<h6><b>Joining Date : </b><?php echo $user['rdate']; ?> </h6>
								<h6><b>Status ID : </b><?php echo $user['package_used']; ?></h6>
		
						</div> -->
                   <svg xmlns="http://www.w3.org/2000/svg" width="353px" height="206px" xmlns:xlink="http://www.w3.org/1999/xlink">
                         <text x="5" y="15" style="font-size:16;fill:#FFF;">
                            Name : <?php echo $user['f_name'].' '.$user['l_name'];  ?>  </text>
                        <text x="5" y="35" style="font-size:16;fill:#FFF;">
                            Username : <?php echo $user['customer_id']; ?>   </text>                
                        <text x="5" y="55" style="font-size:16;fill:#FFF;">
                         Direct Sponsor : <?php echo $user['direct_customer_id']; ?>                    </text>
                        <text x="5" y="75" style="font-size:16;fill:#FFF;">
                        Email :  <?php echo $user['email']; ?>                    </text>
                        <text x="5" y="95" style="font-size:16;fill:#FFF;">
                           Phone :   <?php echo $user['phone']; ?>                      </text>
                        <text x="5" y="115" style="font-size:16;fill:#FFF;">
                          Joining Date : <?php echo $user['rdate']; ?>                     </text>
                        <text x="5" y="135" style="font-size:16;fill:#FFF;"> 
                         Status ID : <?php echo $user['package_used']; ?>                      </text>
							
							
							
                    </svg>
					<img src="<?php echo base_url();?>/images/user/31.png" alt="user-img" class="img-circle user-image" style="height: 60px;"> 
                    
                </div>
            </div>
        </div>
    </div> 

</div>
<!---end of links-->
<style>
@media print {
  body * {
    visibility: hidden;
  }
  #dvPrintContent {
    border: 1px solid;
  }
  #dvPrintContent * {
    visibility: visible;
  }
  .loginbtnblock{display:none}
   .modal-header .close {
	display: none;
}

#idModal .modal-dialog.modal-sm {
	width: 500px;
}
  
}
</style>
<div id="dvPrintContent">
 <div class="modal fade fcid-card" id="idModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header no-print12">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ID CARD</h4>
        </div>
        <div class="modal-body id1">
        <div id="dvPrintContent" class="formblock">
<img id="img" src="<?php echo base_url(); ?>assets/images/idcard.png">
<div class="idimg">

<?php 
if($user['gender']=='Female') { $img = base_url().'images/user/female.png'; }
else { $img = base_url().'images/user/31.png'; }
if($user['image'] !='') { echo '<img src="'.base_url().'images/user/'.$user['image'].'">'; }
else{echo '<img src="'.$img.'">';} ?>
</div>

<div class="fcusername">
<span id="lblUserName"><?php echo $user['f_name'].' '.$user['l_name']; ?></span><br>
<span><?php echo $rank; ?></span>
</div>
<div class="fcuserID">
<span id="lblMemberIds"><?php echo $user['customer_id']; ?></span>
</div>
<div class="fcusergrd">
<span id="lblMemberIds"><?php echo date('Y-m-d',strtotime($user['rdate'])); ?></span>
</div>
<div class="fcuserrnk">
<span id="lblMemberIds"><?php echo $user['phone']; ?></span>
</div>
<div class="form-row loginbtnblock  ">
<input  type="button" value="Print" onclick="window.print();" class="btn btn_xport">
</div>
</div>

        </div>
       </div>
    </div>
	 
  </div>
 
  </div>


<div id="invite-friend-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">  
    <div class="modal-content" >
	 <div class="modal-header no-print12">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Invite Friends</h4>
        </div>
     
      <div class="modal-body">

<span>Share your Referral code</span>

<div id="social">
<div class="col-lg-12 reffer">
<div class="email-bg">
<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url().'register/'.$user['customer_id'];?>&picture=<?php echo base_url();?>assets/images/facebook.jpg&name=blisszon&description=text" target="_blank">
 <i class="fa fa-facebook"></i>  Share on Facebook </a>
 </div>
 </div>
 
<div class=" col-lg-12 reffer reffer3">
<div class="email-bg">
 <a class="sprite_stumbleupon" href="https://plus.google.com/share?url=<?php echo base_url().'register/'.$user['customer_id'];?>" target="_blank"> <i class="fa fa-google-plus"></i>  Share via Google Plus </a>
</div>
</div>

<div class=" col-lg-12 reffer reffer3">
<div class="email-bg">
 <a class="sprite_stumbleupon" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url().'register/'.$user['customer_id'];?>" target="_blank"> <i class="fa fa-linkedin"></i>  Share via Linkedin </a>
</div>
</div>


<div class=" col-lg-12 reffer">
<div class="email-bg ">
 <a class="sprite_stumbleupon" href="whatsapp://send?text=Hi friends, Start Join with Unitymall. 
	Click on this link <?php echo base_url().'register/'.$user['customer_id'];?>"> <i class="fa fa-whatsapp" aria-hidden="true"></i>  Share on Whatsapp </a>
</div>
</div>
</div>          
		<div class="col-lg-12 email-bg">
		<input type="text" id="website" value="<?php echo base_url().'register/'.$user['customer_id'];?>" />
<button data-copytarget="#website">Copy your link</button>
	 
	  </div>
	  	
      </div> 
    </div> 
  </div>
</div>  

<!--bonanza claim form-->
<div class="">
    <div class="">
        <div class="col-md-12">
            <div class="modal-box">
                <!-- Button trigger modal -->
             
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <div class="modal-body">
                                <div class="icon">
                                    <i class="fa fa-list-alt"></i>
                                </div>
                                <h3 class="title">Bonanza Claim Form</h3>
                                <p class="description">Business between 18 May se 18 June</p>
                                <div class="form-group">
                                    <input class="form-control user" type="text" placeholder="Joining Date">
                                    <input class="form-control user" type="text" placeholder="Pairs Completed before 15 May ">
                                    <input class="form-control user" type="text" placeholder="Enter No. of Pairs achieved">
                                </div>
                                <button class="subscribe"><i class="fa fa-paper-plane"></i>Claim Bonanza</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--bonanza claim form-->
<!---end of links-->
<!--div class="">
    <div class="col-sm-8">
        <div class="row">
             <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="d-flex flex-row">
                        <div class="p-10 bg-info">
							<i class="fa fa-credit-card"></i>
                        </div>
                        <div class="align-self-center m-l-20">
                            <h3 class="m-b-0 text-info">0.00</h3>
                            <h5 class="text-muted m-b-0">Team Sales</h5>
                        </div>
                    </div>
                </div>
            </div> 

             <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="d-flex flex-row">
                         <div class="p-10 bg-success">
							<i class="fa fa-credit-card"></i>
                        </div>
                        <div class="align-self-center m-l-20">
                            <h3 class="m-b-0 text-success">0.00</h3>
                            <h5 class="text-muted m-b-0">Self Sales</h5>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="d-flex flex-row">
                         <div class="p-10 bg-info">
							<i class="fa fa-credit-card"></i>
                        </div>
                        <div class="align-self-center m-l-20">
                            <h3 class="m-b-0 text-info">0.00</h3>
                            <h5 class="text-muted m-b-0">Total Credit</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="d-flex flex-row">
                         <div class="p-10 bg-success">
							<i class="fa fa-credit-card"></i>
                        </div>
                        <div class="align-self-center m-l-20">
                            <h3 class="m-b-0 text-success">0.00</h3>
                            <h5 class="text-muted m-b-0">Total Balance</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="d-flex flex-row">
                         <div class="p-10 bg-danger">
							<i class="fa fa-user"></i>
                        </div>
                        <div class="align-self-center m-l-20">
                            <h3 class="m-b-0 text-danger">Nominee</h3>
                            <h5 class="text-muted m-b-0"></h5>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card1 ">
            <div class="customer-card m-b-0 m-t-0">
                <img src="<?php echo base_url();?>assets/images/card.png" alt="" class="card_img">
                <div class="card-content white-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="353px" height="206px" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <text x="5" y="15" style="font-size:16;fill:#FFF;">
                            Name : <?php echo $user['f_name'].' '.$user['l_name'];  ?>                        </text>
                        <text x="5" y="35" style="font-size:16;fill:#FFF;">
                            Username : <?php echo $user['customer_id']; ?>                        </text>
                    
                        <text x="5" y="55" style="font-size:16;fill:#FFF;">
                            Direct Sponsor : <?php echo $user['direct_customer_id']; ?>                        </text>
                        <text x="5" y="75" style="font-size:16;fill:#FFF;">
                            Email : <?php echo $user['email']; ?>                      </text>
                        <text x="5" y="95" style="font-size:16;fill:#FFF;">
                            Phone :  <?php echo $user['phone']; ?>                         </text>
                        <text x="5" y="115" style="font-size:16;fill:#FFF;">
                            Joining Date : <?php echo $user['rdate']; ?>                     </text>
                        <text x="5" y="135" style="font-size:16;fill:#FFF;">
                            Active Date : <?php echo $user['package_used']; ?>                      </text>
                    </svg>
					<img src="<?php echo base_url();?>/images/user/31.png" alt="user-img" class="img-circle user-image" style="height: 60px;">
                    
                </div>
            </div>
        </div>
    </div>
</div
 <div class="col-sm-12">
<div class="rewards">
<h2 class="text-center top-bdr top-bdr1" style="margin-bottom:40px;" ><span>Rewards</span></h2>
<div class="table-responsive">
<table class="table table-bordered table-hover category-table "> 
<thead> <tr> <th>Sr.No</th><th>BV Matching</th> <th>Rewards</th> </tr> </thead> 
<tbody> 
<tr <?php if($user['reward'] >0){echo "class='reward'";}?>>  
<td>1</td>
<td>10000 PV Matching</td>
<td>Wrist Watch</td>
</tr>
<tr <?php if($user['reward'] >1){echo "class='reward'";}?>>  
<td>2</td>
<td>25000 PV Matching</td>
<td>Rs.2600 Cash</td>
</tr>
<tr <?php if($user['reward'] >2){echo "class='reward'";}?>>  
<td>3</td>
<td>50000 PV Matching</td>
<td>Rs.5100/Gold Coin</td>
</tr>

<tr <?php if($user['reward'] >3){echo "class='reward'";}?>>  
<td>4</td>
<td>100000 PV Matching</td>
<td>Rs.11000/Mobile</td>
</tr>

<tr <?php if($user['reward'] >4){echo "class='reward'";}?>>  
<td>5</td>
<td>2.5 Lacs PV Matching</td>
<td>Rs.26000/Laptop</td>
</tr>

<tr <?php if($user['reward'] >5){echo "class='reward'";}?>>  
<td>6</td>
<td>5 Lacs PV Matching</td>
<td>Rs.51000/I Phone</td>
</tr>
<tr <?php if($user['reward'] >6){echo "class='reward'";}?>>  
<td>7</td>
<td>7.5 Lacs PV Matching</td>
<td>Rs.70,000/Bike</td>
</tr>


<tr <?php if($user['reward'] >7 ){echo "class='reward'";}?>> 
<td>8</td>
<td>10 Lacs PV Matching</td>
<td> Rs.1.2Lacs/Pulsor</td>
</tr>
<tr <?php if($user['reward'] >8 ){echo "class='reward'";}?>> 
<td>9</td>
<td>15 Lacs PV Matching</td>
<td> Rs.1.75Lacs/Bullet</td>
<tr <?php if($user['reward'] >9 ){echo "class='reward'";}?>> 
<td>10</td>

<td>25 Lacs PV Matching</td>
<td> Rs.3Lacs/Alto Car</td>
</tr>
<tr <?php if($user['reward'] >10 ){echo "class='reward'";}?>> 
<td>11</td>
<td>35 Lacs PV Matching</td>
<td> Rs.4.5Lacs/Tiago</td>
</tr>
<tr <?php if($user['reward'] >11 ){echo "class='reward'";}?>> 
<td>12</td>
<td>60 Lacs PV Matching</td>
<td> Rs.7.5Lacs/Xcent</td>
</tr>

<tr <?php if($user['reward'] >12 ){echo "class='reward'";}?>> 
<td>13</td>
<td>80 Lacs PV Matching</td>
<td> Rs.9Lacs/Brezza</td>
</tr>
<tr <?php if($user['reward'] >13 ){echo "class='reward'";}?>> 
<td>14</td>
<td>1 Crore PV Matching</td>
<td> Rs.12Lacs/Scorpio</td>
</tr>



</tbody> 

</table>
</div>


</div> 
</div> 
<div class="col-sm-4">
<div class="news-wrapper">
						 
                        <h2 class="text-center top-bdr top-bdr1" style="margin-bottom:40px;" ><span>Top Achievers</span></h2>
                           
							<div class="news-back">
                               <marquee class="news-back1" direction="up" onmouseover="this.stop()" scrollamount="3" onmouseout="this.start()">
							   <p>Sandeep Jaiswal (Gold)</p>									
								
								<p> Annam (Gold Star) </p>
							
							<p>Devendra Vishwakarma (Star)</p>
                              
							  <p>Susheela (Star)</p>
   
   <p>Pooja Rajbar (Star)</p>
   
   <p>Om Prakash (Star)</p>
  
                               
                                     
                              </marquee>
                          </div>
                          </div>
                          </div>--->




<p>&nbsp;</p>
<div class="clearfix"></div>

<!--<p>&nbsp;</p>
<div class="clearfix"></div>
</div>
<div class="col-sm-12 text-center narg" id="my-transaction">
<div class="col-sm-4 text-center"><div class="bt0 brb" data-toggle="modal" data-target="#invite-friend-modal">Invite Friends</div></div>
<div class="col-sm-4 text-center"></div>-->
<!--<div class="col-sm-4 text-center"><div class="bt0 brb">Grand Total: <?php echo ($matching_income + $leader_income + $recognise_income + $repurchase_income + $franch_income);?></div></div>-->

<!--<div class="col-sm-2"></div>

<div class="col-sm-5  text-center">
<div class="bt0 brb hide" data-toggle="modal" data-target="#referralModal">View Direct BDM</div>

<div id="referralModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Direct BDM</h4>
      </div>
      <div class="modal-body">
        <table class="table">
		<tr><th class="text-center">Name</th><th class="text-center">Sponsored BDM</th></tr>
		<?php if($referrals=='') { echo '<tr><td colspan="2">No friends.</td></tr>';} 
		else { echo $referrals; } ?>
		</table>
      </div> 
    </div> 
  </div>
</div>
</div>-->
</div>
</div>
<!-- Modal -->
<!--<div id="all-transaction-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Worldwave History</h4>
      </div>
      <div class="modal-body">
	  <table class="table" style="width:100%">
  <tr>
   <th>Sr. no</th>
    <th>Redeemed Amt.</th>
    <th>Redeemed Amt. after TDS</th>
    <th>Request</th>
    <th>Date</th>
    <th>Status</th>
  </tr>
	  <?php

if(!empty($bliss_perk_history)) {
	$id=1;
	foreach($bliss_perk_history as $perk_history) {
		echo "<tr><td>".$id."</td><td>".$perk_history['redeem']."</td><td>".$perk_history['after_tds']."</td><td>".$perk_history['my_bliss_req']."</td><td>".$perk_history['rdate']."</td><td>".$perk_history['redeem_status']."</td></tr>";
		$id++;
	}
} ?>
</table> 
      </div> 
    </div> 
  </div>
</div>

<div id="redemptions-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Redeem Amount</h4>
      </div>
      <div class="modal-body">
	  <?php if($redeem_error=='show') { 
	     echo validation_errors();
	  } ?>
        <form method="post" action="<?php echo base_url();?>admin" class="form row">
		
		<input type="hidden" name="profile_com">
		<div class="col-sm-6 form-group"><label>Balance</label> <input id="balance"  required type="text" readonly name="balance" value="<?php echo $user['bliss_amount']; ?>" class="form-control"></div>
		
		<div class="col-sm-6 form-group"><label>Redeem</label> <input id="redeem" required type="number" min="2000" max="<?php echo $user['bliss_amount'];?>" name="redeem" value="<?php if($this->input->post('redeem')!='') { echo $this->input->post('redeem'); } ?>" class="form-control"></div>
		
		<div class="col-sm-6 form-group"><label>Redeemed balance after TDS</label> <input id="final_redeem" type="text" name="final_redeem" value="" class="form-control"></div>
		
		<div class="col-sm-6 form-group"><label>Balance after Redeem</label> <input type="text" id="after_redeem" name="after_redeem" value="" class="form-control"></div>
		
		
		<div class="col-sm-12 form-group"><label style="font-weight:normal"><input required type="checkbox" name="declare" value="1"> I hereby declared that the details furnished above correct to the best of my knowledge and belief. Redemption request is subject to approval from company. Redemption process will may take 3-7 working days.</label></div>
		<div class="col-sm-12"><input type="submit" name="redeem_bliss" value="Confirm Request" class="btn" style="color:#fff;"></div>
		</form>
      </div> 
    </div> 
  </div>
</div>-->


<div id="shopping_voucher_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upgrade request</h4>
      </div>
      <div class="modal-body">
	  
	  <?php if($shopping_voucher_modal=='show') { 
	     echo validation_errors();
	  } ?>
        <form method="post" action="<?php echo base_url();?>admin" class="form row">
               
		<div class="col-sm-12 form-group"><label>E-mail</label> <input type="text" name="email" value="" class="form-control"></div>
		<div class="col-sm-12 form-group"><label>Confirm E-Mail</label> <input type="text" name="c_email" value="" class="form-control"></div>
		<div class="col-sm-12 form-group"><label style="font-weight:normal"><input type="checkbox" name="declare" value="1"> I hereby declared that the details above correct to the best of my knowledge and belief. Upgrade process will may take 48 hours.</label></div>
		
		<div class="col-sm-12 text-center"><input type="submit" name="confirm_request" value="Upgrade" class="form-control "></div>
		
		</form>
      </div> 
    </div> 
  </div>
</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Download Joining Form</h4>
      </div>
      <div class="modal-body" style="height:auto; overflow:hidden;">

<span>Word File Or Pdf File</span>
<p>&nbsp;</p>

<div id="social">
<div class="col-lg-12 reffer">
<div class="btn-group">
<a href="#"><button type="button" class="btn btn-info btn-sm" style="margin-right:20px;">Word File</button></a>
<a href="#"><button type="button" class="btn btn-info btn-sm">Pdf File</button></a>
 </div>
 </div>

      </div> 
    </div> 
  </div>
</div>
</div>

<script>

jQuery(document).ready(function() { 	
(function() {'use strict';
  document.body.addEventListener('click', copy, true);
    function copy(e) {
	var 
      t = e.target,
      c = t.dataset.copytarget,
      inp = (c ? document.querySelector(c) : null);
    if (inp && inp.select) {
      inp.select();
	try {document.execCommand('copy');
        inp.blur();
		t.classList.add('copied');
        setTimeout(function() { t.classList.remove('copied'); }, 1500);
      }
      catch (err) {
        alert('please press Ctrl/Cmd+C to copy');
      }
    }
    }
})();

/*  <?php if($redeem_error=='show') {  ?>
    jQuery('#redemptions-modal').modal('show'); 	
	<?php } ?>
	
	<?php if($shopping_voucher_modal=='show') {  ?>
    jQuery('#shopping_voucher_modal').modal('show'); 	
	<?php } ?> */

 jQuery('#redeem').keyup(function(){
	          var redeem = jQuery("#redeem").val();
			  var balance = jQuery("#balance").val();
			  var cash = parseFloat(balance-redeem);  
			  var bliss = parseFloat(redeem*0.90);
			  jQuery("#final_redeem").val(bliss);
			  jQuery("#after_redeem").val(cash);
		  });


});
</script>
<style>

</style>
