 
 <?php 
$user = $profile[0]; 
?>

<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Bank detail updated successfully.';
          echo '</div>';       
        } 
      }
	  
	  
echo validation_errors(); 

	   $attributes = array('class' => 'form');
      echo form_open_multipart(base_url().'admin/bank_details', $attributes);
      ?>
	  
 <div class="page-heading"> 
        <h2>Bank Details</h2>
      </div>
	  
	   <div class="col-md-12">
 <div class="widget" style="height:auto; overflow:hidden;">
 <div class="widget-title">
 <h4>Enter Bank Details</h4>
 </div>
     <div class="widget-body">
		<div class="col-sm-3 form-group"><label>Bank Name</label> <input required type="text" name="bank_name" value="<?php if($this->input->post('bank_name')!='') { echo $this->input->post('bank_name'); }else { echo $user['bank_name']; } ?>" class="form-control"></div>
		<div class="col-sm-3 form-group"><label>Branch</label> <input required type="text" name="branch" value="<?php if($this->input->post('branch')!='') { echo $this->input->post('branch'); }else { echo $user['branch']; } ?>" class="form-control"></div>
		<div class="col-sm-3 form-group"><label>State</label> <input required type="text" name="bank_state" value="<?php if($this->input->post('bank_state')!='') { echo $this->input->post('bank_state'); }else { echo $user['bank_state']; } ?>" class="form-control"></div>
		
		<div class="col-sm-3 form-group"><label>Account Type</label> <input type="text" name="account_type" value="<?php if($this->input->post('account_type')!='') { echo $this->input->post('account_type'); }else { echo $user['account_type']; } ?>" class="form-control"></div>
		
		<div class="col-sm-3 form-group"><label>Account No.</label> <input required type="number" name="account_no" value="<?php if($this->input->post('account_no')!='') { echo $this->input->post('account_no'); }else { echo $user['account_no']; } ?>" class="form-control"></div>
		
		<div class="col-sm-3 form-group"><label>IFSC Code</label> <input required type="text" name="ifsc" value="<?php if($this->input->post('ifsc')!='') { echo $this->input->post('ifsc'); }else { echo $user['ifsc']; } ?>" class="form-control"></div>
		
		  <div class="form-group col-sm-3">
			   <label>Passbook image or cancel cheque</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="bank_img">
			  <input type="hidden" value="<?php echo $user['bank_img']; ?>" name="bank_img_old">
          </div>
		  
		  <div class="form-group col-sm-2">
           <?php if($user['bank_img'] !='') { echo '<a href="'.base_url().'images/user/'.$user['bank_img'].'" target="_blank"><img src="'.base_url().'images/user/'.$user['bank_img'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>
		
		
		<div class="col-sm-12 form-group"><label style="font-weight:normal"><input required type="checkbox" checked="checked" name="declare" value="1"> I hereby declared that the details furnished above correct to the best of my knowledge and belief. </label></div>
		  
		  <div class="clearfix"></div>
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp;  
          </div></div>
		  </div>
		  
		  <?php echo form_close(); ?>