<div class="mainbar no-print hidden-xs" >  
<nav class="">
<div class="container">
   
	</div> <!-- /.container --> 
	</nav>
	</div> 
 
 <div class="container">
  <div class="content">
    <div class="content-container">
 <div class="page-heading"> 
<h2>Transfer Fund</h2>

</div>
<div class="col-sm-12 right-bar">
<br>
<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Successfully Transfered.';
          echo '</div>';       
        } elseif($this->session->flashdata('flash_message') == 'password')
        {
          echo '<div class="alert alert-danger">';   
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Incorrect Password.';
          echo '</div>';       
        } elseif($this->session->flashdata('flash_message') == 'less')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your Wallet have less Amount.';
          echo '</div>';       
        }  elseif($this->session->flashdata('flash_message') == 'no')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Incorrect Member ID.';
          echo '</div>';       
        } /*elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
            echo '</div>';  
		}*/
      }
	  
echo validation_errors(); 

	   $attributes = array('class' => 'form');
      echo form_open(base_url().'admin/transfer_fund', $attributes);
      ?>
	  

	

		 <div class="form-group col-sm-12">
            <label>Amount To Be Transfer</label>
             <input type="number" name="amount" placeholder="Amount To Be Transfer" required class="form-control">
          </div>

        <div class="form-group col-sm-12">
            <label>To Member ID</label>
			<input type="text" id="bliss_code_input" name="member_id" placeholder="To Member ID" required class="form-control request-code-input" value="<?php if($this->input->post('member_id')!='') { echo $this->input->post('member_id'); } ?>">
			
          </div>
		  <div id="sponsr_name"></div>
       <!--  <input type="hidden" name="type" value="bliss_amount"> -->


	
<div class="form-group col-sm-12">
            <label>Transaction Code</label>
             <input type="password" name="transaction" placeholder="Transaction Code" required class="form-control">
          </div>
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" name="submit" value="submit" type="submit">Submit</button> &nbsp;  
          </div>
		  
		  <?php echo form_close(); ?>
		  
</div>


</div>
</div>
</div>