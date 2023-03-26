	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/bonanza_list'; ?>">Back</a>
        <h2>Update Bonanza</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Distributor updated successfully.';
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
      
      echo form_open_multipart('admin/bonanza/edit/'.$this->uri->segment(4).'', $attributes);
	 
      ?>  
      
	  <fieldset>


		   <div class="form-group col-sm-3">
          <label>Start Date</label>
            <input type="text" class="form-control" id="datepicker"  name="start_date" value="<?php echo $bonanza_data[0]['start_date'] ; ?>" >
          </div>
         
		
		  
         <div class="form-group col-sm-3">
            <label>End Date</label>
              <input type="text" class="form-control" id="datepicker1"  name="end_date" value="<?php echo $bonanza_data[0]['end_date'];?>" >
          </div>
		  
       

		
		  
		
          
        <div class="form-group col-sm-3">
            <label>LSB</label>
              <input type="text" class="form-control"  name="lbv" value="<?php echo $bonanza_data[0]['lbv'];?>" >
          </div>
		 
        <div class="form-group col-sm-3">
            <label>RSB</label>
              <input type="text" class="form-control" name="rbv" value="<?php echo $bonanza_data[0]['rbv'];?>" >
          </div>
		  <div class="form-group col-sm-3">
            <label>Reward</label>
              <input type="text" class="form-control" name="reward"  value="<?php echo $bonanza_data[0]['reward'];?>" >
          </div>

 <div class="form-group col-sm-2">
            <label>Rank</label>
      <select class="form-control"  name="rank">
            <option selected disabled value="">Select Rank</option>
            <option <?php if($bonanza_data[0]['rank']=='Associate') { echo 'selected="selected"'; } ?> value="Associate">Associate</option>
            <option <?php if($bonanza_data[0]['rank']=='Bronze') { echo 'selected="selected"'; } ?> value="Bronze">Bronze</option>
      <option <?php if($bonanza_data[0]['rank']=='Silver') { echo 'selected="selected"'; } ?> value="Silver">Silver</option>
      <option <?php if($bonanza_data[0]['rank']=='Gold') { echo 'selected="selected"'; } ?> value="Gold">Gold</option>
      <option <?php if($bonanza_data[0]['rank']=='Platinum') { echo 'selected="selected"'; } ?> value="Platinum">Platinum</option>
      <option <?php if($bonanza_data[0]['rank']=='Emrald') { echo 'selected="selected"'; } ?> value="Emrald">Emrald</option>
      <option <?php if($bonanza_data[0]['rank']=='Rubi') { echo 'selected="selected"'; } ?> value="Rubi">Rubi</option>
      <option <?php if($bonanza_data[0]['rank']=='Sapphire') { echo 'selected="selected"'; } ?> value="Sapphire">Sapphire</option>
      <option <?php if($bonanza_data[0]['rank']=='Diamond') { echo 'selected="selected"'; } ?> value="Diamond">Diamond</option>
      <option <?php if($bonanza_data[0]['rank']=='Double Diamond') { echo 'selected="selected"'; } ?> value="Double Diamond">Double Diamond</option>
      <option <?php if($bonanza_data[0]['rank']=='Blue Diamond') { echo 'selected="selected"'; } ?> value="Blue Diamond">Blue Diamond</option>
      <option <?php if($bonanza_data[0]['rank']=='Black Diamond') { echo 'selected="selected"'; } ?> value="Black Diamond">Black Diamond</option>
      </select>
          </div>
 <div class="form-group col-sm-2">
            <label>Status</label>
			<select class="form-control"  name="status">
            <option selected disabled value="">Select Status</option>
            <option <?php if($bonanza_data[0]['status']=='Active') { echo 'selected="selected"'; } ?> value="Active">Active</option>
			<option <?php if($bonanza_data[0]['status']=='Deactive') { echo 'selected="selected"'; } ?> value="Deactive">Deactive</option>
			</select>
          </div>
		  
		 
		  
       
		 
		  
		  
		  
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp;  
          </div>
		  
		  </fieldset>
	  
	  
	  <?php echo form_close(); ?>
	  
	  <!--script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script-->