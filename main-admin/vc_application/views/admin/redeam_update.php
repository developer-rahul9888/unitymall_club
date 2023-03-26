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
      echo form_open_multipart('admin/redeam/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $redeamupdate[0];
	  ?>
	  
	  <div class="col-md-6">
      <div class="page-heading"> 
        <h2 class="iod">Update Payout <ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/redeam'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></ul></h2>
		
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
		 <input type="hidden" class="form-control" required name="rid" value="<?php echo $prod['id'];  ?>" >
	  
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Name <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="name" value="<?php if($this->input->post('f_name')!='') { echo $this->input->post('f_name'); } else { echo $prod['f_name']; }  ?>" >
          </div>
          </div>
		  
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Redeem <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="redeem" value="<?php if($this->input->post('redeem')!='') { echo $this->input->post('redeem'); } else { echo $prod['redeem']; }  ?>" >
          </div>
          </div>
		  <?php if($prod['voucher_email']==''){ ?>
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">After TDS <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control"  name="after_tds" value="<?php if($this->input->post('after_tds')!='') { echo $this->input->post('after_tds'); } else { echo $prod['after_tds']; }  ?>" >
          </div>
          </div>
		  <?php }else{ ?>
		  
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Voucher Email <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="voucher_email" value="<?php if($this->input->post('voucher_email')!='') { echo $this->input->post('voucher_email'); } else { echo $prod['voucher_email']; }  ?>" >
          </div>
          </div>
		  
		  <?php }?>
		  
		  <input type="hidden" value="<?php echo $prod['id']; ?> " name="customer_id">
		
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Status <small style="color:red">*</small></label>
             <div class="col-sm-9">  
			 <select name="status" class="form-control custom-select">
			  <option <?php if($prod['redeem_status']=='approved') { echo 'selected="selected"'; } ?> value="approved">Approved</option>
			  <option <?php if($prod['redeem_status']=='disapproved') { echo 'selected="selected"'; } ?> value="disapproved">Disapproved</option>
			  <option <?php if($prod['redeem_status']=='pending') { echo 'selected="selected"'; } ?> value="pending">Pending</option>
			  </select>
          </div> 
          </div> 
		  
		  
		</div>  

				 
        </fieldset>
      <?php echo form_close(); ?>
	  
</div>




<div class="col-md-6">

<h2 class="iod">Bank Detail</h2>
<ul>
<li><b>Bank Name :- </b><?php echo $prod['bank_name']; ?></li>
<li><b>Branch :- </b><?php echo $prod['branch']; ?></li>
<li><b>Account Name :- </b><?php echo $prod['account_name']; ?></li>
<li><b>Account Type :- </b><?php echo $prod['account_type']; ?></li>
<li><b>Account no :- </b><?php echo $prod['account_no']; ?></li>
<li><b>Bank City :- </b><?php echo $prod['bank_city']; ?></li>
<li><b>Bank State :- </b><?php echo $prod['bank_state']; ?></li>
<li><b>IFSC :- </b><?php echo $prod['ifsc']; ?></li>
</ul>


</div>
	     <!--script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:350 });</script-->
  
 