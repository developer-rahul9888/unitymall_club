	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/merchant'; ?>">Back</a>
        <h2>Update merchant</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> merchant updated successfully.';
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
      
      echo form_open_multipart('admin/merchant/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $merchant[0];
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		
		<div class="form-group col-sm-6">
            <label>Display Name</label>
              <input type="text" class="form-control"  name="d_name" value="<?php if($this->input->post('d_name')!='') { echo $this->input->post('d_name'); } else { echo $prod['d_name']; } ?>" >
          </div>
		  <div class="form-group col-sm-6">
            <label>Merchant ID</label>
              <input type="text" class="form-control"  name="merchant_id" readonly value="<?php if($this->input->post('merchant_id')!='') { echo $this->input->post('merchant_id'); } else { echo $prod['merchant_id']; } ?>" >
          </div>
		  <div class="form-group col-sm-6">
            <label>Email</label>
              <input type="text" class="form-control"  name="email" value="<?php if($this->input->post('email')!='') { echo $this->input->post('email'); } else { echo $prod['email']; } ?>" >
          </div>
		 
		  <div class="form-group col-sm-6">
            <label>Phone</label>
             <input type="text" class="form-control"  name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $prod['phone']; } ?>" >
          </div>
			
		  <div class="form-group col-sm-6">
            <label>Password</label>
			  <input type="text" class="form-control"  name="pass_word" value="" >
			  <span style="font-size:12px;">Please keep it blank if you don't want change.</span>
          </div>  <div class="form-group col-sm-6">            
		  
		  
		  <label>GST No</label>             
		  <input type="text" class="form-control" readonly name="gst" value="<?php if($this->input->post('gst')!='') { echo $this->input->post('gst'); } else { echo $prod['gst']; } ?>" >          </div>		  		  		  		  		  
		  <div class="form-group col-sm-6">            
		  
		  
		  <label>Store Name</label>             
		  <input type="text" class="form-control" readonly  name="store_name" value="<?php if($this->input->post('store_name')!='') { echo $this->input->post('store_name'); } else { echo $prod['store_name']; } ?>" >          </div>		  		  		  		  		  		  		  		  		  		  
  <div class="form-group col-sm-6">            <label>Phone</label>             <input type="text" class="form-control"  name="phone" value="<?php if($this->input->post('phone')!='') { echo $this->input->post('phone'); } else { echo $prod['phone']; } ?>" >          </div>
		  <div class="form-group col-sm-6">
            <label>Status</label>
			<select name="status" class="form-control">
			<option <?php if($prod['status']=='active') { echo 'selected="selected"'; } ?> value="active">Active</option>
			<option <?php if($prod['status']=='deactive') { echo 'selected="selected"'; } ?> value="deactive">Deactive</option>
			</select>
          </div>
			
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/merchant'; ?>">Cancel </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>