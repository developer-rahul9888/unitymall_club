<?php $this->load->view('includes/front/leftsidebar');?>

<div class="container inner">
<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Generate link</h2>
				</div>			 		
			</div> 

    <div class="col-md-8 col-md-offset-2">
    <div class="genrate-link">
        
        
       <?php  if(!empty($link)){echo $link;} ?> 
        
        <form action="" method="POST" >
  <div class="form-group">
    <label>URL:</label>
     <input required type="text" name="link"  value="" class="form-control" placeholder="Enter url to link">
  </div>
  
  
  <div class="form-group">
    <label>Website Name:</label>
     <input required type="text" name="web_name"  value="" class="form-control" placeholder="Enter Website name">
  </div>
  
  <?php if($this->session->userdata('is_customer_logged_in')){ ?>
 <button type="submit" name="submit" value="submit" class="btn btn-default genreate_link"><strong>Generate Link</strong></button>
 
 <?php }else{ ?>
 
 <button data-toggle="modal" data-target="#registerLoginModal" class="btn btn-default genreate_link"><strong>Login</strong></button> 
<?php } ?>
 
 
</form>
 

</div>
</div>
			<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">How It Works</h2>
				</div>			 		
			</div> 
			<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<div class="col-md-4 col-sm-4 step-number-block">
                                <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                    <div class="icon-lg text-primary m-b20">
                                        <a href="#" class="icon-cell"><img src="<?php echo base_url(); ?>assets/front/images/linkk2.png" alt=""></a>
                                    </div>
                                    <div class="icon-content">
                                    	<div class="step-number">1</div>
                                        
                                        <p>Search your favourite products from any listed website.</p>
                                    </div>
                                </div>
                    </div>
					
					<div class="col-md-4 col-sm-4 step-number-block active">
                                <div class="wt-icon-box-wraper  p-a30 center bg-secondry m-a5 ">
                                    <div class="icon-lg m-b20">
                                        <a href="#" class="icon-cell"><img src="<?php echo base_url(); ?>assets/front/images/linkk1.png" alt=""></a>
                                    </div>
                                    <div class="icon-content text-white">
                                    	<div class="step-number active">2</div>
                                       
                                        <p>Copy URL of your product that you select.</p>
                                    </div>
                                </div>
                    </div>
					
					<div class="col-md-4 col-sm-4 step-number-block">
                                <div class="wt-icon-box-wraper  p-a30 center bg-white m-a5">
                                    <div class="icon-lg text-primary m-b20">
                                        <a href="#" class="icon-cell"><img src="<?php echo base_url(); ?>assets/front/images/linkk3.png" alt=""></a>
                                    </div>
                                    <div class="icon-content">
                                    	<div class="step-number">3</div>
                                       
                                        <p>Paste URL at <b>www.wishzon.com</b> in Generate Link.</p>
                                    </div>
                                </div>
                    </div>
				</div>			 		
			</div> 







</div>