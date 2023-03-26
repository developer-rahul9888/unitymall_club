	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/product_sale'; ?>">Back</a>
        <h2>Add Product Sale</h2>
      </div>
 
      <?php 
	  if(empty($products)) { die('Please check product id'); }
	  $prod = $products[0];
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product_sale added successfully.';
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
      
      echo form_open('admin/product_sale/edit/'.$this->uri->segment(4), $attributes);
      ?>
        <fieldset> 
		<input type="hidden" value="<?php echo $prod['id'];?>" name="cid">
		<div class="form-group col-sm-6">
            <label>Product</label>
              <input type="text" class="form-control" required name="pname" value="<?php if($this->input->post('pname')!='') { echo $this->input->post('pname'); } else { echo $prod['pname']; }  ?>" >
          </div> 
		   <div class="form-group col-sm-3">
            <label>Amount</label>
              <input type="number" class="form-control" required name="amount" value="<?php if($this->input->post('amount')!='') { echo $this->input->post('amount'); } else { echo $prod['amount']; }  ?>" >
          </div> 
		   <div class="form-group col-sm-3">
            <label>User ID</label>
              <input type="text" class="form-control" required name="user_id" value="<?php if($this->input->post('user_id')!='') { echo $this->input->post('user_id'); } else { echo $prod['user_id']; }  ?>" >
          </div> 
           <div class="form-group col-sm-6">
            <label>Address</label>
              <input type="text" class="form-control" required name="address" value="<?php if($this->input->post('address')!='') { echo $this->input->post('address'); } else { echo $prod['address']; }  ?>" >
          </div> 
		   <div class="form-group col-sm-3">
            <label>Status</label>
              <select name="status" class="form-control">
			  <option value="Processing">Processing</option>
			  <option <?php if($prod['status']=='Delivered') { echo 'selected="selected"'; } ?> value="Delivered">Delivered</option>
			  </select>
          </div> 
		  <div class="form-group col-sm-3">
            <label>Slip No.</label>
              <input type="text" class="form-control" name="slip_no" value="<?php if($this->input->post('slip_no')!='') { echo $this->input->post('slip_no'); } else { echo $prod['slip_no']; }  ?>" >
          </div> 
		  <div class="form-group col-sm-3">
            <label>Dispached Date</label>
              <input type="text" class="form-control" name="dis_date" value="<?php if($this->input->post('dis_date')!='') { echo $this->input->post('dis_date'); }  else { echo $prod['dis_date']; }   ?>" >
          </div> 
		  
		  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/product_sale'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php echo form_close(); ?> 