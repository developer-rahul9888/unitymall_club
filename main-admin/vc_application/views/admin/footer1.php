	<div id="footer">
		<hr>
		<div class="inner">
			<div class="container">
				<!--p class="right"><a href="#">Back to top</a></p-->
				<p>
				</p>
			</div>
		</div>
	</div>
	
	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-2.2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<!--script src="<?php echo base_url(); ?>assets/js/admin.min.js"></script-->
	  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery("a.show-zip").click(function(){
                    jQuery(this).parent('span').toggleClass('active');
                });
				jQuery('.add-more-d-area').click(function(){
					var content = '<input type="text" class="form-control" name="delivery_area[]" placeholder="1 Mile - $10" >';
					jQuery('.add-more-d-area-div').append(content);
				});
				
				jQuery('.add-more-spl-hour').click(function(){
					var content = '<input type="text" class="datetimepicker1" name="mspl_hour[]" />				 <select name="opening_hour[]"><option value="00">Opening Hours</option><option value="00">00:00 A.M</option><option value="01">01:00 A.M</option><option value="02">02:00 A.M</option>		<option value="03">03:00 A.M</option><option value="04">04:00 A.M</option><option value="05">05:00 A.M</option><option value="06">06:00 A.M</option><option value="07">07:00 A.M</option><option value="08">08:00 A.M</option><option value="09">09:00 A.M</option>		<option value="10">10:00 A.M</option><option value="11">11:00 A.M</option><option value="12">12:00 P.M</option><option value="13">13:00 P.M</option><option value="14">14:00 P.M</option><option value="15">15:00 P.M</option><option value="16">16:00 P.M</option>		<option value="17">17:00 P.M</option><option value="18">18:00 P.M</option><option value="19">19:00 P.M</option><option value="20">20:00 P.M</option><option value="21">21:00 P.M</option><option value="22">22:00 P.M</option><option value="23">23:00 P.M</option>		 </select><select name="closing_hour[]"><option value="00">Closing Hours</option><option value="00">00:00 A.M</option><option value="01">01:00 A.M</option><option value="02">02:00 A.M</option><option value="03">03:00 A.M</option><option value="04">04:00 A.M</option>		<option value="05">05:00 A.M</option><option value="06">06:00 A.M</option><option value="07">07:00 A.M</option><option value="08">08:00 A.M</option><option value="09">09:00 A.M</option><option value="10">10:00 A.M</option><option value="11">11:00 A.M</option>			<option value="12">12:00 P.M</option><option value="13">13:00 P.M</option><option value="14">14:00 P.M</option><option value="15">15:00 P.M</option><option value="16">16:00 P.M</option><option value="17">17:00 P.M</option><option value="18">18:00 P.M</option>			<option value="19">19:00 P.M</option><option value="20">20:00 P.M</option><option value="21">21:00 P.M</option><option value="22">22:00 P.M</option><option value="23">23:00 P.M</option></select>';
					
					jQuery('.add-more-d-area-div').append(content);
				});
				
				 jQuery( ".datetimepicker1" ).datepicker({dateFormat:'d M yy'});
				 
				 jQuery('#spl_hr').click(function(){
				    jQuery('.show_hr').show();
				 });
				 jQuery('#alwys').click(function(){
				    jQuery('.show_hr').hide();
				 });
            });
			
        </script>
</body>
</html>