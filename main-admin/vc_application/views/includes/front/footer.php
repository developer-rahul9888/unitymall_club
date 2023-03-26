<script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets/front/js/datetimepicker.js"></script>

<div id="registerLoginModal" class="modal fade" role="dialog">

  <div class="modal-dialog"> 

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h2 class="modal-title fdr">Login</h2>

        <h2 class="modal-title fdr2" style="display:none">Forgot Password</h2>

        <h2 class="modal-title sng-up" style="display:none">Signup</h2>

      </div>

      <div class="modal-body">

	  

	  <div class="col-sm-12 signin-sect fdr">

	   <div id="login-msg-div"></div>

		<div id="register-msg-div1"></div>

        <form class="form" action="" method="post" id="popup-login-form">

       <p><label>User ID</label> <input type="text" required name="user_name" class="form-control input-empty" placeholder="ID NO."></p>

       <p><label>Password</label> <input type="password" required name="password" class="form-control input-empty"></p>

	   

       <p><input type="submit" name="submit" value="Login" class="btn btn-primary popup-login-button">  &nbsp; <!--a href="javascript:;" class="show-register-form">Register</a--></p>

	      <div class="col-md-5 keeplogin text-left ferd3"><b>Register</b></div>

	   <div class="col-md-7 keeplogin text-right ferd"><b>Forgot your Password?</b></div>

     </form>

	  </div>

	  

	  

	  <div class=" col-sm-12 loginform fdr2" style="display:none">

	  <div id="forget-msg-div"></div>

<form action="#" id="forgetpassword" autocomplete="on" method="POST">

<p><label>Username</label> <input type="email" required name="user_name" class="form-control input-empty" placeholder="Enter your email id"></p>

<p class="keeplogin dgtbkt"> 

<b class="lgt"> Login </b>

<input class="hdf btn btn-primary popup-login-button" name="submit" id="can" type="submit" value="Mail My Password" />

</p>

</form>

</div>

	  

	  

	  

	  <div class="col-sm-12 signup-sect sng-up" style="display:none">

	  <h4>Register Free</h4>

	   <div id="register-msg-div"></div>

        <form class="form" action="" method="post" id="popup-register-form">

       <p><label>First Name</label> <input required="required" type="text" name="f_name" class="form-control input-empty"></p>

       <p><label>Last Name</label> <input type="text" name="l_name" class="form-control input-empty"></p>

       <p><label>Email</label> <input required="required" type="email" name="email" class="form-control input-empty"></p>

       <p><label>Password</label> <input type="password" name="password" class="form-control input-empty"></p>

	   <p><label>Confirm Password</label> <input type="password" name="cpassword" class="form-control input-empty"></p>

       <p><label>Phone</label> <input type="number" min="1" maxlength="10" name="phone" class="form-control input-empty"></p>

	   <p><label>City</label> <input required="required" type="text" name="city" class="form-control input-empty"></p>

	   

	   <p><label>State</label> <select name="state" class="form-control" required="required"><option selected disabled>SELECT STATE</option><option value="Andhra Pradesh">Andhra Pradesh</option><option value="Arunachal Pradesh">Arunachal Pradesh</option><option value="Assam">Assam</option><option value="Bihar">Bihar</option><option value="Chhattisgarh">Chhattisgarh</option><option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option><option value="Daman and Diu">Daman and Diu</option><option value="Delhi">Delhi</option><option value="Goa">Goa</option><option value="Gujarat">Gujarat</option><option value="Haryana">Haryana</option><option value="Himachal Pradesh">Himachal Pradesh</option><option value="Jammu and Kashmir">Jammu and Kashmir</option><option value="Jharkhand">Jharkhand</option><option value="Karnataka">Karnataka</option><option value="Kerala">Kerala</option><option value="Madhya Pradesh">Madhya Pradesh</option><option value="Maharashtra">Maharashtra</option><option value="Manipur">Manipur</option><option value="Meghalaya">Meghalaya</option><option value="Mizoram">Mizoram</option><option value="Nagaland">Nagaland</option><option value="Orissa">Orissa</option><option value="Puducherry">Puducherry</option><option value="Punjab">Punjab</option><option value="Rajasthan">Rajasthan</option><option value="Sikkim">Sikkim</option><option value="Tamil Nadu">Tamil Nadu</option><option value="Telangana">Telangana</option><option value="Tripura">Tripura</option><option value="Uttar Pradesh">Uttar Pradesh</option><option value="Uttarakhand">Uttarakhand</option><option value="West Bengal">West Bengal</option></select></p>

	   

	   <p><label>Pincode</label> <input required="required" type="number" name="pincode" class="form-control input-empty"></p>

	   

	   

      <p class="hide"><label> Registration PIN</label> <input type="text" name="pin_code" class="form-control input-empty"></p> 

      <p><label> Referral Code</label> <input id="bliss_code_input" type="text" name="bliss_code" class="form-control input-empty request-code-input" ></p> 

	  <div id="sponsr_name"></div> 
 
	  <p><label> Placement Code</label> <input id="place_code_input" type="text" name="place_code" class="form-control input-empty request-code-input" ></p>
	  
	  <div id="place_sponsr_name"></div>

	  <div class="form-group">

		 <label>Binary Placement *</label>	 <br>

		 <input checked="checked" name="position" value="left" type="radio"><label class="check">Left Side</label>

		       

		 <input name="position" value="right" type="radio"> <label class="check">Right Side</label>

		 <!--<label class="col-md-12 row">Registration Code *</label>-->

		 </div>

		  	<div class="form-group">

		 <input checked="checked" name="term_condition" value="left" type="checkbox"><span class="check">I acknowledge that I have read, understood and agree to all the <a href="#" style="cursor:pointer;">Terms & Conditions.</a></span>

		 </div> 

			 

		    <div class="request-code-div" style="display:none;">

			<div id="request-code-result"></div>

			<div class="input-group">

               <input type="text" class="form-control" maxlength="10" placeholder="Phone" value="">

               <div class="input-group-addon request-code-search glyphicon glyphicon-search"></div>

            </div>

			</div>

       <p><label>&nbsp;</label> <input type="submit" name="submit" value="Register" class="btn btn-primary popup-register-button"> &nbsp; &nbsp; <a href="javascript:;" class="show-login-form lgt">Login</a></p>

     </form>

	 </div>

	 

      </div>

      

    </div> 

  </div>

</div>





<script type="text/javascript">





    jQuery(document).ready(function () {







   });



 </script>

</body>

</html>

