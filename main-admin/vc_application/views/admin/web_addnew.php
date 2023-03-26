	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weightweight:normal;}
	 .iod ul{float:right}
	 .iods ul{float:right}
	 .iods{background:#ccc}
	 .remove-btn{color: #ff0000;padding: 3px 10px;	 font-size: 21px;}
	 input[type="file"]{padding:0px;}
	 
	 </style>
	 <?php 
	 //form data
      $attributes = array('class' => 'form', 'id' => '');
      echo form_open_multipart(base_url().'admin/w_product/add', $attributes);
	  ?>
      <div class="page-heading"> 
        <h2 class="iod">Add Offers <ul class="list-inline"><li>
		<a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/w_product'; ?>">&laquo; Back</a>
		<li>
		<button type="reset" class="btn btn-primary btn-sm">Reset</button>
		</li>
		<button type="submit" class="btn btn-primary btn-sm">Save</button>
		<li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button>
		</li></h2>
				<!--h2 class="iods">
		<a data-toggle="collapse" data-parent="#accordion" href="#collapse0">General</a> 
		<ul class="list-inline"><li><button class="btn btn-primary btn-sm show-attributes" type="button">Creat New Attribute</button></li></ul></h2-->

		
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product added successfully.';
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
		 
	  
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Name <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="p_name" value="<?php if($this->input->post('p_name')!='') { echo $this->input->post('p_name'); }  ?>" >
          </div>
          </div>
		
		<div class="form-group col-sm-12">
             <label  class="control-label col-sm-3">Tag Name</label>
           <div class="col-sm-9">   <input type="text" class="form-control"  name="s_name" value="<?php if($this->input->post('s_name')!='') { echo $this->input->post('s_name'); }  ?>" >
          </div>
          </div>
		  
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Status <small style="color:red">*</small></label>
             <div class="col-sm-9">  <select name="status" class="form-control custom-select">
			  <option value="active">Active</option>
			  <option value="deactive">Deactive</option>
			  </select>
          </div> 
          </div> 

  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Product Type <small style="color:red">*</small></label>
             <div class="col-sm-9">  <select name="product_type" class="form-control custom-select">
			  <option value="1">Hot Deals</option>
			  <option value="2">Best Cashback Offers</option>
			  <option value="3">Best Deals & Discounts</option>
			  <option value="4">Coupons</option>
			  <option value="5">Home slider</option>
			  <option value="6">Deal slider</option>
			  </select>
          </div> 
          </div> 
		  
		    <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">website <small style="color:red">*</small></label>
            <div class="col-sm-9">   
			
			<select name="web_name" class="form-control custom-select">
			 <option selected disabled value="">Select</option>
			  <?php if(!empty($web)) {
				  foreach($web as $value) {
					  echo '<option value="'.$value['id'].'"';
					  if($this->input->post('web_name')==$value['id']) { echo ' selected="selected" '; }
					  echo '>'.$value['web_name'].'</option>';
				  }
			  } ?>
			  </select>
          </div>  
          </div> 
		  
		  <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">URL <small style="color:red">*</small></label>
             <div class="col-sm-9"> <input type="text" class="form-control" required name="url" value="<?php if($this->input->post('url')!='') { echo $this->input->post('url'); }  ?>" >
          </div>
          </div>
		  
		   <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Category<small style="color:red">*</small></label>
            <div class="col-sm-9">  
			<select name="category" class="form-control custom-select">
			<option selected disabled value="">Select</option> 
			  <?php if(!empty($category)) {
				  foreach($category as $value) {
					  echo '<option value="'.$value['id'].'"';
					  if($this->input->post('category')==$value['id']) { echo ' selected="selected" '; }
					  echo '>'.$value['c_name'].'</option>';
				  }
			  } ?>
			  </select>
          </div>  
          </div>
		  
		 
		   <div class="form-group col-sm-12">
             <label  class="control-label col-sm-3">Offer End Date</label>
           <div class="col-sm-9">   <input id="datepicker" type="text" class="form-control"  name="e_date" value="<?php if($this->input->post('e_date')!='') { echo $this->input->post('e_date'); }  ?>" >
          </div>
          </div>
		 
		</div>  
		  
		 
<!-- prices-->	
<div class="col-sm-12">	 
		
	
	<!-- Description-->		 
					<div class="panel panel-default">
						
			<div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Description<span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
        </h4>
      </div> 
	  
         <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
		 <h2></h2>
		 
		  <div class="form-group col-sm-12">
            <label  class="control-label">Short Description</label>
              <textarea class="form-control" name="s_discription"><?php if($this->input->post('s_discription')!='') { echo $this->input->post('s_discription'); } ?></textarea>
          </div>
		  
  <div class="form-group col-sm-12">
            <label  class="control-label">Description</label>
               <textarea class="form-control textarea-editor" name="p_description"><?php if($this->input->post('p_description')!='') { echo $this->input->post('p_description'); } ?></textarea>
          </div>
		  
        </div>
        </div>
        </div> 
		
	<!-- Description end-->
	
	<!-- Images -->		 
					<div class="panel panel-default">
			<div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Images<span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
        </h4>
      </div> 
         <div id="collapse3" class="panel-collapse collapse">
	 
        <div class="panel-body">
		 <h2></h2>
  <div class="form-group col-lg-6 col-mg-6 col-sm-6">
        <label  class="control-label col-sm-5">Image</label>
               <div class="col-sm-7"> <input type="file" class="form-control"  name="image" ></div>
		
          </div>
		  
        </div>
        </div>
        </div> 
		
	<!-- images end-->
	
	<div class="panel panel-default">
			<div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Attribute<span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
        </h4>
      </div> 
         <div id="collapse4" class="panel-collapse collapse"> 
        <div class="panel-body">
		   <div class="form-group col-sm-12">
		 <p> <br><button class="btn btn-success btn-sm add-attribute" type="button">Add Attribute</button> </p>
		    <div class="col-sm-5"><label>Title</label></div><div class="col-sm-5"><label>Value</label></div>  
			<div class="add-attribute-div"></div> 
		  </div>
		</div> 
		</div>
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
	  
	  jQuery('.show-attributes').click(function(){
		  jQuery('.panel-collapse').removeClass('in');
		  jQuery('#collapse4').addClass('in');
	  });
	  });
	  </script>
	     <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:400 });</script>
  
 