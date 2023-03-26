<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>Maxaura Admin</title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/global-admin.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="container login">

<div class="col-lg-12 text-center"><img style="margin:10px 0;" src="/assets/images/logo.png" alt="Order Food" width="220"></div>

      <?php 
      $attributes = array('class' => 'form-signin');
      echo form_open(base_url().'admin/login/validate_credentials', $attributes);
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
      echo form_close();
      ?>      
    </div><!--container-->

  </body>
</html>