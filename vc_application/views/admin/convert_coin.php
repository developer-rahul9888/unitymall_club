<div class="mainbar no-print hidden-xs">
  <nav class="">
    <div class="container">

    </div> <!-- /.container -->
  </nav>
</div>

<div class="container">
  <div class="content">
    <div class="content-container">
      <div class="page-heading">
        <h2>Convert Coin</h2>

      </div>
      <div class="col-sm-12 right-bar">
        <br>
        <?php
//flash messages
if ($this->session->flashdata('flash_message')) {
    if ($this->session->flashdata('flash_message') == 'updated') {
        echo '<div class="alert alert-success">';
        echo '<a class="close" data-dismiss="alert">×</a>';
        echo 'Successfully Transfered.';
        echo '</div>';
    }
}

echo validation_errors();

$attributes = array('class' => 'form');
echo form_open(base_url() . 'admin/convert-coin', $attributes);
?>




        <div class="form-group col-sm-12">
          <label>Amount To Be Transfer</label>
          <input type="number" name="amount" placeholder="Amount To Be Transfer" required class="form-control">
        </div>

        <div class="form-group col-sm-12">
          <label>Amount will be tranfered</label>
          <input type="number" name="final" readonly value="0" required class="form-control">
        </div>

        <div class="form-group  col-lg-12">
          <button class="btn btn-primary" name="submit" value="submit" type="submit">Submit</button> &nbsp;
        </div>

        <?php echo form_close(); ?>

      </div>


    </div>
  </div>
</div>

<script>
  $('input[name="amount"]').keyup(function() {
    $('input[name="final"]').val($(this).val()*10);
  });
</script>