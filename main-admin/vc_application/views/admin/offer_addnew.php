	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 .iod ul{float:right}
	 .iods ul{float:right}
	 .iods{background:#ccc}
	 .remove-btn{color: #ff0000;padding: 3px 10px;	 font-size: 21px;}
	 input[type="file"]{padding:0px;}
	 
	 </style>
	 <?php 
	 //form data
      $attributes = array('class' => 'form', 'id' => '');
      echo form_open_multipart(base_url().'admin/offer/add', $attributes);
	  ?>
	  
	  <div class="page-heading">
<div id="page-content">
      <div class="page-heading"> 
        <h2 class="iod">Add Banner <ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/offer'; ?>">&laquo; Back</a><li><button type="reset" class="btn btn-primary btn-sm">Reset</button><li><button type="submit" class="btn btn-primary btn-sm">Save</button><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> offer added successfully.';
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
      //form validation
      echo validation_errors(); 
      ?>
        <fieldset> 
		
		<div id="collapse0" class="panel-collapse collapse in">
		 
	  
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Title<small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="p_name" value="<?php if($this->input->post('p_name')!='') { echo $this->input->post('p_name'); }  ?>" >
          </div>
          </div>
		
		  
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Status <small style="color:red">*</small></label>
             <div class="col-sm-9">  <select name="status" class="form-control custom-select">
			  <option value="active">Active</option>
			  <option value="deactive">Deactive</option>
			  </select>
          </div> 
          </div> 

  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Banner Type <small style="color:red">*</small></label>
             <div class="col-sm-9">  
			 <select name="product_type" class="form-control custom-select">
			  <option selected disabled>Select Banner type</option>
			  <option value="1">Home Banner-1 966*200</option>
			  <option value="2">Home Banner-2 966*200</option>
			  <option value="3">Home Banner-3 966*200</option>
			  <option value="4">Home Banner-4 966*200</option>
			  <option value="5">Home slider 1024*263</option>
			  <option value="6">Inner sidebar left add 245*200</option>
			  <option value="7">Inner sidebar right add 245*200</option>
			  <option value="8">Whats Trending? Home 245*200</option>
			  <option value="9">Business & Services  Home 245*200</option>
			  </select>
          </div> 
          </div> 
		  
		   
		  
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">URL <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="url" value="<?php if($this->input->post('url')!='') { echo $this->input->post('url'); }  ?>" >
          </div>
          </div>
		  
		   <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Category<small style="color:red">*</small></label>
            <div class="col-sm-9">  
			<select name="category" class="form-control custom-select">
			<option selected disabled value="">Select</option> 
			  <?php if(!empty($category)) {
				  foreach($category as $value) {
					  echo '<option value="'.$value['id'].'"';
					  if($this->input->post('category')==$value['id']) { echo ' selected="selected" '; }
					  echo '>'.$value['c_name'].'</option>';
				  }
			  } ?>
			  </select>
          </div>  
          </div>
		  
		  <div class="form-group col-mg-12">
        <label  class="control-label col-sm-3">Image</label>
               <div class="col-sm-9"> <input type="file" class="form-control"  name="image" ></div>
		
          </div>
		  
		 
		  
		 
		</div>  
		  
		 

				  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/product'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:400 });</script>
  </div></div>
 