
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

         <h2>Stock Details</h2>

      </div>
 
<div class="table-responsive">
<table id="example" class="table table-bordered table-hover customer-table"> 
	<thead> <tr><th>ID</th><th>Distributor ID</th><th>Name</th><th>Product Name</th><th>Available</th><th>Total</th><th>Date</th><th>Delete</th></tr> </thead> 
<tbody> 
<?php  
 $i = 1; 
foreach($send_franchise_stock as $con){
		echo '<tr><td>'.$i.'</td><td>'.$con['customer_id'].'</td><td>'.$con['f_name'].'  '.$con['l_name'].'</td><td>'.$con['pname'].'</td><td>'.$con['qty'].'</td><td>'.$con['stock_send_qty'].'</td><td>'.date('d F Y',strtotime($con['date'])).'</td>';
?>	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/sale/send_stock_qty/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
<?php echo '</tr>';         
$i++; 
}   
?>
</tbody> 
</table>
</div> 
</form>
 <?php echo form_close(); ?>