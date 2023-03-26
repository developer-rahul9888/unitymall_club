	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/webstores'; ?>">Back</a>
        <h2>Update webstores</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> webstores updated successfully.';
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
      
      echo form_open_multipart('admin/webstores/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $webstores[0];
      ?>
        <fieldset>
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		
		<div class="form-group col-sm-12">
            <label>Website</label>
              <input type="text" class="form-control"  name="web_name" value="<?php if($this->input->post('web_name')!='') { echo $this->input->post('web_name'); } else { echo $prod['web_name']; } ?>" >
          </div>
		  
			  
		  
		  <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label>Url</label>
              <input type="url" class="form-control"  name="web_url" value="<?php if($this->input->post('web_url')!='') { echo $this->input->post('web_url'); } else { echo $prod['web_url']; } ?>" >
          </div>
		  
		  
		  
		  
		  <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label>Image</label>
              <input type="file" class="form-control"  name="image" >
<input type="hidden" value="<?php echo $prod['web_img']; ?>" name="avtar_exist">
<?php if($prod['web_img'] !='') { echo '<img src="'.base_url().'images/webstores/'.$prod['web_img'].'" width="100">'; } ?>
          </div> 
		  
		  <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label>Status</label>
              <select name="status">
			  <option value="active">Active</option>
			  <option value="deactive">Deactive</option>
			  </select>
          </div> 
		  
		   <div class="form-group col-sm-12">
            <label>Description</label>
              <textarea class="form-control"  name="web_dis" ><?php if($this->input->post('web_dis')!='') { echo $this->input->post('web_dis'); } else { echo $prod['web_dis']; } ?></textarea>
          </div>

          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/webstores'; ?>">Cancel </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>