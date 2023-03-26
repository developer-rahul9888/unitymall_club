	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url(); ?>">Back</a>
        <h2>Update wallet</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> wallet amount added successfully.';
          echo '</div>';       
        }else{
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
      
      echo form_open_multipart('admin/wallet/add');
      ?>
      
	  <fieldset>



		 <div class="form-group col-sm-4">
            <label>User ID</label>
              <input id="bliss_code_input" type="text" class="form-control request-code-input"  name="bsacode" >
          </div>
		  
		 <div class="form-group col-sm-4">
            <label>Amount</label>
              <input type="text" class="form-control" name="amount" >
          </div>
		  
		  <div class="form-group col-sm-4">
            <label>Type</label>
             <select name="type" class="form-control custom-select">
			  <option value="bliss_amount"> Wallet</option>
			  <!---option  value="wallet">Wallet</option-->
			  </select>
          </div>
		  
		  
          <div class="form-group  col-lg-4">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp;  
          </div>
		 
		  </fieldset>
	   <div id="sponsr_name"></div>
	  
	  <?php echo form_close(); ?>
	  

