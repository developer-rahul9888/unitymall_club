	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/customer'; ?>">Back</a>
        <h2>Update Distributor </h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Distributor updated successfully.';
          echo '</div>';       
        } elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
            echo '</div>';  
		} else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  //print_r($restaurants);
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open_multipart('admin/customer/edit/'.$this->uri->segment(4).'', $attributes);
	  $user = $customer[0];
      ?>
      
	  <fieldset>
<input type="hidden" value="<?php echo $user['id']; ?>" name="cid">
		<input type="hidden" value="<?php echo $user['var_status']; ?>" name="var_status">

		<p>&nbsp;</p>


		 <div class="form-group col-sm-2">
            <label>Unique Code</label>
              <input type="text" class="form-control" readonly  name="bsacode" value="<?php echo $user['customer_id'];?>" >
          </div>
		  
		<div class="form-group col-sm-3">
            <label>Image</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="image" >
<input type="hidden" value="<?php echo $user['image']; ?>" name="image_old">
          </div>  
		  <div class="form-group col-sm-2">
<?php if($user['image'] !='') { echo '<img src="http://maxaura.dndmarket.com/images/user/'.$user['image'].'" width="50" height="50">'; } ?>
</div>

<div class="form-group col-sm-2">
            <label>Sponsor Code</label>
              <input type="text" class="form-control" readonly   value="<?php echo $user['parent_customer_id'];?>" >
          </div>
		  
		
          
        <div class="form-group col-sm-3">
            <label>First Name</label>
              <input type="text" class="form-control"  name="f_name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } else { echo $user['f_name']; } ?>" >
          </div>
		 
        <div class="form-group col-sm-3">
            <label>Last Name</label>
              <input type="text" class="form-control" name="l_name" value="<?php if($this->input->post('l_name')!='') { echo $this->input->post('l_name'); } else { echo $user['l_name']; } ?>" >
          </div>
		  <div class="form-group col-sm-3">
            <label>DOJ</label>
              <input type="text" class="form-control" readonly  value="<?php echo $user['rdate'];?>" >
          </div>


		 
		  
		  <div class="form-group col-sm-3">
            <label>Phone</label>
              <input type="number" class="form-control"  name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $user['phone']; } ?>" >
          </div>
		  
        <div class="form-group col-sm-3">
            <label>Email</label>
              <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" >
          </div>
		  
		  <div class="form-group col-sm-4">
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
        <div class="form-group col-sm-2">
            <label>Pincode</label>
              <input type="number" class="form-control"  name="pincode" value="<?php if($this->input->post('pincode')!='') { echo $this->input->post('pincode'); } else { echo $user['pincode']; } ?>" >
          </div>
		  
<div class="form-group col-sm-2">
            <label>Gender</label>
			<select class="form-control"  name="gender">
            <option selected disabled value="">Select gender</option>
            <option <?php if($user['gender']=='Male') { echo 'selected="selected"'; } ?> value="Male">Male</option>
			<option <?php if($user['gender']=='Female') { echo 'selected="selected"'; } ?> value="Female">Female</option>
			</select>
          </div>
		   <div class="clearfix"></div>
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
		
 <div class="clearfix"></div>
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
           <?php if($user['panimage'] !='') { echo '<a href="http://maxaura.dndmarket.com/images/user/'.$user['panimage'].'" target="_blank"><img src="http://maxaura.dndmarket.com/images/user/'.$user['panimage'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>
 <div class="clearfix"></div>
        <div class="form-group col-sm-6">
            <label>Aadhar No</label>
              <input type="text" class="form-control"  name="aadhar" value="<?php if($this->input->post('aadhar')!='') { echo $this->input->post('aadhar'); } else { echo $user['aadhar']; } ?>" >
			  </div>
		  <div class="form-group col-sm-4">
			   <label>Upload Aadhar</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="aadharimage">
			  <input type="hidden" value="<?php echo $user['aadharimage']; ?>" name="aadharimage_old">
			
          </div>
		  
		  <div class="form-group col-sm-2">
           <?php if($user['aadharimage'] !='') { echo '<a href="http://maxaura.dndmarket.com/images/user/'.$user['aadharimage'].'" target="_blank"><img src="http://maxaura.dndmarket.com/images/user/'.$user['aadharimage'].'" style="width:auto;max-width:64px;"></a>'; } ?>
          </div>
		  
		  
		   <div class="clearfix"></div>
		  <div class="form-group col-sm-3">
            <label>Status</label>
             <select name="status" class="form-control custom-select">
			  <option <?php if($user['status']=='active') { echo 'selected="selected"'; } ?> value="active">Active</option>
			  <option <?php if($user['status']=='deactive') { echo 'selected="selected"'; } ?> value="deactive">Deactive</option>
			  </select>
          </div>
		  
		   <div class="form-group col-sm-3">
            <label>Password</label>
              <input type="text" class="form-control" name="newpassword" value="<?php if($this->input->post('password')!='') { echo $this->input->post('password'); }?>" >
			  <input type="hidden" name="oldpassword" value="<?php echo $user['pass_word']; ?>">
          </div>
		  
		   <div class="form-group col-sm-3">
            <label>Transactional PIN</label>
              <input type="text" class="form-control" name="newtrpin" value="<?php if($this->input->post('newtrpin')!='') { echo $this->input->post('newtrpin'); }?>" >
			  <input type="hidden" name="oldtrpin" value="<?php echo $user['tr_pin']; ?>">
          </div>
          
		  <div class="form-group col-sm-3">
            <label>Earned amount</label>
              <input type="text" class="form-control" disabled  value="<?php if($this->input->post('bliss_amount')!='') { echo $this->input->post('bliss_amount'); } else { echo $user['bliss_amount']; } ?>" >
          </div>		  		  		  		   <div class="form-group col-sm-6">            <label>Franchise</label>             <select name="franchise" class="form-control custom-select">			  <option <?php if($user['franchise']=='1') { echo 'selected="selected"'; } ?> value="1">Yes</option>			  <option <?php if($user['franchise']=='0') { echo 'selected="selected"'; } ?> value="0">No</option>			  </select>          </div> 		  		  		  		  		  		  		  		  		  		  		  		  		  		  		  		  
		  
		  <input type="hidden" name="bliss_amount" value="<?php echo $user['bliss_amount']; ?>">
		  
		  <div class="form-group col-sm-3">
            <label>Add amount</label>
              <input type="text" class="form-control"  name="add_amt" value="<?php if($this->input->post('add_amt')!='') { echo $this->input->post('add_amt'); } ?>" >
          </div>
		  
		   <div class="form-group  col-lg-12 hide">
            <p><input type="checkbox" name="terms" checked  value="yes"> By clicking become an distributor, you are agreeing to the privacy policy and the terms & conditions of the Gangland</p>
          </div>
		  
		  
		  <h4 style="text-align:center;clear:both;padding-top:20px; color:#fe980f;">Enter Bank Details</h4>
		<div class="col-sm-3 form-group"><label>Bank Name</label> <input  type="text" name="bank_name" value="<?php if($this->input->post('bank_name')!='') { echo $this->input->post('bank_name'); }else { echo $user['bank_name']; } ?>" class="form-control"></div>
		
		<div class="col-sm-3 form-group"><label>Branch</label> <input  type="text" name="branch" value="<?php if($this->input->post('branch')!='') { echo $this->input->post('branch'); }else { echo $user['branch']; } ?>" class="form-control"></div>
	
		
		<div class="col-sm-3 form-group"><label>State</label> <input  type="text" name="bank_state" value="<?php if($this->input->post('bank_state')!='') { echo $this->input->post('bank_state'); }else { echo $user['bank_state']; } ?>" class="form-control"></div>
		
		<div class="col-sm-3 form-group "><label>Account Name</label> <input type="text" name="account_name" value="<?php if($this->input->post('account_name')!='') { echo $this->input->post('account_name'); }else { echo $user['account_name']; } ?>" class="form-control"></div>
		
		<div class="col-sm-3 form-group "><label>Account Type</label> <input type="text" name="account_type" value="<?php if($this->input->post('account_type')!='') { echo $this->input->post('account_type'); }else { echo $user['account_type']; } ?>" class="form-control"></div>
		
		<div class="col-sm-3 form-group"><label>Account No.</label> <input  type="number" name="account_no" value="<?php if($this->input->post('account_no')!='') { echo $this->input->post('account_no'); }else { echo $user['account_no']; } ?>" class="form-control"></div>
		
		<div class="col-sm-3 form-group"><label>IFSC Code</label> <input  type="text" name="ifsc" value="<?php if($this->input->post('ifsc')!='') { echo $this->input->post('ifsc'); }else { echo $user['ifsc']; } ?>" class="form-control"></div>
		
		
		
		<div class="col-sm-12 form-group"><label style="font-weight:normal"><input checked type="checkbox" name="declare" value="1"> I hereby declared that the details furnished above correct to the best of my knowledge and belief. </label></div>
		  
		  
		  
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp;  
          </div>
		  
		  </fieldset>
	  
	  
	  <?php echo form_close(); ?>
	  
	  <!--script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script-->