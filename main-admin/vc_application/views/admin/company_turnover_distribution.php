<script type="text/javascript"> 

function deleteConfirm(url)

 {

    if(confirm('Do you want to Delete this record ?'))

    {

        window.location.href=url;

    }

 }

</script>	



     <style>



	 label.checkbox { padding-left: 20px;}



	 .add-more-d-area-div-parent input {margin-bottom: 6px;}



	 label.checkbox{font-weight:normal;}



	 </style>



      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url(); ?>">Back</a>



        <h2>Company Turnover Distribution</h2>



      </div>



 



      <?php



      //flash messages



      if($this->session->flashdata('flash_message')){



        if($this->session->flashdata('flash_message') == 'updated')



        {



          echo '<div class="alert alert-success">';



            echo '<a class="close" data-dismiss="alert">×</a>';



            echo '<strong>Well done!</strong> Distribution successfully.';



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

	   <div class="col-sm-12 hide">

<form class="form form-inline" method="post" action="">

     

		<div class="form-group col-sm-3">

		<label>From :</label>

	  <input type="text" name="sdate" class="form-control" id="datepicker" required value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>">

	  </div>

	  

	<div class="form-group col-sm-3">

	<label>To :</label>

		    <input type="text" name="edate" class="form-control" id="datepicker1" required value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>"> 

		  </div>

		  

		  <div class="form-group col-sm-3">

		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 

		  </div>



  </form>

       </div>

<!--div class="col-sm-12">

	  

      

  

  <div class="form-group col-sm-3"> 

		   <?php echo form_open(base_url().'index.php/vc_site_admin/customer/generatecsv'); ?> 

		   <input type="hidden"  value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" name="sdate">

		    <input type="hidden"  value="<?php if($this->input->post('edate')!='') { echo $this->input->post('edate'); }?>" name="edate"> 

		    

		    	<label>&nbsp;</label>

		   <input type="submit" name="submit" style="display:block" class="btn btn-success" value="Generate CSV">

		   

		   <?php echo form_close(); ?>

		  </div>

  

	</div-->  

      <?php



      //form data



      $attributes = array('class' => 'form', 'id' => '');







      //form validation



      echo validation_errors();



	  //print_r($editor);



      



      echo form_open_multipart('admin/company_turnover_distribution');



      ?>



      



	  





	  

	

	  <p>&nbsp;</p>



<fieldset>



		 <div class="form-group col-sm-4">



            <label>Amount</label>



              <input required type="number" class="form-control" value="<?php echo $monthly_business; ?>" name="amount" >

			  



          </div>

		  

		  



		  



		



          <div class="form-group  col-md-12">



            <button class="btn btn-primary" type="submit">Updates</button> &nbsp;  



          </div>



		 



		  </fieldset>



	   <div id="sponsr_name"></div>



	  



     <div class="table-responsive">

<table id="example" class="table table-bordered table-hover customer-table"> 

  <thead> <tr><th>ID</th> <th>Name</th><th>Distributor ID</th><th>Sponsor ID</th><th>Direct Sponsor</th><th>Phone</th><th>Achiever</th> </tr> </thead> 

<tbody> 

<?php 

$i = 1;

$Travel = $Car = $House = $crown = 0 ;

foreach($customer as $con){

 

  if($con['royality']== 1) {$Travel=$Travel+1; $type="Travel";} 

  if($con['royality']== 2) {$Car=$Car+1; $type="Car"; } 

  if($con['royality']== 3) {$House=$House+1; $type="House"; } 

  if($con['royality']== 4) {$crown=$crown+1; $type="crown";}



  

  echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/customer/edit/'.$con['id'].'">'.$con['f_name'].'</a></td><td>'.$con['customer_id'].'</td><td>'.$con['parent_customer_id'].'</td><td>'.$con['direct_customer_id'].'</td><td>'.$con['phone'].'</td><td>'.$type.'</td>';

?>

<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/customer/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->

    <?php '</tr>';

	

$i++;

}

?>

</tbody> 

<tr style="height:40px;background-color:#0098da;"> 



	<td><center><b>Travel royality Achiever</b></center> </td>

	<td><?php echo $Travel; ?></td>

	<td><center><b>Car royality Achiever</b></center> </td>

	<td><?php echo $Car; ?></td>

	<td><center><b>House royality Achiever</b></center> </td>

	<td><?php echo $House; ?></td>

	<!-- <td><center><b>crown royality Achiever</b></center> </td>

	<td><?php echo $crown; ?></td> -->

	<td></td>

</tr>

</table>

</div>



	  <?php echo form_close(); ?>



	  







