<div class="container col-pro-12">
<?php 
if(empty($category)) { ?>

<h2> Category not found</h2>

<?php } else { ?>

<h2><?php echo ucfirst($this->uri->segment(2));?></h2>
<?php //print_r($category); ?>

 
<div class="row collection_info">
		<div class="col-sm-3 collection_img"><?php echo '<img src="'.base_url().'main-admin/images/category/'.$category[0]['image'].'" class="img-responsive">'; ?></div>
		<div class="col-sm-9 collection_desc">
			
			<div class="rte">
			<?php echo $category[0]['c_description'];?>
			</div>
			
		</div>
	</div> 
 
 
 
 
 
<?php 
if(!empty($category_product)) { 
	foreach($category_product as $categoryproduct) {
	  echo '<div class="col-sm-3">
             <div class="col-pro-3" style="margin-bottom:17px;">
                <div class="col-img-2"><a href="'.base_url().'bliss-product/'.$categoryproduct['p_id'].'">';
              if($categoryproduct['image']==''){ echo '<img src="'.base_url().'assets/front/images/products1.jpg" class="img-togg">'; }
		      else { echo '<img src="'.base_url().'main-admin/images/product/'.$categoryproduct['image'].'" class="img-responsive">'; }
       echo           '<img src="'.base_url().'assets/front/images/str.png" class="srt-0">
                </a></div>
               <h4>'.$categoryproduct['pname'].'</h4>
              <span>'.$categoryproduct['p_id'].'</span>
              <strong>?'.$categoryproduct['cost'].'</strong>
              <a class="buynow" href="'.base_url().'bliss-product/'.$categoryproduct['p_id'].'">BUY NOW</a>
            </div>
         </div>';	
	}
} ?>



<?php } /**************** endif category not found ******************/ ?>
</div>