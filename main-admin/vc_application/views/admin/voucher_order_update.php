	

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
    echo form_open_multipart('admin/voucher_order/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $voucher_order[0];

	  ?>

      <div class="page-heading"> 

        <h2 class="iod">Update Voucher Orders<ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/voucher_order'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>

		

      </div>

 

      <?php 

      //flash messages

      if($this->session->flashdata('flash_message')){

        if($this->session->flashdata('flash_message') == 'updated')

        {

          echo '<div class="alert alert-success">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo '<strong>Well done!</strong> Voucher updated successfully.';

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
      //echo '<pre>'; print_r($prod); echo '</pre>';
      ?>

        <fieldset> 

		

		<div id="collapse0" class="panel-collapse collapse in">

		 <input type="hidden" class="form-control" required name="cid" value="<?php echo $prod['id'];  ?>" >

	  

		<div class="form-group col-sm-12">

          <label  class="control-label col-sm-3">Voucher Name </label>

             <div class="col-sm-9"> <input type="text" class="form-control"  name="pname" value="<?php if($this->input->post('pname')!='') { echo $this->input->post('pname'); } else { echo $prod['pname']; }  ?>" >

          </div>

          </div>

		<div class="form-group col-sm-12">

          <label  class="control-label col-sm-3">Voucher Value </label>

             <div class="col-sm-9"> <input type="text" class="form-control"  name="price" value="<?php if($this->input->post('price')!='') { echo $this->input->post('price'); } else { echo $prod['price']; }  ?>" >

          </div>

          </div>

		

		  <div class="form-group col-sm-12">

           <label  class="control-label col-sm-3">Status</label>

             <div class="col-sm-9">  <select name="status" class="form-control custom-select">

			  <option <?php if($prod['status']=='Pending') { echo 'selected="selected"'; } ?> value="Pending">Pending</option>

			  <option <?php if($prod['status']=='Accepted') { echo 'selected="selected"'; } ?> value="Accepted">Accepted</option>

			  <option <?php if($prod['status']=='Rejected') { echo 'selected="selected"'; } ?> value="Rejected">Rejected</option>

			  </select>

          </div> 

          </div> 
	  	<div class="form-group col-sm-12">

          <label  class="control-label col-sm-3">Voucher Code </label>

             <div class="col-sm-9"> <input type="text" class="form-control"  name="voucher_code" value="<?php if($this->input->post('voucher_code')!='') { echo $this->input->post('voucher_code'); } else { echo $prod['voucher_code']; }  ?>" >

          </div>

          </div>

		  <div class="form-group col-sm-12">

			<label  class="control-label col-sm-3">Note</label>

			<div class="col-sm-9">  
	  			<textarea class="form-control" name="note"><?php if($this->input->post('note')!='') { echo $this->input->post('note'); } else { echo $prod['note']; }  ?></textarea>
			</div> 

</div> 
		 

		   <div class="form-group col-sm-12">
		    <div class="col-sm-4"><label>Value</label></div><div class="col-sm-4"><label>Coins</label></div><div class="col-sm-4"><label>Qty</label></div>  
			<?php if($prod['products']!=''){
				$attributeArray = json_decode($prod['products'],true);
				$count = 1; 
				foreach($attributeArray as $attributVal) {
					echo '<div class="form-group col-sm-4"><input placeholder="Title" type="text" readonly required class="form-control" name="a_title[]" value="'.$attributVal['cost'].'" ></div><div class="form-group col-sm-4"><input placeholder="Value" readonly type="text" required class="form-control" name="a_value[]" value="'.$attributVal['price'].'" ></div><div class="form-group col-sm-4"><input placeholder="Value" readonly type="text" required class="form-control" name="a_value[]" value="'.$attributVal['qty'].'" ></div>';
					$count++;
				}
			} ?>
			
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

  

 