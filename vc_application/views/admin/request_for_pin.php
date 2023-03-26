	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	
	 </style>
	
	  <div class="content">
		<div class="content-container">
      <div class="page-heading">
        <h2>Wallet Request</h2>
      </div>

     
      
      <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open_multipart('admin/request-wallet', $attributes);
      ?>
       
	   
	    <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong>  Request Sent successfully.';
          echo '</div>';       
        } else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
		 
		  <div class="form-group col-sm-6">
            <label> Amount</label>
              <input type="text" class="form-control"  name="amount" value="<?php if($this->input->post('amount')!='') { echo $this->input->post('amount'); }  ?>" >
          </div>
		  <div class="form-group col-sm-6">
            <label> Mobile No.</label>
              <input type="int" class="form-control"  name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); }  ?>" >
          </div>
		   <div class="form-group col-sm-6">
            <label> UTR No.</label>
              <input type="text" class="form-control"  name="neft" value="<?php if($this->input->post('neft')!='') { echo $this->input->post('neft'); }  ?>" >
          </div>
		  
		  
		   <div class="form-group col-sm-6">
            <label> Bank Name</label>
              <input type="text" class="form-control"  name="bank_name" value="<?php if($this->input->post('bank_name')!='') { echo $this->input->post('bank_name'); }  ?>" >
          </div>
		   <div class="form-group col-sm-6">
            <label>Bank branch</label>
              <input type="text" class="form-control"  name="bank_branch" value="<?php if($this->input->post('bank_branch')!='') { echo $this->input->post('bank_branch'); }  ?>" >
          </div>
		   <div class="form-group col-sm-6">
            <label> Account No.</label>
              <input type="text" class="form-control"  name="account_no" value="<?php if($this->input->post('account_no')!='') { echo $this->input->post('account_no'); }  ?>" >
          </div>
		  
		  <div class="form-group col-sm-6">
		  
		   <div class="form-group">
            <label> IFSC Code</label>
              <input type="text" class="form-control"  name="ifsc" value="<?php if($this->input->post('ifsc')!='') { echo $this->input->post('ifsc'); }  ?>" >
          </div>
		  
	
		  <div class="form-group">
            <label>Image</label>
              <input type="file" class="form-control" required name="image"  >
          </div>

		
		  
         <div class="form-group ">
            <label>Description</label>
              <textarea class="form-control" required name="description" value="<?php if($this->input->post('description')!='') { echo $this->input->post('description'); } ?>" ></textarea>
          </div>
		  
		  </div>
		  
		  <div class="form-group col-lg-6 col-md-6 col-sm-6">
			  <div class="form-group col-lg-7 col-md-7 col-sm-7">
				<label>Amount Credited In :- </label>
				 <p class="text-left"><b> Company Name : </b>  Unity Mall</p>
				 <p class="text-left"><b> Bank Name : </b>  ********</p>
				 <p class="text-left"><b> Account No. :</b>   ********</p>
				 <p class="text-left"><b> IFSC Code :</b>  ********</p>
				 <p class="text-left"><b> Account Type :</b> ********</p>
				
				  
			  </div>
			 <!-- <div class="form-group col-lg-5 col-md-5 col-sm-5">
				<div class="img122">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/barcodee.jpg">
				</div>
			  </div>-->
          </div>
		  
		  <div class="col-lg-12 col-md-12">
          <div class="form-group  req-btn">
            <button class="btn btn-primary" type="submit">Send Request</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/pin_request'; ?>">Cancel </a>
          </div>
		  </div>
		  
		  

      <?php echo form_close(); ?>
	  
	  </div>
	  </div>
	 
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>