<div class="page-heading">
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/uploadreceipts/add'; ?>">Add New</a>
        <h2>Receipts List</h2>
</div>  
<table class="table table-bordered table-hover product-table"> 
<thead> <tr><th>S No.</th><th>Product Name </th><th>website </th><th>Amount</th><th>Image</th><th>Descriptions</th><th>Status</th></tr> </thead> 
<tbody> 
<?php 
foreach($all_receipt as $con){ 
$image = '';
 if(!empty($con['image'])){
	 $image =  base_url().'images/receipt/'.$con['image'];
 }


echo '<tr><td>'.$con['id'].'</td>
<td>'.$con['website'].'</td>
<td>'.$con['product'].'</td>
<td>'.$con['amount'].'</td>
<td><img src='.$image .' alt="img" width="50px" height="50px"></td>
<td>'.$con['description'].'</td><td>'.$con['status'].'</td>';
echo '</tr>';

}
?>
</tbody> 
</table>


