<footer class="col-sm-12">
<div class="col-sm-2 col-fot-4">
<div class="rotate"><div class="txt-root"><span>Users</span></div></div>
<div class=""><img src="<?php echo base_url();?>assets/images/f1.png"></div>
<ul class="quk-lnk footer-quick-link">
<li><a href="/help">Help/FAQS</a></li>
<li><a href="/help">Track Order</a></li>
<li><a href="/how_do_i_shop">How do I shop ?</a></li>
<li><a href="/how_do_i_pay">How do I pay ?</a></li>
</ul>
</div>
 
<div class="col-sm-2 col-fot-4">
<div class="rotate"><div class="txt-root"><span>Policies</span></div></div>
<div class=""><img src="<?php echo base_url();?>assets/images/f2.png"></div>
<ul class="quk-lnk footer-quick-link">
<li><a href="/terms_of_use">Terms of Use</a></li>
<li><a href="/privacy">Privacy </a></li>
<li><a href="/exchanges_return">Exchanges & Return </a></li>
<li><a href="/shipping_policy">Shipping Policy </a></li>
</ul>
</div>
<div class="col-sm-2 col-fot-4">
<div class="rotate"><div class="txt-root"><span>Company</span></div></div>
<div class=""><img src="<?php echo base_url();?>assets/images/f3.png"></div>
<ul class="quk-lnk footer-quick-link">
<li><a href="/about">About Us</a></li>
<li><a href="/contact_us">Contact Us</a></li>
<li><a href="/store_locator">Store Locator</a></li>
<li><a href="#">Corporate</a></li>
</ul>
</div>
<div class="col-sm-2 col-fot-4">
<div class="rotate"><div class="txt-root"><span>Awesome</span></div></div>
<div class=""><img src="<?php echo base_url();?>assets/images/f4.png"></div>
<ul class="quk-lnk footer-quick-link">
<li><a href="/happy_hours">Happy Hours</a></li>
<li><a href="#">Winners League</a></li> 
<li><a href="#">Good times</a></li> 
<li><a href="#">The One</a></li> 
</ul>
</div>
<div class="col-sm-2 col-fot-4">
<div class="rotate"><div class="txt-root"><span>Partner with us</span></div></div>
 <div class=""><img src="<?php echo base_url();?>assets/images/f5.png"></div>
  
<ul class="quk-lnk">
<li><a href="http://www.blisszon.com/merchants/">Make your Bliss Store  </a></li>
<li><a href="http://www.blisszon.com/merchants/admin/signup">Become a Bliss Merchant </a></li>
<li><a href="http://www.blisszon.com/merchants/admin">Partner Dashboard </a></li> 
<li><a href="#">Send a query</a></li> 
 </ul>
 </div>
 
 <!--div class="col-news-12">
 <h3>Newsletter</h3>
 <small>&nbsp;</small>
 <form method="post" action="">
 <input type="email" required placeholder="Enter your email id...">
 <input type="submit" value="Subscribe">
 </form>
</div--> 
<!-- news letter -->

<div class="col-sm-12 col-sb-fto-12 text-center footer-images">
<div class="col-sm-3 col-sb-fto-4">
<h3>Get Blisszon App</h3>
<a href="#"><img src="<?php echo base_url(); ?>assets/front/images/p1.jpg"></a>
</div>
<div class="col-sm-6 col-sb-fto-4">
<h3>Secure Payment Options</h3>
<ul class="list-inline">
<li><a href="#"><img src="<?php echo base_url(); ?>assets/front/images/p2.jpg"></a></li>
<li><a href="#"><img src="<?php echo base_url(); ?>assets/front/images/p3.jpg"></a></li>
<li><a href="#"><img src="<?php echo base_url(); ?>assets/front/images/p4.jpg"></a></li>
<li><a href="#"><img src="<?php echo base_url(); ?>assets/front/images/p5.jpg"></a></li> 
</ul>
</div>
<div class="col-sm-3 col-sb-fto-4">
<h3>Find more about Blisszon</h3>
<ul class="list-inline social-icon">
<li><a href="https://www.facebook.com/" target="_blank"><img width="40" src="<?php echo base_url(); ?>assets/front/images/s1.jpg"></a></li> 
<!--li><a href="https://www.linkedin.com/" target="_blank"><img width="40" src="<?php echo base_url(); ?>assets/front/images/s2.jpg"></a></li--> 
<li><a href="https://twitter.com/" target="_blank"><img width="40" src="<?php echo base_url(); ?>assets/front/images/s3.jpg"></a></li> 
<!--li><a href="https://www.youtube.com/" target="_blank"><img width="40" src="<?php echo base_url(); ?>assets/front/images/s4.jpg"></a></li-->  
</ul>
</div>

</div>
</footer>
<!-- footer Close-->

</div>
  
<?php if(!$this->session->userdata('is_customer_logged_in')){ ?>
<!-- Modal -->
<div id="registerLoginModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Let the shopping begin!</h2>
      </div>
      <div class="modal-body">
	  
	  <div class="col-sm-6 signin-sect">
	  <img src="<?php echo base_url();?>assets/front/images/sigup.jpg"  style="margin-bottom: 10px;">
	  <h4>Sign In</h4>
	   <div id="login-msg-div"></div>
        <form class="form" action="" method="post" id="popup-login-form">
       <p><label>Username</label> <input type="email" required name="user_name" class="form-control input-empty" placeholder="Email"></p>
       <p><label>Password</label> <input type="password" required name="password" class="form-control input-empty"></p>
       <p><label>&nbsp;</label> <input type="submit" name="submit" value="Start Shopping..!" class="btn btn-primary popup-login-button">  &nbsp; <!--a href="javascript:;" class="show-register-form">Register</a--></p>
     </form>
	  </div>
	  
	  <div class="col-sm-6 signup-sect">
	  <h4>Register Free</h4>
	   <div id="register-msg-div"></div>
        <form class="form" action="" method="post" id="popup-register-form">
       <p><label>First Name</label> <input required="required" type="text" name="f_name" class="form-control input-empty"></p>
       <p><label>Last Name</label> <input required="required" type="text" name="l_name" class="form-control input-empty"></p>
       <p><label>Email</label> <input required="required" type="email" name="email" class="form-control input-empty"></p>
       <p><label>Password</label> <input type="password" name="password" class="form-control input-empty"></p>
	   <p><label>Confirm Password</label> <input type="password" name="cpassword" class="form-control input-empty"></p>
       <p><label>Phone</label> <input type="number" min="1" maxlength="10" name="phone" class="form-control input-empty"></p>
       <p><label>Bliss Code</label> <input id="bliss_code_input" type="text" name="bliss_code" class="form-control input-empty">
		   <a href="javascript:;" class="request-code">Request Code</a></p>
		    <div class="request-code-div" style="display:none;">
			<div id="request-code-result"></div>
			<div class="input-group">
               <input type="text" class="request-code-input form-control" maxlength="10" placeholder="Phone" value="">
               <div class="input-group-addon request-code-search glyphicon glyphicon-search"></div>
            </div>
			</div>
  
	   <div class="g-recaptcha" data-sitekey="6LdPmREUAAAAAKONMJzl7vnFzW5ucC0hDiyQQsG_"></div>
       <p><label>&nbsp;</label> <input type="submit" name="submit" value="Enjoy Shopping..!" class="btn btn-primary popup-register-button"> &nbsp; <!--a href="javascript:;" class="show-login-form">Login</a--></p>
     </form>
	 </div>
	 
      </div>
      
    </div> 
  </div>
</div>
<?php /* ?>
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Blisszon Login</h4>
      </div>
      <div class="modal-body">
	   <div id="login-msg-div"></div>
        <form class="form" action="" method="post" id="popup-login-form">
       <p><label>Username</label> <input type="email" name="user_name" class="form-control" placeholder="Email"></p>
       <p><label>Password</label> <input type="password" name="password" class="form-control"></p>
       <p><label>&nbsp;</label> <input type="button" name="submit" value="Login" class="btn btn-primary popup-login-button">  &nbsp; <a href="javascript:;" class="show-register-form">Register</a></p>
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="registerModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Blisszon Register</h4>
      </div>
      <div class="modal-body">
	   <div id="register-msg-div"></div>
        <form class="form" action="" method="post" id="popup-register-form">
       <p><label>First Name</label> <input required="required" type="text" name="f_name" class="form-control"></p>
       <p><label>Last Name</label> <input required="required" type="text" name="l_name" class="form-control"></p>
       <p><label>Email</label> <input required="required" type="email" name="email" class="form-control"></p>
       <p><label>Password</label> <input type="password" name="password" class="form-control"></p>
       <p><label>Phone</label> <input type="text" name="phone" class="form-control"></p>
       <p><label>&nbsp;</label> <input type="button" name="submit" value="Register" class="btn btn-primary popup-register-button"> &nbsp; <a href="javascript:;" class="show-login-form">Login</a></p>
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div> 
  </div>
</div>
<?php */ } ?>

<script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/owl.carousel.js"></script> 
<!--script src="<?php echo base_url(); ?>assets/front/js/datetimepicker.js"></script-->
<script type="text/javascript">
jQuery(document).ready(function () {
  jQuery('#popup-login-form').submit(function( event ) {  
  event.preventDefault(); 
			   jQuery.ajax({
                   type:"POST",
                   url:"<?php echo base_url(); ?>login",
                   data:jQuery("#popup-login-form").serialize(), 
                   success : function(data){ console.log(data);
                      if(data.indexOf("alert alert-success")== "-1") { jQuery("#login-msg-div").html(data); }
		      else { window.location.href = "<?php echo base_url(); ?>profile"; }
                   }
               });  
  });
 // jQuery('.popup-register-button').click(function(){ 
  jQuery("#popup-register-form").submit(function( event ) { 
  event.preventDefault();
			   jQuery.ajax({
                   type:"POST",
                   url:"<?php echo base_url(); ?>register",
                   data:jQuery("#popup-register-form").serialize(),
                   success:function(data){
					   if(data.indexOf("alert alert-success")== "-1") { jQuery("#register-msg-div").html(data); }
		              else { jQuery("#register-msg-div").html('');
					         jQuery("#login-msg-div").html(data); 
							jQuery('.input-empty').val(''); 
						} 
                   }
               });  
  });
  jQuery('.show-register-form').click(function(){
	 jQuery('#loginModal').modal('hide'); 
	 jQuery('#registerModal').modal('show'); 
  });
  jQuery('.show-login-form').click(function(){
	 jQuery('#loginModal').modal('show'); 
	 jQuery('#registerModal').modal('hide'); 
  });
	jQuery('.request-code').click(function(){
		jQuery('.request-code-div').toggle();
		jQuery('#request-code-result').html('');
		jQuery('.request-code-input').val('');
	});
	jQuery('.request-code-search').click(function(){
		var phone = jQuery('.request-code-input').val();
		jQuery.ajax({
                   type:"POST",
                   url:"<?php echo base_url(); ?>get-bliss-code-by-phone",
                   data:"phone="+phone,
                   success:function(data){
					   jQuery("#request-code-result").html(data); 
					}
               });  
	});
});
 </script>

 </body>
</html>