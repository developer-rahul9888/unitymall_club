


  <section class="page-title">
    	<div class="auto-container">
			<div class="content">
				<h1>Recharge <span></span></h1>
				<ul class="page-breadcrumb">
					<li><a href="<?php echo base_url();?>">Home</a></li>
					
					<li>Recharge</li>
				</ul>
			</div>
        </div>
    </section>
    <!--End Page Title-->





	  

	
	
	
	<!-- recharge Section Four -->
	<section class="recharge1 main-form py-0" style="position: relative;">
<div class="container">
<div class="row">
<div class="flipcard effect__click">
                    <div class="card__front posrel">
                <div class="recharge-bills recharge-bills-home">
<div class="tabs" style=" outline: currentcolor none medium;" tabindex="7">
<form class="form" action="" method="post" id="recharge">  
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active operator-radio">
			<label class="radio-inline mo-pm" data-cls=".op-Prepaid-Mobile"><input id="abc" type="radio" checked="" name="optradio" value="Prepaid"><i class="fa fa-mobile"></i>Prepaid</label>
		</li>
		<li role="presentation" class="operator-radio">
			<label class="radio-inline mo-pm" data-cls=".op-Postpaid-Mobile"><input id="abc" type="radio" checked="" name="optradio" value="Postpaid"><i class="fa fa-mobile"></i>Postpaid</label>
		</li>
		<!---<li role="presentation" class="operator-radio">
			 <label class="radio-inline mo-dc" data-cls=".op-Datacard"><input type="radio" name="optradio" value="Datacard"><i class="fa fa-credit-card"></i>Datacard</label>
		</li>  --->
		
		<li role="presentation" class="operator-radio">
			<label class="radio-inline dth-op" data-cls=".op-DTH"><input type="radio" name="optradio" value="DTH"><i class="fa fa-television"></i>DTH</label>
		</li>
		<li role="presentation" class="operator-radio">
			 <label class="radio-inline elec" data-cls=".op-Electricity"><input type="radio" name="optradio" value="Electricity"><i class="fa fa-lightbulb-o"></i>Electricity</label>
		</li>
		<li role="presentation" class="operator-radio">
			 <label class="radio-inline water" data-cls=".op-Electricity"><input type="radio" name="optradio" value="Electricity"><i class="fa fa-tint"></i>Water</label>
		</li>
		<li role="presentation" class="operator-radio">
			 <label class="radio-inline Insurance" data-cls=".op-Electricity"><input type="radio" name="optradio" value="Electricity"><i class="fa fa-file"></i>Insurance</label>
		</li>
		<li role="presentation" class="operator-radio">
			 <label class="radio-inline Loan" data-cls=".op-Electricity"><input type="radio" name="optradio" value="Electricity"><i class="fa fa-inr"></i>Pay Loan</label>
		</li>
		<li role="presentation" class="operator-radio">
			 <label class="radio-inline Bus" data-cls=".op-Electricity"><input type="radio" name="optradio" value="Electricity"><i class="fa fa-bus"></i>Bus Travale</label>
		</li>
		 
		 
	</ul>
</form></div>
<script>
$(document).ready(function () {
    $('.nav li label').click(function(e) {
        $('.nav li.active').removeClass('active');
        var $parent = $(this).parent();
        $parent.addClass('active');
        e.preventDefault();
    });
});
</script>
	  
  
<div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="mobile">
        <div class="row electricity-overflow" style="overflow: hidden; outline: currentcolor none medium;" tabindex="0">
            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
                <div class="radio"> 
					<label>
					<span class="mobno">Mobile Number</span>
					<span style="display:none" class="dth-sh">Customer ID / Subcsriber ID</span>
					<span style="display:none" class="elec-sh">Consumer Number</span>
					<span style="display:none" class="water_r">Water</span>
					<span style="display:none" class="Insu_rance">Insurance</span>
					<span style="display:none" class="Pay_Loan">Pay Loan</span>
					<span style="display:none" class="bus_travale">Bus Travale</span>
					</label>
                </div>
            </div>  
            <div class="clearfix"></div>
            <div class="space"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                   <div class="field-mobilerecharge-service_number required">
<div class="input-group"><!--span class="input-group-addon rupee1">+91</span--><input type="number" id="mobilerecharge-service_number" class="form-control integerOnly nozero checkNumber input-empty phone-input" name="phone" maxlength="10" autocomplete="off"></div>
</div>  
<div class="clearfix"></div>
 <div class="field-mobilerecharge-operator required">
<select id="mobilerecharge-operator" class="form-control  with-arrow custom-select-operator" name="operator" required="">
	<option class="op-first-operator" value="">Select</option> 
			  <option class="op-Prepaid-Mobile" value="BILAVAIRTEL001" style="display:block">AIRTEL</option>			  </select><input type="hidden" name="circle" value="18">
			  <input type="hidden" name="operator_commision" id="operator_commision" value="0"> 
			  <input type="hidden" name="operator_cashback" id="operator_cashback" value="0"> 
			  <input type="hidden" name="merchant_cashback" id="merchant_cashback" value="0"> 

<div class="help-block"></div>
</div>
<div class="clearfix"></div>
<div class="field-mobilerecharge-amount required">
<div class="input-group"><span class="input-group-addon rupee">₹</span><input type="number" id="amount" class="form-control integerOnly nozero input-empty amount-input" name="amount" maxlength="5" placeholder="Enter Amount"></div><div class="help-block"></div> 
</div>
 
 <div class="field-mobilerecharge-amount required">
                 <div class="input-group"><input type="password" class="form-control integerOnly nozero input-empty pin-input" maxlength="4" name="pin" placeholder="Transaction PIN"></div>
</div>  

            </div>
            </div>
            
            
           
            
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                 <div class="form-group operator-name">
				 <span class="mobno"><img src="<?php echo base_url();?>assets/front/images/mobile.jpg" alt=""></span>
				 <span style="display:none" class="dth-sh"><img src="<?php echo base_url();?>assets/front/images/DTH-RECHAGE.jpg" alt=""></span>
					<span style="display:none" class="elec-sh"><img src="<?php echo base_url();?>assets/front/images/electricty.jpg" alt=""></span> 
					<span style="display:none" class="water_r"><img src="<?php echo base_url();?>assets/front/images/waterbill.jpg" alt=""></span> 
					<span style="display:none" class="Insu_rance"><img src="<?php echo base_url();?>assets/front/images/insurance.jpg" alt=""></span> 
					<span style="display:none" class="Pay_Loan"><img src="<?php echo base_url();?>assets/front/images/payloan.jpg" alt=""></span> 
					<span style="display:none" class="bus_travale"><img src="<?php echo base_url();?>assets/front/images/bus-1.jpg" alt=""></span> 
                             
				</div>
            </div> 
		
			 
			<p><span>  <b class="br_plan"><a href="JavaScript:void(0);">Browse Plans</a> </b>of all operators</span></p>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="mb_recharge_sub_container">

<button type="button" id="button-mobile-recharge" data-toggle="modal" data-target="#registerLoginModal" class="btn btn-primary btn-block num-show-button " name="submit">Pay Here</button>

				</div>		
				</div>		
 
				 

    <div id="rechargeModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title text-center">Please Confirm</h4>
      </div>
      <div class="modal-body">
        <p class="red">Please fill all required fields.</p>
        <p class="greenn">Your <span class="mobno">Mobile Number</span>
					<span style="display:none" class="dth-sh">Customer ID / Subcsriber ID</span>
					<span style="display:none" class="elec-sh">Consumer Number</span> is <b><span class="phone-div"></span></b> and Amount is Rs. <b><span class="amount-div"></span></b> <br>		<br>	<b>Payment Type</b>	&nbsp; &nbsp; 
		<label class="radio-inline">
		<input type="radio" name="paytype" value="Wallet" checked="">		</label> 

		</p>

      </div>

      <div class="modal-footer foot-back"><input type="submit" name="confirm" value="Confirm" class="btn btn-success butn">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        </div>                         
	</div>
	<div role="tabpanel" class="tab-pane fade hide in" id="electricity">           
        <div class="row electricity-overflow" style="overflow: hidden; outline: currentcolor none medium;" tabindex="0">
            <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
                <div class="radio">
					<label><span class="mobno1">Customer Id</span></label>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="space"></div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                        <div class="field-mobilerecharge-service_number required">
<div class="input-group"><input type="number" id="mobilerecharge-service_number" class="form-control integerOnly nozero checkNumber input-empty phone-input" name="uid" maxlength="10" autocomplete="off"></div>
</div>                
                </div>
            </div>          
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group operator-name">
                        <div class="field-mobilerecharge-amount required">
<div class="input-group"><span class="input-group-addon rupee">₹</span><input type="number" id="amount" class="form-control integerOnly nozero input-empty amount-input" name="MobileRecharge[amount]" maxlength="5" placeholder="Enter Amount"></div><div class="help-block"></div>
</div>              
  </div>
  </div>			
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                 <div class="form-group operator-name">
                 <div class="field-mobilerecharge-amount required">
                 <div class="input-group"><input type="password" class="form-control integerOnly nozero input-empty pin-input" maxlength="4" name="pin" placeholder="Transaction PIN"></div>
</div>              
  </div>
            </div>

			

			

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="mb_recharge_sub_container">



<button type="button" id="button-mobile-recharge" data-toggle="modal" data-target="#registerLoginModal" class="btn btn-primary btn-block " name="submit">Recharge Now</button>

				</div>		 

        </div>

                           

	</div>

        


<div class="" id="sh_plan" style=" display:none; ">

<div class="alert alert-success">

      <a href="#" class="close">×</a>

     

	<h3>Browse Plans</h3>

	<!-- required for floating -->

	<!-- Nav tabs -->

	<div class="plan-cnt">

		<ul class="nav nav-tabs list rc_web">

			<li class="active operator-radio">

				<label href="#best-offer" data-toggle="tab">Best Offer</label>

			</li>

			<li class="operator-radio">

				<label href="#full-talktime" data-toggle="tab">Full Talktime</label>

			</li>

			<li class="operator-radio">

				<label href="#3gdata" data-toggle="tab">3G/4G Data</label>

			</li>

			<li class="operator-radio">

				<label href="#2gdata" data-toggle="tab">2G Data</label>

			</li>

			<li class="operator-radio">

				<label href="#topup" data-toggle="tab">Top Up</label>

			</li>

			<li class="operator-radio">

				<label href="#sprecharge" data-toggle="tab">Special Recharge</label>

			</li>

			<li class="operator-radio">

				<label href="#roaming" data-toggle="tab">Roaming</label>

			</li>

		</ul>





		<!-- Tab panes -->

		<div class="tab-content">

			<div class="tab-pane active" id="best-offer">

				<div class="table-responsive">

					<table class="table oo">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							
						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="full-talktime">

				<div class="table-responsive">

					<table class="table">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							
						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="3gdata">

				<div class="table-responsive">

					<table class="table oo">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							
						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="2gdata">

				<div class="table-responsive">

					<table class="table ">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							
						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="topup">

				<div class="table-responsive">

					<table class="table">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							
						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="sprecharge">

				<div class="table-responsive">

					<table class="table">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							
						</tbody>

					</table>

				</div>

			</div>

			<div class="tab-pane" id="roaming">

				<div class="table-responsive">

					<table class="table">

						<thead>

							<tr>

								<th>Price</th>

								<th>Talktime</th>

								<th>Validity</th>

								<th>Description</th>

							</tr>

						</thead>

						<tbody>

							
						</tbody>

					</table>

				</div>

			</div>

		</div>

	</div>

</div>

      </div>







  </div>

  
				</div>

                    </div>

			  </div>		

			   

              </div>

                </div>

            </section>
	<!-- End recharge Section Four -->
		<!--<section class="video-section">
		<div class="auto-container">
			
			<h2>Begin your Business Career Today!

 <br> Opportunities don't happen <span>you create them.</span></h2>
			
		</div>
	</section>--->