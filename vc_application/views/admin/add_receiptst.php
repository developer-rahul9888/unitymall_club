	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/uploadreceipts'; ?>">Back</a>
        <h2>Upload Bill </h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {   
			echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
			echo '<strong>Well done!</strong> Receipt of Bill upload successfully.';
			echo '</div>';      
			
        } else{
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';

          echo '</div>';          
        }
      }
	  

      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

 
      echo validation_errors();
	
      
      echo form_open_multipart('admin/uploadreceipts/add', $attributes);
      ?>
        <fieldset> 
		
		<div class="form-group col-sm-12">
            <label>website</label>
              <input type="text" class="form-control"  name="websites" value="<?php if($this->input->post('websites')!='') { echo $this->input->post('websites'); }  ?>" >
          </div>	

		  <div class="form-group col-sm-12">
            <label>Product</label>
              <input type="text" class="form-control"  name="p_name" value="<?php if($this->input->post('p_name')!='') { echo $this->input->post('p_name'); }  ?>" >
          </div>
		

		   <div class="form-group col-sm-4">
            <label>Amount</label>
              <input type="number" required="required" class="form-control"  name="amount" value="<?php if($this->input->post('amount')!='') { echo $this->input->post('amount'); }  ?>" >
          </div>
		  		  <div class="form-group col-sm-4">
            <label>Image</label>
              <input style="padding:0px;" type="file" class="form-control"  name="image" value="<?php if($this->input->post('image')!='') { echo $this->input->post('image'); }  ?>" >
          </div> 
			  
		  <div class="form-group col-sm-12">
            <label>Descriptions</label>
              <textarea class="form-control" required="required" name="p_discription" value="<?php if($this->input->post('p_discription')!='') { echo $this->input->post('p_discription'); } ?>" ></textarea>
          </div>
		 <div class="col-lg-12 col-md-12">
			  <div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button> &nbsp; 
				 <a class="btn btn-primary" href="<?php echo base_url().'admin/uploadreceipts'; ?>">Cancel  </a>
			  </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	  