<div class="page-heading"> 
        <h2>Downline Wise Sale List</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> order updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  //print_r($restaurants);
     
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	 // print_r($editor);
      
     echo form_open(base_url().'admin/downlinesale/', $attributes);
      ?>	  

<div class="row">
<div class="col-md-12 col-sm-12">

<div class="col-xs-12 col-md-4 col-sm-6">
<div class="form-group">
<label class="control-label">Date From </label> 
<input name="sdate" type="text" id="datepicker1" class="form-control form-control-inline input-medium datepicker">
</div>
</div>
<div class="col-xs-12 col-md-4 col-sm-6">
<div class="form-group">
<label class="control-label">Date To </label> 
<input name="edate" type="text" id="datepicker" class="form-control form-control-inline input-medium datepicker">
</div>
</div>

<div class="col-xs-12 col-md-4 col-sm-6 text-left"><input type="submit" name="submit" value="Show" id="ContentPlaceHolder1_btnShow" class="btn btn-success"></div>
<div class="clearfix"></div>
<br>
<div class="col-md-12 col-sm-12 martintb header-mainv1 stickyv1">
<div class="table-responsive"> 

<table cellspacing="0" rules="all" class="table table-striped table-bordered table-hover" border="1" id="ContentPlaceHolder1_GridView1" style="width:100%;border-collapse:collapse;">
<tbody>
<tr align="center">
<th scope="col">S.No</th><th scope="col">Customer ID</th><th scope="col">Customer Name</th><th scope="col">Total Amount</th><th scope="col">Orderdate</th>
</tr>
<?php 
setlocale(LC_MONETARY,"en_IN");
$grand_total = 0; 
if(!empty($sales)) {  
	$i = 1;
	foreach($sales as $row) {  
		$grand_total = $grand_total + $row['total_amount'];
		echo '<tr align="center"><td>'.$i.'</td><td>'.$row['customer_id'].'</td><td>'.$row['f_name'].' '.$row['l_name'].'</td><td>'.$row['total_amount'].'</td><td>'.date('d F Y',strtotime($row['o_date'])).'</td></tr>';
		$i++;
	}
} 


echo '<tr align="center"><td colspan="3"></td><td><b>'.money_format("%i",$grand_total).'</b></td><td></td></tr>';
?>

</tbody>
</table>
 
</div>
</div>

</div>
</div>
</div>
</div>


	  <?php echo form_close(); ?>

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	  <!--link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script-->

<script type="text/javascript">
jQuery(document).ready(function () { 
	jQuery( ".datepicker" ).datepicker({maxDate:0,
      changeMonth: true,
      changeYear: true
    });
});
 </script>	


