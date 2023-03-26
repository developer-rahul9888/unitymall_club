 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<?php
      //flash messages
        if(!empty($career))
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your Request Submitted successfully';
          echo '</div>';       
        }elseif($imgerror){echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'File format should be JPEG, PNG, PDF, DOC.';
            echo '</div>';}
?>
				</div>


				
			</div>    	
    		<div class="row"> 
			<div class="col-sm-2"></div> 
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Career</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form  id="main-contact-form" class="contact-form row"  method="post" enctype='multipart/form-data'>
						
						<div class="form-group col-md-6">
							<label>Interested in</label>
							<select name="intrest">
							<option selected disabled required  value="">Select Interest</option>
							  <option value="part time">Part Time</option>
				              <option  value="full time">Full Time</option>
				              <option value="home based">Home Based Job</option>
				          </select>
				            </div>
						
						<div class="form-group col-md-6">
							<label>Expected Salary</label>
							<select name="expected">
							<option selected disabled required  value="">Select Value</option>
							  <option value="10000">10000</option>
				              <option value="15000">15000</option>
				              <option value="25000">25000</option>
				              <option value="35000">35000</option>
				          </select>
				            </div>
							
				            <div class="form-group col-md-6">
							<label>First Name</label>
				                <input type="text" name="fname" class="form-control" required="required">
				            </div>
							
							<div class="form-group col-md-6">
							<label>Last Name</label>
				                <input type="text" name="lname" class="form-control" required="required">
				            </div>
							
							<div class="form-group col-md-6">
							<label>Address</label>
				                <input type="text" name="address" class="form-control" required="required" >
				            </div>
							
							<div class="form-group col-md-6">
							<label>City</label>
				                <input type="text" name="city" class="form-control" required="required">
				            </div>
							
							<div class="form-group col-md-6">
							<label>State</label>
				                <input type="text" name="state" class="form-control" required="required" >
				            </div>
							
							<div class="form-group col-md-6">
							<label>Pin Code</label>
				                <input type="text" name="pin" class="form-control" required="required" >
				            </div>
							
							<div class="form-group col-md-6">
							<label>Date Of Birth</label>
				                <input type="text" name="Dob" class="form-control" required="required" >
				            </div>
							
							<div class="form-group col-md-6">
							<label>Age</label>
				                <input type="text" name="age" class="form-control" required="required" >
				            </div>
							
							<div class="form-group col-md-6">
							<label>Gender</label>
				                <input type="text" name="gender" class="form-control" required="required" >
				            </div>
							
				            <div class="form-group col-md-6">
							<label>E-mail</label>
				                <input type="email" name="email" class="form-control" required="required" >
				            </div>
							<div class="form-group col-md-6">
							<label>Contact No.</label>
				                <input type="text" name="phone" class="form-control" required="required" placeholder="Phone">
				            </div>
							
							
							<div class="form-group col-md-6">
							<label>Highest Qualification</label>
				                <input type="text" name="hq" class="form-control" required="required" >
				            </div>
							
							<div class="form-group col-md-6">
							<label>Total work experience</label>
				                <input type="text" name="workexp" class="form-control" required="required" >
				            </div>
							
							<div class="form-group col-md-6">
							<label>Current Employer</label>
				                <input type="text" name="currentemp" class="form-control" required="required" >
				            </div>
							
							<div class="form-group col-md-6">
							<label>Reason for job change</label>
				                <input type="text" name="reason" class="form-control" required="required" >
				            </div>
							
							<div class="form-group col-md-6">
							<label>Upload resume</label>
				                <input type="file" name="image" class="form-control" >
								<span>File format should be JPEG, PNG, PDF, DOC</span>
				            </div>
							                       
				            <div class="form-group col-md-12">
				                <input type="submit" name="contact" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	