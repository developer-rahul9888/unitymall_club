	<div id="footer">
		
	</div>
	


	
	  <!--link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script-->
    

	  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://code.jquery.com/resources/demos/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

  <script>
  
  $(document).ready(function() {
    jQuery('#example').DataTable();
	jQuery( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	jQuery( "#datepicker1" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	jQuery( "#datepicker2" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	jQuery( "#datepicker3" ).datepicker({
      changeMonth: true,
      changeYear: true
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
                url: "<?php echo base_url(); ?>../get-bliss-code-by-phone",
                data:"phone="+phone,
                dataType: "text",
                success: function(data){
					jQuery("#sponsr_name").html(data);
					
					
                }
            });
        }
    });
});	
} );
 
  </script>
</body>
</html>