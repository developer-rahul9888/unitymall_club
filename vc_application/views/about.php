<?php

						/*$to = 'hackertool9888@gmail.com';
			    	$subject ="OTP form :- OTP for unitymall";
			    	$txt = "Your OTP for unitymall is 1234"; 
			    	$headers = "From: unitymall.club"."\r\n";
			    	$headers = "MIME-Version: 1.0" . "\r\n";     
			    	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
			    	$headers .= 'From: <unitymall.club>' . "\r\n"; 
			    	echo mail($to,$subject,$txt,$headers);
			    	die();*/

?>


  <section class="page-title">
    	<div class="auto-container">
			<div class="content">
				<h1>About <span>Us</span></h1>
				<ul class="page-breadcrumb">
					<li><a href="<?php echo base_url();?>">Home</a></li>
					
					<li>About Us</li>
				</ul>
			</div>
        </div>
    </section>
    <!--End Page Title-->

	

	
	
	
	<!-- About Section Four -->
	<section class="about-section-four">
		<div class="auto-container">
			
			<!-- Sec Title -->
			
			
			<div class="row clearfix">
				
				<!-- Content Column -->
				<div class="image-column col-lg-5 col-md-12 col-sm-12">
					<div class="inner-column">
						<div class="image-1"><img src="<?php echo base_url();?>assets/front/images/about-2.jpg" alt=""></div>
						
						<div class="image-2"><img src="<?php echo base_url();?>assets/front/images/about-3.jpg" alt=""></div>
					</div>
				</div>
				
				<!-- Skills Column -->
				
					

							<div class="content-column col-sm-7">
					<div class="inner-column">
						<h3>What We Do Thing <span>Much Better ?</span></h3>
						<div class="text">
							<p>Unity Mall vision is to create India's most reliable and frictionless commerce ecosystem that creates life-changing experiences for buyers and sellers.</p>
							<p>We treat our customers at utmost priority. We always try our best to solve any query quickly so that our clients should not face any trouble because their trust is very valuable. We give our customers the most comfortable and easy online shopping portal where customer gets what they required most</p>
						</div>
			
					</div>
				</div>
					
				</div>
				
			</div>
		</div>
	</section>
	<!-- End About Section Four -->
		<!--<section class="video-section">
		<div class="auto-container">
			
			<h2>Begin your Business Career Today!

 <br> Opportunities don't happen <span>you create them.</span></h2>
			
		</div>
	</section>--->
	
	
	
	
	
	
	
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


<div id='lens'></div>

<div id='slideshow-items-container'>

  <img class='slideshow-items active' src='https://images.unsplash.com/photo-1512054502232-10a0a035d672?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80'>
  <img class='slideshow-items' src='https://images.unsplash.com/photo-1539341029274-a659646db47c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80'>
  <img class='slideshow-items' src='https://images.unsplash.com/photo-1512486130939-2c4f79935e4f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80'>

</div>

<div id='result'></div>

<div class='row'>
  <img class='slideshow-thumbnails active' src='https://images.unsplash.com/photo-1512054502232-10a0a035d672?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=100&q=80'>
  <img class='slideshow-thumbnails' src='https://images.unsplash.com/photo-1539341029274-a659646db47c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=100&q=80'>
  <img class='slideshow-thumbnails' src='https://images.unsplash.com/photo-1512486130939-2c4f79935e4f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=100&q=80'>
</div>


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
