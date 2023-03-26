	<?php if(empty($order)) { echo '<p>Please check URL</p>'; }
	
elseif($blissid=='') { echo '<p>This user have not valid Bliss ID</p>'; }
else { 
	$order_data = $order[0]; ?>
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	.itm-lst li span{float:right;}
		 .itm-lst li{clear:both;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/order/'.$order_data['id']; ?>">Back</a>
        <h2>Order #<?php echo $order_data['id'];?></h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Done!</strong> distribute successfully.';
          echo '</div>';       
        } else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> not distribute please try again.';
          echo '</div>';          
        }
      }
	 
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/order/distribute/'.$this->uri->segment(4).'', $attributes);
	  
      ?>
        <fieldset>
		
		
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Contact Info</h4></div>
            <div class="panel-body">
				<div class="col-sm-7">
			  <h4><?php echo $order_data['p_name']; ?></h4>
			  <?php echo $order_data['p_email']; ?><br>
			  <?php echo $order_data['p_phone']; ?><br>
			  <?php echo $order_data['p_address'].' '.$order_data['p_address2'].' '.$order_data['p_city'].' '.$order_data['p_zip'].' '.$order_data['p_state']; ?><br><br>
			</div>
			
				<div class="col-sm-5">
					<h4>Distribute Amount <?php //echo $order_data['status'];?></h4>
<?php if(!empty($distribution)) { ?>
					<p>Already distribute for this order.</p>
					<?php } else { ?>
					 <label>Amount</label>
					 <input type="number" required value="<?php echo $order_data['comm_dis']; ?>" name="damount">
					 <br><label>Order ID</label>
					 <input type="number" required readonly value="<?php echo $order_data['id']; ?>" name="oid">
					<br> <label>Customer ID</label>
					 <input type="number" required readonly value="<?php echo $order_data['user_id']; ?>" name="uid">
<br> <label>Customer id ID</label>
					 <input type="text" required readonly value="<?php echo $blissid; ?>" name="bid">
<input type="hidden" required value="<?php echo $order_data['how_to_pay']; ?>" name="how_to_pay">
					<br><input type="submit" name="submit" class="btn btn-primary" value="Submit"> 
					<?php }?>
				</div>
			</div>
        </div>
	
        </fieldset>
      <?php echo form_close(); 
	} ?>
	  