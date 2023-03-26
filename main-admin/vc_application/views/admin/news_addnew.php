	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/news'; ?>">Back</a>
        <h2>Add New News Feed</h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> News added successfully.';
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
      
      echo form_open_multipart('admin/news/add', $attributes);
      ?>
        <fieldset class="additionn"> 
		
		
		<div class="form-group col-sm-12">
            <label>Title</label>
              <input type="text" class="form-control"  name="title" value="<?php if($this->input->post('title')!='') { echo $this->input->post('title'); }  ?>" >
          </div>
		
		
		 <div class="form-group col-sm-12">
            <label  class="control-label">Discription</label>
               <textarea class="form-control " name="discription"><?php if($this->input->post('discription')!='') { echo $this->input->post('discription'); } ?></textarea>
          </div>
		  	 <div class="form-group ">           <label  class="control-label col-sm-3">Type <small style="color:red">*</small></label>             <div class="col-sm-9">  <select name="type" class="form-control custom-select">			  <option value="news">News</option>			  <option value="achiever">Achiever</option>			  </select>          </div>           </div> 
			 
		<div class="form-group ">           
		<label  class="control-label col-sm-3">Status <small style="color:red">*</small></label>       
		<div class="col-sm-9">  <select name="status" class="form-control custom-select">			  <option value="active">Active</option>			  <option value="deactive">Deactive</option>			  </select>          </div>          
		</div> 
		
		<div class="form-group ">
      
		<label  class="control-label col-sm-3">Image</label>
               <div class="col-sm-9"> 
			   <input type="file" class="form-control"  name="image" ></div>
			    
		  
		  
          </div>
       
		  
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/news'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>