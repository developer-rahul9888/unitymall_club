	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/seo'; ?>">Back</a>
        <h2>Add new seo</h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> seo added successfully.';
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
      
      echo form_open_multipart('admin/seo/add', $attributes);
      ?>
        <fieldset> 
		<div class="form-group col-sm-12">
            <label>Url</label>
              <input type="text" class="form-control"  name="url" value="<?php if($this->input->post('url')!='') { echo $this->input->post('url'); }  ?>" >
          </div>
		
		<div class="form-group col-sm-12">
            <label>Title</label>
              <input type="text" class="form-control"  name="title" value="<?php if($this->input->post('title')!='') { echo $this->input->post('title'); }  ?>" >
          </div>
		
		
		<div class="form-group col-sm-12">
            <label>Discription</label>
              <input type="text" class="form-control"  name="discription" value="<?php if($this->input->post('discription')!='') { echo $this->input->post('discription'); }  ?>" >
          </div>
		  
		  <div class="form-group col-sm-12">
            <label>Keyword</label>
              <input type="text" class="form-control"  name="keyword" value="<?php if($this->input->post('keyword')!='') { echo $this->input->post('keyword'); }  ?>" >
          </div>
		
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/seo'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>