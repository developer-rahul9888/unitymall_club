	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/pin'; ?>">Back</a>
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
      
      echo form_open_multipart('admin/pin/add', $attributes);
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
			<?php
			if(!empty($package)) {
				foreach($package as $pack) {
					echo '<option value="'.$pack['id'].'">'.$pack['title'].' ('.$pack['amount'].')</option>';
				}
			}

			?>
			  
			 
			  </optgroup>
			   

			  </select> 
			  
          </div> 
		   
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Generate</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/pin'; ?>">Back </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	   