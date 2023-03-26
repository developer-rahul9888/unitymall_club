<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>
<div class="page-heading">
        <h2>Bonanza List <a class="btn btn-primary flr" href="<?php echo base_url().'admin/bonanza/add'; ?>">Add</a></h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> customer updated with success.';
          echo '</div>';       
        }else{
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
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      //echo form_open('admin/customer/', $attributes);
      ?>
      <?php if($this->uri->segment(2)!='customer_all') {    ?>
	  <div class="col-sm-12">
	  <form class="form form-inline" method="post" action="">

  </form>
      
  
  <div class="form-group col-sm-3"> 
		   <?php echo form_open('https://www.aonegreenlife.in/main-admin/index.php/vc_site_admin/customer/generatecsv'); ?> 
		   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
		    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		    
		    	<!--<label>&nbsp;</label>
		   //<input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">
		   
		   <?php echo form_close(); ?>-->
		  </div>
  
	</div>  
	<?php } ?> 
	  <p>&nbsp;</p>
	  
	  <div class="table-responsive">
   <table id="example" class="table table-bordered table-hover customer-table"> 
	<thead> <tr><th>ID</th> <th>LBV</th><th>RBV</th><th>Reward</th><th>Rank</th><th>Status</th><th>Date</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($bonanza as $con){
	
	
	
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/bonanza/edit/'.$con['id'].'">'.$con['lbv'].'</a></td><td>'.$con['rbv'].'</td><td>'.$con['reward'].'</td><td>'.$con['rank'].'</td><td>'.$con['status'].'</td><td>'.$con['date'].'</td>';
?>

		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>