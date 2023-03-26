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
        <h2>Voucher History</h2>
      </div>
 

	  <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>id</th> <th>Customer ID</th><th>BrandName</th><th>EndDate</th><th>Value</th><th>VoucherGCcode</th><th>VoucherGuid</th><th>VoucherNo</th><th>status</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($voucher_history as $con){ 
	
	echo '<tr><td>'.$i.'</td><td>'.(($con['customer_id'])?$con['customer_id']:"--").'</td><td>'.$con['BrandName'].'</td><td>'.$con['EndDate'].'</td><td>'.$con['Value'].'</td><td>'.$con['VoucherGCcode'].'</td><td>'.$con['VoucherGuid'].'</td><td>'.$con['VoucherNo'].'</td><td>'.$con['status'].'</td>';
?>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>