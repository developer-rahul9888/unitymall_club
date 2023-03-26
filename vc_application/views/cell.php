
<!-- Slider -->
		<div class="subbanner">
		<img src="<?php echo base_url();?>images/banner1.png" class="img-responsive">
	</div>
	<!-- //Banner-Slider-JavaScript -->
	<!-- //Header -->
			<div class="hepls">
<div class="container">
<div class="col-md-12 cell">
<h2 class="title text-center">Grievance Cell Mechanism</h2>
<p class="text-left">
At Auras Way Private Limited, satisfaction of our customers as well as distributors is at prime focus. We are committed to serve them with industry’s best practices, which minimizes incidents of dissatisfaction. Though, if such issues take place we have set up Grievances Cell which address the issues and solve it out in timely manner to manage satisfaction level of the people who deals with us.
                        <br>
                    </p>
	
	<ul class="ram text-left" style="margin:20px auto;"> 
                            <li>
                                <strong>	HOW TO RAISE THE COMPLAINT :</strong><br> Customers, Distributors or any other persons who have complaint with us, can raise their voice in following ways.


                                <ul class="kishan">
                                    <li>
                                        <strong>	CALL TO OUR CUSTOMER CARE :</strong> <br>They can make a call on our Customer Care No :
                                                                                         <strong> +91 0000000000</strong> and lodge their issues.

                                    </li>
                                    <li>
                                        <strong>	MAIL TO CUSTOMER CARE :</strong> <br>They can e-mail their quires on our customer care mail address - <strong>grievance@aurasway.com</strong>
</li>
                                    <li>
                                        <strong>
                                            FEEDBACK / QUIRES ON WEBSITE :
                                        </strong> <br>They can put their quires which is available on our<strong> website -https://www.aurasway.com</strong>
</li>
                                    <li>
                                        <strong>WRITE A LETTER :</strong> They can write letter with details of their quires and send it to our official address -<strong> Auras Way Private Limited, a Company incorporated under companies act 1956 Govt. of India. Auras Way was started in August 2018 with just 2 products and now we have a range of Product with us</strong>
</li>

                                </ul>
                            </li>
                            <li>
                                <strong>	HOW IT WILL BE SOLVED :</strong><br>
                                First of all complaint will be registered and complaint number will be generated. Then as per nature of complaint, it will be placed to the concern department and tentative time to solve this issue will be demanded. Then after complaint will be informed on mail or phone about the confirmation that their complaint is registered and complaint number will be provided to them as well tentative time to solve the issue will be informed.
                            </li>
                            <li>
                                <strong>	TIME FRAME :</strong><br>
                                Most of the complaints are being solved within 4 working days. However its our commitment that every issue will be resolved within 14 days from the date of registration o the same. Once the issue is resolved, complainant is again informed on mail or over phone and the issue is closed.
                            </li>
                            <li>
                                <strong> MAINTENANCE OF RECORD  :</strong><br>
                                Digital complaint register is duly maintained. Manager (Operations) as well as company directors will periodically review the complaint and details.
                            </li>
                            <li>
                                <strong>5.	CUSTOMER GRIEVANCE REDRESSAL COMMITTEE :</strong><br>
                                                                                             <ul class="kishan">
                                                                                                 <li>
                                                                                                     <strong> support@aurasway.com-</strong>
                                                                                                 </li>
                                                                                                
                                                                                             </ul>


                              
                            </li>
                        <div></div></ul>
						
						<div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="well well-sm">
                    <form class="form-horizontal" action="/home/grventry" enctype="multipart/form-data" method="post">
                        <fieldset>
                            <legend class="text-center">Submit Your Grievance</legend>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">Description (Max 600 Characters) </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="message" cols="20" rows="2" required=""></textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">Action Required (Max 400 Characters) </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="actionreq" cols="20" rows="2" required=""></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message">Upload Documents if Required</label>
                                <div class="col-md-9" id="fileUploadsContainer">
                                    <input class="form-control" name="attachments[]" type="file">
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-default btn-block" onclick="extraTicketAttachment()">
                                        <i class="fa fa-plus"></i> Add More
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">Department Concerned</label>
                                <div class="col-md-9">
                                    <select id="department" class="form-control" name="department" required="">
                                        <option value="">Select Department</option>
                                        <option value="1">Sales</option>
                                        <option value="2">Support</option>
                                        <option value="3">Technical</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message">Grievance Location	</label>
                                <div class="col-md-9" id="fileUploadsContainer">
                                    <textarea class="form-control" name="location" cols="20" rows="2"></textarea>
                                </div>

                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-center">Your Details</legend>
                            <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">Name</label>
                                <div class="col-md-9">
                                    <input id="name" name="name" placeholder="Your name" class="form-control" required="" type="text">
                                </div>
                            </div>

                            <!-- Email input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">E-mail</label>
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
                                <label class="col-md-3 control-label" for="email">ISR ID</label>
                                <div class="col-md-9">
                                    <input id="isrid" name="isrid" placeholder="Your Affari ISRID" class="form-control" required="" type="number">
                                </div>
                            </div>

                            <!-- Message body -->




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