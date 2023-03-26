
<!-- Slider -->
		<div class="subbanner">
		<img src="<?php echo base_url();?>images/banner1.png" class="img-responsive">
	</div>
	<!-- //Banner-Slider-JavaScript -->
	<!-- //Header -->
			<div class="hepls">
<div class="container">
<div class="col-md-12 hlp">
<h2 class="title text-center">Help &amp; Support</h2>
			<div class="row about-left" style="margin:20px auto;">

                    <p class="text-left">
                        For any help or support queries kindly mail us to:
                        <b>support@aurasway.com</b> 
                        Our customer care team will be contact you shortly. If you are looking for an ISR, kindly mention your ISR query in the subject line of your mail or send mail to <b>sales@aurasway.com</b>
                    </p>
                   <p class="text-left"> <b>
                        Customer Support.
                    </b></p>
					<p class="text-left"><b>
                        Phone No:
                    </b> +910000000000</p>

                  <p style="color:red;font-weight:bold; margin-top:20px;" class="text-left">
                      <b>Note: </b><br>
                     

                      (1)                NAME, EMAIL-ID AND    PHONE NUMBER CAN ONLY BE UPDATED BEFORE KYC.<br>

                      (2)                AFTER KYC NO INFORMATION CAN BE UPDATED.<br>

                      (3)                SPONSOR ID WILL NOT CHANGE IN ANY CASE.
                  </p>
                </div>
				<div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="well well-sm">
                    <form class="form-horizontal" action="/home/support" enctype="multipart/form-data" method="post">
                        <fieldset>
                            <legend class="text-center">Submit Your Query</legend>

                            <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">Name</label>
                                <div class="col-md-9">
                                    <input id="name" name="name" placeholder="Your name" class="form-control" required="" type="text">
                                </div>
                            </div>

                            <!-- Email input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">Bank Name</label>
                                <div class="col-md-9">
                                    <input id="email" name="email" placeholder="Your email" class="form-control" required="" type="email">
                                </div>
                            </div>

                            <!-- Email input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">Phone Number</label>
                                <div class="col-md-9">
                                    <input id="phone" name="phone" placeholder="Your Phone number" class="form-control" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">Department</label>
                                <div class="col-md-9">
                                    <select id="department" class="form-control" name="department" required="">
                                        <option value="">Select Department</option>
                                        <option value="1">Sales</option>
                                        <option value="2">Support</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">Query Type</label>
                                <div class="col-md-6">
                                    <select id="qtype" class="form-control" onchange="ddchange(this)" name="qtype" required="">
                                        <option value="">Select Query Type</option>
                                        <option value="1">New</option>
                                        <option value="2">Repeat</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input style="display:none" id="oldtid" name="oldtid" placeholder="Ticket ID" class="form-control" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">ISR ID(Optional)</label>
                                <div class="col-md-9">
                                    <input id="isrid" name="isrid" placeholder="Your Affari ISRID" class="form-control" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message">Subject</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="subejct" name="subject" placeholder="Please enter your Subject" required="" type="text">
                                </div>
                            </div>
                            <!-- Message body -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message">Message</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5" required=""></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message">Attachments</label>
                                <div class="col-md-9" id="fileUploadsContainer">
                                    <input class="form-control" name="attachments[]" type="file">
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-default btn-block" onclick="extraTicketAttachment()">
                                        <i class="fa fa-plus"></i> Add More
                                    </button>
                                </div>
                            </div>

                            <script>
                                function extraTicketAttachment() {
                                    jQuery("#fileUploadsContainer").append('<input type="file" name="attachments[]" class="form-control" />');
                                }
                                function ddchange(ddl) {
                                    var val = $(ddl).val();
                                    if (val == '1') {
                                        $("#oldtid").hide();
                                    }
                                    else {
                                        $("#oldtid").show();
                                    }
                                }
                            </script>

                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                  
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
			</div>
			</div>
			</div>