	
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
      echo form_open_multipart('admin/news/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $newsupdate[0];
	  ?>
      <div class="page-heading"> 
        <h2 class="iod">Update News Feed<ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/news'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>
		
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> news updated successfully.';
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
	   
      ?>
      
      <?php 
      //form validation
      echo validation_errors(); 
      ?>
        <fieldset> 
		
		<div id="collapse0" class="panel-collapse collapse in">
		 <input type="hidden" class="form-control" required name="rid" value="<?php echo $prod['id'];  ?>" >
	  
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Title <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="title" value="<?php if($this->input->post('title')!='') { echo $this->input->post('title'); } else { echo $prod['title']; }  ?>" >
          </div>
          </div>
		
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Status <small style="color:red">*</small></label>
             <div class="col-sm-9">  <select name="status" class="form-control custom-select">
			  <option value="active">Active</option>
			  <option <?php if($prod['status']=='deactive') { echo 'selected="selected"'; } ?> value="deactive">Deactive</option>
			  </select>
          </div> 
          </div> 
		  
		   <div class="form-group col-sm-12">
            <label  class="control-label">Discription</label>
               <textarea class="form-control " name="discription"><?php if($this->input->post('discription')!='') { echo $this->input->post('discription'); } else { echo $prod['discription']; } ?></textarea>
          </div>
		   <div class="form-group col-sm-12"> 
			<label  class="control-label col-sm-3">Type <small style="color:red">*</small></label>             <div class="col-sm-9">  <select name="type" class="form-control custom-select">		
			<option value="news">News</option>			
			<option <?php if($prod['type']=='achiever') { echo 'selected="selected"'; } ?> value="achiever">Achiever</option>			  </select>          </div>         
			</div> 
			
			
			
		  
			<div class="form-group col-sm-12 ">
      
		<label  class="control-label col-sm-3">Image</label>
               <div class="col-sm-7"> 
			   <input type="file" class="form-control"  name="image" >
			   <input type="hidden" value="<?php echo $prod['image']; ?>" name="image_old">
			   </div>
			     <div class="form-group col-sm-2">

<?php if($prod['image'] !='') { echo '<img src="'.base_url().'../assets/images/'.$prod['image'].'" width="50" height="50">'; } ?>

</div>
			    
		  
		  
          </div>
		
		
		</div>  

	</div>
				 
        </fieldset>
      <?php echo form_close(); ?>
	  

	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:350 });</script>
  
 