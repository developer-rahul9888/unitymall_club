

 
 <div class="col-sm-12">
 <div class="page-heading"> 

<h2>Hold Gift Your Voucher Club</h2>
</div>


<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>Coin</th>
                <th>Send By</th>
                <th>Pay Level</th>
                <th>Date</th>
         
            </tr>
        </thead>
        <tbody>
<?php 
$i = 1;
if(!empty($income)) {
	$tamount=0;
	foreach($income as $val){ 
			$amount = round($val['amount']); 
		$tamount = $tamount + $val['amount']; 
		
		if ($val['c_date'] !=''){
			
			$date = date('d F Y h:i A',strtotime($val['c_date']));
		}else{
			$date='';
		}
		
		
		if($amount > 0) {
			echo '<tr><td class="text-center">'.$i.'</td><td class="text-center">Coin '.$amount.'</td><td class="text-center">'.$val['customer_id'].'</td><td class="text-center">'.$val['pay_level'].'</td><td class="text-center">'.$date.'</td>';
			
			
			$i++;
		}
	}
}
else { echo '<tr><td colspan="5">No records found.</td></tr>'; }
?>
        </tbody>
        <tfoot>
			<tr> 
			 <td class="text-center"><b>TOTAL INCOME</b></td>
			  <td class="text-center"><b>Coin <?php if(!empty($income)) { echo $tamount; } else { echo "0";}?></b></td><td></td><td></td>
			  <td></td>
			</tr>
        </tfoot>
    </table>	


</div>


 