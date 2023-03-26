<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>Realwater</title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/global-admin.css" rel="stylesheet" type="text/css">
  </head>
  <body> 
    <div class="container">
<div class="col-lg-12 register-form">
<div class="col-lg-12  text-center"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>/images/rlogo.jpg"></a></div>
<div class="clearfix"></div>
      <?php  
if(isset($message_error) && $message_error){
          echo '<br><div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong> email or password is wrong.';
          echo '</div>';             
      }

if(isset($message_error_pending) && $message_error_pending){
          echo '<br><div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Error!</strong> your email confirmation is not complete.';
          echo '</div>';             
      }
	  if($this->session->flashdata('register') && $this->session->flashdata('register')=='true'){
             $this->session->set_flashdata('register', 'false'); 
          echo '<br><div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Register successfully please login now.';
            //echo 'Check your email inbox/spam and click the link given in email to verify your account.';
          echo '</div>';             
      }
?>
<?php echo validation_errors(); ?>


<div class="clearfix"></div>

<?php
      $attributes = array('class' => 'col-sm-6 col-sm-offset-3');
      echo form_open(base_url().'admin/login/validate_credentials', $attributes);
?>
      <h4 class="text-center">Sign in to start your session</h4>

<input type="email" required value="<?php if($this->input->post('user_name')!='') { echo $this->input->post('user_name'); } ?>" class="form-control" name="user_name" placeholder="Email">
      
	  <br>
<input type="password" value="" class="form-control" name="password" placeholder="Password">
    
      <br />

 <div class="col-sm-6 lik">
<a href="<?php echo base_url(); ?>admin/signup">Register</a><br>
<a href="<?php echo base_url(); ?>admin/forgot-password">Forgot Password</a><br>
<!--a href="#">Resend Verification Link</a-->
</div>
 <div class="col-sm-6 text-right"><input type="submit" value="Login" class="btn btn-large btn-primary" name="submit"></div>
 
<?php 
      echo form_close();
      ?>      

    </div> 
	</div><!--container-->

  </body>
</html>