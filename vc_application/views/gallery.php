<style>


.view {
    overflow: hidden;
    position: relative;
}
.view {
    overflow: hidden;
    position: relative;
    margin-top: 2em;
}



body a {
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
    text-decoration: none;
}
.view img {
    display: block;
    position: relative;
    box-shadow: 0 4px 9px rgba(0, 0, 0, 0.4);
    border: 2px solid #51A8B1;
    height: 253px;
}


</style>


 <link href="<?php echo base_url(); ?>assets/front/css/lsb.css" rel="stylesheet">

  <section class="page-title">
    	<div class="auto-container">
			<div class="content">
				<h1>Our <span>Gallery</span></h1>
				<ul class="page-breadcrumb">
					<li><a href="<?php echo base_url();?>">Home</a></li>
					
					<li>Our Gallery</li>
				</ul>
			</div>
        </div>
    </section>
    <!--End Page Title-->


	
	<section class="about bg-offwhite ">
        <div class="container">
           
           <div class="row align-items-center mttpp">
			
			
									<?php 
if(!empty($gallery)) { 
	foreach($gallery as $categoryproduct) {
		
               echo'
					<div class="col-md-4 new-grid-w3l view view-eighth" style="width:none;">
					<a href="'.base_url().'main-admin/images/product/'.$categoryproduct['image'].'" class="lsb-preview wthree_p_grid" data-lsb-group="header">  
						<img class="img-responsive center-block" src="'.base_url().'main-admin/images/product/'.$categoryproduct['image'].'" alt="'.$categoryproduct['title'].'" class="img-responsive" />
						</a>
					</div> ';
					}
				
}?>	
				
		
				
            </div>
			
		

			
        </div>
    </section>
	
	
				
<script src="<?php echo base_url(); ?>assets/front/js/lsb.min.js"></script>
<script>
	jQuery(window).load(function() {
		  jQuery.fn.lightspeedBox();
		});
	</script> 
	
<script type="text/javascript"> 
jQuery(document).ready(function () { 

jQuery('.imgBox').imgZoom({
  boxWidth: 460,
  boxHeight: 460,
  marginLeft: 5,
});
	
 jQuery(".ferd").click(function(){
        jQuery(".fdr").hide(); 
        jQuery(".fdr2").show();
    });
	    jQuery(".lgt").click(function(){
        jQuery(".fdr2").hide(); 
        jQuery(".fdr").show();
    });


    var showChar = 759;
	var ellipsestext = " ... ";
	var lesstext = " Read less  ";
	var moretext = " Read more  ";
	 jQuery(".more").each(function() {
		var content = jQuery(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-0, content.length - showChar);

			var html = c + '<span class="moreelipses">'+ellipsestext+'</span><span class="morecontent"><span style="display:none;">' + h + '</span><a href="JavaScript:Void(0);" class="morelink">'+moretext+'</a></span>';

			jQuery(this).html(html);
		}

	});

	jQuery(".morelink").click(function(){
		if(jQuery(this).hasClass("less")) {
			jQuery(this).removeClass("less");
			jQuery(this).html(moretext);
		} else {
			jQuery(this).addClass("less");
			jQuery(this).html(lesstext);
		}
		jQuery(this).parent().prev().toggle();
		jQuery(this).prev().toggle();
		return false;
	});
	
	
});

 </script>	
	
