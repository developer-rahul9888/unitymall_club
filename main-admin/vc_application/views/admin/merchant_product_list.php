

<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product updated with success.';
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

 
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products
        
      </h1>
      <ol class="breadcrumb">
       <!-- <a class="btn btn-primary flr" href="<?php echo base_url().'admin/product/add'; ?>">Add New</a>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <!-- /.box-header -->
          <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div class="box">
          
            <!-- /.box-header -->
            <div class="box-body">
			
		 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/product/', $attributes);
      ?>
		
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr><th>SKU</th> <th>Title</th><th>Actual Price</th><th>Discount Price</th><th>QTY</th><th>Description</th><th>Status</th><th>Delete</th> </tr>
                </thead>
                <tbody>
               <?php 
$i = 1;
foreach($product as $con){ 
	
	echo '<tr><td><a href="'.base_url().'admin/m_product/edit/'.$con['id'].'">'.$con['sku'].'</a></td><td><a href="'.base_url().'admin/m_product/edit/'.$con['id'].'">'.$con['pname'].'</a></td><td>'.$con['price'].'</td><td>'.$con['p_d_price'].'</td><td>'.$con['p_qty'].'</td><td>'.$con['s_discription'].'</td><td>'.$con['status'].'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/m_product/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
          
                </tbody>
                <tfoot>
                <tr><th>SKU</th> <th>Title</th><th>Actual Price</th><th>Discount Price</th><th>QTY</th><th>Description</th><th>Status</th><th>Delete</th> </tr>
                </tfoot>
              </table>
			   <?php echo form_close(); ?>
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 
 
 