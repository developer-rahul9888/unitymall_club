	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/product'; ?>">Back</a>
        <h2>Update product</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product updated successfully.';
          echo '</div>';       
        } elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
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
	  $user_id = $this->session->userdata('user_id');
	  if(!empty($product) && $product[0]['mid']==$user_id)  {
      $prod = $product[0];
	  
      echo form_open_multipart('admin/product/edit/'.$this->uri->segment(4).'', $attributes);
	  
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		
		<div class="form-group col-sm-12">
            <label>Title</label>
              <input type="text" class="form-control"  name="pname" value="<?php if($this->input->post('pname')!='') { echo $this->input->post('pname'); } else { echo $prod['pname']; } ?>" >
          </div>
		  <!--div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label>Last Name</label>
              <input type="text" class="form-control"  name="last_name" value="<?php //if($this->input->post('last_name')!='') { echo $this->input->post('last_name'); } else { echo $prod['last_name']; } ?>" >
          </div-->
          
		 
		  <div class="form-group col-sm-4">
            <label>Image</label>
              <input style="padding:0px;"  type="file" class="form-control"  name="image" >
<input type="hidden" value="<?php echo $prod['image']; ?>" name="avtar_exist">
<?php if($prod['image'] !='') { echo '<img src="'.base_url().'images/product/'.$prod['image'].'" width="100">'; } ?>
          </div> 
		  	  
			  
			  <div class="form-group col-sm-4">
            <label>Price</label>
              <input type="text" class="form-control"  name="price" value="<?php if($this->input->post('price')!='') { echo $this->input->post('price'); } else { echo $prod['price']; } ?>" >
          </div> 
		  
		  <div class="form-group col-sm-4">
            <label>Category</label>
              <select name="category" class="form-control" required="required">
			  <option value="">Select category</option>
			  <?php if(!empty($category)) {
				  foreach($category as $value) {
					  echo '<option value="'.$value['id'].'"';
					  if($prod['category']==$value['id']) { echo ' selected="selected" '; }
					  echo '>'.$value['c_name'].'</option>';
				  }
			  } ?>
			  </select>
          </div>

		   <div class="form-group col-sm-12">
            <label>Description</label>
              <textarea class="form-control"  name="description" ><?php if($this->input->post('description')!='') { echo $this->input->post('description'); } else { echo $prod['description']; } ?></textarea>
          </div>

          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/product'; ?>">Cancel </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	  <?php } else { echo '<p>Please check your url.</p>'; } ?>
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>