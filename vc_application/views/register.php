  <?php 
      //flash messages
      if($this->session->flashdata('register')){
        if($this->session->flashdata('register') == 'true')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo 'Register successfully please login now. Your user id is <b>'.$userregisterid.'</b>';
          echo '</div>';       
        } 
        if($this->session->flashdata('register') == 'email')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo 'Email id is already register.';
          echo '</div>';       
        } 
		if($this->session->flashdata('register') == 'phone')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Phone No. is already register.';
          echo '</div>';       
        } 
         if($this->session->flashdata('register') == 'pin_code')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo 'Please check your PIN Code.';
          echo '</div>';       
        }
        if($this->session->flashdata('register') == 'addhar')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo 'You cannot Use same Aadhar twise';
          echo '</div>';       
        }
        if($this->session->flashdata('register') == 'bliss_code')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo 'Referral Code is not exist. Please check your Referral Code.';
          echo '</div>';       
        }
        if($this->session->flashdata('register') == 'place_code')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo 'Placement is not Available.';
          echo '</div>';       
        }
		if($this->session->flashdata('register') == 'rtl_code')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo 'Referral Code is not a Distributor ';
          echo '</div>';       
        } 
		
		if($this->session->flashdata('register') == 'sendotp')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please verify your OTP. Check your mail.';
          echo '</div>'; 

// echo '<script>
// jQuery(".otp_vrfy").show();		  
// </script>	';		  
        }
		if($this->session->flashdata('register') == 'wrong_otp')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please type correct OTP';
          echo '</div>';       
        }
		
      }
	  
      //form validation
      echo validation_errors();