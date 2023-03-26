	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/pins'; ?>">Back to E-pin List</a>
        <h2>Activate PIN</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'activated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong></strong> PIN activated successfully.';
          echo '</div>';       
        }  else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong>PIN not activated please try again.';
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
      if(empty($user)) {
      echo form_open('admin/pin_activate/'.$this->uri->segment(3), $attributes);
      ?>
        <fieldset>
		   <div class="form-group col-sm-4">
            <label>Customer ID :</label>
              <input type="hidden" name="find_customer" value="yes" >
              <input type="text" class="form-control"  name="assign_to" value="<?php if($this->input->post('assign_to')!='') { echo $this->input->post('assign_to'); } ?>" >
          </div> 
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Find Customer</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/pins'; ?>">Back </a>
          </div>
        </fieldset>
      <?php echo form_close(); 
	  
	  } 
	  else {
		  echo form_open('admin/franchize_pin/'.$this->uri->segment(3), $attributes);
		  ?>
		 <fieldset>
		   <div class="form-group col-sm-4">
            <p><label>Customer: </label>&nbsp;<?php echo $user[0]['f_name'].' '.$user[0]['l_name'].' ('.$user[0]['customer_id'].')';?> 
              <input type="hidden" name="assign_to" value="<?php echo $user[0]['customer_id']; ?>" >
              <input type="hidden" name="pin" value="<?php $this->uri->segment(3); ?>" ></p>
			<p><label>Sponsor: </label>&nbsp;<?php echo $user[0]['df_name'].' '.$user[0]['dl_name'].' ('.$user[0]['direct_customer_id'].')';?> </p>
			<p><label>PIN: </label>&nbsp;<?php echo $pin[0]['pinid'];?></p>
			<p><label>Amount: </label>&nbsp;<?php echo $pin[0]['p_amount'];?></p>
			<p><label>BV: </label>&nbsp;<?php echo $pin[0]['b_volume'];?></p>
          </div> 
		  
		  <input type="hidden" name="pin_amt" value="<?php echo $pin[0]['p_amount']; ?>" >
		  
		   <!-- <div class="form-group">
  <select class="form-control" name="product" required>
  <option selected disabled>Select Product</option>
  <?php if($pin[0]['p_amount']==0){echo "<option value='0~~0'>Special package   Amount:- 0</option>";} ?>
		  <?php 
		  if(!empty($product)) {
		  foreach($product as $products){
            echo"<option value=".$products['id']."~~".$products['p_d_price'].">".$products['pname']."   Amount:- ".$products['p_d_price']. "</option>";
		    }	
		  }
		  ?>
		  </select>
</div>  -->
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-success" type="submit">Activate PIN</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/franchize_pin/'.$this->uri->segment(3); ?>">Back </a>
          </div>
        </fieldset>  
		  
	  <?php 
	  echo form_close(); 
	  } ?>
	