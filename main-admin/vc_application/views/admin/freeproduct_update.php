	

     <style>

	 label.checkbox { padding-left: 20px;}

	 .add-more-d-area-div-parent input {margin-bottom: 6px;}

	 label.checkbox{font-weight:normal;}

	 .iod ul{float:right}

	 .iods ul{float:right}

	 .iods{background:#ccc}

	 .remove-btn{color: #ff0000;padding: 3px 10px;	 font-size: 21px;}

	 input[type="file"]{padding:0px;} 

	 </style>

	 <?php 

	 //form data

      $attributes = array('class' => 'form', 'id' => '');

      echo form_open_multipart('admin/f_product/edit/'.$this->uri->segment(4).'', $attributes);

	  $prod = $f_products[0];

	  ?>

      <div class="page-heading"> 

        <h2 class="iod">Update E-Voucher <ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/f_product'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>

		

      </div>

 

      <?php 

      //flash messages

      if($this->session->flashdata('flash_message')){

        if($this->session->flashdata('flash_message') == 'updated')

        {

          echo '<div class="alert alert-success">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo '<strong>Well done!</strong> product updated successfully.';

          echo '</div>';       

        } elseif($image_error == 'true'){

			echo '<div class="alert alert-danger">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo '<strong>Image !</strong> should not be empty please upload image.';

            echo '</div>';  

		} else{

          echo '<div class="alert alert-danger">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';

          echo '</div>';          

        }

      }

	   

      ?>

      

      <?php 

      //form validation

      echo validation_errors(); 

      ?>

        <fieldset> 

		

		<div id="collapse0" class="panel-collapse collapse in">

		 <input type="hidden" class="form-control" required name="cid" value="<?php echo $prod['id'];  ?>" >

	  

		<div class="form-group col-sm-12">

          <label  class="control-label col-sm-3">Name <small style="color:red">*</small></label>

             <div class="col-sm-9"> <input type="text" class="form-control" required name="p_name" value="<?php if($this->input->post('p_name')!='') { echo $this->input->post('p_name'); } else { echo $prod['pname']; }  ?>" >

          </div>

          </div>

		

		  

		  

		  <div class="form-group col-sm-12">

        <label  class="control-label col-sm-3">Stock keeping unit(SKU) <small style="color:red">*</small></label>

               <div class="col-sm-9"> <input readonly type="text" class="form-control" required name="sku" value="#<?php echo $prod['id'];  ?>" >

             <input type="hidden" class="form-control" name="sku_old" value="<?php  echo $prod['sku'];  ?>" >

          </div>

          </div>

		       

		 

		  

		  

		  <div class="form-group col-sm-12">

           <label  class="control-label col-sm-3">Status <small style="color:red">*</small></label>

             <div class="col-sm-9">  <select name="status" class="form-control custom-select">

			  <option value="active">Active</option>

			  <option <?php if($prod['status']=='deactive') { echo 'selected="selected"'; } ?> value="deactive">Deactive</option>

			  </select>

          </div> 

          </div> 
		  
		  
		  
		<!--  <div class="form-group col-sm-12">

          <label  class="control-label col-sm-3">Price <small style="color:red">*</small></label>

             <div class="col-sm-9"> <input type="number" class="form-control" required name="price" value="<?php if($this->input->post('price')!='') { echo $this->input->post('price'); } else { echo $prod['price']; }  ?>" >

          </div>

          </div>
		  
		  		  <div class="form-group col-sm-12">

          <label  class="control-label col-sm-3">Points <small style="color:red">*</small></label>

             <div class="col-sm-9"> <input type="number" class="form-control"  name="points" value="<?php if($this->input->post('points')!='') { echo $this->input->post('points'); } else { echo $prod['points']; }  ?>" >

          </div>

          </div>-->
		  
		  
		  
		  
		  
		  

		 

		  



		   <div class="form-group col-sm-12">

           <label  class="control-label col-sm-3">Category<small style="color:red">*</small></label>

            <div class="col-sm-9">  

			<select name="category" class="form-control custom-select">

			<option value="">Select</option> 

			  <?php if(!empty($category)) {

				  foreach($category as $value) {

					  echo '<option value="'.$value['id'].'"';

					  if($prod['category']==$value['id']) { echo ' selected="selected" '; }

					  echo '>'.$value['c_name'].'</option>';

				  }

			  } ?>

			  </select>

          </div>  

          </div>

		  

		<!--  <div class="form-group col-sm-12">

            <label  class="control-label col-sm-3">Actual Cost</label>

             <div class="col-sm-9"> <input type="number" required="required" class="form-control"  name="price" value="<?php if($this->input->post('price')!='') { echo $this->input->post('price'); } else { echo $prod['price']; }  ?>" >

          </div> 

          </div>

		<div class="form-group col-sm-12">

            <label  class="control-label col-sm-3">MRP</label>

             <div class="col-sm-9"> <input type="number" required="required" class="form-control"  name="cost" value="<?php if($this->input->post('cost')!='') { echo $this->input->post('cost'); } else { echo $prod['cost']; }  ?>" >

          </div> 

          </div>



		  

		  <div class="form-group col-lg-12">

           <label  class="control-label col-sm-3">Tax class <small style="color:red">*</small></label>

            <div class="col-sm-9">   

			

			<select name="t_class" class="form-control custom-select"> 

			  <?php if(!empty($tax)) {

				  foreach($tax as $value) {

					  echo '<option value="'.$value['amount'].'"';

					  if($prod['t_class']==$value['amount']) { echo ' selected="selected" '; }

					  echo '>'.$value['title'].' '.$value['amount'].' '.$value['type'].'</option>';

				  }

			  } ?>

			  </select>

          </div>  

          </div> 

		  

		 

		  

		  

		  <div class="form-group col-sm-12">

            <label  class="control-label col-sm-3">DP</label>

             <div class="col-sm-9"> <input type="number" required="required" class="form-control"  name="p_d_price" value="<?php if($this->input->post('p_d_price')!='') { echo $this->input->post('p_d_price'); } else { echo $prod['p_d_price']; }  ?>" >

          </div> 

          </div> 

		  

		  

		   <div class="form-group col-sm-12">

            <label  class="control-label col-sm-3">BV</label>

             <div class="col-sm-9"> <input type="text" required="required" class="form-control"  name="comm_dis" value="<?php if($this->input->post('comm_dis')!='') { echo $this->input->post('comm_dis'); } else { echo $prod['comm_dis']; }  ?>" >

          </div> 

          </div>

		  

		  

			

		  

		  <div class="form-group col-sm-12">

            <label  class="control-label col-sm-3">Qty</label>

              <div class="col-sm-9"><input type="number" required="required" class="form-control"  name="p_qty" value="<?php if($this->input->post('p_qty')!='') { echo $this->input->post('p_qty'); } else { echo $prod['p_qty']; }  ?>" >

          </div>

          </div> -->

		  

		 

		  <div class="form-group col-sm-12">

            <label  class="control-label">Description in English</label>

              <textarea class="form-control " name="s_discription"><?php if($this->input->post('s_discription')!='') { echo $this->input->post('s_discription'); } else { echo $prod['s_discription']; } ?></textarea>

          </div>

		  

  <div class="form-group col-sm-12">

            <label  class="control-label">Description in Hindi</label>

               <textarea class="form-control " name="p_discription"><?php if($this->input->post('p_discription')!='') { echo $this->input->post('p_discription'); } else { echo $prod['description']; } ?></textarea>

          </div>

		  

		    <div class="form-group col-lg-6 col-mg-6 col-sm-6">

        <label  class="control-label col-sm-5">Image <br>

		<input type="file" class="form-control" name="image" >

		<input type="hidden" value="<?php echo $prod['image'];?>" name="image_old">

		</label>

               <div class="col-sm-7"><?php if($prod['image']!='') { echo '<img width="150" class="img-responsive" src="'.base_url().'assets/images/'.$prod['image'].'" >'; } ?> </div>

			    

		  

		  

          </div>

		   <div class="form-group col-sm-12">
		 <p> <br><button class="btn btn-success btn-sm add-attribute" type="button">Add Attribute</button> </p>
		    <div class="col-sm-5"><label>Value</label></div><div class="col-sm-5"><label>Offer Price</label></div>  
			<?php if($prod['attribute']!=''){
				$attributeArray = json_decode($prod['attribute'],true);
				$count = 1; 
				foreach($attributeArray as $attributVal) {
					echo '<div class="remove-div-'.$count.'"><div class="form-group col-sm-5"><input placeholder="Title" type="text" required class="form-control" name="a_title[]" value="'.$attributVal[0].'" ></div><div class="form-group col-sm-6"><input placeholder="Value" type="text" required class="form-control" name="a_value[]" value="'.$attributVal[1].'" ></div><div class="col-sm-1"><button data=".remove-div-'.$count.'" type="button" class="remove-btn glyphicon glyphicon-remove remove-div"></button></div></div>';
					$count++;
				}
			} ?>
			<div class="add-attribute-div"></div> 
		  </div>
		

		  

		</div>  

		  

		 



				  <div class="col-lg-12 col-md-12">

          <div class="form-group">

            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 

			 <a class="btn btn-primary" href="<?php echo base_url().'admin/product'; ?>">Cancel </a>

          </div>

		  </div>

        </fieldset>

      <?php echo form_close(); ?>

	  

	   <script>

	  jQuery(document).ready(function(){

		  var uid = 999;

		 jQuery('.add-attribute').click(function(){

            var add_attr = '<div class="remove-div-'+uid+'"><div class="form-group col-sm-5"><input placeholder="Title" type="text" required class="form-control" name="a_title[]" value="" ></div><div class="form-group col-sm-6"><input placeholder="Value" type="text" required class="form-control" name="a_value[]" value="" ></div><div class="col-sm-1"><button data=".remove-div-'+uid+'" type="button" class="remove-btn glyphicon glyphicon-remove remove-div"></button></div></div>';

			jQuery('.add-attribute-div').append(add_attr);

			uid++;

		 });

        jQuery('html').on('click','.remove-div',function(){

		  if(confirm('Are you sure ?')) {

           var cls = jQuery(this).attr('data');

		   jQuery(cls).html();

		   jQuery(cls).remove();

		 }

		});		

		

		var imgid = 999;

		 jQuery('.add-upload-img').click(function(){

            var add_attr = '<div class="remove-img-div-'+imgid+'"><div class="form-group col-sm-11"><input type="file" required class="form-control" name="p_image[]" value="" ></div><div class="col-sm-1"><button data=".remove-img-div-'+imgid+'" type="button" class="glyphicon glyphicon-remove remove-btn  remove-img-div"></button></div></div>';

			jQuery('.add-upload-img-div').append(add_attr);

			imgid++;

		 });

        jQuery('html').on('click','.remove-img-div',function(){

		  if(confirm('Are you sure ?')) { 

           var cls = jQuery(this).attr('data');

		   jQuery(cls).html();

		   jQuery(cls).remove();

		 }

		});	 

		

		jQuery('html').on('click','.remove-image-div',function(){

		  if(confirm('Are you sure ?')) {

           var img = jQuery(this).attr('data-img');

		   jQuery.ajax({

			   type:"POST",

			   url:"<?php echo base_url();?>admin/product/remove_img",

			   data:"img="+img,

			   success:function(data){}

		   });

           var cls = jQuery(this).attr('data');

		   jQuery(cls).html();

		   jQuery(cls).remove();

		 }

		});	

	  

	  jQuery('.show-attributes').click(function(){

		  jQuery('.panel-collapse').removeClass('in');

		  jQuery('#collapse4').addClass('in');

	  });

	  });

	  </script>

	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>

  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:350 });</script>

  

 