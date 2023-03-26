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
<a class="btn btn-primary flr hide" href="<?php echo base_url(); ?>admin/sale/add">Add New</a>
        <h2>Franchise Order</h2>
      </div>
	   <div class="col-sm-12">
	  <form class="form form-inline" method="post" action="">
     
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="text" class="form-control" id="datepicker" required value="<?php if($this->input->post('s_name')!='') { echo $this->input->post('s_name'); }?>" name="sdate">
	  </div>
	  
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="text" class="form-control" id="datepicker1" required value="<?php if($this->input->post('e_name')!='') { echo $this->input->post('e_name'); }?>" name="edate"> 
		  </div>
		  
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>

  </form>
      
  

  
	</div>  

	  <p>&nbsp;</p>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> sale updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  //print_r($restaurants);
      ?>
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/sale/', $attributes);
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>S.NO.</th> <th>User ID</th><th>Franchise Id</th><th>TxnId</th><th>Total Paid</th><th>BV</th><th>Date</th><!-- <th>Delete</th> --> </tr> </thead> 
<tbody> 
<?php $gtotal = 0;
$i = 1;
$bv=0;$admin=0;$total=0;
foreach($sale as $con){ $gtotal = $gtotal + $con['gtotal'];
$bv = $bv + $con['bv'];
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/sale/invoice/'.$con['id'].'">'.$con['customer'].'</a></td> <td><a href="'.base_url().'admin/sale/invoice/'.$con['id'].'">'.$con['customer_id'].'</a></td>  <td>'.$con['id'].'</td><td><a href="'.base_url().'admin/sale/invoice/'.$con['id'].'">'.$con['gtotal'].'</a></td><td><a href="'.base_url().'admin/sale/invoice/'.$con['id'].'">'.$con['bv'].'</a></td><td>'.date('d F Y',strtotime($con['tdate'])).'</td>';
?>
	
<!-- <td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/sale/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td> -->
		<?php echo '</tr>';
$i++;
}                                                          
?>
</tbody> <tr style="height:40px;background-color:#a72522;color:#fff;"> 	<td colspan="3"><center><b>Total Paid</b></center></td><td></td>	<td>Rs <?php echo $gtotal; ?></td>	<td>Bv <?php echo $bv; ?></td>	<td></td><!-- <td></td> -->	</tr>
</table>
</div>
</form>
 <?php echo form_close(); ?>