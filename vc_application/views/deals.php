<h2><?php echo $merchant[0]['d_name'];?></h2>
<div class="col-sm-9">
   <div class="col-sm-8">
   <div class="col-sm-3 bli-thm text-center">
   <ul>
   <li><img src="<?php echo base_url();?>assets/images/th.jpg"></li>  
   <li><img src="<?php echo base_url();?>assets/images/th.jpg"></li>  
   <li><img src="<?php echo base_url();?>assets/images/th.jpg"></li>  
   </ul>
  </div>
   <div class="col-sm-9 fol"><img src="<?php echo base_url();?>assets/images/th1.jpg"></div>
   <!-- address -->
   <div class="col-sm-12 mrc-ads">
   <div class="op-0po">
   <h3>Name</h3>
   <span>Address</span>
   </div>
   <div class="op-0po">
   <h3>Deals</h3> 
   </div>
   <div class="op-0po">
   <h3>Rate</h3> 
   </div>
   <div class="op-0po">
   <h3>tags</h3> 
   </div>
   </div>
    <div class="col-sm-12 mrc-ds">
	<strong>Deals details</strong>
<pre>




</pre>
	</div>
    <div class="col-sm-12 mrc-ds">
	<strong>Terms & Conditions </strong>
<pre>




</pre>
	</div>
    <div class="col-sm-12 mrc-ds">
	<strong>More form name </strong>
	<img src="<?php echo base_url();?>assets/images/th.jpg"> 
	</div>
       <div class="col-sm-12 mrc-ds">
	<strong>Merchant detail </strong>
<pre>




</pre>
	</div>
   
   </div>
    <div class="col-sm-4">
	<div class="dls-dl col-sm-12 text-center">
	<strong>Make your deals</strong>
	<span>name</span>
	<ul class="list-inline tio">
	<li><small>Available Blise</small><br><input type="text"></li> 
	<li><small>Blise To Merchant</small><br><input type="text"></li> 
	<li><small>Blise Left</small><br><input type="text"></li> 
	</ul>
	<button>Make Deals</button>
	</div>
	<div class="dls-dl col-sm-12 text-center">
	<strong>Make your deals</strong>
	<span>name</span>
	<ul class="dls-lst">
		<?php
if(!empty($deals)) {
	foreach($deals as $deal) {
	  echo '<li><label>'.$deal['title'].':</label> <input type="checkbox"></li>';	
	}
} ?>
	<li><label>Deals 1:</label> text <input type="checkbox"></li>
	<li><label>Deals 1:</label> text <input type="checkbox"></li>
	</ul>
	<button>Make Deals</button>
	</div>
	</div>
	
	<div class="col-sm-12">
	<span>Address</span>
		<div class="col-sm-12">
	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15258308.700625544!2d82.7526305!3d20.98570035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1483615260795" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	
	</div>
	</div>
   </div>
   <div class="col-sm-3 bls-rgt-sid text-center">
   <h3>also like</h3>
   <div class="loc-de">
 <img src="<?php echo base_url();?>assets/images/ttt.jpg">
 <img src="<?php echo base_url();?>assets/images/ttt.jpg">
 <img src="<?php echo base_url();?>assets/images/ttt.jpg">
 <img src="<?php echo base_url();?>assets/images/ttt.jpg">
 <img src="<?php echo base_url();?>assets/images/ttt.jpg">
 <img src="<?php echo base_url();?>assets/images/ttt.jpg">
 <img src="<?php echo base_url();?>assets/images/ttt.jpg">
  </div>
   
   </div>
   <style> 
   .tio li small{}
   .tio input{width:100px}
   .dls-dl{padding:;margin:0 0 20px}
   .dls-lst  {margin:0;float:left;list-style:none;padding:0;width:100%;padding:0 15px;text-align:left}
   .dls-lst li{font-size:18px;margin:0 10px}
   .dls-lst input{float:right}.bli-thm img, .fol img{border:1px solid #f8f8f8;padding:3px}
   .dls-dl span{color:#f00;padding:5px 0;font-size:22px;display:block}
   .dls-dl strong{background:#3d393a;color:#fff;font-size:18px;text-transform:uppercase;display:block;padding:8px}
   .dls-dl button{background:#0098da;color:#fff;font-size:18px;text-transform:uppercase;display:block;padding:8px;width:100%;border:0}
   .mrc-ds{background:#f8f8f8;margin:10px 0;padding:15px }
   .mrc-ds strong{margin:0 0 10px;display:block;font-size:25px}
   .mrc-ads{border:1px solid #f8f8f8;padding:15px;;margin:15px 0}
   .op-0po{border:1px solid #e8e8e8;margin-bottom:10px}
   .op-0po h3{background:#f8f8f8;margin:0;padding:5px 15px}
   .op-0po span{padding:5px 15px;display:block}
   .bli-thm ul{margin:0;padding:0}
   .bli-thm ul li{list-style:none; margin-bottom:10px}
   img{max-width:100%}
   .bls-rgt-sid{background:#A9ABAE}
   .bls-rgt-sid .loc-de{margin:10px 0}
   .bls-rgt-sid .loc-de img{border:3px solid #606062;margin:5px 0} 
   </style>