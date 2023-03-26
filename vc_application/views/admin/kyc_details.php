 
 <?php 
$user = $profile[0]; 
if($user['var_status']=='no' || $user['var_status']==''){
?>

<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'KYC detail updated successfully.';
          echo '</div>';       
        } 
      }
	  
	  
echo validation_errors(); 

	   $attributes = array('class' => 'form');
      echo form_open_multipart(base_url().'admin/kyc_details', $attributes);
      ?>
	  
 <div class="page-heading"> 
        <h2>KYC Details</h2>
      </div>
	   <div class="col-md-12">
 <div class="widget" style="height:auto; overflow:hidden;">
                    <div class="widget-title">
 <h4>Enter KYC Details</h4>
	</div>	
	<div class="widget-body">
	 <div class="form-group col-sm-6">
            <label>PAN No</label>
              <input type="text" class="form-control"  name="pancard" value="<?php if($this->input->post('pancard')!='') { echo $this->input->post('pancard'); } else { echo $user['pancard']; } ?>" >
			  </div>
			  
		  <div class="form-group col-sm-4">
			    <label>Upload Pan Image</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="panimage" >
			  <input type="hidden" value="<?php echo $user['panimage']; ?>" name="panimage_old">
          </div>
		  <div class="form-group col-sm-2">
           <?php if($user['panimage'] !='') { echo '<a href="'.base_url().'images/user/'.$user['panimage'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['panimage'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>

        <div class="form-group col-sm-6">
            <label>Aadhar / Driving licence / Voter Card No.</label>
              <input type="text" class="form-control"  name="aadhar" value="<?php if($this->input->post('aadhar')!='') { echo $this->input->post('aadhar'); } else { echo $user['aadhar']; } ?>" >
			  </div>
		  <div class="form-group col-sm-4">
			   <label>Aadhar / Driving licence / Voter Card Front Image</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="aadharimage">
			  <input type="hidden" value="<?php echo $user['aadharimage']; ?>" name="aadharimage_old">
          </div>
		  
		  <div class="form-group col-sm-2">
           <?php if($user['aadharimage'] !='') { echo '<a href="'.base_url().'images/user/'.$user['aadharimage'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['aadharimage'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>
		   <div class="form-group col-sm-4">
			   <label>Aadhar / Driving licence / Voter Card Back Image</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="back_aadharimage">
			  <input type="hidden" value="<?php echo $user['back_adhar_img']; ?>" name="back_aadharimage_old">
          </div>
		   <div class="form-group col-sm-2">
           <?php if($user['back_adhar_img'] !='') { echo '<a href="'.base_url().'images/user/'.$user['back_adhar_img'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['back_adhar_img'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>
		  	<div class="form-group col-sm-4">
			   <label>Passbook image or cancel cheque</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="bank_img">
			  <input type="hidden" value="<?php echo $user['bank_img']; ?>" name="bank_img_old">
          </div>
		   <div class="form-group col-sm-2">
           <?php if($user['bank_img'] !='') { echo '<a href="'.base_url().'images/user/'.$user['bank_img'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['bank_img'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>
		   <div class="form-group  col-lg-12">
            <p><input type="checkbox" name="terms" checked required value="yes"> You are agreeing to the privacy policy and the terms & conditions of the FDN Marketing Pvt. Ltd. </p>
          </div>
		 
		  
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp;  
          </div></div>
		  </div>
		  
		  <?php echo form_close(); ?>
		  
<?php }else{ ?>	  

 <div class="page-heading"> 
        <h2>KYC Details</h2>
      </div>
	  <div class="widget col-md-12">
                    <div class="widget-title">
                        <h4> <i class="icon-tags"></i>KYC Details  <span class="pull-right"></span></h4>
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
		  
		  
<?php } ?>	  
		  