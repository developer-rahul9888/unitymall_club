	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="#">Back to E-pin List</a>
        <h2>Activate Account</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> pin updated successfully.';
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
      
      echo form_open_multipart('#', $attributes);
      ?>
        <fieldset>
		
		   <div class="form-group col-sm-4">
            <label>Your PIN :</label>
              <input type="text" class="form-control"  name="assign_to" value="<?php if($this->input->post('assign_to')!='') { echo $this->input->post('assign_to'); } ?>" >
          </div>
		  


          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Activate</button> &nbsp; 
			 <a class="btn btn-primary" href="#">Back </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	