<?php
//flash messages
if ($this->session->flashdata('flash_message')) {
  if ($this->session->flashdata('flash_message') == 'updated') {
    echo '<div class="alert alert-success">';
    echo '<a class="close" data-dismiss="alert">×</a>';
    echo 'Your Redeem Request has been Accepted We Will Process Within 48 Working Hours.';
    echo '</div>';
  } elseif ($this->session->flashdata('flash_message') == 'already_updated') {
    echo '<div class="alert alert-success">';
    echo '<a class="close" data-dismiss="alert">×</a>';
    echo '<strong></strong> Already Request Sent. Your Wallet Will be credit whithing 2 days..';
    echo '</div>';
  } else {
    echo '<div class="alert alert-danger">';
    echo '<a class="close" data-dismiss="alert">×</a>';
    echo '<strong>Error!</strong> Request Not Sent.';
    echo '</div>';
  }
}
//print_r($restaurants);
?>

<?php

// $current_date = date('Y-m-d H:i:s',strtotime('-8 hours -19 minutes -15 seconds'));

$day = date("l"); // echo date('Y-m-d H:i:s');
//form data
$attributes = array('class' => 'form', 'id' => '');

//form validation
echo validation_errors();
//print_r($editor);

echo form_open('admin/Payment_request', $attributes);
//print_r($matching_income); 
if ($day == 'Wednesday' || $day == 'Saturday' || 1 == 1) {
?>

  <div class="col-sm-12">

    <h2>Payment Request </h2>
  </div>

  <div class="col-sm-12">
    <div class="request-form ">
      <input type="hidden" name="profile_com">
      <div class="col-sm-6 form-group"><label>Balance</label> <input id="balance" required type="text" readonly name="balance" value="<?php echo $wallet_amount; ?>" class="form-control"></div>

      <div class="col-sm-6 form-group"><label>Redeem</label> <input id="redeem" required type="number" min="500" max="" name="redeem" value="" class="form-control"></div>

      <div class="col-sm-6 form-group"><label>Redeemed balance after TDS (5%) + Admin(10%)</label> <input readonly id="final_redeem" type="text" name="final_redeem" value="<?php if ($this->input->post('redeem') != '') {
                                                                                                                                                                              echo $this->input->post('redeem');
                                                                                                                                                                            } ?>" class="form-control"></div>

      <div class="col-sm-6 form-group"><label>Balance after Redeem</label> <input type="text" id="after_redeem" name="after_redeem" value="" class="form-control"></div>


      


      <div class="col-sm-12"><input type="submit" name="redeem_bliss" value="Confirm Request" class="btn btn-primary "></div>

      <?php
      echo form_close();
      ?>
    </div>
  </div>
  <div class="col-sm-12 ">
  	<br>
    <div class="request-form ">

      <div class="table-responsive">
        <table class="table payment" style="width:100%">
          <tr>
            <th>Sr. no</th>
            <th>Redeemed Amt.</th>
            <th>Redeemed Amt. after TDS</th>
            <th>Request</th>

            <th>Date</th>
            <th>Status</th>
          </tr>
          <?php

          if (!empty($bliss_perk_history)) {
            $id = 1;
            foreach ($bliss_perk_history as $perk_history) {
              echo "<tr><td>" . $id . "</td><td>" . $perk_history['redeem'] . "</td><td>" . $perk_history['after_tds'] . "</td><td>" . $perk_history['my_bliss_req'] . "</td><td>" . $perk_history['rdate'] . "</td><td>" . $perk_history['redeem_status'] . "</td></tr>";
              $id++;
            }
          } ?>
        </table>
      </div>
    </div>

  </div>
<?php } else {

  echo '<div class="alert alert-success">';
  echo '<a class="close" data-dismiss="alert">×</a>';
  echo 'You can redeem wallet amount on Wednesday Or Saturday..';
  echo '</div>';
} ?>

<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.min.js"></script>
<script>
  jQuery('#redeem').keyup(function() {

    var redeem = jQuery("#redeem").val();
    var balance = jQuery("#balance").val();
    var cash = parseFloat(balance - redeem);
    <?php if ($profile[0]['var_status'] == 'yes') {  ?>
      var bliss = parseFloat(redeem * 0.85);
    <?php } else { ?>
      var bliss = parseFloat(redeem * 0.85);
    <?php } ?>
    jQuery("#final_redeem").val(bliss);
    jQuery("#after_redeem").val(cash);
  });


  jQuery('#type').change(function() {

    $(".form").submit();
  });
</script>