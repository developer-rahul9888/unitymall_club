<div class="page-heading"> 
        <h2>My Recent Clicks</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> activity_log updated with success.';
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
      $attributes = array('class' => 'form form-inline', 'id_no' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
     //echo form_open('admin/category/', $attributes);
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover category-table"> 
<thead> <tr> <th>S.NO</th><th>Website Name</th><th>Tracking Ticket</th><th>Date&Time</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($activity_log as $con){ 
	
	echo '<tr><td>'.$i.'</td><td>You visited '.$con['Sitename'].' Website.</td><td>'.$con['visitor_no'].'</td><td>'.$con['Date_Time'].'</td>'; 
?>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>
 <?php //echo form_close(); ?>