<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>Unity Mall</title> 
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/global-admin.css" rel="stylesheet" type="text/css">
	 <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container login">

<div class="col-lg-12"><a  href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" width="120px" class="img-responsive center-block ad" /></a>

      <?php 
      $attributes = array('class' => 'form-signin'); 
      echo form_open(base_url().'login/validate_credentials', $attributes);
      echo '<h2 class="form-signin-heading">Login</h2>';
      echo form_input('user_name', '', 'placeholder="Username" class="form-control"');
	  echo '<br>';
      echo form_password('password', '', 'placeholder="Password" class="form-control"');
	  
      if(isset($message_error) && $message_error){
          echo '<br><div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
          echo '</div>';             
      }
      echo "<br />";
      echo "<br />";
      echo form_submit('submit', 'Login', 'class="btn btn-large btn-primary"');
	  echo '<a style="float:right;" title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal"><i class="fa fa-lock"></i> Forget Password</a>';
      echo form_close();
      ?>
    </div><!--container-->
	
	
	
	<?php if(!$this->session->userdata('is_customer_logged_in')){ ?>
<!-- Modal -->
<div id="registerLoginModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
	
    <div class="modal-content" style="height:200px;">
     
      <div class="modal-body">
	  
	  
	  
	  <div class=" col-sm-12 loginform fdr2">
	  <div id="forget-msg-div"></div>
<form action="/main-admin/" id="forgetpassword" autocomplete="on" method="POST">
<p><label>Email</label> <input type="email" required name="user_email" class="form-control input-empty" placeholder="Enter your Email"></p>
<p class="keeplogin dgtbkt"> 
<input class="hdf btn btn-primary popup-login-button" name="submit" id="can" type="submit" value="Reset Password" />
</p>
</form>
</div>
	  
	  

      </div>
      
    </div> 
  </div>
</div>

	<?php }?>
	
	<script type="text/javascript">
	
	jQuery(document).ready(function () { 
	
	 jQuery("#forgetpassword").submit(function( event ) { 
  event.preventDefault();
			   jQuery.ajax({
                   type:"POST",
                   url:"<?php echo base_url(); ?>user/forgotPassword",
                   data:jQuery("#forgetpassword").serialize(),
                   success:function(data){
					jQuery("#forget-msg-div").html(data); 
                   }
               });  
  });
	
	 });
	
	</script>

  </body>
</html>