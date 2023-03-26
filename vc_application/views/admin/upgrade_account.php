	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 
	 .btn.btn-success {
	background: linear-gradient(to bottom, #FC8F0E, #EE353B);
	padding: 13px 20px;
	font-size: 25px;
	font-weight: 600;
	width: 100%;
	border:none;
}
.proceed {
	position: absolute;
	bottom: 8%;
	left: 7%;
	width: 41%;
}

	 </style>
      <div class="page-heading">
        <h2>Activate User</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
         if($this->session->flashdata('flash_message') == 'no_record'){
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong>Active Record Not Found. Come Back Soon.';
          echo '</div>';          
        } elseif($this->session->flashdata('flash_message') == 'already'){
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong>You Already Used Activated Your Account.';
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
      if(empty($user)) {
      echo form_open('admin/upgrade_account', $attributes);
      ?>
        <fieldset>
		   <div class="form-group col-sm-4">
            <label>Customer ID :</label>
              <input type="hidden" name="find_customer" value="yes" >
              <input type="text" class="form-control"  name="assign_to" value="<?php if($this->input->post('assign_to')!='') { echo $this->input->post('assign_to'); } ?>" >
          </div> 
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Find Customer</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin'; ?>">Back </a>
          </div>
        </fieldset>
      <?php echo form_close(); 
	  
	  } 
	  else {
		  echo form_open('admin/upgrade_account/'.$this->uri->segment(3), $attributes);
		  ?>
		 
      
        
		   <div class="form-group col-sm-12">
			<fieldset>
		   
		   
		   <?php

		   if($this->session->flashdata('flash_message') == 'activated') { ?>
             <img src="<?php echo base_url(); ?>assets/images/activate_image.jpg" alt="">
      <?php  } else { ?>
        	<img src="<?php echo base_url(); ?>assets/images/instant.jpg" alt="">
        	<input type="hidden" name="assign_to" value="<?php echo $user[0]['customer_id']; ?>" >
		   
       <!---     <p><label>Customer: </label>&nbsp;<?php echo $user[0]['f_name'].' '.$user[0]['l_name'].' ('.$user[0]['customer_id'].')';?> 
              <input type="hidden" name="assign_to" value="<?php echo $user[0]['customer_id']; ?>" >
              <input type="hidden" name="pin" value="<?php $this->uri->segment(3); ?>" ></p>
			  <p><label>Wallet Balance: </label>&nbsp;INR <?php echo $profile[0]['bliss_amount'];?></p>
			  
      
        <input type="hidden" name="product" value="1100" >
       <p><label>Activation Package: </label>&nbsp;INR 1100 + 198 (18 % GST) = INR 1298</p>   --> 	
       
	   <div class="form-group proceed">
            <button class="btn btn-success" type="submit">Proceed to Payment</button> &nbsp; 
		<!--	 <a class="btn btn-primary" href="<?php echo base_url().'admin'; ?>">Back </a>  -->
          </div>



     <?php   }

		   ?>
		   
			
		   
        </fieldset>  
		  
	  <?php 
	  echo form_close(); 
	  } ?>	
       </div> 

      

          
		  
		  <!--<p><label>package: </label>&nbsp;Rs 8000 
             </p>-->			  		  
		  
		  
		 
		   
		
		  
          
	