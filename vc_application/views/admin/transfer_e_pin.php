
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
	 
	 

      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/pins'; ?>">Back to E-pin List</a>
        <h2>Transfer PIN</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>PIN Transfer successfully.';
          echo '</div>';       
        }  else{
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
	  
      echo form_open_multipart('admin/pins/transfer', $attributes);
      ?>
	  
        <fieldset>
		
		   <div class="form-group col-sm-4">
            <label>Transfer to :</label>
              <input id="bliss_code_input" type="text" class="form-control request-code-input"  name="assign_to" value="<?php if($this->input->post('assign_to')!='') { echo $this->input->post('assign_to'); } ?>" >
			  <div id="sponsr_name"></div>
          </div>
		  
		  
		  <div class="form-group col-sm-4">
           <label>Available E-Pin:</label>
             <select name="pinid" class="form-control custom-select">
			 <?php 
foreach($available_pin as $con){ ?>
			  <option value="<?php echo $con['id'];?>"><?php echo $con['pinid'].' - '.$con['p_amount'];?></option>
			  <?php }?>
			  </select> 
          </div> 
		  
		  <div class="form-group col-sm-4">
            <label>No. of pins:</label>
              <input  type="number" class="form-control request-code-input"  name="pins" value="<?php if($this->input->post('pins')!='') { echo $this->input->post('pins'); } ?>" >
			  <div id="sponsr_name"></div>
          </div>


          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit" name="submit" value="Transfer E-Pins">Transfer E-Pins</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/pins'; ?>">Back </a>
          </div>
        </fieldset>
	 <?php echo form_close(); ?>
	