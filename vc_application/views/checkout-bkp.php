<div class="body1 col-sm-12">
 <div class="stepwizard text-center">
    <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step text-left">
        <a href="javascript:;" type="button" class="btn btn-primary btn-circle">1</a>
        <p>Shipping</p>
      </div>
          <div class="stepwizard-step">
        <a href="javascript:;" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        <p>Payment</p>
      </div>
          <div class="stepwizard-step text-right">
        <a href="javascript:;" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        <p>Thank you</p>
      </div>
        </div>
  </div>
  <div class="col-sm-9">
      <form role="form" action="<?php echo base_url();?>checkout" method="post">
    <div class="setup-content" id="step-1">
		
		<?php $cust_id = $this->session->userdata('cust_id');
		if($cust_id=='') { 
		  echo '<p><a href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">Click here</a> for login. For complete you order you need to login first.</p>';
		} ?>
          <div class="col-xs-12 to-0-1">
		  <h4 class="cft">Add Delivery address</h4>
			  <?php  echo validation_errors(); ?>
        <div class="col-md-12">
              
              <div class="form-group">
			  
            <label class="control-label col-xs-2">First Name</label>
			<div class="col-xs-10">
            <input value="<?php echo $this->session->userdata('p_name');?>" name="name" type="text" required="required" class="form-control" placeholder=""  />
          </div>
          </div>
              <div class="form-group">
            <label class="control-label col-xs-2">Email address</label>
			<div class="col-xs-10">
            <input value="<?php echo $this->session->userdata('p_email');?>" name="email" type="email" required="required" class="form-control" placeholder="" />
          </div>
          </div>

              <div class="form-group">
            <label class="control-label col-xs-2">Contact Number</label>
			<div class="col-xs-10">
             <input value="<?php echo $this->session->userdata('p_phone');?>"  name="phone" type="text" required="required" class="form-control" placeholder=""  />
          </div>
          </div>
		                <div class="form-group">
            <label class="control-label col-xs-2">Adderss</label>
			<div class="col-xs-10">
             <input value="<?php echo $this->session->userdata('p_address');?>"  name="address" type="text" required="required" class="form-control" placeholder=""  />
          </div>
          </div>
              <div class="form-group">
            <label class="control-label col-xs-2"> </label>
			<div class="col-xs-10">
             <input value="<?php echo $this->session->userdata('p_address2');?>" type="text" name="address2" class="form-control" placeholder=""  />
          </div>
          </div>
              <div class="form-group">
            <label class="control-label col-xs-2"> City/Town</label>
			<div class="col-xs-10">
             <input value="<?php echo $this->session->userdata('p_city');?>" name="city" type="text" required="required" class="form-control" placeholder=""  />
          </div>
          </div>
              <div class="form-group">
            <label class="control-label col-xs-2"> State/territory</label>
			<div class="col-xs-10">
             <input value="<?php echo $this->session->userdata('p_state');?>" name="state" type="text" required="required" class="form-control" placeholder=""  />
          </div>
          </div>
              <div class="form-group">
            <label class="control-label col-xs-2">Postal Code</label>
			<div class="col-xs-10">
             <input value="<?php echo $this->session->userdata('p_zip');?>" name="zip" type="text" required="required" class="form-control" placeholder=""  />
          </div>
          </div>
		  
		  
              <div class="form-group3">
            <label class="control-label col-sm-12">Shipping Method</label>
			<div class="col-xs-12 lop-9">
			<span>Please Consider this when selecting your shipping option</span>
			</div>
			<div class="col-xs-12"><input name="shipping" type="radio" value="Regular" checked="checked"> Free Shipping</div>  
          </div>
          </div>
             <div class="col-sm-12 text-right"><p> <button class="btn btn-primary nextBtn" type="submit" >Next</button></p> </div>
            </div>
      </div> 
    <!--div class="row setup-content" id="step-2">
	 <div class="col-xs-12 to-0-1">
	<h4 class="cft">How do you want to pay ?</h4>
          <div class="  you-pay ">
        <ul>
		<li>Debit Card</li>
		<li>Credit Card</li>
		<li>Net Banking</li>
		<li>Bill Cash</li>
		<li>Installments</li>
		<li>Pay Pal</li>
		<li>Pay @ home</li> 
		</ul>
      </div>
        </div>
		
		 <div class="col-xs-12 to-0-1">
		  <h4 class="cft">Delivery address</h4>
        <div class="col-md-12 addrs">
		<ul>
		<li><strong>M</strong></li>
		<li> n</li>
		<li> n</li>
		<li> n</li>
		</ul>
		<button class="add-asrd" >Submit</button>
		</div>
		</div>
        </div>
    <div class="row setup-content" id="step-3">
          <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
              <h3> Step 3</h3>
              <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
            </div>
      </div>
        </div-->
  </form>
  </div>
  <?php $this->load->view('cart_sidebar'); ?>
 
    </div>


<!--script type="text/javascript">
  $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
		  allWells = $('.setup-content'),
		  allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
	  e.preventDefault();
	  var $target = $($(this).attr('href')),
			  $item = $(this);

	  if (!$item.hasClass('disabled')) {
		  navListItems.removeClass('btn-primary').addClass('btn-default');
		  $item.addClass('btn-primary');
		  allWells.hide();
		  $target.show();
		  $target.find('input:eq(0)').focus();
	  }
  });

  allNextBtn.click(function(){
	  var curStep = $(this).closest(".setup-content"),
		  curStepBtn = curStep.attr("id"),
		  nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
		  curInputs = curStep.find("input[type='text'],input[type='url'],textarea[textarea]"),
		  isValid = true;

	  $(".form-group").removeClass("has-error");
	  for(var i=0; i<curInputs.length; i++){
		  if (!curInputs[i].validity.valid){
			  isValid = false;
			  $(curInputs[i]).closest(".form-group").addClass("has-error");
		  }
	  }

	  if (isValid)
		  nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
  </script-->