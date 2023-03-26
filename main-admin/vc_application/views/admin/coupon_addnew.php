	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/coupon'; ?>">Back</a>
        <h2>Add new pin</h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> pin added successfully.';
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
      
      echo form_open_multipart('admin/coupon/add', $attributes);
      ?>
        <fieldset> 
		<div class="form-group col-sm-12">
            <label>Title</label>
              <input type="text" class="form-control"  name="title" value="<?php if($this->input->post('title')!='') { echo $this->input->post('title'); }  ?>" >
          </div>
		<div class="form-group col-sm-6">
            <label>Code</label>
              <input type="text" class="form-control"  name="code" value="<?php if($this->input->post('code')!='') { echo $this->input->post('code'); }  ?>" >
          </div>
	
		  <div class="form-group col-sm-6">
            <label>Amount</label>
              <input type="text" class="form-control"  name="amount" value="<?php if($this->input->post('amount')!='') { echo $this->input->post('amount'); }  ?>" >
          </div>
		  
		  <div class="form-group col-sm-6">
           <label>Type<small style="color:red">*</small></label>
             <select name="type" class="form-control custom-select">
			  <option value="Percentage">Percentage</option>
			  <option value="Fixed">Fixed</option>
			  </select> 
          </div> 
		  

		   <div class="form-group col-sm-6">
            <label>Per User Limit</label>
              <input type="text" class="form-control"  name="per_user" value="<?php if($this->input->post('per_user')!='') { echo $this->input->post('per_user'); } ?>" >
			  <span style="font-size:11px;">Please keep it 0 if you don't want set limit</span>
          </div>

 <div class="form-group col-sm-4">
            <label>Start date</label>
              <input id="datepicker" type="text" class="form-control"  name="start_date" value="<?php if($this->input->post('start_date')!='') { echo $this->input->post('start_date'); }  ?>" >
          </div>
			
			<div class="form-group col-sm-4">
            <label>End date</label>
              <input id="datepicker1" type="text" class="form-control"  name="end_date" value="<?php if($this->input->post('end_date')!='') { echo $this->input->post('end_date'); }  ?>" >
          </div>

<div class="form-group col-sm-4">
           <label>Status<small style="color:red">*</small></label>
             <select name="status" class="form-control custom-select">
			  <option value="Active">Active</option> 
			  <option value="Deactive">Deactive</option>
			  </select> 
          </div> 

		  
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/coupon'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>