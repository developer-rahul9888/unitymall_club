	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/package'; ?>">Back</a>
        <h2>Generate New PIN</h2>
      </div>
  
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> Package added successfully.';
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
      
      echo form_open_multipart('admin/package/add', $attributes);
      ?>
        <fieldset>  
	
		  <div class="form-group col-sm-4">
            <label>Title</label>
              <input type="text" class="form-control"  name="title" value="<?php if($this->input->post('title')!='') { echo $this->input->post('title'); }  ?>" >
          </div>
		  
		  
		 <div class="form-group col-sm-4">
            <label>Amount</label>
              <input type="text" class="form-control"  name="amount" value="<?php if($this->input->post('amount')!='') { echo $this->input->post('amount'); }  ?>" >
          </div>
		  
		    <div class="form-group col-sm-4">
            <label>PV / Percentage For Repurchase Pin</label>
              <input type="text" class="form-control"  name="pv" value="<?php if($this->input->post('pv')!='') { echo $this->input->post('pv'); }  ?>" >
          </div>
		  <div class="form-group col-sm-4">
            <label>Capping</label>
              <input type="text" class="form-control"  name="capping" value="<?php if($this->input->post('capping')!='') { echo $this->input->post('capping'); }  ?>" >
          </div>
		  
		  <div class="form-group col-sm-4">
            <label>Percentage</label>
              <input type="text" class="form-control"  name="percentage" value="<?php if($this->input->post('percentage')!='') { echo $this->input->post('percentage'); }  ?>" >
          </div>
		  
		  
 <div class="form-group col-sm-4">
            <label>Franchisee</label>
              <select name="franchisee" class="form-control custom-select">   
        <option value="0">No</option>    
        <option  value="1">Yes</option>
        </select> 
          </div>

		   <div class="form-group col-sm-4">
            <label>Status</label>
              <select name="status" class="form-control custom-select">		
			  <option value="active">Active</option>		
			  <option  value="deactive">Deactive</option>
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
	   