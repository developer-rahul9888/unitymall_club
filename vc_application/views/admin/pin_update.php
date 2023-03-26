	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin'; ?>">Back to E-pin List</a>
        <h2>Transfer PIN</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
            $msg = $this->session->flashdata('success_msg');
            if($msg==''){ $showmsg = 'Pin transfer successfull.'; }
            else { $showmsg = $msg; }
            
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong>'.$msg.'';
          echo '</div>';       
        }  else{
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
      $attributes = array('class' => 'form', 'id' => '','autocomplete'=>'off');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/pin_transfer/', $attributes);
      ?>
        <fieldset>
		
		   <div class="form-group col-sm-4">
            <label>Transfer to :</label>
              <input id="bliss_code_input" type="text" class="form-control request-code-input"  name="assign_to" value="<?php if($this->input->post('assign_to')!='') { echo $this->input->post('assign_to'); } ?>" >
			  <div id="sponsr_name"></div>
          </div>
		  
		   <div class="form-group col-sm-4">
            <label>No. of E-Pin:</label>
              <input type="text" class="form-control"  name="pins" value="<?php if($this->input->post('pins')!='') { echo $this->input->post('pins'); }  ?>" >
          </div>
		  
		  <div class="form-group col-sm-4">
             <label>Plan Package:<small style="color:red">*</small></label>
             <select name="pinid" class="form-control custom-select">
      
       <option value='' disabled="" selected="">Select Package</option>
      
     <?php
      if(!empty($package)) {
        foreach($package as $pack) {
          echo '<option value="'.$pack['amount'].'~'.$pack['franchisee'].'">'.$pack['title'].' ('.$pack['amount'].')</option>';
        }
      }

      ?>
        
    
        </select> 
          </div> 

<div style="clear:both" class="clearfix"></div>
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Transfer E-Pins</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin'; ?>">Back </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	