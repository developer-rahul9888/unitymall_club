 
 <!-- /.mainbar -->

<div class="content">
    <div class="content-container">
<div>
		<h2 class="content-header-title text-center"><?php if (!empty($page_title)) echo $page_title;?>
: <?php echo array_sum(array_column($incomes,'amount')); ?> </h2>
</div>
<div class="row">
<div class="col-md-12 col-sm-12">
<div class="tabbable-line boxless tabbable-reversed">
<div class="portlet light bordered">
<div class="portlet-title tabbable-line">
<div id="ContentPlaceHolder1_mainDiv" class="col-md-12 col-sm-12 martintb">
<div class="table-responsive">
<div>
<table cellspacing="0" rules="all" class="table table-striped table-bordered table-hover" border="1" id="ContentPlaceHolder1_GridView1" style="width:100%;border-collapse:collapse;">
<tbody>

<tr>
<th scope="col">Sr no.</th><th scope="col">User Send By</th><th scope="col">Name</th><th scope="col">Amount</th><th scope="col">Pay Level</th><th scope="col">Status</th>
</tr>

<?php if(!empty($incomes)) {  $i = 1; foreach ($incomes as $income) { ?>

<tr align="center">
<td><?php echo $i; ?></td>
<!--<td><?php echo $income['r_date']; ?></td>-->
<td><?php echo $income['customer_id']; ?></td>
<td><?php echo $income['f_name']; ?></td>
<td>Rs. <?php echo $income['amount']; ?></td>
<td><?php echo $income['pay_level']; ?></td>

<td>Confirm</td>

</tr>
<?php $i++; } }  ?>

</tbody></table>
</div>
</div> 
</div>
</div>
</div>
</div>
</div>
<!------ Include the above in your HEAD tag ---------->

</div>


 <!-- END PAGE CONTENT -->


</div></div>


 <link rel="icon" href="assets/img/favicon.html" />
    <!-- External CSS -->
    <link href="<?php echo base_url(); ?>assets/btc/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <!-- Bootstrap core CSS -->
  
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/btc/assets/css/emberf675.css" rel="stylesheet">
	
	
	

<script src="<?php echo base_url(); ?>assets/btc/assets/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/btc/assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/btc/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/btc/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

<script>
var ember = [];
var usdInput = document.getElementById("amtUSD");
var btcInput = document.getElementById("amtBTC");

ember.btcPrice = 5316.819822;
ember.socket = io.connect('https://socket.coincap.io/');
ember.socket.on('trades', function(data) {
  var amt = document.getElementById("amtUSD");
    if (data.coin == "BTC") {
        ember.amtUSD = usdInput.value;
        ember.amtBTC = btcInput.value;
        ember.usdCalc = ember.amtBTC * data.msg.price;
        if(data.msg.price > amt.value) {
          $(amt).addClass('increment');
        } else {
          $(amt).addClass('decrement');
        }
        $("#amtUSD").attr("value", ember.usdCalc);
        setTimeout(function () {
            $(amt).removeClass('increment decrement');
        }, 700);
    }
});

$("#amtBTC").bind("change paste keyup", function() {
    ember.usdCalc = $(this).val() * ember.btcPrice;
    $("#amtUSD").attr("value", ember.usdCalc);
});



</script>
	
