<?php date_default_timezone_set('America/New_York'); ?>


<div class="row" style="margin:5px -15px 10px;">
<div class="col-sm-6 page-heading"> 
        <h2>Search</h2>
      </div>
<div class="col-sm-6 text-right" style="margin-top: 20px;">
<?php 
$per_day = date('Y-m-d').' 00:00:00,'.date('Y-m-d').' 23:59:59';
$tomorrow = date('Y-m-d',strtotime("+1 day",strtotime(date('Y-m-d')))).' 00:00:00,'.date('Y-m-d',strtotime("+1 day",strtotime(date('Y-m-d')))).' 23:59:59';


if(date('D',strtotime(date('Y-m-d')))=='Mon') { 
  $week = date('Y-m-d').' 00:00:00,'.date('Y-m-d',strtotime("+7 days",strtotime(date('Y-m-d')))).' 23:59:59';
} else { 
   $wdate = date('Y-m-d',strtotime('last Monday', strtotime(date('Y-m-d')))); 
   $week = $wdate.' 00:00:00,'.date('Y-m-d',strtotime("+7 days",strtotime($wdate))).' 23:59:59';
}


$per_month = date('Y-m').'-01 00:00:00,'.date('Y-m-t').' 23:59:59';
$last_month = date('Y-m',strtotime("-1 month",strtotime(date('Y-m-d')))).'-01 00:00:00,'.date('Y-m-t',strtotime("-1 month",strtotime(date('Y-m-d')))).' 23:59:59';
$last_2_month = date('Y-m',strtotime("-2 month",strtotime(date('Y-m-d')))).'-01 00:00:00,'.date('Y-m-t',strtotime("-2 month",strtotime(date('Y-m-d')))).' 23:59:59';
$last_3_month = date('Y-m',strtotime("-3 month",strtotime(date('Y-m-d')))).'-01 00:00:00,'.date('Y-m-t',strtotime("-3 month",strtotime(date('Y-m-d')))).' 23:59:59';
$per_year = date('Y').'-01-01 00:00:00,'.date('Y').'-12-31 23:59:59';

if($this->input->post('current_month')!= '') {
   $current_month = $this->input->post('current_month'); 
} elseif($this->input->post('filter')!='') {
	  $filter = $this->input->post('filter');
        $date = explode(',',$filter);
		$current_month = date('m/d/Y',strtotime($date[0]));
} else {
	$current_month = date('m/d/Y'); 
}

$cdate = $current_month;

$next_month = date('Y-m',strtotime("+1 month",strtotime($current_month))).'-01 00:00:00,'.date('Y-m-t',strtotime("+1 month",strtotime($current_month))).' 23:59:59';
$next_m = date('F',strtotime("+1 month",strtotime($current_month)));
$next_current_month = date('Y-m-d',strtotime("+1 month",strtotime($current_month)));

$prev_month = date('Y-m',strtotime("-1 month",strtotime($current_month))).'-01 00:00:00,'.date('Y-m-t',strtotime("-1 month",strtotime($current_month))).' 23:59:59';
$prev_m = date('F',strtotime("-1 month",strtotime($current_month)));
$prev_current_month = date('Y-m-d',strtotime("-1 month",strtotime($current_month)));
?>
<form class="form form-inline" action="/admin/search" method="post" style="">
<a class="advan-search" style="color:#00ABED;" href="javascript:;">Click here for advance search</a> 
<select name="filter" class="form-control" onchange="this.form.submit()">
 <option value="<?php echo $per_month; ?>">Current Month</option>
 <option <?php if($this->input->post('filter')==$per_day) { echo 'selected="selected"'; }?> value="<?php echo $per_day; ?>">Today</option>
 <option <?php if($this->input->post('filter')==$tomorrow) { echo 'selected="selected"'; }?> value="<?php echo $tomorrow; ?>">Tomorrow</option>
 <option <?php if($this->input->post('filter')==$week) { echo 'selected="selected"'; }?> value="<?php echo $week; ?>">Current Week</option>
 <option <?php if($this->input->post('filter')==$last_month) { echo 'selected="selected"'; }?> value="<?php echo $last_month; ?>">Last Month</option>
 <option <?php if($this->input->post('filter')==$last_2_month) { echo 'selected="selected"'; }?> value="<?php echo $last_2_month; ?>">2 Months Ago</option>
 <option <?php if($this->input->post('filter')==$last_3_month) { echo 'selected="selected"'; }?> value="<?php echo $last_3_month; ?>">3 Months Ago</option>
 <!--option <?php //if($this->input->post('filter')==$per_year) { echo 'selected="selected"'; }?> value="<?php //echo $per_year; ?>">1 Year</option-->
</select>
</form>
</div>
</div>

<div class="row advan-search-div" style="margin:5px -15px 10px;display:none;">
<div class="col-sm-6"></div>
<div class="col-sm-6 text-right">
<form class="form form-inline" action="/admin/search" method="post">
<input required="" type="text" name="sdate" value="<?php if($this->input->post('sdate')!='') { echo $this->input->post('sdate'); }?>" placeholder="Start Date" class="form-control datepicker">
<input required="" type="text" name="ldate" value="<?php if($this->input->post('ldate')!='') { echo $this->input->post('ldate'); }?>" placeholder="End Date" class="form-control datepicker">
<input type="submit" name="search" value="Search" class="btn btn-primary">
</form>
</div>

</div>

<div class="row">
<div class="col-sm-4 text-left">
<form class="form form-inline" action="/admin/search" method="post">
<input type="hidden" name="next_prev" value="<?php echo $prev_month;?>"> <input type="hidden" name="current_month" value="<?php echo $prev_current_month;?>">
<input type="submit" name="submitform" class="btn btn-primary btn-sm" value="&laquo; Prev (<?php echo $prev_m;?>)">
</form>
</div>

<div class="col-sm-4 text-center"><h3 style="margin-top:0px;"><?php echo date('F Y',strtotime($current_month));?></h3></div>

<div class="col-sm-4 text-right">
<form class="form form-inline" action="/admin/search" method="post">
<input type="hidden" name="next_prev" value="<?php echo $next_month;?>"> <input type="hidden" name="current_month" value="<?php echo $next_current_month;?>">
<input type="submit" name="submitform" class="btn btn-primary btn-sm" value="(<?php echo $next_m;?>) Next &raquo;">
</form>
</div>
</div>


<table class="table table-bordered"> 
<thead> <tr> <th>Date</th><th>Coordinator</th> <th>Study</th> <th>Meals Required</th> <th>Dietary Requirements</th> </tr> </thead> 
<tbody> 
<?php if ($this->input->server('REQUEST_METHOD') === 'POST' && ($this->input->post('filter') == $per_day || $this->input->post('filter') == $tomorrow || $this->input->post('filter') == $week || $this->input->post('sdate') != '')) {
	
	$i = 1;
if(empty($order)) { echo '<tr><td colspan="5">No order</td></tr>'; }
else { 
foreach($order as $con){ 
      $d = date('d',strtotime($con['odate']));
	  if(($d%2)==0) { $oddeven = 'even'; } else { $oddeven = 'odd'; }
	  
        $date = date('Y-m-d',strtotime($con['odate']));
        $show_date = date('l, F dS Y',strtotime($con['odate']));
        if($i==1) {  $show_date; }
        elseif($c_date == $date){ $show_date = ''; }
        else {  $show_date; echo '<tr class="sperater"><td bgcolor="#00ABED" colspan="5"></td></tr>'; }
        $c_date = $date;
		
	echo '<tr class="'.$oddeven.'';
        if($con['status']=='Pending') { echo ' pending'; }
        echo '"><td><strong>';
		echo $show_date;
       echo '</strong></td><td><a href="javascript" class="member-click" data-cls="'.str_replace(' ','-',$con['coordinator']).'" data-toggle="modal" data-target="#coordinatorInfo">'.$con['coordinator'].'</a></td><td>'.$con['study'].'</td><td>'.$con['meals_qty'].' x '.$con['meals'].'</td><td>'.$con['dietary'].'</td>  </tr>';
$i++;
} 
} 

} else {  ?>
<?php 

/*$cdate = date('m/d/Y'); */

$m = date('m',strtotime($cdate));
$y = date('Y',strtotime($cdate));

$order_array = array();
$i = 1;
$oddeven = 'even';
if(!empty($order)) {
foreach($order as $con){ 
      $order_val = '';
	  
        $date = date('Y-m-d',strtotime($con['odate']));
        $show_date = date('l, F dS Y',strtotime($con['odate']));
		$d = date('d',strtotime($con['odate']));
		if(($d%2)==0) { $oddeven = 'even'; } else { $oddeven = 'odd'; }
	$order_val .= '<tr class="'.$oddeven.'';
        if($con['status']=='Pending') { $order_val .= ' pending'; }
        $order_val .= '"><td><strong>';
		
        if($i==1) { $order_val .= $show_date; }
        elseif($c_date == $date){ }
        else { $order_val .= $show_date; }
		
        $c_date = $date;
       $order_val .= '</strong></td><td><a href="javascript" class="member-click" data-cls="'.str_replace(' ','-',$con['coordinator']).'" data-toggle="modal" data-target="#coordinatorInfo"> '.$con['coordinator'].'</a></td> <td>'.$con['study'].'</td><td>'.$con['meals_qty'].' x '.$con['meals'].'</td><td>'.$con['dietary'].'</td>  </tr>';
	if($m == date('m',strtotime($con['odate']))){
		if (array_key_exists($d, $order_array)) { $order_array[$d] = $order_array[$d].''.$order_val; }
		else { $order_array[$d] = $order_val; }
	} 
$i++;
} 
} 

?>

<?php 
$date = date('m/d/Y',strtotime($m.'/01/'.$y));

for($i=1;$i<36;$i++) {  
  if($m == date('m',strtotime($date))) {
	  $d = date('d',strtotime($date));
	  if (array_key_exists($d, $order_array)) {
          echo $order_array[$d]; 
		} else {
			if(($d%2)==0) { $oddeven = 'even'; } else { $oddeven = 'odd'; }
echo '<tr class="'.$oddeven.'"><td><strong>';
 $date = date('Y-m-d',strtotime($date));
        $show_date = date('l, F dS Y',strtotime($date));
        if($i==1) { echo $show_date; }
        elseif($c_date == $date){ }
        else { echo $show_date; }
        $c_date = $date;
		
		  echo '</strong></td><td></td><td></td><td></td><td></td></tr>'; 	
		}
		echo '<tr class="sperater"><td bgcolor="#00ABED" colspan="5"></td></tr>';
  }
$date = date('m/d/Y',strtotime('+1 day',strtotime($date)));

} /* end for of calander */ 
} /* end if calander */
?>

</tbody> 
</table>


<!-- Modal -->
<div class="modal fade" id="coordinatorInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Coordinator info</h4>
      </div>
      <div class="modal-body" id="modal-members-div" style="overflow:hidden">
        <?php if(!empty($all_members)) {
                 foreach($all_members as $val) {
                    echo '<div class="col-sm-12 members-list m-'.str_replace(' ','-',$val['first_name']).'"><p><strong>'.$val['first_name'].'</strong><br>'.$val['email_addres'].'<br>'.$val['phone'].'</p></div>';
                 }
              } ?>
			 <!--div class="col-sm-12 members-list members-no-list" style="display:none"><p>No info about this coordinator</p></div-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  jQuery(document).ready( function() {
    jQuery( ".datepicker" ).datepicker({dateFormat:'yy-mm-dd'});
    jQuery('.advan-search').click(function(){
       jQuery('.advan-search-div').toggle();
    });
    jQuery('.member-click').click(function(){
      var cls = jQuery(this).attr('data-cls');
      jQuery('.members-list').hide();
      jQuery('.m-'+cls).show();
    });
  } );
  </script>

