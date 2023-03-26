<div class="page-heading"> 
<?php 
$profile_tr_pin = $this->session->userdata('profile_tr_pin');
	 ?>
        <h2>Joining Pins</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> order updated with success.';
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
      
     //echo form_open('admin/category/', $attributes);
     echo $pin_error;
	  
	
	 ?>
	 
	 <?php 
	 
     if(empty($pin)) { echo '<div class="alert alert-success"><strong></strong>Right now no PIN assign to you.</div>'; }
     else { 
      ?>
      <style>td{text-align:center;}</style>
	 <div class="table-responsive">
<table id="example" class="table table-bordered table-hover category-table"> 

<thead>
      <tr>
        <th>Sr. No.</th>
        <th>E-Pin</th>
        
        <th>Package</th>	
   	
        <th>Used On </th>
        <th>Used By </th>
        <th>Status</th> 
		
      </tr>
    </thead>
<tbody> 
<?php 
$i = 1; //print_r($pin);
foreach($pin as $con){ 
   
$caping = ($con['b_volume'] * 105);
	echo '<tr><td>'.$i.'</td>
	<td>'.$con['pinid'].'</td>';

	echo '<td>'.$con['p_amount'].'</td>
	
	
	<td>';
	if($con['used_on']!='' && $con['used_on']!='0000-00-00') { echo date('d M Y',strtotime($con['used_on'])); }
	echo '</td>
	<td>'.$con['used_by'].'</td>
	<td>'.$con['status'].'</td>
	</tr>';
$i++;

}
?>

</tbody> 
</table>
</div>
 <?php } 
	 
	 ?>