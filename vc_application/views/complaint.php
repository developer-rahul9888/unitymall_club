 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<?php
      //flash messages
        if(!empty($complaint))
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your Complaint Submitted successfully';
          echo '</div>';       
        } 
	  
 
?>
				</div>


				
			</div>    	
    		<div class="row"> 
			<div class="col-sm-2"></div> 
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Complaint</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form  id="main-contact-form" class="contact-form row"  method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
							<div class="form-group col-md-6">
				                <input type="text" name="phone" class="form-control" required="required" placeholder="Phone">
				            </div>
							
							
				            <div class="form-group col-md-6">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
							<div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
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
	