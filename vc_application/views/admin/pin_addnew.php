	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/pins'; ?>">Back</a>
        <h2>Generate New PIN</h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> PIN added successfully.';
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
      
      echo form_open_multipart('admin/pin_addnew', $attributes);
      ?>
        <fieldset>  
	
		  <div class="form-group col-sm-4">
            <label>No. of E-Pin:</label>
              <input type="text" class="form-control"  name="pins" value="<?php if($this->input->post('pins')!='') { echo $this->input->post('pins'); }  ?>" >
          </div>
		  

		  
		  
		  <div class="form-group col-sm-4">
           <label>Plan Package:<small style="color:red">*</small></label>
             <select name="pinid" class="form-control custom-select">
			 <optgroup label="Purchase">
			
			  <option value="1~1000">JOINING PACK (1000)</option>
			
			  </optgroup>
			  
			 <!--  <optgroup label="Upgrade">
			
			  <option value="4~1400">UPGRADE PACK (1400)</option>
			  <option value="5~4900">UPGRADE PACK (4900)</option>
			  <option value="6~10500">UPGRADE PACK (10500)</option>
			  <option value="7~25200">UPGRADE PACK (25200)</option>
			  <option value="8~49000">UPGRADE PACK (49000)</option>
			  <option value="9~100100">UPGRADE PACK (100100)</option>
			  <option value="10~149100">UPGRADE PACK (149100)</option>
			  </optgroup> -->

			  </select> 
			  
          </div>  
		
		 <div class="form-group col-sm-4">
           <label>Wallet Amount</label>
		    <input type="text" readonly class="form-control"  name="wallet" value="<?php echo $profile[0]['wallet']; ?>" >
		   </div>
		
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Generate</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/pins'; ?>">Back </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	   