<div class="col-sm-12">
<?php 
$user = $profile[0]; 
?>
<h2>Welcome <?php echo ucfirst($this->session->userdata('full_name'));?></h2>

</div>
<div class="col-sm-12 right-bar">

<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Profile updated successfully.';
          echo '</div>';       
        } /*elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
            echo '</div>';  
		}*/
      }
	  
	  if($user['var_status']=='no') { 
              echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your profile is under review please wait 2 working days';
          echo '</div>';
           }
	  
echo validation_errors(); 

	   $attributes = array('class' => 'form');
      echo form_open_multipart(base_url().'admin/profile', $attributes);
      ?>
	  
		<input type="hidden" value="<?php echo $user['id']; ?>" name="cid">
		<input type="hidden" value="<?php echo $user['var_status']; ?>" name="var_status">

		<p>&nbsp;</p>
<p>Reference URL: <strong><?php echo base_url().'reference/'.$user['customer_id'];?></strong></p>
<p>&nbsp;</p>
         <div class="clearfix"></div>
<div class="widget col-md-12">
                    <div class="widget-title">
                        <h4> <i class="icon-tags"></i>Personal Details</h4>
                    </div>
                    <div class="widget-body">
		 <div class="form-group col-sm-3">
            <label>RD Code</label>
              <input type="text" class="form-control" readonly  name="bsacode" value="<?php echo $user['customer_id'];?>" >
          </div>
		  
		<div class="form-group col-sm-3">
            <label>Image</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="image" >
<input type="hidden" value="<?php echo $user['image']; ?>" name="image_old">
          </div>  
		<div class="form-group col-sm-3">
<?php if($user['image'] !='') { echo '<img src="'.base_url().'images/user/'.$user['image'].'" width="100">'; } ?>
</div>

        <div class="form-group col-sm-3">
            <label>First Name</label>
              <input type="text" class="form-control" <?php if($user['f_name']!=''){echo "readonly";}?>  name="f_name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } else { echo $user['f_name']; } ?>" >
          </div>
        <div class="form-group col-sm-3">
            <label>Last Name</label>
              <input type="text" class="form-control" <?php if($user['l_name']!=''){echo "readonly";}?>  name="l_name" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } else { echo $user['l_name']; } ?>" >
          </div>

		  <div class="form-group col-sm-3">
            <label>Gender</label>
			<select class="form-control"  name="gender">
            <option selected disabled value="">Select gender</option>
            <option <?php if($user['gender']=='Male') { echo 'selected="selected"'; } ?> value="Male">Male</option>
			<option <?php if($user['gender']=='Female') { echo 'selected="selected"'; } ?> value="Female">Female</option>
			</select>
          </div>
        <div class="form-group col-sm-3">
            <label>Date of Birth</label>
              <input type="text" class="form-control" <?php if($user['dob']!=''){echo "readonly";}?> placeholder="DD-MM-YYYY" name="dob" value="<?php if($this->input->post('dob')!='') { echo $this->input->post('dob'); } else { echo $user['dob']; } ?>" >
          </div>
		  
		   </div><!---widget body--->
                </div>
				
				<div class="clearfix"></div>
<div class="widget col-md-12">
                    <div class="widget-title">
                        <h4> <i class="icon-tags"></i>Contact Details</h4>
                    </div>
                    <div class="widget-body">
		  
		  <div class="form-group col-sm-3">
            <label>Phone</label>
              <input type="number" class="form-control" <?php if($user['phone']!=''){echo "readonly";}?>  name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $user['phone']; } ?>" >
          </div>
        <div class="form-group col-sm-3">
            <label>Email</label>
              <input type="email" class="form-control"  name="email" value="<?php echo $user['email']; ?>" >
          </div>
		  
		  <div class="form-group col-sm-3">
            <label>Address</label>
              <input type="text" class="form-control"  name="address" value="<?php if($this->input->post('address')!='') { echo $this->input->post('address'); } else { echo $user['address']; } ?>" >
          </div>
        <div class="form-group col-sm-3">
            <label>City</label>
              <input type="text" class="form-control"  name="city" value="<?php if($this->input->post('city')!='') { echo $this->input->post('city'); } else { echo $user['city']; } ?>" >
          </div>
		  
		  <div class="form-group col-sm-3">
            <label>State</label>
              <input type="text" class="form-control"  name="state" value="<?php if($this->input->post('state')!='') { echo $this->input->post('state'); } else { echo $user['state']; } ?>" >
          </div>
        <div class="form-group col-sm-3">
            <label>Pincode</label>
              <input type="number" class="form-control"  name="pincode" value="<?php if($this->input->post('pincode')!='') { echo $this->input->post('pincode'); } else { echo $user['pincode']; } ?>" >
          </div>
          </div>
          </div>
		  
		  				
				<div class="clearfix"></div>
<div class="widget col-md-12">
                    <div class="widget-title">
                        <h4> <i class="icon-tags"></i>Nominee Details</h4> 
                    </div>
                    <div class="widget-body">
		  <div class="form-group col-sm-3">
            <label>Nominee Name*</label>
              <input type="text" class="form-control"  name="nominee" value="<?php if($this->input->post('nominee')!='') { echo $this->input->post('nominee'); } else { echo $user['nominee']; } ?>" >
          </div>
        <div class="form-group col-sm-3">
            <label>Nominee Relation*</label>
              <input type="text" class="form-control"  name="nominee_rel" value="<?php if($this->input->post('nominee_rel')!='') { echo $this->input->post('nominee_rel'); } else { echo $user['nominee_rel']; } ?>" >
          </div>
        <div class="form-group col-sm-3">
            <label>Nominee DOB</label>
              <input type="text" class="form-control" placeholder="DD-MM-YYYY" name="nominee_dob" value="<?php if($this->input->post('nominee_dob')!='') { echo $this->input->post('nominee_dob'); } else { echo $user['nominee_dob']; } ?>" >
          </div>
          </div>
          </div>

          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp;  
          </div>
		  
		  <?php echo form_close(); ?>
		  
</div>
