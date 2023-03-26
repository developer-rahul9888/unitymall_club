<?php $this->load->view('includes/admin/header'); ?>

 <div class="col-sm-12 panel-body ">


       <?php $this->load->view('includes/admin/sidebar'); ?>

 <div class="col-sm-10 main-body">
      <?php $this->load->view($main_content); ?>
</div>


</div>

<?php $this->load->view('includes/admin/footer'); ?>