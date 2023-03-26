<div class="container"> 
 <div class="content">    
 <div class="content-container"> 
 <div class="col-sm-12">

      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Wallet updated successfully.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Wallet updation Failed.';
          echo '</div>';          
        }
      }
	   echo validation_errors();
	  //print_r($restaurants);
      ?>

<form class="form club-form" method="post" action="">
<input type="hidden" name="how_to_pay" value="paytm">
		    <div class=" mt-4 main-container">
						<div class=" prt">
						<h2 class="text-center top-bdr"><span>Add Fund</span></h2>
						 </div>
						</div>
						
	
	<div class=" mt-20 main-container">
            <div class="row">

           <div class="form-group col-sm-6">
            <label> Your Current Balance</label>
				<h2>₹ <?php echo $profile[0]['bliss_amount'];  ?></h2>
			<label>Add Fund to Wallet </label>
              <input type="text" class="form-control" name="TXN_AMOUNT" value="" placeholder="Enter Amount">
			  <br>
			  <div class="form-group  req-btn">
				<button class="btn btn-primary" type="submit">Proceed to Payment</button> 
			  </div>
		  </div>

          <div class="col-lg-6 col-md-6 hidden-xs">
				<img src="<?php echo base_url(); ?>images/wallettt.png">
          </div>
                 
				
            </div>
       </div>

 <div class=" mt-4 main-container">
            <div class=" prt">
            <h2 class="text-center top-bdr"><span>History</span></h2>
             </div>
            </div>
       <table class="table table-bordered table-hover product-table"> 
<thead> <tr><th>S No.</th><th>Amount</th><th>Status </th><th>Date</th></tr> </thead> 
<tbody> 
<?php 
$i=1;
if(!empty($history)) {

foreach($history as $con){


echo '<tr><td>'.$i.'</td>
<td>Rs '.$con['cr'].'</td>
<td>'.$con['status'].'</td>
<td>'.$con['e_date'].'</td></tr>';

$i++;
}
}

?>
</tbody> 
</table>




						
 </form>
 
</div>
</div>
</div></div>

<script>  
$(document).ready(function(){
    $('#sel1').on('change', function() {
        var i= $('#sel1').val();
      if (i=='555')
      {
        $("#div1").attr("max","3");
      }
      else if (i == '1000')
      {
        $("#div1").attr("max","2");
      }
      else if (i == '1500')
      {
       $("#div1").attr("max","1");
      }
    });
});
</script>
