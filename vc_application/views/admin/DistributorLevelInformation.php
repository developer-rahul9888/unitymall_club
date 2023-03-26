


<div class="page-heading"> 


        <h2>Referral Network Level Information</h2>


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


      


     //echo form_open('admin/category/', $attributes);


      ?><div class="col-md-12 col-sm-12">


	  <div class="row hide">


	  <div class="col-md-5">


	  <div class="form-group"><label class="control-label col-md-5">RD Code :</label>


	  <div class="col-md-6"><span id="ContentPlaceHolder1_DistributorId" class="form-control" style="font-weight: bold;font-size: 12px; border: none;"><?php echo $profile[0]['customer_id'];?></span>


	  </div>


	  </div>


	  </div>


	  <div class="col-md-5">


	  <div class="form-group"><label class="control-label col-md-5">Sponser Id :</label>


	  <div class="col-md-6"><span id="ContentPlaceHolder1_lblsponserid" class="form-control" style="font-weight: bold; font-size: 12px; border: none;"><?php echo $profile[0]['parent_customer_id'];?></span></div>


	  </div>


	  </div>


	  </div>


	  


	  <div class="row hide">


	  <div class="col-md-5"><div class="form-group"><label class="control-label col-md-5">RD Name :</label><div class="col-md-6"><span id="ContentPlaceHolder1_txtName" class="form-control" style="font-weight: bold;                                    font-size: 12px; border: none;"><?php echo $profile[0]['f_name'].' '.$profile[0]['l_name'];?></span></div></div></div>


	  <div class="col-md-5"><div class="form-group"><label class="control-label col-md-5">Sponser Name :</label>


	  <div class="col-md-6"><span id="ContentPlaceHolder1_txtUpName" class="form-control" style="font-weight: bold;font-size: 12px; border: none;"><?php if(!empty($parent_profile)) { echo $parent_profile[0]['f_name'].' '.$parent_profile[0]['l_name']; } ?></span></div>


	  </div>


	  </div>


	  </div>


	  


	  <h2 class="page-title"><b>Select Levels</b></h2>


	  <div class="col-md-12 col-sm-12">


	  <div class="row">


	  <form method="post" action="<?php echo base_url(); ?>admin/DistributorLevelInformation">


	  <div class="table-responsive" style="width: 75vw;">


	  <table id="ContentPlaceHolder1_rb" class="ver12bldgray" style="width:100%;">


	  <tbody>


	  <tr><td><span class="btn green" style="margin-bottom: 2px;"><label><input onclick="this.form.submit();" type="radio" name="level" value="1" <?php if($this->input->post('level')=='' || $this->input->post('level')=='1') { echo 'checked="checked"'; } ?>> Level 1</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input type="radio" name="level" value="2" onclick="this.form.submit();" <?php if($this->input->post('level')=='2') { echo 'checked="checked"'; } ?>> Level 2</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='3') { echo 'checked="checked"'; } ?> type="radio" name="level" value="3" onclick="this.form.submit();"> Level 3</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='4') { echo 'checked="checked"'; } ?> type="radio" name="level" value="4" onclick="this.form.submit();"> Level 4</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='5') { echo 'checked="checked"'; } ?> type="radio" name="level" value="5" onclick="this.form.submit();"> Level 5</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='6') { echo 'checked="checked"'; } ?> type="radio" name="level" value="6" onclick="this.form.submit();"> Level 6</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='7') { echo 'checked="checked"'; } ?> type="radio" name="level" value="7" onclick="this.form.submit();"> Level 7</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='8') { echo 'checked="checked"'; } ?> type="radio" name="level" value="8" onclick="this.form.submit();"> Level 8</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='9') { echo 'checked="checked"'; } ?> type="radio" name="level" value="9" onclick="this.form.submit();"> Level 9</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='10') { echo 'checked="checked"'; } ?> type="radio" name="level" value="10" onclick="this.form.submit();"> Level 10</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='11') { echo 'checked="checked"'; } ?> type="radio" name="level" value="11" onclick="this.form.submit();"> Level 11</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='12') { echo 'checked="checked"'; } ?> type="radio" name="level" value="12" onclick="this.form.submit();"> Level 12</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='13') { echo 'checked="checked"'; } ?> type="radio" name="level" value="13" onclick="this.form.submit();"> Level 13</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='14') { echo 'checked="checked"'; } ?> type="radio" name="level" value="14" onclick="this.form.submit();"> Level 14</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='15') { echo 'checked="checked"'; } ?> type="radio" name="level" value="15" onclick="this.form.submit();"> Level 15</label></span></td> 

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='16') { echo 'checked="checked"'; } ?> type="radio" name="level" value="16" onclick="this.form.submit();"> Level 16</label></span></td> 

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='17') { echo 'checked="checked"'; } ?> type="radio" name="level" value="17" onclick="this.form.submit();"> Level 17</label></span></td> 

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='18') { echo 'checked="checked"'; } ?> type="radio" name="level" value="18" onclick="this.form.submit();"> Level 18</label></span></td>

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='19') { echo 'checked="checked"'; } ?> type="radio" name="level" value="19" onclick="this.form.submit();"> Level 19</label></span></td> 

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='20') { echo 'checked="checked"'; } ?> type="radio" name="level" value="20" onclick="this.form.submit();"> Level 20</label></span></td> 

	  <td><span class="btn green" style="margin-bottom: 2px;"><label><input <?php if($this->input->post('level')=='21') { echo 'checked="checked"'; } ?> type="radio" name="level" value="21" onclick="this.form.submit();"> Level 21</label></span></td> 

	  </tr>


	  </tbody>


	  </table>


	  </div>


	  </form>


	  </div>


	  


	  </div>


	  


	  <div id="ContentPlaceHolder1_List">


	  <div class="controls-row">


	  <h1 class="page-title"><span id="ContentPlaceHolder1_LevelNo">Details Of: <?php echo $current_user;?></span> 


	  <?php if($show_inner=='true') { echo '<a class="btn btn-primary flr" href="'.base_url().'admin/DistributorLevelInformation">Back</a>'; } ?></h1>


	  </div>


	  </div>


	  <div class="col-md-12 col-sm-12 martintb">


	  <div class="table-responsive">


	  <div>


	  <table id="example" cellspacing="0" rules="all" class="table table-bordered table-striped" border="1" style="border-collapse:collapse;width: 100%">
<thead>
<tr>


<th scope="col">S.No</th><th scope="col">User ID</th><th scope="col">User Name</th><th scope="col">Rank</th><th scope="col">DOJ</th><th scope="col">City</th><th scope="col">State</th><th scope="col">Pincode</th><th scope="col">Sponser ID</th><th scope="col">Status</th>


</tr>
</thead>

	 <tbody>




<?php $no_user_found = 'true';


if(!empty($myfriends)) { 


	$i = 1;


	foreach($myfriends as $friend) {



				 $no_user_found = 'false';


				 if($friend['user_level']==2) { $rank = 'Active Associate'; }
				 elseif($friend['user_level']==3) { $rank = 'Bronze'; }
				 elseif($friend['user_level']==4) { $rank = 'Silver'; }
				 elseif($friend['user_level']==5) { $rank = 'Gold'; }
				 else { $rank = 'Associate'; }
				 if($friend['consume'] > 0) { $status = 'Green'; } else { $status = 'Red'; }
				echo '<tr align="center"><td>'.$i.'</td><td><a href="'.base_url().'admin/DistributorLevelInformation/'.$friend['customer_id'].'">'.$friend['customer_id'].'</a></td><td>'.$friend['f_name'].' '.$friend['l_name'].'</td><td>'.$rank.'</td><td>'.date('d F Y',strtotime($friend['rdate'])).'</td><td>'.$friend['city'].'</td><td>'.$friend['state'].'</td><td>'.$friend['pincode'].'</td><td>'.$friend['parent_customer_id'].'</td><td>'.$status.'</td></tr>';


				$i++;


			


		


	}


} 


if($no_user_found == 'true') { echo '<tr><td colspan="9">No user found</td></tr>'; } 


?>


</tbody>  


	  </table></div></div></div><span id="ContentPlaceHolder1_Label2" style="color:Red;font-weight:bold;display: none;"></span></div>


