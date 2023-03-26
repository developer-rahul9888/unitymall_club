	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"> 
        <h2>Website Setting</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> Setting updated successfully.';
          echo '</div>';       
        }  else {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong> change a few things up and try submitting again.';
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
      
      echo form_open(base_url('admin/setting'), $attributes);
	  $setting = $all_setting[0];
      ?>
        <fieldset> 
		
		<div class="form-group col-sm-12 hide">
            <label>Title</label>
              <input type="text" class="form-control"  name="title" value="<?php //if($this->input->post('title')!='') { echo $this->input->post('title'); } else { echo $setting['title']; } ?>" >
          </div>
		  
		     <div class="form-group col-sm-3">
            <label>Maintenance</label>
              <select name="maintenance" class="form-control">
			  <option value="No">No</option>
			  <option <?php if($setting['maintenance']=='Yes') { echo 'selected="selected"'; } ?> value="Yes">Yes</option>
			  </select>
          </div> 
		  

          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/'; ?>">Cancel </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	   