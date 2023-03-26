<div class="page-heading"> 

        <h2>Rewards</h2>

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

      ?>

 <?php

      //form data

      $attributes = array('class' => 'form form-inline', 'id' => '');



      //form validation

      echo validation_errors();

	  //print_r($editor);

      

     //echo form_open('admin/bonanza/', $attributes);

      ?>

	  <div class="table-responsive">

<table class="table table-bordered table-hover category-table"> 

<thead> <tr><th>Sr.</th><th>Reward</th>

<tbody>   

<?php 

$i = 1;

foreach($reward as $con){  

//if($bonanza[0]['id']=$rewards[0]['bonanza_id']) {

//if(in_array($con['id'],$ids)) { $class = 'style="background-color:#96d59b;"'; } else { $class = ''; }

echo '<tr '.$class.'><td>'.$i.'</td><td>'.$con['reward'].'</td>';
	
	
	
	?>

	

<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php //echo base_url().'admin/order/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->

		<?php echo '</tr>';

$i++;

}

?>

</tbody> 

</table></div>

 <?php //echo form_close(); ?> 