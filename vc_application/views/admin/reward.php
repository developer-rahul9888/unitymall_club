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
 
        <h2>Team Sales Bonus &nbsp;&nbsp;</h2>
      </div>
  <!--<div class="">
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
    //print_r($editor);
      
      echo form_open('admin/reward');
      ?>
    
    <div class="col-sm-12">
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
</div> 
 <?php echo form_close(); ?>
<p>&nbsp;</p>   <div class="table-responsive"><table class="table table-bordered table-hover category-table"> <thead> <tr> <th>S. No.</th><th>Reward</th> </tr> </thead> <tbody> <?php $i = 1;foreach($reward as $con){     echo '<tr><td>'.$i.'</td><td>'.$con['reward'].'</td>';?>  td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/pin/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td    <?php echo '</tr>';$i++;}?></tbody> </table></div>
 </div>-->
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> pin updated with success.';
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
      ?>
    
    
    <div class="col-md-12">   
    <div class="table-responsive rewardd">
    <table class="table table-bordered table-hover category-table">   
    <thead>     
    <tr>      
      <th>S. No.</th>   
      <th>Direct Salar Rank</th>  
      <th>Left S.B.</th>      
      <th>Right S.B.</th>       
      <th>Bonus</th>      
      <th>M.B. Capping</th>   
      <th>Gift/Tour</th>      
      <th>Royality</th>   
    </tr>
    </thead> 
      <?php $reward = $profile[0]['reward']; ?>

      <tbody>   
    <tr <?php if($reward>=1) { echo 'class="green"'; } ?>>      <td>1.</td>     <td>Bronze</td>     <td>6</td>      <td> 12</td>      <td>1800</td>     <td>10:10=3000 Daily</td>     <td>----</td>     <td>--</td>   </tr>
    
        <tr <?php if($reward>=2) { echo 'class="green"'; } ?>>      <td>2.</td>     <td>Silver</td>     <td>15</td>     <td>30</td>     <td>4500</td>     <td>15:15=4500 Daily</td>     <td>----</td>     <td>--</td>   </tr>
    
          <tr <?php if($reward>=3) { echo 'class="green"'; } ?>>      <td>3.</td>     <td>Gold</td>     <td>38</td>     <td>76</td>     <td>11400</td>      <td>20:20=6000 Daily</td>     <td>----</td>     <td>--</td>   </tr>
      
        <tr <?php if($reward>=4) { echo 'class="green"'; } ?>>      <td>4.</td>     <td>Platinum</td>     <td>95</td>     <td>190</td>      <td>28500</td>      <td>25:25=7500 Daily</td>     <td>----</td>     <td>--</td>   </tr> 
    
        <tr <?php if($reward>=5) { echo 'class="green"'; } ?>>      <td>5.</td>     <td>Emrald</td>     <td>238</td>      <td>476</td>      <td>65000</td>      <td>--</td>     <td>LDP </td>     <td>--</td>   </tr>
    
        <tr <?php if($reward>=6) { echo 'class="green"'; } ?>>      <td>6.</td>     <td>Rubi</td>     <td> 595</td>     <td>1190</td>     <td>153000</td>     <td>--</td>     <td>NEPAL </td>     <td>--</td>   </tr>   
        <tr <?php if($reward>=7) { echo 'class="green"'; } ?>>      <td>7.</td>     <td>Sapphire</td>     <td> 1487</td>      <td>2974</td>     <td>400000</td>     <td>--</td>     <td>THAILAND </td>      <td>--</td>   </tr>
    
        <tr <?php if($reward>=8) { echo 'class="green"'; } ?>>      <td>8.</td>     <td>Diamond</td>      <td> 3718</td>      <td>7436</td>     <td>1011000</td>      <td>--</td>     <td>DUBAI </td>     <td>--</td>   </tr> 
    

        <tr <?php if($reward>=9) { echo 'class="green"'; } ?>>      <td>9.</td>     <td>Double Diamond</td>     <td>9295</td>     <td> 18590 </td>      <td>2021000</td>      <td>--</td>     <td>CAR BONUS </td>     <td>--</td>   </tr> 
    
        <tr <?php if($reward>=10) { echo 'class="green"'; } ?>>     <td>10.</td>      <td>Blue Diamond</td>     <td>23240</td>      <td> 46480 </td>      <td>6551000</td>      <td>--</td>     <td>SWITZERLAND </td>     <td>--</td>   </tr> 
    
        <tr <?php if($reward>=11) { echo 'class="green"'; } ?>>     <td>11.</td>      <td>Black Diamond</td>      <td>58100</td>      <td>116200 </td>      <td>11111000</td>     <td>--</td>     <td>Wila </td>      <td>2% RE.P.C.T.</td>   </tr> 
    

        </tbody>  <tfoot> <tr>      <td></td>     <td>TOTAL</td>      <td>96827</td>      <td> 193654</td>      <td>21358200</td>     <td></td>     <td> </td>      <td></td>   </tr> </tfoot></table></div></div>
</form>
 <?php echo form_close(); ?>