<?php date_default_timezone_set('America/New_York'); ?>
 
<?php 
$company_show = $agent_show = $agency_show = 'false';
if($this->input->post('company_search')!='') { 
   $company_show = 'true';
 } elseif($this->input->post('agency_search')!='') { 
   $agency_show = 'true';
 } else { 
   $agent_show = 'true';
 } ?> 

<div class="row advan-search-div">
<ul class="tabs">
<li <?php if($agent_show=='true') { echo 'class="active"'; } ?> data=".agent-search">Agent Search</li>
<li <?php if($agency_show=='true') { echo 'class="active"'; } ?> data=".agency-search">Agency Search</li>
<li <?php if($company_show=='true') { echo 'class="active"'; } ?> data=".company-search">Company Search</li>
</ul>
<div class="col-sm-12 agent-search tab" style="display:<?php if($agent_show=='true') { echo 'block'; } else { echo 'none'; } ?>">
<h2>Agent Search</h2>
<p>&nbsp;</p>
<form class="form form-inline" action="/" method="post">
<input type="text" name="name" value="<?php if($this->input->post('agent_search')!='') { echo $this->input->post('name'); }?>" placeholder="Name" class="form-control"> 
<input type="text" size="8" name="waoic" value="<?php if($this->input->post('agent_search')!='') { echo $this->input->post('waoic'); }?>" placeholder="WAOIC" class="form-control"> 
<input type="text" size="8" name="npn" value="<?php if($this->input->post('agent_search')!='') { echo $this->input->post('npn'); }?>" placeholder="NPN" class="form-control"> 
<input type="text" name="dba" value="<?php if($this->input->post('agent_search')!='') { echo $this->input->post('dba'); }?>" placeholder="DBA" class="form-control"> 
<input type="text" name="city" value="<?php if($this->input->post('agent_search')!='') { echo $this->input->post('city'); }?>" placeholder="City, State, Zip" class="form-control"> 
<select name="insu_type" class="form-control">
<option value="">Types of insurance</option>
<option value="">Select All</option>
		<option <?php if($this->input->post('insu_type')=='1') { echo 'selected="selected"'; }?> value="1">Auto / Home</option>
		<option <?php if($this->input->post('insu_type')=='2') { echo 'selected="selected"'; }?> value="2">Boat / RV / Motorcycle</option>
		<option <?php if($this->input->post('insu_type')=='3') { echo 'selected="selected"'; }?> value="3">Commercial</option>
		<option <?php if($this->input->post('insu_type')=='4') { echo 'selected="selected"'; }?> value="4">Health / Disability</option>
		<option <?php if($this->input->post('insu_type')=='5') { echo 'selected="selected"'; }?> value="5">Life</option>
		<option <?php if($this->input->post('insu_type')=='6') { echo 'selected="selected"'; }?> value="6">Surety / Bail bonds</option> 
		<option <?php if($this->input->post('insu_type')=='8') { echo 'selected="selected"'; }?> value="8">Travel</option>
		<option <?php if($this->input->post('insu_type')=='9') { echo 'selected="selected"'; }?> value="9">Variable / Annuities</option>
</select>
<input type="submit" name="agent_search" value="Search" class="btn btn-primary">
</form>
<p>&nbsp;</p>
</div>

<div class="col-sm-12 agency-search tab" style="display:<?php if($agency_show=='true') { echo 'block'; } else { echo 'none'; } ?>">
<h2>Agency Search</h2>
<p>&nbsp;</p>
<form class="form form-inline" action="/" method="post">
<input type="text" name="name" value="<?php if($this->input->post('agency_search')!='') { echo $this->input->post('name'); }?>" placeholder="Name" class="form-control"> 
<input type="text" name="waoic" value="<?php if($this->input->post('agency_search')!='') { echo $this->input->post('waoic'); }?>" placeholder="WAOIC" class="form-control">   
<input type="text" name="dba" value="<?php if($this->input->post('agency_search')!='') { echo $this->input->post('dba'); }?>" placeholder="DBA" class="form-control"> 
<input type="text" name="city" value="<?php if($this->input->post('agency_search')!='') { echo $this->input->post('city'); }?>" placeholder="City, State, Zip" class="form-control"> 
<select name="insu_type" class="form-control">
<option value="">Types of insurance</option>
<option value="">Select All</option>
		<option <?php if($this->input->post('insu_type')=='1') { echo 'selected="selected"'; }?> value="1">Auto / Home</option>
		<option <?php if($this->input->post('insu_type')=='2') { echo 'selected="selected"'; }?> value="2">Boat / RV / Motorcycle</option>
		<option <?php if($this->input->post('insu_type')=='3') { echo 'selected="selected"'; }?> value="3">Commercial</option>
		<option <?php if($this->input->post('insu_type')=='4') { echo 'selected="selected"'; }?> value="4">Health / Disability</option>
		<option <?php if($this->input->post('insu_type')=='5') { echo 'selected="selected"'; }?> value="5">Life</option>
		<option <?php if($this->input->post('insu_type')=='6') { echo 'selected="selected"'; }?> value="6">Surety / Bail bonds</option>
		<option <?php if($this->input->post('insu_type')=='7') { echo 'selected="selected"'; }?> value="7">Title</option>
		<option <?php if($this->input->post('insu_type')=='8') { echo 'selected="selected"'; }?> value="8">Travel</option>
		<option <?php if($this->input->post('insu_type')=='9') { echo 'selected="selected"'; }?> value="9">Variable / Annuities</option>
</select>
<input type="submit" name="agency_search" value="Search" class="btn btn-primary">
</form>
<p>&nbsp;</p>
</div>

<div class="col-sm-12 company-search tab" style="display:<?php if($company_show=='true') { echo 'block'; } else { echo 'none'; } ?>">
<h2>Company Search</h2>
<p>&nbsp;</p>
<form class="form form-inline" action="/" method="post">
<input type="text" name="name" value="<?php if($this->input->post('company_search')!='') { echo $this->input->post('name'); }?>" placeholder="Name" class="form-control"> 
<input type="text" name="waoic" value="<?php if($this->input->post('company_search')!='') { echo $this->input->post('waoic'); }?>" placeholder="WAOIC" class="form-control"> 
<input type="text" name="naic" value="<?php if($this->input->post('company_search')!='') { echo $this->input->post('naic'); }?>" placeholder="NAIC" class="form-control"> 
<!--select name="coverage_type" title="Type of insurance" class="form-control">
		<option value="">Coverage type</option>
		<option value="PC">Auto/Home/Commercial (Property &amp; Casualty)</option>
		<option value="CHARITGA">Charitable Gift Annuity</option>
		<option value="HEALTH">Health</option>
		<option value="HEALTHDISC">Healthcare Discount Plan</option>
		<option value="HOUSESERVC">Household Service Contract (heating, appliances)</option>
		<option value="KEYREPLACE">Key Replacement</option>
		<option value="LIFESETT">Life Settlement</option>
		<option value="LIFEANNU">Life/Annuity</option>
		<option value="PAINTLESSD">Paintless Dent</option>
		<option value="PP">Product Guarantee</option>
		<option value="UTILITY">Residential Utilities</option>
		<option value="SURETY">Surety</option>
		<option value="TIREWHEEL">Tire/Wheel</option>
		<option value="TITLE">Title</option>
		<option value="VEHICLESC">Vehicle Service Contract</option>
		<option value="WINDSHIELD">Windshield Repair</option> 
	</select-->
<select name="organiz_type" title="Organization Type" class="form-control">
		<option value="">Organization Type</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Accredited Reinsurer') { echo 'selected="selected"'; }?> value="Accredited Reinsurer">Accredited Reinsurer</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Association') { echo 'selected="selected"'; }?> value="Association">Association</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Charitable Gift Annuity') { echo 'selected="selected"'; }?> value="Charitable Gift Annuity">Charitable Gift Annuity</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Certified Reinsurer') { echo 'selected="selected"'; }?> value="Certified Reinsurer">Certified Reinsurer</option>
		<option  va<?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Fraternal Benefit Societies') { echo 'selected="selected"'; }?>value="Fraternal Benefit Societies">Fraternal Benefit Societies</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Health Care Service Contractor') { echo 'selected="selected"'; }?> value="Health Care Service Contractor">Health Care Service Contractor</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Accredited Reinsurer') { echo 'selected="selected"'; }?> value="Healthcare Discount Plan">Healthcare Discount Plan</option>Healthcare Discount Plan
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Health Maintenance Organization') { echo 'selected="selected"'; }?> value="Health Maintenance Organization">Health Maintenance Organization</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Independent Review Organization') { echo 'selected="selected"'; }?> value="Independent Review Organization">Independent Review Organization</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Limited Health Care Service Contractor') { echo 'selected="selected"'; }?> value="Limited Health Care Service Contractor">Limited Health Care Service Contractor</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Life') { echo 'selected="selected"'; }?> value="Life">Life</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Life Settlements') { echo 'selected="selected"'; }?> value="Life Settlements">Life Settlements</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Multiple Employer Welfare Association') { echo 'selected="selected"'; }?> value="Multiple Employer Welfare Association">Multiple Employer Welfare Association</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Purchasing Group') { echo 'selected="selected"'; }?> value="Purchasing Group">Purchasing Group</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Property') { echo 'selected="selected"'; }?> value="Property">Property</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Reinsurance intermediary') { echo 'selected="selected"'; }?> value="Reinsurance intermediary">Reinsurance intermediary</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Risk Retention') { echo 'selected="selected"'; }?> value="Risk Retention">Risk Retention</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Service Contract Provider') { echo 'selected="selected"'; }?> value="Service Contract Provider">Service Contract Provider</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Trusteed Alien Reinsurer') { echo 'selected="selected"'; }?> value="Trusteed Alien Reinsurer">Trusteed Alien Reinsurer</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Title') { echo 'selected="selected"'; }?> value="Title">Title</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Third Party Administrator') { echo 'selected="selected"'; }?> value="Third Party Administrator">Third Party Administrator</option>
		<option <?php if($this->input->post('company_search')!='' && $this->input->post('organiz_type')=='Viatical Settlement Provider') { echo 'selected="selected"'; }?>  value="Viatical Settlement Provider">Viatical Settlement Provider</option> 
	</select>
<input type="submit" name="company_search" value="Search" class="btn btn-primary">
</form>
<p>&nbsp;</p>
</div>

</div>

<div class="result-div">
<?php if($this->input->post('company_search')!='') { ?>
<table id="example" class="table table-bordered" width="100%" cellspacing="0">
<thead> <tr> <th>Name</th><th>WAOIC</th> <th>Status</th> </tr> </thead> 
<tbody> 
<?php 
	$i = 1;
if(empty($company_search)) { echo '<tr><td colspan="3">No company found</td></tr>'; }
else { 
foreach($company_search as $con) { 
	echo '<tr><td><a target="_blank" href="/company/'.$con['waoic'].'">'.$con['name'].'</a></td><td>'.$con['waoic'].'</td><td>'.$con['status'].'</td>  </tr>';
$i++;
} 
}  
?>

</tbody> 
</table>
<?php } ?>

<?php if($this->input->post('agency_search')!='') { ?>
<table id="example" class="table table-bordered" width="100%" cellspacing="0">
<thead> <tr> <th>Name</th><th>WAOIC</th> <th>City, State, Zip</th> <th>Status</th> </tr> </thead> 
<tbody> 
<?php 
	$i = 1;
if(empty($agency_search)) { echo '<tr><td colspan="4">No agency found</td></tr>'; }
else { 
foreach($agency_search as $con) { 
	echo '<tr><td><a target="_blank" href="/agency/'.$con['waoic'].'">'.$con['name'].'</a></td><td>'.$con['waoic'].'</td><td>'.$con['address2'].'</td><td>'.$con['status'].'</td>  </tr>';
$i++;
} 
}  
?>

</tbody> 
</table>
<?php } ?>

<?php if($this->input->post('agent_search')!='') { ?>
<table id="example" class="table table-bordered" width="100%" cellspacing="0">
<thead> <tr> <th>Name</th><th>WAOIC</th> <th>NPN</th> <th>City, State, Zip</th> </tr> </thead> 
<tbody> 
<?php 
	$i = 1;
if(empty($agent_search)) { echo '<tr><td colspan="4">No agent</td></tr>'; }
else { 
foreach($agent_search as $con) { 
	echo '<tr><td><a target="_blank" href="/agent/'.$con['waoic'].'">'.$con['name'].'</a></td><td>'.$con['waoic'].'</td><td>'.$con['npn'].'</td><td>'.$con['address2'].'</td>  </tr>';
$i++;
} 
}  
?>

</tbody> 
</table>
<?php } ?>

</div>


<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<script type="text/javascript"> 
jQuery(document).ready(function(){
    jQuery('#example').DataTable();
	jQuery('.tabs li').click(function(){
		jQuery('.tabs li').removeClass('active');
		jQuery(this).addClass('active');
		var cls = jQuery(this).attr('data');
		jQuery('.tab').hide();
		jQuery(cls).show();
                jQuery('.result-div').hide();
	});
});
</script>
