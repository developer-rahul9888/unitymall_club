 <link href="<?php echo base_url(); ?>assets/front/css/style1.css" rel="stylesheet">


<!-- Slider -->
	  <section class="page-title">
    	<div class="auto-container">
			<div class="content">
				<h1>Single <span>Product</span></h1>
				<ul class="page-breadcrumb">
					<li><a href="<?php echo base_url();?>">Home</a></li>
					
					<li>Single Product</li>
				</ul>
			</div>
        </div>
    </section>

	<!-- //Header -->
<?php //print_r($products); ?>
<section>
			<div class="container">
						<?php if(empty($products)) { ?>	<p>Product not found.</p><?php } else { 	$prod = $products[0];	?>
						<div class="row">				
						<div class="col-sm-12 padding-right">
						<div class="product-details"><!--product-details-->	
						<div class="col-sm-5">	
							
						<div id='slideshow-items-container' class="slideshow-itemss">
						
						
						  <img class='slideshow-items active' src='<?php echo base_url();?>main-admin/images/product/<?php echo $products[0]['image'];?>'>
						  
						  <?php if(!empty($store)){
	foreach($store as $prods){
	
	?>
						  <img class='slideshow-items' src='<?php echo base_url();?>main-admin/images/product/<?php echo $prods; ?>'>
						  
						  <?php 

}
						}
						
						?>

						</div>

						<div class='row slideshow-thumbnailss'>
						  <img class='slideshow-thumbnails active' src='<?php echo base_url();?>main-admin/images/product/<?php echo $products[0]['image'];?>'>
						  
						  <?php if(!empty($store)){
	foreach($store as $prods){
	
	?>
						  <img class='slideshow-thumbnails' src='<?php echo base_url();?>main-admin/images/product/<?php echo $prods; ?>'>
						  
						  <?php 

}
						}
						
						?>
						 
						</div>	
						
					<!--	<div class="view-product imgBox">				
						<?php if($prod['image']=='') { 	$image_url = base_url().'images/product.jpg';	} else {$image_url = base_url().'main-admin/images/product/'.$prod['image'].'';	} ?>	
						<img src="<?php echo $image_url;?>" alt="" class="img-responsive" data-origin="<?php echo $image_url;?>">
						</div>   -->
						
						</div>	
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->	
							<h2><?php echo $prod['pname'];?></h2>
							<p>Pro. ID: <?php echo $prod['sku'];?></p>
								<span class="p_d_price">
								<h3><?php echo 'MRP. '.$prod['cost'];?></h3>
								<!-- <p><?php echo 'MRP: '.$prod['p_d_price'];?></p> -->
								<h3><?php echo 'Coins: '.$prod['comm_dis'];?></h3>
								<h3><?php echo 'Reward Points: '.$prod['reward'];?></h3>
								
								<label>Quantity:</label>
								<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" class="form form-inline crt-btn">	
								<div class="hide">	
								<input type="hidden" name="name" value="<?php echo $prod['pname'];?>">	
								<input type="hidden" name="id" value="<?php echo $prod['id'];?>">	
								<input type="hidden" name="image" value="<?php echo $image_url;?>">	
								<input type="hidden" name="tax" value="<?php echo $prod['p_d_price']*$prod['t_class']/100;?>">	
								</div>
								<input type="number" required min="1" name="qty"  value="1" class="form-control qty-no" placeholder="Qty.">
								<button type="submit" class="btn btn-fefault cart">	
								<i class="fa fa-shopping-cart"></i> Add to cart					
								</button>
								</form>	
								</span>	
								<p><b>Availability:</b> In Stock</p>
								<p><b>Brand:</b> <?php echo $prod['brand']; ?></p> 
								<p><b>Rating:</b> <img src="<?php echo base_url(); ?>assets/front/images/rating.png" alt=""></p>
								</div><!--/product-information-->	
								</div>			 
								</div><!--/product-details-->
								<div class="category-tab shop-details-tab"><!--category-tab-->
								<div class="col-sm-12">	
								<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
								<li ><a href="#reviews" data-toggle="tab">Reviews</a></li>
								</ul>
								</div>	
								<div class="tab-content">
								<div class="tab-pane fade  active in" id="details" >
								<div class="col-sm-12">
								<p><?php echo $prod['s_discription']; ?></p>
								<?php echo $prod['description'];?>																		
								</div>
								</div>
								<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">	

				                <?php if(!empty($review)) 
								{foreach($review as $reviews) { 

									//print_r ($reviews);
									
								
									
								echo	'<ul>						
								<li><a href=""><i class="fa fa-user"></i>'.$reviews['name'].'</a></li>
								<li><a href=""><i class="fa fa-clock-o"></i>'.date('h:i A',strtotime($reviews['r_date'])).'</a></li>
								<li><a href=""><i class="fa fa-calendar-o"></i>'.date('d F Y',strtotime($reviews['r_date'])).'</a></li>

								</ul>									
								<p>'.$reviews['comment'].'</p>';
									} 
								} ?>


								<p><b>Write Your Review</b></p>	
								<div id="review-msg-div"></div>
								 <form class="form" action="" method="post" id="review">
								<span>					
								<input required type="text" name="name" placeholder="Your Name"/>
								<input required type="email" name="email" placeholder="Email Address"/>
								<input  type="hidden" name="pro_id" value="<?php echo $prod['id'];?>"/>										
								</span>		
								<textarea required name="comment" ></textarea>
								
								<input class="star star-5" id="star-5" type="radio" name="rating" value="5"/>
								<label class="star star-5" for="star-5"></label>
								<input class="star star-4" id="star-4" type="radio" name="rating" value="4"/>
								<label class="star star-4" for="star-4"></label>
								<input class="star star-3" id="star-3" type="radio" name="rating"value="3"/>
								<label class="star star-3" for="star-3"></label>
								<input class="star star-2" id="star-2" type="radio" name="rating" value="2"/>
								<label class="star star-2" for="star-2"></label>
								<input class="star star-1" id="star-1" type="radio" name="rating" value="1"/>
								<label class="star star-1" for="star-1"></label>
								
								<input type="submit" name="submit" value="Submit" class="btn btn-primary popup-register-button">
								</form>	
								</div>	
								</div>	
								</div>	
								</div><!--/category-tab-->		
								
								</div>	
								</div>	
								<?php } ?>		
								</div>	
								</section>	



<style>
	#owl-product .owl-nav{text-align:center;}
	#owl-product .owl-nav div {position: relative;top: 0;font-size: 22px !important;width: 55px;height: 40px;display: inline-block;margin: 1px 23px;}
	
.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 1px;
  font-size: 23px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}










	
	
.slideshow-itemss {
	width: 100%;
	max-height: 430px;
	min-height: 430px;
	overflow: hidden;
	margin-top: 25px;
}
.slideshow-itemss .slideshow-items.active {
	width: 85%;
}


.slideshow-items {
  width: 500px;
}
.slideshow-thumbnails {
  width: 100px;
}
#slideshow-items-container { display: inline-block; position: relative; }

#lens { background-color: rgba( 233, 233, 233, 0.4 ) }
#lens, #result { position: absolute; display: none; z-index: 1; }
.slideshow-items { display: none; }
.slideshow-items.active { display: block; }
.slideshow-thumbnails { opacity: 0.5; }
.slideshow-thumbnails.active { opacity: 1; }
#lens, .slideshow-items, .slideshow-thumbnails, #result { border: solid var(--light-grey-2) 1px; }





</style>







<script>
	$(document).ready(function() {

  $('.slideshow-thumbnails').hover(function() { changeSlide($(this)); });

  $(document).mousemove(function(e) {
    var x = e.clientX; var y = e.clientY;
    
    var x = e.clientX; var y = e.clientY;

    var imgx1 = $('.slideshow-items.active').offset().left;
    var imgx2 = $('.slideshow-items.active').outerWidth() + imgx1;
    var imgy1 = $('.slideshow-items.active').offset().top;
    var imgy2 = $('.slideshow-items.active').outerHeight() + imgy1;

    if ( x > imgx1 && x < imgx2 && y > imgy1 && y < imgy2 ) {
      $('#lens').show(); $('#result').show();
      imageZoom( $('.slideshow-items.active'), $('#result'), $('#lens') );
    } else {
      $('#lens').hide(); $('#result').hide();
    }

  });
  
});

function imageZoom( img, result, lens ) {

  result.width( img.innerWidth() ); result.height( img.innerHeight() );
  lens.width( img.innerWidth() / 2 ); lens.height( img.innerHeight() / 2 );

  result.offset({ top: img.offset().top, left: img.offset().left + img.outerWidth() + 10 });

  var cx = img.innerWidth() / lens.innerWidth(); var cy = img.innerHeight() / lens.innerHeight();

  result.css('backgroundImage', 'url(' + img.attr('src') + ')');
  result.css('backgroundSize', img.width() * cx + 'px ' + img.height() * cy + 'px');

  lens.mousemove(function(e) { moveLens(e); });
  img.mousemove(function(e) { moveLens(e); });
  lens.on('touchmove', function() { moveLens(); })
  img.on('touchmove', function() { moveLens(); })

  function moveLens(e) {
    var x = e.clientX - lens.outerWidth() / 2;
    var y = e.clientY - lens.outerHeight() / 2;
    if ( x > img.outerWidth() + img.offset().left - lens.outerWidth() ) { x = img.outerWidth() + img.offset().left - lens.outerWidth(); }
    if ( x < img.offset().left ) { x = img.offset().left; }
    if ( y > img.outerHeight() + img.offset().top - lens.outerHeight() ) { y = img.outerHeight() + img.offset().top - lens.outerHeight(); }
    if ( y < img.offset().top ) { y = img.offset().top; }
    lens.offset({ top: y, left: x });
    result.css('backgroundPosition', '-' + ( x - img.offset().left ) * cx  + 'px -' + ( y - img.offset().top ) * cy + 'px');
  }
}


function changeSlide(elm) {
  $('.slideshow-items').removeClass('active');
  $('.slideshow-items').eq( elm.index() ).addClass('active');
  $('.slideshow-thumbnails').removeClass('active');
  $('.slideshow-thumbnails').eq( elm.index() ).addClass('active');
}

</script>

