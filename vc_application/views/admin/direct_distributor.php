<div class="page-heading"> 
        <h2>My Direct Team</h2>
      </div>
 <style>
     .show-all-tr{margin:5px 6px;float:none;}
 </style> 
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
	  //print_r($editor);
      
     //echo form_open('admin/category/', $attributes);
      ?>	  

	  <?php 
	  $total_distributer = 0;
	  $distributer_info = '';
if(!empty($myfriends)) { //echo '<pre>'; print_r($myfriends); echo '</pre>';
	$i = 1;
	
	usort($myfriends, function($a, $b) {
        return $a['id'] - $b['id'];
    });
    $position = $this->uri->segment(3);
	
	foreach($myfriends as $friend) {
	    if($position==''){ $show = 'true'; }
				
	    elseif($position=='left' && $friend['position']=='left') { $show = 'true'; }
	    elseif($position=='right' && $friend['position']=='right') { $show = 'true'; }
	    else { $show = 'false'; }
		
		if($friend['consume'] > 0) { $store = 'Green'; } else { $store = 'Red'; } { $show = 'true'; }

        if($friend['user_level']==2) { $rank = 'Active Associate'; }
                 elseif($friend['user_level']==3) { $rank = 'Bronze'; }
                 elseif($friend['user_level']==4) { $rank = 'Silver'; }
                 elseif($friend['user_level']==5) { $rank = 'Gold'; }
                 else { $rank = 'Associate'; }
		
	   // if($friend['consume'] >=1) { $store='green'; } else { $store='red'; }
	    if($show=='true') {						
				$total_distributer = $total_distributer + 1;
				$distributer_info .= '<tr align="center" class="'.$friend['position'].'-tr all-tr"><td>'.$i.'</td><td>'.$friend['customer_id'].'</td><td>'.$friend['phone'].'</td><td>'.$friend['f_name'].' '.$friend['l_name'].'</td>
				<td>'.$rank.'</td><td>'.$friend['dcustomer_id'].'</td><td>'.date('d F Y',strtotime($friend['rdate'])).'</td><td>'.$store.'</td>';
							
				//$store='</td></tr>';
				$i++; 
	    }
	}
} ?>
<div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="tabbable-line boxless tabbable-reversed">
                <div class="portlet-body form">
                    <div class="form-body">
                         <div class="form-group">
                            <div class="col-md-3"> <label class="control-label"> Detail of : <?php echo $current_user;?></label></div>
                            <div class="col-md-3"> <label class="control-label"> Total : <?php echo $total_distributer; ?></label><?php if($show_inner=='true') { echo '<a class="flr btn btn-primary" href="'.base_url().'admin/downlineall">Back</a>'; } ?></div>
                            
                        </div>
            </div>
            </div>
            </div>
            <div id="ContentPlaceHolder1_mainDiv" class="col-md-12 col-sm-12 martintb">        
        <div class="table-responsive">
            <div>
<?php //print_r($myfriends); ?>
<div class="table-responsive">
	<table id="example" cellspacing="0" rules="all" class="table table-striped table-bordered table-hover" border="1" id="ContentPlaceHolder1_GridView1" style="width:100%;border-collapse:collapse;">

<thead><tr>
<th scope="col">S.No</th><th scope="col">User ID</th><th scope="col">Phone No</th><th scope="col">User Name</th><th scope="col">Rank</th><th scope="col">Sponser ID</th><th scope="col">DOJ</th><th scope="col">Status</th>
</tr>
</thead>
<tbody>
<?php echo $distributer_info; ?>

</tbody></table></div>
</div>
            </div>
            </div>
            
            </div> </div>

<script>
    jQuery('document').ready(function(){
       jQuery('.show-all-tr').click(function(){
           jQuery('.all-tr').hide();
           var cls = jQuery(this).attr('data');
           jQuery(cls).show();
       });
    });
</script>
	  <?php //echo form_close(); ?>