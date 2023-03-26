
  <div class="content">
    <div class="content-container">

<div class="col-sm-6 right-bar">



<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'password')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Password updated successfully.';
          echo '</div>';       
        } 
		
		if($this->session->flashdata('flash_message') == 'pin')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Pin updated successfully.';
          echo '</div>';       
        }
      }
	  
echo validation_errors(); 

	   $attributes = array('class' => 'form');
      echo form_open(base_url().'admin/password', $attributes);
      ?>
	  
	  <h2>Update Password</h2>
	  
	  <div class="col-sm-12">
         <input type="hidden" name="old_password_validate">
		 <div class="form-group col-sm-12">
            <label>Current Password:</label>
             <input type="password" name="old_password" placeholder="Current Password" required class="form-control">
          </div>

        <div class="form-group col-sm-12">
            <label>New Password:</label>
			<input type="password" name="newpassword" placeholder="New Password" required class="form-control" value="<?php if($this->input->post('newpassword')!='') { echo $this->input->post('newpassword'); } ?>">
			
          </div>
        <div class="form-group col-sm-12">
            <label>Retype New Password:</label>
			
			<input type="password" name="Retype_password" placeholder="Retype New Password" required class="form-control"
			value="<?php if($this->input->post('Retype_password')!='') { echo $this->input->post('Retype_password'); } ?>">
			
          </div>
<div class="clearfix"></div>
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" name="update" value="update" type="submit">Update</button> &nbsp;  
          </div>
		  
		  </div>
		  
		  <?php echo form_close(); ?>
		  

</div>


<div class="col-sm-6 right-bar hide">


		  
	 <?php
	   $attributes = array('class' => 'form');
      echo form_open(base_url().'admin/password', $attributes);
      ?>
		  
		  
		 
		  <h2>Security Code</h2>
		  <div class="col-sm-12">
		  <input type="hidden" name="old_pin_validate">
		  <div class="form-group col-sm-12">
            <label>Current Pin:</label>
             <input type="password" name="old_pin" placeholder="Current Pin" required class="form-control">
          </div>

        <div class="form-group col-sm-12">
            <label>New Pin:</label>
			<input type="password" name="newpin" placeholder="New Pin" required class="form-control" value="<?php if($this->input->post('newpin')!='') { echo $this->input->post('newpin'); } ?>">
			
          </div>
        <div class="form-group col-sm-12">
            <label>Retype New Pin:</label>
			
			<input type="password" name="Retype_pin" placeholder="Retype New Pin" required class="form-control"
			value="<?php if($this->input->post('Retype_pin')!='') { echo $this->input->post('Retype_pin'); } ?>">
			
          </div>
<div class="clearfix"></div>
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" name="updatepin" value="update" type="submit">Update</button> &nbsp;  
          </div>
		  
		  </div>
		  
		  <?php echo form_close(); ?>	  
		  
		  
		  
</div>


</div>
</div>
