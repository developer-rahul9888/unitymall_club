	<div id="footer">
		
	</div>
	<?php // error_reporting(0); ?>
	
	<?php $user = $profile['0']; ?>	
	
	<style>
	.fcid-card .modal-sm {
    width: 440px;
}

	</style>
	
	 <!-- Modal -->
  <div class="modal fade fcid-card" id="idModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">  ID Card</h4>
        </div>
        <div class="modal-body">
		<?php // echo "<pre>"; print_r($user); echo "</pre>"; ?>
        <div id="dvPrintContent" class="formblock" style="overflow:hidden">
<img id="img" src="<?php echo base_url();?>images/user/auras.png" style="margin-top: -186px;">
<div style="margin-top: -464px; margin-left: 95px; position: absolute;">
<?php if($user['image'] !='') { echo '<img src="'.base_url().'images/user/'.$user['image'].'" width="180px">'; }else{echo '<img src="'.base_url().'images/user/31.png" width="90px" height="90px">';} ?>

</div>
<div class="fcusername" style="position: absolute; font-size: 18px; color: #000; margin-left: 140px; margin-top: -240px; font-family: 'ocr-aregular';">
<span id="lblUserName"><?php echo $user['f_name'].' '.$user['l_name'];?></span>
</div>
<div style="position: absolute; font-size: 18px; color: #000; margin-left: 140px; margin-top: -180px; font-family: 'ocr-aregular';">
<span id="lblFCID"></span>
</div>
<div class="fcuserID" style="position: absolute; font-size: 18px; color: #000; margin-left: 140px; margin-top: -190px; font-family: 'ocr-aregular';">
<span id="lblMemberIds"><?php echo $this->session->userdata('bliss_id');?></span>
</div>

<div class="fcuserID" style="position: absolute; font-size: 18px; color: #000; margin-left: 140px; margin-top: -148px; font-family: 'ocr-aregular';">
<span id="lblMemberIds"><?php echo date('d F Y',strtotime($user['rdate']));?></span>
</div>

<div class="fcuserID" style="position: absolute; font-size: 18px; color: #000; margin-left: 140px; margin-top: -100px; font-family: 'ocr-aregular';">
<span id="lblMemberIds"><?php echo $user['phone'];?></span>
</div>

<div class="fcuserID" style="position: absolute; font-size: 18px; color: #000; margin-left: 140px; margin-top: -58px; font-family: 'ocr-aregular';">
<span id="lblMemberIds"><?php echo $user['bsacode'];?></span>
</div>



</div>

<div class="clearfix">&nbsp;</div>

<div class="form-row loginbtnblock hide">
<input type="button" name="ctl00$btnExport" value="Export" onclick="return PrintFcID();__doPostBack('ctl00$btnExport','')" id="btnExport" class="btn normalbtn">
<input type="hidden" name="ctl00$hfMemb" id="hfMemb" value="137708">
<input type="hidden" name="ctl00$hfImageData" id="hfImageData">
</div>
        </div>
       </div>
    </div>
  </div>	
	
	

	
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
  <script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
  <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function () {
  jQuery('.eml').click(function(){
	    jQuery("#envelopeTab").toggle();
  });	
  jQuery('.bbh-btn').click(function(){   
            var cid = jQuery(this).attr('data-id');
            jQuery('.bbh-ajax-info').html('<img src="/assets/images/ajax-loader.gif" style="max-width:100%">');
            jQuery.ajax({
                type:"POST",
                url: '<?php echo base_url();?>index.php/vc_site_admin/downlineall/user_popup_info',
                data: "cid="+cid,
                success:function(data) {
                    jQuery('.bbh-ajax-info').html(data);
                }
            });
        }); 
		
		
		
	var searchRequest = null;

jQuery(function () {
    var minlength = 5;

    jQuery("#bliss_code_input").keyup(function () {
        var that = this,
        value = $(this).val();
        var phone = jQuery('.request-code-input').val();
        if (value.length >= minlength ) {
            if (searchRequest != null) 
                searchRequest.abort();
            searchRequest = jQuery.ajax({
                type:"POST",
                url: "<?php echo base_url(); ?>get-bliss-code-by-phone",
                data:"phone="+phone,
                dataType: "text",
                success: function(data){
					jQuery("#sponsr_name").html(data);
					
					
                }
            });
        }
    });
});	
		
    jQuery('#example').DataTable();
	jQuery( "#datepicker" ).datepicker();
	jQuery( "#datepicker1" ).datepicker();
	jQuery( "#datepicker2" ).datepicker();
	jQuery( "#datepicker3" ).datepicker(); 
	
} );


 
  </script>	

</body>
</html>