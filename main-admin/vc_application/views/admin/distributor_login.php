
<div class="page-heading">
<!--a class="btn btn-primary flr" href="<?php echo base_url().'admin/customer/add'; ?>">Add New</a--> 
        <h2>Distributor Login</h2> 
      </div>
      

<form method="post" action="<?php echo base_url(); ?>../index.php/vc_site_admin/user/super_admin_login" target="_blank" class="form form-inline">
	  <p>Enter Distributor ID. 
		  <input type="text" style="width:200px !important" class="form-control" required value="" name="bcono" style="height:auto;"> 
		  <input type="submit" name="submit" class="btn btn-primary" value="Login">
	  	  <input type="hidden" name="auth" value="<?php echo md5('@#96pp~~'.date('YmdH').md5('Awr@sw@Y'));?>">
	  </p>
	</form>
	