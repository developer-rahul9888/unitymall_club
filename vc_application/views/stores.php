<div class="container-fluid single_store">
	<div class="shoes-grid">

		<img src="<?php echo base_url() ?>main-admin/images/webstores/<?php echo $store[0]['web_img'];?>" class="img-responsive" alt=" " />
		<p class="text-center">Buy any Product via unity mall to get Cashback</p>
		<?php if ($this->session->userdata('is_customer_logged_in')) {
			//$link='<a class="btn btn-primary get_deal openPopup " href="'.base_url().'redirecting/'.$store[0]['id'].'/'.$store[0]['web_name'].'" target="_blank">';
			$link = '<a class="btn btn-primary get_deal openPopup " href="' . $store[0]['web_url'] . '" target="_blank">';
		} else {
			$link = '<a data-link="' . base_url() . 'redirecting/' . $store[0]['id'] . '/' . $store[0]['web_name'] . '" class="btn btn-primary get_deal openPopup goto" title="Login" href="javascript:;" data-toggle="modal" data-target="#registerLoginModal">';
		}  ?>
		<?php echo $link; ?>Go To Website</a>
	</div>
</div>



<section class="webstore1">
	<div class="container">

		<div class="col-sm-12">
			<div class="webstore-container">
				<div class="products" style="margin-bottom: 0;">

					<h5 class="latest-product">Terms &amp; Conditions</h5>
				</div>
				<div class="product-left">
					<h3></h3>
					<ul>
						<li> To earn Cashback, visit website via Unitty Mall and then shop.</li>
						<li> To start earning Cashback, you must complete your purchase in the same session after clicking from Unitty Mall.</li>
						<li> Don't close the website while shopping. If you do, you must again click through Unitty Mall to start a new session.</li>
						<li> You will not get cashback, if you pay for your order using retailers' credits, gift cards or vouchers.</li>
						<li> Make sure your shopping cart is empty when you click through to the store from Unitty Mall. If you add products before you click via Unitty Mall, your purchase will not track.</li>
						<li> Don't click on other links to go to a website or click on pop-up ads while searching and shopping.</li>
						<li> Do not visit any other price comparison, coupon or deal site before placing your order. Else your Cashback will not be tracked.</li>
						<li> Don't open multiple tabs of a website. Make sure the website is opened only via Unitty Mall. If you want to shop some more after checking out the first time, you must go back to Unitty Mall and click back through to the website again.</li>
						<li> Cashback is not payable if you return any part of your order. Even if you exchange any part of your order, Cashback will be Cancelled.</li>
						<li> Cashback will not be paid on GST, delivery, card payment fees, taxes or any other additional charges.</li>
					</ul>
					<div class="clearfix"> </div>
				</div>

			</div>
		</div>
	</div>
</section>


<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body store_body"> </div>
			<div class="modal-footer"> <button type="button" class="close" data-dismiss="modal">&times;</button> </div>
		</div>
	</div>
</div>

<!--      <?php //$this->load->view('includes/front/leftsidebar');
			?> -->