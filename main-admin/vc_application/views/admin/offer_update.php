	
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
      echo form_open_multipart('admin/offer/edit/'.$this->uri->segment(4).'', $attributes);
	  $prod = $product[0];
	  ?>
	  
	   
	  <div class="page-heading">
<div id="page-content">
      <div class="page-heading"> 
        <h2 class="iod">Update Banner <ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/offer'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>
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
             <label  class="control-label col-sm-3">Set Name</label>
           <div class="col-sm-9">   <input type="text" class="form-control"  name="s_name" value="<?php if($this->input->post('s_name')!='') { echo $this->input->post('s_name'); } else { echo $prod['s_name']; }  ?>" >
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
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">Product Type <small style="color:red">*</small></label>
             <div class="col-sm-9">  <select name="product_type" class="form-control custom-select">
			  <option <?php if($prod['product_type']=='1') { echo 'selected="selected"'; } ?> value="1">Hot Deals</option>
			  
			  <option <?php if($prod['product_type']=='2') { echo 'selected="selected"'; } ?> value="2">Best Cashback Offers </option>
			  
			  <option <?php if($prod['product_type']=='3') { echo 'selected="selected"'; } ?> value="3">Best Deals & Discounts</option>
			 
			  <option <?php if($prod['product_type']=='4') { echo 'selected="selected"'; } ?> value="4">Best Discount Coupons</option>
			  <option <?php if($prod['product_type']=='5') { echo 'selected="selected"'; } ?> value="5">Home slider</option>
			  
			  </select>
			  	  
          </div> 
          </div> 
		  

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
		  
		  
		  
		  <div class="form-group col-sm-12">
           <label  class="control-label col-sm-3">web id <small style="color:red">*</small></label>
            <div class="col-sm-9">   
			
			<select name="web_name" class="form-control custom-select">
			 <option value="">Select</option>
			  <?php if(!empty($web)) {
				  foreach($web as $value) {
					  echo '<option value="'.$value['id'].'"';
					  if($prod['web_id']==$value['id']) { echo ' selected="selected" '; }
					  echo '>'.$value['web_name'].'</option>';
				  }
			  } ?>
			  </select>
          </div>  
          </div> 
		  
		  <div class="form-group col-sm-12">
            <label  class="control-label col-sm-3">URL</label>
            <div class="col-sm-9">   <input type="text" class="form-control"  name="url" value="<?php echo $prod['url']; ?>" >
          </div>
          </div>
		  
		  <div class="form-group col-sm-12">
            <label  class="control-label col-sm-3">URL Key</label>
            <div class="col-sm-9">   <input type="text" class="form-control" readonly name="p_id" value="<?php echo $prod['p_id']; ?>" >
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
              <textarea class="form-control" name="s_discription"><?php if($this->input->post('s_discription')!='') { echo $this->input->post('s_discription'); } else { echo $prod['s_discription']; } ?></textarea>
          </div>
		  
  <div class="form-group col-sm-12">
            <label  class="control-label">Description</label>
               <textarea class="form-control textarea-editor" name="p_discription"><?php if($this->input->post('p_discription')!='') { echo $this->input->post('p_discription'); } else { echo $prod['description']; } ?></textarea>
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
        <label  class="control-label col-sm-5">Image <br>
		<input type="file" class="form-control" name="image" >
		<input type="hidden" value="<?php echo $prod['image'];?>" name="image_old">
		</label>
               <div class="col-sm-7"><?php if($prod['image']!='') { echo '<img width="150" class="img-responsive" src="'.base_url().'images/product/'.$prod['image'].'" >'; } ?> </div>
			    
		  
		  
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
		</div>
		</div>
	</div>
				  <div class="col-lg-12 col-md-12">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/offer'; ?>">Cancel </a>
          </div>
		  </div>
        </fieldset>
      <?php 
	  
	  echo form_close(); ?>
	  
	  </div>
	  </div>
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:350 });</script>
  
 