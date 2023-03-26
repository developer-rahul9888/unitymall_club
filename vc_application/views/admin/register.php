
  <div class="content">
    <div class="content-container">
	
	<div class="page-heading"> 

        <h2>SignUp</h2>

      </div>

<?php 
      //flash messages
      if($this->session->flashdata('register')){
        if($this->session->flashdata('register') == 'true')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Register successfully';
          echo '</div>';       
        } 
		if($this->session->flashdata('register') == 'pin_error')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please check your PIN.';
          echo '</div>';       
        } 
        if($this->session->flashdata('register') == 'already')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Email id is already register.';
          echo '</div>';       
        } 
		 if($this->session->flashdata('register') == 'place_code')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo 'Placement is not Available.';
          echo '</div>';       
        }
        if($this->session->flashdata('register') == 'bliss_code')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo 'Please Activate your ID first.';
          echo '</div>';       
        }
		if($this->session->flashdata('register') == 'al_phone')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Phone No. is already register.';
          echo '</div>';       
        } 
        
      }
	  
     ?>
<?php echo validation_errors(); ?>

<?php
      $attributes = array('class' => 'col-sm-0 col-sm-offset-0');
      echo form_open('', $attributes);
?> 
	  
	  
	  
	 
	 <div class="col-sm-12 signup-sect">
	  <div id="register-msg-div"></div>
        <form class="form" action="" method="post" id="popup-register-form">
	
	   
	   <div class="col-sm-3">
        <div class="form-group">
       <label>First Name</label> <input required="required" type="text" name="f_name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } ?>" class="form-control input-empty">
	   </div>
	   </div>
	   
	   
	   <div class="col-sm-3">
     <div class="form-group">
      <label>Last Name</label> <input  type="text" name="l_name" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } ?>" class="form-control input-empty">
	  </div>
	   </div>
	   <div class="col-sm-3">
     <div class="form-group">
       <label>Email</label> <input required="required" type="email" name="email" value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } ?>" class="form-control input-empty">
	   </div>
	   </div>
	   
	   
	   <div class="col-sm-3">
     <div class="form-group">
       <label>Sponsor ID</label> <input id="bliss_code_input" required="required" type="text" name="bliss_code" value="<?php if($this->input->post('bliss_code')!='') { echo $this->input->post('bliss_code'); } else {  echo $this->session->userdata('bliss_id'); } ?>" class="form-control input-empty request-code-input">
	   <div id="sponsr_name"></div>
	   </div>
	   </div>

	   <div class="col-sm-3">
     <div class="form-group">
       <label>Placement ID</label> <input id="place_code_input" type="text" name="place_code" value="<?php if($this->input->post('place_code')!='') { echo $this->input->post('place_code'); } else { echo $this->uri->segment(3); }  ?>" class="form-control input-empty request-code-input">
	   <div id="place_sponsr_name"></div> 
	   </div>
	   </div>

	    <div class="col-sm-3">
     <div class="form-group">
       <label>Pancard</label> <input  type="text" name="pancard" value="<?php if($this->input->post('pancard')!='') { echo $this->input->post('pancard'); }  ?>" class="form-control input-empty request-code-input">
	   </div>
	   </div>
	   <div class="col-sm-3">
     <div class="form-group">
       <label>Aadhar</label> <input  type="text" name="aadhar" value="<?php if($this->input->post('aadhar')!='') { echo $this->input->post('aadhar'); }  ?>" class="form-control input-empty request-code-input">
	   </div>
	   </div>
	   
	   
	   <div class="col-md-3 col-sm-6">
     <div class="form-group">
       <label>Password</label> <input type="password" name="password" required value="<?php if($this->input->post('password')!='') { echo $this->input->post('password'); } ?>" class="form-control input-empty">
	   </div>
	   </div>
	   <div class="col-md-3 col-sm-6">
     <div class="form-group">
	   <label>Confirm Password</label> <input type="password" name="cpassword" required value="<?php if($this->input->post('cpassword')!='') { echo $this->input->post('cpassword'); } ?>" class="form-control input-empty">
	   </div>
	   </div>
	   
	   
	   <div id="mySelect" class="form-group col-md-3 col-sm-6">
		<label>Phone</label>
		<div class="input-group">
         
          <input type="number" min="1" maxlength="10" name="phone" class="form-control input-empty num">
      </div>
	  </div>
	  
	  <div class="col-sm-3">
        <div class="form-group">
       <label>City</label> <input required="required" type="text" name="city" value="<?php if($this->input->post('city')!='') { echo $this->input->post('city'); } ?>" class="form-control input-empty">
	   </div>
	   </div>
	   
	   <div class="col-sm-3">
        <div class="form-group">
       <label>State</label> <select name="state" class="form-control" required="required"><option selected disabled>SELECT STATE</option><option value="Andhra Pradesh">Andhra Pradesh</option><option value="Arunachal Pradesh">Arunachal Pradesh</option><option value="Assam">Assam</option><option value="Bihar">Bihar</option><option value="Chhattisgarh">Chhattisgarh</option><option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option><option value="Daman and Diu">Daman and Diu</option><option value="Delhi">Delhi</option><option value="Goa">Goa</option><option value="Gujarat">Gujarat</option><option value="Haryana">Haryana</option><option value="Himachal Pradesh">Himachal Pradesh</option><option value="Jammu and Kashmir">Jammu and Kashmir</option><option value="Jharkhand">Jharkhand</option><option value="Karnataka">Karnataka</option><option value="Kerala">Kerala</option><option value="Madhya Pradesh">Madhya Pradesh</option><option value="Maharashtra">Maharashtra</option><option value="Manipur">Manipur</option><option value="Meghalaya">Meghalaya</option><option value="Mizoram">Mizoram</option><option value="Nagaland">Nagaland</option><option value="Orissa">Orissa</option><option value="Puducherry">Puducherry</option><option value="Punjab">Punjab</option><option value="Rajasthan">Rajasthan</option><option value="Sikkim">Sikkim</option><option value="Tamil Nadu">Tamil Nadu</option><option value="Telangana">Telangana</option><option value="Tripura">Tripura</option><option value="Uttar Pradesh">Uttar Pradesh</option><option value="Uttarakhand">Uttarakhand</option><option value="West Bengal">West Bengal</option></select>
	   </div>
	   </div>
	   
	   
	   <!--div class="col-sm-3">
        <div class="form-group">
       <label>State</label> <input required="required" type="text" name="state" value="<?php if($this->input->post('state')!='') { echo $this->input->post('state'); } ?>" class="form-control input-empty">
	   </div>
	   </div-->
	   
	   <div class="col-sm-3">
        <div class="form-group">
       <label>Pincode</label> <input required="required" type="number" name="pincode" value="<?php if($this->input->post('pincode')!='') { echo $this->input->post('pincode'); } ?>" class="form-control input-empty">
	   </div>
	   </div>
	  
	  
	  <div class="col-sm-3">
	    <div class="form-group">
		 <label>Binary Placement *</label>	 <br>
		 
		 <input <?php if($this->uri->segment(4)=='Left') { echo 'checked="checked"';}?> name="position" value="left" type="radio"> <label class="check"> Left Side </label> &nbsp;
		       
		 <input <?php if($this->uri->segment(4)=='Right') { echo 'checked="checked"';}?> name="position" value="right" type="radio"> <label class="check"> Right Side </label>

		 </div>
		 </div>
	    
	   
	   
	   <div class="col-md-12 col-sm-12">
<div class="form-group">

<input type="checkbox" name="chk" required>
I accept all terms & conditions.
</div>
</div>
	   
	   
	   
	   <div class="col-md-4 col-sm-6">
     <div class="form-group">
     
       
       <label>&nbsp;</label> <input type="submit" name="submit" value="Submit" class="btn btn-primary popup-register-button">
	   </div>
	  	   
	   </div>
	  </form>
	 </div>

  
		  <?php echo form_close(); ?>
		  

</div>
</div>
</div>
