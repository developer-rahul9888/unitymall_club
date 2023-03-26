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
        <h2>Pin sale</h2>
      </div>
	  
	  
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
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead><tr> <tr><th>S.NO.</th> <th>User ID</th><th>Total Paid</th><th>BV</th><th>Admin(10%)</th><th>Date</th><th>Delete</th></tr></thead>
<tbody> 
<?php 
$gtotal = 0;
$bv = 0;
$i = 1;
$admin=0;
$total=0;
foreach($sale as $con){ 
	$gtotal = $gtotal + $con['gtotal'];
    $bv = $bv + $con['bv'];
	$admin = $gtotal*(10/100);
	$total = $total + $admin;
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/pin_invoice/'.$con['id'].'">'.$con['customer'].'</a></td><td><a href="'.base_url().'admin/pin_invoice/'.$con['id'].'">'.$con['gtotal'].'</a></td><td><a href="'.base_url().'admin/pin_invoice/'.$con['id'].'">'.$con['bv'].'</a></td><td>'.$admin.'</td><td>'.date('d F Y',strtotime($con['tdate'])).'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin_sale/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
<tfooter><tr style="height:40px;background-color:#0098da;"> 	<td colspan="2">Total</td>	<td>Rs <?php echo $gtotal; ?></td>	<td>Rs <?php echo $bv; ?></td>	<td></td><td></td><td></td>	</tr></tfooter>
</table>
</div>
</form>