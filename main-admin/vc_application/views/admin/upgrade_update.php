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
      echo form_open_multipart('admin/upgrade/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $upgradeupdate[0];
	  ?>
	  
	  <div class="col-md-6">
      <div class="page-heading"> 
        <h2 class="iod">Upgrade Account <ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/upgrade'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></ul></h2>
		
      </div>
 

 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> redeem updated successfully.';
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
          <label  class="control-label col-sm-3">Name <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } else { echo $prod['f_name']; }  ?>" >
          </div>
          </div>
		  
		 
		  
		  <input type="hidden" value="<?php echo $prod['up_user_id']; ?> " name="customer_id">
		
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Status <small style="color:red">*</small></label>
             <div class="col-sm-9">  
			 <select name="status" class="form-control custom-select">
			  <option value="approved">Approved</option>
			  <option value="disapproved">Disapproved</option>
			  <option <?php if($prod['up_status']=='pending') { echo 'selected="selected"'; } ?> value="pending">Pending</option>
			  </select>
          </div> 
          </div> 
		  
		  
		</div>  

				 
        </fieldset>
      <?php echo form_close(); ?>
	  
</div>




<div class="col-md-6">

<h2 class="iod">User Detail</h2>
<ul>
<li><b>Name :- </b><?php echo $prod['f_name']; ?></li>
<li><b>Email :- </b><?php echo $prod['email']; ?></li>
<li><b>Parent id :- </b><?php echo $prod['parent_customer_id']; ?></li>
<li><b>Phone :- </b><?php echo $prod['phone']; ?></li>
<li><b>Verified Account :- </b><?php echo $prod['var_status']; ?></li>
</ul>


</div>
	     <!--script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:350 });</script-->
  
 