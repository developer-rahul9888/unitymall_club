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
<thead> <tr><th>id</th> <th>Brand</th><th>Brandtype</th><th>denominationList</th><th>stockAvailable</th><th>Category</th><th>Action</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($brands as $con){ 
	
	echo '<tr><td>'.$i.'</td><td>'.$con['BrandName'].'</td><td>'.$con['Brandtype'].'</td><td>'.$con['denominationList'].'</td><td>'.$con['stockAvailable'].'</td><td>'.$con['Category'].'</td>';
?>
<td><a href="<?php echo base_url('admin/voucher-brand/'.$con['BrandProductCode']); ?>" class="btn">Generate</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table></div>