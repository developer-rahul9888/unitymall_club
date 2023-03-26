	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/voucher-codes'; ?>">Back</a>
        <h2>Generate Voucher Code</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Generate successfully.';
          echo '</div>';       
        } else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  //print_r($restaurants);
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open_multipart('admin/voucher-code/'.$this->uri->segment(3).'', $attributes);
	  $prod = $voucher_code[0];
      ?>
        <fieldset>
		<div id="collapse0" class="panel-collapse collapse in">
		<input type="hidden" value="<?php echo $prod['id']; ?>" name="cid">
		
		<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Brand</label>
             <div class="col-sm-9"> <input readonly type="text" class="form-control"  name="brand" value="<?php if($this->input->post('brand')!='') { echo $this->input->post('brand'); } else { echo $prod['brand']; } ?>" >
          </div>
          </div>
				<div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Value</label>
             <div class="col-sm-9"> <input readonly type="number" class="form-control"  name="value" value="<?php if($this->input->post('value')!='') { echo $this->input->post('value'); } else { echo $prod['value']; } ?>" >
          </div>
          </div>
          <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Code</label>
             <div class="col-sm-9"> <input readonly type="text" class="form-control"  name="code" value="<?php if($this->input->post('code')!='') { echo $this->input->post('code'); } else { echo $prod['code']; } ?>" >
          </div>
          </div>

          <div class="form-group col-sm-12">
          <label  class="control-label col-sm-3">Quantity</label>
             <div class="col-sm-9"> <input type="number" required class="form-control"  name="quantity" value="<?php if($this->input->post('quantity')!='') { echo $this->input->post('quantity'); } ?>" >
          </div>
          </div>

<div class="col-sm-12">
<div class="panel panel-default">
						
			<div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true">Discription<span class="pull-right glyphicon glyphicon-chevron-down"></span></a>
        </h4>
      </div> 
	  
         <div id="collapse2" class="panel-collapse collapse in" style="" aria-expanded="true">
        <div class="panel-body">
		 <h2></h2>
		 
		      <div class="form-group col-sm-12">
              <label>About the brand</label>
              <textarea class="form-control " readonly  name="about" ><?php if($this->input->post('about')!='') { echo $this->input->post('about'); } else { echo $prod['about']; } ?></textarea>
          </div>		  		  		    
          
          <div class="form-group col-sm-12">            
            <label>Terms & Conditions</label>              
            <textarea class="form-control " readonly  name="terms" ><?php if($this->input->post('terms')!='') { echo $this->input->post('terms'); } else { echo $prod['terms']; } ?>
            </textarea>          
          </div>	

          <div class="form-group col-sm-12">            
            <label>Steps to avail</label>              
            <textarea class="form-control " readonly  name="steps" ><?php if($this->input->post('steps')!='') { echo $this->input->post('steps'); } else { echo $prod['steps']; } ?>
            </textarea>          
          </div>	
		  
        </div>
        </div>
        </div>
        </div>
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Generate</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/voucher-codes'; ?>">Cancel </a>
          </div>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	  <script src="https://demos.codexworld.com/add-wysiwyg-html-editor-to-textarea-website/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true, height:200 });</script>
 <script>
tinymce.init({
    selector: '.myTextarea2',
    height: 350,
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
    link_list: [
        { title: 'My page 1', value: 'http://getlocal.blissinfosys.com/' },
        { title: 'My page 2', value: 'http://getlocal.blissinfosys.com/' }
    ],
    image_list: [
        { title: 'My page 1', value: 'http://getlocal.blissinfosys.com/' },
        { title: 'My page 2', value: 'http://getlocal.blissinfosys.com/' }
    ],
    image_class_list: [
        { title: 'None', value: '' },
        { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,
    file_picker_callback: function (callback, value, meta) {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
            callback('http://getlocal.blissinfosys.com/main-admin/assets/images/logo.png', { text: 'My text' });
        }
    
        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
            callback('http://getlocal.blissinfosys.com/main-admin/assets/images/logo.png', { alt: 'My alt text' });
        }
    
        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
            callback('movie.mp4', { source2: 'alt.ogg', poster: 'http://getlocal.blissinfosys.com/main-admin/assets/images/logo.png' });
        }
    },
    templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: 'sliding',
    contextmenu: "link image imagetools table",
});
</script>