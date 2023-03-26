<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<!--div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Sportswear
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">Nike </a></li>
											<li><a href="#">Under Armour </a></li>
											<li><a href="#">Adidas </a></li>
											<li><a href="#">Puma</a></li>
											<li><a href="#">ASICS </a></li>
										</ul>
									</div>
								</div>
							</div-->
							
							
							
							
							
							<?php if(isset($category_list) && (!empty($category_list))) { 
	  
	foreach($category_list as $category) {
		echo '<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="'.base_url().'category/'.str_replace(' ','-',$category['c_name']).'">'.$category['c_name'].'</a></h4>
								</div>
							</div>';
	}
	
} ?>
							
						<div class="panel-heading">
									<h4 class="panel-title">
										<a href="/bliss-products">View All</a></h4>
								</div>
						</div><!--/category-products-->
						
						
						<!--brands_products-->
						<!-- <div class="brands_products text-center">
							<h2>Custom Products</h2>
							<div class="brands-name">
							
								<p>Blisszon provides laser cutting & engraving services to turn your designs into custom products. Upload your design & get an instant online quote to make your design real.</p>
								
								
								<a href="javascript:;" data-toggle="modal" data-target="#uploadreadyModal"><button type="button" class="btn btn-default">Upload ready to use design </button></a></br>
								<span>Design format should be .dwg or .dxf </span>
								</br>
								<a href="javascript:;" data-toggle="modal" data-target="#uploadrasterModal"><button type="button" class="btn btn-default">Upload raster Design</button></a></br>
								<span>Design format should be JPEG, PNG, PDF</span>
								</br>
								<a class="lat-btn" href=""><button type="button" class="btn btn-default">Request Instant Quote</button></a>
							</div>
						</div>   -->
						<!--/brands_products-->
						
						  <!-- <div class="price-range">
							<h2>VIEW SAMPLES</h2>
							</div>
						 -->
						<!--price-range>
						<div class="price-range">
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div>
						<price-range-->
					
						<!--shipping-->
						<!-- <div class="shipping text-center">
						img src="<?php echo base_url(); ?>assets/front/images/sample1.png" alt="" /
						<img src="<?php echo base_url(); ?>assets/front/images/sample2.png" alt="" />
						<img src="<?php echo base_url(); ?>assets/front/images/sample3.png" alt="" />
						<img src="<?php echo base_url(); ?>assets/front/images/sample4.png" alt="" />
						<img src="<?php echo base_url(); ?>assets/front/images/sample5.png" alt="" />
						<img src="<?php echo base_url(); ?>assets/front/images/sample6.png" alt="" />
						<img src="<?php echo base_url(); ?>assets/front/images/sample7.png" alt="" />
						</div> -->
						
					
					</div>
				</div>
				
