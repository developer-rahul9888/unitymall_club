<div class="page-heading"> 
<?php 
$profile_tr_pin = $this->session->userdata('profile_tr_pin');
	 if($profile_tr_pin!='') {
		 ?>
 <form class="form form-inline flr text-right" method="post" action="">
	 <p><a href="<?php echo base_url('admin/pins');?>" class="btn btn-success btn-sm">Joining PIN</a> 
	 <input required type="hidden" name="logout_tr_pin" value="yes" class="form-control"> <input type="submit" class="btn btn-primary" value="Logout from transactional PIN"> </p>
	 </form>
	 <?php } ?>
        <h2>Repurchase Pins</h2>
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
	  
	 if($profile_tr_pin=='') {
	 ?>
	 <form class="form form-inline" method="post" action="">
	 <p>Transactinal PIN: <input required type="password" name="profile_tr_pin" value="" class="form-control"> <input type="submit" class="btn btn-primary" value="Submit"> </p>
	 </form>
	 <?php 
	 } else {
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
        <th>GST</th>	
        <th>Total</th>		
        <th>RPV</th>				
        <th>Userd On </th>
        <th>Used By </th>
        <th>Status</th> 
		<th>Use this PIN</th>		
      </tr>
    </thead>
<tbody> 
<?php 
$i = 1;
foreach($pin as $con){ 
$caping = ($con['b_volume'] * 10) * 25;
	echo '<tr><td>'.$i.'</td>
	<td>'.$con['pinid'].'</td>
	<td>'.$con['p_amount'].'</td>
	<td>10%</td>
	<td>';
	$aftergst = ((10 / 100) * $con['p_amount']) + $con['p_amount'];
	echo round($aftergst,2);
	echo '</td>
	<td>'.$con['b_volume'].'</td> 
	<td>'.date('d F Y',strtotime($con['used_on'])).'</td>
	<td>'.$con['used_by'].'</td>
	<td>'.$con['status'].'</td> 
	<td>';
	if($con['status']=='Active' && $con['used_by']=='') { echo '<a class="btn btn-success btn-sm" href="'.base_url().'admin/pin_activate/'.$con['id'].'">Use This</a>'; }
	echo '</td>
	</tr>';
$i++;
}
?>

</tbody> 
</table>
</div>
 <?php } 
	 }
	 ?>