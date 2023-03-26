<?php 
$user = $profile[0]; 
?>
<div class="col-sm-12 no-print">
<h2>Personal Details</h2>
</div>

<div class="clearfix"></div>
<div class="widget col-md-12">
                    <div class="widget-title">
                        <h4>Personal Details  <span><a class="btn btn-primary flrt" href="<?php echo base_url();?>admin/profile">Edit</a></span></h4>
                    </div>
                    <div class="widget-body">
                        <div class="col-md-3">
                            <div class="text-center profile-pic">
							<?php if($user['image'] !='') { echo '<img src="'.base_url().'images/user/'.$user['image'].'" width="220">'; } ?>
                            </div>
                        </div><!--span 6--->
                        <div class="col-md-9">
						<div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody style="font-weight: bold">
								<tr>
                                        <td class="span2">
                                            First Name :
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['f_name'];?></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="span2">
                                            Last Name:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['l_name'];?></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="span2">
                                            Gender:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['gender'];?></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="span2">
                                            Date of Birth:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['dob'];?></span>
                                        </td>
                                    </tr>
                                 <tr>
                                        <td class="span2">
                                            Joining Date :
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['rdate'];?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">
                                            Activation Date :
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['rdate'];?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="span2">
                                            Sponsor ID :
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblCountry"><?php echo $user['parent_customer_id'];?></span>
                                        </td>
                                    </tr>
									
                                </tbody>
                            </table></div>
                        </div><!--span12--->
						
                    </div><!---widget body--->
                </div>
				
				<div class="clearfix"></div>
<div class="widget col-md-12">
                    <div class="widget-title">
                        <h4>Contact Details <span><a class="btn btn-primary flrt " href="<?php echo base_url();?>admin/profile">Edit</a></span></h4>
                    </div>
                    <div class="widget-body">
                        
                        <div class="col-md-12">
						<div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody style="font-weight: bold">
                                 <tr>
                                        <td class="span2">
                                           Address:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['address'];?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">
                                            city:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['city'];?></span>
                                        </td>
                                    </tr>
                                  
                                    <tr>
                                        <td class="span2">
                                            State:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblMailId"> <?php echo $user['state'];?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">
                                            Email Address:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblRank"> <?php echo $user['email'];?></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="span2">
                                            Pincode:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblRank"> <?php echo $user['pincode'];?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">
                                            Mobile :
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblMobile">  <?php echo $user['phone'];?></span>
                                        </td>
                                    </tr>

                              


                                </tbody>
                            </table></div>
                        </div><!--span12--->
						
                    </div><!---widget body--->
                </div>
				
				<div class="clearfix"></div>
<div class="widget col-md-12">
                    <div class="widget-title">
                        <h4>Nominee Details <span><a class="btn btn-primary flrt " href="<?php echo base_url();?>admin/profile">Edit</a></span></h4>
                    </div>
                    <div class="widget-body">
                        
                        <div class="col-md-8">
						<div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody style="font-weight: bold">
                                 <tr>
                                        <td class="span2">
                                           Nominee Name:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"> <?php echo $user['nominee'];?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">
                                           Nominee Relation:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"> <?php echo $user['nominee_rel'];?></span>
                                        </td>
                                    </tr>
									 <tr>
                                        <td class="span2">
                                           Nominee DOB:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"> <?php echo $user['nominee_dob'];?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table></div>
                        </div><!--span12--->
						<div class="col-md-4"></div>
                    </div><!---widget body--->
                </div>
				<div class="clearfix"></div>
<div class="widget col-md-12">
                    <div class="widget-title">
                        <h4>Kyc Details  <span><a class="btn btn-primary flrt " href="<?php echo base_url();?>admin/kyc_details">Edit</a></span></h4>
                    </div>
                    <div class="widget-body">
                        <div class="col-md-8">
						<div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody style="font-weight: bold">
                                 <tr>
                                        <td class="span2">
                                           PAN Card
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"> <?php echo $user['pancard'];?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">
                                           PAN Proof:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ">  <?php if($user['panimage'] !='') { echo '<a href="'.base_url().'images/user/'.$user['panimage'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['panimage'].'" style="width:auto;max-width:64px;"></a>'; } ?></span>
                                        </td>
                                    </tr>
									 <tr>
                                        <td class="span2">
                                          Aadhar
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"> <?php echo $user['aadhar'];?></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="span2">
                                          Aadhar Proof
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"> <?php if($user['aadharimage'] !='') { echo '<a href="'.base_url().'images/user/'.$user['aadharimage'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['aadharimage'].'" style="width:auto;max-width:64px;"></a>'; } ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table></div>
                        </div><!--span12--->
						<div class="col-md-4"></div>
                    </div><!---widget body--->
                </div>
						<div class="clearfix"></div>
<div class="widget col-md-12">
                    <div class="widget-title">
                        <h4>Bank Details  <span><a class="btn btn-primary flrt " href="<?php echo base_url();?>admin/bank_details">Edit</a></span></h4>
                    </div>
                    <div class="widget-body">
                        
                        <div class="col-md-8">
						<div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody style="font-weight: bold">
                                 <tr>
                                        <td class="span2">
                                           Bank Name:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['bank_name'];?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span2">
                                            Branch:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['branch'];?></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="span2">
                                            State:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['bank_state'];?></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="span2">
                                            Account Type:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['account_type'];?></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="span2">
                                            Account Number:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['account_no'];?></span>
                                        </td>
                                    </tr>
									<tr>
                                        <td class="span2">
                                            IFSC Code:
                                        </td>
                                        <td>
                                            <span id="ctl00_cphUser_lblDOJ"><?php echo $user['ifsc'];?></span>
                                        </td>
                                    </tr>
                                  
                                    
                                </tbody>
                            </table></div>
                        </div><!--span12--->
						<div class="col-md-4"></div>
                    </div><!---widget body--->
                </div>		
				