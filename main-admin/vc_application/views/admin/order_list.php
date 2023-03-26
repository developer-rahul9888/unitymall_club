<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>

<style>
 .table-striped > tbody > tr.Delivered {background:#5cb85c}
 .table-striped > tbody > tr.Accepted {background:#ec971f}
 .table-striped > tbody > tr.Pending {background:#31b0d5}
 .table-striped > tbody > tr.Cancel {background:#c9302c}
</style>

<div class="page-heading"> 
        <h2>Order</h2>
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
      
      echo form_open('admin/order/', $attributes);
      ?>
	  
	   <div class="col-sm-12">
	  <form class="form form-inline" method="post" action="">
     
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('s_name')!='') { echo $this->input->post('s_name'); }?>" name="sdate">
	  </div>
	  
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('e_name')!='') { echo $this->input->post('e_name'); }?>" name="edate"> 
		  </div>
		  
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>

  </form>
      
  
 <!--<div class="form-group col-sm-3"> 
		   <?php echo form_open(base_url().'index.php/vc_site_admin/customer/generatecsv'); ?> 
		   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">
		    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 
		    
		    	<label>&nbsp;</label>
		   <input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">
		   
		   <?php echo form_close(); ?>
		  </div>-->
  
	</div>  

	  <p>&nbsp;</p>
	  <div class="table-responsive">
<table id="example" class="table table-bordered table-hover category-table table-striped"> 
<thead> <tr> <th>OrderID.</th><th>Name</th><th>customer id</th><th>Phone</th><th>Amount</th><th>Bv</th><th>Status</th><th>Date</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
$total_amount=0;
	$comm_dis=0;
foreach($order as $con){ 
$total_amount = $total_amount + $con['total_amount']; 
		$comm_dis = $comm_dis + $con['comm_dis'];
	
	echo '<tr class='.$con['status'].'><td>'.$con['id'].'</td>
	<td><a href="'.base_url().'admin/order/'.$con['id'].'">'.$con['p_name'].'</a></td>
	<td>'.$con['customer_id'].'</td>
	<td><a href="'.base_url().'admin/order/'.$con['id'].'">'.$con['p_phone'].'</a></td>
	<td>'.$con['total_amount'].'</td>
	<td>'.$con['comm_dis'].'</td><td>';
	if($con['emi']=='no' || $con['emi']=='yes') { echo $con['status']; }
	else { echo 'EMI Payment'; }
	echo '</td><td>'.$con['o_date'].'</td>';
?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php //echo base_url().'admin/order/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
		<?php echo '</tr>';
$i++;
}
?>
</tbody><tr style="height:40px;background-color:#0098da;"> 	<td colspan="3"><center><b>Total</b></center></td><td></td>	<td>Rs <?php echo $total_amount; ?></td>	<td>Bv <?php echo $comm_dis; ?></td>	<td></td><td></td>	</tr>


</table></div>
 <?php echo form_close(); ?>