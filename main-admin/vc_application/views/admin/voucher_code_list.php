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
        <h2>Voucher Codes</h2>
      </div>
 

	  <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>id</th> <th>Brand</th><th>Value</th><th>Product Code</th><th>Action</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($voucher_codes as $con){ 
	
	echo '<tr><td>'.$i.'</td><td>'.$con['brand'].'</td><td>'.$con['value'].'</td><td>'.$con['code'].'</td>';
?>
<td><a href="<?php echo base_url('admin/voucher-code/'.$con['id']); ?>" class="btn">Generate</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>