<div class="col-sm-12 wel">
<?php 
$user = $profile[0]; 
 $rewards=array();
if(!empty($rhistory)){ 
foreach ($rhistory as $rew) {
	$rewards[]=$rew['level'];
}
} 

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
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'redeem')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Account upgrade request sumited successfully. upgrade process will may take 1-2 working days.';
          echo '</div>';       
        }  
		if($this->session->flashdata('flash_message') == 'emi_bliss_perks')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Thank you for shopping with us. We will be shipping your order to you soon.';
          echo '</div>';       
        }
		if($this->session->flashdata('flash_message') == 'emi_payment_error')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please check your order info or email to admin.';
          echo '</div>';       
        }
      }   
	  
      //flash messages
        if(!empty($invite_email))
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Invitation sent successfully';
          echo '</div>';       
        } 

if($profile[0]['account_name']=='' || $profile[0]['account_no']=='' || $profile[0]['aadhar']=='' || $profile[0]['pancard']=='') { 
              echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please update your profile';
          echo '</div>';
           }elseif($profile[0]['var_status']=='no') { 
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
        elseif(!strstr($profile[0]['package_used'],$comparedate) && $profile[0]['bsacode']!='')
        {
            if($profile[0]['bsacode']=='2 Star') { $re_pur_amt = '10PV'; } // 10pv 750
			elseif($profile[0]['bsacode']=='3 Star') { $re_pur_amt = '20PV'; } // 20pv 1500
			elseif($profile[0]['bsacode']=='5 Star') { $re_pur_amt = '30PV'; } // 30pv 2250
			elseif($profile[0]['bsacode']=='Manager') { $re_pur_amt = '50PV'; } // 50pv 3750
			elseif($profile[0]['bsacode']=='Senior Manager') { $re_pur_amt = '60PV'; } // 60pv 4500
			else { $re_pur_amt = '100PV'; } // 100pv 7500
						
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your '.$re_pur_amt.' repurchase is pending.';
          echo '</div>';       
        }  
        
	 echo validation_errors();
?>





</div>
<div class="hide">
	<div class="col-sm-12">
			<div class="news-text1">
				<div class=" con-w3l" >
					<marquee class="ind-home" direction="left" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();">
							<i class="fa fa-trophy"></i> Good news .Complete 200 pair and get Goa tour (t&c apply).Fully paid by company.Hurry up .Don't miss the chance
		Good news .Complete 200 pair and get Goa tour (t&c apply).Fully paid by company.Hurry up.
					</marquee>
				</div>
			</div>
	</div>
</div>
<div class="col-sm-12 right-bar">

<!---------- cash ---------------->
<?php
$achived = $redeemed = $left_pv = $right_pv = $matching = 0;
$left_rpv = $right_rpv = $rmatching = 0;
if(!empty($bliss_amount)) {
	foreach($bliss_amount as $val) {
	  if($val['sale_type']=='1') {
		if($val['type']=='Matching') { $matching = $matching + $val['amount']; }
		if($val['status']=='Redeem') { $redeemed = $redeemed + $val['amount']; }
		if($val['status']=='Active' && $val['type']=='PV right') { $right_pv = $right_pv + $val['amount']; }
		if($val['status']=='Active' && $val['type']=='PV left') { $left_pv = $left_pv + $val['amount']; }
	  } else {
		if($val['type']=='Matching') { $rmatching = $rmatching + $val['amount']; } 
		if($val['status']=='Active' && $val['type']=='PV right') { $right_rpv = $right_rpv + $val['amount']; }
		if($val['status']=='Active' && $val['type']=='PV left') { $left_rpv = $left_rpv + $val['amount']; }  
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

<h2 class="text-center top-bdr" ><span>Distributor</span></h2>
	<div class="col-lg-4 col-md-6">
        <div class="card bg-success">
            <div class="card-body">
                                       
                        <div class="carousel-item flex-column active">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="fa fa-users text-white"></i>
                                <div class="m-t-10">
                                    <h5>All Team</h5>
                                </div>
                                <div class="ml-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span>Left</span>
                                    <p id="left_member"><?php echo round($user['left_count'],0); ?></p>
                                </div>
                                <div class="col-4">
                                    <span>Right</span>
                                    <p id="right_member"><?php echo round($user['right_count'],0); ?></p>
                                </div>
                                <div class="col-4">
                                    <span>Direct</span>
                                    <p id="direct_member"><?php echo count($directs); ?></p>
                                </div>
                            </div>
                        </div>
                  
            </div>
        </div>
    </div>
	
	<div class="col-lg-4 col-md-6">
        <div class="card bg-cyan">
            <div class="card-body">
                                       
                        <div class="carousel-item flex-column active">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="fa fa-users text-white"></i>
                                <div class="m-t-10">
                                    <h5>Active Members</h5>
                                </div>
                                <div class="ml-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span>Left</span>
                                    <p id="left_member"><?php echo round($user['plcount'],0); ?></p>
                                </div>
                                <div class="col-4">
                                    <span>Right</span>
                                    <p id="right_member"><?php echo round($user['prcount'],0); ?></p>
                                </div>
                               <div class="col-4">
                                    <span>Direct</span>
                                    <p id="direct_member"><?php echo $user['left_direct']+$user['right_direct']; ?></p>
                                </div>
                            </div>
                        </div>                 
            </div>
        </div>
    </div>
	
	<div class="col-lg-4 col-md-6">
        <div class="card bg-primary1">
            <div class="card-body">
                                       
                        <div class="carousel-item flex-column active">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="fa fa-users text-white"></i>
                                <div class="m-t-10">
                                    <h5>Direct Member</h5>
                                </div>
                                <div class="ml-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span>Left</span>
                                    <p id="left_member"><?php echo $user['left_direct']; ?></p>
                                </div>
                                <div class="col-4">
                                    <span>Right</span>
                                    <p id="right_member"><?php echo $user['right_direct']; ?></p>
                                </div>
                                <div class="col-4">
                                    <span>Direct</span>
                                    <p id="direct_member"><?php echo $user['left_direct']+$user['right_direct']; ?></p>
                                </div>
                            </div>
                        </div>                 
            </div>
        </div>
    </div>

<div class="clearfix"></div>
	
	<div class="col-lg-4 col-md-6">
        <div class="card bg-dark">
            <div class="card-body">
                                       
                        <div class="carousel-item flex-column active">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="fa fa-line-chart text-white"></i>
                                <div class="m-t-10">
                                    <h5>Sale</h5>
                                </div>
                                <div class="ml-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span>Left</span>
                                    <p id="left_member"><?php echo $user['left_sale']; ?></p>
                                </div>
                                <div class="col-4">
                                    <span>Right</span>
                                    <p id="right_member"><?php echo $user['right_sale']; ?></p>
                                </div>
                                <div class="col-4">
                                    <span>Direct</span>
                                    <p id="direct_member"><?php echo $user['direct_sale']; ?></p>
                                </div>
                            </div>
                        </div>                 
            </div>
        </div>
    </div>
	
	<div class="col-lg-4 col-md-6">
        <div class="card bg-danger">
            <div class="card-body">
                                       
                        <div class="carousel-item flex-column active">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="fa fa-line-chart text-white"></i>
                                <div class="m-t-10">
                                    <h5>Sale PV</h5>
                                </div>
                                <div class="ml-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-3">
                                    <span>Self</span>
                                    <p id="left_member"><?php echo round($user['sbv'],0);?></p>
                                </div>
								<div class="col-3">
                                    <span>Left</span>
                                    <p id="left_member"><?php echo round($user['lbv'],0);?></p>
                                </div>
                                <div class="col-3">
                                    <span>Right</span>
                                    <p id="right_member"><?php echo round($user['rbv'],0);?></p>
                                </div>
                                <div class="col-3">
                                    <span>Team</span>
                                    <p id="direct_member"><?php echo round($user['lbv']+$user['rbv'],0);?></p>
                                </div>
                            </div>
                        </div>                 
            </div>
        </div>
    </div>
	
	<div class="col-lg-4 col-md-6">
        <div class="card bg-warning">
            <div class="card-body">
                                       
                        <div class="carousel-item flex-column active">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="fa fa-line-chart text-white"></i>
                                <div class="m-t-10">
                                    <h5>Sale BV</h5>
                                </div>
                                <div class="ml-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-3">
                                    <span>Self</span>
                                    <p id="left_member"> <?php if(!empty($repurchase_bv)) { echo round($repurchase_bv[0]['sbv'],0); } else { echo '0';} ?></p>
                                </div>
								<div class="col-3">
                                    <span>Left</span>
                                    <p id="left_member"> <?php if(!empty($repurchase_bv)) { echo round($repurchase_bv[0]['lbv'],0); } else { echo '0';} ?></p>
                                </div>
                                <div class="col-3">
                                    <span>Right</span>
                                    <p id="right_member"> <?php if(!empty($repurchase_bv)) { echo round($repurchase_bv[0]['rbv'],0); } else { echo '0';} ?></p>
                                </div>
                                <div class="col-3">
                                    <span>Team</span>
                                    <p id="direct_member"><?php if(!empty($repurchase_bv)) { echo round($repurchase_bv[0]['lbv']+$repurchase_bv[0]['rbv'],0); } else { echo '0';} ?></p>
                                </div>
                            </div>
                        </div>                 
            </div>
        </div>
    </div>

<div class="">
   <div class="col-sm-8">
        <div class="card qlink">
            <div class="card-body">
                <h6 class="card-title">Quick Links</h6>
                <div class="row button-group">
				
                    <div class="col-sm-4">
                        <a href="<?php echo base_url(); ?>admin/signup">
                            <button type="button" class="btn btn-rounded btn-block btn-outline-info"> <i class="icon-user-follow"></i>  Add Client</button></a>
                    </div>
                    <div class="col-sm-4">
                         <a href="<?php echo base_url(); ?>admin/treeview">
                            <button type="button" class="btn btn-rounded btn-block btn-outline-success"><i class="icon-people"></i>  Tree View</button></a>
                    </div>
                    <div class="col-sm-4">
                         <a href="<?php echo base_url(); ?>admin/bank-statement">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-primary"><i class="ti ti-money"></i>Payout</button></a>
                    </div>
					
					
                    <div class="col-sm-4">
                         <a href="<?php echo base_url(); ?>admin/downlineall">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-danger"><i class="icon-user-follow"></i>  My Team</button></a>
                    </div>
                    <div class="col-sm-4">
                         <a href="<?php echo base_url(); ?>admin/personal_details">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-secondary"><i class="ti-user"></i>  My Profile</button></a>
                    </div>
                    <div class="col-sm-4">
                         <a href="<?php echo base_url(); ?>admin/Payment_request">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-warning"><i class="icon-wallet"></i> My wallet</button></a>
                    </div>
					
					<div class="col-sm-4">
                      <a  data-toggle="modal" data-target="#idModal" href="#">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-primary"><i class="icon-wallet"></i> ID Card</button></a>
                    </div>
					
					<div class="col-sm-4">
					
                        <a  data-toggle="modal" data-target="#invite-friend-modal" href="#">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-info"><i class="icon-wallet"></i> Invite Friends</button></a>
                    </div>
					
					<div class="col-sm-4">
					
                        <a  data-toggle="modal" data-target="#myModal" href="#">
                        <button type="button" class="btn btn-rounded btn-block btn-outline-success"><i class="icon-wallet"></i> Bonanza Claim Form</button></a>
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

</div>
<!---end of links-->
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
<img src="http://lifebnao.com/images/user/31.png">
</div>

<div class="fcusername">
<span id="lblUserName"><?php echo $user['f_name'].' '.$user['l_name']; ?></span>
</div>
<div class="fcuserID">
<span id="lblMemberIds"><?php echo $user['customer_id']; ?></span>
</div>
<div class="fcusergrd">
<span id="lblMemberIds"><?php echo $user['rdate']; ?></span>
</div>
<div class="fcuserrnk">
<span id="lblMemberIds"><?php echo $user['phone']; ?></span>
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
<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url().'reference/'.$user['customer_id'];?>&picture=<?php echo base_url();?>assets/images/facebook.jpg&name=blisszon&description=text" target="_blank">
 <i class="fa fa-facebook"></i>  Share on Facebook </a>
 </div>
 </div>
 
<div class=" col-lg-12 reffer reffer3">
<div class="email-bg">
 <a class="sprite_stumbleupon" href="https://plus.google.com/share?url=<?php echo base_url().'reference/'.$user['customer_id'];?>" target="_blank"> <i class="fa fa-google-plus"></i>  Share via Google Plus </a>
</div>
</div>


<div class=" col-lg-6 reffer mob_app">
<div class="email-bg ">
 <a class="sprite_stumbleupon" href="whatsapp://send?text=Hi friends, content goes hare. 
	Click on this link <?php echo base_url().'reference/'.$user['customer_id'];?>"> <img src="<?php echo base_url();?>assets/images/w.png">  Share on Whatsapp </a>
</div>
</div>
</div>          
		<div class="col-lg-12 email-bg">
		<input type="text" id="website" value="<?php echo base_url().'reference/'.$user['customer_id'];?>" />
<button data-copytarget="#website">Copy your link</button>
	 
	  </div>
	  	
      </div> 
    </div> 
  </div>
</div>  

<!--bonanza claim form-->
<div class="container">
    <div class="row">
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
</div-->
 <div class="col-sm-12">
<div class="rewards">
<h2 class="text-center top-bdr top-bdr1" style="margin-bottom:40px;" ><span>Rewards</span></h2>
<div class="table-responsive">
<table class="table table-bordered table-hover category-table "> 
<thead> <tr> <th>Sr.No</th><th>Points</th> <th>Rewards</th> </tr> </thead> 
<tbody> 
<tr <?php if($user['reward'] >0){echo "class='reward'";}?>>  
<td>1</td>
<td>20 Points</td>
<td>T-shirt</td>
</tr>
<tr <?php if($user['reward'] >1 ){echo "class='reward'";}?>> 
<td>2</td>
<td>50 Points</td>
<td> Smartphone</td>
</tr>
<tr <?php if($user['reward'] >2 ){echo "class='reward'";}?>> 
<td>3</td>
<td>100 Points</td>
<td>32" LED TV</td>
</tr>
<tr <?php if($user['reward'] >3 ){echo "class='reward'";}?>> 
<td>4</td>
<td>250 Points</td>
<td> 11000 DP for Laptop</td>
</tr>
<tr <?php if($user['reward'] >4 ){echo "class='reward'";}?>> 
<td>5</td>
<td>500 Points</td>
<td>21000 DP for Bike</td>
</tr>
<tr <?php if($user['reward'] >5 ){echo "class='reward'";}?>> 
<td>6</td>
<td>1100 Points</td>
<td>65000 DP for Alto</td>
</tr>
<tr <?php if($user['reward'] >6 ){echo "class='reward'";}?>> 
<td>7</td>
<td>2500 Points</td>
<td>13500 DP for Swift</td>
</tr>
<tr <?php if($user['reward'] >7 ){echo "class='reward'";}?>> 
<td>8</td>
<td>5000 Points</td>
<td>270000 DP for Breeza</td>
</tr>
<tr <?php if($user['reward'] >8 ){echo "class='reward'";}?>> 
<td>9</td>
<td>11000 Points</td>
<td> 500000 DP for Creta</td>
</tr>


</tbody> 

</table>
</div>


</div> 
</div> 

<!--<div class="col-sm-4">
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

 <?php if($redeem_error=='show') {  ?>
    jQuery('#redemptions-modal').modal('show'); 	
	<?php } ?>
	
	<?php if($shopping_voucher_modal=='show') {  ?>
    jQuery('#shopping_voucher_modal').modal('show'); 	
	<?php } ?>

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
